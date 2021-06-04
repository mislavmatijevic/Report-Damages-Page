<?php

define("LVL_ADMINISTRATOR", 1);
define("LVL_MODERATOR", 2);
define("LVL_REGISTRIRANI", 3);
define("LVL_NEREGISTRIRANI", 4);

define("USER_CONTROL_ERROR", -4);
define("USER_CONTROL_BLOCK", -3);
define("USER_CONTROL_MAIL_ERROR", -2);
define("USER_CONTROL_NEWPASSWORD", -1);
define("USER_CONTROL_SUCCESS", 1);


class UserControl
{
    private const MAIL_WELCOME = 1;
    private const MAIL_TERMS = 2;
    private const MAIL_PASSWORD = 3;
    private const MAIL_BLOCK = 4;

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

        $fullUser = null;
        try {
            $fullUser = $dbObj->AuthenticateUser($username, $password);
        } catch (Exception $e) {
            switch ($e->getCode()) {
                case DBTermsError: {
                    $user = $dbObj->GetUserData($username);
                    
                    self::sendUserMail(self::MAIL_TERMS, $user->email, $user->id_korisnik, $username);
                    throw new Exception("Dobili ste poštu na " . substr($user->email, 0, 3) . "..." . substr($user->email, strpos($user->email, '@'), 10));
                }
                case DBPassError: {
                    $user = $dbObj->GetUserData($username);
                    $configuration = parse_ini_file('./config/manage.conf');

                    // U ovom slučaju poruka iznimke je novi broj neuspjelih prijava.           // Ne želimo blokirati administratora.
                    if ($e->getMessage() >= $configuration["maxFailedLogins"] && $user->id_uloga !== LVL_ADMINISTRATOR) {
                        $dbObj->BlockUser($username);
                        self::sendUserMail(self::MAIL_BLOCK, $user->email, settype($e->getMessage(), "integer"));
                        throw new Exception($configuration["maxFailedLogins"]." neuspjelih prijava za redom, račun je blokiran. ", USER_CONTROL_BLOCK);
                    } else {
                        throw new Exception('<a style="color: white" href='."./control/forgottenPass.php?username=$username".'>Zaboravljena lozinka?</a>');
                    }
                }
                default: {
                    throw new Exception($e->getMessage(), $e->getCode());
                }
            }
        }

