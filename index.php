<?php
require_once './php_background/_page.php';

$isLoggedIn = false;
if (isset($_POST['login'])) {

    $isLoggedIn = UserControl::LogIn($_POST['email'], $_POST['password']);
    $smarty->assign("messageOK", ERROR_MESSAGE);

    switch ($isLoggedIn) {
        case DBError: {
                $smarty->assign("message", "Problem s bazom podataka!");
                break;
            }
        case UserError: {
                $smarty->assign("message", "Molimo registrirajte se.");
                break;
            }
        case PassError: {
                $smarty->assign("message", "Neispravna lozinka!");
                break;
            }
        case LOGIN_COMPLETE: {
            $smarty->assign("message", "Dobrodošli, {$_SESSION["user"]->ime}!");
            $smarty->assign("messageOK", INFO_MESSAGE);
        }
    }
}


$smarty->display("header.tpl");
$smarty->display("index.tpl");

$smarty->display("login_floating.tpl");

$smarty->display("footer.tpl");
