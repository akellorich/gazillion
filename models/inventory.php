<?php
    require_once("db.php");

    class inventory extends db{

        public function checkitemcategory($id,$categoryname){
            $sql="CALL spcheckitemcategory({$id},'{$categoryname}')";
            $rst=$this->getData($sql);
            return $rst->rowCount()?true:false;
        }

        public function saveitemcategory($id,$categoryname){
            if($this->checkitemcategory($id,$categoryname)){
                return "Sorry, the item category is already in use";
            }else{
                $sql="CALL spsaveitemcategory({$id},'{$categoryname}',{$_SESSION['userid']})";
                $this->getData($sql);
                return "success";
            }
        }

        public function deleteitemcategory($id){
            $sql="CALL spdeleteitemcategory({$id},{$_SESSION['userid']})";
            $this->getData($sql);
            return "success";
        }

        public function getitemcategories($id){
            $sql="CALL spgetitemcategories({$id})";
            return $this->getJSON($sql);
        }   

        public function checkitem($id,$checkfield,$searchvalue){
            $sql="CALL spcheckcatalogitem({$id},'{$checkfield}','{$searchvalue}')";
            $rst=$this->getData($sql);
            return $rst->rowCount()?true:false;
        }

        public function saveitem($id,$barcode,$itemname,$categoryid, $averageprice,$unitofmeasureid){            
            if($this->checkitem($id,'barcode',$barcode)){
                // check barcode
                return "Sorry, the item barcode s already in use";
            }else if ($this->checkitem($id,'itemname',$itemname)){
                // check item name  
                return "Sorry, the item name is already in use.";
            }else{
                // save the item
                $sql="CALL spsavecatalogitem({$id},'{$barcode}','{$itemname}',{$categoryid},{$averageprice},{$_SESSION['userid']},{$unitofmeasureid})";
                $this->getData($sql);
                return "success";
            }
        }

        public function deleteitem($id){
            $sql="CALL spdeletecatalogitem({$id},{$_SESSION['userid']})";
            $this->getData($sql);
            return "success";
        }

        public function getitems($id){
            $sql="CALL spgetcatalogitems({$id})";
            return $this->getJSON($sql);
        }

        public function getsupplierproducts($supplierid){

        }

        public function filteritems($categoryid){
            
        }
    }
?>