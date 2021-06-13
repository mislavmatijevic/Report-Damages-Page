<?php

ob_clean();
header_remove();
header("Content-type: application/json; charset=utf-8");
http_response_code(200);

require_once dirname(__DIR__)."/control/Database.php";
require_once dirname(__DIR__)."/control/OutputControl.php";
require_once dirname(__DIR__)."/control/UserControl.php";

$confFilePath = dirname(__DIR__)."/privatno/config/manage.conf";
$config = parse_ini_file($confFilePath);

if (isset($_POST["getCookieDuration"])) {
    die(json_encode($config["cookieDurationDays"]));
}

session_start();
if ($_SESSION["lvl"] != 1) {
    die(json_encode("Nedovoljne ovlasti!"));
}

$confFilePath = dirname(__DIR__)."/privatno/config/manage.conf";
$config = parse_ini_file($confFilePath);
$configItemsPerPage = $config["maxItemsPerPage"];

$dbObj = new DB;

// Vraća popis svih tablica iz sheme
if (isset($_POST["getTableList"])) {
    try {
        $allTableNames = $dbObj->SelectPrepared("SELECT table_name FROM information_schema.tables WHERE TABLE_SCHEMA = 'WebDiP2020x057'");
        die(json_encode($allTableNames));
    } catch (Exception $e) {
        die(json_encode(false));
    }
}

$queryInbound = false;
$query;
$argumentArray = array();
$argumentString;

if (isset($_POST["newRowData"]) && isset($_SESSION["selectedTablename"])) {
    
    $newData = json_decode(Prevent::Injection("POST", "newRowData"), true);
    $queryInbound = true;

    foreach ($newData as $key => $value) {
        if ($value === "") {
            $newData[$key] = null;
        }
    }

    $tableName = $_SESSION["selectedTablename"];
    $tableHeader = $dbObj->SelectPrepared("DESCRIBE $tableName");


    $queryValues = " VALUES (?";
    $argumentCount = 1;
    while ($argumentCount < count($tableHeader)-1) {
        $queryValues .= ", ?";
        $argumentCount++;
    }

    $queryValues .= ")";

    $queryStart = "INSERT INTO $tableName (" . $tableHeader[1]["Field"];
    for ($i=2; $i <= $argumentCount; $i++) {
        $queryStart .= ", " . $tableHeader[$i]["Field"];
    }
    $queryStart .= ")";

    $query = $queryStart . $queryValues;

    $argumentString = "";
    for ($i=1; $i < $argumentCount+1; $i++) {
        switch (substr($tableHeader[$i]["Type"], 0, 3)) {
            case "var":
            case "cha":
            case "tim": {
                $argumentString .= "s";
                break;
            }
            case "tin":
            case "int": {
                $argumentString .= "i";
                break;
            }
        }
    }

    for ($i=1; $i < count($tableHeader); $i++) { 
        if ($newData[$tableHeader[$i]["Field"]] === null) {
            $argumentString[$i-1] = "s";
        }
    }

    foreach ($newData as $key => $value) {
        $argumentArray[] = $value;
    }
}

if (isset($_POST["updateRow"]) && $_POST["rowId"] && isset($_SESSION["selectedTablename"])) {

    $rowID = Prevent::Injection("POST", "rowId");
    $pureJSONDate = Prevent::Injection("POST", "updateRow");

    $receivedData = json_decode($pureJSONDate, true);

    unset($_POST["change"]);
    $queryInbound = true;
    
    $updateValue = array();
    
    foreach ($receivedData as $key => $value) {
        $updateValue[$key] = $value;
    }
    
    foreach ($updateValue as $key => $value) {
        if ($value === "") {
            $updateValue[$key] = null;
        }
    }

    $tableName = $_SESSION["selectedTablename"];
    $tableHeader = $dbObj->SelectPrepared("DESCRIBE $tableName");

    $query = "UPDATE $tableName SET " . $tableHeader[1]["Field"] . " = ?";
    $argumentCount = 2;
    while ($argumentCount < count($tableHeader)) {
        $query .= ", " . $tableHeader[$argumentCount++]["Field"] . " = ?";
    }

    $query .= " WHERE " . $tableHeader[0]["Field"] . " = ?";

    $argumentString = "";
    for ($i=1; $i < count($tableHeader); $i++) {
        switch (substr($tableHeader[$i]["Type"], 0, 3)) {
            case "tin":
            case "int": {
                $argumentString .= "i";
                break;
            }
            case "flo": {
                $argumentString .= "d";
                break;
            }
            default: {
                $argumentString .= "s";
                break;
            }
        }
    }

    for ($i=1; $i < count($tableHeader); $i++) { 
        if ($updateValue[$tableHeader[$i]["Field"]] === null) {
            $argumentString[$i] = "s";
        }
    }

    $argumentString .= "i"; // Za id na kraju (WHERE uvjet).
    $updateValue["id_row"] = $rowID;

    foreach ($updateValue as $key => $value) {
        $argumentArray[] = $value;
    }
}

if (isset($_POST["deleteFieldIdentifier"]) && isset($_POST["deleteRowId"]) && isset($_SESSION["selectedTablename"])) {

    $fieldName = Prevent::Injection("POST", "deleteFieldIdentifier");
    $rowId = Prevent::Injection("POST", "deleteRowId");
    $queryInbound = true;

    $tableName = $_SESSION["selectedTablename"];

    $query = "DELETE FROM $tableName WHERE ($fieldName = ?)";
    $argumentString = "i";
    $argumentArray = [$rowId];
}

if ($queryInbound) {
    try {
        $dbObj->ExecutePrepared($query, $argumentString, $argumentArray);
        die(json_encode("Izvršen je upit<br>$query<br>s prepared argumentima tipa<br>\"$argumentString\"<br>s vrijednostima<br>" . print_r($argumentArray, true)));
    } catch (Exception $e) {
        die(json_encode(false));
    }
}

if (!empty($_POST["getTableHeader"])) {
    $_SESSION["selectedTablename"] = Prevent::Injection("POST", "getTableHeader");
    $tableName = $_SESSION["selectedTablename"];
    try {
        $tableHeader = $dbObj->SelectPrepared("DESCRIBE $tableName");
        die(json_encode($tableHeader));
    } catch (Exception $e) {
        die(json_encode(false));
    }
}


// Filtriranje 
if (isset($_POST["dataManipulation"])) {

    $tableName = $_SESSION["selectedTablename"];

    if (isset($_POST['max_page'])) {
        try {
            $databaseData = $dbObj->SelectPrepared("SELECT COUNT(*) FROM $tableName");
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

    $criteria = "";

    if (isset($_POST['sortDir']) && isset($_POST['rowName'])) {
        $sortRowName = Prevent::Injection("POST", "rowName");
        $sortDir = Prevent::Injection("POST", "sortDir");
        $criteria = " ORDER BY $sortRowName $sortDir ";
    } else if (isset($_POST['searchString']) && isset($_POST['searchRow'])) {
        $searchRow = Prevent::Injection("POST", "searchRow");
        $searchString = Prevent::Injection("POST", "searchString");
        $criteria = " WHERE $searchRow LIKE '%$searchString%' ";
    }

    try {
        $offset = $currentPage * $configItemsPerPage;
        $userActions = $dbObj->SelectPrepared("SELECT * FROM $tableName $criteria LIMIT ?, ?", "ii", [$offset, $configItemsPerPage]);
        die(json_encode($userActions));
    } catch (Exception $e) {
        if ($e->getCode() == DBEmpty) {
            die(json_encode(0));
        }
        die(json_encode(-1));
    }
}