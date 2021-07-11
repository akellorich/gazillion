<?php
    require_once("db.php");
    
    class paymenttier extends db{
        public function checktier($id,$tiername){
            $sql="CALL spchecktierdetails({$id},'{$tiername}')";
            $rst=$this->getData($sql);
            return $rst->rowCount()?true:false;
        }
        public function checkRange($id,$minvalue,$maxvalue){
            $sql="CALL spchecktier({$id},{$minvalue},{$maxvalue})";
            $rst=$this->getData($sql);
            return $rst->rowCount()?true:false;
        }

        public function saveTier($id,$category,$tiername){
            if($this->checktier($id,$tiername)){
                return "Sorry the Tarrif has already been defined.";
            }else{
                $sql="CALL spsavepricingtier({$id},'{$tiername}','{$category}',{$_SESSION['userid']})";
                $this->getData($sql);
                //$row=$rst->fetch(PDO::FETCH_ASSOC);
                //return $row['tierid'];
                return "success";
            } 
        }

        public function getTiers($id){
            $sql="CALL spgettiers({$id})";
            return $this->getJSON($sql);
        }

        public function deleteTier($id){
            $sql="CALL spdeletetier({$id},{$_SESSION['userid']})";
            $this->getData($sql);
            return "success";
        }

        public function savetiervalues($id,$tierid,$minvalue,$maxvalue,$priceperkg){
            if($this->checkRange($tierid,$minvalue,$maxvalue)){
                return "Sorry, the range provided is already covered for the Tariff";
            }else{
                $sql="CALL spsavepricingtiervalues({$id},{$tierid},{$minvalue},{$maxvalue},{$priceperkg},{$_SESSION['userid']})";
                $this->getData($sql);
                return "success";
            }
        }

        public function deletetierrange($id){
            $sql="CALL spdeletetierrange({$id},{$_SESSION['userid']})";
            $this->getData($sql);
            return "success";
        }

        public function gettierrangevalues($id){
            $sql="CALL spgettariffrangevalues({$id})";
            return $this->getJSON($sql);
        }
    }
?>