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

require_once dirname(__DIR__)."/control/Database.php";

class UserControl
{
    private const MAIL_WELCOME = 1;
    private const MAIL_PASSWORD = 2;
    private const MAIL_BLOCK = 3;
    private const MAIL_FILE_MISSING = 4;

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
        global $confFilePath;

        $fullUser = null;
        $configuration = parse_ini_file($confFilePath);

        $dbObj = new DB();

        try {
            $fullUser = $dbObj->AuthenticateUser($username, $password);
        } catch (Exception $e) {
            switch ($e->getCode()) {
                case DBLogicError: {
                    $user = $dbObj->GetUserData($username);
                    throw new Exception("Molimo aktivirajte račun!<br>Dobili ste mail na " . substr($user->email, 0, 3) . "..." . substr($user->email, strpos($user->email, '@'), 10));
                }
                case DBPassError: {
                    $user = $dbObj->GetUserData($username);

                    // U ovom slučaju poruka iznimke je novi broj neuspjelih prijava.           // Ne želimo blokirati administratora.
                    if ($e->getMessage() >= $configuration["maxFailedLogins"] && $user->id_uloga !== LVL_ADMINISTRATOR) {
                        $dbObj->BlockUser($username);
                        self::sendUserMail(self::MAIL_BLOCK, $user->email, $e->getMessage(), $username);
                        throw new Exception($configuration["maxFailedLogins"]." neuspjelih prijava za redom, račun je blokiran. ", USER_CONTROL_BLOCK);
                    } else {
                        throw new Exception('<a class="warning-exception" href='."./control/forgotten-pass.php?username=$username".'>Zaboravljena lozinka?</a>');
                    }
                }
                default: {
                    throw new Exception($e->getMessage(), $e->getCode());
                }
            }
        }

        self::stopSession();

        $maxSessionDurationSeconds = $configuration["maxSessionLengthMinutes"]*60;

        self::startSession();
        setcookie(session_name(),session_id(),time()+$maxSessionDurationSeconds);
        
        $_SESSION["user"] = $fullUser;
        $_SESSION["lvl"] = $fullUser->id_uloga;
        
