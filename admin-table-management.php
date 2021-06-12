<?php
$pageAccessLvl = 1;
$pageTitle = "Upravljanje tablicama";
require_once "./control/_page.php";


try {
    $dbObj = new DB();
    $allTableNames = $dbObj->SelectPrepared("SELECT table_name FROM information_schema.tables WHERE TABLE_SCHEMA = 'WebDiP2020x057'");
    $smarty->assign("allTableNames", $allTableNames);
} catch (Exception $e) {
    echo $e->getMessage();
    die();
}

$queryInbound = false;
$query;
$argumentArray = array();
$argumentString;

if (isset($_POST["new"]) && isset($_SESSION["selectedTablename"])) {
    
    unset($_POST["new"]);
    $queryInbound = true;

    $newData = array();

    foreach ($_POST as $key => $value) {
        $newData[$key] = Prevent::Injection("POST", $key);
    }

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

if (isset($_POST["change"]) && isset($_SESSION["selectedTablename"])) {

    $rowID = Prevent::Injection("POST", "change");
    unset($_POST["change"]);
    $queryInbound = true;
    
    $updateValue = array();
    
    foreach ($_POST as $key => $value) {
        $updateValue[$key] = Prevent::Injection("POST", $key);
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
        if ($updateValue[$tableHeader[$i]["Field"]] === null) {
            $argumentString[$i-1] = "s";
        }
    }

    $argumentString .= "i"; // Za id na kraju (WHERE uvjet).
    $updateValue["id_korisnik"] = $rowID;

    foreach ($updateValue as $key => $value) {
        $argumentArray[] = $value;
    }
}

if (isset($_POST["delete"]) && isset($_SESSION["selectedTablename"])) {
    $updateValue = Prevent::Injection("POST", "delete");
    $queryInbound = true;

    $tableName = $_SESSION["selectedTablename"];

    $fieldName = explode("-", $updateValue)[0];
    $idDelete = explode("-", $updateValue)[1];

    $query = "DELETE FROM $tableName WHERE ($fieldName = ?)";
    $argumentString = "i";
    $argumentArray = [$idDelete];
}

if ($queryInbound) {
    try {
        $dbObj->ExecutePrepared($query, $argumentString, $argumentArray);
        $smarty->assign("infoGlobal", "Izvršen je upit<br>$query<br>s prepared argumentima tipa<br>\"$argumentString\"<br>s vrijednostima<br>" . print_r($argumentArray, true));
    } catch (Exception $e) {
        $smarty->assign("errorGlobal", $e->getMessage());
    }
}

$smarty->display("header.tpl");
$smarty->display("admin-table-list.tpl");

if (!empty($_GET["table-name"])) {
    $_SESSION["selectedTablename"] = Prevent::Injection("GET", "table-name");
}

if (!empty($_SESSION["selectedTablename"])) {
    $tableName = $_SESSION["selectedTablename"];
    $paging = new PagingControl($tableName, "*");
    
    try {
        $tableHeader = $dbObj->SelectPrepared("DESCRIBE $tableName");
        $tableData = $paging->getData();
        $smarty->assign("tableName", $tableName);
        $smarty->assign("tableHeader", $tableHeader);
        $smarty->assign("tableData", $tableData);
    } catch (Exception $e) {
        $smarty->assign("errorGlobal", $e->getMessage());
    }
}



if (isset($paging)) {
    $paging->displayControls();
}

$smarty->display("admin-table-management.tpl");

if (isset($paging)) {
    $paging->displayControls();
}

$smarty->display("footer.tpl");
