<?php

include dirname(__DIR__)."/control/_page.php";
$relativePath = '../';

if (isset($_GET["activateId"]) && isset($_GET["username"])) {
    $activateId = filter_input(INPUT_GET, "activateId", FILTER_SANITIZE_EMAIL);
    $username = filter_input(INPUT_GET, "username", FILTER_SANITIZE_EMAIL);


    $dbObj = new DB();

    try {
        $fullUser = $dbObj->ConfirmUser($activateId, $username);
        UserControl::LogIn($username, $fullUser->lozinka_citljiva);
    } catch (Exception $e) {
        if ($e->getCode() !== DBUserError) {
            $smarty->assign("message", $e->getMessage());
            $smarty->display("header.tpl");
            $smarty->display("activate.tpl");
            $smarty->display("footer.tpl");
            exit();
        }
    }
}


header("Location: {$relativePath}index.php");
exit();
