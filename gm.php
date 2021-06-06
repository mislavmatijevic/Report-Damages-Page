<?php

include "./control/Database.php";

$dbObj = new DB();
$obj = $dbObj->GetSelect("SELECT * FROM korisnik WHERE id_korisnik = 1");
var_dump($obj);
echo (date("d.m. H:i:s", strtotime(htmlspecialchars($obj[0]["datum_registracije"]))));

phpinfo();