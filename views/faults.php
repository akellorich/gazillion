<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fault Details</title>
    <?php require_once("header.txt") ?>
</head>
<body>
   <?php require_once("navigation.txt") ?>
   <div class="container-fluid mt-3">
        <div id="errors"></div>
        <table class="table table-sm table-striped" id="faultslist">
            <thead>
                <th>#</th>
                <th>Fault Name</th>
                <th>Fault Description</th>
                <th>Date Added</th>
                <th>Added By</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </thead>
            <tbody></tbody>
        </table>
        <button class="btn btn-sm btn-success" id="addfaultdetails">Add Fault</button>

   </div> <!---->
</body>
<!-- Modal for Adding a Fault  -->
<div class="modal fade alert-dismissable fade" id="faultdetailsmodal">
    <div class="modal-dialog">
        <div class="modal-content" id="faultdetailsmodalcontent">
            <div class="modal-header">
                <p  class="modal-title" ><h5>Enter Fault Details</h5></p>
                <button type="button" class="close" data-dismiss="modal">
                    <span class='font-weight-bold' >&times;</span>
                </button>
            </div> 
            <div class="modal-body">
                <div id="faultdetailserrors" class="faultdetailserrors"></div>
                <input type="hidden" name="faultid" id="faultid" value="0">
                <div class="form-group row">
                    <label for="faultdetailscategory" class="col-sm-3 col-form-label">Category: </label>
                    <div class="col-sm-9">
                        <select id="faultdetailscategory"  name="faultdetailscategory" class='form-control form-control-sm'></select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="faultsdetailsfaultname" class="col-sm-3 col-form-label">Name: </label>
                    <div class="col-sm-9">
                        <input type="text" id="faultsdetailsfaultname"  name="faultsdetailsfaultname" class='form-control form-control-sm'>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="faultsdetailsfaultdescription" class="col-sm-3 col-form-label">Description: </label>
                    <div class="col-sm-9">
                        <input type="text" id="faultsdetailsfaultdescription"  name="faultsdetailsfaultdescription" class='form-control form-control-sm'>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" id="savefaultdetails" >Save Fault</button>
                <button type="button" class="btn btn-info btn-sm" id="resetfaultdetailsfields" >Reset Fields</button>
                <button type="button" class="btn btn-danger btn-sm" id="closefaultdetailsmodal" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php require_once("footer.txt") ?>
<script src="../js/faults.js"></script>
</html>