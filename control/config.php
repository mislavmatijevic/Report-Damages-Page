<?php

ob_clean();
header_remove();
header("Content-type: application/json; charset=utf-8");
http_response_code(200);

require_once dirname(__DIR__)."/control/Database.php";
require_once dirname(__DIR__)."/control/OutputControl.php";

session_start();
if ($_SESSION["lvl"] != 1) {
    die(json_encode("Nedovoljne ovlasti!"));
}

$conf = dirname(__DIR__)."/privatno/config/manage.conf";
$config = parse_ini_file($conf);

if (isset($_POST['get_current_config'])) {
    die(json_encode($config));
}

$dbObj = new DB;

if (isset($_POST['newConfig'])) {
    $newConfig = json_decode($_POST['newConfig']);

    try {
        if (!isset($newConfig->maxFailedLogins) || empty($newConfig->maxFailedLogins)) {
            $newConfig->maxFailedLogins = $config["maxFailedLogins"];
        } elseif (!is_numeric($newConfig->maxFailedLogins)) {
            throw new Exception();
        }
        if (!isset($newConfig->maxHoursToAccept) || empty($newConfig->maxHoursToAccept)) {
            $newConfig->maxHoursToAccept = $config["maxHoursToAccept"];
        } elseif (!is_numeric($newConfig->maxHoursToAccept)) {
            throw new Exception();
        }
        if (!isset($newConfig->maxItemsPerPage) || empty($newConfig->maxItemsPerPage)) {
            $newConfig->maxItemsPerPage = $config["maxItemsPerPage"];
        } elseif (!is_numeric($newConfig->maxItemsPerPage)) {
            throw new Exception();
        }
        if (!isset($newConfig->cookieDurationDays) || empty($newConfig->cookieDurationDays)) {
            $newConfig->cookieDurationDays = $config["cookieDurationDays"];
        } elseif (!is_numeric($newConfig->cookieDurationDays)) {
            throw new Exception();
        }
        if (!isset($newConfig->maxSessionLengthMinutes) || empty($newConfig->maxSessionLengthMinutes)) {
            $newConfig->maxSessionLengthMinutes = $config["maxSessionLengthMinutes"];
        } elseif (!is_numeric($newConfig->maxSessionLengthMinutes)) {
            throw new Exception();
        }

        if (!isset($newConfig->captchaSecretKey) || empty($newConfig->captchaSecretKey)) {
            $newConfig->captchaSecretKey = $config["captchaSecretKey"];
        } else {
            $newConfig->captchaSecretKey = Prevent::XSS($newConfig->captchaSecretKey);
        }

        if (!isset($newConfig->virtualTimeOffsetSeconds) || empty($newConfig->virtualTimeOffsetSeconds)) {
            $newConfig->virtualTimeOffsetSeconds = $config["virtualTimeOffsetSeconds"];
        } else {
            if (!is_numeric($newConfig->virtualTimeOffsetSeconds)) {
                throw new Exception();
            }
            $newConfig->virtualTimeOffsetSeconds = $config["virtualTimeOffsetSeconds"] + ($newConfig->virtualTimeOffsetSeconds*60*60);
        }

        $changesMessage = "Promijenjene su konfiguracijske postavke sljedećim vrijednostima:";

        $fileConfig = fopen($conf, "w");
        foreach ($newConfig as $key => $newValue) {
            if ($newValue !== $config[$key]) {
                $changesMessage .= "\n($key) $config[$key] -> $newValue";
            }
            fwrite($fileConfig, $key . " = " . $newValue . "\n");
        }
        fclose($fileConfig);

        $returnMe = [
            'realTime' => date("d.m.Y H:i:s", time()),
            'virtualTime' => date("d.m.Y H:i:s", time() + $config["virtualTimeOffsetSeconds"]),
        ];

        $logObj = new Log($dbObj);
        $logObj->New("", $changesMessage, Log::promjena_konfiguracije);

        die(json_encode($returnMe));
    } catch (Exception $e) {
        die(json_encode(false));
    }
}

if (isset($_POST['get_moderators'])) {
    try {
        $allModerators = $dbObj->GetModerators();
        die(json_encode($allModerators));
    } catch (Exception $e) {
        die(json_encode(false));
    }
}

if (isset($_POST['get_categories'])) {
    try {
        die(json_encode($dbObj->SelectPrepared("SELECT id_kategorija_stete, naziv FROM kategorija_stete")));
    } catch (Exception $e) {
        die(json_encode(false));
    }
}

if (isset($_POST["username"]) && isset($_POST["action"])) {
    $username = Prevent::Injection("POST", "username");
    $action = Prevent::Injection("POST", "action");
    settype($action, "integer");

    try {
        $newLvl = ($action == 0 ? 3 : 2);
        $dbObj->ExecutePrepared("UPDATE `WebDiP2020x057`.`korisnik` SET `id_uloga` = ? WHERE `korisnicko_ime` = ?", "is", [$newLvl, $username]);
        die(json_encode(true));
    } catch (Exception $e) {
        die(json_encode(false));
    }
}

if (isset($_POST["id_moderator"]) && isset($_POST["new_categories"])) {
    $id_moderator = Prevent::Injection("POST", "id_moderator");

    try {
        $dbObj->ExecutePrepared("DELETE FROM `WebDiP2020x057`.`moderator_kategorije` WHERE (`id_moderator` = ?)", "i", [$id_moderator]);
        foreach ($_POST["new_categories"] as $key => $value) {
            $dbObj->ExecutePrepared("INSERT INTO `WebDiP2020x057`.`moderator_kategorije` (`id_moderator`, `id_kategorija_stete`) VALUES (?, ?)", "ii", [$id_moderator, $value]);
        }
        die(json_encode(true));
    } catch (Exception $e) {
        die(json_encode(false));
    }
}

$fullBackupFileLocation = "../baza/WebDiP2020x57.sql";

// Vraća veličinu datoteke.
if (isset($_POST["backupCreate"])) {
    shell_exec("mysqldump -u" . korisnik . " -p" . lozinka . " " . baza . " --opt > " . $fullBackupFileLocation);
    die(json_encode(filesize($fullBackupFileLocation)));
}

// Vraća broj dodanih naredbi.
if (isset($_POST["backupRestore"])) {
    $counter = 0;

    try {
        $backupFile = fopen($fullBackupFileLocation, "r");
        if ($backupFile == false) {
            throw new Exception("Error", -1);
        }

        $entireBackupFile = fread($backupFile, filesize($punaLokacija));

        $orderList = explode(';', $entireBackupFile);

        while (($line = fgets($backupFile)) !== false) {
            if ($line[0] !== "-") {
                $counter++;
            }
        }
        fclose($backupFile);

        shell_exec("mysql -u" . korisnik . " -p" . lozinka . " " . baza . " < " . $fullBackupFileLocation);
        die(json_encode($counter));
    } catch (Exception $e) {
        die(json_encode($e->getCode()));
    }
}
