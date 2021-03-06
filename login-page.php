<?php
$pageTitle = "Stranica za prijavu";
require_once './control/_page.php';

$isLoggedIn = false;
$loginUser = null;

if (isset($_COOKIE["user"])) {
    $loginUser["username"] = $_COOKIE["user"];
    $smarty->assign("setRemember", true);
}

if (isset($_POST['login'])) {
    require_once("./control/login.php");
}

$smarty->display("header.tpl");

$smarty->assign("loginUser", Prevent::XSS($loginUser));
$smarty->display("login.tpl");

$smarty->display("footer.tpl");
