<?php

error_reporting(E_ALL);

define("ERROR_MESSAGE", 0);
define("INFO_MESSAGE", 1);

require_once './smarty-3.1.39/libs/Smarty.class.php';
$smarty = new Smarty();

require_once './php_background/UserControl.php';
UserControl::startSession();


require_once './php_background/Database.php';