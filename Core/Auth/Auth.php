<?php
/**
 * Created by PhpStorm.
 * User: itcyb
 * Date: 10/27/2017
 * Time: 12:49 PM
 */

class Auth extends Authenticate
{
    public static $user;
    public static function user()
    {
        return self::$user;
    }

    public static function setUser($user)
    {
        self::$user = $user;
    }

    public static function id()
    {
        try {
            ##code here
            return self::$user['id'];
        } catch (Exception $e) {
            ##handle exceptions here
            return $e->getMessage();
        }
    }

    public function lastLogin()
    {
    }

    public function lastUpdated()
    {
    }

    public function createdAt()
    {
    }
}