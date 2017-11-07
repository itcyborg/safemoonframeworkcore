<?php

/**
 *
 */
class User extends RegisterUser
{
    /**
     * @param $username
     * @param $email
     * @param $password
     * @param $confirmPassword
     * @return static
     */
    public static function create($username, $email, $password, $confirmPassword)
    {
        if($msg=self::isUnique($email,$username)){
            self::username($username);
            self::email($email);
            self::password($password);
            self::confirmPassword($password);
            $new = new static;
            return $new->save();
        }
        throw new Exception($msg);
    }

    private static function isUnique($email, $username)
    {
        $isUnique=true;
        $username_check=DB::FindColumn('users','username',$username);
        if($username_check['count']>0){
            $isUnique=false;
            Notifications::addError("Username Exists",Request::uri());
            throw new Exception("Username Exists");
        }
        $email_check=DB::FindColumn('users','email',$email);
        if($email_check['count']>0){
            $isUnique=false;
            Notifications::addError("Email Exists",Request::uri());
            throw new Exception("Email Exists");
        }
        return $isUnique;
    }

    public static function logout()
    {
        Auth::setUser(null);
        SessionManager::destroy();
        header('location:/');
    }

    public static function login($email,$password)
    {
        ##code here
        return Authenticate::validate($email,$password);
    }

    public static function reset($email)
    {
        $db=DB::FindColumn('users',['email'=>$email]);
        if($db['count']>0)
        {
            $token=RememberToken::generate(256);
            if(DB::save('password_resets',[
                'userid'=>$db['result'][0]->id,
                'token'=>$token
            ]))
            {
                Mailer::newMail()
                ->to($email,$db['result'][0]->username)
                ->message($token)
                ->from('noreply@safemoon.com')
                ->subject("Password Reset")
                ->send();
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}

?>
