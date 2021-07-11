<?php
  require_once("../models/mpesa.php");
  date_default_timezone_set('Africa/Nairobi');
 
  $stk=new MPesa();

  $mobilenumber="254724542213";
  $referenceno="ELLY";
  $amount=10;
  $description="This is accomodation invoice";
  echo $stk->initiatestk($mobilenumber,$referenceno,$amount,$description);
?>
