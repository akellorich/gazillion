<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once("header.txt") ?>
    <title>Settings</title>
</head>
<body>
    <?php require_once("navigation.txt") ?>
    <div class="container-fluid">
        <div id="errors" class="mt-2 mb-2"></div>
        <div class="row">
           <div class="col">
                <div class="card">
                    <div class="card-header">
                        <span class="text-left font-weight-bold">Units of Measure</span>
                        <span class="float-right">
                            <a href="#" class="settingslink" data-id='adduom'><i class="fas fa-plus-circle fa-fw fa-lg"></i></a>
                            <a href="#" class="settingslink" data-id='edituom'><i class="far fa-edit fa-fw fa-lg"></i></a>
                            <a href="#" class="settingslink" data-id='deleteuom'><i class="fas fa-minus-circle fa-fw fa-lg"></i></a>
                        </span>
                    </div>
                    <div class="card-body">
                        <div id="unitofmeasure"></div>
                    </div>
                </div>
           </div>

           <div class="col">
                <div class="card">
                    <div class="card-header">
                        <span class="text-left font-weight-bold">Registration Documents</span>
                        <span class="float-right">
                            <a href="#" class="settingslink" data-id='addregdoc'><i class="fas fa-plus-circle fa-fw fa-lg"></i></a>
                            <a href="#" class="settingslink" data-id='editregdoct'><i class="far fa-edit fa-fw fa-lg"></i></a>
                            <a href="#" class="settingslink" data-id='deleteregdoc'><i class="fas fa-minus-circle fa-fw fa-lg"></i></a>
                        </span>
                    </div>
                    <div class="card-body">
                        <div id="regcert"></div>
                    </div>
                </div>
           </div>

           <div class="col">
                <div class="card">
                    <div class="card-header">
                        <span class="text-left font-weight-bold">Property Types</span>
                        <span class="float-right">
                            <a href="#" class="settingslink" data-id='addpropertytype'><i class="fas fa-plus-circle fa-fw fa-lg"></i></a>
                            <a href="#" class="settingslink" data-id='editpropertytype'><i class="far fa-edit fa-fw fa-lg"></i></a>
                            <a href="#" class="settingslink" data-id='deletepropertytype'><i class="fas fa-minus-circle fa-fw fa-lg"></i></a>
                        </span>
                    </div>
                    <div class="card-body">
                        <div id="propertytype"></div>
                    </div>
                </div>
           </div>

           <div class="col">
                <div class="card">
                    <div class="card-header">
                        <span class="text-left font-weight-bold">Property Owner Types</span>
                        <span class="float-right">
                            <a href="#" class="settingslink" data-id='addpropertyownertype'><i class="fas fa-plus-circle fa-fw fa-lg"></i></a>
                            <a href="#" class="settingslink" data-id='editpropertyownertype'><i class="far fa-edit fa-fw fa-lg"></i></a>
                            <a href="#" class="settingslink" data-id='deletepropertyownertype'><i class="fas fa-minus-circle fa-fw fa-lg"></i></a>
                        </span>
                    </div>
                    <div class="card-body">
                        <div id="propertyownertype"></div>
                    </div>
                </div>
           </div>
        </div>
        <!-- second row -->
        <div class="row mt-2">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <span class="text-left font-weight-bold">Property Unit Types</span>
                        <span class="float-right">
                            <a href="#" class="settingslink" data-id='addunittype'><i class="fas fa-plus-circle fa-fw fa-lg"></i></a>
                            <a href="#" class="settingslink" data-id='editunittype'><i class="far fa-edit fa-fw fa-lg"></i></a>
                            <a href="#" class="settingslink" data-id='deleteunittype'><i class="fas fa-minus-circle fa-fw fa-lg"></i></a>
                        </span>
                    </div>
                    <div class="card-body">
                        <div id="unittypeslist"></div>
                    </div>
                </div>
            </div>
            <div class="col">
                
            </div>

            <div class="col">

            </div>

            <div class="col">

            </div>
        </div>
    </div>
</body>
<?php require_once("footer.txt") ?>
<script src="../js/settings.js"></script>
</html>