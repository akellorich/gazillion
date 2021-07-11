<?php
    require_once("../models/sms.php");

    $sms= new sms();
    if(isset($_POST['sendsms'])){
        $recipient=$_POST['recipient'];
        $message=$_POST['message'];
        echo $sms->sendSMS($recipient,$message);
    }

?>