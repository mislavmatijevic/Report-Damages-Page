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
            header("Location: index.php");
            exit();
        }
    }
}
