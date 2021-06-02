<?php

define("server", "localhost");
define("korisnik", "WebDiP2020x057");
define("lozinka", "admin_PNID");
define("baza", "WebDiP2020x057");

define("DBError", -3);
define("UserError", -2);
define("PassError", -1);

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
    public function AuthenticateUser(string $email, string $password)
    {

        $prepared = $this->mysqli_object->prepare("SELECT * FROM korisnik WHERE email = ? AND lozinka_sha256 = ? LIMIT 1");

        $pass_sha256 = hash("sha256", $password);

        if (!($prepared->bind_param("ss", $email, $pass_sha256))) {
            return -3;
        }


        if ($prepared->execute() == false) {
            return -3;
        };

        $result = $prepared->get_result();
        $resultObject = $result->fetch_object();

        if ($result->num_rows === 0) {
            $prepared = $this->mysqli_object->prepare("SELECT id_korisnik, broj_neuspjesnih_prijava FROM korisnik WHERE email = ? LIMIT 1");
            $prepared->bind_param("s", $email);

            $novi_broj_neuspjesnih = 1;

            if ($prepared->execute()) {

                $result = $prepared->get_result();

                if ($result->num_rows === 0) {
                    return -2;
                }

                $resultObject = $result->fetch_object();

                if (isset($resultObject->broj_neuspjesnih_prijava)) {
                    $novi_broj_neuspjesnih = $resultObject->broj_neuspjesnih_prijava + 1;
                }

                $prepared = $this->mysqli_object->prepare("UPDATE `WebDiP2020x057`.`korisnik` SET `broj_neuspjesnih_prijava` = ? WHERE `id_korisnik` = ?");
                $prepared->bind_param("ii", $novi_broj_neuspjesnih, $resultObject->id_korisnik);
                $prepared->execute();

                return -1;
            }

            $result = $prepared->get_result();
        } else {
            $prepared = $this->mysqli_object->prepare("UPDATE `WebDiP2020x057`.`korisnik` SET `broj_neuspjesnih_prijava` = ? WHERE `id_korisnik` = ?");
            $counterResetValue = NULL;
            $prepared->bind_param("si", $counterResetValue, $resultObject->id_korisnik);
            $prepared->execute();
        }

        return $resultObject;
    }
}
