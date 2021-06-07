<?php

require_once dirname(__DIR__) . "/control/_page.php";
require_once dirname(__DIR__) . "/control/Database.php";

function filter(&$value) {
    $value = htmlspecialchars($value);
}

class Prevent
{
    static function XSS($object)
    {
        array_walk_recursive($object, 'filter');
        return $object;
    }
    static function Injection(string $inputSource, string $key)
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
        global $smarty;
        $this->smarty = $smarty;
        $this->tableData = $tableData;
        $this->tableName = $tableName . " " . $additional;

        $config = parse_ini_file(dirname(__DIR__) . "/admin/config/manage.conf");
        $this->configItemsPerPage = $config["maxItemsPerPage"];
        $this->dbObj = new DB();

        $databaseData = $this->dbObj->GetSelect("SELECT COUNT(*) FROM $this->tableName");
        $numberOfRows = $databaseData[0]["COUNT(*)"];
        $highestPage = ceil($numberOfRows / $this->configItemsPerPage) - 1;
        $smarty->assign("maxPage", $highestPage);

        $this->currentPage = 0;
        if (isset($_GET["page"])) {
            $this->currentPage = Prevent::Injection("GET", "page");
            settype($this->currentPage, "integer");
            if ($this->currentPage < 0 || !is_numeric($this->currentPage)) {
                $this->currentPage = 0;
                $smarty->assign("messageGlobal", "Ovo je prva stranica");
            } else if ($this->currentPage > $highestPage) {
                $this->currentPage = $highestPage;
                $smarty->assign("messageGlobal", "Ovo je zadnja stranica");
            }
        }
    }

    public function getData()
    {
        $this->smarty->assign("currentPage", $this->currentPage);
        $offset = $this->currentPage * $this->configItemsPerPage;
        return $this->dbObj->GetSelect("SELECT $this->tableData FROM $this->tableName LIMIT {$offset}, {$this->configItemsPerPage}");
    }

    public function displayControls()
    {
        $this->smarty->display("pagingControls.tpl");
    }
}
