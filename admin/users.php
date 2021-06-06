<?php

$pageTitle = "ZAŠTIĆENO - Ispis korisnika";
$relativePath = "../../";
require_once '../control/_page.php';

$smarty->display("header.tpl");

try {
    $dbObj = new DB();
    $userList = $dbObj->GetSelect("SELECT korisnicko_ime, prezime, ime, email, lozinka_sha256 FROM WebDiP2020x057.korisnik");
    $smarty->assign("userList", $userList);
} catch (Exception $e) {
    $smarty->assign("messageGlobal", $e->getMessage());
}
$smarty->assign("userList", $userList);
$smarty->display("users.tpl");

$smarty->display("footer.tpl");
