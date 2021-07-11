<?php
    require_once("../models/mail.php");
    $mail= new mail();
    if(isset($_POST['sendemail'])){
        $recipient=$_POST['recipient'];
        $message=$_POST['message'];
        $subject=$_POST['subject'];
        $sender=$_SESSION['username'];
        echo $mail->sendEmail($recipient,$subject,$message,$sender);
    }
?>