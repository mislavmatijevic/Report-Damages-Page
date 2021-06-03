<?php

define("LVL_ADMINISTRATOR", 1);
define("LVL_MODERATOR", 2);
define("LVL_REGISTRIRANI", 3);
define("LVL_NEREGISTRIRANI", 4);

define("USER_CONTROL_SUCCESS", 1);
define("USER_CONTROL_NEWPASSWORD", -1);

define("MAIL_WELCOME", 1);
define("MAIL_TERMS", 2);
define("MAIL_PASSWORD", 3);

class UserControl
{
    public static function startSession()
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

    public static function stopSession()
    {
        if (session_id() != "") {
            session_unset();
            session_destroy();
        }
    }



    public static function LogIn($username, $password)
    {
        $dbObj = new DB();
        $dbResponse = $dbObj->AuthenticateUser($username, $password);

        if ($dbResponse == DBError) {
            return DBError;
        }

        if (isset($dbResponse->error)) {
            if ($dbResponse->error === DBTermsError) {
                self::sendUserMail(MAIL_TERMS, $dbResponse->email, $dbResponse->id_korisnik, $dbResponse->korisnicko_ime);
                return DBTermsError;
            } else {
                $configuration = parse_ini_file('../config/manage.conf');
                if ($dbResponse->error >= $configuration["maxFailedLogins"]) {
                    self::SendNewPassword($dbResponse->korisnicko_ime, $dbResponse->email);
                    return USER_CONTROL_NEWPASSWORD;
                }
            }
        } else {
            self::stopSession();
            self::startSession();
            $_SESSION["user"] = $dbResponse;
            $_SESSION["lvl"] = $dbResponse->id_uloga;
            return USER_CONTROL_SUCCESS;
        }
    }

    public static function RegisterUser($newUser)
    {
        $dbObj = new DB();
        $dbResponse = $dbObj->InsertUser($newUser);
        if ($dbResponse !== DBError) {
            $newUserId = $dbResponse;
            self::sendUserMail(MAIL_WELCOME, $newUser["email"], $newUserId, $newUser["username"]);
            return DBSuccess;
        } else {
            return DBError;
        }
    }

    public static function CheckCaptcha($captcha_response){
        
        if (!isset($captcha_response)) {
            return false;
        }
        
        $secretKey = "6Lf1IQwbAAAAAPoDQR_It0X1h9MTvdnNTOOTqUC8";
        
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha_response);
        $response = file_get_contents($url);
        $responseKeys = json_decode($response, true);

