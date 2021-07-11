<?php
    require_once("../models/inventory.php");
    
    $inventory=new inventory();

    if(isset($_GET['getcategories'])){
        $categoryid= !isset($_GET['categoryid'])?0:$_GET['categoryid'];
        echo $inventory->getitemcategories($categoryid);
    }

    if(isset($_GET['getsupplierproducts'])){
        $supplierid=$_GET['supplierid'];
        echo $inventory->getsupplierproducts($supplierid);
    }
    if(isset($_GET['getproductbycategory'])){
        $categoryid=$_GET['categoryid'];
        echo $inventory->filteritems($categoryid);

    }


?>