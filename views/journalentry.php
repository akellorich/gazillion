<html>
<head>
    <title>Journal Entry</title>
    <?php require_once("header.txt") ?>
<head>
<body>
    <?php include_once("navigation.txt") ?>
    
    <div class="container-fluid">
        <div class="lead text-center mt-3 mb-2 font-weight-bold">Make Journal Entry</div> 
        <div id="errors"></div>
        <div class="row">
            <div class="col cols-md-6">
                <div class="form-group">
                    <label for="journaldescription">Journal Entry Description:</label>
                    <input type="text" id="journaldescription" class='form-control form-control-sm'>
                </div> 
            </div>

            <div class="col col-md-3">
                <div class="form-group">
                    <label for="referenceno">Reference Number:</label>
                    <input type="text" class="form-control form-control-sm" name="referenceno" id="referenceno">
                </div>
            </div>
            <div class="col col-md-2 mt-4">
                <div class="checkgroup">
                    <input type="checkbox" name="posttogl" id="posttogl">
                    <label for="posttogl">Post to GL</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="glaccount">GL Account</label>
                    <select name="glaccount" id="glaccount" class='form-control form-control-sm'></select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="narration">Narration</label>
                    <input type="text" id="narration" name="narration" class="form-control form-control-sm">
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <label for="debit">Debit</label>
                    <input type="number" name="debit" id="debit" class='form-control form-control-sm'>
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <label for="credit">Credit</label>
                    <input type="number" name="credit" id="credit"  class='form-control form-control-sm'>
                </div>
            </div>
            <div class="col col-md-2">
                <div class="form-group">
                    
                    <button class='btn btn-secondary btn-sm mt-4' class='form-control' id="add">Add to List</button>
                </div>
            </div>
        </div>
       <table class='table table-sm table-striped' id="journalentries">
           <thead>
               <th>#</th>
               <th>Account Name</th>
               <th>Narration</th>
               <th>Debit</th>
               <th>Credit</th>
               <th>&nbsp;</th>
               <th>&nbsp;</th>
           </thead>
           <tbody></tbody>
           <tfoot class='font-weight-bold text-secondary'>
               <td colspan="2">TOTALS</td>
               <td id="difference">Difference:</td>
               <td id='debits'>DR:</td>
               <td id='credits'>CR:</td>
               <td colspan="2">&nbsp;</td>
           </tfoot>
       </table>
       <button class='btn btn-success' id="save">Save Journal</button>
       <button class='btn btn-danger' id="clear">Clear Form</button>
    </div>
</body>
<?php require_once("footer.txt") ?>
<script type="text/javascript" src="../js/journalentry.js"></script>
</html>