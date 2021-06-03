<?php
$pageAccessLvl = 4;
require_once './control/_page.php';

$newUser = null;
$mistakeField = null;
if (isset($_POST["register"])) {
    $mistakeField = array();
    $newUser = array();

    foreach ($_POST as $k => $v) {
        $newUser[$k] = $v;

        $mistake = "";

        switch ($k) {
            case 'name': {
                    if (empty($v)) {
                        $mistakeField[$k] = "Popunite ime!";
                    } elseif (strlen($v) > 25) {
                        $mistakeField[$k] = "Ime je predugačko!";
                    }
                    break;
                }
            case 'surname': {
                    if (empty($v)) {
                        $mistakeField[$k] = "Popunite prezime!";
                    } elseif (strlen($v) > 50) {
                        $mistakeField[$k] = "Prezime je predugačko!";
                    }
                    break;
                }
            case 'username': {

                    if (empty($v)) {
                        $mistakeField[$k] = "Popunite korisničko ime!";
                    } elseif (strlen($v) > 20) {
                        $mistakeField[$k] = "Korisničko ime je predugačko!";
                    }

                    break;
                }
            case 'password': {

                    if (!preg_match('/^([\w]+){5,}$/', $v)) {
                        $mistakeField[$k] = "Lozinka mora imati više od 5 znakova!";
                    } elseif (!preg_match('/^(?=.*[\d])([\w]+){5,}$/', $v)) {
                        $mistakeField[$k] = "Lozinku mora činiti barem 1 broj!";
                    } elseif (strlen($v) > 50) {
                        $mistakeField[$k] = "Lozinka je predugačka!";
                    } elseif (!preg_match('/^(?=.*[\D])([\w]+){5,}$/', $v)) {
                        $mistakeField[$k] = "Lozinku mora činiti barem 1 slovo!";
                    }

                    break;
                }
            case 'confirm_pass': {

                    if ($v !== $_POST["password"]) {
                        $mistakeField[$k] = "Lozinke se ne poklapaju.";
                    }

                    break;
                }
            case 'email': {

                    if (empty($v)) {
                        $mistakeField[$k] = "Unesite mail!";
                    } elseif (strlen($v) > 45) {
                        $mistakeField[$k] = "Email je predugačak!";
                    } elseif (!preg_match('/^[^.]([a-z0-9A-Z.\+\"\_\-]{1,64})[^.]@[^\-\_\-](?=.{1,255}$)([a-z0-9A-Z\-\+\.)+([a-z0-9A-Z]+)$/', $v)) {
                        $mistakeField[$k] = "Unesite ispravan email!";
                    }

                    break;
                }
            case 'g-recaptcha-response': {
                if (UserControl::CheckCaptcha($v) === false) {
                    $mistakeField[$k] = "Ispunite reCaptcha obrazac";
                    $smarty->assign("messageOK", ERROR_MESSAGE);
                    $smarty->assign("message", $mistakeField[$k]);
                };
                break;
            }
        }
    }

    if (empty($mistakeField)) {
        if (!strlen($newUser["name"])) {
            $newUser["name"] = null;
        }
        if (!strlen($newUser["surname"])) {
            $newUser["surname"] = null;
        }

        $isRegistered = UserControl::RegisterUser($newUser);

        switch ($isRegistered) {
            case DBError: {
                    $smarty->assign("message", "Problem s bazom podataka!");
                    $smarty->assign("messageOK", ERROR_MESSAGE);
                    break;
                }
            default: {
                    $smarty->assign("message", "{$newUser["name"]}, na mail Vam je stigla obavijest. Dovršite aktivaciju preko nje!");
                    $smarty->assign("messageOK", INFO_MESSAGE);
                }
        }
    }
}

if (isset($newUser)) {
    $smarty->assign("newUser", $newUser);
}
if (!empty($mistakeField)) {
    $smarty->assign("mistakeField", $mistakeField);
}

$smarty->display("header.tpl");
$smarty->display("register.tpl");
$smarty->display("footer.tpl");
