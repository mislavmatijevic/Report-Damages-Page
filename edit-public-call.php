<?php
$pageAccessLvl = 3;
$pageTitle = "Prijava štete";
require_once './control/_page.php';

$publicCallId;
$currentCall;
$materialTypes;
$mistakeField = array();

function checkEligibility(int $publicCallId)
{
    global $currentCall;
    $dbObj = new DB();
    $currentCall = $dbObj->SelectPrepared("SELECT jp.*, oo.id_korisnik as id_moderator FROM javni_poziv as jp INNER JOIN korisnik oo ON jp.id_odgovorna_osoba = oo.id_korisnik INNER JOIN kategorija_stete k ON jp.id_kategorija_stete = k.id_kategorija_stete WHERE jp.id_javni_poziv = ?", "i", [$publicCallId]);
    $currentCall = $currentCall[0];
    if ($currentCall["zatvoren"] == 1) {
        throw new Exception("Ovaj je javni poziv zatvoren!");
    }
    if ($currentCall["id_moderator"] != $_SESSION["user"]->id_korisnik) {
        throw new Exception("Nemate ovlasti uređivati ovaj javni poziv!");
    }
}


if (isset($_POST["public-call-identifier"])) {
    $publicCallId = Prevent::Injection("POST", "public-call-identifier");
    settype($publicCallId, "integer");

    $updatedCallName = Prevent::Injection("POST", "name");
    $updatedCallDesc = Prevent::Injection("POST", "description");
    $updatedStatus = Prevent::Injection("POST", "closed");
    settype($updatedStatus, "integer");
    if ($updatedStatus !== 1) {
        $updatedStatus = 0;
    }
    $startDate = Prevent::Injection("POST", "start-date");
    $startTime = Prevent::Injection("POST", "start-time");
    $start = strtotime($startDate . " " . $startTime);
    $deadlineDate = Prevent::Injection("POST", "deadline-date");
    $deadlineTime = Prevent::Injection("POST", "deadline-time");

    try {
        checkEligibility($publicCallId);

        if (empty($deadlineDate) || empty($deadlineTime)) {
            throw new Exception("Rokovi nisu u potpunosti uneseni.", 1);
        }
        if (($deadline = strtotime($deadlineDate . " " . $deadlineTime)) == false) {
            throw new Exception("Odabran rok nije ispravan!", 1);
        }
        if ($start > $deadline) {
            throw new Exception("Ne možete pomaknuti datum završetka prije početka!", 1);
        }
        if ((time() + $config["virtualTimeOffsetSeconds"]) > $deadline) {
            throw new Exception("Ne možete pomaknuti datum završetka prije ovog trenutka!", 1);
        }
        if (strlen($updatedCallName) < 3 || strlen($updatedCallName) > 45) {
            throw new Exception("Provjerite naziv!", 1);
        }
        if (strlen($updatedCallDesc) < 3) {
            throw new Exception("Opis je prekratak!", 1);
        }

        $deadline = date("Y-m-d H:i:s", $deadline);

        $argArray = [$updatedCallName, $updatedCallDesc, $deadline, $updatedStatus, $publicCallId];

        $dbObj = new DB();
        $dbObj->ExecutePrepared("UPDATE `WebDiP2020x057`.`javni_poziv` SET `naziv` = ?, `opis` = ?, `datum_zatvaranja` = ?, `zatvoren` = ? WHERE (`id_javni_poziv` = ?);
        ", "sssii", $argArray);
        $smarty->assign("infoGlobal", "Poziv ažuriran!");
    } catch (Exception $e) {
        $smarty->assign("errorGlobal", $e->getMessage());
    }
} elseif (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $publicCallId = Prevent::Injection("GET", "id");
    settype($publicCallId, "integer");
} else {
    $smarty->assign("errorGlobal", "Nije odabran javni poziv!");
}

$allowedToChange = false;

try {
    checkEligibility($publicCallId);
    $allowedToChange = true;
} catch (Exception $e) {
    $smarty->assign("errorGlobal", $e->getMessage());
}

$smarty->display("header.tpl");

if ($allowedToChange && isset($currentCall)) {
    $currentCall["open_date"] = explode(" ", $currentCall["datum_otvaranja"])[0];
    $currentCall["open_time"] = explode(" ", $currentCall["datum_otvaranja"])[1];
    $currentCall["close_date"] = explode(" ", $currentCall["datum_zatvaranja"])[0];
    $currentCall["close_time"] = explode(" ", $currentCall["datum_zatvaranja"])[1];
    $smarty->assign("currentCall", $currentCall);
    $smarty->display("edit-public-call.tpl");
}

$smarty->display("footer.tpl");
