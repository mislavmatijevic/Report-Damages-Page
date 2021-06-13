<?php

require_once dirname(__DIR__)."/control/constants.php";

define("server", "localhost");
define("korisnik", "WebDiP2020x057");
define("lozinka", "admin_PNID");
define("baza", "WebDiP2020x057");

define("DBError", -5);
define("DBEmpty", -4);
define("DBLogicError", -3);
define("DBUserError", -2);
define("DBPassError", -1);
define("DBSuccess", 1);

require_once dirname(__DIR__) . "/control/OutputControl.php"; // Protiv XSS-a čim se čita iz baze.

class Log
{
    // Tipovi radnji
    public const prijava = 1;
    public const odjava = 2;
    public const registracija = 3;
    public const aktivacija = 4;
    public const pristup_stranici = 5;
    public const prihvaćanje_uvjeta = 6;
    public const donacija = 7;
    public const otvaranje_javnog_poziva = 8;
    public const zatvaranje_javnog_poziva = 9;
    public const prijava_na_javni_poziv = 10;
    public const subvencioniranje = 11;
    public const prijava_štete = 12;
    public const neuspješna_prijava = 13;
    public const blokiranje = 14;
    public const zahtjev_nove_lozinke = 15;
    public const promjena_lozinke = 16;
    public const odbijanje_prijave = 17;
    public const mail_za_registraciju = 18;
    public const mail_za_lozinku = 19;
    public const mail_za_blokiranje = 20;
    public const općenit_upit = 21;
    public const promjena_konfiguracije = 22;
    
    // Tipovi radnji

    private $dbObjLog;
    public function __construct(DB $activeDbObj) // OBJEKT NE SMIJE sadržavati objekt baze jer bi se rekurzivno sadržavali!
    {
        $this->dbObjLog = $activeDbObj;
    }

    public function New($query, $description, $activity, $id_user = null)
    {
        global $fullScriptName;
        global $confFilePath;

        if ($id_user === null) {
            isset($_SESSION["user"]->id_korisnik) ? $executor = $_SESSION["user"]->id_korisnik : $executor = "1";
        } else {
            $executor = $id_user;
        }

        $config = parse_ini_file($confFilePath);
        $this->dbObjLog->ExecutePrepared("INSERT INTO dnevnik (`url`, `datum_vrijeme`, `upit`, `opis_radnje`, `id_radnja`, `id_izvrsitelj`) VALUES (?, ?, ?, ?, ?, ?)", "ssssii", [$fullScriptName, date("Y-m-d H:i:s", time() + $config["virtualTimeOffsetSeconds"]), $query, $description, $activity, $executor]);
    }

    /**
     * @param string $criteria prazno (sve) / "user" / "action" / "frequency"
     * @param string $arguments id_korisnik / id_radnje
     */
    public function GetLogs(string $criteria = "", string $argument = "")
    {
        switch ($criteria) {
            case '':
                $records = $this->dbObjLog->SelectPrepared("TABLE dnevnik");
                break;
            case 'user':
                $records = $this->dbObjLog->SelectPrepared("SELECT * dnevnik WHERE id_izvrsitelj = ?", "i", [$argument]);
                break;
            case 'action':
                $records = $this->dbObjLog->SelectPrepared("SELECT * FROM dnevnik WHERE id_radnja = ?;", "i", [$argument]);
                break;
            case 'frequency':
                $records = $this->dbObjLog->SelectPrepared("SELECT tr.naziv, COUNT(*) as count FROM tip_radnje as tr INNER JOIN dnevnik as d WHERE d.id_radnja = tr.id_tip GROUP BY tr.naziv ORDER BY COUNT(*) DESC;");
                break;
            default: {
                throw new Exception("Nepoznat kriterij \"$criteria\" za dohvat logova iz baze!", 1);
            }
        }

        return Prevent::XSS($records);
    }
};

class DB
{
    private $mysqli_object = null;
    private $logObj;

    public function __construct()
    {
        $this->mysqli_object = new mysqli(server, korisnik, lozinka, baza);
        mysqli_report(MYSQLI_REPORT_ERROR);
        if ($this->mysqli_object->connect_errno) {
            throw new Exception("Neuspješno spajanje na bazu (" . $this->mysqli_object->connect_errno . ")", DBError);
        }

        $this->mysqli_object->set_charset("utf8");
        if ($this->mysqli_object->connect_errno) {
            throw new Exception("Neuspješno postavljanje znakova za bazu (" . $this->mysqli_object->connect_errno . ")", DBError);
        }

        if (isset($error)) {
            throw new Exception($error, DBError);
        }

        $this->logObj = new Log($this);
    }

