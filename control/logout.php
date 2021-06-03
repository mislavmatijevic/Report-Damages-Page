<?php
$pageAccessLvl = 3;
include dirname(__DIR__)."/control/_page.php";

UserControl::startSession();
UserControl::stopSession();

header('Location: ../index.php');

exit();
