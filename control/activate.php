<?php

include dirname(__DIR__)."/control/_page.php";
$relativePath = '../';

if (isset($_GET["activateId"]) && isset($_GET["username"])) {
    $activateId = filter_input(INPUT_GET, "activateId", FILTER_SANITIZE_EMAIL);
    $username = filter_input(INPUT_GET, "username", FILTER_SANITIZE_EMAIL);


    $dbObj = new DB();

    try {
        UserControl::ConfirmUserAndLogin($activateId, $username);
    } catch (Exception $e) {
        if ($e->getCode()) {
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
