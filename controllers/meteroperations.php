<?php
    require_once("../models/meter.php");
    $meter=new meter();
    if(isset($_POST['savemetermake'])){
        $makeid=$_POST['makeid'];
        $makename=$_POST['makename'];
        echo $meter->saveMeterMake($makeid,$makename);
    }
    if(isset($_GET['getmetermakes'])){
        $makeid=$_GET['makeid'];
        echo $meter->getMeterMakes($makeid);
    }
    if(isset($_POST['savemetermodel'])){
        $makeid=$_POST['makeid'];
        $modelid=$_POST['modelid'];
        $modelname=$_POST['modelname'];
        echo $meter->saveMeterModel($modelid,$makeid,$modelname);
    }
    if(isset($_GET['getmetermodels'])){
        $makeid=$_GET['makeid'];
        $modelid=$_GET['modelid'];
        echo $meter->getMeterModels($makeid,$modelid);
    }
    if(isset($_POST['savemeter'])){
        $meterid=$_POST['meterid'];
        $meterno=$_POST['meterno'];
        $serialno=$_POST['serialno'];
        $modelid=$_POST['modelid'];
        $metertype=$_POST['metertype'];
        echo $meter->saveMeter($meterid,$meterno,$serialno,$modelid,$metertype);
    }
    if(isset($_GET['getmeters'])){
        $makeid=$_GET['makeid'];
        $modelid=$_GET['modelid'];
        $meterid=$_GET['meterid'];
        echo $meter->getMeter($makeid,$modelid,$meterid);
    }
    if(isset($_POST['saveunitmeter'])){
        $id=$_POST['id'];
        $unitid=$_POST['unitid'];
        $meterid=$_POST['meterid'];
        echo $meter->saveUnitMeter($id,$unitid,$meterid);
    }
    if(isset($_POST['savemeterreading'])){
        $id=$_POST['id'];
        $customerid=$_POST['customerid'];
        $unitid=$_POST['unitid'];
        $meterreading=$_POST['meterreading'];
        $narration=$_POST['narration'];
        $readby=$_POST['readby'];
        $readdate=$_POST['readdate'];
        $meterid=$_POST['meterid'];
        $billclient=$_POST['billclient'];
        echo $meter->saveMeterReading($id,$customerid,$meterid,$unitid,$meterreading,$narration,$readby,$readdate,$billclient);
    }
    if(isset($_GET['getmeterreadings'])){
        $meterid=$_GET['meterid'];
        $startdate=$_GET['startdate'];
        $enddate=$_GET['enddate'];
        echo $meter->getmeterreadings($meterid,$startdate,$enddate);
    }
?>
