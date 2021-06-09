<?php
require_once dirname(__DIR__)."/control/OutputControl.php";

if (isset($_POST['checkUsername'])) {
    ob_clean();
    header_remove();
    header("Content-type: application/json; charset=utf-8");
    http_response_code(200);

    $requestedUsername = Prevent::Injection("POST", "checkUsername");

    $dbObj = new DB();

    try {
        $dbObj->CheckUserExists($requestedUsername);
    } catch (Exception $ex) { // Korisnik ne postoji (ili je nedajbože baza prestala raditi).
        
        die(json_encode(false));
    }
    die(json_encode(true)); // Korisnik postoji jer nije bačena iznimka na provjeru imena.
}
