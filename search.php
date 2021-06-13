<?php

if (isset($_GET["all"])) {
    $pageAccessLvl = 3;
}

$pageTitle = "Završene štete";
require_once './control/_page.php';

if (isset($_GET["all"])) {
    $_SESSION["requestedCallId"] = false; // False znači pokaži sve prijavljene štete (mora biti registrirani).
}

if (isset($_GET["id"])) {
    $_SESSION["requestedCallId"] = Prevent::Injection("GET", "id");
    settype($_SESSION["requestedCallId"], "integer");
}

$publicCallId;
$isViewable = false;

if (!isset($_SESSION["requestedCallId"])) {
    header("Location: {$relativePath}index.php");
    exit();
} else {
    $publicCallId = $_SESSION["requestedCallId"];
    try {
        $dbObj = new DB();
        if ($publicCallId !== false) {
            $isClosed = $dbObj->SelectPrepared("SELECT zatvoren FROM javni_poziv WHERE id_javni_poziv = ?", "i", [$publicCallId]);
            if ($isClosed[0]["zatvoren"] != "1") {
                throw new Exception("Ovaj javni poziv još nije završen!", 1);
            }
        }
        $isViewable = true;
    } catch (Exception $e) {
        $smarty->assign("errorGlobal", $e->getMessage());
    }
}

if ($isViewable) {
    $searchCriteria = "";

    if (isset($_GET["search-string"])) {
        $searchTags = Prevent::Injection("GET", "search-string");
        $searchTags = explode(";", $searchTags);

        if ($publicCallId == false) {
            $searchCriteria = " WHERE s.oznake LIKE '%' ";
        } else { // Ovdje već postoji WHERE ključna riječ u upitu.
            $searchCriteria = " AND s.oznake LIKE '%' ";
        }

        $searchTagsString = "";
        foreach ($searchTags as $key => $tag) {
            $searchTagsString .= $tag . " ";
            $searchCriteria .= " AND s.oznake LIKE '%{$tag}%' ";
        }
        if (strlen($searchTagsString) > 0) {
            $smarty->assign("searchTagsString", $searchTagsString);
        }
    }
    
    try {
        if ($publicCallId == false) {
            $paging = new PagingControl("steta as s", "k.korisnicko_ime, s.id_steta, s.naziv, s.opis, s.oznake, s.datum_prijave, s.datum_potvrde, s.subvencija_hrk, s.id_status_stete", "INNER JOIN korisnik k ON k.id_korisnik = s.id_prijavitelj $searchCriteria ORDER BY datum_prijave DESC");
        } else {
            $paging = new PagingControl("steta as s", "k.korisnicko_ime, s.id_steta, s.naziv, s.opis, s.oznake, s.datum_prijave, s.datum_potvrde, s.subvencija_hrk, s.id_status_stete", "INNER JOIN korisnik k ON k.id_korisnik = s.id_prijavitelj WHERE s.id_javni_poziv = ? $searchCriteria", "i", [$publicCallId]);
        }

        $reportedDamages = $paging->getData();

        $dbObj = new DB();

        foreach ($reportedDamages as $key => $value) {
            $reportedDamages[$key]["dokazni_materijali"] = $dbObj->SelectPrepared("SELECT * FROM dokazni_materijali as dm INNER JOIN steta_dokazi as sd ON sd.id_materijala = dm.id_materijala AND sd.id_steta = ?", "i", [$value["id_steta"]]);
        }

        $smarty->assign("reportedDamages", $reportedDamages);
    } catch (Exception $e) {
        if ($e->getCode() === DBEmpty) {
            $smarty->assign("errorGlobal", "Tražena šteta ne postoji u bazi.");
        } else {
            $smarty->assign("errorGlobal", $e->getMessage());
        }
    }
    $smarty->display("header.tpl");
    $smarty->display("search.tpl");
}
if (isset($paging)) {
    $paging->displayControls();
}
$smarty->display("footer.tpl");
