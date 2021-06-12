<?php
$pageAccessLvl = 3;
$pageTitle = "Stvaranje javnog poziva";
require_once './control/_page.php';

$currentCallId;
$currentCall;
$materialTypes;
$mistakeField = array();

function checkEligibility(int $publicCallId)
{
    global $currentCall;
    global $smarty;
    $dbObj = new DB();
    $currentCall = $dbObj->SelectPrepared("SELECT jp.*, oo.id_korisnik as id_moderator FROM javni_poziv as jp INNER JOIN korisnik oo ON jp.id_odgovorna_osoba = oo.id_korisnik INNER JOIN kategorija_stete k ON jp.id_kategorija_stete = k.id_kategorija_stete WHERE jp.id_javni_poziv = ?", "i", [$publicCallId]);
    $currentCall = $currentCall[0];
    if ($currentCall["zatvoren"] == 1) {
        throw new Exception("Ovaj je javni poziv zatvoren!");
    }
    if ($currentCall["id_moderator"] != $_SESSION["user"]->id_korisnik) {
        throw new Exception("Nemate ovlasti uređivati ovaj javni poziv!");
    }
    $smarty->assign("callName", $currentCall["naziv"]);
    $smarty->assign("remainingSubvention", $currentCall["skupljeno_sredstava"]);
}

$allowedToChange = false;

if (isset($_POST["fund"])) {
    $allowedToChange = true;
    $damageId = Prevent::Injection("POST", "damageId");
    $amount = Prevent::Injection("POST", "amount");
    $currentCallId = Prevent::Injection("POST", "current-call");
    checkEligibility($currentCallId);
    try {
        if (!preg_match("/^(\d)+(\.(\d){1,2})*$/", $amount)) {
            throw new Exception("Iznos subvencije nije ispravan. Decimalne znamenke dijelite točkom!", 1);
        } 
        if ($damageId <= 0) {
            throw new Exception("Šifra nije ispravna!", 1);
        }
    } catch (Exception $e) {
        $smarty->assign("errorGlobal", $e->getMessage());
    }
} elseif (isset($_POST["remove"])) {
}


if (isset($_GET['id'])) {
    $currentCallId = Prevent::Injection("GET", "id");
    try {
        $dbObj = new DB();
        checkEligibility($currentCallId);
        $allowedToChange = true;
    } catch (Exception $e) {
        $smarty->assign("errorGlobal", $e->getMessage());
    }
}

$smarty->display("header.tpl");
if ($allowedToChange) {
    try {
        $paging = new PagingControl("steta", "k.korisnicko_ime, s.id_steta, s.naziv, s.opis, s.oznake, s.datum_prijave", "as s INNER JOIN korisnik k ON k.id_korisnik = s.id_prijavitelj WHERE s.id_javni_poziv = {$currentCallId}");
        $allDamages = $paging->getData();
        $smarty->assign("currentCallId", $currentCallId);
        $smarty->assign("allDamages", $allDamages);
        $smarty->display("fund-damages.tpl");
    } catch (Exception $e) {
        $smarty->assign("errorGlobal", $e->getMessage());
    }
}
$paging->displayControls();
$smarty->display("footer.tpl");
