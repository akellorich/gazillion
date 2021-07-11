<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Banking</title>
    <?php require_once("header.txt") ?>
</head>
<body>
    <?php require_once("navigation.txt");?>
    <div class="container-fluid banking">
        <div class="row">
            <div class="col col-md-3">
                <div class="card filteroptions mt-3">
                    <div class="card-header">
                        <h5>Step 1 -- Filter Options</h5>
                    </div>

                    <div class="card-body">
                        <div class="errors" id="errors"></div>
                        <div class="form-group">
                            <label for="pos">Point of Sale</label>
                            <select name="pos" id="pos" class='form-control form-control-sm'></select>
                        </div> 

                        <div class="form-group">
                            <label for="paymentmethod">Payment Method</label>
                            <select name="paymentmethod" id="paymentmethod" class="form-control form-control-sm"></select>    
                        </div>

                        <div class="form-group">
                            <input type="checkbox" name="alldates" id="alldates">All Dates 
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="startdate" id="startdatelabel">Start Date</label>
                                    <input type="text" name="startdate" id="startdate" class="form-control form-control-sm">
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="enddate" id="enddatelabel">End Date</label>
                                    <input type="text" name="enddate" id="enddate" class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>
                        <button id="filterreceipts" name="filterreceipts" class="btn btn-secondary btn-sm">Filter Receipts</button>
                    </div>
                </div>

                <div class="card mt-3 summary" id="summary">
                    <div class="card-header">
                        <h5>Step 3 -- Summarized Selected Receipts</h5>
                    </div>
                   <div class="card-body">
                       
                   </div>
                </div>

                <div class="card mt-3  mb-3 bankingdetails">
                    <div class="card-header">
                        <h5>Step 4 -- Banking Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="cashbookaccount">Cashbook Account</label>
                            <select name="cashbookaccounty" id="cashbookaccount" class="form-control form-control-sm"></select>
                        </div>

                        <div class="form-group">
                            <label for="narration"Narration>Narration</label>
                            <input type="text" name="narration" id="narration" class="form-control form-control-sm">
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="referenceno">Reference Number</label>
                                    <input type="text" id="referenceno" name="referenceno" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="postas">Post Receipt(s) As</label>
                                    <select name="postas" id="postas" class="form-control form-control-sm">
                                        <option value="">&lt;Choose One&gt;</option>
                                        <option value="single">Single</option>
                                        <option value="group">Grouped</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        

                        <button id="bankreceipts" name="bankreceipts" class='btn btn-success'>Bank Selected Receipts</button>
                    </div>
                    
                </div>
            </div>

            <div class="col">
                <div class=" card  mt-3 receiptlist">
                <div class="card-header"> <h5>Step 2 -- Select Receipts to Bank</h5> </div>
                    <table class="table table-striped table-sm" id="pendingreceipts">
                        <thead>
                            <th><input type='checkbox' id='all'></th>
                            <th>#</th>
                            <th>Date</th>
                            <th>Point of Sale</th>
                            <th>Customer</th>
                            <th>Receipt No</th>
                            <th>Mode of Payment</th>
                            <th>Reference</th>
                            <th>Amount</th>
                            <th>Added By</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="10">No Records Listed. Apply filter options first</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
       
            
           
    </div>
</body>
<?php require_once("footer.txt") ?>
<script src="../js/banking.js"></script>
</html>