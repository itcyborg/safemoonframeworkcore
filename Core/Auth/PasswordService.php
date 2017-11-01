<?php
/**
 * Created by PhpStorm.
 * User: itcyb
 * Date: 10/27/2017
 * Time: 4:33 PM
 */

class PasswordService
{
    public static function hash($password)
    {
        self::hasLower($password);
        self::hasUpper($password);
        self::hasInteger($password);
        $options = [
            'cost' => 12
        ];
        return password_hash($password, PASSWORD_BCRYPT, $options);
    }

    private static function hasLower($password)
    {
        if (preg_match("/[a-z]/", $password)) {
            return true;
        }
        throw new Exception("Password must contain at least one uppercase letter.");
    }

    private static function hasUpper($password)
    {
        if (preg_match("/[A-Z]/", $password)) {
            return true;
        }
        throw new Exception("Password must contain at least one uppercase letter.");
    }

    private static function hasInteger($password)
    {
        if (preg_match("/[0-9]/", $password)) {
            return true;
        }
        throw new Exception("Password must contain at least one number.");
    }

    private static function hasSymbols($password)
    {
    }
}