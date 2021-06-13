<?php
$pageTitle = "Činjenje dobroga";
require_once './control/_page.php';

$publicCallId;

if (isset($_POST["public-call-identifier"]) && isset($_POST["amount"])) {
    $publicCallId = Prevent::Injection("POST", "public-call-identifier");
    settype($publicCallId, "integer");

    $isValidCaptcha = false;
    try {
        $isValidCaptcha = UserControl::CheckCaptcha($_POST['g-recaptcha-response']);
    } catch (Exception $e) {
        $smarty->assign("messageCaptcha", $e->getMessage());
    }
    
    if ($isValidCaptcha) {
        $amountToBeDonated = Prevent::Injection("POST", "amount");
        settype($amountToBeDonated, "float");
        $amountToBeDonated = round($amountToBeDonated, 2);

        if (!preg_match("/^(\d)+(\.(\d){1,2})*$/", $amountToBeDonated)) {
            $smarty->assign("errorGlobal", "Uneseni iznos $amountToBeDonated nije ispravan!");
            $smarty->assign("message", "Unesite ispravan iznos za donaciju.<br>Ako unosite decimalne znamenke, unesite točno dvije odvojene točkom.");
        } else {
            try {
                $dbObj = new DB();
                $dbObj->MakeDonation($publicCallId, $amountToBeDonated, $_SESSION["user"]);
            } catch (Exception $e) {
                $smarty->assign("errorGlobal", $e->getMessage());
            }
        }
    }
} elseif (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: {$relativePath}index.php");
    exit();
} else {
    $publicCallId = Prevent::Injection("GET", 'id');
    settype($publicCallId, "integer");
}

try {
    $dbObj = new DB();
    $publicCallInfo = $dbObj->SelectPrepared("SELECT jp.id_javni_poziv, jp.naziv, jp.opis, jp.datum_otvaranja, jp.datum_zatvaranja, jp.skupljeno_sredstava, jp.zatvoren, oo.korisnicko_ime as moderator, k.ilustracija as kategorija_ilustracija FROM javni_poziv as jp INNER JOIN korisnik oo ON jp.id_odgovorna_osoba = oo.id_korisnik INNER JOIN kategorija_stete k ON jp.id_kategorija_stete = k.id_kategorija_stete WHERE jp.id_javni_poziv = ?", "i", [$publicCallId]);
    $publicCallInfo = $publicCallInfo[0];
    if ($publicCallInfo["zatvoren"] == 1) {
        throw new Exception("Ovaj je javni poziv istekao!");
    }
    $smarty->assign("publicCallInfo", $publicCallInfo);
} catch (Exception $e) {
    if ($e->getCode() == DBEmpty) {
        unset($publicCallId);
    }
    $smarty->assign("errorGlobal", $e->getMessage());
}

$smarty->display("header.tpl");
if (isset($publicCallId)) {
    $smarty->display("donate.tpl");
}
$smarty->display("footer.tpl");
