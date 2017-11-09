<?php
/**
 * Created by PhpStorm.
 * User: itcyb
 * Date: 11/2/2017
 * Time: 12:50 PM
 */

class Notifications
{
    public static $notifications=[];

    public static $errors=[
    ];

    public static $messages=[
    ];

    public static function addMessage($msg,$route)
    {
        self::$messages['route'][$route][]=$msg;
    }

    public static function addError($error,$route)
    {
        self::$errors['route'][$route][]=$error;
    }

    public static function get()
    {
        self::$notifications['errors']=self::$errors;
        self::$notifications['messages']=self::$messages;
        return self::$notifications;
    }

    public static function hasMessages()
    {
        if(sizeof(self::$messages)>0){
            return true;
        }
        return false;
    }

    public static function hasErrors()
    {
        if(sizeof(self::$errors)>0){
            return true;
        }
        return false;
    }
}
