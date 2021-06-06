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
    $loginUser = $_POST;
    require_once("./control/login.php");
}
///////// LOGIRANJE ZA DESKTOP KORISNIKE /////////

$smarty->display("header.tpl");

try {
    $dbObj = new DB();
    $javniPozivi = $dbObj->GetSelect("SELECT jp.id_javni_poziv, jp.naziv, jp.opis, jp.datum_otvaranja, jp.skupljeno_sredstava, jp.datum_zatvaranja, oo.korisnicko_ime as moderator, k.ilustracija as kategorija_ilustracija FROM WebDiP2020x057.javni_poziv as jp INNER JOIN korisnik oo ON jp.id_odgovorna_osoba = oo.id_korisnik INNER JOIN kategorija_stete k ON jp.id_kategorija_stete = k.id_kategorija_stete ;");
    $smarty->assign("javniPozivi", $javniPozivi);
} catch (Exception $e) {
    $smarty->assign("messageGlobal", $e->getMessage());
}

$smarty->display("index.tpl");

if (isset($_SESSION["user"]) == false) {
    $smarty->assign("loginUser", $loginUser);
    $smarty->display("login-floating.tpl");
}

$smarty->display("footer.tpl");
