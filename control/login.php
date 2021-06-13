<?php

$isValidCaptcha = false;
$loginUser['username'] = Prevent::Injection("POST", "username");
$loginUser['password'] = Prevent::Injection("POST", "password");

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
    }
    if ($isLoggedIn === USER_CONTROL_SUCCESS) {
        if (isset($_POST["remember"])) {
            $maxSeconds = $config["cookieDurationDays"]*24*60*60;
            setcookie("user", $loginUser['username'], time()+$maxSeconds);
        } elseif (isset($_COOKIE["user"])) { // Ako nije kvačica na "Zapamti me".
            unset($_COOKIE["user"]);
            setcookie("user", "", "expires = Thu, 01 Jan 1970 00:00:00 GMT");
        }

        header("Location: {$relativePath}index.php");
        exit();
    }
}
