<?php
    $stkResponse = file_get_contents('php://input');
    $logFile = "../logfiles/stk_confirmation_response.txt";

    $jsonstkResponse = json_decode($stkResponse, true);
    /*
    $meterno=$jsonstkResponse['BillRefNumber'];
    $paymentmoderef=$jsonstkResponse['TransID'];
    $amount=$jsonstkResponse['TransAmount'];
    $paymentdate=$jsonstkResponse['TransTime'];
    $mobile=$jsonstkResponse['MSISDN'];
    $payeename=$jsonstkResponse['FirstName'].' '.$jsonstkResponse['MiddleName'].' '.$jsonstkResponse['LastName'];

    $sql="CALL spgetmeterdetails('{$meterno}')";
    $rst=$db->getData($sql);
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
        $sql="CALL spsavecustomerpayment({$customerid},{$unitid},{$meterid},'{$accounttype}',{$tariffid},{$paymentmodeid},'{$paymentmoderef}',{$amount},'{$paymentdate}',1)"; 
        $db->getData($sql);
    }
    */
    // write to file
    $log = fopen($logFile, "a");
    fwrite($log, $stkResponse);
    fclose($log); 
    // send a confirmation message to the account owner and the person paying if not account owner
    //echo $response;

?>