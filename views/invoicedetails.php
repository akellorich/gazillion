<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Supplier Invoice Details</title>
    <?php require_once("header.txt") ?>
</head>
<body>
    <?php require_once("navigation.txt") ?>
    <div class="container-fluid invoice">
        <div class="row">
            <div class="col col-md-3">
                <div class="card mt-3">
                    <div class="card-header">
                        <h5>Filter Options</h5>
                    </div>
                    <div class="card-body">
                        <div id="errors" class="errors"></div>
                        <div class="form-group">
                            <label for="supplier">Supplier</label>
                            <select name="supplier" id="supplier" class='form-control form-control-sm'></select>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="checkbox-group">
                                    <input type="checkbox" name="alldates" id="alldates"> All Dates
                                </div>
                            </div>
                        </div>
                       
                        <div class="row">
                           
                            <div class="col">
                                <label for="startdate">Start Date</label>
                                <input type="text" id="startdate" name="startdate" class='form-control form-control-sm'>
                            </div>
                            <div class="col">
                                <label for="enddate">End Date</label>
                                <input type="text" id="enddate" name="enddate" class='form-control form-control-sm'>
                            </div>
                            <button class='btn btn-dark btn-sm w-100 mt-3' id="searchgrn">Filter GRNs</button>
                        </div>

                    </div>
                </div>

                <div class="card mt-2">
                    <div class="card-header">
                        <h5>Invoice Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="invoicetotal">Invoice Amount</label>
                            <input type="text" id="invoicetotal" disabled class='form-control text-right lead font-weight-bold' value="0.00">
                        </div>
                        <div class="form-group">
                            <label for="invoiceno">Invoice #</label>
                            <input type="text" id="invoiceno" class='form-control form-control-sm'>
                        </div>
                        <div class="form-group">
                            <label for="invoicedate">Invoice Date</label>
                            <input type="text" id="invoicedate" name="invoicedate" class="form-control form-control-sm">
                        </div>
                        <button class='btn btn-success' id="saveinvoice">Save Invoice</button>
                        <button class='btn btn-danger'>Clear Form</button>
                    </div>
                </div>
            </div> 
        
            <div class="col">
                <div class="card mt-3">
                    <div class="card-header">
                        <h5>Uninvoiced Goods Received Notes</h5>
                    </div>
                    <div>
                        <table class="table table-striped table-sm">
                            <thead>
                                <th><input type='checkbox' id='allgrn'></th>
                                <th>#</th>
                                <th>GRN Number</th>
                                <th>Delivery Note Number</th>
                                <th>Date Received</th>
                                <th>Amount</th>
                            </thead>
                            <tbody id="uninvoicedgrns">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    
</body>
<?php require_once("footer.txt") ?>
<script src="../js/invoicedetails.js"></script>
</html>