<?php
require_once './control/_page.php';

$isLoggedIn = false;
$loginUser = null;

if (isset($_POST['login'])) {

    $loginUser = $_POST;

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
        case PassError: {
                $smarty->assign("message", "Neispravna lozinka");
                break;
            }
        case USER_CONTROL_SUCCESS: {
            header("Location: index.php");
        }
    }
}

$smarty->display("header.tpl");

$smarty->assign("loginUser", $loginUser);
$smarty->display("login.tpl");

$smarty->display("footer.tpl");