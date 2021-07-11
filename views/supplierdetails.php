<html>
<head>
    <title>Supplier Details</title>
    <?php require_once("header.txt") ?>
<head>
<body>
    <?php require_once("navigation.txt") ?>
    <div class="container-fluid">        
    <ul class="nav nav-tabs mt-3" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#info" role="tab">Supplier Info</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#products" role="tab">Products</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#transactions" role="tab">Transactions</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#invoices" role="tab">Invoices</a>
            </li>

            
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane active" id="info" role="tabpanel">
                <input type="hidden" id="id" name="id" value="<?php  
                    if(isset($_GET['supplierid'])){
                        echo $_GET['supplierid'];
                    }else{
                        echo 0;
                    }
                ?>">
                <!-- <p class="lead text-center mb-2 mt-2">Please Provide Supplier Details</p> -->
                <div id="errors" class="mt-2 mb-3" ></div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="suppliernames">Supplier Name:</label>
                            <input type="text" id="suppliername" name="suppliername" class="form-control form-control-sm">
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label for="physicaladdress">Physical Address:</label>
                            <input type="text" id="physicaladdress" name="physicaladdress" class="form-control form-control-sm">
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label for="postaladdress">Postal Address:</label>
                            <input type="text" id="postaladdress" name="postaladdress" class="form-control form-control-sm">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" id="email" name="email" class="form-control form-control-sm">
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label for="mobile">Mobile:</label>
                            <input type="text" id="mobile" name="mobile" class="form-control form-control-sm">
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label for="creditlimit">Credit Limit:</label>
                            <input type="text" id="creditlimit" name="creditlimit" class="form-control form-control-sm">
                        </div>
                    </div>
                </div>

                <input type="button" id="savesupplier" name="savesupplier" Value="Save supplier" class="btn btn-success">
                <input type="button" id="goback" name="goback" Value="Back to list" class="btn btn-secondary">                                                                                                 
            </div>
            
            <div class="tab-pane" id="products" role="tabpanel">
                <div id="errorproductlist" class="mt-2 mb-2"></div>
                <table class="table table-striped table-sm mt-3" id="supplierproducts">
                    <thead class="thead-light">
                        <th>#</th>
                        <th>Product Code</th>
                        <th>Product Name</th>
                        <th>Date Added</th>
                        <th>Added By</th>
                        <th>&nbsp;</th>
                    </thead>
                    <tbody id="productslist"></tbody>
                    <tfoot></tfoot>
                </table>
                <input type="button" id="addproduct" name="addproduct" value="Add Product(s)" class="btn btn-success" data-toggle='modal' data-target='#productdetails'>
            </div>

            <div class="tab-pane" id="invoices" role="tabpanel">
                
                <div class="row">
                    <div class="col col-md-3">
                        <div class="card mt-3">
                            <div class="card-header">
                                Filter Options
                            </div>
                            <div class="card-body">
                                <div id="errorinvoices" class="mt-2 mb-2"></div>
                                <input type="checkbox" name="alldates" id="alldates">All dates
                                <div class="form-group">
                                    <label for="startdate">Start Date</label>
                                    <input type="text" id="startdate"class="form-control form-control-sm">
                                </div>
                                <div class="form-group">
                                    <label for="enddate">End Date</label>
                                    <input type="text" id="enddate"class="form-control form-control-sm">
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select id="status"class="form-control form-control-sm">
                                        <option value='<All>'>&lt;All&gt;</option>
                                        <option value='Pending'>Pending</option>
                                        <option value='Partially Paid'>Partially Paid</option>
                                        <option value='Fully Paid'>Fully Paid</option>
                                    </select>
                                </div>
                                <button class='btn btn-dark btn-sm' id="filterbutton" name="filterbutton">Filter Invoices</button>
                                <input type="button" id="addinvoice" name="addinvoice" value="Add New Invoice" class="btn btn-success btn-sm">
                            </div>
                        </div>
                        
                    </div>
                    <div class="col">
                        <table class="table table-striped table-sm mt-3" id="supplierinvoices">
                            <thead class="thead-light">
                                <th>#</th>
                                <th>Invoice #</th>
                                <th>Date Added</th>
                                <th>Invoice Amount</th>
                                <th>Paid</th>
                                <th>Balance</th>
                                <th>Status</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody id="invoiceslist"></tbody>
                            <tfoot></tfoot>
                        </table>
                        
                    </div>
                </div>
                
            </div>

            <div class="tab-pane" id="transactions" role="tabpanel">
                <div class="row mt-2">
                    <div class="col col-md-3" id="filteroptions">
                        <p class="alert alert-info">Filter Options</p>
                            <div id="statementerrors"></div>
                        
                            <div class="form-group">
                                <label for="statementstartdate">Start Date</label>
                                <input type="text" id="statementstartdate" name="statementstartdate"class="form-control form-control-sm">
                                <label for="statementenddate">End Date</label>
                                <input type="text" id="statementenddate" name="statementenddate"class="form-control form-control-sm">
                            </div>

                            <button type="button" class="btn btn-secondary" id="generatestatement" name="generatestatement">Generate Statement</button>
                    </div>

                    <div class="col">
                        <div class="alert alert-success font-weight-bold">
                            <div>
                                <a class='btn btn-danger btn-sm' data-toggle='collapse' href='#filteroptions' role='button' aria-expanded='false' aria-controls='filteroptions'><i class="far fa-eye-slash"></i></a>
                                <span>Supplier's Statement</span> 
                            </div>
                        </div>
                        <div id='supplierstatement'></div>
                        <div id='supplieraging'></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade alert-dismissable fade" id="productdetails">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" id="supplierproductsform" name="supplierproductsform">
                    <div class="modal-header">
                        <p  class="modal-title">Select Customer Products</p>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="errorsproduct" id="errorsproduct"></div>
                        <input type="hidden" name="savesupplierproducts" id="savesupplierproducts" value="true">
                        <input type="hidden" id="supplierid" name="supplierid" value="<?php  
                            if(isset($_GET['supplierid'])){
                                echo $_GET['supplierid'];
                            }else{
                                echo 0;
                            }
                        ?>">
                        <div class="form-group">
                            <label for="productcategory">Category</label>
                            <select name="productcategory" id="productcategory"class="form-control form-control-sm"></select>
                        </div>

                        <div class="form-group">
                            <label for="productname">Product(s)</label>
                            <select name="productname[]" id="productname" multiple class="form-control form-control-sm"></select>
                        </div>

                    </div>
                
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-success" id="saveproduct" name="savesupplierproducts" value="Save Product(s)">
                        <button type="button" class="btn btn-danger" id="cancelprocust" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<?php require_once("footer.txt") ?>
<script type="text/javascript" src="../js/supplierdetails.js"></script>
</html>