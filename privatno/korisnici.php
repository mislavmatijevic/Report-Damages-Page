<?php

$pageTitle = "ZAŠTIĆENO - Ispis korisnika";
$relativePath = "../";
require_once '../control/_page.php';

$paging = new PagingControl("korisnik", "korisnicko_ime, prezime, ime, email, lozinka_sha256");

try {
    $userList = $paging->getData();
    $smarty->assign("userList", $userList);
} catch (Exception $e) {
    $smarty->assign("errorGlobal", $e->getMessage());
}

$smarty->display("header.tpl");
if (isset($paging)) {
    $paging->displayControls();
}
$smarty->display("users.tpl");
if (isset($paging)) {
    $paging->displayControls();
}
$smarty->display("footer.tpl");
