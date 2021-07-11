<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment Details</title>
    <?php require_once("header.txt") ?>
</head>
<body>
   <?php require_once("navigation.txt") ?>
   <div class="container-fluid mt-3">
        <div id="errors"></div>
        <input type="hidden" name="id" id="id" value="0">
        <div class="row">
            <div class="col col-md-2">
                <div class="form-group">
                    <label for="vouchernumber">Voucher Number</label>
                    <input type="text" id='vouchernumber' class='form-control form-control-sm'>
                </div>
            </div>
            <div class="col col-md-1">
                <div class="fom-group groupedcheckbox">
                    <input type="checkbox" class="form-check-input" id="generatevoucherno">
                    <label class="form-check-label" for="generatevoucherno">Auto Generate</label>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="text" id="date" class='form-control form-control-sm'>
                </div>
            </div>

            <div class="col">  
                <div class="form-group">
                    <label for="supplier">Supplier</label>
                    <select name="supplier" id="supplier" class='form-control form-control-sm'></select>
                </div>
            </div>
            
            <div class="col"> 
                <div class="form-group">
                    <label for="invoicenumber">Invoice Number</label>
                    <select id="invoicenumber" class='form-control form-control-sm'></select>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col">
                <div class="form-group">
                    <label for="costcenter">Cost Center</label>
                    <select name="costcenter" id="costcenter" class='form-control form-control-sm'></select>
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <label for="paymentmode">Payment Mode</label>
                    <select name="paymentmode" id="paymentmode"  class='form-control form-control-sm'></select>
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <label for="paidfrom">Paid From</label>
                    <select name="paidfrom" id="paidfrom"  class='form-control form-control-sm'></select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="referencenumber">Reference Number</label>
                    <input type="text" id="referencenumber"  class='form-control form-control-sm'>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col col-md-2">
                <div class="form-group">
                    <label for="itemcode">Item Code</label>
                    <input type="text" id="itemcode" name="itemcode" class='form-control form-control-sm'>
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" id="description" name="description" class='form-control form-control-sm'>
                </div>
            </div>

            <div class="col col-md-2">
                <div class="from-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" id="quantity" name="quantity" class="form-control form-control-sm">
                </div>
            </div>

            <div class="col col-md-2">
                <div class="form-group">
                    <label for="unitprice">Unit Price</label>
                    <input type="number" id="unitprice" name="unitprice" class="form-control form-control-sm">
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <label for="Account Charged">Account Charged</label>
                    <select name="accountcharged" id="accountcharged" class="form-control form-control-sm"></select>
                    
                </div>
            </div>
            <div class="col col-md-1">
                <label for="addtolist">&nbsp;</label>
                <button class='btn btn-sm btn-dark form-control form-control-sm' id="addtolist">Add to List</button>
            </div>
        </div>
        <table class='table table-striped table-sm' id="paymentdetails">
            <thead>
                <th> Item Code </th>
                <th> Description </th>
                <th> Quantity </th>
                <th> Unit Price </th>
                <th> Account Charged </th>
                <th> Line Total </th>
                <th> &nbsp; </th>
                <th> &nbsp; </th>
            </thead>

            <tbody>
    
            </tbody>
        </table>

        <div class="row">
            <div class="col col-md-10">
                <button class='btn btn-success' id="save">Save Payment</button>
                <button class='btn btn-danger' id="clear">Clear Screen</button>
            </div>
            <div class="col">
                <p class='alert alert-success text-right font-weight-bold'>TOTAL:    <span class='total' id='total'>0.00</span></p>
            </div>
        </div>
   </div>
</body>

<?php require_once("footer.txt") ?>
<script src="../js/paymentdetails.js"></script>
</html>