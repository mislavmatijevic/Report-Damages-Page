<?php
$pageAccessLvl = 3;
$pageTitle = "Stvaranje javnog poziva";
require_once './control/_page.php';

$publicCallId;
$newCall;
$materialTypes;
$mistakeField = array();
$allowedCategories = array();

try {
    $dbObj = new DB();
    $allowedCategories = $dbObj->SelectPrepared("SELECT mk.id_kategorija_stete, k.naziv FROM WebDiP2020x057.moderator_kategorije as mk INNER JOIN kategorija_stete k ON mk.id_kategorija_stete = k.id_kategorija_stete  WHERE id_moderator = ?", "i", [$_SESSION["user"]->id_korisnik]);
} catch (Exception $e) {
    $smarty->assign("errorGlobal", $e->getMessage());
}

if (isset($_POST["submit"])) {
    $newCall["name"] = Prevent::Injection("POST", "name");
    $newCall["category"] = Prevent::Injection("POST", "category");
    $newCall["description"] = Prevent::Injection("POST", "description");
    $newCall["deadlineDate"] = Prevent::Injection("POST", "deadline-date");
    $newCall["deadlineTime"] = Prevent::Injection("POST", "deadline-time");

    try {
        if (empty($newCall["deadlineDate"]) || empty($newCall["deadlineTime"])) {
            throw new Exception("Odaberite puni rok!", 1);
        }

        if (($newCall["deadline"] = strtotime($newCall["deadlineDate"] . " " . $newCall["deadlineTime"])) == false) {
            throw new Exception("Odabrani rok nije ispravan!", 1);
        }
        if ($newCall["deadline"] < (time() + $config["virtualTimeOffsetSeconds"])) {
            throw new Exception("Ne možete postaviti datum početka prije današnjeg datuma!", 1);
        }

        if (strlen($newCall["name"]) < 3 || strlen($newCall["name"]) > 45) {
            throw new Exception("Provjerite naziv!", 1);
        }
        if (strlen($newCall["description"]) < 3) {
            throw new Exception("Opis je prekratak!", 1);
        }

        $startTime = date("Y-m-d H:i:s", time() + $config["virtualTimeOffsetSeconds"]);
        $deadline = date("Y-m-d H:i:s", $newCall["deadline"]);

        $argArray = [$newCall["name"], $newCall["description"], $startTime, $deadline, $_SESSION["user"]->id_korisnik, $newCall["category"]];

        $dbObj = new DB();
        $newCallId = $dbObj->ExecutePrepared("INSERT INTO `WebDiP2020x057`.`javni_poziv` (`naziv`, `opis`, `datum_otvaranja`, `datum_zatvaranja`, `id_odgovorna_osoba`, `id_kategorija_stete`) VALUES (?, ?, ?, ?, ?, ?)", "ssssii", $argArray, true);

        $dbObj = new DB();
        $logObj = new Log($dbObj);
        $logObj->New("", "Moderator {$_SESSION["user"]->korisnicko_ime} je otvorio javni poziv pod šifrom $newCallId.", Log::otvaranje_javnog_poziva);

        $_SESSION["infoGlobal"] = "Poziv dodan pod šifrom $newCallId!";
        header("Location: {$relativePath}moderation.php");
        exit();
    } catch (Exception $e) {
        $smarty->assign("errorGlobal", $e->getMessage());
    }
}

$smarty->display("header.tpl");

if (isset($newCall)) {
    $smarty->assign("newCall", $newCall);
}
$smarty->assign("allowedCategories", $allowedCategories);
$smarty->display("create-public-call.tpl");

$smarty->display("footer.tpl");