        if (isset($fullUser)) {
            self::stopSession();
            self::startSession();
            $_SESSION["user"] = $fullUser;
            $_SESSION["lvl"] = $fullUser->id_uloga;
            
            return USER_CONTROL_SUCCESS;
        } else {
            throw new Exception("Korisnik nije pronađen", USER_CONTROL_ERROR);
        }
    }

    public static function RegisterUser($newUser)
    {
        $dbObj = new DB();

        try {
            $usernameExists = true;
            $dbObj->GetUserData($newUser["username"]);
        } catch (Exception $e) { // Želimo iznimku jer to znači da korisnik ne postoji!
            if ($e->getCode() === DBUserError) {
                $usernameExists = false;
            } else {
                throw new Exception($e->getMessage(), $e->getCode());
            }
        } finally {
            if ($usernameExists) {
                throw new Exception("Korisničko ime zauzeto");
            }
        }

        
        $newUserId = $dbObj->InsertUser($newUser);
        self::sendUserMail(self::MAIL_WELCOME, $newUser["email"], $newUserId, $newUser["username"]);

        return USER_CONTROL_SUCCESS;
    }

    public static function CheckCaptcha($captcha_response)
    {
        global $relativePath;

        if (empty($captcha_response)) {
            throw new Exception("ReCaptcha nije ispunjena!");
        }
        
        $config = parse_ini_file($relativePath . "config/manage.conf");
        $secretKey = $config["captchaSecretKey"];
        
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha_response);
        $response = file_get_contents($url);
        $responseKeys = json_decode($response, true);

        if ($responseKeys["success"] == false) {
            throw new Exception("Ponovno popunite ReCaptcha obrazac!");
        };

        return USER_CONTROL_SUCCESS;
    }

    public static function SendNewPassword($username, $email = null)
    {
        $identifier = bin2hex(random_bytes(25));

        $dbObj = new DB();

        if ($email === null) {
            $email = $dbObj->GetUserData($username)->email;
        }

        // Prvo se šalje mail tako da u slučaju zapinjanja ne prebriše lozinku.
        self::sendUserMail(self::MAIL_PASSWORD, $email, -1, $identifier);

        $dbObj->PrepareIdentifierForNewPassword($username, $identifier);

        return $email;
    }

    public static function SetNewPassword($identifier, $newPassword) {

        $dbObj = new DB();
        $dbObj->SetPasswordWithIdentifier($identifier, $newPassword);
        return USER_CONTROL_SUCCESS;
    }

    private static function sendUserMail(int $type, string $emailReceiver, int $contentNumeric = -1, string $contentString = '')
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
            case self::MAIL_WELCOME: {
                $mailTitle = 'Registracija';
                $message .=  '
                <h1 style="color: orange;width: 100%;text-align: center;">
                Dobrodošao '.$contentString.'!
                </h1>
                <br><br>

                <p style="font-family: sans-serif;font-size: 16px;">
                Dobrodošli na Stranicu za štete!
                </p>
                <br>

                <p style="font-family: sans-serif;font-size: 16px;">

                Ja sam Mislav Matijević i dizajnirao sam stranicu za prijavu šteta.
                Nadam se da će Vam stranica pomoći i donijeti malo radosti u tragičnu situaciju, te da ćemo zajedno sve riješiti.
                Od prikupljanja donacija i pomaganja drugim žrtvama nesreća dijeli Vas samo još jedan korak.

                </p>
                <br>';
                break;
            }
            case self::MAIL_TERMS: {
                $mailTitle = 'Uvjeti korištenja';
                $message .=  '
                <h1 style="color: orange;width: 100%;text-align: center;">
                Uvjeti korištenja
                </h1>

                <p style="font-family: sans-serif;font-size: 16px;">
                Pozdrav,<br>'.$contentString.'!
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
            case self::MAIL_PASSWORD: {
                /* Ovdje ne ide "/control/changePass.php" jer se iz "control" foldera već poziva!!! */
                $fileRoute = $folderPath . "/changePass.php";
                $mailTitle = 'Nova lozinka';
                $message .=  '
                <h1 style="color: orange;width: 100%;text-align: center;">
                Nova lozinka
                </h1>

                <p style="font-family: sans-serif;font-size: 16px;">
                Pozdrav,<br>ovaj mail dobivate jer Vam je bila potrebna nova lozinka na stranici za prijavu šteta.
                </p>
                <p style="font-family: sans-serif;font-size: 16px;">
                    <strong>
                    Preporuka je poduzeti nužne radnje na linku ispod što prije!
                    </strong>
                </p>
                <br>

                <p style="font-family: sans-serif;font-size: 16px;">
                    <a href="' . $fileRoute . "?identifier=" . $contentString . '" target="_blank">
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
            case self::MAIL_BLOCK: {
                $mailTitle = 'Račun blokiran';
                $message .=  '
                <h1 style="color: red;width: 100%;text-align: center;">
                Račun blokiran
                </h1>

                <p style="font-family: sans-serif;font-size: 16px;">
                Pozdrav,<br>ovaj mail dobivate jer je zabilježeno ' .$contentNumeric.' neuspjelih pokušaja prijave za redom.
                </p>

                <p style="font-family: sans-serif;font-size: 16px;">
                Kako bi se izbjeglo provaljivanje Vašeg računa, on je privremeno blokiran. To znači da mu nitko ne može pristupiti.
                </p>

                <p style="font-family: sans-serif;font-size: 16px;">
                    <strong>
                    Molimo da se javite administratoru kako biste opet mogli koristiti svoj račun.
                    </strong>
                </p>

                <p style="font-family: sans-serif;font-size: 16px;">
                Isprike na neugodnostima,<br>
                </p>
                <p style="font-family: sans-serif;font-size: 16px;">
                Mislav Matijević, tvorac stranice
                </p>

                <br>';
                break;
            }
            default: throw new Exception("Neispravno postavljeno slanje mailova!", USER_CONTROL_MAIL_ERROR);
        }

        if ($type === self::MAIL_WELCOME || $type === self::MAIL_TERMS) {
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
        </body>
            <div style="margin-top: 50px;background-color: #333333;width: 100%;height: auto;text-align: center;font-style: italic;color: white;">
            Mislav Matijević, Copyright © 2021. 
            </div>
        </html>';

        if (mail($emailReceiver, $mailTitle .  " | Stranice štete", $message, $headers) === false) {
            throw new Exception("Mail nije mogao biti poslan!", USER_CONTROL_MAIL_ERROR);
        };
        
        return USER_CONTROL_SUCCESS;
    }
}
