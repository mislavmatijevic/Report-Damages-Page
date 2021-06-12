<?php
$pageAccessLvl = 1;
$pageTitle = "Upravljanje tablicama";
require_once "./control/_page.php";


$smarty->display("header.tpl");

$smarty->display("admin-table-management.tpl");

$smarty->display("footer.tpl");