    public function __destruct()
    {
        $this->mysqli_object->close();
    }

    public function ExecutePrepared(string $preparedQuery, string $argumentsString = "", array $argumentsArray = [], bool $returnLastIndex = false)
    {
        if (($prepared = $this->mysqli_object->prepare($preparedQuery)) == false) {
            throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
        }

        if (empty($argumentsArray) === false) {
            if (($prepared->bind_param($argumentsString, ...$argumentsArray)) == false) {
                throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
            }
        }

        if ($prepared->execute() == false) {
            var_dump($preparedQuery);
            var_dump($argumentsString);
            var_dump(...$argumentsArray);
            throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
        };

        if ($returnLastIndex) {
            return $prepared->insert_id;
        }

        return $prepared->get_result();
    }

    public function SelectPrepared(string $preparedQuery, string $argumentsString = "", array $argumentsArray = [])
    {
        $userResult = $this->ExecutePrepared($preparedQuery, $argumentsString, $argumentsArray);

        // Uopće ne postoji takav korisnik (ili je izbrisan, ili je promijenio lozinku).
        if ($userResult->num_rows == 0) {
            throw new Exception("Neuspio dohvat iz baze! (" . __LINE__ . ")", DBEmpty);
        }

        return Prevent::XSS($userResult->fetch_all(MYSQLI_ASSOC));
    }

    /**
     * @return boolean|object Ako korisnik postoji, vraća njegov objekt iz baze, inače baca iznimku.
     */
    public function CheckUserExists(string $username)
    {
        $dbResult = $this->ExecutePrepared("SELECT * FROM korisnik WHERE korisnicko_ime = ?", "s", [$username]);

        if ($dbResult->num_rows == 0) { // Korisnik ne postoji:
            throw new Exception('<a class="warning-exception" href="/register.php">Niste registrirani?</a>', DBUserError);
        }

        return Prevent::XSS($dbResult->fetch_object());
    }

    /**
     * @return object|integer Ako je korisnik autenticiran, vraća njegov objekt iz baze, inače baca iznimku.
     */
    public function AuthenticateUser(string $username, string $password)
    {
        $userObject = $this->CheckUserExists($username);

        // Korisnik postoji i mi imamo sve njegove podatke u 'resultObject'.

        // Predstoje tri provjere.
        // Za početak, je li blokiran?
        if ($userObject->status_blokade != null) {
            throw new Exception("Račun blokiran", DBUserError);
        }

        // Nije blokiran.
        // Odgovaraju li mu lozinke?
        if ($userObject->lozinka_sha256 != hash("sha256", $userObject->sol . $password)) { // Lozinke se ne poklapaju
            $retry_count = $userObject->broj_neuspjesnih_prijava == null ? 1 : $userObject->broj_neuspjesnih_prijava + 1;
            
            $this->ExecutePrepared("UPDATE `WebDiP2020x057`.`korisnik` SET `broj_neuspjesnih_prijava` = ? WHERE `id_korisnik` = ?", "ii", [$retry_count, $userObject->id_korisnik]);

            $this->logObj->New("UPDATE `WebDiP2020x057`.`korisnik` SET `broj_neuspjesnih_prijava` = $retry_count WHERE `id_korisnik` = $userObject->id_korisnik", "Korisnik $userObject->korisnicko_ime nije unio ispravnu lozinku. Unesene lozinke su", Log::neuspješna_prijava, $userObject->id_korisnik);
            throw new Exception("$retry_count", DBPassError);
        }

        // Lozinke se poklapaju
        // Trebaju se poništiti neuspješne prijave i provjeriti je li račun aktiviran.
        if ($userObject->broj_neuspjesnih_prijava !== null) {
            $this->ExecutePrepared("UPDATE `WebDiP2020x057`.`korisnik` SET `broj_neuspjesnih_prijava`=NULL WHERE `id_korisnik` = ?", "i", [$userObject->id_korisnik]);
        }

        if ($userObject->datum_aktivacije === null) {
            throw new Exception("Račun nije aktiviran", DBLogicError);
        }

        $this->logObj->New("UPDATE `WebDiP2020x057`.`korisnik` SET `broj_neuspjesnih_prijava`=NULL WHERE `id_korisnik` = $userObject->id_korisnik", "Prijavio se korisnik $userObject->korisnicko_ime.", Log::prijava, $userObject->id_korisnik);
        return Prevent::XSS($userObject);
    }

