<?php

require_once dirname(__DIR__).'/control/_page.php';

$newPassword = null;
$smarty->assign("requestSent", false);

$identifier = null;
$smarty->assign("passChanged", false);

if (isset($_GET['identifier'])) {
    $identifier = $_GET['identifier'];
} elseif (isset($_POST['submit'])) {
    if (empty($_POST['newPassword'])) {
        $smarty->assign("message", "Molimo unesite novu lozinku!");
    } else {
        $identifier = $_POST['identifier'];
        $newPassword = $_POST["newPassword"];
        $newPasswordRepeat = $_POST["newPasswordRepeat"];

        if (empty($newPassword) || empty($newPasswordRepeat)) {
            $smarty->assign("message", "Unesite obje lozinke!");
        } elseif ($newPassword !== $newPasswordRepeat) {
            $smarty->assign("message", "Lozinke se ne podudaraju");
        } elseif (!preg_match('/^([\w]+){5,}$/', $newPassword)) {
            $smarty->assign("message", "Lozinka mora imati više od 5 znakova!");
        } elseif (!preg_match('/^(?=.*[\d])([\w]+){5,}$/', $newPassword)) {
            $smarty->assign("message", "Lozinku mora činiti barem 1 broj!");
        } elseif (strlen($newPassword) > 50) {
            $smarty->assign("message", "Lozinka je predugačka!");
        } elseif (!preg_match('/^(?=.*[\D])([\w]+){5,}$/', $newPassword)) {
            $smarty->assign("message", "Lozinku mora činiti barem 1 slovo!");
        } else {
            $captcha = false;
            try {
                $captcha = UserControl::CheckCaptcha($_POST['g-recaptcha-response']);
            } catch (Exception $e) {
                $smarty->assign("messageCaptcha", $e->getMessage());
            }
    
            if ($captcha) {
                try {
                    $set = UserControl::SetNewPassword($identifier, $newPassword);
                } catch (Exception $e) {
                    $smarty->assign("message", $e->getMessage());
                } finally {
                    if ($set) {
                        $smarty->assign("passChanged", true);
                        $smarty->assign("message", "Vaša lozinka sada je promijenjena");
                        $smarty->assign("additionalInfo", "Ova se stranica sada može zatvoriti.");
                    }
                }
            }
        }
    }
}

if (!isset($identifier)) { // U slučaju da je netko slučajno nabasao na stranicu.
    header("Location: ../index.php");
    exit();
} else {
    $smarty->assign("identifier", $identifier);
}


$smarty->display("header.tpl");

if (isset($newPassword)) {
    $smarty->assign("newPassword", $newPassword);
}
if (isset($newPasswordRepeat)) {
    $smarty->assign("newPasswordRepeat", $newPasswordRepeat);
}

$smarty->display("changePass.tpl");

$smarty->display("footer.tpl");
