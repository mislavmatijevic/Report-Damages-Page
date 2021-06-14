<?php
$pageAccessLvl = 2;
$pageTitle = "Moje kategorije";
require_once './control/_page.php';

$paging = new PagingControl("javni_poziv as jp", "jp.*, ks.naziv as kategorija_naziv", "INNER JOIN moderator_kategorije mk ON mk.id_kategorija_stete = jp.id_kategorija_stete AND jp.id_odgovorna_osoba = {$_SESSION["user"]->id_korisnik} AND mk.id_moderator = {$_SESSION["user"]->id_korisnik} INNER JOIN kategorija_stete ks WHERE ks.id_kategorija_stete = jp.id_kategorija_stete");

try {
    $javniPozivi = $paging->getData();
    $smarty->assign("javniPozivi", $javniPozivi);
} catch (Exception $e) {
    if ($e->getCode() !== DBEmpty) { // Nemoj javljati pogrešku da ništa nije dohvaćeno.
        $smarty->assign("errorGlobal", $e->getMessage());
    }
}

$smarty->display("header.tpl");
$smarty->display("moderation.tpl");

if (isset($paging)) {
    $paging->displayControls();
}
$smarty->display("footer.tpl");
