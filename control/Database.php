<?php

require_once dirname(__DIR__)."/control/constants.php";

define("server", "localhost");
define("korisnik", "WebDiP2020x057");
define("lozinka", "admin_PNID");
define("baza", "WebDiP2020x057");

define("DBError", -4);
define("DBActivationError", -3);
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
    public const novi_status_javnog_poziva = 11;
    public const prijava_štete = 12;
    public const neuspješna_prijava = 13;
    public const zaključavanje_računa = 14;
    public const zahtjev_nove_lozinke = 15;
    public const promjena_lozinke = 16;
    public const promjena_podataka_korisnika = 17;
    public const poslan_mail_za_blokiranje = 18;
    public const poslan_mail_za_lozinku = 19;
    public const poslan_mail_za_registraciju = 20;
    
    // Tipovi radnji

    private $dbObjLog;
    public function __construct($activeDbObj)
    {
        $this->dbObjLog = $activeDbObj;
    }

    public function LogActivity($query, $description, $activity, $id_user)
    {
        global $fullScriptName;
        
        if (($prepared = $this->dbObjLog->mysqli_object->prepare("INSERT INTO dnevnik (`url`, `datum_vrijeme`, `upit`, `opis_radnje`, `id_radnja`, `id_izvrsitelj`) VALUES (?, ?, ?, ?, ?, ?)")) == false) {
            throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
        }

        if (($prepared->bind_param("ssssii", $fullScriptName, date('Y-m-d H:i:s'), $query, $description, $activity, $id_user)) == false) {
            throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
        }

        if ($prepared->execute() == false) {
            throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
        };
    }

    /**
     * @param string $criteria prazno (sve) / user / frequency
     * @param string $arguments id_korisnika / id_radnje
     */
    public function GetLogs(string $criteria = "", string $argument = "")
    {
        switch ($criteria) {
            case '':
                if (($prepared = $this->dbObjLog->mysqli_object->prepare("TABLE dnevnik")) == false) {
                    throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
                }
                break;
            case 'user':
                if (($prepared = $this->dbObjLog->mysqli_object->prepare("SELECT * dnevnik WHERE id_izvrsitelj = ?")) == false) {
                    throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
                }
                if (($prepared->bind_param("i", $argument)) == false) {
                    throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
                }
                break;
            case 'frequency':
                if (($prepared = $this->dbObjLog->mysqli_object->prepare("")) == false) {
                    throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
                }
                if (($prepared->bind_param("i", $argument)) == false) {
                    throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
                }
                break;
            default: {
                throw new Exception("Nepoznat kriterij \"$criteria\" za dohvat logova iz baze!", 1);
            }
        }

        if ($prepared->execute() == false) {
            throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
        };
        $allLogs = $prepared->get_result();
        
        if ($allLogs->num_rows == 0) {
            throw new Exception("Takvi podaci nisu pronađeni!", DBError);
        }

        return Prevent::XSS($allLogs->fetch_all(MYSQLI_ASSOC));
    }
};

class DB
{
    private $mysqli_object = null;
    private $error = '';

    public function __construct()
    {
        $this->mysqli_object = new mysqli(server, korisnik, lozinka, baza);
        mysqli_report(MYSQLI_REPORT_ERROR);
        if ($this->mysqli_object->connect_errno) {
            $this->error .=  "Neuspješno spajanje na bazu: " . $this->mysqli_object->connect_errno . ", " . $this->mysqli_object->connect_error;
            $this->error .= $this->mysqli_object->connect_error;
        }
        $this->mysqli_object->set_charset("utf8");
        if ($this->mysqli_object->connect_errno) {
            $this->error .=  "Neuspješno postavljanje znakova za bazu: " . $this->mysqli_object->connect_errno . ", " . $this->mysqli_object->connect_error;
            $this->error .= $this->mysqli_object->connect_error;
        }
    }

    public function __destruct()
    {
        $this->mysqli_object->close();
    }

