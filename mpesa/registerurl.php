<?php
    require_once('mpesa.php');
    $mpesa=new MPesa();
    $validationurl=$_POST['validationurl'];
    $confirmationurl=$_POST['confirmationurl'];
    $response=$mpesa->registerURL($validationurl,$confirmationurl);
    echo $response;

?>