<?php
    require_once("../models/lead.php");
    $lead=new lead();
    if(isset($_GET['getleads'])){
        $regionid=$_GET['region'];
        $classificationid=$_GET['classification'];
        $leadname=$_GET['leadname'];
        echo $lead->getleads($regionid,$classificationid,$leadname); 
    }
    if(isset($_GET['getleaddetails'])){
        $id=$_GET['leadid'];
        echo $lead->getLeadDetails($id);
    }
    if(isset($_GET['getrecentlyaddedleads'])){
       echo  $lead->getRecentlyAddedLeads();
    }
    if(isset($_POST['savelead'])){
        $id=$_POST['id'];
        $leadname=$_POST['leadname'];
        $classificationid=$_POST['classification'];
        $regionid=$_POST['region'];
        $management=$_POST['management'];
        $blocks=$_POST['blocks'];
        $units=$_POST['units'];
        $longitude=isset($_POST['longitude'])?$_POST['longitude']:0;
        $latitude=isset($_POST['latitude'])?$_POST['latitude']:0;
        echo $lead->savelead($id,$leadname,$classificationid,$regionid,$management,$blocks,$units,$longitude,$latitude);
    }
?>