<?php

error_reporting(E_ALL);

define("ERROR_MESSAGE", 0);
define("INFO_MESSAGE", 1);

$urlToRoot = $_SERVER['HTTP_HOST'].dirname($_SERVER["PHP_SELF"])."/";
if (!isset($relativePath)) {
    $relativePath = basename(dirname($_SERVER['REQUEST_URI'], 1)) === "control" ? "../" : "./";
}

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


// Uvijek preko TLS-a:
if (empty($_SERVER['HTTPS']) && $_SERVER['HTTP_HOST'] !== "localhost:4000") {
    header('Location: '.$urlToRoot.substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/")+1));
    exit;
} elseif ($_SERVER['HTTP_HOST'] !== "localhost:4000") { // Zapamti ovu https putanju.
    $urlToRoot = "https://".$urlToRoot;
} else { // Nesiguran protokol za lokalno testiranje.
    $urlToRoot = "http://".$urlToRoot;
}

require_once dirname(__DIR__)."/control/Database.php";

switch ($_SESSION["lvl"]) {
    case LVL_ADMINISTRATOR: {
            $userHelloMessage = "Ugodan dan, administratore!";
            break;
        }
    case LVL_MODERATOR: {
            $userHelloMessage = "Budite pažljivi u radu!";
            break;
        }
    case LVL_REGISTRIRANI: {
            $userHelloMessage = "Ugodan boravak, " . (!empty($_SESSION["user"]->ime) ? $_SESSION["user"]->ime : $korisnik["user"]->korisnicko_ime) . "!";
            break;
        }
    case LVL_NEREGISTRIRANI: {
            $userHelloMessage = "Dobrodošli na stranicu!";
            break;
        }
}

require_once dirname(__DIR__)."/control/paging.php";

$smarty->assign("userHelloMessage", $userHelloMessage);