    /**
     * @return boolean|object Ako korisnik postoji, vraća njegov objekt iz baze, inače baca iznimku.
     */
    public function CheckUserExists(string $username)
    {
        if (($prepared = $this->mysqli_object->prepare("SELECT * FROM korisnik WHERE korisnicko_ime = ? LIMIT 1")) == false) {
            throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
        }

        if ($prepared->bind_param("s", $username) == false) {
            throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
        }

        if ($prepared->execute() == false) {
            throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
        };

        $dbResult = $prepared->get_result();

        if ($dbResult->num_rows == 0) { // Korisnik ne postoji:
            throw new Exception('<a href=//register.php">Niste registrirani?</a>', DBUserError);
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

            if (($prepared = $this->mysqli_object->prepare("UPDATE `WebDiP2020x057`.`korisnik` SET `broj_neuspjesnih_prijava` = ? WHERE `id_korisnik` = ? ")) == false) {
                throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
            }

            if ($prepared->bind_param("ii", $retry_count, $userObject->id_korisnik) == false) {
                throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
            }

            if ($prepared->execute() == false) {
                throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
            };

            throw new Exception("$retry_count", DBPassError);
        }

        // Lozinke se poklapaju
        // Trebaju se poništiti neuspješne prijave i provjeriti je li račun aktiviran.
        if ($userObject->broj_neuspjesnih_prijava !== null) {
            if (($prepared = $this->mysqli_object->prepare("UPDATE `WebDiP2020x057`.`korisnik` SET `broj_neuspjesnih_prijava`=NULL WHERE `id_korisnik` = ?")) == false) {
                throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
            }
            $prepared->bind_param("i", $userObject->id_korisnik);
            $prepared->execute();
        }

        if ($userObject->datum_aktivacije === null) {
            throw new Exception("Račun nije aktiviran", DBActivationError);
        }

        return Prevent::XSS($userObject);
    }

    public function BlockUser($username, $doBlock = true)
    {
        if (($prepared = $this->mysqli_object->prepare("UPDATE `WebDiP2020x057`.`korisnik` SET `status_blokade` = ?, `broj_neuspjesnih_prijava`=NULL WHERE korisnicko_ime = ?")) == false) {
            throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
        }

        $newBlockStatus = $doBlock ? 1 : null;

        if ($prepared->bind_param("is", $newBlockStatus, $username) == false) {
            throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
        }

        if ($prepared->execute() == false) {
            throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
        };

        return DBSuccess;
    }

    public function GetSelect(string $query)
    {
        if (($result = $this->mysqli_object->query($query)) == false) {
            throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
        }

        return Prevent::XSS($result->fetch_all(MYSQLI_ASSOC));
    }

    public function GetPrepared(string $preparedQuery, string $argumentsString, array $argumentsArray)
    {
        if (($prepared = $this->mysqli_object->prepare($preparedQuery)) == false) {
            throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
        }

        if (($prepared->bind_param($argumentsString, ...$argumentsArray)) == false) {
            throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
        }

        if ($prepared->execute() == false) {
            throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
        };

        $userResult = $prepared->get_result();

        // Uopće ne postoji takav korisnik (ili je izbrisan, ili je promijenio lozinku).
        if ($userResult->num_rows == 0) {
            throw new Exception("Neuspio dohvat iz baze!", DBError);
        }

        return Prevent::XSS($userResult->fetch_all(MYSQLI_ASSOC));
    }

    /**
     * @return string Ako je korisnik uspješno ubačen, vraća njegovu lozinku u "sha256" obliku pomoću koje se korisnik aktivira preko maila.
     */
    public function InsertUser($newUser, $salt)
    {
        $pass_sha256 = hash("sha256", $salt . $newUser["password"]);

        if (($prepared = $this->mysqli_object->prepare("INSERT INTO `korisnik` (`ime`, `prezime`, `korisnicko_ime`, `email`, `lozinka_citljiva`, `lozinka_sha256`, `datum_registracije`) VALUES (?, ?, ?, ?, ?, ? ?)")) == false) {
            throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
        };

        $prepared->bind_param('sssssss', $newUser["name"], $newUser["surname"], $newUser["username"], $newUser["email"], $newUser["password"], $pass_sha256, date('Y-m-d H:i:s'));

        if ($prepared->execute() == false) {
            throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
        };

        return $pass_sha256;
    }

