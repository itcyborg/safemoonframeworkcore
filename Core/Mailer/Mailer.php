<?php
/**
 * Created by PhpStorm.
 * User: itcyb
 * Date: 11/6/2017
 * Time: 3:30 PM
 */


class Mailer
{
    private static $mail;
    private static $msg_plain;
    private static $msg_formatted;
    private static $subject;
    private static $cc=[];
    private static $bcc=[];
    private static $to=[];
    private static $from;
    private static $reply_to;
    private static $attachment;

    public static function newMail()
    {
        $config=Config::mailer();

        self::$mail = new \PHPMailer\PHPMailer\PHPMailer(true);
        //Server settings
        self::$mail->SMTPDebug = 0;                                   // Enable verbose debug output
        self::$mail->isSMTP();                                        // Set mailer to use SMTP
        self::$mail->Host = $config['server'];                        // Specify main and backup SMTP servers
        self::$mail->SMTPAuth = true;                                 // Enable SMTP authentication
        self::$mail->Username = $config['username'];                  // SMTP username
        self::$mail->Password = $config['password'];                  // SMTP password
        self::$mail->SMTPSecure = 'tls';                              // Enable TLS encryption, `ssl` also accepted
        self::$mail->Port = 465;
        $static=new static;
        return $static;
    }

    public function to($to,$name=null)
    {
        if(is_array($to))
        {
            foreach ($to as $item=>$value) {
                self::$mail->addAddress($item,$value);
            }
        }else{
            self::$mail->addAddress($to,$name);
        }
        return $this;
    }

    public function cc(array $cc)
    {
        foreach ($cc as $item) {
            $this->mail->addCC($item);
        }
        return $this;
    }

    public function bcc(array $bcc)
    {
        foreach ($bcc as $item) {
            $this->mail->addBCC($item);
        }
    }

    public function subject($subject)
    {
        self::$mail->Subject = $subject;
        return $this;
    }

    public function message($msg_plain=null,$msg_formatted=null)
    {
        if(!is_null($msg_formatted))
        {
            self::$mail->isHTML(true);
            self::$mail->Body    = $msg_formatted;
            self::$mail->AltBody = $msg_plain;
        }else{
            self::$mail->isHtml(false);
            self::$mail->Body    = $msg_plain;
        }
        return $this;
    }

    public function reply_to($reply_to=null,$name=null)
    {
        self::$mail->addReplyTo($reply_to, $name);
    }

    public function from($from,$from_name=null)
    {
        self::$mail->setFrom($from, $from_name);
        return $this;
    }

    public function attachement($path,$name=null)
    {
        self::$mail->addAttachment($path,$name);
        return $this;
    }
    public function send()
    {
        try {
            self::$mail->send();
            return true;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function mailView($view)
    {

    }
}