    /**
     * Blokira korisnika.
     */
    public function BlockUser($username, $doBlock = true)
    {
        $newBlockStatus = $doBlock ? 1 : null;
        
        $this->ExecutePrepared("UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = ?, `broj_neuspjesnih_prijava` = NULL WHERE korisnicko_ime = ?", "is", [$newBlockStatus, $username]);

        $this->logObj->New("UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = $newBlockStatus, `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = $username", "Blokiran je korisnik $username.", Log::blokiranje);
        
        return DBSuccess;
    }

    /**
     * Vraća popis svih blokiranih.
     */
    public function GetAllWithBlockedStatus($status)
    {
        return $this->SelectPrepared("SELECT id_korisnik, email, korisnicko_ime FROM `WebDiP2020x057`.`korisnik` WHERE `status_blokade` = ?", "i", [$status]);
    }

    /**
     * @return string Ako je korisnik uspješno ubačen, vraća njegovu lozinku u "sha256" obliku pomoću koje se korisnik aktivira preko maila.
     */
    public function InsertUser($newUser, $salt)
    {
        global $confFilePath;
        $pass_sha256 = hash("sha256", $salt . $newUser["password"]);

        $config = parse_ini_file($confFilePath);
        $currentTime = date("Y-m-d H:i:s", time() + $config["virtualTimeOffsetSeconds"]);

        $this->ExecutePrepared("INSERT INTO `korisnik` (`ime`, `prezime`, `korisnicko_ime`, `email`, `lozinka_citljiva`, `sol`, `lozinka_sha256`, `datum_registracije`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)", "ssssssss", [$newUser["name"], $newUser["surname"], $newUser["username"], $newUser["email"], $newUser["password"], $salt, $pass_sha256, $currentTime]);

        $this->logObj->New("INSERT INTO `korisnik` (`ime`, `prezime`, `korisnicko_ime`, `email`, `lozinka_citljiva`, `sol`, `lozinka_sha256`, `datum_registracije`) VALUES (" . $newUser["name"] . $newUser["surname"] . $newUser["username"] . $newUser["email"] . "[nova_lozinka]" . $salt . $pass_sha256 . $currentTime . ")", "Registriran je korisnik {$newUser["username"]}.". $newUser['username'], Log::registracija, $this->mysqli_object->insert_id);

        return $pass_sha256;
    }

    /**
     * @return user Ako je korisniku uspješno zabilježena aktivacija, vraća cijeli njegov objekt iz baze.
     */
    public function ConfirmUser(string $sha256password, string $username, int $maxHoursToAccept)
    {
        $userObject = null;
        try {
            $userObject = $this->SelectPrepared("SELECT * FROM `korisnik` WHERE `lozinka_sha256` = ? AND `korisnicko_ime` = ?", "ss", [$sha256password, $username])[0];
        } catch (Exception $e) {
            if ($e->getCode() == DBEmpty) {
                throw new Exception("Ovaj je link nevažeći", DBUserError);
            } else {
                throw $e;
            }
        }

        global $confFilePath;
        $config = parse_ini_file($confFilePath);
        $currentTime = date("Y-m-d H:i:s", time() + $config["virtualTimeOffsetSeconds"]);
        
        // Ako je aktiviran prihvaćeni:
        if ($userObject["datum_aktivacije"] != null) {
            $this->logObj->New("SELECT * FROM `korisnik` WHERE `lozinka_sha256` = $sha256password AND `korisnicko_ime` = $username", "Prilikom pokušaja aktivacije korisnik $username je označen kao već aktiviran.", Log::registracija);
            throw new Exception('Račun već aktiviran. U slučaju pogreške kontaktirajte administratora.', DBPassError);
        } else {
            if (($currentTime - strtotime($userObject["datum_registracije"])) / 60 / 60 > $maxHoursToAccept) {
                // Izbriši nevažećeg korisnika.
                $this->ExecutePrepared("DELETE FROM `WebDiP2020x057`.`korisnik` WHERE `korisnicko_ime` = ?", "s", [$username]);

                $this->logObj->New("DELETE FROM `WebDiP2020x057`.`korisnik` WHERE `korisnicko_ime` = $username", "Prilikom pokušaja aktivacije izbrisan je nevažeći korisnik $username koji se nije bio aktivirao na vrijeme.", Log::registracija);

                throw new Exception("Rok za aktivaciju je istekao ({$maxHoursToAccept}h).<br>Možete otvoriti novi račun s istim korisničkim imenom.", DBError);
            }
            

            // Sve ok, označi da je korisnik aktiviran.
            $this->ExecutePrepared("UPDATE `WebDiP2020x057`.`korisnik` SET `datum_aktivacije` = ? WHERE (`id_korisnik` = ?)", "si", [$currentTime, $userObject["id_korisnik"]]);
        }

        $this->logObj->New("UPDATE `WebDiP2020x057`.`korisnik` SET `datum_aktivacije` = $currentTime WHERE (`id_korisnik` = {$userObject["id_korisnik"]})", "Aktiviran je korisnik $username s identifikatorom šifrom {$userObject["id_korisnik"]}.", Log::registracija);

        return $userObject;
    }


