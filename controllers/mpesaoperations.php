<?php
    require_once("../models/mpesa.php");
    $mpesa=new MPesa();
    if(isset($_POST['registerurl'])){
        $validationUrl=$_POST['validationurl'];
        $confirmationUrl=$_POST['confirmationurl'];
        echo $mpesa->registerURL($confirmationUrl,$validationUrl);
    }
    if(isset($_POST['simulatempesac2btransaction'])){
        $amount=$_POST['amount'];
        $reference=$_POST['reference'];
        echo $mpesa->simulatec2b($amount,$reference);
    }
?>