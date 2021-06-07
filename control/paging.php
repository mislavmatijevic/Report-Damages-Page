<?php

require_once dirname(__DIR__)."/control/_page.php";
require_once dirname(__DIR__)."/control/Database.php";

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
        
        $config = parse_ini_file(dirname(__DIR__)."/admin/config/manage.conf");
        $this->configItemsPerPage = $config["maxItemsPerPage"];
        $this->dbObj = new DB();

        $databaseData = $this->dbObj->GetSelect("SELECT COUNT(*) FROM $this->tableName");
        $numberOfRows = $databaseData[0]["COUNT(*)"];
        $highestPage = ceil($numberOfRows / $this->configItemsPerPage) - 1;
        $smarty->assign("maxPage", $highestPage);

        $this->currentPage = 0;
        if (isset($_GET["page"])) {
            $this->currentPage = $_GET["page"];
            if ($this->currentPage < 0) {
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
