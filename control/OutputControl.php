<?php

require_once dirname(__DIR__) . "/control/_page.php";
require_once dirname(__DIR__) . "/control/Database.php";

function purify(&$value)
{
    $value = trim($value);
    $value = stripslashes($value);
    $value = htmlspecialchars($value, ENT_NOQUOTES, "UTF-8");
}

class Prevent
{
    public static function XSS($object)
    {
        if (is_array($object)) {
            array_walk_recursive($object, 'purify');
        } elseif (is_object($object)) {
            foreach ($object as $key => $element) {
                purify($element);
            }
        } else {
            purify($object);
        }
        return $object;
    }
    public static function Injection(string $inputSource, string $key)
    {
        switch ($inputSource) {
            case 'GET':
                $cleanValue = filter_input(INPUT_GET, $key);
                break;

            case 'POST':
                $cleanValue = filter_input(INPUT_POST, $key);
                break;

            case 'COOKIE':
                $cleanValue = filter_input(INPUT_COOKIE, $key);
                break;
        }

        return self::XSS($cleanValue);
    }
}

class PagingControl
{
    private $tableData = '';
    private $tableName = null;
    private $configItemsPerPage = 10;
    private $dbObj;
    private $smarty;
    private $currentPage;

    public function __construct(string $tableName, string $tableData, string $additional = "")
    {
        global $confFilePath;
        global $smarty;
        $this->smarty = $smarty;
        $this->tableData = $tableData;
        $this->tableName = $tableName . " " . $additional;

        $config = parse_ini_file($confFilePath);
        $this->configItemsPerPage = $config["maxItemsPerPage"];
        $this->dbObj = new DB();

        $databaseData = $this->dbObj->SelectPrepared("SELECT COUNT(*) FROM $this->tableName");
        $numberOfRows = $databaseData[0]["COUNT(*)"];
        $highestPage = ceil($numberOfRows / $this->configItemsPerPage) - 1;
        $smarty->assign("maxPage", $highestPage);

        $this->currentPage = 0;
        if (isset($_GET["page"])) {
            $this->currentPage = Prevent::Injection("GET", "page");
            settype($this->currentPage, "integer");
            if ($this->currentPage < 0 || !is_numeric($this->currentPage)) {
                $this->currentPage = 0;
                $smarty->assign("errorGlobal", "Ovo je prva stranica");
            } elseif ($this->currentPage > $highestPage) {
                $this->currentPage = $highestPage;
                $smarty->assign("errorGlobal", "Ovo je zadnja stranica");
            }
        }
    }

    public function getData()
    {
        $this->smarty->assign("currentPage", $this->currentPage);
        $offset = $this->currentPage * $this->configItemsPerPage;
        return $this->dbObj->SelectPrepared("SELECT $this->tableData FROM $this->tableName LIMIT {$offset}, {$this->configItemsPerPage}");
    }

    public function displayControls()
    {
        $this->smarty->display("pagingControls.tpl");
    }
}
