<?php
    require_once("settings.php");
    use PHPMailer\PHPMailer\PHPMailer;
    require_once("../phpmailer/PHPMailer.php");
    require_once("../phpmailer/SMTP.php");
    require_once("../phpmailer/Exception.php");

    class mail extends settings{
        private $smtpserver;
        private $smtpport;
        private $smtpsecurity;
        private $username;
        private $password;

        public function __construct(){
            // fetch email settings
            $rst=$this->getemailconfigurationasobject();
            $row=$rst->fetch(PDO::FETCH_ASSOC);
            $this->smtpserver=$row['smtpserver'];
            $this->smtpport=$row['smtpport'];
            $this->username=$row['emailaddress'];
            $this->password=$row['password'];
            $this->smtpsecurity=$row['usessl']==1?'ssl':'tls';
        }

        public function sendEmail($recipient,$subject,$message,$sender,$attachment=''){
            $mail= new PHPMailer();

            $mail->isSMTP();
            $mail->Host=$this->smtpserver;
            $mail->SMTPAuth=true;
            $mail->Username=$this->username;
            $mail->Password=$this->password;
            $mail->Port=$this->smtpport;
            $mail->SMTPSecure=$this->smtpsecurity;

            $mail->isHTML(true);
            $mail->SetFrom($this->username,$sender);
            $mail->addAddress($recipient);
            $mail->Subject=$subject;
            $mail->Body=$message;
            if($attachment!=""){
                $mail->AddAttachment($attachment);
            }
            if($mail->send()){
                return "success";
            }else{
                return $mail->ErrorInfo;
            }
        }
    }
?>