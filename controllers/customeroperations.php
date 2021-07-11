<?php 
    require_once("../models/customer.php");
    require_once("../models/meter.php");
    require_once("../models/sms.php");

    $customer=new customer();
    $meter=new meter();
    $sms=new sms();

    if(isset($_POST['savecustomer'])){
        // add customer
        $customerid=$_POST['customerid'];
        $customername=$_POST['customername'];
        $address=$_POST['address'];
        $town=$_POST['town'];
        $postalcode=$_POST['postalcode'];
        $mobile=$_POST['mobile'];
        $email=$_POST['email'];
        $regdocid=$_POST['regdocid'];
        $regdocrefno=$_POST['regdocref'];
        $typeid=$_POST['typeid'];
        $pinno=$_POST['pinno'];
        $landline=$_POST['landline'];
        $tableData = stripcslashes($_POST['TableData']);
        // Decode the JSON array
        $tableData = json_decode($tableData,TRUE);
        $newcustomerid= $customer->saveCustomers($customerid,$customername,$address,$town,$postalcode,$mobile,$email, $regdocid,$regdocrefno,$typeid,$pinno,$landline);
        if(is_numeric($newcustomerid)){
            foreach($tableData as $unit){
                $id=0;
                $unitid=$unit['unitid'];
                $startdate=$unit['commissioningdate'];
                $commissionunit=$unit['commission'];
                $meterid=$unit['meterid'];
                $initialmetgerreading=$unit['initialreading'];
                $result=$customer->attachUnitCustomer($id,$unitid,$newcustomerid,$startdate);
                if($result=="success"){
                    // check if unit is commissioned
                    if($commissionunit==1){
                        $meterreadingresult=$meter->saveMeterReading($id,$newcustomerid,$meterid,$unitid,$initialmetgerreading,'Initial reading during commissioning');
                        if($meterreadingresult!="success"){
                            $result .=", ".$meterreadingresult;
                        }
                    }
                }
            }
        }
        if (is_numeric($newcustomerid)){
            echo "success";
        }else{
            echo $newcustomerid;
        }
    }
    if(isset($_GET['getcustomers'])){
        echo $customer->getCustomer();
    }
    if(isset($_GET['getcustomerdetails'])){
        $customerid=$_GET['customerid'];
        echo $customer->getCustomerDetails($customerid); 
    }
    if(isset($_GET['getcustomerunits'])){
        $customerid=$_GET['customerid'];
        echo $customer->getCustomerUnits($customerid);
    }
    if(isset($_GET['getcustomerstatement'])){
        $meterid=$_GET['meterid'];
        $startdate=$_GET['startdate'];
        $enddate=$_GET['enddate'];
        echo $customer->getcustomerstatement($meterid,$startdate,$enddate);
    }
    if(isset($_GET['getcustomeropenreceivables'])){
        $customerid=$_GET['customerid'];
        echo $customer->getcustomeropenreceivables($customerid);
    }
    if(isset($_POST['savecustomerpayment'])){
        $paymentmode=$_POST['paymentmode'];
        $paymentmoderef=$_POST['paymentmoderef'];
        $customerid=$_POST['customerid'];
        $amount=$_POST['amount'];
        $tableData = stripcslashes($_POST['tableData']);
        $balance=0;
        $error=0;
        // Decode the JSON array
        $tableData = json_decode($tableData,TRUE);
        foreach($tableData as $receivable){
            $unitid=$receivable['unitid'];
            $meterid=$receivable['meterid'];
            $accounttype=$receivable['accounttype'];
            $tariffid=$receivable['tariffid'];
            if($amount>0){
                $rst=$customer->savecustomerpayment($customerid,$unitid,$meterid,$accounttype,$tariffid,$paymentmode,$paymentmoderef,$amount,0);
                $row=$rst->fetch(PDO::FETCH_ASSOC);
                $balance=$row['balance'];
                $receiptno=$row['receiptno'];
                $mobile=$row['customermobileno'];
                $meterno=$row['meterno'];
                // send SMS confirming the amount received
                $message="Dear Customer, your payment for meter number ".$meterno." of Ksh.".$amount." has been received successfully. Receipt number is ".$receiptno;
                // send sms and queue if not successfully sent
                $sms->sendSMS($mobile,$message);
            }
            if(is_numeric($balance)){
                if($balance>0){
                    $amount-=$balance;
                }else{
                    $amount=0;
                }
              // $amount=$balance>0?-=$balance:0;
            }else{
                $error=1;
            }
        }
        // check if any balance remained and post the data to the excess account
        if($amount>0){
            $customer->savecustomerpayment($customerid,$unitid,$meterid,$accounttype,$tariffid,$paymentmode,$paymentmoderef,$amount,1);
        }
        echo $error==0?"success":"Sorry an error occured.";
    }
?>