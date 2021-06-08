<?php
$pageTitle = "Početna stranica";
require_once './control/_page.php';

///////// LOGIRANJE ZA DESKTOP KORISNIKE /////////
$isLoggedIn = false;
$loginUser = null;

if (isset($_COOKIE["user"])) {
    $loginUser["username"] = $_COOKIE["user"];
    $smarty->assign("setRemember", true);
}

// Za test:
if (isset($_POST['testing'])) {
    try {
        if (isset($_POST["admin"])) {
            $isLoggedIn = UserControl::LogIn("mmatijevi", "test1");
        } elseif (isset($_POST["moderator"])) {
            $isLoggedIn = UserControl::LogIn("aanic2", "anica2");
        } elseif (isset($_POST["registered"])) {
            $isLoggedIn = UserControl::LogIn("mmatijac3", "matejftw3");
        }
    } catch (Exception $e) {
        $smarty->assign("message", $e->getMessage());
    } finally {
        if ($isLoggedIn === USER_CONTROL_SUCCESS) {
            header("Location: index.php");
            exit();
        }
    }
// Pravi login:
} elseif (isset($_POST['login'])) {
    require_once("./control/login.php");
}
///////// LOGIRANJE ZA DESKTOP KORISNIKE /////////



try {
    $dbObj = new DB();
    $acceptanceStats = $dbObj->SelectPrepared("SELECT k.naziv, COUNT(*) as count, s.naziv as status FROM steta INNER JOIN kategorija_stete k ON k.id_kategorija_stete = steta.id_kategorija_stete INNER JOIN status_stete s ON steta.id_status_stete = s.id_status_stete GROUP BY k.naziv, s.id_status_stete;");
    $smarty->assign("acceptanceStats", $acceptanceStats);
} catch (Exception $e) {
    $smarty->assign("messageGlobal", $e->getMessage());
}

$paging = new PagingControl("javni_poziv as jp", "jp.id_javni_poziv, jp.naziv, jp.opis, jp.datum_otvaranja, jp.datum_zatvaranja, jp.zatvoren, k.ilustracija as kategorija_ilustracija", "INNER JOIN kategorija_stete k ON jp.id_kategorija_stete = k.id_kategorija_stete");

try {
    $javniPozivi = $paging->getData();
    $smarty->assign("javniPozivi", $javniPozivi);
} catch (Exception $e) {
    $smarty->assign("messageGlobal", $e->getMessage());
}

$smarty->display("header.tpl");
$smarty->display("index.tpl");

if (isset($_SESSION["user"]) == false) {
    $smarty->assign("loginUser", Prevent::XSS($loginUser));
    $smarty->display("login-floating.tpl");
}
if (isset($paging)) {
    $paging->displayControls();
}
$smarty->display("footer.tpl");
