<?php

define("server", "localhost");
define("korisnik", "WebDiP2020x057");
define("lozinka", "admin_PNID");
define("baza", "WebDiP2020x057");

define("DBError", -4);
define("DBTermsError", -3);
define("DBUserError", -2);
define("DBPassError", -1);
define("DBSuccess", 1);

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
    public function CheckUserExists(string $username) {
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
            throw new Exception(`<a style="color: white" href=//register.php">Niste registrirani?</a>`, DBUserError);
        }

        return $dbResult->fetch_object();
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
        if ($userObject->lozinka_sha256 !== hash("sha256", $password)) { // Lozinke se ne poklapaju
            $userObject->broj_neuspjesnih_prijava == null ? $retry_count = 1 : $retry_count = $userObject->broj_neuspjesnih_prijava + 1;

            if (($prepared = $this->mysqli_object->prepare("UPDATE `WebDiP2020x057`.`korisnik` SET `broj_neuspjesnih_prijava` = ? WHERE `id_korisnik` = ? ")) == false) {
                throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
            }

            if ($prepared->bind_param("ii", $retry_count, $userObject->id_korisnik) == false) {
                throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
            }
    
            if ($prepared->execute() == false) {
                throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
            };

            throw new Exception($retry_count, DBPassError);
        }

        // Lozinke se poklapaju
        // Trebaju se poništiti neuspješne prijave i provjeriti uvjeti.
        if ($userObject->broj_neuspjesnih_prijava !== null) {
            if (($prepared = $this->mysqli_object->prepare("UPDATE `WebDiP2020x057`.`korisnik` SET `broj_neuspjesnih_prijava`=NULL WHERE `id_korisnik` = ?")) == false) {
                throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
            }
            $prepared->bind_param("i", $userObject->id_korisnik);
            $prepared->execute();
        }

        if ($userObject->uvjeti === null) {
            throw new Exception("Uvjeti nisu prihvaćeni", DBTermsError);
        }

        return $userObject;
    }

    public function BlockUser($username, $doBlock = true) {

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

    public function BaseGetTable($tableName)
    {
        $query = "TABLE {$tableName}";
        $result = $this->mysqli_object->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function InsertUser($newUser)
    {
        $pass_sha256 = hash("sha256", $newUser["password"]);

        if (($prepared = $this->mysqli_object->prepare("INSERT INTO `korisnik` (`ime`, `prezime`, `korisnicko_ime`, `email`, `lozinka_citljiva`, `lozinka_sha256`) VALUES (?, ?, ?, ?, ?, ?)")) == false) {
            throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
        };

        $prepared->bind_param('ssssss', $newUser["name"], $newUser["surname"], $newUser["username"], $newUser["email"], $newUser["password"], $pass_sha256);

        if ($prepared->execute() == false) {
            throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
        };

        return $prepared->insert_id;
    }

    public function ConfirmUser($id)
    {
        if (($prepared = $this->mysqli_object->prepare("SELECT `uvjeti`, `email`, `lozinka_citljiva` FROM `korisnik` WHERE `id_korisnik` = ?")) == false) {
            throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
        }

        if (($prepared->bind_param("i", $id)) == false) {
            throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
        }

        if ($prepared->execute() == false) {
            throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
        };

        $result = $prepared->get_result();
        $resultObject = $result->fetch_object();

        if ($resultObject === null) {
            throw new Exception("Error", DBUserError);
        }

        if ($resultObject->uvjeti === null) {
            if (($prepared = $this->mysqli_object->prepare("UPDATE `WebDiP2020x057`.`korisnik` SET `uvjeti` = ? WHERE (`id_korisnik` = ?)")) == false) {
                throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
            }
            $prepared->bind_param("si", date('Y-m-d H:i:s'), $id);
            $prepared->execute();
            return $resultObject;
        }

        throw new Exception('Račun već aktiviran. U slučaju pogreške kontaktirajte administratora.', DBPassError);
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
            throw new Exception('<a style="color: white" href="./register.php">Niste registrirani?</a>', DBUserError);
        }

        return $result->fetch_object();
    }

    public function PrepareIdentifierForNewPassword($username, $meshedIdentifier)
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

    public function SetPasswordWithIdentifier($meshedIdentifier, $newPassword)
    {
        if (($prepared = $this->mysqli_object->prepare("UPDATE `WebDiP2020x057`.`korisnik` SET `lozinka_citljiva` = ?, `lozinka_sha256` = ? WHERE `lozinka_citljiva` = ?")) == false) {
            throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
        }

        $pass_sha256 = hash("sha256", $newPassword);

        if (($prepared->bind_param("sss", $newPassword, $pass_sha256, $meshedIdentifier)) == false) {
            throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
        }

        if ($prepared->execute() == false) {
            throw new Exception("Problem s bazom podataka (" . __LINE__ . ")", DBError);
        };

        return DBSuccess;
    }
}