    public function GetUserData(string $username)
    {
        $result = $this->ExecutePrepared("SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = ?", "s", [$username]);

        if ($result->num_rows === 0) {
            throw new Exception('<a href="./register.php">Niste registrirani?</a>', DBUserError);
        }

        $this->logObj->New("SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = $username", "Zahtjevani su i dohvaćeni podaci za konkretnog korisnika s korisničkim imenom $username.", Log::općenit_upit);

        return Prevent::XSS($result->fetch_object());
    }

    public function PrepareIdentifierForNewPassword(string $username, string $meshedIdentifier)
    {
        $userObject = $this->GetUserData($username);
        $this->ExecutePrepared("UPDATE `WebDiP2020x057`.`korisnik` SET `lozinka_citljiva` = ? WHERE `id_korisnik` = ?", "si", [$meshedIdentifier, $userObject->id_korisnik]);

        $this->logObj->New("UPDATE `WebDiP2020x057`.`korisnik` SET `lozinka_citljiva` = $meshedIdentifier WHERE `id_korisnik` = $userObject->id_korisnik", "Zahtjevana je nova lozinka za korisnika $username. Identifikator korisnika jest $meshedIdentifier.", Log::zahtjev_nove_lozinke, $userObject->id_korisnik);

        return DBSuccess;
    }

    /**
     * Postavlja novu lozinku tamo gdje je stupac "čitljiva lozinka" set od 50 pseudoslučajnih znakova.
     * Prvo traži korisnika s takvom "čitljivom" lozinkom, a potom preko id-ja pronađenog korisnika izvršava UPDATE upit.
     * @param string $meshedIdentifier 50 pseudoslučajnih znakova zapamćeni u polju "lozinka_citljiva", osigurava privatnost.
     * @param string $newPassword Nova šifra u čitljivom obliku.
     * @return string Ako je sve prošlo u redu, vraća šifru DBSuccess.
     */
    public function SetPasswordWithIdentifier(string $meshedIdentifier, string $newPassword, string $salt)
    {
        //////////// DOHVAĆANJE KORISNIKA PO HASHU ////////////
        $result = $this->ExecutePrepared("SELECT id_korisnik, korisnicko_ime FROM korisnik WHERE `lozinka_citljiva` = ?", "s", [$meshedIdentifier]);

        if ($result->num_rows === 0) {
            throw new Exception("Link je istekao.", DBPassError);
        }
        //////////// KRAJ DOHVAĆANJA KORISNIKA PO HASHU ////////////

        $userObject = Prevent::XSS($result->fetch_object());

        $pass_sha256 = hash("sha256", $salt . $newPassword);
        try {
            $this->ExecutePrepared("UPDATE `WebDiP2020x057`.`korisnik` SET `lozinka_citljiva` = ?, `sol` = ?, `lozinka_sha256` = ?, `broj_neuspjesnih_prijava` = NULL WHERE `id_korisnik` = ?", "sssi", [$newPassword, $salt, $pass_sha256, $userObject->id_korisnik]);
        } catch (Exception $e) {
            throw new Exception("Dogodila se pogreška i lozinka nije promijenjena (" . __LINE__ . ")", DBPassError);
        }

        $this->logObj->New("UPDATE `WebDiP2020x057`.`korisnik` SET `lozinka_citljiva` = [nova_lozinka], `sol` = $salt, `lozinka_sha256` = $pass_sha256, `broj_neuspjesnih_prijava` = NULL WHERE `id_korisnik` = $userObject->id_korisnik", "Postavljena je nova lozinka za korisnika $userObject->korisnicko_ime.", Log::promjena_lozinke, $userObject->id_korisnik);
        return DBSuccess;
    }

