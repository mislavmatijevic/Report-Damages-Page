<?php
$pageAccessLvl = 3;
include dirname(__DIR__)."/control/_page.php";

$dbObj = new DB;
$logObj = new Log($dbObj);
$logObj->New(NULL, "Korisnik {$_SESSION["user"]->korisnicko_ime} se odjavio.", Log::odjava, $_SESSION["user"]->id_korisnik);

UserControl::startSession();
UserControl::stopSession();


header("Location: {$relativePath}index.php");

exit();
