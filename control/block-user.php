<?php

ob_clean();
header_remove();
header("Content-type: application/json; charset=utf-8");
http_response_code(200);

require_once dirname(__DIR__)."/control/Database.php";
require_once dirname(__DIR__)."/control/OutputControl.php";

if (isset($_POST["get_blocked"])) {
    $selectedStatus = Prevent::Injection("POST", "get_blocked");
    try {
        if (!is_numeric($selectedStatus)) {
            throw new Exception();
        }
        $dbObj = new DB;
        die(json_encode($dbObj->GetAllWithBlockedStatus($selectedStatus)));
    } catch (Exception $e) {
        die(json_encode(false));
    }
}
if (isset($_POST['username']) && isset($_POST['action'])) { // action => 0 ili 1
    $selectedUser = Prevent::Injection("POST", "username");
    $selectedAction = Prevent::Injection("POST", "action");

    try {
        if (!is_numeric($selectedAction)) {
            throw new Exception();
        }

        $selectedAction = $selectedAction == 1 ? true : false;

        $dbObj = new DB;
        $dbObj->BlockUser($selectedUser, $selectedAction);
        
        die(json_encode(true));
        
    }
    catch (Exception $e) {
        die(json_encode(false));
    }
}