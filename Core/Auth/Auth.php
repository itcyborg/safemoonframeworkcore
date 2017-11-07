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
        if(is_null(self::$user) && !is_null($_SESSION))
        {
            if(isset($_SESSION['username'],$_SESSION['email'])){
                self::$user['sessionid']=session_id();
                foreach ($_SESSION as $item=>$value) {
                    self::$user[$item]=$value;
                }
            }
        }
        return self::$user;
    }

    public static function isLoggedIn()
    {
        if(isset($_SESSION['username'],$_SESSION['email']))
        {
            return true;
        }else{
            header('location:login/required');
        }
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

    public static function Routes()
    {
        /*
         * login
         * register
         * password reset request
         * verify password reset
         */

        /*
         * login Routes
         */
        Router::get('login','loginController@index');
        Router::post('login','loginController@login');
        Router::get('login/required','loginController@loginRequired');
        /*
         * Register Routes
         */
        Router::get('register','registerController@index');
        Router::post('register','registerController@register');
        /*
         * logout route
         */
        Router::get('logout','loginController@logout');

        /*
         * Passowrd reset route
         */
        Router::get('reset','resetController@index');
        Router::post('reset','resetController@reset');
    }
}