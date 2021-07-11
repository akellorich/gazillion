<?php
    header("Content-Type: application/json");
    require_once('../models/db.php');
    require_once('../models/sms.php');

    $sms=new sms();
    $db=new db();

    $response = '{
        "ResultCode": 0, 
        "ResultDesc": "Confirmation Received Successfully"
    }';

    // Response from M-PESA Stream
    $mpesaResponse = file_get_contents('php://input');
    // log the response
    $logFile = "../logfiles/MPESA_Confirmation_Response.txt";
    //log sql statement for debugging
    $sqllogFile = "SQL_confirmation_response.txt";
    $jsonMpesaResponse = json_decode($mpesaResponse, true); // We will then use this to save to database
    
    $meterno=$jsonMpesaResponse['BillRefNumber'];
    $paymentmoderef=$jsonMpesaResponse['TransID'];
    $amount=$jsonMpesaResponse['TransAmount'];
    $paymentdate=$jsonMpesaResponse['TransTime'];
    $mobile=$jsonMpesaResponse['MSISDN'];
    $payeename=$jsonMpesaResponse['FirstName'].' '.$jsonMpesaResponse['MiddleName'].' '.$jsonMpesaResponse['LastName'];
    $sql="CALL spgetmeterdetails('{$meterno}')";
    $rst=$db->getData($sql);
    $meterid='';
    if($rst->rowCount()){ 
        $row=$rst->fetch(PDO::FETCH_ASSOC);
        // get unitid, customerid, meterid, tarrif and customers mobile number
        $unitid=$row['unitid'];
        $customerid=$row['customerid'];
        $meterid=$row['meterid'];
        $accounttype=$row['accounttype'];
        $paymentmodeid=2;
        $tariffid=$row['tariffid'];
        $mobile=$row['customermobileno'];
        // output sql statement to file
        $log = fopen($sqllogFile, "a");
        fwrite($log, $mpesaResponse);
        fclose($log); 
        // write to database
        $sql="CALL spsavecustomerpayment({$customerid},{$unitid},{$meterid},'{$accounttype}',{$tariffid},{$paymentmodeid},'{$paymentmoderef}',{$amount},'{$paymentdate}',1,5)"; 
        //$sql="CALL spsavecustomerpayment({$customerid},{$unitid},{$meterid},'{$accounttype}',{$tariffid},{$paymentmodeid},'{$paymentmoderef}',{$amount},'{$paymentdate}',{$postexcesspayment},{$_SESSION['userid']})";
        $db->getData($sql);
    }
    // write to file
    $log = fopen($logFile, "a");
    fwrite($log, $mpesaResponse);
    fclose($log); 
    // send a confirmation message to the account owner and the person paying if not account owner
    $message="Hello customer, your payment for meter #: ".$meterid." of "; //.$amount." via MPESA Ref #: ".$ $paymentmoderef." has been received successfully.";
    $sms->sendSMS($mobile,$message);
    echo $response;
?>
