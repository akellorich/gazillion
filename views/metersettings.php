<!DOCTYPE html>
<html lang="en">
<head>
<?php require_once("header.txt") ?>
    <title>Meter Settings</title>
</head>
<body>
    <?php require_once("navigation.txt"); ?>
    <div class="container-fluid">
        <div class="col-md-12 text-center ">
            <nav class="nav-justified ">
            <div class="nav nav-tabs " id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="pop1-tab" data-toggle="tab" href="#pop1" role="tab" aria-controls="pop1" aria-selected="true">Makes</a>
                <a class="nav-item nav-link" id="pop2-tab" data-toggle="tab" href="#pop2" role="tab" aria-controls="pop2" aria-selected="false">Models</a>
                <a class="nav-item nav-link" id="pop2-tab" data-toggle="tab" href="#pop3" role="tab" aria-controls="pop3" aria-selected="false">Meter Details</a>
            </div>
            </nav>
            <div class="tab-content text-left" id="nav-tabContent">
                <div class="tab-pane fade show active" id="pop1" role="tabpanel" aria-labelledby="pop1-tab">
                        <div class="pt-3"></div>
                        <table class="table table-sm table-striped">
                            <thead>
                                <th>#</th>
                                <th>Make Name</th>
                                <th>Models</th>
                                <th>Units</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody id="metermakeslist" class="metermakeslist"></tbody>
                        </table>
                    <button class="btn btn-success btn-sm" id="addmake" data-toggle="modal" data-target="#metermakedetails">Add Make</button>
                </div>
                <div class="tab-pane fade" id="pop2" role="tabpanel" aria-labelledby="pop2-tab">
                    <div class="pt-3"></div>
                    <div class="filteroption">
                        <div class="form-group">
                            <label for="modelmakefilter">Make</label>
                            <select name="modelmakefilter" id="modelmakefilter"></select>
                        </div>
                    </div>   
                    <table class="table table-sm table-striped">
                        <thead>
                            <th>#</th>
                            <th>Make</th>
                            <th>Model Name</th>
                            <th>Units</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                        </thead>
                        <tbody id="modelslist" class="modelslist"></tbody>
                    </table>
                    <button class="btn btn-success btn-sm" id="addmodel" data-toggle="modal" data-target="#metermodeldetails">Add Model</button>
                </div>
                <div class="tab-pane fade" id="pop3" role="tabpanel" aria-labelledby="pop3-tab">
                    <div class="pt-3"></div>
                    <div class="filtermeterdetails">
                        <div class="form-group">
                            <label for="metermakefilter">Make</label>
                            <select name="metermakefilter" id="metermakefilter"></select>
                            <label for="metermodel">Model</label>
                            <select name="metermodel" id="metermodel"></select>
                        </div>
                    </div>
                    <table class="table table-sm table-striped">
                        <thead>
                            <th>#</th>
                            <th>Make</th>
                            <th>Model</th>
                            <th>Meter #</th>
                            <th>Serial No</th>
                            <th>Unit</th>
                            <th>Customer</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                        </thead>
                        <tbody id="meterslist" class="meterslist"></tbody>
                    </table>
                    <button class='btn btn-sm btn-success' id="addmeter" data-toggle="modal" data-target="#meterdetails">Add Meter</button>
                </div>
            </div>
        </div>
        <!-- Modal for adding a METER make -->
        <div class="modal fade alert-dismissable fade" id="metermakedetails">
            <div class="modal-dialog">
                <div class="modal-content" id="makedetails">
                    <div class="modal-header">
                        <p  class="modal-title" >Provide Meter Make Details</p>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div> <!-- -->
                    <div class="modal-body">
                        <div id="makeerrors" class="makeerrors"></div>
                        <input type="hidden" id="makeid" value="0">
                        <div class="form-group row">
                            <label for="makename" class="col-sm-3 col-form-label">Make Name: </label>
                            <div class="col-sm-9">
                                <input name="makename" id="makename" class='form-control form-control-sm'>
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" id="savemake" >Save Meter Make</button>
                        <button type="button" class="btn btn-info btn-sm" id="clearmake" >Clear Fields</button>
                        <button type="button" class="btn btn-danger btn-sm" id="closemake" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal for adding a METER Model -->
    <div class="modal fade alert-dismissable fade" id="metermodeldetails">
            <div class="modal-dialog">
                <div class="modal-content" id="modeldetails">
                    <div class="modal-header">
                        <p  class="modal-title" ><h4>Provide Meter Model Details</h4></p>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div> <!-- -->
                    <div class="modal-body">
                        <div id="modelerrors" class="modelerrors"></div>
                        <input type="hidden" id="modelid" value="0">
                        <div class="form-group row">
                            <label for="addmodelmakename" class="col-sm-3 col-form-label">Make Name:</label>
                            <div class="col-sm-9">
                                <select name="addmodelmakename" id="addmodelmakename" class='form-control form-control-sm'></select>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="modelname" class="col-sm-3 col-form-label">Model Name:</label>
                            <div class="col-sm-9">
                                <input name="modelname" id="modelname" class='form-control form-control-sm'>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" id="savemodel" >Save Meter Model</button>
                        <button type="button" class="btn btn-info btn-sm" id="clearmodel" >Clear Fields</button>
                        <button type="button" class="btn btn-danger btn-sm" id="closemake" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
         <!-- Modal for adding a METER Details -->
         <div class="modal fade alert-dismissable fade" id="meterdetails">
            <div class="modal-dialog">
                <div class="modal-content" id="meters">
                    <div class="modal-header">
                        <p  class="modal-title" ><h5>Provide Meter Details</h5></p>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div> <!-- -->
                    <div class="modal-body">
                        <div id="metererrors" class="metererrors"></div>
                        <input type="hidden" id="meterid" value="0">
                        <div class="form-group row">
                            <label for="addmetermake" class="col-sm-3 col-form-label">Meter Make: </label>
                            <div class="col-sm-9">
                                <select name="addmetermake" id="addmetermake" class='form-control form-control-sm'></select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="addmetermodel" class="col-sm-3 col-form-label">Meter Model: </label>
                            <div class="col-sm-9">
                                <select name="addmetermodel" id="addmetermodel" class='form-control form-control-sm'></select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="meterpaymenttype" class="col-sm-3 col-form-label">Payment Type: </label>
                            <div class="col-sm-9">
                                <select name="meterpaymenttype" id="meterpaymenttype" class='form-control form-control-sm'>
                                   <!-- <option value="">&lt;Choose One&gt;</option>
                                    <option value="prepaid">Prepaid</option>
                                    <option value="postpaid">Postpaid</option> -->
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="meterserialno" class="col-sm-3 col-form-label">Serial Number: </label>
                            <div class="col-sm-9">
                                <input name="meterserialno" id="meterserialno" class='form-control form-control-sm'></select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="meteraccountno" class="col-sm-3 col-form-label">Acc. Number: </label>
                            <div class="col-sm-9">
                                <input name="meteraccountno" id="meteraccountno" class='form-control form-control-sm'></select>
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" id="savemeter" >Save Meter</button>
                        <button type="button" class="btn btn-info btn-sm" id="clearmeter" >Clear Fields</button>
                        <button type="button" class="btn btn-danger btn-sm" id="closemeter" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>
<?php require_once("footer.txt") ?>
<script src="../js/metersettings.js"></script>
</html>