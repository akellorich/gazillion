<?php
    header("Content-Type: application/json");
    require_once('connection.php');
  
    $db=new db();
    //$db->connect();

    $response = '{ "ResultCode": 0, "ResultDesc": "Confirmation Received Successfully" }';

    // Save the M-PESA input stream. 
    $mpesaResponse = file_get_contents('php://input');

    // check if the customer has paid enough money 
    
    /* If we have any validation, we will do it here then change the $response if we reject the transaction */
    // Your Validation
    // $response = '{  "ResultCode": 1, "ResultDesc": "Transaction Rejected."  }';
    /* Ofcourse we will be checking for amount, account number(incase of paybill), invoice number and inventory.
    But we reserve this for future tutorials*/

    // log the response
    $logFile = "validationResponse.txt";

    // will be used when we want to save the response to database for our reference
    $jsonMpesaResponse = json_decode($mpesaResponse, true); 
    //echo $jsonMpesaResponse;
    $tenantid=$jsonMpesaResponse['BillRefNumber'];
    // check that the tenant exists and that their balance is correct
    $stmt=$db->connect()->query("CALL sp_checkcustomerbalance ('{$tenantid}')");
    if($stmt->rowCount()){
        while($row=$stmt->fetch()){
            $balance=$row['balance'];
        }
        if($balance<jsonMpesaResponse['TransAmount']){
            $response = '{ "ResultCode": 1, "ResultDesc": "Sorry, insufficient amount provided" }' ;
        }else{
            $response = '{ "ResultCode": 0, "ResultDesc": "Confirmation Received Successfully" }';
        }
    }else{
        $response = '{ "ResultCode": 1, "ResultDesc": "Sorry, no tenant with similar tenant-id provided" }';
    }
    // write the M-PESA Response to file
    $log = fopen($logFile, "a");
    fwrite($log, $mpesaResponse);
    fclose($log);

    echo $response;

?>