<?php
    require_once("../models/property.php");
    $property= new property();

    if(isset($_GET['getpropertytypes'])){
        $propertyid=$_GET['id'];
        echo $property->getpropertytypes($propertyid);
    }
    if(isset($_POST['savepropertytype'])){
        $id=$_POST['id'];
        $name=$_POST['name'];
        echo $property->savepropertytype($id,$name);
    }
    if(isset($_POST['deletepropertytype'])){
        $id=$_POST['id'];
        echo $property->deletepropertytype($id);
    }
    if(isset($_GET['getpropertyownertypes'])){
        $id=$_GET['id'];
        echo $property->getpropertyownertype($id);
    }
    if(isset($_POST['savepropertyownertype'])){
        $id=$_POST['id'];
        $name=$_POST['name'];
        echo $property->savepropertyownertype($id,$name);
    }
    if(isset($_POST['deletepropertyownertype'])){
        $id=$_POST['id'];
        echo $property->deletepropertyownertype($id);
    }
    if(isset($_POST['savepropertyowner'])){
        $id=$_POST['id'];
        $ownername=$_POST['name'];
        $type=$_POST['type'];
        $pinno=$_POST['pinno'];
        $physicaladdress=$_POST['physicaladdress'];
        $postaladdress=$_POST['postaladdress'];
        $town=$_POST['town'];
        $mobile=$_POST['mobile'];
        $email=$_POST['email'];
        $regdocid=$_POST['regdocid'];
        $regdocref=$_POST['regdocref'];
        echo $property->savepropertyowner($id,$type,$ownername,$physicaladdress,$postaladdress,$town,$mobile,$email,$pinno,$regdocid,$regdocref);
    }
    if(isset($_GET['getpropertyowners'])){
        $ownerid=$_GET['id'];
        echo $property->getpropertyowners($ownerid);
    }
    if(isset($_POST['saveproperty'])){
        $propertyid=$_POST['propertyid'];
        $typeid=$_POST['propertytype'];
        $ownerid=$_POST['ownerid'];
        $propertyname=$_POST['propertyname'];
        $physicallocation=$_POST['propertylocation'];
        $propertyblocks=$_POST['propertyblocks'];
        $propertyunits=$_POST['propertyunits'];
        $contactperson=$_POST['propertycontactperson'];
        $contactpersonmobile=$_POST['propertycontactpersonmobile'];
        $contactpersonemail=$_POST['propertycontactpersonemail'];
        $longitude=isset($_POST['longitude'])?$_POST['longitude']:0;
        $latitude=isset($_POST['latitude'])?$_POST['latitude']:0;
        $regionid=$_POST['regionid'];
        echo $property->savepropertydetails($propertyid,$ownerid,$typeid,$propertyname,$physicallocation,$longitude,$latitude,$contactperson,$contactpersonmobile,$contactpersonemail,$propertyblocks,$propertyunits,$regionid);
    }
    if(isset($_GET['getownerproperties'])){
        $ownerid=$_GET['ownerid'];
        echo $property->getOwnerProperties($ownerid);
    }
    if(isset($_GET['getpropertydetails'])){
        $id=$_GET['id'];
        echo $property->getpropertydetails($id);
    }
    if(isset($_POST['savepropertyblock'])){
        $propertyid=$_POST['propertyid'];
        $blockid=$_POST['blockid'];
        $blockname=$_POST['blockname'];
        $units=$_POST['blockunits'];
        echo $property->savePropertyBlock($propertyid,$blockid,$blockname,$units);
    }
    if(isset($_GET['getpropertyblocks'])){
        $propertyid=$_GET['propertyid'];
        $blockid=$_GET['blockid'];
        echo $property->getPropertyBlocks($propertyid,$blockid);
    }
    if(isset($_POST['savemultipleunits'])){
        $success=0;
        $failure=0;
        $failureunits="";
        $tableData = stripcslashes($_POST['TableData']);
        // Decode the JSON array
        $tableData = json_decode($tableData,TRUE);
        $blockid=$_POST['blockid'];
        $unittype=$_POST['unittype'];
        foreach($tableData as $unit){
            $unitid=0;
            $unitname=$unit['unitname'];
            $result=$property->saveunit($blockid,$unitid,$unitname,$unittype);
            $result=="success"?$success+=1:$failure+=1;
            if($result=="exists"){
                $failureunits .=$unitname.",";
            }
        }
        if($failure==0){
            echo $success." units added successfully.";
        }else{
            echo $success." units added successfully, ".$failure." units already exists (<strong>".$failureunits."</strong>)";
        }
    }
    if(isset($_GET['getpropertyunits'])){
        $propertyid=$_GET['propertyid'];
        $blockid=$_GET['blockid'];
        echo $property->getpropertyunits($propertyid,$blockid);
    }
    if(isset($_GET['getpropertyunitslist'])){
        $propertyid=$_GET['propertyid'];
        $blockid=$_GET['blockid'];
        echo $property->getpropertyunitslist($propertyid,$blockid);
    }
    if(isset($_GET['getunitdetails'])){
        $unitid=$_GET['unitid'];
        echo $property->getUnitDetails($unitid);
    }
    if(isset($_POST['savedocument'])){
        $id=$_POST['id'];
        $templateid=$_POST['templateid'];
        //$path=$_POST['base64'];
        $propertyid=$_POST['propertyid'];
        $documentname="../attachments/".rand(1000,10000).'-'.$_FILES['file']['name'];
        $tempname=$_FILES['file']['tmp_name'];
        if(move_uploaded_file($tempname,$documentname)){
            echo $property->savePropertyDocument($id,$templateid,$documentname,$propertyid);
        }else{
            echo "File was not uploaded. Please try again";
        }
    }
    if(isset($_GET['getpropertydocuments'])){
        $propertyid=$_GET['propertyid'];
        echo $property->getPropertyDocuments($propertyid);
    }
    if(isset($_POST['deletepropertydocument'])){
        $id=$_POST['id'];
        echo $property->deletePropertyDocument($id);
    }
?>