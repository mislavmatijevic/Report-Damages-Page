<?php

error_reporting(E_ALL);

define("ERROR_MESSAGE", 0);
define("INFO_MESSAGE", 1);

require_once dirname(__DIR__)."/smarty-3.1.39/libs/Smarty.class.php";
$smarty = new Smarty();

require_once dirname(__DIR__)."/control/UserControl.php";
UserControl::startSession();

require_once dirname(__DIR__)."/control/Database.php";

$smarty->setTemplateDir(dirname(__DIR__)."/templates");
$smarty->setCompileDir(dirname(__DIR__)."/templates_c");

$smarty->assign("relativePath", (basename(dirname($_SERVER['REQUEST_URI'], 1)) === "control" ? "../" : "./"));

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
            $userHelloMessage = "Ugodan boravak, " . (!empty($_SESSION["user"]["ime"]) ? $_SESSION["user"]["ime"] : $korisnik["user"]["korisnicko_ime"]) . "!";
            break;
        }
    case LVL_NEREGISTRIRANI: {
            $userHelloMessage = "Dobrodošli na stranicu!";
            break;
        }
}
$smarty->assign("userHelloMessage", $userHelloMessage);