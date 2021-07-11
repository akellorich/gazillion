<?php
    require_once("../models/paymenttiers.php");
    $paymenttier=new paymenttier();
    
    if(isset($_POST['savepaymenttier'])){
        $id=$_POST['id'];
        $category=$_POST['category'];
        $tiername=$_POST['tiername'];
        echo $paymenttier->saveTier($id,$category,$tiername);
    }
    if(isset($_GET['getpaymenttiers'])){
        $id=$_GET['id'];
        echo $paymenttier->getTiers($id);
    }
    if(isset($_POST['deletepaymenttier'])){
        $id=$_POST['id'];
        echo $paymenttier->deleteTier($id);
    }
    if(isset($_POST['savepaymenttierrange'])){
        $id=$_POST['id'];
        $tierid=$_POST['tierid'];
        $minvalue=$_POST['minvalue'];
        $maxvalue=$_POST['maxvalue'];
        $priceperkg=$_POST['priceperkg'];
        echo $paymenttier->savetiervalues($id,$tierid,$minvalue,$maxvalue,$priceperkg);
    }
    if(isset($_POST['deletepaymenttierrange'])){
        $id=$_POST['id'];
        echo $paymenttier->deletetierrange($id);
    }
    if(isset($_GET['gettariffrangevalues'])){
        $id=$_GET['id'];
        echo $paymenttier->gettierrangevalues($id);
    }

?>