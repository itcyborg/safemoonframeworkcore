<?php
/**
 * Created by PhpStorm.
 * User: itcyb
 * Date: 10/27/2017
 * Time: 4:12 PM
 */

class SanitizeRequest
{
    public static function email($email)
    {
        return filter_var($email, FILTER_SANITIZE_EMAIL);
    }

    public static function text($text)
    {
        return filter_var($text, FILTER_SANITIZE_STRING);
    }

    public static function url($url)
    {
        return filter_var($url, FILTER_SANITIZE_URL);
    }
}