        return USER_CONTROL_SUCCESS;
    }

    /**
     * Activates user with their sha256 hash derived from password.
     * @param string $activateId SHA256 from password, got in mail link as GET parameter for activation.
     * @param string $activateId SHA256 from password, got in mail link as GET parameter for activation.
     */
    public static function ConfirmUserAndLogin(string $activateId, string $username)
    {
        global $confFilePath;
        $config = parse_ini_file($confFilePath);
        $maxHoursToAccept = $config["maxHoursToAccept"];
        $dbObj = new DB();
        $newlyActivatedUser = $dbObj->ConfirmUser($activateId, $username, $maxHoursToAccept);
        self::LogIn($newlyActivatedUser->korisnicko_ime, $newlyActivatedUser->lozinka_citljiva);
    }

    public static function RegisterUser($newUser)
    {
        $dbObj = new DB();

        $usernameExists = true;

        try {
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
        
        $hash = $dbObj->InsertUser($newUser, bin2hex(random_bytes(25)));
        self::sendUserMail(self::MAIL_WELCOME, $newUser["email"], $hash, $newUser["username"]);

        return USER_CONTROL_SUCCESS;
    }

    public static function CheckCaptcha($captcha_response)
    {
        global $confFilePath;
        if (empty($captcha_response)) {
            throw new Exception("Označice kvačicu<br>\"I'm not a robot\"!");
        }
        
        $config = parse_ini_file($confFilePath);
        $secretKey = $config["captchaSecretKey"];
        
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha_response);
        $response = file_get_contents($url);
        $responseKeys = json_decode($response, true);

        if ($responseKeys["success"] == false) {
            throw new Exception("Ponovno riješite ReCaptcha test!");
        };

        return USER_CONTROL_SUCCESS;
    }

    public static function SendMailAboutNewPassword($username, $email = null)
    {
        $identifier = bin2hex(random_bytes(25));

        $dbObj = new DB();

        if ($email === null) {
            $email = $dbObj->GetUserData($username)->email;
        }

        // Prvo se šalje mail tako da u slučaju zapinjanja ne prebriše lozinku.
        self::sendUserMail(self::MAIL_PASSWORD, $email, $identifier, $username);

        $dbObj->PrepareIdentifierForNewPassword($username, $identifier);

        return $email;
    }

    public static function SendMailAboutMissingDamageFiles($username, $damageName, $damageDateReported, $email, $missingFilename)
    {
        $message = `
        <p><strong>
        Molimo ponovno priložite datoteku $missingFilename za štetu $damageName prijavljenu $damageDateReported.
        </strong></p>
        `;
        self::sendUserMail(self::MAIL_FILE_MISSING, $email, $message, $username);
    }

    public static function SetNewPassword($identifier, $newPassword)
    {
        $dbObj = new DB();
        $dbObj->SetPasswordWithIdentifier($identifier, $newPassword, bin2hex(random_bytes(25)));
        return USER_CONTROL_SUCCESS;
    }

    private static function sendUserMail(int $type, string $emailReceiver, $infoArgument = -1, string $recepientUsername = '')
    {
        $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $folderPath = $protocol . $_SERVER['HTTP_HOST'] . dirname($_SERVER["PHP_SELF"]);

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
                $fileRoute = $folderPath . "/control/activate.php";
                $message .=  '
                <h1 style="color: $highlightColor;width: 100%;text-align: center;">
                Dobrodošli, '.$recepientUsername.'!
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

                <br>

                <p style="font-family: sans-serif;font-size: 16px;">
                    <strong>
                    Pritiskom na link prihvaćate uvjete korištenja stranice koji mogu biti pregledani <a href="https://www.termsfeed.com/blog/sample-terms-and-conditions-template/">ovdje</a>!
                    </strong>
                </p>
                <p style="font-family: sans-serif;font-size: 16px;">
                    <a href="' . $fileRoute . "?activateId=" . $infoArgument . "&username=" . $recepientUsername . '" target="_blank">
                    Pritisnite ovdje za prihvaćanje uvjeta korištenja i aktivaciju svojeg korisničkog računa.
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
                break;
            }
            case self::MAIL_PASSWORD: {
                /* Ovdje ne ide "/control/change-pass.php" jer se iz "control" foldera već poziva!!! */
                $fileRoute = $folderPath . "/change-pass.php";
                $mailTitle = 'Nova lozinka';
                $message .=  '
                <h1 style="color: $highlightColor;width: 100%;text-align: center;">
                Nova lozinka
                </h1>

                <p style="font-family: sans-serif;font-size: 16px;">
                Pozdrav, '.$recepientUsername.'!
                </p>
                <p style="font-family: sans-serif;font-size: 16px;">
                Ovaj mail dobivate jer Vam je bila potrebna nova lozinka na stranici za prijavu šteta.
                </p>
                <p style="font-family: sans-serif;font-size: 16px;">
                    <strong>
                    Preporuka je poduzeti nužne radnje na linku ispod što prije!
                    </strong>
                </p>
                <br>

                <p style="font-family: sans-serif;font-size: 16px;">
                    <a href="' . $fileRoute . "?identifier=" . $infoArgument . '" target="_blank">
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
                Pozdrav, '.$recepientUsername.'.
                </p>
                <p style="font-family: sans-serif;font-size: 16px;">
                Ovaj mail dobivate jer je zabilježeno ' .$infoArgument.' neuspjelih pokušaja prijave za redom.
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
            case self::MAIL_FILE_MISSING: {
                $mailTitle = 'Zamolba';
                $message .=  '
                <h1 style="color: red;width: 100%;text-align: center;">
                Zamolba za ponovnim dizanjem datoteka
                </h1>

                <p style="font-family: sans-serif;font-size: 16px;">
                Pozdrav, '.$recepientUsername.'.
                </p>
                <p style="font-family: sans-serif;font-size: 16px;">
                Isprike na neugodnosti. Ovaj mail dobivate jer smo imali poteškoća s bazom podataka.
                </p>

                '.$infoArgument.'

                <p style="font-family: sans-serif;font-size: 16px;">
                Hvala na razumijevanju.
                </p>

                <p style="font-family: sans-serif;font-size: 16px;">
                Srdačan pozdrav,<br>
                </p>
                <p style="font-family: sans-serif;font-size: 16px;">
                Mislav Matijević, tvorac stranice
                </p>

                <br>';
            }
            default: throw new Exception("Neispravno postavljeno slanje mailova!", USER_CONTROL_MAIL_ERROR);
        }

        $message .= '
        </body>
            <div style="margin-top: 50px;background-color: #333333;width: 100%;height: auto;text-align: center;font-style: italic;color: white;">
            Mislav Matijević, Copyright © 2021. 
            </div>
        </html>';

        if (mail($emailReceiver, $mailTitle .  " | Stranice štete", $message, $headers) == false) {
            throw new Exception("Mail nije mogao biti poslan!", USER_CONTROL_MAIL_ERROR);
        } else {
            return USER_CONTROL_SUCCESS;
        }
    }
}
