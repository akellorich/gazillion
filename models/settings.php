<?php
require_once("db.php");
class settings extends db{
    public function getRegions(){
        $sql="CALL spgetregions()";
        echo $this->getJSON($sql);
    }

    public function getCustomerClassification(){
        $sql="CALL spgetcustomerclassification()";
        echo $this->getJSON($sql);
    }

    public function checkUnitOfMeasure($id,$unitofmeasure){
        $sql="CALL spcheckunitofmeasure({$id},'{$unitofmeasure}')";
        $rst=$this->getData($sql);
        return $rst->rowCount()?true:false;
    }

    public function saveUnitOfMeasure($id,$unitofmeasure){
        if($this->checkUnitOfMeasure($id,$unitofmeasure)){
            return "The unit of measure has already been defined in the system.";
        }else{
            $sql="CALL spsaveunitofmeasure({$id},'{$unitofmeasure}',{$_SESSION['userid']})";
            $this->getData($sql);
            return "success";
        }
    }

    public function deleteUnitOfMeasure($id){
        $sql="CALL spdeleteunitofmeasure({$id},{$_SESSION['userid']})";
        //echo $sql."<br/>";
        $this->getData($sql);
        return 'success';
    }

    public function getUnitsOfMeasure($id){
        $sql="CALL spgetunitofmeasure({$id})";
        return $this->getJSON($sql);
    }

    public function checkRegistrationDocument($id,$documentname){
        $sql="CALL spcheckregistrationdocument({$id},'{$documentname}')";
        $rst=$this->getData($sql);
        return $rst->rowCount()?true:false;
    }

    public function saveRegistrationDocument($id,$documentname){
        if($this->checkRegistrationDocument($id,$documentname)){
            return "The registration document has already been defined in the system";
        }else{
            $sql="CALL spsaveregistrationdocument({$id},'{$documentname}',{$_SESSION['userid']})";
            $this->getData($sql);
            return "success";
        }
    }

    public function deleteRegistrationDocument($id){
        $sql="CALL spdeleteregistrationdocument({$id},{$_SESSION['userid']})";
        $this->getData($sql);
        return "success";
    }

    public function getRegistrationDocuments($id){
        $sql="CALL spgetregistrationdocuments({$id})";
        return $this->getJSON($sql);
    }

    public function checkunittype($id,$description){
        $sql="CALL spcheckunittype({$id} ,'{$description}')";
        $rst=$this->getData($sql);
        return $rst->rowCount()?true:false;
    }

    public function saveunittype($id,$description){
        if($this->checkunittype($id,$description)){
            return "The unit type is already defined";
        }else{
            $sql="CALL spsaveunittype({$id},'{$description}',{$_SESSION['userid']})";
            $this->getData($sql);
            return "success";
        }
    }

    public function getunittypes($id){
        $sql="CALL spgetunittypes({$id})";
        return $this->getJSON($sql);
    }

    public function deleteunittype($id){
        $sql="CALL spdeleteunittype({$id},{$_SESSION['userid']})";
        $this->getData($sql);
        return "success";
    }
    public function getPaymentMethods(){
        $sql="CALL spgetpaymentmethods()";
        return $this->getJSON($sql);
    }

    public function savempesaconfiguration($consumerkey,$consumersecret,$validationurl,$confirmationurl,$paybillnumber){
        $sql="CALL spsavempesaconfiguration('{$consumerkey}','{$consumersecret}','{$validationurl}','{$confirmationurl}',{$paybillnumber})";
        $this->getData($sql);
        return "success";
    }

    public function getmpesaconfiguration(){
        $sql="CALL spgetmpesaconfiguration()";
        return $this->getJSON($sql);
    }

    public function saveemailconfiguration($emailaddress,$emailpassword,$smtpserver,$smtpport,$usessl){
        $sql="CALL spsaveemailconfiguration('{$emailaddress}','{$emailpassword}','{$smtpserver}',{$smtpport},{$usessl})";
        $this->getData($sql);
        return"success";
    }

    public function getemailconfiguration(){
        $sql="CALL spgetemailconfiguration()";
        return $this->getJSON($sql);
    }

    public function savesmsconfiguration($senderid,$username,$apikey){
        $sql="CALL spsavesmsconfiguration('{$senderid}','{$username}','{$apikey}')";
        $this->getData($sql);
        return "success";
    }

    public function getsmsconfiguration(){
        $sql="CALL spgetsmsconfiguration()";
        return $this->getJSON($sql);
    }

    public function getsmsconfigurationasobject(){
        $sql="CALL spgetsmsconfiguration()";
        return $this->getData($sql);
    }

    public function getemailconfigurationasobject(){
        $sql="CALL spgetemailconfiguration()";
        return $this->getData($sql);
    }

    public function getmpesaconfigurationasobject(){
        $sql="CALL spgetmpesaconfiguration()";
        return $this->getData($sql);
    }

   

    public function getpropertydocumenttemplates(){
        $sql="CALL spgetpropertydocumenttemplates()";
        return $this->getJSON($sql);
    }

    public function savempesac2bparameters($url,$shortcode,$msisdn){
        $sql="CALL spsavempesac2bparameters('{$url}','{$shortcode}','{$msisdn}')";
        $this->getData($sql);
        return "success";
    }

    public function getmpesac2bparameters(){
        $sql="CALL spgetmpesac2bparameters()";
        return $this->getJSON($sql);
    } 
    
    public function getfaultcategories(){
        $sql="CALL spgetfaultcategories()";
        return $this->getJSON($sql);
    }

    public function checkfaults($id,$faultname){
        $sql="CALL `spcheckfault`({$id},'{$faultname}')";
        return $this->getData($sql)->rowCount()?true:false;
    }

    public function savefault($id, $faultname,$faultdescription,$categoryid){
        if($this->checkfaults($id,$faultname)){
            return "exists";
        }else{
            $sql="CALL `spsavefault`({$id}, '{$faultname}','{$faultdescription}',{$categoryid},{$_SESSION['userid']})";
            $this->getData($sql);
            return "success";
        }
    }

    public function deletefault($faultid){
        $sql="CALL `spdeletefault`({$faultid},{$_SESSION['userid']})";
        $this->getData($sql);
        return "success";
    }

    public function getfaults($categoryid){
        $sql="CALL `spgetfaults`({$categoryid})";
        return $this->getJSON($sql);
    }

}
?>