    public function MakeDonation(int $idJavniPoziv, float $amount, $user)
    {
        $currentFunding = $this->SelectPrepared("SELECT skupljeno_sredstava, zatvoren FROM javni_poziv WHERE id_javni_poziv = ?", "i", [$idJavniPoziv]);
        $isClosed = $currentFunding[0]["zatvoren"];
        if ($isClosed == 1) {
            throw new Exception("Ovaj javni poziv je zatvoren!", DBLogicError);
        }
        $newFunding = $currentFunding[0]["skupljeno_sredstava"] + $amount;
        $this->ExecutePrepared("UPDATE javni_poziv SET skupljeno_sredstava = ? WHERE id_javni_poziv = ?", "di", [$newFunding, $idJavniPoziv]);

        $queryReadable = "UPDATE javni_poziv SET skupljeno_sredstava = $amount WHERE id_javni_poziv = $idJavniPoziv";

        if (isset($user)) { // Registrirani korisnik
            $this->ExecutePrepared("INSERT INTO `WebDiP2020x057`.`donacije` (`iznos`, `id_javni_poziv`, `id_donator`) VALUES (?, ?, ?)", "dii", [$amount, $idJavniPoziv, $user->id_korisnik]);
            $this->logObj->New("$queryReadable; INSERT INTO `WebDiP2020x057`.`donacije` (`iznos`, `id_javni_poziv`, `id_donator`) VALUES ({$amount}, {$idJavniPoziv}, {$user->id_korisnik})", "Korisnik $user->korisnicko_ime donirao je $amount HRK za javni poziv s oznakom $idJavniPoziv.", Log::donacija, $user->id_korisnik);
        } else {
            $this->logObj->New($queryReadable, "Neregistrirani korisnik s IP adresom {$_SERVER['REMOTE_ADDR']} donirao je $amount HRK za javni poziv s oznakom $idJavniPoziv.", Log::donacija);
        }
    }


    /**
     * Vraća šifru novododane štete.
     */
    public function InsertDamage(int $idJavniPoziv, int $idUser, int $idCategory, $newDamageInfo)
    {
        $currentPublicCallStatus = $this->SelectPrepared("SELECT zatvoren FROM javni_poziv WHERE id_javni_poziv = ?", "i", [$idJavniPoziv]);
        $isClosed = $currentPublicCallStatus["zatvoren"];
        if ($isClosed == 1) {
            throw new Exception("Ovaj javni poziv je zatvoren!", DBLogicError);
        }

        $argArray = [$newDamageInfo["name"], $newDamageInfo["description"], $newDamageInfo["tags"], $idCategory, $idUser, $idJavniPoziv];

        $newDamageId = $this->ExecutePrepared("INSERT INTO steta (naziv, opis, oznake, id_kategorija_stete, id_prijavitelj, id_javni_poziv) VALUES (?, ?, ?, ?, ?, ?)", "sssiii", $argArray, true);


        foreach ($newDamageInfo["files"] as $key => $thisFile) {            
            $lastEvidenceIndex = $this->ExecutePrepared("INSERT INTO `WebDiP2020x057`.`dokazni_materijali` (`naziv`, `id_vrsta_materijala`) VALUES (?, ?)", "si", [$thisFile->fileName, $thisFile->fileType], true);
            $this->ExecutePrepared("INSERT INTO `WebDiP2020x057`.`steta_dokazi` (`id_steta`, `id_materijala`) VALUES (?, ?)", "ii", [$newDamageId, $lastEvidenceIndex]);
        }

        $this->logObj->New("INSERT INTO `WebDiP2020x057`.`steta` (`naziv`, `opis`, `oznake`, `id_kategorija_stete`, `id_prijavitelj`, `id_javni_poziv`) VALUES ({$newDamageInfo["name"]}, {$newDamageInfo["description"]}, {$newDamageInfo["tags"]}, $idCategory, $idUser, $idJavniPoziv); INSERT INTO `WebDiP2020x057`.`dokazni_materijali` (`naziv`, `id_vrsta_materijala`) VALUES ({$newDamageInfo["files"]->fileName}, {$newDamageInfo["files"]->fileType}); INSERT INTO `WebDiP2020x057`.`steta_dokazi` (`id_steta`, `id_materijala`) VALUES ({$newDamageId}, {$lastEvidenceIndex})", "Prijavljena je nova šteta!", Log::prijava_štete);

        return $newDamageId;
    }

