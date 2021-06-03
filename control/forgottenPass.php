<?php

require_once dirname(__DIR__).'/control/_page.php';

$username = null;
$smarty->assign("requestSent", false);

if (isset($_GET['username']))
{
    $username = $_GET["username"];
} 
else if (isset($_POST['submit']))
{
    $passwordResetStatus = UserControl::SendNewPassword($_POST['username']);

    switch ($passwordResetStatus) {
        case DBError: {
                $smarty->assign("message", "Problem s bazom podataka");
                break;
            }
        case DBUserError: {
                $smarty->assign("message", "Račun nije registriran");
                break;
            }
        case USER_CONTROL_SUCCESS: {
            $smarty->assign("message", "Na email s kojim ste se registrirali poslane su Vam upute za novu lozinku!");
            $smarty->assign("requestSent", true);
        }
    }
}
$smarty->display("header.tpl");

if (isset($username)) $smarty->assign("username", $username);
$smarty->display("forgottenPass.tpl");

$smarty->display("footer.tpl");