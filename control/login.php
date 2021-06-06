<?php

$isValidCaptcha = false;

try {
    $isValidCaptcha = UserControl::CheckCaptcha($_POST['g-recaptcha-response']);
} catch (Exception $e) {
    $smarty->assign("messageCaptcha", $e->getMessage());
}

if ($isValidCaptcha) {
    $isLoggedIn = false;
    
    try {
        $isLoggedIn = UserControl::LogIn($loginUser['username'], $loginUser['password']);
    } catch (Exception $e) {
        $smarty->assign("message", $e->getMessage());
        $isLoggedIn = false;
    } finally {
        if ($isLoggedIn === USER_CONTROL_SUCCESS) {

            if (isset($_POST["remember"])) {
                setcookie("user", $loginUser['username']);
            } else if (isset($_COOKIE["user"])) {
                unset($_COOKIE["user"]);
                setcookie("user", null, -1, '/');
            }

            header("Location: index.php");
            exit();
        }
    }
}
