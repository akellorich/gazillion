<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once("header.txt") ?>
    <!-- leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin=""
    />
    <title>Property Owners</title>
</head>
<body>
    <?php require_once("navigation.txt") ?>
    <div class="container-fluid mb-2">
        <div class="row">
            <!-- Filter Options -->
            <div class="col col-md-3 text-left">
                <button id="addnew" class='btn btn-success btn-sm btn-block mt-2 text-left'><i class="fas fa-plus-circle fa-fw fa-lg"></i> Add New Property Owner</button>
                <button id="delete" class="btn btn-danger btn-sm btn-block text-left"><i class="fas fa-minus-circle fa-fw fa-lg"></i> Delete Property Owner</button>
                <button id="filter" class="btn btn-secondary btn-sm btn-block mb-2 text-left"><i class="fas fa-search fa-fw fa-lg"></i> Open Filter Options</button>
                <select multiple class='form-control form-control-sm' id='propertyownerslist'></select>
            </div>
            <!-- Property Owner Details grouped in Tabs -->
            <div class="col text-centered">
                <nav class="nav-justified ">
                    <div class="nav nav-tabs " id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="pop1-tab" data-toggle="tab" href="#pop1" role="tab" aria-controls="pop1" aria-selected="true">General Info</a>
                        <a class="nav-item nav-link" id="pop2-tab" data-toggle="tab" href="#pop2" role="tab" aria-controls="pop2" aria-selected="false">Properties</a>
                        <a class="nav-item nav-link" id="pop3-tab" data-toggle="tab" href="#pop3" role="tab" aria-controls="pop3" aria-selected="false">Property Blocks</a>
                        <a class="nav-item nav-link" id="pop4-tab" data-toggle="tab" href="#pop4" role="tab" aria-controls="pop4" aria-selected="false">Property Units</a>
                    </div>
                </nav>
                
                <div class="tab-content text-left" id="nav-tabContent"> 
                    <!-- General info tab details -->
                    <div class="tab-pane fade show active" id="pop1" role="tabpanel" aria-labelledby="pop1-tab">
                        <div class="pt-3"></div>
                        <p class="alert alert-secondary">Bio Data</p>
                        <p id="detailserrors"></p>
                        <div class="row">
                            <div class="col col-md-4">
                                <div class="form-group">
                                    <input type="hidden" name="id" id="id" value="0">
                                    <label for="type">Owner Type</label>
                                    <select name="type" id="type" class='form-control form-control-sm'></select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="col">
                                    <label for="name">Name</label>
                                    <input type="text" id="name" name="name" class="form-control form-control-sm">
                                </div>
                            </div>
                            
                        </div> 
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="regdocid">Registration Document</label>
                                    <select name="regdocid" id="regdocid" class="form-control form-control-sm"></select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="regdocref">Registration Reference #</label>
                                    <input type="text" id="regdocref" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col">
                                <div class="col">
                                    <label for="pinno">PIN #</label>
                                    <input type="text" id="pinno" name="pnno" class="form-control form-control-sm">
                                </div>
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p class="alert alert-secondary">Contact Information</p>
                            </div>
                        </div>
                        
                        <div class="row">
                            
                            <div class="col">
                                <div class="form-group">
                                    <label for="physicaladdress">Physical Address</label>
                                    <input type="text" id="physicaladdress" name="physicaladdress" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="postaladdress">Postal Address</label>
                                    <input type="text" id="postaladdress" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="town">Town</label>
                                    <input type="text" id="town" name="town" class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="mobile">Mobile</label>
                                    <input type="text" name="" id="mobile" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                            <button class='btn btn-success btn-sm' id="save" name="save"><i class="far fa-save fa-lg fa-fw"></i> Save Property Owner</button>
                            </div>
                        </div>
                    </div>
                    <!-- Properties info tab details -->
                    <div class="tab-pane fade" id="pop2" role="tabpanel" aria-labelledby="pop2-tab">
                        <div class="pt-3"></div>
                        <table class="table table-sm" id="ownerpropertiestable">
                            <thead>
                                <th>#</th>
                                <th>Property Name</th>
                                <th>Classification</th>
                                <th>Location</th>
                                <th>Blocks</th>
                                <th>Units</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody id="ownerproperties">

                            </tbody>
                        </table>
                        <button id="addnewproperty" class="btn btn-success btn-sm" data-toggle="modal" data-target="#propertydetails"><i class="fas fa-plus-circle fa-fw fa-lg"></i> Add Property</button>
                    </div>
                    <!-- Blocks info tab details -->
                    <div class="tab-pane fade" id="pop3" role="tabpanel" aria-labelledby="pop2-tab">
                        <div class="pt-3"></div>
                        <div class="filterblocks" id="filterblocks">
                            <label for="filterpropertyblockselect">Property</label>
                            <select name="filterpropertyblockselect" id="filterpropertyblockselect"></select>
                        </div>
                        <table class="table table-sm table-striped" id="propertyblockstable">
                            <thead>
                                <th>#</th>
                                <th>Property Name</th>
                                <th>Block Name</th>
                                <th>Total Units</th>
                                <th>Units Defined</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody class="propertyblockslist" id="propertyblockslist"></tbody>
                        </table>
                        <button class="btn btn-success btn-sm" name="addnewblock" id="addnewblock" data-toggle="modal" data-target="#propertyblockdetails"><i class="fas fa-plus-circle fa-fw fa-lg"></i> Add New Block</button>
                    </div>
                     <!-- Units info tab details -->
                    <div class="tab-pane fade" id="pop4" role="tabpanel" aria-labelledby="pop2-tab">
                        <div class="pt-3"></div>
                        <div id="filterblockunits">
                            <label for="unitspropertyfilterselect">Property:</label>
                            <select name="unitspropertyfilterselect" id="unitspropertyfilterselect"></select>
                            <label for="unitsblockfilterselect">Block:</label>
                            <select name="unitsblockfilterselect" id="unitsblockfilterselect"></select>
                        </div>
                        <div id="">
                            <table class="table table-sm table-striped" id="propertyunitstable">
                                <thead>
                                    <th>#</th>
                                    <th>Property</th>
                                    <th>Block</th>
                                    <th>Unit Name</th>
                                    <th>Unit Type</th>
                                    <th>Status</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                </thead>
                                <tbody id="propertyblockunitslist">
                                
                                </tbody>
                            </table>
                        </div>
                        <button class="btn btn-success btn-sm" name="addnewunit" id="addnewunit" data-toggle="modal" data-target="#propertyblockunitdetails"><i class="fas fa-plus-circle fa-fw fa-lg"></i> Add New Unit</button>
                    </div>
                </div>
            </div>
            <!-- Modal for adding a new property -->
            <div class="modal fade alert-dismissable fade" id="propertydetails">
                <div class="modal-dialog">
                    <div class="modal-content" id="heldsalesdetails">
                        <div class="modal-header">
                            <p  class="modal-title" >Provide Property Details</p>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div> <!-- -->
                        <div class="modal-body">
                            <div id="propertyerrors" class="propertyerrors"></div>
                            <input type="hidden" id="propertyid" value="0">
                            <div class="form-group">
                                <div class="form-group row">
                                    <label for="region" class="col-sm-3 col-form-label">Region: </label>
                                    <div class="col-sm-9">
                                        <select name="region" id="region" class='form-control form-control-sm'></select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="propertytype" class="col-sm-3 col-form-label">Property Type: </label>
                                <div class="col-sm-9">
                                    <select name="propertytype" id="propertytype" class='form-control form-control-sm'></select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="propertyname" class="col-sm-3 col-form-label">Property Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="propertyname" id="propertyname" class='form-control form-control-sm'>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="propertyphysicallocation" class="col-sm-3 col-form-label">Location</label>
                                <div class="col-sm-9"><input type="text" id="propertyphysicallocation" name="propertyphysicallocation" class='form-control form-control-sm'></div>
                            </div>
                            <div class="form-group row">
                                <label for="propertyblocks" class="col-sm-3 col-form-label">Blocks</label>
                                <div class="col-sm-9"><input type="number" id="propertyblocks"  name="propertyblocks" class='form-control form-control-sm'></div>
                            </div>
                            <div class="form-group row">
                                <label for="propertyunits" class="col-sm-3 col-form-label">Units</label>
                                <div class="col-sm-9"><input type="number" id="propertyunits"  name="propertyunits" class='form-control form-control-sm'></div>
                            </div>
                            <div class="form-group row">
                                <label for="propertycontactperson" class="col-sm-3 col-form-label">Contact Person</label>
                                <div class="col-sm-9"><input type="text" id="propertycontactperson" name="propertycontactperson" class='form-control form-control-sm'></div>
                            </div>
                            <div class="form-group row">
                                <label for="propertycontactpersonmobile" class="col-sm-3 col-form-label">Contact Mobile</label>
                                <div class="col-sm-9"><input type="text" id="propertycontactpersonmobile" name="propertycontactpersonmobile" class='form-control form-control-sm'></div>
                            </div>
                            <div class="form-group row">
                                <label for="propertycontactpersonemail" class="col-sm-3 col-form-label">Contact Email</label>
                                <div class="col-sm-9"><input type="text" id="propertycontactpersonemail" name="propertycontactpersonemail" class='form-control form-control-sm'></div>
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" id="saveproperty">Save</button>
                            <button type="button" class="btn btn-info btn-sm" id="clearproperty">Clear</button>
                            <button type="button" class="btn btn-danger btn-sm" id="closeproperty" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

         <!-- Modal for adding property blocks -->
         <div class="modal fade alert-dismissable fade" id="propertyblockdetails">
                <div class="modal-dialog">
                    <div class="modal-content" id="propertyblockdetails">
                        <div class="modal-header">
                            <p  class="modal-title" >Provide Property Block Details</p>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div> <!-- -->
                        <div class="modal-body">
                            <div id="propertyblockerrors" class="propertyblockerrors"></div>
                            <div class="form-group row">
                                <input type="hidden" name="propertyblockid" id="propertyblockid" value="0">
                                <label for="addpropertyblockselect" class="col-sm-3 col-form-label">Property Name: </label>
                                <div class="col-sm-9">
                                    <select name="addpropertyblockselect" id="addpropertyblockselect" class='form-control form-control-sm'></select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="propertyblockname" class="col-sm-3 col-form-label">Block Name: </label>
                                <div class="col-sm-9">
                                    <input type="text" name="propertyblockname" id="propertyblockname" class='form-control form-control-sm'>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="propertyblockunits" class="col-sm-3 col-form-label">No of Units</label>
                                <div class="col-sm-9">
                                    <input type="number" name="propertyblockunits" id="propertyblockunits" class='form-control form-control-sm'>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" id="savepropertyblock">Save Block</button>
                            <button type="button" class="btn btn-info btn-sm" id="clearpropertyblock">Clear Fields</button>
                            <button type="button" class="btn btn-danger btn-sm" id="closepropertyblock" data-dismiss="modal">Close Window</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal for adding new units -->
        <div class="modal fade alert-dismissable fade" id="propertyblockunitdetails">
                <div class="modal-dialog">
                    <div class="modal-content" id="propertyunitdetails">
                        <div class="modal-header">
                            <p  class="modal-title" >Provide Unit Details</p>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="propertyblockuniterrors" class="propertyblockuniterrors"></div>
                            <div class="form-group row">
                                <input type="hidden" name="propertyblockunitid" id="propertyblockunitid" value="0">
                                <label for="addpropertyunitselect" class="col-sm-3 col-form-label">Property: </label>
                                <div class="col-sm-9">
                                    <select name="addpropertyunitselect" id="addpropertyunitselect" class='form-control form-control-sm'></select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="addblockunitselect" class="col-sm-3 col-form-label">Block: </label>
                                <div class="col-sm-9">
                                    <select name="addblockunitselect" id="addblockunitselect" class='form-control form-control-sm'></select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="unittypeselect" class="col-sm-3 col-form-label">Unit Type: </label>
                                <div class="col-sm-9">
                                    <select name="unittypeselect" id="unittypeselect" class='form-control form-control-sm'></select>
                                </div>
                            </div>
                            <!-- Toggle for Single or Multiple Units -->
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-primary btn-sm active">
                                    <input type="radio" name="options" id="singleunit" autocomplete="off" checked class="unitsaddoption" value="singleunit"> Single Unit
                                </label>
                                <label class="btn btn-primary btn-sm">
                                    <input type="radio" name="options" id="multipleunits" autocomplete="off" class="unitsaddoption" value="multipleunits"> Multiple Units
                                </label>
                            </div>

                            <div id="singleunitoptions" class="singelunitoptions mt-3">
                                <div class="form-group row">
                                    <label for="unitname" class="col-sm-3 col-form-label">Unit Name: </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="unitname" id="unitname" class='form-control form-control-sm'>
                                    </div>
                                </div>
                            </div>

                            <div id="multipleunitsoptions" class="multipleunitsoptions mt-3">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label for="unitnostartfrom" class="col-sm-3 col-form-label">Serial:</label>
                                        <div class="col-sm-9">
                                            <select name="serialtype" id="serialtype" class='form-control form-control-sm'>
                                                <option value="">&lt;Choose One&gt;</option>
                                                <option value="numerical">Numerical</option>
                                                <option value="alphabetical">Alphabetical</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group row">
                                        <label for="unitnos" class="col-sm-3 col-form-label">Units:</label>
                                        <div class="col-sm-9">
                                            <input type="number" name="unitnos" id="unitnos" class='form-control form-control-sm'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label for="unitnostartat" class="col-sm-3 col-form-label">Start:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="unitnostartat" id="unitnostartat" class='form-control form-control-sm'>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group row">
                                        <label for="unitnoprefix" class="col-sm-3 col-form-label">Prefix:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="unitnoprefix" id="unitnoprefix" class='form-control form-control-sm'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label for="unitnosuffix" class="col-sm-3 col-form-label">Suffix:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="unitnosuffix" id="unitnosuffix" class='form-control form-control-sm'>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="check-group">
                                        <input type="checkbox" class="check-control" id="appendzeros" name="appendzeros">
                                        <label for="appendzeros" class="check-label">Pad zeros to unit name</label>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="row">
                                <div class="col col-md-3">
                                    <button id="generateunitnos" class="btn btn-sm btn-primary">Generate Units</button>
                                </div>
                                <div class="col">
                                    <select multiple class='form-control form-control-sm list-small' id='unitnames'></select>
                                    <button id="removeunitnos" class="btn btn-sm btn-danger mt-2">Remove</button>
                                </div>
                            </div>
                            
                            
                            </div>
                         
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" id="saveunit">Save Unit</button>
                            <button type="button" class="btn btn-info btn-sm" id="clearunit">Clear Fields</button>
                            <button type="button" class="btn btn-danger btn-sm" id="closeunits" data-dismiss="modal">Close Window</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal for adding meter to unit -->
        <div class="modal fade alert-dismissable fade" id="unitmeter">
                <div class="modal-dialog">
                    <div class="modal-content" id="unitmeterdetails">
                        <div class="modal-header">
                            <p  class="modal-title" ><h5>Provide Meter Details</h5></p>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div> <!-- -->
                        <div class="modal-body">
                            <div id="unitmetererrors" class="unitmetererrors"></div>
                            <div class="form-group row">
                                
                                <label for="unitmetermake" class="col-sm-3 col-form-label">Meter Make: </label>
                                <div class="col-sm-9">
                                    <select name="unitmetermake" id="unitmetermake" class='form-control form-control-sm'></select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="unitmetermodel" class="col-sm-3 col-form-label">Meter Model: </label>
                                <div class="col-sm-9">
                                    <select name="unitmetermodel" id="unitmetermodel" class='form-control form-control-sm'></select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="unitmeterid" class="col-sm-3 col-form-label">Meter Number:</label>
                                <div class="col-sm-9">
                                    <select name="unitmeterid" id="unitmeterid" class='form-control form-control-sm'></select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" id="saveunitmeter">Save Unit Meter</button>
                            <button type="button" class="btn btn-info btn-sm" id="clearpropertyblock">Clear Fields</button>
                            <button type="button" class="btn btn-danger btn-sm" id="closepropertyblock" data-dismiss="modal">Close Window</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal to display Map -->
        <div class="modal fade alert-dismissable fade" id="mapdetails">
                <div class="modal-dialog">
                    <div class="modal-content" id="map">
                        <div class="modal-body">
                            <div id="mapid" style="width: 470px; height: 400px;"></div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
        <!-- Attached Documents Modal -->
        <div class="modal fade alert-dismissable fade" id="attacheddocuments">
            <div class="modal-dialog">
                <div class="modal-content" id="attacheddocumentdetails">
                    <div class="modal-header">
                        <p  class="modal-title" ><h5>Attached Documents</h5></p>
                        <button type="button" class="close" data-dismiss="modal">
                            <span class='font-weight-bold' >&times;</span>
                        </button>
                    </div> <!-- -->
                    <div class="modal-body">
                        <div id="deletedocumenterror"></div>
                        <table class="table table-striped table-sm">
                            <thead>
                                <th>#</th>
                                <th>Description</th>
                                <th>&nbsp;</th><!-- View the file -->
                                <th>&nbsp;</th><!-- Delete the file -->
                            </thead>
                            <tbody id="documentlist">
                            
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-success btn-sm" id="addattachment"><i class="fas fa-plus-circle fa-fw fa-lg"></i> Add Document</button>
                        <div id="attachmentdetails" class="mt-2">
                            <div id="attachmenterrors" class="attchmenterrors"></div>
                            <div class="form-group row">
                                <input type="hidden" id="fielid" name="fileid" value="0">
                                <label for="documentdescription" class="col-sm-3 col-form-label">Description:</label>
                                <div class="col-sm-9">
                                    <select id="documentdescription"  name="documentdescription" class='form-control form-control-sm'></select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="documentfile" class="col-sm-3 col-form-label">Attach File:</label>
                                <div class="col-sm-9">
                                    <input type="file" id="documentfile"  name="documentfile" class='form-control form-control-sm'>
                                </div>
                            </div>
                            <button type="button" class="btn btn-secondary btn-sm" id="saveattachment" >Upload Document</button>
                            <button type="button" class="btn btn-info btn-sm" id="resetattachment" >Reset Fields</button>
                            <button type="button" class="btn btn-danger btn-sm" id="closeattachment" data-dismiss="modal">Close</button>
                        </div> 
                    </div>
                    <div class="modal-footer">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<!-- leftlet Javascript -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
   integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
   crossorigin="">
</script>
<?php require_once("footer.txt") ?>
<script src="../js/propertyowners.js"></script>
</html>

