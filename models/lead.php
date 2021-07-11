<?php
    require_once("db.php");
    class lead extends db{
        public function checklead($leadid,$leadname){
            $sql="CALL spchecklead({$leadid},'{$leadname}')";
            $rst=$this->getData($sql);
            if($rst->rowCount()){
                return true;
            }else{
                return false;
            }
        }

        public function savelead($id,$leadname,$classificationid,$regionid,$management,$blocks,$units,$longitude,$latitude){
            if($this->checklead($id,$leadname)){
                return "A lead with similar name is already in use.";
            }else{
                $sql="CALL spsavelead({$id},{$classificationid},{$regionid},'{$leadname}',{$longitude},{$latitude},{$blocks},{$units},'{$management}',{$_SESSION['userid']})";
                //echo $sql."<br/>";
                $this->getData($sql);
                return 'success';
            }
        }

        public function getleads($regionid,$classificationid,$leadname){
            $sql="CALL spgetleads({$regionid},{$classificationid},'{$leadname}')";
            //echo $sql."<br/>";
            return $this->getJSON($sql);
        }

        public function getLeadDetails($id){
            $sql="CALL spgetleaddetails({$id})";
            return $this->getJSON($sql);
        }

        public function getRecentlyAddedLeads(){
            $sql="CALL spgetrecentlyaddedleads()";
            return $this->getJSON($sql);
        }
    }
?>