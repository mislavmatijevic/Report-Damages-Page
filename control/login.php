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
            setcookie('user', $loginUser['username'], time()+$maxSeconds, '/');
        } elseif (isset($_COOKIE["user"])) { // Ako nije kvačica na "Zapamti me".
            echo '{}';
            setcookie('user', '', time() - 60*60*24, '/');
            unset($_COOKIE["user"]);
        }

        header("Location: {$relativePath}index.php");
        exit();
    }
}
