<?php
require_once("../models/settings.php");
$settings=new settings;
if(isset($_GET['getregions'])){
    $settings->getRegions();
}
if(isset($_GET['getcustomerclassifications'])){
    $settings->getCustomerClassification();
}
if(isset($_GET['getuom'])){
    $id=$_GET['id'];
    echo $settings->getUnitsOfMeasure($id);
}
if(isset($_POST['saveuom'])){
    $id=$_POST['id'];
    $name=$_POST['name'];
    echo  $settings->saveUnitOfMeasure($id,$name);
}
if(isset($_POST['deleteuom'])){
    $id=$_POST['id'];
    echo $settings->deleteUnitOfMeasure($id);
}
if(isset($_GET['getregdocs'])){
    $id=$_GET['id'];
    echo $settings->getRegistrationDocuments($id);
}
if(isset($_POST['saveregdoc'])){
    $id=$_POST['id'];
    $name=$_POST['name'];
    echo $settings->saveRegistrationDocument($id,$name);
}
if(isset($_POST['deleteregdoc'])){
    $id=$_POST['id'];
    echo $settings->deleteRegistrationDocument($id);
}
if(isset($_POST['saveunittype'])){
    $id=$_POST['id'];
    $description=$_POST['name'];
    echo $settings-> saveunittype($id,$description);
}
if(isset($_GET['getunittypes'])){
    $id=$_GET['id'];
    echo $settings->getunittypes($id);
}
if(isset($_POST['deleteunittype'])){
    $id=$_POST['id'];
    echo $settings->deleteunittype($id);
}
if(isset($_GET['getpaymentmethods'])){
    echo $settings->getPaymentMethods();
}
if(isset($_POST['savempesaconfiguraion'])){
    $consumerkey=$_POST['consumerkey'];
    $consumersecret=$_POST['consumersecret'];
    $paybillnumber=$_POST['paybillnumber'];
    $validationurl=$_POST['validationurl'];
    $confirmationurl=$_POST['confirmationurl'];
    echo $settings->savempesaconfiguration($consumerkey,$consumersecret,$validationurl,$confirmationurl,$paybillnumber);    
}
if(isset($_GET['getmpesaconfiguration'])){
    echo $settings->getmpesaconfiguration();
}
if(isset($_POST['saveemailconfiguration'])){
    $emailaddress=$_POST['emailaddress'];
    $emailpassword=$_POST['password'];
    $smtpserver=$_POST['smtpserver'];
    $smtpport=$_POST['smtpport'];
    $usessl=$_POST['usessl'];
    echo $settings->saveemailconfiguration($emailaddress,$emailpassword,$smtpserver,$smtpport,$usessl);
}
if(isset($_GET['getemailconfiguration'])){
    echo $settings->getemailconfiguration();
}
if(isset($_POST['savesmsconfiguration'])){
    $senderid=$_POST['senderid'];
    $username=$_POST['username'];
    $apikey=$_POST['apikey'];
    echo $settings->savesmsconfiguration($senderid,$username,$apikey);
}
if(isset($_GET['getsmsconfiguration'])){
    echo $settings->getsmsconfiguration();
}
if(isset($_GET['getfaultcategories'])){
    echo $settings->getfaultcategories();
}
if(isset($_GET['getpropertydocumenttemplates'])){
    echo $settings->getpropertydocumenttemplates();
}
if(isset($_GET['getmpesac2bparameters'])){
    echo $settings->getmpesac2bparameters();
}
if(isset($_POST['savempesac2bparameters'])){
    $url=$_POST['url'];
    $shortcode=$_POST['shortcode'];
    $msisdn=$_POST['msisdn'];
    echo $settings->savempesac2bparameters($url,$shortcode,$msisdn);
}
if(isset($_POST['savefault'])){
    $faultid=$_POST['faultid'];
    $categoryid=$_POST['categoryid'];
    $faultname=$_POST['faultname'];
    $faultdescription=$_POST['faultdescription'];
    echo $settings->savefault($faultid, $faultname,$faultdescription,$categoryid);
}
if(isset($_GET['getexistingfaults'])){
    $categoryid=!isset($_GET['categoryid'])?0:$_GET['categoryid'];
    echo $settings-> getfaults($categoryid);
}
?>