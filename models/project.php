<?php
    require_once("db.php");
    class project extends db{

        public function checkProject($projectid,$projectname){
            $sql="CALL spcheckproject({$projectid},'{$projectname}')";
            $rst=$this->getData($sql);
            return $rst->rowCount()?true:false;
        }

        public function saveproject(){
            if($this->checkProject($projectid,$projectname)){
                return "Sorry, the project name is already in use."
            }else{
                $sql="CALL spsaveproject({$projectid},'{$projectname}',{$propertyid},'{$startdate}','{$enddate}',{$leadid},{$_SESSION['userid']})";
                $this->getData($sql);
                return "success";
            }
        }

        public function deleteproject($projectid){
            $sql="CALL spdeleteproject({$projectid},{$_SESSION['userid']})";
            $this->getData($sql);
            return "success";
        }   

        public function getprojects($projectid){
            $sql="CALL spgetprojects({$projectid})";
            return $this->getJSON($sql);
        }

        public function checkprojectphase($projectid,$phaseid, $phasename){
            $sql="CALL spcheckprojectphase({$projectid},{$phaseid},'{$phasename}')";
            $rst=$this->getData($sql);
            return $rst->rowCount()?true:false;
        }

        public function saveprojectphased($phaseid,$projectid,$startdate,$enddate,$phasename){
            if($this->checkprojectphase($projectid,$phaseid, $phasename)){
                return "The project phase has already been defined.";
            }else{
                $sql="CALL spsaveprojectphase({$phaseid},{$projectid},'{$startdate}','{$enddate}','{$phasename}',{$_SESSION['userid']})";
                $this-getData($sql);
                return 'success'
            }
        }

        public function deleteprojectphase($phaseid){
            $sql="CALL spdeleteprojectphase({$phaseid},{$_SESSION['userid']})";
            $this->getData($sql);
            return 'success';
        }

        public function getprojectphases($projectid,$phaseid){
            $sql="CALL spgetprojectphases({$projectid},{$phaseid})";
            return $this->getJSON($sql);
        }

        public function checkprojectactivity($activityid,$phaseid,$activityname){
            $sql="CALL spcheckprojectactivity({$activityid},{$phaseid},'{$activityname}')";
            $rst=$this->getData($sql);
            return $rst->rowCount()?true:false;
        }

        public function saveprojectactivity($phaseid,$activityid,$startdate,$enddate,$activityname,$percentage){
            if(checkprojectactivity($activityid,$phaseid,$activityname)){
                return "The project phase activity has already been added."
            }else{
                $sql="CALL spsaveprojectactivity({$activityid},{$startdate},{$enddate},{$activityname},{$percentage},{$_SESSION['userid']})";
                $this->getData($sql);
                return "success";
            }
        }

        public function deleteprojectactivity($activityid){
            $sql="CALL spdeleteprojectactivity({$activityid},{$_SESSION['userid']})";
            $this->getData($sql);
            return "success";
        }

        public function getprojectactivities($phaseid,$activityid){
            $sql="CALL spgetprojectactivities({$phaseid},{$activityid})";
            return $this->getJSON($sql);
        }

        public function checkprojectmaterial($materialid,$activityid,$itemid){
            $sql="CALL spcheckprojectmaterial({$materialid},{$activityid},{$itemid})";
            $rst=$this->getData($sql);
            return $rst->rowCount()?true:false;
        }

        public function saveprojectmaterial($materialid,$itemid,$quantity,$unitprice,$activityid){
            if($this->checkprojectmaterial($materialid,$activityid,$itemid)){
                return "The material has already  been added to the Activity."
            }else{
                $sql="CALL spsaveprojectmaterial({$materialid},{$itemid},{$quantity},{$unitprice},{$activityid},{$_SESSION['userid']})";
                $this->getData($sql);
                return "success";
            }
        }

        public function deleteprojectmaterial($materialid){
            $sql="CALL spdeleteprojectmaterial({$materialid},{$_SESSION['userid']})";
            $this->getData($sql);
            return "success";
        }

        public function getprojectmaterials($activityid,$materialid){
            $sql="CALL spgetprojectmaterials({$activityid},{$materialid})";
            return $this->getJSON($sql);
        }
    }
?>