    public function FundDamage(int $callId, int $damageId, float $amount, bool $isDepleted)
    {
        // Trenutno stanje
        $currentPublicCallFunds = $this->SelectPrepared("SELECT skupljeno_sredstava FROM javni_poziv WHERE id_javni_poziv = ?", "i", [$callId]);
        // Novo stanje
        $currentPublicCallFunds = $currentPublicCallFunds[0]["skupljeno_sredstava"] - $amount;

        // Još jednanput provjere.
        if ($currentPublicCallFunds < 0) {
            throw new Exception("Nedovoljno sredstava!", DBLogicError);
        } else if ($currentPublicCallFunds == 0) {
            $isDepleted = true;
        }
        // Oduzmi pozivu:
        $this->ExecutePrepared("UPDATE javni_poziv SET skupljeno_sredstava = ? WHERE id_javni_poziv = ?", "di", [$currentPublicCallFunds, $callId]);
        
        $firstQuery = "UPDATE javni_poziv SET skupljeno_sredstava = $currentPublicCallFunds WHERE id_javni_poziv = $callId";

        if ($isDepleted) {
            $status = 1;
            $this->ExecutePrepared("UPDATE javni_poziv SET zatvoren = ? WHERE id_javni_poziv = ?", "ii", [$status, $callId]);
        }

        // Dodaj prijavi

        global $confFilePath;
        $config = parse_ini_file($confFilePath);
        $virtualDate = date("Y-m-d H:i:s", time() + $config["virtualTimeOffsetSeconds"]);

        $newStatus = 2; // Status "obrađeno"

        $this->ExecutePrepared("UPDATE steta SET id_status_stete = ?, datum_potvrde = ?, subvencija_hrk = ? WHERE id_steta = ?", "isdi", [$newStatus, $virtualDate, $amount, $damageId]);

        if ($isDepleted) {
            $this->logObj->New("$firstQuery; UPDATE javni_poziv SET zatvoren = $status WHERE id_javni_poziv = $callId; UPDATE steta SET id_status_stete = $newStatus, datum_potvrde = $virtualDate, subvencija_hrk = $amount WHERE id_steta = $damageId",
            "Moderator " . $_SESSION["user"]->korisnicko_ime . " potrošio je sva sredstva javnog poziva sa šifrom $callId (bilo preostalo $currentPublicCallFunds) i time ga zatvorio. Zadnja sredstva su pretočena na prijavu štete s oznakom $damageId.", Log::zatvaranje_javnog_poziva);
        } else {
            $this->logObj->New($firstQuery,
            "Moderator " . $_SESSION["user"]->korisnicko_ime . " uplatio je sredstva javnog poziva sa šifrom $callId na prijavu štete s oznakom $damageId.", Log::subvencioniranje);
        }
    }

    public function CloseDamage(int $damageId)
    {
        global $confFilePath;
        $config = parse_ini_file($confFilePath);
        $virtualDate = date("Y-m-d H:i:s", time() + $config["virtualTimeOffsetSeconds"]);

        $newStatus = 3;
        $this->ExecutePrepared("UPDATE steta SET id_status_stete = ?, datum_potvrde = ? WHERE id_steta = ?", "isi", [$newStatus, $virtualDate, $damageId]);

        $this->logObj->New("UPDATE steta SET id_status_stete = $newStatus, datum_potvrde = $virtualDate, WHERE id_steta = $damageId",
        "Moderator " . $_SESSION["user"]->korisnicko_ime . " zatvorio je prijavu štete s oznakom $damageId.", Log::odbijanje_prijave);
    }

    public function GetModerators()
    {
        $moderators = $this->SelectPrepared("SELECT id_korisnik, email, korisnicko_ime FROM WebDiP2020x057.korisnik WHERE id_uloga = 2");
        
        foreach ($moderators as $key => $value) {
            try {
                $categories = $this->SelectPrepared("SELECT mk.id_kategorija_stete, k.naziv FROM WebDiP2020x057.moderator_kategorije as mk INNER JOIN kategorija_stete k WHERE mk.id_kategorija_stete = k.id_kategorija_stete AND mk.id_moderator = ?", "i", [$value["id_korisnik"]]);
                $moderators[$key]["categories"] = $categories;
            } catch (Exception $e) {
                $value["categories"] = null;
            }
        }
        return $moderators;
    }
}
