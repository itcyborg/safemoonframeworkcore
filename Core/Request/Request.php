<?php
/**
 * Created by PhpStorm.
 * User: itcyb
 * Date: 10/26/2017
 * Time: 2:49 PM
 */

class Request
{
    public static function uri()
    {
        return trim(
            parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH),
            "/"
        );
    }

    public static function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}