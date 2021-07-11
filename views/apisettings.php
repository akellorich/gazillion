<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once("header.txt") ?>
    <title>API Settings</title>
</head>
<body>
    <?php require_once("navigation.txt"); ?>
    <div class="container-fluid">
        <div class="col-md-12 text-center ">
            <nav class="nav-justified ">
            <div class="nav nav-tabs " id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="pop1-tab" data-toggle="tab" href="#pop1" role="tab" aria-controls="pop1" aria-selected="true">MPESA</a>
                <a class="nav-item nav-link" id="pop2-tab" data-toggle="tab" href="#pop2" role="tab" aria-controls="pop2" aria-selected="false">Email</a>
                <a class="nav-item nav-link" id="pop2-tab" data-toggle="tab" href="#pop3" role="tab" aria-controls="pop3" aria-selected="false">SMS Gateway</a>
            </div>
            </nav>
            <div class="tab-content text-left " id="nav-tabContent">
                <div class="tab-pane fade show active align-self-center" id="pop1" role="tabpanel" aria-labelledby="pop1-tab">
                    <div class="pt-3"></div>
                    <div id="mpesaerrors"></div>
                    <div class="form-group">
                        <label for="consumerkey">Consumer Key</label>
                        <input type="text" id="consumerkey" class="form-control form-control-sm">
                    </div>
                    <div class="form-group">
                        <label for="consumersecret">Consumer Secret</label>
                        <input type="text" id="consumersecret" class="form-control form-control-sm">
                    </div>
                    <div class="form-group">
                        <label for="paybillnumber">Paybill  Number</label>
                        <input type="text" id="paybillnumber" class="form-control form-control-sm">
                    </div>
                    <div class="form-group">
                        <label for="validationurl">Validation URL</label>
                        <input type="text" id="validationurl" class="form-control form-control-sm">
                    </div>
                    <div class="form-group">
                        <label for="confirmationurl">Confirmation URL</label>
                        <input type="text" id="confirmationurl" class="form-control form-control-sm">
                    </div>
                    <button id="savempesa" class="btn btn-sm btn-success">Save Configuration</button>
                    <button id="simulatec2bapi" class="btn btn-sm btn-success" data-toggle="modal" data-target="#simulatec2bmodal">Simulate C2B Transaction</button>
                    <button id="simulatestkpushapi" class="btn btn-sm btn-success">Simulate STK Push</button>
                </div>

                <div class="tab-pane fade" id="pop2" role="tabpanel" aria-labelledby="pop2-tab">
                    <div class="pt-3"></div>
                    <div class="row">
                        <div class="col">
                            <div id="emailerrors"></div>
                            <div class="form-group">
                                <label for="senderemail">Sender Email Address</label>
                                <input type="email" id="senderemail" class="form-control form-control-sm">
                            </div>
                            <div class="form-group">
                                <label for="emailapssword">Password</label>
                                <input type="password" name="password" id="password" class="form-control form-control-sm">
                            </div>
                            <div class="form-group">
                                <label for="smtp">SMTP Server</label>
                                <input type="text" id="smtp" class="form-control form-control-sm">
                            </div>
                            <div class="from-group">
                                <label for="smtpport">SMTP Port</label>
                                <input type="number" id="smtpport" class="form-control form-control-sm">
                            </div>
                            <div>
                                <input type="checkbox" name="usessl" id="usessl">
                                <label for="usessl">Use SSL ?</label>
                            </div>

                            <button id="saveemail" class="btn btn-sm btn-success">Save Configuration</button>
                        </div>
                        <div class="col">
                            <div id="testmailerrors"></div>
                            <div class="form-group">
                                <label for="testemailaddress">Recipient Email Address</label>
                                <input type="text" id="testemailaddress" class="form-control form-control-sm">
                            </div>
                            <div class="form-group">
                                <label for="testemailsubject">Email Subject</label>
                                <input type="text" id="testemailsubject" class="form-control form-control-sm">
                            </div>
                            <div class="form-group">
                                <label for="testemailmessage">Message</label>
                                <textarea name="" id="testemailmessage" class="form-control form-control-sm"></textarea>
                            </div>
                            <button id="sendtestemail" class="btn btn-danger btn-sm">Send Test Email</button>
                        </div>
                    </div>
                    
                </div>
                <div class="tab-pane fade" id="pop3" role="tabpanel" aria-labelledby="pop3-tab">
                    <div class="pt-3"></div>
                    <div class="row">
                        <div class="col">
                            <div id="smserrors"></div>
                            <div class="form-group">
                                <label for="smssenderid">Sender ID</label>
                                <input type="text" id="smssenderid" class="form-control form-control-sm">
                            </div>
                            <div class="form-group">
                                <label for="smsusername">Username</label>
                                <input type="text" id="smsusername" class="form-control form-control-sm">
                            </div>
                            <div class="form-group">
                                <label for="smsapikey">API Key</label>
                                <input type="text" id="smsapikey" class="form-control form-control-sm">
                            </div>
                            <button id="savesms" class="btn btn-sm btn-success">Save Configuration</button>
                        </div>

                        <div class="col">
                            <div id="testsmserrors"></div>
                            <div class="form-group">
                                <label for="testsmsrecipient">Message Recipient</label>
                                <input type="text" id="testsmsrecipient" class="form-control form-control-sm">
                            </div>
                            <div class="form-group">
                                <label for="testsmsmessage">Test Message</label>
                                <textarea name="testsmsmessage" id="testsmsmessage"  class="form-control form-control-sm"></textarea>
                            </div>
                            <button id="sendtestmessage" class="btn btn-sm btn-success">Send Test Message</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
        <!-- Add a modal to test MPESA -->
        <div class="modal fade alert-dismissable fade" id="simulatec2bmodal">
                <div class="modal-dialog">
                    <div class="modal-content" id="simulatec2bmodaldetails">
                        <div class="modal-header">
                            <p  class="modal-title" ><h5>Simulate C2B Transaction</h5></p>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div> <!-- -->
                        <div class="modal-body">
                            <div id="simulatec2berrors" class="simulatec2berrors"></div>
                            <div class="form-group">
                                <!-- <input type="hidden" name="propertyblockid" id="propertyblockid" value="0"> -->
                                <label for="c2burl">URL: </label>
                                <input type="text" name="c2burl" id="c2burl" class='form-control form-control-sm'> 
                            </div>
                            <div class="form-group">
                                <label for="c2bmsisdn">Customer's Mobile Number: </label>
                                <input type="text" name="c2bmsisdn" id="c2bmsisdn" class='form-control form-control-sm'>
                            </div>
                            <div class="form-group">
                                <label for="c2bshortcode">Short Code:</label>
                                <input type="number" name="c2bshortcode" id="c2bshortcode" class='form-control form-control-sm'>
                            </div>
                            <div class="form-group">
                                <label for="c2breference">Reference #:</label>
                                <input type="text" name="c2breference" id="c2breference" class='form-control form-control-sm'>

                            </div>
                            <div class="form-group">
                                <label for="c2bamount">Amount:</label>
                                <input type="number" name="c2bamount" id="c2bamount" class='form-control form-control-sm'>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" id="simulate2cbtransactionbutton">Simulate Transaction</button>
                            <!-- <button type="button" class="btn btn-info btn-sm" id="clearpropertyblock">Clear Fields</button> -->
                            <button type="button" class="btn btn-danger btn-sm" id="closepropertyblock" data-dismiss="modal">Close Window</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of the modal -->

    </div>
    
</body>
<?php require_once("footer.txt") ?>
<script src="../js/apisettings.js"></script>
</html>