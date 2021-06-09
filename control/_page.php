<?php
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


if (!function_exists('str_contains')) {
    function str_contains($haystack, $needle) {
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
            $userHelloMessage = "Administrator";
            break;
        }
    case LVL_MODERATOR: {
            $userHelloMessage = "Moderator";
            break;
        }
    case LVL_REGISTRIRANI: {
            $userHelloMessage = "Pozdrav, " . (!empty($_SESSION["user"]->ime) ? $_SESSION["user"]->ime : $korisnik["user"]->korisnicko_ime) . "!";
            break;
        }
    case LVL_NEREGISTRIRANI: {
            $userHelloMessage = "Dobrodošli!";
            break;
        }
}

require_once dirname(__DIR__)."/control/OutputControl.php";

$smarty->assign("userHelloMessage", $userHelloMessage);

$termsAccepted = false;
if (isset($_COOKIE["terms4cookies"])) {
    var_dump($_COOKIE["terms4cookies"]);
    die();
}

if (!$termsAccepted) {
    $smarty->display("cookiesPopup.tpl");
}

?>