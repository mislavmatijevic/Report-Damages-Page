<?php

ob_clean();
header_remove();
header("Content-type: application/json; charset=utf-8");
http_response_code(200);

require_once dirname(__DIR__)."/control/OutputControl.php";

if (!empty($_POST['hoursDiff'])) {

    $conf = dirname(__DIR__)."/privatno/config/manage.conf";
    $config = parse_ini_file($conf);

    $requestedDiff = Prevent::Injection("POST", "hoursDiff");

    try {
        if (!is_numeric($requestedDiff)) {
            throw new Exception();
        }

        $config["virtualTimeOffsetSeconds"] = $config["virtualTimeOffsetSeconds"]+($requestedDiff*60*60);

        $fileConfig = fopen($conf, "w");
        foreach ($config as $key => $value) {
            fwrite($fileConfig, $key . " = " . $value . "\n");
        }
        fclose($fileConfig);

        $returnMe = [
            'realTime' => date("d.m.Y H:i:s", time()),
            'virtualTime' => date("d.m.Y H:i:s", time() + $config["virtualTimeOffsetSeconds"]),
        ];

        die(json_encode($returnMe));
    }
    catch (Exception $e) {
        json_encode(false);
    }
}
