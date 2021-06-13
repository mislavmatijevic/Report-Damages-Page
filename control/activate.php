<?php

include dirname(__DIR__)."/control/_page.php";
$relativePath = '../';

if (isset($_GET["activateId"]) && isset($_GET["username"])) {
    $activateId = Prevent::Injection("GET", "activateId");
    $username = Prevent::Injection("GET", "username");


    $dbObj = new DB();

    try {
        UserControl::ConfirmUserAndLogin($activateId, $username);
        $_SESSION["infoGlobal"] = "Dobro nam došli, $username!";
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
