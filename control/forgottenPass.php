<?php
require_once dirname(__DIR__).'/control/_page.php';

if (isset($_POST['login'])) {

    $isLoggedIn = UserControl::LogIn($_POST['email'], $_POST['password']);
    $smarty->assign("messageOK", ERROR_MESSAGE);

    switch ($isLoggedIn) {
        case DBError: {
                $smarty->assign("message", "Problem s bazom podataka");
                break;
            }
        case UserError: {
                $smarty->assign("message", "Račun nije registriran");
                break;
            }
        case USER_CONTROL_SUCCESS: {
            $smarty->assign("message", "Na email vam je poslana nova lozinka!");
            $smarty->assign("messageOK", INFO_MESSAGE);
        }
    }
}

$smarty->display("header.tpl");

$smarty->display("forgottenPass.tpl");

$smarty->display("footer.tpl");