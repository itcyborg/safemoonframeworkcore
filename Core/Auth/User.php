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
        $username_check=DB::FindColumn('users',['username'=>$username]);
        if($username_check['count']>0){
            $isUnique=false;
            Notifications::addError("Username Exists",Request::uri());
            throw new Exception("Username Exists");
        }
        $email_check=DB::FindColumn('users',['email'=>$email]);
        if($email_check['count']>0){
            $isUnique=false;
            Notifications::addError("Error registering using this email. Try another.",Request::uri());
            throw new Exception("Error registering using this email. Try another.");
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
            $token=strtoupper(RememberToken::generate(10));
            if(DB::save('password_resets',[
                'userid'=>$db['result'][0]->id,
                'token'=>PasswordService::hashToken($token)
            ]))
            {
                Mailer::newMail()
                ->to($email,$db['result'][0]->username)
                ->message(
                    "hello ".$db['result'][0]->username.",\n
                    You've recently requested for a password reset.\n
                    Follow this link\n".
                    URL::HostUri()
                    ."reset/verify/\n
                    Use the following code to reset your password\n
                        $token\n
                    If you did not request for this, ignore this email.
                    ",
                    "<div style='padding:3em;background-color:rgba(163,180,255,0.44);'>
                        <p>Hello " .$db['result'][0]->username.",</p><br>
                        <p>You've recently requested for a password reset<br>
                        Follow this link: <a href='".URL::HostUri()."reset/verify/'>Verify code</a><br>
                        and enter the code below: <br>
                        <b> $token</b>
                        </p><br>
                        <p><i>If you did not request for this, ignore this email.</i></p>
                     </div>"
                )
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
