<?php
    header("Content-Type: application/json");
    require_once('../models/db.php');
    require_once("../models/sms.php");

    $db=new db();
    $sms=new sms();

    // log the response
    $mpesaResponse = file_get_contents('php://input');
    $logFile = "../logfiles/Validation_Response.txt";
    $jsonMpesaResponse = json_decode($mpesaResponse, true);
    $log = fopen($logFile, "a");
    fwrite($log, $mpesaResponse);
    fclose($log);
    // will be used when we want to save the response to database for our reference
    //$jsonMpesaResponse = json_decode($mpesaResponse, true); 
    //echo $jsonMpesaResponse;
    $meterno=$jsonMpesaResponse['BillRefNumber'];
    // check that the tenant exists and that their balance is correct
    $sql="CALL spgetmeterdetails('{ $meterno}')";
    $rst=$db->getData($sql);
    if($rst->rowCount()){
        $response = '{ "ResultCode": 0, "ResultDesc": "Confirmation Received Successfully" }';
    }else{
        $mobilenumber=$jsonMpesaResponse['MSISDN'];
        $message="Sorry, we did not find the Meter No. ".$meterno." in our system. Kindly correct the meter no. then try again";
        $sms->sendSMS($mobilenumber,$message);
        $response = '{ "ResultCode": 1, "ResultDesc": "Sorry, we did not find a meter with the number: '.$meterno.' from our system." }';
    }

   echo $response;

?>