    /**
     * @return user Ako je korisniku uspješno zabilježena aktivacija, vraća cijeli njegov objekt iz baze.
     */
    public function ConfirmUser(string $sha256password, string $username, int $maxHoursToAccept)
    {
        if (($prepared = $this->mysqli_object->prepare("SELECT * FROM `korisnik` WHERE `lozinka_sha256` = ? AND `korisnicko_ime` = ?")) == false) {
            throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
        }

        if (($prepared->bind_param("ss", $sha256password, $username)) == false) {
            throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
        }

        if ($prepared->execute() == false) {
            throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
        };

        $userResult = $prepared->get_result();

        // Uopće ne postoji takav korisnik (ili je izbrisan, ili je promijenio lozinku).
        if ($userResult->num_rows == 0) {
            throw new Exception("Ovaj je link nevažeći", DBUserError);
        }

        $userObject = Prevent::XSS($userResult->fetch_object());

        // Ako je aktiviran prihvaćeni:
        if ($userObject->datum_aktivacije != null) {
            throw new Exception('Račun već aktiviran. U slučaju pogreške kontaktirajte administratora.', DBPassError);
        } else {
            // Ako nije aktiviran, a prošlo je više sati nego što je trebalo.
            /*
                date()
            */
            if ((time() - strtotime($userObject->datum_registracije)) / 60 / 60 > $maxHoursToAccept) {
                // Izbriši nevažećeg korisnika.
                if (($prepared = $this->mysqli_object->prepare("DELETE FROM `WebDiP2020x057`.`korisnik` WHERE `korisnicko_ime` = ?")) == false) {
                    throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
                }
                if (($prepared->bind_param("s", $username)) == false) {
                    throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
                }
                if ($prepared->execute() == false) {
                    throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
                };
                throw new Exception("Rok za aktivaciju je istekao ({$maxHoursToAccept}h).<br>Možete otvoriti novi račun s istim korisničkim imenom.", DBError);
            }

            // Sve ok, označi da je korisnik aktiviran.
            if (($prepared = $this->mysqli_object->prepare("UPDATE `WebDiP2020x057`.`korisnik` SET `datum_aktivacije` = ? WHERE (`id_korisnik` = ?)")) == false) {
                throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
            }

            if (($prepared->bind_param("si", date('Y-m-d H:i:s'), $userObject->id_korisnik)) == false) {
                throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
            }

            if ($prepared->execute() == false) {
                throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
            };
        }

        return Prevent::XSS($userObject);
    }


    public function GetUserData($username)
    {
        if (($prepared = $this->mysqli_object->prepare("SELECT id_korisnik, email, id_uloga FROM korisnik WHERE korisnicko_ime = ? LIMIT 1")) == false) {
            throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
        }

        if ($prepared->bind_param("s", $username) == false) {
            throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
        }

        if ($prepared->execute() == false) {
            throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
        };

        $result = $prepared->get_result();

        if ($result->num_rows === 0) {
            throw new Exception('<a href="./register.php">Niste registrirani?</a>', DBUserError);
        }

        return Prevent::XSS($result->fetch_object());
    }

    public function PrepareIdentifierForNewPassword(string $username, string $meshedIdentifier)
    {
        if (($prepared = $this->mysqli_object->prepare("UPDATE `WebDiP2020x057`.`korisnik` SET `lozinka_citljiva` = ? WHERE `korisnicko_ime` = ?")) == false) {
            throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
        }

        if (($prepared->bind_param("ss", $meshedIdentifier, $username)) == false) {
            throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
        }

        if ($prepared->execute() == false) {
            throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
        };

        return DBSuccess;
    }

    /**
     * Postavlja novu lozinku tamo gdje je čitljiva lozinka set od 50 pseudoslučajnih znakova.
     * @param string $meshedIdentifier 50 pseudoslučajnih znakova, osiguravaju privatnost.
     * @param string $newPassword Nova šifra u čitljivom obliku.
     * @return string Ako je sve prošlo u redu, vraća šifru DBSuccess.
     */
    public function SetPasswordWithIdentifier(string $meshedIdentifier, string $newPassword, string $salt)
    {
        if (($prepared = $this->mysqli_object->prepare("UPDATE `WebDiP2020x057`.`korisnik` SET `lozinka_citljiva` = ?, `sol` = ?, `lozinka_sha256` = ?, `broj_neuspjesnih_prijava` = NULL  WHERE `lozinka_citljiva` = ?")) == false) {
            throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
        }

        $pass_sha256 = hash("sha256", $salt . $newPassword);

        if (($prepared->bind_param("ssss", $newPassword, $salt, $pass_sha256, $meshedIdentifier)) == false) {
            throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
        }

        if ($prepared->execute() == false) {
            throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
        };

        if ($prepared->affected_rows === 0) {
            throw new Exception("Link je istekao.", DBPassError);
        };

        return DBSuccess;
    }

    public function MakeDonation($idJavniPoziv, $amount, $user)
    {
        if (($prepared = $this->mysqli_object->prepare("UPDATE javni_poziv SET skupljeno_sredstava = ? WHERE id_javni_poziv = ?")) == false) {
            throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
        }

        if (($prepared->bind_param("id", $idJavniPoziv, $amount)) == false) {
            throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
        }

        if ($prepared->execute() == false) {
            throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
        };

        if (isset($user)) { // Registrirani korisnik
            // TO-DO upiši u dnevnik i u tablicu "donacije" da je donirao
        }
    }
}
