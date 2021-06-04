<?php

require_once dirname(__DIR__).'/control/_page.php';

$username = null;
$smarty->assign("requestSent", false);

if (isset($_GET['username'])) {
    $username = $_GET["username"];
} elseif (isset($_POST['submit'])) {
    if (empty($_POST['username'])) {
        $smarty->assign("message", "Molimo unesite Vaše korisničko ime!");
    } else {
        $username = $_POST["username"];

        $captcha = false;
        try {
            $captcha = UserControl::CheckCaptcha($_POST['g-recaptcha-response']);
        } catch (Exception $e) {
            $smarty->assign("messageCaptcha", $e->getMessage());
        }
    
        if ($captcha) {
            try {
                $sent = UserControl::SendNewPassword($_POST['username']);
            } catch (Exception $e) {
                $smarty->assign("message", $e->getMessage());
            } finally {
                if ($sent) {
                    $smarty->assign("message", "Na Vaš '".substr($sent, 0, 3) . "..." . substr($sent, strpos($sent, '@'), 15)."' email poslane su Vam upute za novu lozinku!");
                    $smarty->assign("requestSent", true);
                }
            }
        }
    }
}
$smarty->display("header.tpl");

if (isset($username)) {
    $smarty->assign("username", $username);
}
$smarty->display("forgottenPass.tpl");

$smarty->display("footer.tpl");
