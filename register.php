<?php
$pageTitle = "Stranica za registraciju";
require_once './control/_page.php';

$newUser = null;
$mistakeField = null;
if (isset($_POST["register"])) {
    $mistakeField = array();
    $newUser = array();

    try {
        UserControl::CheckCaptcha($_POST['g-recaptcha-response']);
    } catch (Exception $e) {
        $mistakeField["captcha"] = $e->getCode();
        $smarty->assign("messageOK", ERROR_MESSAGE);
        $smarty->assign("message", $e->getMessage());
    }

    foreach ($_POST as $k => $v) {
        $newUser[$k] = Prevent::Injection("POST", $k);

        $mistake = "";

        switch ($k) {
            case 'name': {
                if (empty($v)) {
                    $mistakeField[$k] = "Popunite ime!";
                } elseif (strlen($v) > 25) {
                    $mistakeField[$k] = "Ime je predugačko";
                }
                break;
            }
            case 'surname': {
                if (empty($v)) {
                    $mistakeField[$k] = "Popunite prezime!";
                } elseif (strlen($v) > 50) {
                    $mistakeField[$k] = "Prezime je predugačko";
                }
                break;
            }
            case 'username': {

                if (empty($v)) {
                    $mistakeField[$k] = "Popunite korisničko ime!";
                } elseif (strlen($v) < 3) {
                    $mistakeField[$k] = "Korisničko ime je prekratko";
                } elseif (strlen($v) > 20) {
                    $mistakeField[$k] = "Korisničko ime je predugačko";
                }

                break;
            }
            case 'password': {

                if (!preg_match('/^([ -~šđčćžŠĐČĆŽ]+){5,}$/', $v)) {
                    $mistakeField[$k] = "Lozinka mora imati više od 5 znakova!";
                } elseif (!preg_match('/^(?=.*[\d])([ -~šđčćžŠĐČĆŽ]+){5,}$/', $v)) {
                    $mistakeField[$k] = "Lozinku mora činiti barem 1 broj!";
                } elseif (strlen($v) > 50) {
                    $mistakeField[$k] = "Lozinka je predugačka";
                } elseif (!preg_match('/^(?=.*[\D])([ -~šđčćžŠĐČĆŽ]+){5,}$/', $v)) {
                    $mistakeField[$k] = "Lozinku mora činiti barem 1 slovo!";
                }

                break;
            }
            case 'confirm_pass': {

                if ($v !== $_POST["password"]) {
                    $mistakeField[$k] = "Lozinke se ne poklapaju";
                }

                break;
            }
            case 'email': {

                if (empty($v)) {
                    $mistakeField[$k] = "Unesite mail!";
                } elseif (strlen($v) > 45) {
                    $mistakeField[$k] = "Email je predugačak";
                } elseif (!preg_match('/^[^.]([a-z0-9A-Z.\+\"\_\-]{1,64})[^.]@[^\-\_\-](?=.{1,255}$)([a-z0-9A-Z\-\+\.)+([a-z0-9A-Z]+)$/', $v)) {
                    $mistakeField[$k] = "Unesite ispravan email!";
                }

                break;
            }
        }
    }
    
    if (!empty($mistakeField)) {
        $smarty->assign("messageOK", ERROR_MESSAGE);
        $smarty->assign("mistakeField", Prevent::XSS($mistakeField));
    } else {
        $isRegistered = false;

        try {
            $isRegistered = UserControl::RegisterUser($newUser);
        } catch (Exception $e) {
            $smarty->assign("messageOK", ERROR_MESSAGE);
            $smarty->assign("message", $e->getMessage());
        }

        if ($isRegistered) {
            $smarty->assign("messageOK", INFO_MESSAGE);
            $smarty->assign("message", "<strong>{$newUser["name"]}, provjerite mail.</strong>");
            $smarty->assign("infoGlobal", "Dobrodošli!");
        }
    }
}

if (isset($newUser)) {
    $smarty->assign("newUser", Prevent::XSS($newUser));
}

$smarty->display("header.tpl");
$smarty->display("register.tpl");
$smarty->display("footer.tpl");
