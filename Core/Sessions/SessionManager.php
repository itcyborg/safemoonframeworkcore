<?php
/**
 * Created by PhpStorm.
 * User: itcyb
 * Date: 11/2/2017
 * Time: 12:50 PM
 */

class SessionManager
{
    public static function create($parameters)
    {
        @session_start();
        foreach ($parameters as $parameter=>$value) {
            $_SESSION[$parameter]=$value;
        }
        return session_id();
    }

    public static function destroy()
    {
        session_unset();
        session_destroy();
    }
}