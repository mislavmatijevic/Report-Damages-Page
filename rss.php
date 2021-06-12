<?php

require_once "./control/constants.php";
require_once "./control/Database.php";

header('Content-type: application/xml');
echo "<rss version='2.0' xmlns:atom='http://www.w3.org/2005/Atom'>\n";
echo "<channel>\n";
echo '<atom:link href="'.$urlToRoot.$fullScriptName.'" rel="self" type="application/rss+xml" />' . "\n";

echo "<title>Štete RSS</title>\n";
echo "<description>10 posljednjih prijavljenih šteta</description>\n";
echo "<link>https://barka.foi.hr/WebDiP/2020/zadaca_04/mmatijevi/</link>\n";
echo "<language>hr</language>";
echo "<webMaster>mmatijevi@foi.hr (Mislav Matijević)</webMaster>";

$dbObj = new DB;

$popis_steta = $dbObj->SelectPrepared("SELECT k.korisnicko_ime, s.id_steta, s.naziv, s.opis, s.oznake, s.datum_prijave FROM steta s INNER JOIN korisnik k ON k.id_korisnik = s.id_prijavitelj ORDER BY s.id_steta DESC;");

$brojac = 10;

foreach ($popis_steta as $key => $value) {
    if ($brojac == 0) break;

    echo "<item>\n";
    echo "<title>{$value["naziv"]}</title>\n";
    echo "<description>{$value["opis"]}</description>\n";

    $RFC822Datum = date("r", strtotime($value["datum_prijave"]));
    echo "<pubDate>{$RFC822Datum}</pubDate>\n";

    echo "<guid>{$value["korisnicko_ime"]}</guid>\n";
    echo "<guid>{$value["oznake"]}</guid>\n";
    echo "</item>\n";

    $brojac--;
}

echo "</channel>\n";
echo "</rss>\n";
