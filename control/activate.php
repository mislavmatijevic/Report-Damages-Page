<?php

include dirname(__DIR__)."/control/_page.php";


if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $id = $_GET["id"];
    $dbObj = new DB();

    try {
        $dbResponse = $dbObj->ConfirmUser($id);
        UserControl::LogIn($dbResponse->email, $dbResponse->lozinka_citljiva);
    } catch (Exception $e) {
        if ($e->getCode() !== DBUserError) {
            $smarty->assign("message", $e->getMessage());
            $smarty->display("header.tpl");
            $smarty->display("accountNotActivated.tpl");
            $smarty->display("footer.tpl");
            exit();
        }
    }
}


header("Location: ../index.php");
exit();
