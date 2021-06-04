<?php
$pageAccessLvl = 4;
require_once './control/_page.php';

$isLoggedIn = false;

if (isset($_POST['login'])) {
    $loginUser = $_POST;
    require_once("./control/login.php");
}

$smarty->display("header.tpl");

$smarty->assign("loginUser", $loginUser);
$smarty->display("login.tpl");

$smarty->display("footer.tpl");
