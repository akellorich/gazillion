<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once("header.txt") ?>
    <!-- <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"> -->
    <title>Chart of Accounts</title>
    
</head>
<body>
    <?php require_once("navigation.txt")   ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3" id="chartofaccountslist">
                <button class="btn btn-success btn-sm w-100 mb-1 mt-3" data-toggle='modal' data-target='#glgroups'>Add GL group</button>
                <button class="btn btn-danger btn-sm w-100 mb-1">Delete GL Account</button>
                <div id="accordion" class="myaccordion" id="myaccordion">
                </div>
            </div>

           
            <div class="col" id="chartofaccountsdetail">
                <div class="card mt-3">
                    <div class="card-header">
                        Account Details
                    </div>

                    <div class="card-body">
                        <input type="hidden" id="id" name="id" value="0">
                        <div id="accounterrordiv" class="accounterrordiv"></div>
                        <div class="form-group">
                            <label for="accountclass">Account Class</label>
                            <select name="accountclass" id="accountclass" class="form-control form-control-sm"></select>
                        </div>

                        <div class="form-group">
                            <label for="accountgroup">Parent Group</label>
                            <select name="accountgroup" id="accountgroup" class="form-control form-control-sm"></select>
                        </div>

                        <div class="from-group">
                            <label for="subgroupname">Subgroup</label>
                            <select name="accountsubgroup" id="accountsubgroup" class="form-control form-control-sm"></select>
                        </div>

                        <div class="form-group">
                            <label for="accountcode">Account Code</label>
                            <input type="text" id="accountcode" name="accountcode" class='form-control form-control-sm'>
                        </div>

                        <div class="form-group">
                            <label for="accountname">Account Name</label>
                            <input type="text" id="accountname" name="accountname" class="form-control form-control-sm">
                        </div>

                        <button class='btn btn-success btn-sm' id="savebutton">Save GL Account</button>
                        <button class="btn btn-danger btn-sm" id="clearbutton">Clear Form</button>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card mt-3">
                    <div class="card-body">
                        GL Account Summary
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade alert-dismissable fade" id="glgroups">
        <div class="modal-dialog">
            <div class="modal-content">
              
                <div class="modal-body">
                    <div id="grouperrors"></div>
                    <div class="form-group">
                        <label for="glgroupclass">Group Class</label>
                        <select name="groupclass" id="groupclass" class="form-control form-control-sm"></select>
                    </div>
                    <div class="form-group">
                        <label for="subgroupof">Sub Group Of</label>
                        <select name="subgroupof" id="subgroupof" class='form-control form-control-sm'></select>
                    </div>
                    <div class="from-group">
                        <label for="groupname">GL Parent Group Name</label>
                        <input type="text" id="groupname" name="groupname" class='form-control form-control-sm'>
                    </div>

                    <div class="form-check">
                        <input type="checkbox" id="cashbookgroup" name="cashbookgroup" class="form-check-input">
                        <label for="cashbookgroup" class="form-check-label">Cashbook Group</label>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success btn-sm" id="savegroup">Save GL Group</button>
                    <button type="button" class="btn btn-danger btn-sm" id="close" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</body>
<?php require_once("footer.txt") ?>
<script src="../js/chartofaccounts.js"></script>
</html>