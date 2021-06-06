<?php

include "./control/Database.php";

$dbObj = new DB();
$obj = $dbObj->GetSelect("SELECT * FROM korisnik WHERE id_korisnik = 1");
var_dump($obj);
echo (time() - strtotime($obj[0]["datum_registracije"]))/60/60;

phpinfo();