<?php

define("LVL_ADMINISTRATOR", 1);
define("LVL_MODERATOR", 2);
define("LVL_REGISTRIRANI", 3);
define("LVL_NEREGISTRIRANI", 4);

define("USER_CONTROL_SUCCESS", 0);

class UserControl
{
    static function startSession()
    {
        if (session_id() == "") {
            session_name("UserSession");
            session_start();
        }
        if (!isset($_SESSION["lvl"])) {
            $_SESSION["lvl"] = LVL_NEREGISTRIRANI;
            $_SESSION["user"] = null;
        }
    }

    static function stopSession()
    {
        if (!empty(session_id()) || session_id() != "") {
            session_unset();
            session_destroy();
        }
    }

    static function LogIn($email, $password)
    {
        $dbObj = new DB();
        $dbResponse = $dbObj->AuthenticateUser($email, $password);
        if (!is_integer($dbResponse)) {
            self::stopSession();
            self::startSession();
            $_SESSION["user"] = $dbResponse;
            $_SESSION["lvl"] = $dbResponse->id_uloga;
            return USER_CONTROL_SUCCESS;
        } else {
            return $dbResponse;
        }
    }

    static function RegisterUser($newUser)
    {
        $dbObj = new DB();
        $dbResponse = $dbObj->InsertUser($newUser);
        if ($dbResponse !== DBError) {
            $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";  
            $folderPath = $protocol . $_SERVER['HTTP_HOST'] . dirname($_SERVER["PHP_SELF"]);  
            $fileRoute = $folderPath . "/control/activate.php";
            $linkRoute = $dbResponse;

            $headers  = 'MIME-Version: 1.0' . "\r\n"
                . 'Content-type: text/html; charset=utf-8' . "\r\n"
                . "From: stete@prijava-steta.hr\r\n"
                . 'X-Mailer: PHP/' . phpversion();

            $message =  '
            <html>
            <body>
                <h1 style="color: orange;width: 100%;text-align: center;">Dobrodošli</h1>
                <p style="font-family: sans-serif;font-size: 16px;">Dobrodošli na Stranicu za štete!</p><br>
                <p style="font-family: sans-serif;font-size: 14px;"Pozdravljam Vas ja, Mislav Matijević, dizajner stranice - glavom i bradom. Nadam se da će vam stranica pomoći i</p>
                <br>
                <strong>Pritiskom na link prihvaćate uvjete korištenja stranice koji mogu biti pregledani <a href="https://www.termsfeed.com/blog/sample-terms-and-conditions-template/">ovdje</a>!</strong><br>
                <a href="' . $fileRoute . "?id=" . $linkRoute . '" target="_blank">Pritisnite ovdje i Vaš račun će biti aktiviran.</a>
                <br>
                Niste zatražili aktivaciju? Zanemarite ovu e-poštu!
                <br>
                <br>
                Srdačan pozdrav,<br>
                Mislav Matijević
            </body>
            <div style="margin-top: 50px;background-color: #333333;width: 100%;height: auto;text-align: center;font-style: italic;color: white;">
            Mislav Matijević, Copyright © 2021. 
            </div>
            </html>';

            var_dump($message);

            mail($newUser["email"], "Registracija | Stranice štete", $message, $headers);

            return DBSuccess;
        } else {
            return DBError;
        }
    }
}
