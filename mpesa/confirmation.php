<?php
    require_once('connection.php');

    header("Content-Type: application/json");
    $db=new db();
    $response = '{
        "ResultCode": 0, 
        "ResultDesc": "Confirmation Received Successfully"
    }';

    // Response from M-PESA Stream
    $mpesaResponse = file_get_contents('php://input');

    // log the response
    $logFile = "M_PESAConfirmationResponse.txt";


    $jsonMpesaResponse = json_decode($mpesaResponse, true); // We will then use this to save to database
    
    $tenantid=$jsonMpesaResponse['BillRefNumber'];
    $transactionref=$jsonMpesaResponse['TransID'];
    $amount=$jsonMpesaResponse['TransAmount'];
    $date=$jsonMpesaResponse['TransTime'];
    $mobile=$jsonMpesaResponse['MSISDN'];
    $payeename=$jsonMpesaResponse['FirstName'].' '.$jsonMpesaResponse['MiddleName'].' '.$jsonMpesaResponse['LastName'];

    $sql="CALL sp_savempesapayment('{$tenantid}','{$date}','{$transactionref}',{$amount},'{$mobile}','{$payeename}')";
    $stmt=$db->connect()->query($sql);

    // write to file
    $log = fopen($logFile, "a");

    fwrite($log, $mpesaResponse);
    fclose($log);

    echo $response;
?>
