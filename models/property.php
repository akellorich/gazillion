<?php
require_once("db.php");
class property extends db{

    public function checkpropertytype($id,$propertytype){
        $sql="CALL spcheckpropertytype({$id},'{$propertytype}')";
        $rst=$this->getData($sql);
        return $rst->rowCount()?true:false;
    }

    public function savepropertytype($id,$propertytype){
        if($this->checkpropertytype($id,$propertytype)){
            return "Sorry, the property type has already been defined in the system.";
        }else{
            $sql="CALL spsavepropertytype({$id},'{$propertytype}',{$_SESSION['userid']})";
            $this->getData($sql);
            return "success";
        }
    }

    public function deletepropertytype($id){
        $sql="CALL spdeletepropertytype({$id},{$_SESSION['userid']})";
        $this->getData($sql);
        return "success";
    }

    public function getpropertytypes($propertyid){
        $sql="CALL spgetpropertytypes({$propertyid})";
        return $this->getJSON($sql);
    }

    public function checkpropertyownertype($id, $propertyownertype){
        $sql="CALL spcheckpropertyownertype({$id}, '{$propertyownertype}')";
        $rst=$this->getData($sql);
        return $rst->rowCount()?true:false;
    }

    public function savepropertyownertype($id,$propertyownertype){
        if($this->checkpropertyownertype($id, $propertyownertype)){
            return "Sorry, owner type already in use within the system.";
        }else{
            $sql="CALL spsavepropertyownertype($id,'{$propertyownertype}',{$_SESSION['userid']})";
            $this->getData($sql);
            return "success";
        }
    }

    public function deletepropertyownertype($id){
        $sql="CALL spdeletepropertyownertype({$id},{$_SESSION['userid']})";
        $this->getData($sql);
        return "success";
    }

    public function getpropertyownertype($id){
        $sql="CALL spgetpropertyownertypes({$id})";
        return $this->getJSON($sql);
    }

    public function checkpropertyowner($id,$checkfield,$searchvalue,$regdocid){
        $sql="CALL spcheckpropertyowner({$id},'{$checkfield}','{$searchvalue}',{$regdocid})";
        //echo $sql."<br/>";
        $rst=$this->getData($sql);
        return $rst->rowCount()?true:false;
    }

    public function savepropertyowner($id,$ownertypeid,$ownername,$physicaladdress,$postaladdress,$town,$mobile,$email,$pinno,$regdocid,$regdocref){
        
        if($this->checkpropertyowner($id,'name',$ownername,$regdocid)){
            // check name
            return "Sorry, the property owner is already registered in the system.";
        }else if($this->checkpropertyowner($id,'pinno',$pinno,$regdocid)){
            // check pinno   
            return "Sorry, PIN number already registered to a different property owner in the system.";
        }else if($this->checkpropertyowner($id,'regdoc',$regdocref,$regdocid)){
            // check regdoc no  
            return "Sorry, Registration Document already in use with a different property owner in the system.";
        }else{
            $sql="CALL spsavepropertyowner({$id},{$ownertypeid},'{$ownername}','{$physicaladdress}','{$postaladdress}','{$town}','{$mobile}','{$email}','{$pinno}',{$regdocid},'{$regdocref}',{$_SESSION['userid']})";
            $this->getData($sql);
            return "success";
        }
    }

    public function getpropertyowners($ownerid){
        $sql="CALL spgetpropertyowners({$ownerid})";
        return $this->getJSON($sql);
    }

    public function checkpropertydetails($id,$propertyname){
        $sql="CALL spcheckpropertydetails({$id},'{$propertyname}')";
        $rst=$this->getData($sql);
        return $rst->rowCount()?true:false;
    }

    public function savepropertydetails($propertyid,$ownerid,$typeid,$propertyname,$physicallocation,$longitude,$latitude,$contactperson,$contactpersonmobile,$contactpersonemail,$blocks,$units,$regionid){
        if($this->checkpropertydetails($propertyid,$propertyname)){
            return "Sorry, the property name is already in use within the system.";
        }else{
            $sql="CALL spsavepropertydetails({$propertyid},{$ownerid},{$typeid},'{$propertyname}','{$physicallocation}',{$longitude},{$latitude},'{$contactperson}','{$contactpersonmobile}','{$contactpersonemail}',{$_SESSION['userid']},{$blocks},{$units},{$regionid})";
            $this->getData($sql);
            return 'success';
        }
    }

    public function deletepropertydetails(){
       
    }

    public function getpropertydetails($propertyid){
        $sql="CALL spgetpropertydetails($propertyid)";
        return $this->getJSON($sql);
    }

    function getOwnerProperties($id){
        $sql="CALL spgetownerproperties({$id})";
        return $this->getJSON($sql);
    }

    public function checkPropertyBlockName($propertyid,$blockid,$blockname){
        $sql="CALL spcheckpropertyblock({$blockid},{$propertyid},'{$blockname}')";
        $rst=$this->getData($sql);
        return $rst->rowCount()?true:false;
    }

    public function savePropertyBlock($propertyid,$blockid,$blockname,$units){
        if($this->checkPropertyBlockName($propertyid,$blockid,$blockname)){
            return "The block name has already been defined for the property.";
        }else{
            $sql="CALL spsavepropertyblock({$blockid}, {$propertyid},'{$blockname}',{$units},{$_SESSION['userid']})";
            $this->getData($sql);
            return "success";
        }
    }

    public function getPropertyBlocks($propertyid,$blockid){
        $sql="CALL spgetpropertyblocks({$propertyid},{$blockid})";
        return $this->getJSON($sql);
    }

    public function checkunit($blockid,$unitid,$unitname){
        $sql="CALL spcheckpropertyunit({$blockid},{$unitid},'{$unitname}')";
        $rst=$this->getData($sql);
        return $rst->rowCount()?true:false;
    }

    public function saveunit($blockid,$unitid,$unitname,$unittype){
        if($this->checkunit($blockid,$unitid,$unitname)){
            return "exists";
        }else{
            $sql="CALL spsavepropertyunit({$unitid},{$blockid},'{$unitname}',{$unittype},{$_SESSION['userid']})";
            $this->getData($sql);
            return "success";
        } 
    }

    public function getpropertyunits($propertyid,$blockid){
        $sql="CALL spgetpropertyunits({$propertyid},{$blockid})";
        return $this->getJSON($sql);
    }

    public function getUnitDetails($unitid){
        $sql="CALL spgetunitdetails({$unitid})";
        return $this->getJSON($sql);
    }

    public function getpropertyunitslist($propertyid,$blockid){
        $sql="CALL spgetpropertyunitslist({$propertyid},{$blockid})";
        return $this->getJSON($sql);
    }

    public function savePropertyDocument($id,$templateid,$base64,$propertyid){
        if ($this->checkattacheddocument($propertyid,$templateid)){
            return "exists";
        }else{
            $sql="CALL spsavepropertydocument({$id},{$templateid},'{$base64}',{$propertyid},{$_SESSION['userid']})";
            $this->getData($sql);
            return "success";
        }
       
    }

    public function getPropertyDocuments($propertyid){
        $sql="CALL spgetpropertydocuments({$propertyid})";
        return $this->getJSON($sql);
    }

    public function deletePropertyDocument($id){
        $sql="CALL spdeletepropertydocument({$id})";
        $this->getData($sql);
        return "success";
    }

    public function checkattacheddocument($propertyid,$templateid){
        $sql="CALL spcheckattachedpropertydocument({$propertyid},{$templateid})";
        $rst=$this->getData($sql);
        return $rst->rowCount()?true:false;
    }
}

?>