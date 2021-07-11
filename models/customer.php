<?php
    require_once("db.php");
    class customer extends db{
        public function checkCustomer($customerid,$searchfield,$searchvalue,$regdocid){
            $sql="CALL spcheckcustomerdetails({$customerid},'{$searchfield}','{$searchvalue}',{$regdocid})";
            $rst=$this->getData($sql);
            return $rst->rowCount()?true:false;
        }
        public function saveCustomers($customerid,$customername,$address,$town,$postalcode,$mobile,$email, $regdocid,$regdocrefno,$typeid,$pinno,$landline){
            if($this-> checkCustomer($customerid,'mobile',$mobile,$regdocid)){
                return "Sorry the mobile number is already registered in the system.";
            }else  if($this-> checkCustomer($customerid,'email',$email,$regdocid)){
                return "Sorry the Email address is already registered in the system.";
            }else  if($this-> checkCustomer($customerid,'regdoc',$regdocrefno,$regdocid)){
                return "Sorry the Email address is already registered in the system.";
            }else{
                // save the customer
                $sql="CALL spsavecustomerdetails({$customerid},'{$customername}','{$address}','{$town}','{$postalcode}','{$mobile}','{$email}',{$regdocid},'{$regdocrefno}',{$_SESSION['userid']},{$typeid},'{$pinno}','{$landline}')";
                //echo $sql."<br/>";
                $rst=$this->getData($sql);
                $row=$rst->fetch(PDO::FETCH_ASSOC);
                return $row['customerid'];
            }
        }
        public function checkUnitCustomer($id,$unitid,$customerid){
            $sql="CALL spcheckunitcustomer({$id},{$unitid},{$customerid})";
            $rst=$this->getData($sql);
            return $rst->rowCount()?true:false;
        }
    
        public function attachUnitCustomer($id,$unitid,$customerid,$startdate){
            if($this->checkUnitCustomer($id,$unitid,$customerid)){
                return "Another customer is already attached to the unit";
            }else{
                $startdate=$this->mySQLDate($startdate);
                $sql="CALL spattachcustomerunit({$id},{$unitid},{$customerid},'{$startdate}',{$_SESSION['userid']})";
                $this->getData($sql);
                return "success";
            }
        }
    
        public function detachUnitCustomer($id){
            $sql="CALL spdetachcustomerunit({$id},{$_SESSION['userid']})";
            $this->getData($sql);
            return "success";
        }

        public function getCustomerDetails($customerid){
            $sql="CALL spgetcustomerdetails({$customerid})";
            return $this->getJSON($sql);
        }

  
        public function getCustomer(){
            $sql="CALL spgetallcustomers()";
            return $this->getJSON($sql);
        }

        public function filterCustomers(){

        }
        
        public function getCustomerUnits($customerid){
            $sql="CALL spgetcustomerunits({$customerid})";
            return $this->getJSON($sql);
        }

        public function getcustomerstatement($meterid,$startdate,$enddate){
            $startdate=$this->mySQLDate($startdate);
            $enddate=$this->mySQLDate($enddate);
            $sql="CALL spgetcustomerstatement({$meterid},'{$startdate}','{$enddate}')";
            return $this->getJSON($sql);
        }

        public function getcustomeropenreceivables($customerid){
            $sql="CALL spgetcustomeropenreceivables($customerid)";
            return $this->getJSON($sql);
        }

        public function savecustomerpayment($customerid,$unitid,$meterid,$accounttype,$tariffid,$paymentmodeid,$paymentmoderef,$amount,$postexcesspayment){
            $paymentdate='2010-01-01';
            $sql="CALL spsavecustomerpayment({$customerid},{$unitid},{$meterid},'{$accounttype}',{$tariffid},{$paymentmodeid},'{$paymentmoderef}',{$amount},'{$paymentdate}',{$postexcesspayment},{$_SESSION['userid']})"; 
            //echo $sql."<br/>";
            $rst=$this->getData($sql);
            return $rst;
            //return "success";
        }
    }