<?php

require_once dirname(__DIR__).'/control/_page.php';

$newPassword = null;
$smarty->assign("requestSent", false);

$identifier = null;
$smarty->assign("passChanged", false);

if (isset($_GET['identifier'])) {
    $identifier = $_GET['identifier'];
} elseif (isset($_POST['submit']) && isset($_POST['identifier'])) {
    if (empty($_POST['newPassword'])) {
        $smarty->assign("message", "Molimo unesite novu lozinku!");
    } else {
        $identifier = filter_input(INPUT_POST, "identifier");
        $newPassword = filter_input(INPUT_POST, "newPassword");
        $newPasswordRepeat = filter_input(INPUT_POST, "newPasswordRepeat");

        if (empty($newPassword) || empty($newPasswordRepeat)) {
            $smarty->assign("message", "Unesite obje lozinke!");
        } elseif ($newPassword !== $newPasswordRepeat) {
            $smarty->assign("message", "Lozinke se ne podudaraju");
        } elseif (strlen($newPassword) < 5) {
            $smarty->assign("message", "Lozinka mora imati više od 5 znakova!");
        } elseif (!preg_match('/^([\wšđčćžŠĐČĆŽ]+){5,}$/', $newPassword)) {
            $smarty->assign("message", "Uklonite specijalne znakove!");
        } elseif (!preg_match('/^(?=.*[\d])([\wšđčćžŠĐČĆŽ]+){5,}$/', $newPassword)) {
            $smarty->assign("message", "Lozinku mora činiti barem 1 broj!");
        } elseif (strlen($newPassword) > 50) {
            $smarty->assign("message", "Lozinka je predugačka!");
        } elseif (!preg_match('/^(?=.*[\D])([\wšđčćžŠĐČĆŽ]+){5,}$/', $newPassword)) {
            $smarty->assign("message", "Lozinku mora činiti barem 1 slovo!");
        } else {
            $captcha = false;
            try {
                $captcha = UserControl::CheckCaptcha($_POST['g-recaptcha-response']);
            } catch (Exception $e) {
                $smarty->assign("messageCaptcha", $e->getMessage());
            }
    
            $set = false;
            if ($captcha) {
                try {
                    $smarty->assign("requestDone", true);
                    $set = UserControl::SetNewPassword($identifier, $newPassword);
                } catch (Exception $e) {
                    $smarty->assign("message", $e->getMessage());
                    $smarty->assign("additionalInfo", "Ako niste promijenili lozinku, Vaš je račun možda ugrožen! <a href=\"mailto:mmatijevi@foi.hr\">Odmah kontaktirajte administratora.</a>");
                } finally {
                    if ($set === USER_CONTROL_SUCCESS) {
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

$smarty->display("change-pass.tpl");

$smarty->display("footer.tpl");
