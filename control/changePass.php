<?php

include dirname(__DIR__)."/control/_page.php";


if (isset($_GET["tempKey"]) && isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $id = $_GET["id"];
    $tempKey = $_GET["tempKey"];

    // Čisto za dodatnu sigurnost:
        $dbObj = new DB();
        $dbResponse = $dbObj->FindKey($tempKey);

        switch ($dbResponse) {
            case DBError: {
                $smarty->assign("message", "Dogodio se problem s bazom!");
                break;
            }
            case DBUserError: {
                $smarty->assign("message", "Ovaj link je nevažeći. U slučaju pogreške kontaktirajte administratora.");
                break;
            }
            default: {
                UserControl::LogIn($dbResponse->email, $dbResponse->lozinka_citljiva);
                header("Location: ../index.php");
                exit();
            }
        }
        $smarty->display("header.tpl");
        $smarty->display("changePass.tpl");
        $smarty->display("footer.tpl");
    
} else if (isset($_POST["newPassword"])) {
    $id = $_GET["id"];
    $tempKey = $_GET["tempKey"];

    // Čisto za dodatnu sigurnost:
        $dbObj = new DB();
        $dbResponse = $dbObj->FindKey($tempKey);

        switch ($dbResponse) {
            case DBError: {
                $smarty->assign("message", "Dogodio se problem s bazom!");
                break;
            }
            case DBUserError: {
                $smarty->assign("message", "Ovaj link je nevažeći. U slučaju pogreške kontaktirajte administratora.");
                break;
            }
            default: {
                UserControl::LogIn($dbResponse->email, $dbResponse->lozinka_citljiva);
                header("Location: ../index.php");
                exit();
            }
        }
        $smarty->display("header.tpl");
        $smarty->display("changePass.tpl");
        $smarty->display("footer.tpl");
    
} else {
    header("Location: ../index.php");
    exit();
}