<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once("header.txt") ?>
    <title>Customers Information View</title>
</head>
<body>
    <?php require_once("navigation.txt") ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col col-md-3">
                <!-- Filter Options Window --> 
                <div class="mt-2">
                    <a href="#" id="addcustomer" class="btn btn-success btn-sm w-100 text-left"><i class="fas fa-user-plus fa-lg"></i>  Add Customer</a>
                    <a href="#" id="filtercustomer" class="btn btn-secondary btn-sm w-100 mt-1 text-left" data-toggle="modal" data-target="#filtercustomers"><i class="fas fa-search-plus fa-lg"></i>  Filter Customers</a>
                    <!-- <a href="#" id="cancelfilter" class="btn btn-danger btn-sm w-100 mt-1 text-left"><i class="fas fa-search-minus fa-lg"></i>  Cancel Filters</a> -->
                    <a href="#" id="deletecustomer" class="btn btn-danger btn-sm w-100 mt-1 text-left"><i class="fas fa-user-times fa-lg"></i>  Delete Customer</a>
                </div>
                
                <select name="customerslist" id="customerslist" multiple class="form-control form-control-sm list-big mt-2"></select>
            </div>
            <div class="col">
                <!-- Customers Information View -->
                <div class="row mt-2">
                     <div class="col col-md-4">
                        <label for="cardnames">Names:</label>
                        <span class='font-weight-bold'  id="cardnames"></span>
                    </div>
                     <div class="col">
                        <label for="cardcustomerid">Customer ID:</label>
                        <span class='font-weight-bold'  id="cardcustomerid"></span>
                    </div
                    ><div class="col">
                        <label for="cardregdocument">Reg. Doc: </label>
                        <span class='font-weight-bold'  id="cardregdocument"></span>
                    </div>
                    <div class="col">
                        <label for="cardregdocref"> Ref #: </label>
                        <span class='font-weight-bold'  id="cardregdocref"></span>
                    </div>
                </div>
                <div class="row">
                     <div class="col col-md-4">
                        <label for="cardaddress">Address:</label>
                        <span class='font-weight-bold'  id="cardaddress"></span>
                    </div>
                     <div class="col">
                        <label for="cardlastpaidon">Last Paid On:</label>
                        <span class='font-weight-bold'  id="cardlastpaidon"></span>
                    </div>
                    <div class="col">
                        <label for="cardlastamount">Amount: </label>
                        <span class='font-weight-bold'  id="cardlastamount"></span>
                    </div>
                    <div class="col">
                        <label for="cardlastreceiptno"> Receipt #: </label>
                        <span class='font-weight-bold'  id="cardlastreceiptno"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-md-4">
                        <label for="cardoldestcharge">Oldest Charge:</label>
                        <span class='font-weight-bold'  id="cardoldestcharge"></span>
                    </div>
                    <div class="col">
                        <label for="cardoldestchargeamount">Amount:</label>
                        <span class='font-weight-bold'  id="cardoldestchargeamount"></span>
                    </div>
                    <div class="col">
                        <label for="cardoutstandingbalance">Outstanding Balance: </label>
                        <span class='font-weight-bold'  id="cardoutstandingbalance"></span>
                    </div>

                    <div class="col">
                        <label for="cardstatus">Status: </label>
                        <span class='font-weight-bold'  id="cardstatus"></span>
                    </div>
                    
                </div>
                <!-- Tabbed Menu Starts Here -->
                <div class="row">
                    <div class="col-md-12 text-center ">
                        <nav class="nav-justified ">
                            <div class="nav nav-tabs " id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="pop1-tab" data-toggle="tab" href="#pop1" role="tab" aria-controls="pop1" aria-selected="true">General Information</a>
                                <a class="nav-item nav-link" id="properties-tab" data-toggle="tab" href="#properties" role="tab" aria-controls="properties" aria-selected="false">Properties</a>
                                <a class="nav-item nav-link" id="pop2-tab" data-toggle="tab" href="#pop2" role="tab" aria-controls="pop2" aria-selected="false">Transactions</a>
                                <a class="nav-item nav-link" id="pop3-tab" data-toggle="tab" href="#pop3" role="tab" aria-controls="pop3" aria-selected="false">Tickets</a>
                                <a class="nav-item nav-link" id="pop4-tab" data-toggle="tab" href="#pop4" role="tab" aria-controls="pop4" aria-selected="false">Meter Readings</a>
                                <a class="nav-item nav-link" id="pop5-tab" data-toggle="tab" href="#pop5" role="tab" aria-controls="pop5" aria-selected="false">Payments</a>
                            </div>
                        </nav>
                    </div>
                </div>
                <!-- Tab Contents Start Here -->
                <div class="tab-content text-left" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="pop1" role="tabpanel" aria-labelledby="pop1-tab">
                        <div class="pt-3"></div>
                        <div class="row">
                            <div class="col" id="customererrors"></div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p class="alert alert-secondary">Bio Data</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-md-5">
                                <div class="form-group">
                                    <input type="hidden" id="customerid" value="0">
                                    <label for="customertype">Customer Type:</label>
                                    <select name="customertype" id="customertype" class="form-control form-control-sm"></select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="customername">Customer Names:</label>
                                    <input type="text" id="customername" class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="regdoc">Registration Document:</label>
                                    <select name="" id="regdoc" class="form-control form-control-sm"></select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="regdocref">Registration Doc Reference:</label>
                                    <input type="text" id="regdocref" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="pinno">PIN Number:</label>
                                    <input type="text" id="pinno" class="form-control form-control-sm">
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
                                    <label for="postaladdress">Postal Address</label>
                                    <input type="text" id="postaladdress" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="town">Town</label>
                                    <input type="text" id="town" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="postalcode">Postal Code</label>
                                    <input type="text" id="postalcode" class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="landline">Landline</label>
                                    <input type="text" id="landline" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="mobile">Mobile</label>
                                    <input type="text" id="mobile" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" id="email" class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-0">
                            <div class="col">
                                <button id="savecustomer" class="btn btn-success btn-sm">Save Customer</button>
                                <button id="clearcustomerfields" class="btn btn-danger btn-sm">Clear Fields</button>
                            </div>
                        </div>
                        <!-- Div ends here -->
                    </div>
                    <!-- Properties Tab Starts Here -->
                    <div class="tab-pane fade" id="properties" role="tabpanel" aria-labelledby="properties-tab">
                        <div class="pt-3"></div>
                        <!-- <div class="row"> -->
                            <!-- <div class="col"> -->
                                <p class="alert alert-secondary">
                                    <span class='font-weight-bold'  class="text-left">Property Information</span> 
                                    <span class="float-right">
                                        <a href="#" class="settingslink" data-id='addproperty' data-toggle="modal" data-target="#addcustomerunitmodal"><i class="fas fa-plus-circle fa-fw fa-lg"></i></a>
                                    </span>
                                </p>
                                <table class="table table-sm">
                                    <thead>
                                        <th>#</th>
                                        <th>Property</th>
                                        <th>Unit</th>
                                        <th>Meter #</th>
                                        <th>Commission</th>
                                        <th>Initial Reading</th>
                                        <th>Comm. Date</th>
                                        <th>Status</th>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                    </thead>
                                    <tbody id="propertylist"></tbody>
                                </table>
                            </div>
                        <!-- </div> -->
                    <!-- </div> -->
                    <!-- Properties Tab end here  -->

                    <!-- Statement Tab -->
                    <div class="tab-pane fade" id="pop2" role="tabpanel" aria-labelledby="pop2-tab">
                        <div class="pt-3"></div>
                        <div id="statementfilteroptions" class="statementfilteroptions">
                            <div class="row">
                                <div class="col">
                                    <div id="statementerrors"></div>
                                </div>
                            </div>
                            <!-- <input type="checkbox" id="statementalldates"> All Dates -->
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                       <!-- <label for="statementstartdate">Date From:</label> -->
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-calendar-alt fa-fw"></i></span>
                                            </div> 
                                            <input type="text" id="statementstartdate"  class="datefield form-control form-control-sm" placeholder="Start Date" autocomplete="nope">
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <!-- <label for="statementenddate">Date To:</label> -->
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-calendar-alt fa-fw"></i></span>
                                            </div>
                                            <input type="text" id="statementenddate"  class="datefield form-control form-control-sm" placeholder="End Date" autocomplete="nope">
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <!-- <label for="statementmeterno">Meter Number:</label> -->
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-tachometer-alt fa-fw"></i></span>
                                            </div> 
                                            <select  id="statementmeterno"  class="form-control form-control-sm" placeholder="Meter Number"></select>
                                        </div>
                                       
                                    </div>
                                </div>
                                <div class="col col-md-2">
                                    <div class="form-group">
                                         <!-- <label for="generatestatement">&nbsp;</label> -->
                                        <button class="btn btn-sm btn-success mb-2 form-control form-control-sm" id="generatestatement" ><i class="fas fa-filter fa-fw fa-lg"></i> Apply Filter</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <table id="customerstatement" class="table table-sm table-striped">
                            <thead>
                                <th>#</th>
                                <th>Date</th>
                                <th>Reference #</th>
                                <th>Narration</th>
                                <th>Invoice</th>
                                <th>Payment</th>
                                <th>Balance</th>
                               
                            </thead>
                            <tbody id="statementbody"></tbody>
                        </table>
                        <button class="btn btn-sm btn-secondary mb-2" id="printstatement"><i class="fas fa-print fa-fw fa-lg"></i> Print</button>
                        <button class="btn btn-sm btn-secondary mb-2" id="emailstatement"><i class="fas fa-envelope-open fa-fw fa-lg"></i> Email</button>
                    </div>

                    <!-- Tickets Tab -->
                    <div class="tab-pane fade" id="pop3" role="tabpanel" aria-labelledby="pop3-tab">
                        <div class="pt-3"></div>
                        <div id="ticketfilteroptions" class="ticketfilteroptions">
                            <!--<input type="checkbox" id="ticketalldates"> All Dates -->
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <!-- <label for="ticketstartdate">Date From:</label> -->
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-calendar-alt fa-fw"></i></span>
                                            </div>
                                            <input type="text" id="ticketstartdate" class="datefield form-control form-control-sm" placeholder="Start Date">
                                        </div> 
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <!-- label for="ticketenddate">Date To:</label> -->
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-calendar-alt fa-fw"></i></span>
                                            </div>
                                            <input type="text" id="ticketenddate" class="datefield form-control form-control-sm" placeholder="End Date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <!-- <label for="ticketcategory">Category:</label> -->
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-th-list fw"></i></i></span>
                                            </div>
                                            <select  id="ticketcategory" class="form-control form-control-sm" placeholder="Category">
                                                <option value="all">&lt;All&gt;</option>
                                            </select>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">                                 
                                        <!-- <label for="ticketstatus">Status:</label> -->
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-tools fw"></i></i></span>
                                            </div>
                                            <select  id="ticketstatus" class="form-control form-control-sm" placeholder="Status">
                                                <option value="all">&lt;All&gt;</option>
                                                <option value="open">Open</option>
                                                <option value="workaround">Workaround</option>
                                                <option value="closed">Closed</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col col-md-2">
                                    <div class="form-group">
                                        <!-- <label for="filtertieckets">&nbsp;</label> -->
                                        <button class="btn btn-sm btn-success mb-2 form-control form-control-sm" id="filtertickets"><i class="fas fa-filter fa-fw fa-lg"></i> Apply Filter</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table id="customerstatement" class="table table-sm table-striped">
                            <thead>
                                <th>#</th>
                                <th>Date</th>
                                <th>Ticket #</th>
                                <th>Category</th>
                                <th>Narration</th>
                                <th>Assigned To</th>
                                <th>Status</th>
                                <th>&nbsp;</th><!-- Edit-->
                                <th>&nbsp;</th><!-- Resolve-->
                                <th>&nbsp;</th><!-- delete-->
                               
                            </thead>
                            <tbody id="ticketsbody"></tbody>
                        </table>
                        <button class="btn btn-sm btn-secondary mb-2" id="addticket" data-toggle="modal" data-target="#troubletickets"><i class="fas fa-plus-circle fa-fw fa-lg"></i> Add</button>
                        <button class="btn btn-sm btn-secondary mb-2" id="printtickets"><i class="fas fa-print fa-fw fa-lg"></i> Print List</button>
                        
                    </div>
                    <!-- Meter Reading Tab -->
                    <div class="tab-pane fade" id="pop4" role="tabpanel" aria-labelledby="pop4-tab">
                        <div class="pt-3"></div>
                        <div id="mrfilteroptions" class="mrfilteroptions">
                            <div class="row">
                                <div class="col">
                                    <div id="mrfiltererrors"></div>
                                </div>
                            </div>
                            <div class="row">
                                <!-- <div class="col">
                                    <div class="form-group">
                                        <label for="mralldates">&nbsp;</label>
                                        <input type="checkbox" id="mralldates" class="form-control form-control-sm"> All
                                    </div>
                                </div> -->
                                <div class="col">
                                    <div class="form-group">
                                        <!-- <label for="mrstartdate">Date From:</label> -->
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-calendar-alt fa-fw"></i></span>
                                            </div> 
                                            <input type="text" id="mrstartdate" class="datefield form-control form-control-sm" placeholder="Start Date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <!-- <label for="mrenddate">Date To:</label> -->
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-calendar-alt fa-fw"></i></span>
                                            </div>
                                            <input type="text" id="mrenddate" class="datefield form-control form-control-sm" placeholder="End Date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <!-- <label for="mrmeternumber">Meter Number:</label> -->
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-tachometer-alt fw"></i></span>
                                            </div>
                                            <select  id="mrmeternumber" class="form-control form-control-sm" placeholder="Meter Number"></select>  
                                        </div>
                                    </div>
                                </div>
                                <div class="col col-md-2">
                                    <div class="form-group">
                                        <!--  <label for="filtermeterreading">&nbsp;</label> -->
                                        <button class="btn btn-sm btn-success form-control form-control-sm" id="filtermeterreadings"><i class="fas fa-filter fa-fw fa-lg"></i> Apply Filter</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table id="customermeterreading" class="table table-sm table-striped">
                            <thead>
                                <th>#</th>
                                <th>Date</th>
                                <th>Prev Reading</th>
                                <th>Current Reading</th>
                                <th>Units (KGS)</th>
                                <th>Rate</th>
                                <th>Amount</th>
                                <th>&nbsp;</th><!-- Edit-->
                                <th>&nbsp;</th><!-- delete-->
                               
                            </thead>
                            <tbody id="mrbody"></tbody>
                        </table>
                        <button class="btn btn-sm btn-secondary mb-2" id="addmr" data-toggle="modal" data-target="#meterreading"><i class="fas fa-plus-circle fa-fw fa-lg"></i> Add</button>
                        <button class="btn btn-sm btn-secondary mb-2" id="printmr"><i class="fas fa-print fa-fw fa-lg"></i> Print List</button>
                    </div>

                    <div class="tab-pane fade" id="pop5" role="tabpanel" aria-labelledby="pop5-tab">
                        <div class="pt-3"></div>
                        <p class="font-weight-bold text-center">OPEN RECEIVABLES</p>
                        <div id="receipterrors"></div>
                        <table id="openreceivables" class="table table-sm table-striped">
                            <thead>
                                <th>#</th>
                                <th>Meter Number</th>
                                <th>Property</th>
                                <th>Unit</th>
                                <th>Charge Type</th>
                                <th>Amount Due</th>
                            </thead>
                            <tbody id="openreceivablesdetails"></tbody>
                        </table>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="paymentmode">Payment Mode</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-wallet fw"></i></span>
                                        </div>
                                        <select name="paymentmode" id="paymentmode" class="form-control form-control-sm"></select>
                                    </div>   
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="referenceno">Reference Number</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-hashtag fw"></i></span>
                                        </div>
                                         <input type="text" id="referenceno" class="form-control form-control-sm"> 
                                    </div>
                                   
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="amountpaid">Amount Paid</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-money-bill fw"></i></span>
                                        </div>
                                         <input type="number" id="amountpaid" class="form-control form-control-sm"> 
                                    </div>
                                   
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="overpayment">Overpayment</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-piggy-bank fw"></i></span>
                                        </div>
                                        <input type="number" id="overpayment" class="form-control form-control-sm" disabled> 
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!--<div class="col">
                                <input type="checkbox" name="printreceipt" id="printreceipt">
                                <label for="printreceipt">Print Receipt</label>
                            </div>
                            <div class="col">
                                <input type="checkbox" name="emailreceipt" id="emailreceipt">
                                <label for="emailreceipt">Email Receipt</label>
                            </div> -->
                            <div class="col">
                                <label for="#">&nbsp;</label>
                            </div>
                            <div class="col">
                                <label for="#">&nbsp;</label>
                            </div>
                        </div>
                        <!-- <button id="distributeamount" class="btn btn-sm btn-success"> Auto Distribute</button> -->
                        <button id="savereceipt" class="btn btn-sm btn-success">Save Payment</button>
                        <button id="clearpayment" class="btn btn-sm btn-danger">Clear Form</button>
                    </div>
                <!-- Tab Contents End Here -->
            </div>
        </div>
        <!-- Filter Customers Modal -->
        <div class="modal fade alert-dismissable fade" id="filtercustomers">
            <div class="modal-dialog">
                <div class="modal-content" id="filtercustomerdetails">
                    <div class="modal-header">
                        <p  class="modal-title" ><h5>Select Filter Options</h5></p>
                        <button type="button" class="close" data-dismiss="modal">
                            <span class='font-weight-bold' >&times;</span>
                        </button>
                    </div> <!-- -->
                    <div class="modal-body">
                        <div id="filtercustomererrors" class="filtercustomererrors"></div>
                        <div class="form-group row">
                            <label for="filtercustomername" class="col-sm-3 col-form-label">Client Name:</label>
                            <div class="col-sm-9">
                                <input type="text" id="filtercustomername"  name="filtercustomername" class='form-control form-control-sm'>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="filtermeterno" class="col-sm-3 col-form-label">Meter Number:</label>
                            <div class="col-sm-9">
                                <input type="text" id="filtermeterno"  name="filtermeterno" class='form-control form-control-sm'>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="filtercustomertype" class="col-sm-3 col-form-label">Customer Type: </label>
                            <div class="col-sm-9">
                                <select name="filtercustomertype" id="filtercustomertype" class='form-control form-control-sm'></select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="filterproperty" class="col-sm-3 col-form-label">Property:</label>
                            <div class="col-sm-9">
                                <select name="filterproperty" id="filterproperty" class='form-control form-control-sm'></select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="filterunit" class="col-sm-3 col-form-label">Unit:</label>
                            <div class="col-sm-9">
                                <select id="filterunit" name="filterunit" class='form-control form-control-sm'></select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="filterregdoc" class="col-sm-3 col-form-label">Reg. Doc:</label>
                            <div class="col-sm-9">
                                <select id="filterregdoc"  name="filterregdoc" class='form-control form-control-sm'></select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="filterregdocref" class="col-sm-3 col-form-label">Reg Doc #:</label>
                            <div class="col-sm-9">
                                <input type="text" id="filterregdocref"  name="filterregdocref" class='form-control form-control-sm'>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="filtermetermake" class="col-sm-3 col-form-label">Meter Make</label>
                            <div class="col-sm-9">
                                <select id="filtermetermake" name="filtermetermake" class='form-control form-control-sm'></select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="filtermetermodel" class="col-sm-3 col-form-label">Meter Model</label>
                            <div class="col-sm-9">
                                <select id="filtermetermodel" name="filtermetermodel" class='form-control form-control-sm'></select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" id="applyfilter" >Apply Filters</button>
                        <button type="button" class="btn btn-info btn-sm" id="resetfield" >Reset Fields</button>
                        <button type="button" class="btn btn-danger btn-sm" id="closeleadmodal" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

         <!-- Attach property unit to customer -->
         <div class="modal fade alert-dismissable fade" id="addcustomerunitmodal">
            <div class="modal-dialog">
                <div class="modal-content" id="customerunitdetails">
                    <div class="modal-header">
                        <p  class="modal-title" ><h5>Select Customer Unit</h5></p>
                        <button type="button" class="close" data-dismiss="modal">
                            <span class='font-weight-bold' >&times;</span>
                        </button>
                    </div> <!-- -->
                    <div class="modal-body">
                        <div id="uniterrors" class="uniterrors"></div>
                        <div class="form-group row">
                            <label for="addcustomerproperty" class="col-sm-3 col-form-label">Property:</label>
                            <div class="col-sm-9">
                                <select name="addcustomerproperty" id="addcustomerproperty" class='form-control form-control-sm'></select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="addcustomerunit" class="col-sm-3 col-form-label">Unit:</label>
                            <div class="col-sm-9">
                                <select id="addcustomerunit" name="addcustomerunit" class='form-control form-control-sm'></select>
                            </div>
                        </div>

                        <div class="check-group">
                            <input type="checkbox" class="check-control offset-3" id="commissionmeter" name="commissionmeter">
                            <label for="commissionmeter" class="check-label"> Commission Meter</label>
                        </div>
                       
                        <div class="form-group row">
                            <label for="addcustomercommissiondate" class="col-sm-3 col-form-label">Starts:</label>
                            <div class="col-sm-9">
                                <input type="text" id="addcustomercommissiondate"  name="datefield addcustomercommissiondate" class='form-control form-control-sm'>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="addcustomerinitialreading" class="col-sm-3 col-form-label">Meter Reads:</label>
                            <div class="col-sm-9">
                                <input type="number" id="addcustomerinitialreading"  name="addcustomerinitialreading" class='form-control form-control-sm'>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" id="attachunit" >Attach Unit</button>
                        <button type="button" class="btn btn-info btn-sm" id="resetunitattach" >Reset Fields</button>
                        <button type="button" class="btn btn-danger btn-sm" id="closeunitattach" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Ticket details Modal -->
        <div class="modal fade alert-dismissable fade" id="troubletickets">
            <div class="modal-dialog">
                <div class="modal-content" id="ticketdetails">
                    <div class="modal-header">
                        <p  class="modal-title" ><h5>Trouble Ticket Details</h5></p>
                        <button type="button" class="close" data-dismiss="modal">
                            <span class='font-weight-bold' >&times;</span>
                        </button>
                    </div> <!-- -->
                    <div class="modal-body">
                        <div id="tterrors" class="tterrors"></div>
                        <div class="form-group row">
                            <label for="ttmeter" class="col-sm-3 col-form-label">Meter:</label>
                            <div class="col-sm-9">
                                <select id="ttmeter"  name="ttmeter" class='form-control form-control-sm'></select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ttcategory" class="col-sm-3 col-form-label">Fault Category:</label>
                            <div class="col-sm-9">
                                <select id="ttcategory"  name="ttcategory" class='form-control form-control-sm'></select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ttfault" class="col-sm-3 col-form-label">Fault Name: </label>
                            <div class="col-sm-9">
                                <select name="ttfault" id="ttfault" class='form-control form-control-sm'></select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ttnarration" class="col-sm-3 col-form-label">Narration:</label>
                            <div class="col-sm-9">
                                <textarea id="ttnarration"  name="ttnarration" class='form-control form-control-sm'></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ttassignment" class="col-sm-3 col-form-label">Assigned To:</label>
                            <div class="col-sm-9">
                                <select name="ttassignment" id="ttassignment" class='form-control form-control-sm'></select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ttstatus" class="col-sm-3 col-form-label">Status:</label>
                            <div class="col-sm-9">
                                <select id="ttstatus" name="ttstatus" class='form-control form-control-sm'>
                                    <option value="">&lt;ChooseOne&gt;</option>
                                    <option value="open">Open</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" id="savett" >Save TT</button>
                        <button type="button" class="btn btn-info btn-sm" id="resettt" >Reset Fields</button>
                        <button type="button" class="btn btn-danger btn-sm" id="closettmodal" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Meter Reading Modal -->
        <div class="modal fade alert-dismissable fade" id="meterreading">
            <div class="modal-dialog">
                <div class="modal-content" id="mrdetails">
                    <div class="modal-header">
                        <p  class="modal-title" ><h5>Meter Reading Details</h5></p>
                        <button type="button" class="close" data-dismiss="modal">
                            <span class='font-weight-bold' >&times;</span>
                        </button>
                    </div> <!-- -->
                    <div class="modal-body">
                        <div id="mrerrors" class="mrerrors"></div>
                        <div class="form-group row">
                            <input type="hidden" id="mrid" name="mrid" value="0">
                            <label for="mrmeter" class="col-sm-3 col-form-label">Meter:</label>
                            <div class="col-sm-9">
                                <select id="mrmeter"  name="mrmeter" class='form-control form-control-sm'></select>
                                <input type="hidden" name="mrunitid" id="mrunitid">
                                <input type="hidden" id="mrcustomerid" id="mrcustomerid">
                                <input type="hidden" id="mrbillclient" name="mrbillclient">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="mrreadby" class="col-sm-3 col-form-label">Read By:</label>
                            <div class="col-sm-9">
                                <select id="mrreadby"  name="mrreadby" class='form-control form-control-sm'></select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="mrreadingdate" class="col-sm-3 col-form-label">Reading Date: </label>
                            <div class="col-sm-9">
                                <input type="text" name="mrreadingdate" id="mrreadingdate" class='datefield form-control form-control-sm'>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="mrreading" class="col-sm-3 col-form-label">Meter Reading: </label>
                            <div class="col-sm-9">
                                <input type="number" name="mrreading" id="mrreading" class='form-control form-control-sm'>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="mrnarration" class="col-sm-3 col-form-label">Narration: </label>
                            <div class="col-sm-9">
                                <textarea name="mrnarration" id="mrnarration" class='form-control form-control-sm'></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" id="savemr" >Save Meter Reading</button>
                        <button type="button" class="btn btn-info btn-sm" id="resetmr" >Reset Fields</button>
                        <button type="button" class="btn btn-danger btn-sm" id="closemrmodal" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php require_once("footer.txt") ?>
<script src="../js/customers.js"></script>
</html>
