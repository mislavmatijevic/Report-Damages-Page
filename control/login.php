<?php

$isValidCaptcha = UserControl::CheckCaptcha($_POST['g-recaptcha-response']);

if ($isValidCaptcha === true) {
    
    $loginUser = $_POST;

    $isLoggedIn = UserControl::LogIn($loginUser['username'], $loginUser['password']);
    $smarty->assign("messageOK", ERROR_MESSAGE);

    switch ($isLoggedIn) {        
        case DBError:
            $smarty->assign("message", "Problem s bazom podataka");
            break;

        case DBUserError:
            $smarty->assign("message", '<a style="color: white" href="./register.php">Niste registrirani?</a>');
            break;

        case USER_CONTROL_NEWPASSWORD:
        case DBTermsError:
            $smarty->assign("message", "Pogledajte svoj email");
            break;

        case DBPassError:
            $smarty->assign("message", '<a style="color: white" href="./control/forgottenPass.php?username="'.$_POST['username'].'">Zaboravljena lozinka?</a>');
            break;

        case USER_CONTROL_SUCCESS:
            header("Location: index.php");
            exit();
    }
} else {
    $smarty->assign("message", "Ispunite reCaptcha obrazac.");
}
