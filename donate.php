<?php
$pageTitle = "Činjenje dobroga";
require_once './control/_page.php';

$donationId;

if (isset($_POST["donation-identifier"]) && isset($_POST["amount"])) {
    $donationId = Prevent::Injection("POST", "donation-identifier");
    settype($donationId, "integer");

    $isValidCaptcha = true;
    try {
        //$isValidCaptcha = UserControl::CheckCaptcha($_POST['g-recaptcha-response']);
    } catch (Exception $e) {
        $smarty->assign("messageCaptcha", $e->getMessage());
    }
    
    if ($isValidCaptcha) {
        $amountToBeDonated = Prevent::Injection("POST", "amount");
        settype($amountToBeDonated, "float");
        $amountToBeDonated = round($amountToBeDonated, 2);

        if (!preg_match("/^(\d)+(\.(\d){1,2})*$/", $amountToBeDonated)) {
            $smarty->assign("messageGlobal", "Uneseni iznos $amountToBeDonated nije ispravan!");
            $smarty->assign("message", "Unesite ispravan iznos za donaciju.<br>Ako unosite decimalne znamenke, unesite točno dvije odvojene točkom.");
        } else {
            try {
                $dbObj = new DB();
                $dbObj->MakeDonation($donationId, $amountToBeDonated, $_SESSION["user"]);
            } catch (Exception $e) {
                $smarty->assign("messageGlobal", $e->getMessage());
            }
        }
    }
} elseif (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
} else {
    $donationId = Prevent::Injection("GET", 'id');
    settype($donationId, "integer");
}

try {
    $dbObj = new DB();
    $donationInfo = $dbObj->SelectPrepared("SELECT jp.id_javni_poziv, jp.naziv, jp.opis, jp.datum_otvaranja, jp.datum_zatvaranja, jp.skupljeno_sredstava, jp.zatvoren, oo.korisnicko_ime as moderator, k.ilustracija as kategorija_ilustracija FROM javni_poziv as jp INNER JOIN korisnik oo ON jp.id_odgovorna_osoba = oo.id_korisnik INNER JOIN kategorija_stete k ON jp.id_kategorija_stete = k.id_kategorija_stete WHERE jp.id_javni_poziv = ?", "i", [$donationId])[0];
    if ($donationId["zatvoren"] == 1) {
        throw new Exception("Ovaj je javni poziv istekao!");
    }
    $smarty->assign("donationInfo", $donationInfo);
} catch (Exception $e) {
    $smarty->assign("messageGlobal", $e->getMessage());
}

$smarty->display("header.tpl");
if (isset($donationInfo)) {
    $smarty->display("donate.tpl");
}
$smarty->display("footer.tpl");
