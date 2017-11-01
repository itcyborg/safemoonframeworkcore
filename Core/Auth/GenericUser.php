<?php
/**
 * Created by PhpStorm.
 * User: itcyb
 * Date: 10/27/2017
 * Time: 4:08 PM
 */

interface GenericUser
{
    /**
     * @param $email
     * @return mixed
     */
    public static function email($email);

    /**
     * @param $password
     * @return mixed
     */
    public static function password($password);

    /**
     * @param $confirmPassword
     * @return mixed
     */
    public static function confirmPassword($confirmPassword);

    /**
     * @return mixed
     */
    public static function rememberToken();

    public static function username($username);
}