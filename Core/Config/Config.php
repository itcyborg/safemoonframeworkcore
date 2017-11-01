<?php
/**
 * Created by PhpStorm.
 * User: itcyb
 * Date: 10/26/2017
 * Time: 2:49 PM
 */

class Config
{
    public static function database()
    {
        return self::read()['database'];
    }

    protected static function read()
    {
        $root = App::root();
        $file = "/Config/Config.ini";
        return parse_ini_file(
            $root . $file, true
        );
    }

    public static function uri()
    {
        return self::app('uri');
    }

    public static function app($param = null)
    {
        if ($param == "name") {
            return self::read()['app']['name'];
        }
        if ($param == "uri") {
            return self::read()['app']['uri'];
        }
        return self::read()['app'];
    }

    public static function name()
    {
        return self::app('name');
    }

    public static function debug()
    {
        return self::read()['debug'];
    }

    public static function getConfig($string)
    {
        return self::read()[$string];
    }
}