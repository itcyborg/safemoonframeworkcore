<?php
/**
 * Created by PhpStorm.
 * User: itcyb
 * Date: 10/31/2017
 * Time: 10:12 AM
 */

class AssetLoader
{
    public static function load($asset)
    {
        $server=App::publicDir();
        return (string)$server.$asset;
    }
}