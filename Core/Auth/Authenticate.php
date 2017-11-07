<?php
/**
 * Created by PhpStorm.
 * User: itcyb
 * Date: 10/27/2017
 * Time: 6:07 PM
 */

class Authenticate
{
    public static function validate($email,$password)
    {
        ##code here
        $db=DB::FindColumn('users', [
            'email'=>$email
        ]);
        if ($db['count']!==0)
        {
            if(PasswordService::verify($password,$db['result'][0]->password))
            {
                Auth::setUser([
                    'session_id'=>SessionManager::create([
                        'username'=>$db['result'][0]->username,
                        'id'=>$db['result'][0]->id,
                        'email'=>$email,
                        'loggedin'=>true
                    ]),
                    'username'=>$db['result'][0]->username,
                    'id'=>$db['result'][0]->id,
                    'email'=>$email,
                    'loggedin'=>true
                ]);
                return true;
            }
            throw new Exception("Invalid Email/Password combination. Check your details and try again.");
        }
        throw new Exception("Invalid Email/Password combination. Check your details and try again.");
    }
}