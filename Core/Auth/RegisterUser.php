<?php
/**
 * Created by PhpStorm.
 * User: itcyb
 * Date: 10/27/2017
 * Time: 1:49 PM
 */

class RegisterUser implements GenericUser
{
    private static $email;
    private static $password;
    private static $remember_token;
    private static $username;
    private static $confirm_password;

    /**
     * @inheritDoc
     */
    public static function email($email)
    {
        self::$email = $email;
    }

    /**
     * @inheritDoc
     */
    public static function password($password)
    {
        self::$password = $password;
    }

    /**
     * @inheritDoc
     */
    public static function confirmPassword($confirmPassword)
    {
        self::$confirm_password = $confirmPassword;
    }

    /**
     * @inheritDoc
     */
    public static function rememberToken()
    {
        self::$remember_token = RememberToken::generate();
    }

    public static function username($username)
    {
        self::$username = $username;
    }

    public function save()
    {
      if(self::$password===self::$confirm_password)
      {
          try {
              ##code here
              $db=DB::save('users',[
                  'username'=>self::$username,
                  'email'=>self::$email,
                  'password'=>PasswordService::hash(self::$password),
              ]);
              if($db)
              {
                  Auth::setUser([
                      'session_id'=>SessionManager::create([
                          'username'=>self::$username,
                          'email'=>self::$email,
                          'loggedin'=>true,
                          'id'=>DB::idFromEmail('users',self::$email)
                      ]),
                      'username'=>self::$username,
                      'email'=>self::$email,
                      'loggedin'=>true,
                      'id'=>DB::idFromEmail('users',self::$email)
                  ]);
              }
              return $db;
        } catch (Exception $e) {
              ##handle exceptions here
              return $e->getMessage();
        }
      }else {
        throw new Exception("Password does not match", 1);
      }
    }
}
