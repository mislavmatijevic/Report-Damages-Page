<?php
$pageTitle = "Činjenje dobroga";
require_once './control/_page.php';

$donationId;


if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}
$donationId = $_GET['id'];
settype($donationId, "integer");

try {
    $dbObj = new DB();
    $donationInfo = $dbObj->GetPrepared("SELECT jp.id_javni_poziv, jp.naziv, jp.opis, jp.datum_otvaranja, jp.skupljeno_sredstava, jp.datum_zatvaranja, oo.korisnicko_ime as moderator, k.ilustracija as kategorija_ilustracija FROM javni_poziv as jp INNER JOIN korisnik oo ON jp.id_odgovorna_osoba = oo.id_korisnik INNER JOIN kategorija_stete k ON jp.id_kategorija_stete = k.id_kategorija_stete WHERE jp.id_javni_poziv = ?", "i", [$donationId]);
    $smarty->assign("donationInfo", $donationInfo[0]);
} catch (Exception $e) {
    $smarty->assign("messageGlobal", $e->getMessage());
}

$smarty->display("header.tpl");
if (isset($donationInfo)) {
    $smarty->display("donate.tpl");
}
$smarty->display("footer.tpl");
