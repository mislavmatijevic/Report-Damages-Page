<?php

define("LVL_ADMINISTRATOR", 1);
define("LVL_MODERATOR", 2);
define("LVL_REGISTRIRANI", 3);
define("LVL_NEREGISTRIRANI", 4);

define("LOGIN_COMPLETE", 0);

class UserControl
{
    static function startSession()
    {
        if (session_id() == "") {
            session_name("UserSession");
            session_start();
        }
        if (!isset($_SESSION["lvl"])) {
            $_SESSION["lvl"] = LVL_NEREGISTRIRANI;
            $_SESSION["user"] = null;
        }
    }

    static function stopSession()
    {
        if (!empty(session_id()) || session_id() != "") {
            session_unset();
            session_destroy();
        }
    }

    static function LogIn($email, $password)
    {
        $dbObj = new DB();
        $dbResponse = $dbObj->AuthenticateUser($email, $password);
        if (!is_integer($dbResponse)) {
            self::stopSession();
            self::startSession();
            $_SESSION["user"] = $dbResponse;
            $_SESSION["lvl"] = $dbResponse->id_uloga;
            return LOGIN_COMPLETE;
        } else {
            return $dbResponse;
        }
    }
}
