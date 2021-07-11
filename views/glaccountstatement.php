
<html>
<head>
    <title>Sales Report</title>
    <?php require_once("header.txt") ?>
<head>  
<body>
    <?php require_once("navigation.txt") ?>
    <div class="container-fluid mt-3">
        
        <div class="row">
            <div class="col col-md-3">
                <p class="alert alert-info">Filter Options</p>
                    <div id="errors"></div>
                    <div class="check-group">
                        <input type="checkbox" class="check-control" id="alldates" name="alldates">
                        <label for="alldates" class="check-label">All Dates</label>
                    </div>

                    <div class="form-group">
                        <label for="startdate">Start Date</label>
                        <input type="text" id="startdate" name="startdate" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="enddate">End Date</label>
                        <input type="text" id="enddate" name="enddate" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="pos">GL Account</label>
                        <select id="glaccount" name="glaccount" class="form-control"></select>
                    </div>

                    <button type="button" class="btn btn-secondary" id="search" name="search">Generate Statement</button>
            </div>

            <div class="col">
                <p class="alert alert-success font-weight-bold">GL Account Statement</p>
                <div class="results" id="results">
                    <p class="alert alert-info">No results filtered yet</p>
                </div>
            </div>
        </div>
</div>
</body>
<?php require_once("footer.txt") ?>
<script type="text/javascript" src="../js/glaccountstatement.js"></script>
<html>