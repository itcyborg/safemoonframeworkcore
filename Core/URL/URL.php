<?php
/**
 * Created by PhpStorm.
 * User: itcyb
 * Date: 11/5/2017
 * Time: 10:08 AM
 */

class URL
{
    public static function Uri($uri)
    {
       return (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]/".$uri;
    }
}