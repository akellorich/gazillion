<?php

header("Content-Type:application/json");

if (!isset($_GET["token"])) {
    echo "Technical error";
    exit();
}
if ($_GET["token"] != 'Wajonawitu2!') {
    echo "Invalid authorization";
    exit();
}

$con = mysqli_connect('localhost','root', '', 'testmpesa');
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
$request = file_get_contents("php://input");
//Put the json string that we received from Safaricom to an array
$array = json_decode($request, true);

/*
  $transactiontype = mysqli_real_escape_string($con, $array['TransactionType']);
  $transid = mysqli_real_escape_string($con, $array['TransID']);
  $transtime = mysqli_real_escape_string($con, $array['TransTime']);
  $transamount = mysqli_real_escape_string($con, $array['TransAmount']);
  $businessshortcode = mysqli_real_escape_string($con, $array['BusinessShortCode']);
  $billrefno = mysqli_real_escape_string($con, $array['BillRefNumber']);
  $invoiceno = mysqli_real_escape_string($con, $array['InvoiceNumber']);
  $msisdn = mysqli_real_escape_string($con, $array['MSISDN']);
  $orgaccountbalance = mysqli_real_escape_string($con, $array['OrgAccountBalance']);
  $firstname = mysqli_real_escape_string($con, $array['FirstName']);
  $middlename = mysqli_real_escape_string($con, $array['MiddleName']);
  $lastname = mysqli_real_escape_string($con, $array['LastName']);
 */

$transactiontype = $_POST['TransactionType'];
$transid = $_POST['TransID'];
$transtime = $_POST['TransTime'];
$transamount = $_POST['TransAmount'];
$businessshortcode = $_POST['BusinessShortCode'];
$billrefno = $_POST['BillRefNumber'];
$invoiceno = $_POST['InvoiceNumber'];
$msisdn = $_POST['MSISDN'];
$orgaccountbalance = $_POST['OrgAccountBalance'];
$firstname = $_POST['FirstName'];
$middlename = $_POST['MiddleName'];
$lastname = $_POST['LastName'];

$sql = "INSERT INTO `mpesa_payments`
( 
`TransactionType`,
`TransID`,
`TransTime`,
`TransAmount`,
`BusinessShortCode`,
`BillRefNumber`,
`InvoiceNumber`,
`MSISDN`,
`First_Name`,
`Middle_Name`,
`Last_Name`,
`OrgAccountBalance`
)  
VALUES  
( 
'$transactiontype', 
'$transid', 
'$transtime', 
'$transamount', 
'$businessshortcode', 
'$billrefno', 
'$invoiceno', 
'$msisdn',
'$firstname', 
'$middlename', 
'$lastname', 
'$orgaccountbalance' 
)";
mysqli_query($con, $sql);
echo '{"ResultCode":0,"ResultDesc":"Confirmation received successfully"}';
$ary = array(
    "money" => $transamount,
    "mine" => 2
);
echo json_encode($ary);
if (!mysqli_query($con, $sql)) {
    echo mysqli_error($con);
}
/*
  else
  {
  echo '{"ResultCode":0,"ResultDesc":"Confirmation received successfully"}';
  }
 */
mysqli_close($con);
?>