        return $responseKeys["success"] ? true : false;
    }

    private static function SendNewPassword($username, $email = null)
    {
        $identifier = bin2hex(random_bytes(25));

        $dbObj = new DB();

        if ($email === null) {
            $dbResponse = $dbObj->GetUserMail($username);

            // If DB error returned.
            if (is_integer($dbResponse)) {
                return $dbResponse;
            }
            $email = $dbResponse;
        }
        
        $dbResponse = $dbObj->PrepareIdentifierForNewPassword($username, $identifier);

        switch ($dbResponse) {
            case DBSuccess:
                sendUserMail(MAIL_PASSWORD, $email, -1, $identifier);
                return USER_CONTROL_SUCCESS;
                
            case DBError:
                return DBError;
        }
    }

    private static function sendUserMail($type, $emailReceiver, $contentNumeric = -1, $contentString = '')
    {
        $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $folderPath = $protocol . $_SERVER['HTTP_HOST'] . dirname($_SERVER["PHP_SELF"]);
        $linkRoute = $contentNumeric;

        $headers  = 'MIME-Version: 1.0' . "\r\n"
            . 'Content-type: text/html; charset=utf-8' . "\r\n"
            . "From: stete@prijava-steta.hr\r\n"
            . 'X-Mailer: PHP/' . phpversion();

        $mailTitle = '';

        $message =  '
        <html>
            <head>
                <meta charset="UTF-8">
            </head>
            <body>';

        switch ($type) {
            case MAIL_WELCOME: {
                $mailTitle = 'Registracija';
                $message .=  '
                <h1 style="color: orange;width: 100%;text-align: center;">Dobrodošao '.$contentString.'!</h1>
                <br><br>

                <p style="font-family: sans-serif;font-size: 16px;">
                Dobrodošli na Stranicu za štete!
                </p>
                <br>

                <p style="font-family: sans-serif;font-size: 16px;">

                Ja sam Mislav Matijević i dizajnirao sam stranicu.
                Nadam se da će Vam stranica pomoći i donijeti malo radosti u tragičnu situaciju, te da ćemo zajedno sve riješiti.
                Od prikupljanja donacija i pomaganja drugim žrtvama nesreća dijeli Vas samo još jedan korak.

                </p>
                <br>';
                break;
            }
            case MAIL_TERMS: {
                $mailTitle = 'Uvjeti korištenja';
                $message .=  '
                <h1 style="color: orange;width: 100%;text-align: center;">Uvjeti korištenja</h1>

                <p style="font-family: sans-serif;font-size: 16px;">
                Pozdrav, '.$contentString.'!
                </p>
                <br>

                <p style="font-family: sans-serif;font-size: 16px;">
                <strong>
                Zašto dobivam ovaj mail?
                </strong>
                Potrebna je Vaša potvrda uvjeta korištenja stranice za prijave šteta.

                <br>Jednostavno pritisnite na link u nastavku.</p>
                <br>';
                break;
            }
            case MAIL_PASSWORD: {
                $fileRoute = $folderPath . "/control/changePass.php";
                $mailTitle = 'Nova lozinka';
                $message .=  '
                <h1 style="color: orange;width: 100%;text-align: center;">Uvjeti korištenja</h1>

                <p style="font-family: sans-serif;font-size: 16px;">Pozdrav, ovaj mail dobivate jer vam je bila potrebna nova lozinka na stranici za prijavu šteta.</p>
                <p style="font-family: sans-serif;font-size: 16px;">
                    <strong>
                    Preporuka je poduzeti nužne radnje na linku ispod što prije!
                    </strong>
                </p>
                <p style="font-family: sans-serif;font-size: 16px;">Upute u ovome mailu pomoći će Vam da obnovite lozinku.
                </p>
                <br>

                <p style="font-family: sans-serif;font-size: 16px;">
                    <a href="' . $fileRoute . "?id=" . $contentString . '" target="_blank">
                    Pritisnite ovdje za stvaranje nove lozinke.
                    </a>
                </p>

                <p style="font-family: sans-serif;font-size: 16px;">
                Poveznica će Vas dovesti na stranicu web mjesta "Prijave šteta" na kojoj ćete imati priliku putem jednostavne forme obnoviti svoju lozinku.
                </p>
                <p style="font-family: sans-serif;font-size: 16px;">
                Javite se administratoru u slučaju bilo kakvih pitanja ili problema.
                </p>
                <br>';
                break;
            }
            default: die("Neispravno postavljeno slanje mailova!");
        }

        if ($type === MAIL_WELCOME || $type === MAIL_TERMS) {
            $fileRoute = $folderPath . "/control/activate.php";

            $message .=  '
            <p style="font-family: sans-serif;font-size: 16px;">
                <strong>
                Pritiskom na link prihvaćate uvjete korištenja stranice koji mogu biti pregledani <a href="https://www.termsfeed.com/blog/sample-terms-and-conditions-template/">ovdje</a>!
                </strong>
            </p>
            <p style="font-family: sans-serif;font-size: 16px;">
                <a href="' . $fileRoute . "?id=" . $linkRoute . '" target="_blank">
                Pritisnite ovdje za prihvaćanje uvjeta korištenja.
                </a>
            </p>
            <p style="font-family: sans-serif;font-size: 16px;">
            Stranicu ne možete koristiti kao registrirani korisnik bez pritiska na ovaj link.
            </p>

            <br> <br>

            <p style="font-family: sans-serif;font-size: 16px;">
            Srdačan pozdrav,
            </p>
            <p style="font-family: sans-serif;font-size: 16px;">
            Mislav Matijević, tvorac stranice
            </p>
            <br>
            <br>';
        }

        $message .= '
        <       /body>
            <div style="margin-top: 50px;background-color: #333333;width: 100%;height: auto;text-align: center;font-style: italic;color: white;">
            Mislav Matijević, Copyright © 2021. 
            </div>
        </html>';

        mail($emailReceiver, $mailTitle .  " | Stranice štete", $message, $headers);
    }
}
