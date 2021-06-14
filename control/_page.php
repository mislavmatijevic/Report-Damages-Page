<?php
error_reporting(0);
require_once dirname(__DIR__)."/control/constants.php";

require_once dirname(__DIR__)."/control/UserControl.php";
UserControl::startSession();

if (isset($pageAccessLvl)) {
    if ($_SESSION["lvl"] > $pageAccessLvl) {
        header("Location: {$relativePath}index.php");
        exit();
    }
}

require_once dirname(__DIR__)."/smarty-3.1.39/libs/Smarty.class.php";
$smarty = new Smarty();
$smarty->setTemplateDir(dirname(__DIR__)."/templates");
$smarty->setCompileDir(dirname(__DIR__)."/templates_c");
$smarty->assign("relativePath", $relativePath);

if (!isset($pageTitle)) {
    $pageTitle = "";
}
$pageTitle .= " | Stranica za štete";
$smarty->assign("pageTitle", $pageTitle);
$smarty->assign("fullScriptName", $fullScriptName);

if (!function_exists('str_contains')) {
    function str_contains($haystack, $needle)
    {
        return $needle !== '' && mb_strpos($haystack, $needle) !== false;
    }
}


// Uvijek preko TLS-a:
if (empty($_SERVER['HTTPS']) && !str_contains($_SERVER['HTTP_HOST'], "localhost")) {
    header("Location: https://".$fullUrl);
    exit();
} elseif (!str_contains($_SERVER['HTTP_HOST'], "localhost:4000")) { // Zapamti da ova putanja počinje s https.
    $urlToRoot = "https://".$urlToRoot;
} else { // Nesiguran protokol za lokalno testiranje.
    $urlToRoot = "http://".$urlToRoot;
}

require_once dirname(__DIR__)."/control/Database.php";

switch ($_SESSION["lvl"]) {
    case LVL_ADMINISTRATOR: {
            $userHelloMessage = $_SESSION["user"]->korisnicko_ime . " (admin)";
            break;
        }
    case LVL_MODERATOR: {
            $userHelloMessage = $_SESSION["user"]->korisnicko_ime . " (mod)";
            break;
        }
    case LVL_REGISTRIRANI: {
            $userHelloMessage = $_SESSION["user"]->korisnicko_ime;
            break;
        }
    case LVL_NEREGISTRIRANI: {
            $userHelloMessage = "Dobrodošli!";
            break;
        }
}

require_once dirname(__DIR__)."/control/OutputControl.php";

$smarty->assign("userHelloMessage", $userHelloMessage);

$config = parse_ini_file($confFilePath);

$termsAccepted = false;

try {
    $dbObj = new DB();
    $logObj = new Log($dbObj);
    $logObj->New("", "Korištenje skripte " . $fullScriptName, Log::pristup_stranici);

    if (isset($_COOKIE["cookies"])) {
        $termsAccepted = true;
    } elseif (isset($_POST["accept-cookies"])) {
        if ($_POST["accept-cookies"] == "true") {
            $maxSeconds = $config["cookieDurationDays"]*24*60*60;
            setcookie("cookies", "true", time()+$maxSeconds);
            $termsAccepted = true;
            $logObj->New("", "Prihvaćanje uvjeta (" . $fullScriptName . ")", Log::prihvaćanje_uvjeta);
            header("Location: {$relativePath}index.php");
            die();
        }
    }
    if (!$termsAccepted) {
        $smarty->assign("messageCookie", $termsAccepted);
        $smarty->display("header.tpl");
        die();
    }

    if (isset($_SESSION["infoGlobal"])) {
        $smarty->assign("infoGlobal", $_SESSION["infoGlobal"]);
        unset($_SESSION["infoGlobal"]);
    }
} catch (Exception $e) {
}
