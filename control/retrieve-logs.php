<?php

ob_clean();
header_remove();
header("Content-type: application/json; charset=utf-8");
http_response_code(200);

require_once dirname(__DIR__)."/control/Database.php";
require_once dirname(__DIR__)."/control/OutputControl.php";


try {
    $dbObj = new DB;
} catch (Exception $e) {
    die(json_encode(-1)); // -1, a ne false, jer 0==false :(
}

$confFilePath = dirname(__DIR__)."/privatno/config/manage.conf";
$config = parse_ini_file($confFilePath);
$configItemsPerPage = $config["maxItemsPerPage"];

if (isset($_POST['all'])) {

    if (isset($_POST['max_page'])) {
        try {
            $databaseData = $dbObj->SelectPrepared("SELECT COUNT(*) FROM dnevnik");
            $numberOfRows = $databaseData[0]["COUNT(*)"];
            $highestPage = ceil($numberOfRows / $configItemsPerPage) - 1;
            die(json_encode($highestPage));
        } catch (Exception $e) {
            die(json_encode(-1));
        }
    }

    $currentPage = 0;
    if (isset($_POST['page'])) {
        $currentPage = Prevent::Injection("POST", "page");
    }

    try {
        $offset = $currentPage * $configItemsPerPage;
        $userActions = $dbObj->SelectPrepared("SELECT id_dnevnik, k.korisnicko_ime, tp.naziv as naziv_radnje, d.* FROM dnevnik as d INNER JOIN korisnik k ON k.id_korisnik = d.id_izvrsitelj INNER JOIN tip_radnje tp ON tp.id_tip = id_radnja ORDER BY datum_vrijeme DESC LIMIT ?, ?", "ii", [$offset, $configItemsPerPage]);
        die(json_encode($userActions));
    } catch (Exception $e) {
        die(json_encode(-1));
    }
}

if (isset($_POST['username'])) {
    $username = Prevent::Injection("POST", "username");
    try {
        $userInfo = $dbObj->GetUserData($username);
    } catch (Exception $ex) {
        die(json_encode(-1));
    }

    if (isset($_POST['max_page'])) {
        try {
            $databaseData = $dbObj->SelectPrepared("SELECT COUNT(*) FROM dnevnik WHERE id_izvrsitelj = ? ", "i", [$userInfo->id_korisnik]);
            $numberOfRows = $databaseData[0]["COUNT(*)"];
            $highestPage = ceil($numberOfRows / $configItemsPerPage) - 1;
            die(json_encode($highestPage));
        } catch (Exception $e) {
            die(json_encode(-1));
        }
    }

    $currentPage = 0;
    if (isset($_POST['page'])) {
        $currentPage = Prevent::Injection("POST", "page");
    }

    try {
        $offset = $currentPage * $configItemsPerPage;
        $userActions = $dbObj->SelectPrepared("SELECT k.korisnicko_ime, tp.naziv as naziv_radnje, d.* FROM dnevnik as d INNER JOIN korisnik k ON k.id_korisnik = d.id_izvrsitelj INNER JOIN tip_radnje tp ON tp.id_tip = id_radnja WHERE d.id_izvrsitelj = ? LIMIT ?, ?", "iii", [$userInfo->id_korisnik, $offset, $configItemsPerPage]);
        die(json_encode($userActions));
    } catch (Exception $e) {
        die(json_encode(-1));
    }
}

if (isset($_POST['frequency'])) {
    if (isset($_POST['max_page'])) {
        die(json_encode(0)); // Radi kompatibilnosti s ostalim Javascript kodom, reci da postoji samo jedna stranica.
    }
    try {
        $frequency = $dbObj->SelectPrepared("SELECT k.korisnicko_ime, tr.naziv, COUNT(*) as akcije FROM dnevnik INNER JOIN korisnik k ON k.id_korisnik = id_izvrsitelj INNER JOIN tip_radnje tr ON tr.id_tip = id_radnja GROUP BY id_izvrsitelj, id_radnja ORDER BY count(*) DESC;");
        die(json_encode($frequency));
    } catch (Exception $e) {
        die(json_encode(-1));
    }
}

if (isset($_POST['date'])) {
    $selectedDate = Prevent::Injection("POST", "date");
    $dateFrom = $selectedDate . " 00:00:00";
    $dateTo = $selectedDate . " 23:59:59";

    if (isset($_POST['max_page'])) {
        try {
            $databaseData = $dbObj->SelectPrepared("SELECT COUNT(*) FROM dnevnik WHERE datum_vrijeme BETWEEN ? AND ?", "ss", [$dateFrom, $dateTo]);
            $numberOfRows = $databaseData[0]["COUNT(*)"];
            $highestPage = ceil($numberOfRows / $configItemsPerPage) - 1;
            die(json_encode($highestPage));
        } catch (Exception $e) {
            die(json_encode(-1));
        }
    }

    try {
        $frequency = $dbObj->SelectPrepared("SELECT id_dnevnik, k.korisnicko_ime, tp.naziv as naziv_radnje, d.* FROM dnevnik as d INNER JOIN korisnik k ON k.id_korisnik = d.id_izvrsitelj INNER JOIN tip_radnje tp ON tp.id_tip = id_radnja WHERE datum_vrijeme BETWEEN ? AND ? ORDER BY datum_vrijeme ASC LIMIT ?, ?", "ssii", [$dateFrom, $dateTo, $offset, $configItemsPerPage]);
        die(json_encode($frequency));
    } catch (Exception $e) {
        die(json_encode(-1));
    }
}