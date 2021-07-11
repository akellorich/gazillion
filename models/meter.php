<?php 
    require_once("db.php");
    class meter extends db{
        public function checkMeterMake($id,$makename){
            $sql="CALL spcheckmetermakes({$id},'{$makename}')";
            $rst=$this->getData($sql);
            return $rst->rowCount()?true:false;
        }
        public function saveMeterMake($id,$makename){
            if($this->checkMeterMake($id,$makename)){
                return "Sorry, the Meter Make is already in use within the system";
            }else{
                $sql="CALL  spsavemetermake({$id},'{$makename}',{$_SESSION['userid']})";
                $this->getData($sql);
                return "success";
            }
            
        }
        public function getMeterMakes($id){
            $sql="CALL spgetmetermakes({$id})";
            return $this->getJSON($sql);
        }
        public function deleteMeterMake(){

        }
        public function checkMeterModel($modelid,$makeid,$modelname){
            $sql="CALL spcheckmetermodel({$modelid},{$makeid},'{$modelname}')";
            $rst=$this->getData($sql);
            return $rst->rowCount()?true:false;
        }
        public function saveMeterModel($modelid,$makeid,$modelname){
            if($this->checkMeterModel($modelid,$makeid,$modelname)){
                return "Sorry the Model has already been defined in the system";
            }else{
                $sql="CALL  spsavemetermodel({$modelid},{$makeid},'{$modelname}',{$_SESSION['userid']})";
                $this->getData($sql);
                return "success";
            }
        }
        public function getMeterModels($makeid,$modelid){
            $sql="CALL spgetmetermodels({$makeid},{$modelid})";
            // echo $sql."<br/>";
            return $this->getJSON($sql);
        }
        public function deleteMeterModel(){

        }
        public function checkMeter($meterid, $checkfield,$searchvalue){
            $sql="CALL spcheckmeter({$meterid}, '{$checkfield}','{$searchvalue}')";
            $rst=$this->getData($sql);
            return $rst->rowCount()?true:false;
        }
        public function saveMeter($meterid,$meterno,$serialno,$modelid,$tariffid){
            if($this->checkMeter($meterid, 'meterno',$meterno)){
                return "Sorry the meter number is already in use";
            }else if($this->checkMeter($meterid,'serialno',$serialno)){
                return "Sorry the Meter serail number is already in use.";
            }else{
                $sql="CALL spsavemeter({$meterid},'{$meterno}','{$serialno}',{$modelid},{$tariffid},{$_SESSION['userid']})";
                $this->getData($sql);
                return "success";
            }
        }
        public function deleteMeter(){

        }
        public function getMeter($makeid,$modelid,$meterid){
            $sql="CALL spgetmeters($makeid,$modelid,$meterid)";
            return $this->getJSON($sql);
        }

        public function checkUnitMeter($id,$unitid,$meterid){
            $sql="CALL spcheckunitmeters({$id},{$unitid},{$meterid})";
            $rst=$this->getData($sql);
            return  $rst->rowCount()?true:false;
        }

        public function saveUnitMeter($id,$unitid,$meterid){
            if($this->checkUnitMeter($id,$unitid,$meterid)){
                return "The Meter is attached and currently active in another unit";
            }else{
                $sql="CALL spattachunitmeter({$id},{$unitid},{$meterid},{$_SESSION['userid']})";
                $this->getData($sql);
                return "success";
            }
        }

        public function saveMeterReading($id,$customerid,$meterid,$unitid,$reading,$comments,$readby,$readdate,$billclient){
            $readdate=$this->mySQLDate($readdate);
            if($this->checkmeterreading($meterid,$readdate)){
                return "Sorry meter reading for the date has already been recorded.";
            }else{
                $sql="CALL spsavemeterreading({$id},{$customerid},{$unitid},{$meterid},{$reading},'{$comments}',{$_SESSION['userid']},{$readby},'{$readdate}',{$billclient})";
                $this->getData($sql);
                return "success"; 
            }
            
        }

        public function detachUnitMeter($id){
            $sql="CALL spdetachunitmeter({$id},{$_SESSION['userid']})";
            $this->getData($sql);
            return "success";
        }

        public function checkmeterreading($meterid,$date){
            $sql="CALL spcheckmeterreading({$meterid},'{$date}')";
            $rst=$this->getData($sql);
            return  $rst->rowCount()?true:false;
        }

        public function getmeterreadings($meterid,$startdate,$enddate){
            $startdate=$this->mySQLDate($startdate);
            $enddate=$this->mySQLDate($enddate);
            $sql="CALL spgetmeterreadings({$meterid},'{$startdate}','{$enddate}')";
            return $this->getJSON($sql);
        }
    }
?>
