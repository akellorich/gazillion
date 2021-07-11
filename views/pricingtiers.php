<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once("header.txt") ?>
    <title>Pricing Tiers</title>
</head>
<body>
    <?php require_once("navigation.txt")?>
    <div class="container-fluid">
        <div class="row">
            <div class="col col-md-3 mt-2">
                <button class="btn btn-secondary w-100 btn-sm" id="newtariff" data-toggle="modal" data-target="#addtariffdetails"> Add New</button>
                <button class="btn btn-success w-100 btn-sm mt-1" id="edittariff"> Edit</button>
                <button class="btn btn-danger w-100 btn-sm mt-1 mb-1" id="deletetariff"> Delete</button>
                <select multiple name="tariffslist" id="tariffslist" class="form-control form-control-sm list"></select>
            </div>
            <div class="col mt-2">
                <div class="row">
                    <div class="col">
                        <div id="rangeerrors"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-md-3">
                        <div class="form-group">
                            <label for="tariffname">Tariff Name:</label>
                            <input type="hidden" name="id" id="id" value="0">
                            <input type="text" id="tariffname" class="form-control form-control-sm" disabled>
                        </div>
                    </div>
                    <div class="col col-md-2">
                         <div class="form-group">
                            <label for="tarifftype">Tariff Type:</label>
                            <input type="text" id="tarifftype" class="form-control form-control-sm" disabled>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="minvalue">Min Quantity:</label>
                            <input type="number" id="minvalue" class="form-control form-control-sm" d>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="maxvalue">Max Quantity:</label>
                            <input type="number" id="maxvalue" class="form-control form-control-sm">
                        </div>       
                    </div> 
                    <div class="col">
                        <div class="form-group">
                            <label for="priceperkg">Price / KG:</label>
                            <input type="number" id="priceperkg" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="col col-md-1">
                        <label for="addtarrifrange">&nbsp;</label>
                        <button class="btn btn-sm btn-success form-control form-control-sm" id="addtariffrange">Add</button>
                    </div>
                </div>
                <table class="table table-striped table-sm" id="rangetable">
                    <thead>
                        <th>#</th>
                        <th>Min Quantity</th>
                        <th>Max Quantity</th>
                        <th>Price/KG</th>
                        <th>&nbsp</th> <!-- delete button -->
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal for tariff details -->
    <div class="modal fade alert-dismissable fade" id="addtariffdetails">
        <div class="modal-dialog">
            <div class="modal-content" id="tariffdetails">
                <div class="modal-header">
                    <p  class="modal-title" ><h5>Tariff Details</h5></p>
                    <button type="button" class="close" data-dismiss="modal">
                        <span class='font-weight-bold' >&times;</span>
                    </button>
                </div> <!-- -->
                <div class="modal-body">
                    <div id="tarifferrors" class="tarifferrors"></div>
                    <div class="form-group row">
                        <label for="addtarifftype" class="col-sm-3 col-form-label">Type:</label>
                        <div class="col-sm-9">
                            <select id="addtarifftype" name="addtarifftype" class='form-control form-control-sm'>
                                <option value="">&lt;Choose One&gt;</option>
                                <option value="prepaid">Prepaid</option>
                                <option value="postpaid">Postpaid</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="addtariffname" class="col-sm-3 col-form-label">Name:</label>
                        <div class="col-sm-9">
                            <input type="text" name="addtariffname" id="addtariffname" class='form-control form-control-sm'>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" id="savetariff" >Save Tariff</button>
                    <button type="button" class="btn btn-info btn-sm" id="resettariff" >Reset Fields</button>
                    <button type="button" class="btn btn-danger btn-sm" id="closetariff" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</body>
<?php require_once("footer.txt") ?>
<script src="../js/pricingtiers.js"></script>
</html>