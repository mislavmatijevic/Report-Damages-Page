<?php

include dirname(__DIR__)."/control/_page.php";


if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $id = $_GET["id"];

    // Čisto za dodatnu sigurnost:
        $dbObj = new DB();
        $dbResponse = $dbObj->ConfirmUser($id);

        switch ($dbResponse) {
            case DBError: {
                $smarty->assign("message", "Dogodio se problem s bazom!");
                break;
            }
            case DBUserError: {
                $smarty->assign("message", "Račun već aktiviran. U slučaju pogreške kontaktirajte administratora.");
                break;
            }
            default: {
                UserControl::LogIn($dbResponse->email, $dbResponse->lozinka_citljiva);
                header("Location: ../index.php");
                exit();
            }
        }
        $smarty->display("header.tpl");
        $smarty->display("accountNotActivated.tpl");
        $smarty->display("footer.tpl");
    
} else {
    header("Location: ../index.php");
    exit();
}