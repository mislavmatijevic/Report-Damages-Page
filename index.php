<?php
require_once './control/_page.php';

$isLoggedIn = false;
$loginUser = null;

if (isset($_POST['testing'])) {
    
    if (isset($_POST["admin"])) {
        UserControl::LogIn("mmatijevi", "test1");
    } elseif (isset($_POST["moderator"])) {
        UserControl::LogIn("aanic2", "anica2");
    } elseif (isset($_POST["registered"])) {
        UserControl::LogIn("mmatijac3", "matejftw3");
    }
    header("Location: index.php");
    exit();

} elseif (isset($_POST['login']))
{
    require_once("./control/login.php");
}


$smarty->display("header.tpl");
$smarty->display("index.tpl");

if (!isset($_SESSION["user"])) {
    $smarty->assign("loginUser", $loginUser);
    $smarty->display("login_floating.tpl");
}

$smarty->display("footer.tpl");
