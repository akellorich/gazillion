$(document).ready(function(){
    var consumerkeyfield=$("#consumerkey"),
        consumersecretfield=$("#consumersecret"),
        validationurlfield=$("#validationurl"),
        confirmationurlfield=$("#confirmationurl"),
        paybillnofield=$("#paybillnumber"),
        savempesabutton=$("#savempesa"),
        mpesaerrors=$("#mpesaerrors"),

        emailaddressfield=$("#senderemail")
        emailapsswordfield=$("#password"),
        smtpserverfield=$("#smtp"),
        smtpportfield=$("#smtpport"),
        usesslfield=$("#usessl"),
        saveemailconfigurationbutton=$("#saveemail"),
        emailerrors=$("#emailerrors"),

        smssenderidfield=$("#smssenderid"),
        smsusernamefield=$("#smsusername"),
        smsapikeyfield=$("#smsapikey"),
        savesmsconfigurationbutton=$("#savesms"),
        smserrors=$("#smserrors")

        testsmsrecipients=$("#testsmsrecipient")
        testsmsmessage=$("#testsmsmessage")
        testsmssendbutton=$("#sendtestmessage")
        testsmserrors=$("#testsmserrors")

        testemailaddress=$("#testemailaddress")
        testemailsubject=$("#testemailsubject")
        testemailmessage=$("#testemailmessage")
        sendtestemail=$("#sendtestemail")
        testemailerrors=$("#testmailerrors"),
        mpesac2burl=$("#c2burl"),
        mpesac2bshortcode=$("#c2bshortcode"),
        mpesac2bmsisdn=$("#c2bmsisdn"),
        mpesac2breference=$("#c2breference"),
        mpesac2bamount=$("#c2bamount"),
        mpesac2bsimulatetransaction=$("#simulate2cbtransactionbutton"),
        simulatec2berror=$("#simulatec2berrors")
    // show user logged in
    setLoggedInUserName()
    // get MPESA C2B saved configurations
    $.getJSON(
        "../controllers/settingsoperations.php",
        {
            getmpesac2bparameters:true
        },
        function(data){
            mpesac2burl.val(data[0].c2burl)
            mpesac2bshortcode.val(data[0].c2bshortcode)
            mpesac2bmsisdn.val(data[0].c2bmsisdn)
        }
    )
    // get MPESA configuration
    $.getJSON(
        "../controllers/settingsoperations.php",
        {
            getmpesaconfiguration:true
        },
        function(data){
            consumerkeyfield.val(data[0].consumerkey)
            consumersecretfield.val(data[0].consumersecret)
            validationurlfield.val(data[0].validationurl)
            confirmationurlfield.val(data[0].confirmationurl)
            paybillnofield.val(data[0].paybillnumber)
        }
    )
    
    // get email configuration
    $.getJSON(
        "../controllers/settingsoperations.php",
        {
            getemailconfiguration:true
        },
        function(data){
            if(data.length>0){
                emailaddressfield.val(data[0].emailaddress)
                emailapsswordfield.val(data[0].password)
                smtpserverfield.val(data[0].smtpserver)
                smtpportfield.val(data[0].smtpport)
                usesslfield.prop("checked",data[0].usessl==1?true:false)
            }
        }
    )

    // get SMS configuration
    $.getJSON(
        "../controllers/settingsoperations.php",
        {
            getsmsconfiguration:true
        },
        function(data){
            if(data.length>0){
                smssenderidfield.val(data[0].senderid)
                smsusernamefield.val(data[0].username)
                smsapikeyfield.val(data[0].apikey)
            }
        }
    )
    
    // save MPESA configuration
    savempesabutton.on("click",function(){
        mpesaerrors.html("<p class='text-info'><i class='fas fa-shipping-fast fa-fw fa-lg'></i> Configuring MPESA Parameters. Please Wait ...</p>")
        var consumerkey=consumerkeyfield.val(),
            consumersecret=consumersecretfield.val(),
            validationurl=$.trim(validationurlfield.val()),
            confirmationurl=$.trim(confirmationurlfield.val()),
            paybillno=$.trim(paybillnofield.val()),
            errors="",
            results=""
        if(consumerkey==""){
            errors="Please provide Consumer Key"
        }else if(consumersecret==""){
            errors="Please provide Consumer Secret"
        }else if(paybillno==""){
            errors="Please provide the Paybill Number"
        }else if(validationurl==""){
            errors="Please provide the Validation URL"
        }else if(confirmationurl==""){
            errors="Please provide the Confirmation URL"
        }
        if(errors==""){
            $.post(
                "../controllers/settingsoperations.php",
                {
                    savempesaconfiguraion:true,
                    consumerkey:consumerkey,
                    consumersecret:consumersecret,
                    paybillnumber:paybillno,
                    validationurl:validationurl,
                    confirmationurl:confirmationurl
                },
                function(data){
                    data=$.trim(data)
                    console.log(data)
                    if(data.ResponseDescription=="success"){
                        success=1
                        results="MPESA Configuration Saved Successfully."
                    }else{
                        results="<p class='text-danger'><i class='fas fa-times-circle fa-fw fa-lg'></i> "+data+"</p>"
                    }
                    //mpesaerrors.html(results)
                }
            )

            // register URLS
            $.post(
                "../controllers/mpesaoperations.php",
                {   
                    registerurl:true,
                    confirmationurl:confirmationurl,
                    validationurl:validationurl
                },
                function(data){
                    //console.log(data)
                    data=JSON.parse(data)//.slice(1)
                    if(data.ResponseDescription=="success"){
                        results="<p class='text-success'><i class='fas fa-check-circle fa-fw fa-lg'></i> "+results+"</p>"
                        results+="<p class='text-success'><i class='fas fa-check-circle fa-fw fa-lg'></i> MPESA URL registration also completed successfully</p>"
                    }else{
                        results="<p class='text-success'><i class='fas fa-check-circle fa-fw fa-lg'></i> "+results+"</p>"
                        results+="<p class='text-danger'><i class='fas fa-times-circle fa-fw fa-lg'></i></i> URLs registration failed: "+data.errorMessage+"<br></p>"
                    }  
                    mpesaerrors.html(results)
                }
            )
        }else{
            errors="<p class='text-danger'><i class='fas fa-info-circle fa-fw fa-lg'></i>"+errors+"</p>"
            mpesaerrors.html(errors)
        }   
    })

    // save email configuration
    saveemailconfigurationbutton.on("click",function(){
        var emailaddress=emailaddressfield.val(),
            emailpassword=emailapsswordfield.val(),
            smtpserver=smtpserverfield.val(),
            smtpport=smtpportfield.val(),
            usessl=usesslfield.prop("checked")?1:0,
            errors="",
            results=""
        // check for blank fields
        if(emailaddress==""){
            errors="Please provide Sender Email Address"
        }else if(emailpassword==""){
            errors="Please provide Password for the Email Account"
        }else if(smtpserver==""){
            errors="Please provide SMTP server"
        }else if(smtpport==""){
            errors="Please provide SMTP port"
        }
        if(errors==""){
            $.post(
                "../controllers/settingsoperations.php",
                {
                    saveemailconfiguration:true,
                    emailaddress:emailaddress,
                    password:emailpassword,
                    smtpserver:smtpserver,
                    smtpport:smtpport,
                    usessl:usessl
                },
                function(data){
                    data=$.trim(data)
                    if(data=="success"){
                        results="<p class='text-success'><i class='fas fa-check-circle fa-fw fa-lg'></i> Email configuration saved successfully.</p>"
                    }else{
                        results="<p class='text-danger'><i class='fas fa-times-circle fa-fw fa-lg'></i> "+data+"</p>"
                    }
                    emailerrors.html(results)
                }
            )
        }else{
            errors="<p class='text-danger'><i class='fas fa-info-circle fa-fw fa-lg'></i>"+errors+"</p>"
            emailerrors.html(errors)
        }
    })

    //save sms configuration
    savesmsconfigurationbutton.on("click",function(){
        var senderid=smssenderidfield.val(),
            username=smsusernamefield.val(),
            apikey=smsapikeyfield.val(),
            errors="",
            results=""
        if(senderid==""){
            errors="Please provide Sender ID"
        }else if(username==""){
            errors="Please provide Username"
        }else if(apikey==""){
            errors="Please provide API Key"
        }

        if(errors==""){
            $.post(
                "../controllers/settingsoperations.php",
                {
                    savesmsconfiguration:true,
                    senderid:senderid,
                    username:username,
                    apikey:apikey
                },
                function(data){
                    data=$.trim(data) 
                    if(data=="success"){
                        results="<p class='text-success'><i class='fas fa-check-circle fa-fw fa-lg'></i> SMS configuration saved successfully.</p>"
                    }else{
                        results="<p class='text-danger'><i class='fas fa-times-circle fa-fw fa-lg'></i> "+data+"</p>"
                    }
                    smserrors.html(results)
                }
            )
        }else{
            errors="<p class='text-danger'><i class='fas fa-info-circle fa-fw fa-lg'></i>"+errors+"</p>"
            smserrors.html(errors)
        }
    }) 

    testsmssendbutton.on("click",function(){
        var recipient=testsmsrecipients.val(),
            message=testsmsmessage.val(),
            errors="",
            results=""
        
        if(recipient==""){
            errors="Please provide the Recipient(s) number in International Format"
        }else if(message==""){
            errors="Please provide a Message for the Recipients"
        }
        if(errors==""){
            testsmserrors.html("<p class='text-info'><i class='fas fa-shipping-fast fa-fw fa-lg'></i> Sending SMS. Please Wait ...</p>")
            $.post(
                "../controllers/sendsms.php",
               {
                    sendsms:true,
                    recipient:recipient,
                    message:message
               },
               function(data){
                    data=$.trim(data)
                    console.log(data)
                    if(data=="success"){
                        results="<p class='text-success'><i class='fas fa-check-circle fa-fw fa-lg'></i> Test SMS has been sent successfully.</p>"
                    }else{
                        errors="<p class='text-danger'><i class='fas fa-info-circle fa-fw fa-lg'></i>"+data+"</p>"
                    }
                    testsmserrors.html(results)
               }
            )
        }else{
            errors="<p class='text-danger'><i class='fas fa-info-circle fa-fw fa-lg'></i>"+errors+"</p>"
            testsmserrors.html(errors)
        }
    })

    // send test email
    sendtestemail.on("click",function(){
        var emailaddress=testemailaddress.val(),
            subject=testemailsubject.val()
            message=testemailmessage.val(),
            errors="",
            results=""
        if(emailaddress==""){
            errors="Please provide the recipients email address"
        }else if(subject==""){
            errors="Please provide the Email subject"
        }else if(message==""){
            errors="Please provide the Email Message"
        }
        if(errors==""){
            testemailerrors.html("<p class='text-info'><i class='fas fa-shipping-fast fa-fw fa-lg'></i> Sending Mail. Please Wait ...</p>")
            $.post(
                "../controllers/sendmail.php",
                {
                    sendemail:true,
                    recipient:emailaddress,
                    subject:subject,
                    message:message
                },
                function(data){
                    data=$.trim(data)
                    if(data=="success"){
                        results="<p class='text-success'><i class='fas fa-check-circle fa-fw fa-lg'></i> Test email sent successfully.</p>"
                    }else{
                        results="<p class='text-danger'><i class='fas fa-times-circle fa-fw fa-lg'></i> "+data+"</p>"
                    }
                    testemailerrors.html(results)
                }
            )
        }else{
            errors="<p class='text-danger'><i class='fas fa-info-circle fa-fw fa-lg'></i>"+errors+"</p>"
            testemailerrors.html(errors)
        }
    })

    mpesac2bsimulatetransaction.on("click",function(){
        var url=mpesac2burl.val(),
            shortcode=mpesac2bshortcode.val(),
            msisdn=mpesac2bmsisdn.val(),
            amount=mpesac2bamount.val(),
            reference=mpesac2breference.val()
            errors=""
        if(url==""){
            errors="Please enter <strong>C2B URL</strong> first."
        }else if(shortcode==""){
            errors="Please enter <strong>Short Code</strong> first."
        }else if(msisdn==""){
            errors="Please enter <strong>Customers Number</strong> first."
        }else if(amount==""){
            errors="Please enter <strong>Amount</strong> first."
        }else if(reference==""){
            errors="Please enter <strong>Reference</strong> first."
        }
        if(errors==""){
            simulatec2berror.html("<p class='text-info'><i class='fas fa-shipping-fast fa-fw fa-lg'></i> Processing. Please Wait ...</p>")
            $.post(
                "../controllers/settingsoperations.php",
                {
                    savempesac2bparameters:true,
                    url:url,
                    shortcode:shortcode,
                    msisdn:msisdn
                },
                function(data){
                    if(data=="success"){
                        errors="<p class='text-success'><i class='fas fa-check-circle fa-fw fa-lg'></i> C2B Parameters saved successfully.</p>"
                    }else{
                        errors="<p class='text-danger'><i class='fas fa-times-circle fa-fw fa-lg'></i> "+data+"</p>"
                    }
                    // simulate the transaction here
                    // simulatec2berror.html(errors)
                    $.post(
                        "../controllers/mpesaoperations.php",{
                            simulatempesac2btransaction:true,
                            amount:amount,
                            reference:reference
                        },
                        function(data){
                            data=JSON.parse(data)//.slice(1)
                            if(data.ResponseDescription=="Accept the service request successfully."){
                                errors+="<p class='text-success'><i class='fas fa-check-circle fa-fw fa-lg'></i> Test completed successfully.</p>"
                                //results+="<p class='text-success'><i class='fas fa-check-circle fa-fw fa-lg'></i> MPESA URL registration also completed successfully</p>"
                            }else{
                                errors+="<p class='text-danger'><i class='fas fa-times-circle fa-fw fa-lg'></i> Test failed. "+data.errorMessage+"</p>"
                                //results+="<p class='text-danger'><i class='fas fa-times-circle fa-fw fa-lg'></i></i> URLs registration failed: "+data.errorMessage+"<br></p>"
                            }  
                            //errors+="<p class='text-danger'><i class='fas fa-times-circle fa-fw fa-lg'></i> "+data+"</p>"
                            simulatec2berror.html(errors)
                        }
                    )
                }
            )
        }else{
            // display error
            errors="<p class='text-info'><i class='fas fa-info-circle fa-fw fa-lg'></i>"+errors+"</p>"
            simulatec2berror.html(errors)
        }
    })
})