<!DOCTYPE html>
<html lang="en">
<head>
   <!-- <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="../css/all.css" rel="stylesheet" type="text/css" />
    <link href="../css/role.css" rel="stylesheet" type="text/css" />
    <link href="../css/global.css" rel="stylesheet" type="text/css" /> -->
    <?php require_once("header.txt") ?>
    <title>User Managenment</title>
</head>
<body>
<?php require_once("navigation.txt") ?>
<div class="container-fluid">
    
    <div class="row">
        <div class="col col-md-3">
            <section class=" ">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center ">
                            <nav class="nav-justified ">
                            <div class="nav nav-tabs " id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="pop1-tab" data-toggle="tab" href="#pop1" role="tab" aria-controls="pop1" aria-selected="true">Users</a>
                                <a class="nav-item nav-link" id="pop2-tab" data-toggle="tab" href="#pop2" role="tab" aria-controls="pop2" aria-selected="false">Roles</a>
                            </div>
                            </nav>
                            <div class="tab-content text-left" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="pop1" role="tabpanel" aria-labelledby="pop1-tab">
                                        <div class="pt-3"></div>
                                        <div class="form-group">
                                            <label for="userslist">User</label>
                                            <select name="userslist" id="userslist" class='form-control form-control-sm mb-2'></select>
                                            <button class="btn btn-secondary btn-sm" id="changestatusbutton">Disable Account</button>
                                            <button class="btn btn-danger btn-sm" id="changepasswordbutton">Reset Password</button>
                                            <div id="userroles" class="mt-3">
                                                <p class='font-weight-bold'>Assigned Roles:</p>
                                                <div id="userroleslist"></div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                <div class="tab-pane fade" id="pop2" role="tabpanel" aria-labelledby="pop2-tab">
                                    <div class="pt-3"></div>
                                       <div id="roles" class="roles"></div>
                                       <div class="roleusers mt-3" id="roleusers"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        
        <div class="col">
            <div id="userdetails" class="mt-3">
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <p class="alert alert-secondary">User Details</p>
                            </div>
                        </div>
                        <!-- This section displays save error messages -->
                        <div class="row">
                            <div class="col">
                                <div id="errordiv"></div>
                            </div>
                        </div>
                        <div class="row"> 
                            <div class="col">
                                <div class="form-group">
                                    <input type="hidden" id="userid" value="0">
                                    <input type="hidden" id="accountactive" value="0">
                                    <label for="username">Username:</label>
                                    <div class="input-group">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input type="text" name="username" id="username" class="form-control  form-control-sm">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="firstname">First Name:</label>
                                    <div class="input-group">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                                        </div>
                                        <input type="text" name="firstname" id="firstname" class="form-control  form-control-sm">
                                    </div> 
                                </div>
                            </div>
                            
                            <div class="col">
                                <div class="form-group">
                                    <label for="middlename">Middle Name:</label>
                                    <div class="input-group">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                                        </div>
                                        <input type="text" name="middlename" id="middlename" class="form-control  form-control-sm">
                                    </div>  
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="lastname">Last Name:</label>
                                    <div class="input-group">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                                        </div>
                                        <input type="text" name="lastname" id="lastname" class="form-control  form-control-sm">
                                    </div>   
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="password">Password:</label>
                                    <div class="input-group">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                                        </div>
                                         <input type="password" name="password" id="password" class="form-control  form-control-sm">
                                    </div>  
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="confirmpassword">Confirm Password:</label>
                                    <div class="input-group">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                                        </div>
                                        <input type="password" name="confirmpassword" id="confirmpassword" class="form-control  form-control-sm">
                                    </div>
                                   
                                </div>      
                            </div>
                            
                            <div class="col">
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <div class="input-group">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-at"></i></span>
                                        </div>
                                          <input type="email" name="email" id="email" class="form-control  form-control-sm">
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="mobile">Mobile:</label>
                                    <div class="input-group">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                        <input type="number" name="mobile" id="mobile" class="form-control  form-control-sm"> 
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="check-group">
                                    <input type="checkbox" class="check-control" id="systemadmin" name="systemadmin">
                                    <label for="systemadmin" class="check-label">System Administrator (Overrides All Privileges)</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="check-group">
                                    <input type="checkbox" class="check-control" id="changepasswordonlogon" name="changepasswordonlogon">
                                    <label for="changepasswordonlogon" class="check-label">Change password on Logon</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col" id="userprivileges">
                        
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <button class='btn btn-secondary btn-sm' id='saveuser'>Save User</button>
                        <button class='btn btn-danger btn-sm' id='clearuser'>Clear Fields</button>
                        <button class='btn btn-success btn-sm' id='adduserrole' data-toggle='modal' data-target='#userrolesadd'>Add Role</button>
                    </div>
                </div>

            </div>

            <div id="roledetails" class="mt-3">
                <div class="row">
                    <div class="col">
                        <div class="alert alert-secondary">Roles Details</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div id="roleerrors" class="roleerrors">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="control-group">
                            <input type="hidden" id="roleid" name="roleid" value="0">
                            <label for="rolename">Role Name</label>
                            <input type="text" id="rolename" name="rolename" class='form-control form-control-sm'>
                        </div>
                    </div>
                    <div class="col">
                        <div class="control-group">
                            <label for="roledescription">Role Description</label>
                            <input type="text" id="roledescription" name="roledescription" class='form-control form-control-sm'>
                            <p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col" id="roleprivileges" class="mt-3">
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button class='btn btn-secondary btn-sm' id="saverole">Save Role</button>
                        <button class='btn btn-danger btn-sm' id='deleterole'>Delete Role</button>
                        <button class='btn btn-info btn-sm' id='clearrole'>Clear Form</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade alert-dismissable fade" id="userrolesadd">
            <div class="modal-dialog">
                <div class="modal-content" id="heldsalesdetails">
                    <div class="modal-header">
                        <p  class="modal-title" >Select Role(s)</p>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div> <!-- -->
                    <div class="modal-body" id="">
                        <div id="userroleerrors"></div>
                        <div id="usernonroles"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" id="saveuserrole" >Save Roles</button>
                        <button type="button" class="btn btn-danger btn-sm" id="cancelsaveuserrole" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</body>
<!-- <script src="../js/popper.js"></script>
<script src="../js/jquery-2.2.4.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="../js/bootbox.min.js"></script>
<script src="../js/functions.js"></script> -->
<?php require_once("footer.txt") ?>)
<script src="../js/usersmanager.js"></script>
</html>
