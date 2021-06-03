<?php
if (isset($_POST['g-recaptcha-response'])) {
    $captcha = $_POST['g-recaptcha-response'];
}
if (!isset($captcha)) {
    return false;
}

$secretKey = "6Lf1IQwbAAAAAPoDQR_It0X1h9MTvdnNTOOTqUC8";

$ip = $_SERVER['REMOTE_ADDR'];

$url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
$response = file_get_contents($url);
$responseKeys = json_decode($response, true);

if ($responseKeys["success"]) {
    return true;
} else {
    return false;
}
