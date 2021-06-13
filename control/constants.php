<?php
error_reporting(0);

define("ERROR_MESSAGE", 0);
define("INFO_MESSAGE", 1);

$urlToRoot = $_SERVER['HTTP_HOST'].dirname($_SERVER["PHP_SELF"]);
$fullScriptName = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/")+1);
$fullUrl = $urlToRoot . "/" . $fullScriptName;
if (!isset($relativePath)) {
    $relativePath = basename(dirname($_SERVER['REQUEST_URI'], 1)) === "control" ? "../" : "./";
}

$confFilePath = dirname(__DIR__)."/privatno/config/manage.conf";