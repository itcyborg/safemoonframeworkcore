<?php
/**
 * Created by PhpStorm.
 * User: itcyb
 * Date: 10/30/2017
 * Time: 10:29 AM
 */

class AT
{
    public static function user()
    {
        try {
            ##code here
            return self::gateway()->getUserData();
        } catch (AfricasTalkingGatewayException $e) {
            ##handle exceptions here
            return $e->getMessage();
        }
    }

    public static function gateway()
    {
        return self::boot();
    }

    private static function boot()
    {
        $username = self::config()['username'];
        $api_key = self::config()['api_key'];
        return new AfricasTalkingGateway($username, $api_key);
    }

    private static function config()
    {
        return Config::getConfig("AT");
    }

    public static function voiceNumber()
    {
        return self::config()['VoiceNumber'];
    }
}