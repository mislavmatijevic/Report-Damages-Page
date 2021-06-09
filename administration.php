<?php
$pageAccessLvl = 1;
$pageTitle = "Administriranje stranice";
require_once "./control/_page.php";

$smarty->assign("realTime", date("d.m.Y H:i:s", time()));
$smarty->assign("virtualTime", date("d.m.Y H:i:s", time() + $config["virtualTimeOffsetSeconds"]));

$smarty->display("header.tpl");

$smarty->display("administrator.tpl");

$smarty->display("footer.tpl");
