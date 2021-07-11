<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once("header.txt") ?>
    <title>Leads Management</title>
</head>
<body>
    <!-- include navigation -->
    <?php require_once("navigation.txt") ?>
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col col-md-3">
                <div class="row" >
                    <div class="col">
                        <div class="filteroptions" id="filteroptions">
                            <p class='font-weight-bold'>Filter Options</p>
                            <div class="form-group row">
                                <label for="filterregion" class="col-sm-4 col-form-label">Region: </label>
                                <div class="col-sm-8">
                                    <select name="filterregion" id="filterregion" class="form-control form-control-sm"></select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="filterclassification" class="col-sm-4 col-form-label">Classification</label>
                                <div class="col-sm-8">
                                    <select name="filterclassification" id="filterclassification" class="form-control form-control-sm">
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="searchlead" class="col-sm-4 col-form-label">Lead Name:</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control form-control-sm" placeholder="Search ..." id="searchlead" name="searchlead">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-secondary btn-sm" id="searchbutton">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- List of Leads will be shown here --> 
                            <div class="form-group">
                                <!-- <label for="leadslist">Example multiple select</label> -->
                                <select multiple class="form-control form-control-sm list" id="leadslist"></select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="recentlyaddedleads" id="recentlyaddedleads"></div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div id="leadsmaps" class="h-75 leadsmap">
                    
                </div>
                
                <div id="leadinfo" class="h-25 leadinfo">
                    
                    <p class="alert alert-secondary">Lead Details</p>
                        <div class="row">
                            <div class="col">Region: <span class='region font-weight-bold'></span></div>
                            <div class="col">Classification: <span class='classification font-weight-bold'></span></div>
                            <div class="col">Lead Name: <span class='leadname font-weight-bold'></span></div>
                        </div>
                
                    <div class="row">
                        <div class="col">Property Manager: <span class='propertymanager font-weight-bold'></span></div>
                        <div class="col">Blocks: <span class='blocks font-weight-bold'></span></div>
                        <div class="col">Units: <span class='units font-weight-bold'></span></div>
                    </div>
                    <div class="row">
                        <div class="col mt-2">
                            <button class='btn btn-secondary btn-sm' id="addnewlead'" data-toggle="modal" data-target="#leaddetails">Add New Lead</button>
                            <button class='btn btn-info btn-sm' id='editlead' data-toggle="modal" data-target="#leaddetails">Edit Lead Details</button>
                            <button class='btn btn-danger btn-sm' id='deletelead'>Delete Lead</button>
                        </div>
                    </div> 
                   
                </div>
                   
            </div>
        </div>

        <div class="modal fade alert-dismissable fade" id="leaddetails">
            <div class="modal-dialog">
                <div class="modal-content" id="heldsalesdetails">
                    <div class="modal-header">
                        <p  class="modal-title" >Provide Lead Details</p>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div> <!-- -->
                    <div class="modal-body">
                        <div id="leaderrors" class="leaderrors"></div>
                        <input type="hidden" id="leadid" value="0">
                        <div class="form-group row">
                            <label for="leadregion" class="col-sm-3 col-form-label">Region: </label>
                            <div class="col-sm-9">
                                <select name="leadregion" id="leadregion" class='form-control form-control-sm'></select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="leadclassification" class="col-sm-3 col-form-label">Classification</label>
                            <div class="col-sm-9">
                                <select name="leadclassification" id="leadclassification" class='form-control form-control-sm'></select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="leadname" class="col-sm-3 col-form-label">Lead Name</label>
                            <div class="col-sm-9"><input type="text" id="leadname" name="leadname" class='form-control form-control-sm'></div>
                        </div>
                        <div class="form-group row">
                            <label for="leadblocks" class="col-sm-3 col-form-label">Blocks</label>
                            <div class="col-sm-9"><input type="number" id="leadblocks"  name="leadblocks" class='form-control form-control-sm'></div>
                        </div>
                        <div class="form-group row">
                            <label for="leadunits" class="col-sm-3 col-form-label">Units</label>
                            <div class="col-sm-9"><input type="number" id="leadunits"  name="leadunits" class='form-control form-control-sm'></div>
                        </div>
                        <div class="form-group row">
                            <label for="leadmanagement" class="col-sm-3 col-form-label">Management</label>
                            <div class="col-sm-9"><input type="text" id="leadmanagement" name="leadmanagement" class='form-control form-control-sm'></div>
                        </div>
                        <button class="btn btn-success btn-sm">Mark Location</button>
                        <div class="leadmap minimap" id="leadmap">
                        
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" id="savelead" >Save Lead</button>
                        <button type="button" class="btn btn-info btn-sm" id="clearbutton" >Clear Fields</button>
                        <button type="button" class="btn btn-danger btn-sm" id="closeleadmodal" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php require_once("footer.txt") ?>
<script src="../js/leads.js"></script>
</html>