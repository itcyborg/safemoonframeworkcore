<?php
/**
 * Created by PhpStorm.
 * User: itcyb
 * Date: 10/26/2017
 * Time: 2:49 PM
 */

class Request
{
    public static $slug=[];
    public static function uri()
    {
        $url=trim(
            parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH),
            "/"
        );
        return $url;
    }

    public static function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * @return mixed
     */
    public static function getPrevious()
    {
        return self::$previous;
    }
}