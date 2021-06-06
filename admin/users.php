<?php

$pageTitle = "ZAŠTIĆENO - Ispis korisnika";
$relativePath = "../../";
require_once '../control/_page.php';
require_once '../control/paging.php';

$smarty->display("header.tpl");

$paging = new PagingControl("korisnik", "korisnicko_ime, prezime, ime, email, lozinka_sha256");

try {
    $userList = $paging->getData();
    $smarty->assign("userList", $userList);
    $paging->displayControls();
} catch (Exception $e) {
    $smarty->assign("messageGlobal", $e->getMessage());
}

$smarty->display("users.tpl");
if (isset($paging)) {
    $paging->displayControls();
}
$smarty->display("footer.tpl");
