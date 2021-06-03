<?php

define("server", "localhost");
define("korisnik", "WebDiP2020x057");
define("lozinka", "admin_PNID");
define("baza", "WebDiP2020x057");

define("DBError", -4);
define("DBTermsError", -3);
define("DBUserError", -2);
define("DBPassError", -1);
define("DBSuccess", 0);

class DB
{
    private $mysqli_object = null;
    private $error = '';

    public function __construct()
    {
        $this->mysqli_object = new mysqli(server, korisnik, lozinka, baza);
        error_reporting(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
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
     * @return object|integer Ako je korisnik autenticiran, vraća njegov objekt iz baze, inače vraća cjelobrojnu vrijednost koja ukazuje na pogrešku.
     */
    public function AuthenticateUser(string $username, string $password)
    {
        $prepared = $this->mysqli_object->prepare("SELECT * FROM korisnik WHERE korisnicko_ime = ? AND lozinka_sha256 = ? LIMIT 1");

        $pass_sha256 = hash("sha256", $password);

        if ($prepared->bind_param("ss", $username, $pass_sha256) == false) {
            return DBError;
        }


        if ($prepared->execute() == false) {
            return DBError;
        };

        $result = $prepared->get_result();
        $resultObject = $result->fetch_object();

        // Postoji takav korisnik, jedino mu se moraju poništiti neuspješne prijave ili provjeriti uvjeti.
        if ($resultObject !== null) {
            if ($resultObject->broj_neuspjesnih_prijava !== null) {
                $prepared = $this->mysqli_object->prepare("UPDATE `WebDiP2020x057`.`korisnik` SET `broj_neuspjesnih_prijava` = ? WHERE `id_korisnik` = ?");
                $counterResetValue = null;
                $prepared->bind_param("si", $counterResetValue, $resultObject->id_korisnik);
                $prepared->execute();
            }

            if ($resultObject->uvjeti === null) {
                $resultObject->error = DBTermsError;
                return $resultObject;
            }
        } else { // Ne postoji korisnik s korimenom i lozinkom, treba provjeriti je li zaboravio lozinku.
            $prepared = $this->mysqli_object->prepare("SELECT id_korisnik, broj_neuspjesnih_prijava FROM korisnik WHERE korisnicko_ime = ? LIMIT 1");
            $prepared->bind_param("s", $username);

            $novi_broj_neuspjesnih = 1;

            if ($prepared->execute()) {
                $result = $prepared->get_result();

                if ($result->num_rows === 0) {
                    return DBUserError;
                }

                $resultObject = $result->fetch_object();

                if (isset($resultObject->broj_neuspjesnih_prijava)) {
                    $novi_broj_neuspjesnih = $resultObject->broj_neuspjesnih_prijava + 1;
                }

                $prepared = $this->mysqli_object->prepare("UPDATE `WebDiP2020x057`.`korisnik` SET `broj_neuspjesnih_prijava` = ? WHERE `id_korisnik` = ?");
                $prepared->bind_param("ii", $novi_broj_neuspjesnih, $resultObject->id_korisnik);
                $prepared->execute();

                return DBPassError;
            }
        }

        return $resultObject;
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

        $prepared = $this->mysqli_object->prepare("INSERT INTO `korisnik` (`ime`, `prezime`, `korisnicko_ime`, `email`, `lozinka_citljiva`, `lozinka_sha256`)
        VALUES (?, ?, ?, ?, ?, ?);");

        $prepared->bind_param('ssssss', $newUser["name"], $newUser["surname"], $newUser["username"], $newUser["email"], $newUser["password"], $pass_sha256);

        if ($prepared->execute() == false) {
            echo "<br>" . $this->mysqli_object->error . "<br>";
            return DBError;
        };

        return $prepared->insert_id;
    }

    public function ConfirmUser($id)
    {
        $prepared = $this->mysqli_object->prepare("SELECT `uvjeti`, `email`, `lozinka_citljiva` FROM `korisnik` WHERE `id_korisnik` = ?");

        if (($prepared->bind_param("i", $id)) == false) {
            return DBError;
        }

        if ($prepared->execute() == false) {
            return DBError;
        };

        $result = $prepared->get_result();
        $resultObject = $result->fetch_object();

        if ($resultObject === null) {
            return DBUserError;
        }

        if ($resultObject->uvjeti === null) {
            $prepared = $this->mysqli_object->prepare("UPDATE `WebDiP2020x057`.`korisnik` SET `uvjeti` = ? WHERE (`id_korisnik` = ?)");
            $prepared->bind_param("si", date('Y-m-d H:i:s'), $id);
            $prepared->execute();
            return $resultObject;
        }

        return DBUserError;
    }

    public function GetUserMail($username)
    {
        $prepared = $this->mysqli_object->prepare("SELECT email FROM korisnik WHERE korisnicko_ime = ? LIMIT 1");

        if ($prepared->bind_param("ss", $username, $pass_sha256) == false) {
            return DBError;
        }


        if ($prepared->execute() == false) {
            return DBError;
        };

        $result = $prepared->get_result();

        if ($result->num_rows === null) {
            return DBUserError;
        }

        return $result->fetch_object();
    }

    public function PrepareIdentifierForNewPassword($username, $meshedIdentifier)
    {
        $prepared = $this->mysqli_object->prepare("UPDATE `WebDiP2020x057`.`korisnik` SET `lozinka_citljiva` = ?, `lozinka_sha256` = '_' WHERE (`korisnicko_ime` = ?);");

        if (($prepared->bind_param("ss", $meshedIdentifier, $username)) == false) {
            return DBError;
        }

        if ($prepared->execute() == false) {
            return DBError;
        };

        return DBSuccess;
    }
}
