<html>
<head>
    <title>Balance Sheet Report</title>
    <?php require_once("header.txt") ?>
    <style>
        .alert-success .btn-danger {
            float: left;  
        }

        .alert-success span {
            line-height: 34px;
        }

        .alert-success > div:after {
            clear: both;
            content: '';
            display: table;
        }
        .btn-danger{
            margin-right:1rem;
            margin-left:-0.5rem;
        }
    </style>
<head>
<body>
    <?php require_once("navigation.txt") ?>
    <div class="container-fluid mt-3">
        
        <div class="row">
            <div class="col col-md-3" id="filteroptions">
                <p class="alert alert-info">Filter Options</p>
                    <div id="errors"></div>
                   
                    <div class="form-group">
                        <label for="startdate">Start Date</label>
                        <input type="text" id="startdate" name="startdate" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="enddate">End Date</label>
                        <input type="text" id="enddate" name="enddate" class="form-control">
                    </div>

                    <button type="button" class="btn btn-secondary" id="generate" name="generate">Generate Report</button>
            </div>

            <div class="col">
                <div class="alert alert-success font-weight-bold">
                    <div>
                        <a class='btn btn-danger btn-sm' data-toggle='collapse' href='#filteroptions' role='button' aria-expanded='false' aria-controls='filteroptions'><i class="far fa-eye-slash"></i></a>
                        <span>Balance Sheet</span> 
                    </div>

                </div>
                <div id='report'></div>
            </div>
        </div>
</div>
</body>
<?php require_once("footer.txt") ?>
<script type="text/javascript" src="../js/balancesheet.js"></script>
<html>