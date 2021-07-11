$(document).ready(function(){
    var customertypedropdown=$("#customertype"),
        filtercustomertypedropdwon=$("#filtercustomertype"),
        regdoctype=$("#regdoc"),
        filtercustomerregdoctype=$("#filterregdoc"),
        addpropertydropdown=$("#addcustomerproperty"),
        filterpropertydropdown=$("#filterproperty"),
        addunitdropdown=$("#addcustomerunit"),
        filterpropertyunitdropdown=$("#filterunit"),
        option='<option value="">&lt;Choose One&gt;</option>',
        option1='<option value="0">&lt;All&gt;</option>',
        filtermetermakedropdown=$("#filtermetermake"),
        filtermetermodeldropdown=$("#filtermetermodel"),
        customertypefield=$("#customertype"),
        customernamefield=$("#customername"),
        regdoctypefield=$("#regdoc"),
        regdocreffield=$("#regdocref"),
        pinnumberfield=$("#pinno"),
        postaladdressfield=$("#postaladdress"),
        townfield=$("#town"),
        landlinefield=$("#landline"),
        mobilefield=$("#mobile"),
        emailfield=$("#email"),
        savecustomerbutton=$("#savecustomer"),
        customeridfield=$("#customerid"),
        customererrors=$("#customererrors"),
        attachunitbutton=$("#attachunit"),
        commissionmetercheckfield=$("#commissionmeter"),
        meteridfield=$("#meterid"),
        metercommissiondatefield=$("#addcustomercommissiondate"),
        meterinitialreadingfield=$("#addcustomerinitialreading"),
        customerunitstable=$("#propertylist"),
        uniterrors=$("#uniterrors"),
        postalcodefield=$("#postalcode"),
        customerslist=$("#customerslist")
        customeridlabel=$("#cardcustomerid")
        customernamelabel=$("#cardnames"),
        customeraddresslabel=$("#cardaddress"),
        customerregdoclabel=$("#cardregdocument"),
        customerregdocreflabel=$("#cardregdocref"),
        attachedUnits=[],
        statementmeternumber=$("#statementmeterno"),
        mrmeterno=$("#mrmeternumber"),
        paymentmodefield=$("#paymentmode"),
        mrmeter=$("#mrmeter"),
        ttmeter=$("#ttmeter"),
        mrreadbylist=$("#mrreadby"),
        mrreadingdatefield=$("#mrreadingdate"),
        mrreadingfield=$("#mrreading"),
        mrnarrationfield=$("#mrnarration")
        mrerrors=$("#mrerrors"),
        mrsavebutton=$("#savemr"),
        mrunitid=$("#mrunitid"),
        mrcustomerid=$("#mrcustomerid"),
        mrid=$("#mrid"),
        mrbillclient=$("#mrbillclient"),

        refreshmeterreadings=$("#filtermeterreadings"),
        mrstartdatefield=$("#mrstartdate"),
        mrenddatefield=$("#mrenddate"),
        mrmeternumber=$("#mrmeternumber"),
        mrtable=$("#customermeterreading"),
        mrfiltererrors=$("#mrfiltererrors"),

        refreshstatment=$("#generatestatement"),
        statementstartdatefield=$("#statementstartdate"),
        statementenddatefield=$("#statementenddate"),
        statementerrors=$("#statementerrors"),
        statementtable=$("#customerstatement"),

        ttassignmentfield=$("#ttassignment"),
        ttfaultcategoryfield=$("#ttcategory"),
        ttfaultnamefield=$("#ttfault"),
        faultcategoryfield=$("#ttcategory"),
        filterfaultcategory=$("#ticketcategory"),
        openreceivableslist=$("#openreceivablesdetails"),
        savereceiptbutton=$("#savereceipt"),
        receiptpaymentmodefield=$("#paymentmode"),
        receiptpaymentmodereffield=$("#referenceno"),
        receiptamountfield=$("#amountpaid"),
        receipterrors=$("#receipterrors")

    
    // set all date fields
    $(".datefield").datepicker({ dateFormat: 'dd-M-yy', maxDate: new Date()})
    // get all the customers
    getAllCustomers()
    // get customer types
    getPropertyOwnerTypeAsOptions(customertypedropdown,'choose')
    getPropertyOwnerTypeAsOptions(filtercustomertypedropdwon,'all')
    // get registration document types
    getRegistrationDocumentAsOptions(regdoctype,'choose')
    getRegistrationDocumentAsOptions(filtercustomerregdoctype,'all')
    // get property
    getOwnerPropertiesAsOptions(addpropertydropdown,0,'choose')
    getOwnerPropertiesAsOptions(filterpropertydropdown,0,'all')

    getFaultCategoriesAsOptions(faultcategoryfield,'choose')
    getFaultCategoriesAsOptions(filterfaultcategory,'all')
    // get meter makes
    getMeterMakesAsOptions(filtermetermakedropdown,'all')
    // set unit defaults
    addunitdropdown.html(option)
    filterpropertyunitdropdown.html(option1)
    // set meter model defaults
    filtermetermodeldropdown.html(option1)
    // display logged in user
    setLoggedInUserName()
    // set commission meter by default
     commissionmetercheckfield.prop("checked",true)
    // populate payment method list
    getPaymentMethodsAsOptions(paymentmodefield,"choose")
    // add all the users 
    getAllUsersAsOptions(mrreadbylist,'choose')
    getAllUsersAsOptions(ttassignmentfield,'choose')
    // set default tt faukt values
    ttfaultcategoryfield.html(option)
    ttfaultnamefield.html(option)
    //listen to change event of property when adding customer unit
    addpropertydropdown.on("change",function(){
        var propertyid=addpropertydropdown.val()
        if(propertyid!=""){
            getUnitsAsOption(propertyid,addunitdropdown,'choose')
        }else{
            addunitdropdown.html(option)
        }    
    })

    //listen to change event of property when filtering customers
    filterpropertydropdown.on("change",function(){
        var propertyid=filterpropertydropdown.val()
        if(parseInt(propertyid)>0){
            getUnitsAsOption(propertyid,filterpropertyunitdropdown,'all') 
        }else{
            filterpropertyunitdropdown.html(option1)
        }
    })

    // listen to meter make change event 
    filtermetermakedropdown.on("change",function(){
        makeid=filtermetermakedropdown.val()
        if(parseInt(makeid)>0){
            getMeterModelsAsOptions(makeid,filtermetermodeldropdown,'all')
        }else{
            filtermetermodeldropdown.html(option1)
        }
    })

    //listen to save button click
    savecustomerbutton.on("click",function(){
        // check blank fields
        var customertype=customertypefield.val(),
            customername=customernamefield.val(),
            regdocid=regdoctypefield.val(),
            regdocref=regdocreffield.val(),
            pinnumber=pinnumberfield.val(),
            town=townfield.val(),
            postaladdress=postaladdressfield.val(),
            landline=landlinefield.val(),
            mobile=mobilefield.val(),
            email=emailfield.val(),
            customerid=customeridfield.val(),
            postalcode=postalcodefield.val(),
            data=[],
            errors='',
            TableData
            
        // load all the meters added to the customer
        $('#propertylist tr').each(function(row, tr){
            data.push({
                "propertyid" : $(tr).find('td:eq(1)').attr("data-id"),
                "unitid" :$(tr).find('td:eq(2)').attr("data-id"),
                "meterid" : $(tr).find('td:eq(3)').attr("data-id"),
                "commission":$(tr).find('td:eq(4)').text(),
                "initialreading" : $(tr).find('td:eq(5)').text(),
                "commissioningdate" : $(tr).find('td:eq(6)').text()
            })   
        })
        TableData=JSON.stringify(data)
        if(customertype==""){
            errors="Please select the customer type"
        }else if(customername==""){
            errors="Please enter Customer's Name"
        }else if(regdocid==""){
            errors="Please select Registration Document"
        }else if(regdocref==""){
            errors="Please enter Registration Document Reference"
        }else if(pinnumber==""){
            errors="Please provide the Customer's PIN Number"
        }else if(mobile==""){
            errors="Please provide the customer's Mobile Number"
        }else if(email==""){
            errors="Please provide the customer's Email Address"
        }else if(data.length==0){
            errors="Please attach at least a Unit to the customer"
        }
        if(errors==""){
            // save the customer
            $.post(
                "../controllers/customeroperations.php",
                {
                    savecustomer:true,
                    customerid:customerid,
                    customername:customername,
                    address:postaladdress,
                    town:town,
                    postalcode:postalcode,
                    mobile:mobile,
                    email:email,
                    regdocid:regdocid,
                    regdocref:regdocref,
                    landline:landline,
                    typeid:customertype,
                    landline:landline,
                    pinno:pinnumber,
                    TableData:TableData,

                },
                function(data){
                    data=$.trim(data)
                    if(data=="success"){
                        results="<p class='text-success'><i class='fas fa-check-circle fa-fw fa-lg'></i> Customer details saved successfully</p>"
                        //refresh customers list
                        getAllCustomers()
                    }else{
                        results="<p class='text-danger'><i class='fas fa-times-circle fa-fw fa-lg'></i> "+data+"</p>"
                    }
                    customererrors.html(results)
                }
            )
        }else{
           errors="<p class='text-info'><i class='fas fa-info-circle fa-fw fa-lg'></i>"+errors+"</p>"
           customererrors.html(errors)
        }
    })

    attachunitbutton.on("click",function(){
        // check for blank fields
        propertyid=addpropertydropdown.val()
        unitid=addunitdropdown.val(),
        commissionmeter,
        errors=""
        if(propertyid==""){
            errors="Please select property to attach first"
        }else if(unitid==""){
            errors="Please select unit to attach first"
        }else if(commissionmetercheckfield.prop("checked")){
            commissionmeter=1
            meterid=meteridfield.val()
            metercommissiondate=metercommissiondatefield.val()
            meterinitialreading=meterinitialreadingfield.val()
            if(metercommissiondate==""){
                errors="Please select Meter Commissioning date"
            }else if (meterinitialreading==""){
                errors="Please provide Meter Initial reading"
            }
            //console.log("Meter initial reading: "+meterinitialreading)
        }else{
            commissionmeter=0
            metercommissiondate="01-Jan-1970"
            meterinitialreading=0
        }
        if(errors==""){
            // attach the unit to the customer by adding to the list
            $.getJSON(
                "../controllers/propertyoperations.php",
                {
                    getunitdetails:true,
                    unitid:unitid
                },
                function(data){
                    var results=""
                    if (parseInt(data[0].meterid)==0){
                        var uniterror="<p class='text-danger'><i class='fas fa-exclamation-triangle fa-fw fa-lg'></i></i> Sorry, there is no Meter attached to the Unit yet.</p>"
                        uniterrors.html(uniterror)
                    }else if(parseInt(data[0].currentcustomer)!=0){
                        var uniterror="<p class='text-danger'><i class='fas fa-exclamation-triangle fa-fw fa-lg'></i></i> Sorry, the Unit is attached to another customer.</p>"
                        uniterrors.html(uniterror)
                    }else {
                   
                        // check if the item has been added to the list already
                        if(attachedUnits.includes(data[0].unitid)){
                            errors="<p class='text-danger'><i class='fas fa-exclamation-triangle fa-fw fa-lg'></i>Unit is already attached to the customer</p>"
                            uniterrors.html(errors)
                        }else{
                            // check if unit is attached to another client
                            var rowCount = customerunitstable.find("tr").length
                            results+="<tr><td>"+parseInt(rowCount+1)+"</td>"// add the counter here
                            results+="<td data-id='"+data[0].propertyid+"'>"+data[0].propertyname+"</td>"
                            results+="<td data-id='"+data[0].unitid+"'>"+data[0].unitname+"</td>"
                            results+="<td data-id='"+data[0].meterid+"'>"+data[0].meterno+"</td>"
                            results+="<td>"+commissionmeter+"</td>"
                            results+="<td>"+meterinitialreading+"</td>"
                            results+="<td>"+formatDate(metercommissiondate)+"</td>"
                            // add edit and remove buttons
                            results+="<td><a href='javascript void(0)' class='editunit'><span><i class='fas fa-edit fa-sm'></i></span></a></td>"
                            results+="<td><a href='javascript void(0)' class='deleteunit'><span><i class='fas fa-trash-alt fa-sm'></i></span></a></td></tr>"
                            $(results).appendTo(customerunitstable)
                            // hide modal
                            $(".modal:visible").modal('toggle')
                            attachedUnits.push(data[0].unitid)
                        }
                        
                    }
                }
            )

        }else{
            errors="<p class='text-info'><i class='fas fa-info-circle fa-fw fa-lg'></i>"+errors+"</p>"
            uniterrors.html(errors)
        }
    })

    // listen to on click of commission meter check field
    commissionmetercheckfield.on("click",function(){
        if(commissionmetercheckfield.prop("checked")){
            metercommissiondatefield.prop("disabled",false)
            meterinitialreadingfield.prop("disabled",false)
        }else{
            metercommissiondatefield.prop("disabled",true)
            meterinitialreadingfield.prop("disabled",true)
        }
    })
    
    // get all customers
    function getAllCustomers(){
        $.getJSON(
            "../controllers/customeroperations.php",
            {
                getcustomers:true
            },
            function(data){
                var results=""
                for(var i=0;i<data.length;i++){
                    results+="<option value='"+data[i].customerid+"'>"+data[i].names+"</option>"
                }
                customerslist.html(results)
            }
        )
    }

    // listen to click user list 
    customerslist.on("click",function(){
        customerid=$("#customerslist option:selected").val()
        getCustomerUnits(customerid)
        //populate customer meters
        getCustomerMetersAsOptions(customerid,statementmeternumber,'all')
        getCustomerMetersAsOptions(customerid,mrmeterno,'all')
        getCustomerMetersAsOptions(customerid,mrmeter,'choose')
        getCustomerMetersAsOptions(customerid,ttmeter,'choose')
        // get customer open receivables
        getCustomerOpenReceivables(customerid)
        $.getJSON(
            "../controllers/customeroperations.php",
            {
                getcustomerdetails:true,
                customerid:customerid
            },
            function(data){
                // populate fields
                customeridfield.val(data[0].customerid)
                customertypefield.val(data[0].typeid),
                customernamefield.val(data[0].names),
                regdoctypefield.val(data[0].regdocid),
                regdocreffield.val(data[0].regdocrefno),
                pinnumberfield.val(data[0].pinno),
                townfield.val(data[0].town),
                postaladdressfield.val(data[0].address),
                landlinefield.val(data[0].landline),
                mobilefield.val(data[0].mobile),
                emailfield.val(data[0].email),
                postalcodefield.val(data[0].postalcode)

                // populate the labels on the scrore card
                customeridlabel.html(data[0].customerid)
                customernamelabel.html(data[0].names)
                customeraddresslabel.html(data[0].address+" "+data[0].town+" "+data[0].postalcode)
                customerregdoclabel.html($("#regdoc option:selected" ).text())
                customerregdocreflabel.html(data[0].regdocrefno)
            }
        )
    })

    // get customer attached properties
    function getCustomerUnits(customerid){
        $.getJSON(
            "../controllers/customeroperations.php",
            {
                getcustomerunits:true,
                customerid:customerid
            },
            function(data){
                var results=""
                for(var i=0;i<data.length;i++){
                    var rowCount = customerunitstable.find("tr").length
                    results+="<tr><td>"+parseInt(rowCount+1)+"</td>"// add the counter here
                    results+="<td data-id='"+data[i].propertyid+"'>"+data[i].propertyname+"</td>"
                    results+="<td data-id='"+data[i].unitid+"'>"+data[i].unitname+"</td>"
                    results+="<td data-id='"+data[i].meterid+"'>"+data[i].meterno+"</td>"
                    results+="<td>0</td>"
                    results+="<td>"+data[i].initialreading+"</td>"
                    results+="<td>"+data[i].commissioningdate+"</td>"
                    // add edit and remove buttons
                    results+="<td><a href='javascript void(0)' class='editunit'><span><i class='fas fa-edit fa-sm'></i></span></a></td>"
                    results+="<td><a href='javascript void(0)' class='deleteunit'><span><i class='fas fa-trash-alt fa-sm'></i></span></a></td></tr>"
                    customerunitstable.html(results)    
                }
            }
        )
    }

    // listen to save Meter Reading button
    mrsavebutton.on("click",function(){
        // check for blank field
        var meterid=mrmeter.val(),
            readby=mrreadbylist.val(),
            readdate=mrreadingdatefield.val(),
            reading=mrreadingfield.val(),
            narration=mrnarrationfield.val(),
            unitid=mrunitid.val(),
            customerid=mrcustomerid.val(),
            id=mrid.val(),
            billclient=mrbillclient.val()
            errors=""
        if(meterid==""){
            errors="Please select Meter first"
        }else if(readby==""){
            errors="Please select User who read the Meter first"
        }else if(readdate==""){
            errors="Please select Meter Reading Date first"
        }else if(reading==""){
            errors="Please provide Meter Reading first"
        }
       
        if(errors==""){
            $.post(
                "../controllers/meteroperations.php",
                {
                    savemeterreading:true,
                    id:id,
                    customerid:customerid,
                    meterid:meterid,
                    unitid:unitid,
                    readby:readby,
                    readdate:readdate,
                    meterreading:reading,
                    narration:narration,
                    billclient:billclient
                },
                function(data){
                    data=$.trim(data)
                    if(data=="success"){
                        results="<p class='text-success'><i class='fas fa-check-circle fa-fw fa-lg'></i> Meter Reding saved successfully</p>"
                        //refresh meter reading list
                        //getAllCustomers()
                    }else{
                        results="<p class='text-danger'><i class='fas fa-times-circle fa-fw fa-lg'></i> "+data+"</p>"
                    }
                    mrerrors.html(results)
                }
            )
        }else{
            errors="<p class='text-info'><i class='fas fa-info-circle fa-fw fa-lg'></i>"+errors+"</p>"
            mrerrors.html(errors)
        }
    })

    mrmeter.on("change",function(){
        // get unit id
        if(mrmeter.val()!=""){
            $.getJSON(
                "../controllers/meteroperations.php",
                {
                    getmeters:true,
                    meterid:mrmeter.val(),
                    makeid:0,
                    modelid:0
                },
                function(data){
                    mrunitid.val(data[0].unitid) 
                    mrcustomerid.val(data[0].customerid)
                    //console.log("-"+data[0].accountype+"-")
                    mrbillclient.val(data[0].accounttype==='postpaid'?1:0)  
                }
            )
        }else{
            mrunitid.val("") 
            mrcustomerid.val("")
            mrbillclient.val("")
        } 
    })

    refreshmeterreadings.on("click",function(){
        var startdate=mrstartdatefield.val(),
            enddate=mrenddatefield.val(),
            meterid=mrmeternumber.val(),
            errors="",
            results="",
            unitsconsumed
        if(startdate==""){
            errors="Please provide start date."
        }else if(enddate==""){
            errors="Please provide end date."
        }else if(meterid==""){
            errors="Please select Meter first."
        }
        if(errors==""){
            mrfiltererrors.html("") 
            $.getJSON(
                "../controllers/meteroperations.php",
                {
                    getmeterreadings:true,
                    startdate:startdate,
                    enddate:enddate,
                    meterid:meterid
                },
                function(data){
                    for(var i=0;i<data.length;i++){
                        unitsconsumed=parseFloat(data[0].currentreading)-parseFloat(data[0].previousreading)
                        results+="<tr><td>"+parseInt(i+1)+"</td>"
                        results+="<td>"+data[i].readingdate+"</td>"
                        results+="<td>"+data[i].previousreading+"</td>"
                        results+="<td>"+data[i].currentreading+"</td>"
                        results+="<td>"+unitsconsumed+"</td>"
                        results+="<td>"+data[0].priceperkg+"</td>"
                        results+="<td>"+parseFloat(unitsconsumed*data[0].priceperkg)+"</td>"
                        results+="<td><a href='javascript void(0)' class='printinvoice' data-id='"+data[0].invoiceid+"'><span><i class='fas fa-envelope-open-text fa-fw'></i></span></a></td>"
                        results+="<td><a href='javascript void(0)' class='editinvoice'><span><i class='fas fa-edit fa-fw'></i></span></a></td>"
                        results+="<td><a href='javascript void(0)' class='deleteinvoice'><span><i class='fas fa-trash-alt fa-fw'></i></span></a></td></tr>"
                    }
                    // populate the items on the table and make data table
                   
                    //mrtable.DataTable().destroy() 
                    mrtable.find("tbody").html(results)
                    //mrtable.DataTable().draw()
                }
            )
        }else{
            errors="<p class='text-info'><i class='fas fa-info-circle fa-fw fa-lg'></i>"+errors+"</p>"
            mrfiltererrors.html(errors) 
        }
    })

    refreshstatment.on("click",function(){
        var meterid=statementmeternumber.val(),
            startdate=statementstartdatefield.val(),
            enddate=statementenddatefield.val(),
            errors="",
            results="",
            runningbalance=0,
            unitsconsumed=0,
            invoiceamount=0
        if(startdate==""){
            errors="Please provide start date"
        }else if(enddate==""){
            errors="Please provide end date"
        }else if(meterid==""){
            errors="Please select Meter"
        }
        if(errors==""){
            statementerrors.html("") 
            $.getJSON(
                "../controllers/customeroperations.php",
                {
                    getcustomerstatement:true,
                    meterid:meterid,
                    startdate:startdate,
                    enddate:enddate
                },
                function(data){
                    for(var i=0;i<data.length;i++){
                        unitsconsumed=parseFloat(data[0].currentreading)-parseFloat(data[0].previousreading)
                        invoiceamount=parseFloat(data[i].priceperkg)*unitsconsumed
                        runningbalance+=invoiceamount
                        results+="<tr><td>"+parseInt(i+1)+"</td>"
                        results+="<td>"+data[i].invoicedate+"</td>"
                        results+="<td>"+data[i].invoicenumber+"</td>"
                        results+="<td>Customer monthly bill charged.</td>"
                        results+="<td>"+invoiceamount+"</td>"
                        results+="<td>&nbsp;</td> <!-- Amount receipted will be here -->"
                        results+="<td>"+runningbalance+"</td>"
                        results+="<td><a href='javascript void(0)' class='printinvoice'><span><i class='fas fa-print fa-sm'></i></span></a></td>"
                        results+="<td><a href='javascript void(0)' class='deleteinvoice'><span><i class='fas fa-trash-alt fa-sm'></i></span></a></td></tr>" 
                    }
                    statementtable.find("tbody").html(results)
                }
            )
        }else{
            errors="<p class='text-info'><i class='fas fa-info-circle fa-fw fa-lg'></i>"+errors+"</p>"
            statementerrors.html(errors) 
        }
    })

    // lsisten to email invoice 
    mrtable.on("click",".printinvoice",function(e){
        e.preventDefault();
        var invoiceid=$(this).attr("data-id"),
            results=""
        mrfiltererrors.html("<p class='text-info'><i class='fas fa-shipping-fast fa-fw fa-lg'></i> Processing email. Please Wait ...</p>") 
        $.getJSON(
            "../controllers/generatecustomerinvoice.php",
            {
                getinvoicedetails:true,
                invoiceid:invoiceid,
                printinvoice:0
            },
            function(data){
                data=$.trim(data)
                //console.log("'"+data+"'")
                if(data=="success"){
                    results="<p class='text-success'><i class='fas fa-check-circle fa-fw fa-lg'></i> Invoice emailed successfully</p>"
                }else{
                    results="<p class='text-danger'><i class='fas fa-times-circle fa-fw fa-lg'></i> "+data+"</p>"
                }
                mrfiltererrors.html(results) 
            }
        )
    })  

    function getCustomerOpenReceivables(customerid){
        $.getJSON(
            "../controllers/customeroperations.php",
            {
                getcustomeropenreceivables:true,
                customerid:customerid
            },
            function(data){
                var results=""
                for(var i=0;i<data.length;i++){
                    results+="<tr data-unitid='"+data[i].unitid+"' data-meterid='"+data[i].id+"' data-accounttype='"+data[i].accounttype+"' data-tarrifid='"+data[i].tariffid+"'><td>"+parseInt(i+1)+" </td>"
                    results+="<td>"+data[i].meterno+"</td>"
                    results+="<td>"+data[i].propertyname+"</td>"
                    results+="<td>"+data[i].unitname+"</td>"
                    results+="<td>"+data[i].accounttype+"</td>"
                    results+="<td>"+data[i].amountdue+"</td></tr>"
                }
                openreceivableslist.html(results)
            }
        )
    }

    savereceiptbutton.on("click",function(){
        // check for blank fields
        var customerid=customeridfield.val()//$("#customerslist option:selected").val(),
            paymentmode=receiptpaymentmodefield.val(),
            paymentmoderef=receiptpaymentmodereffield.val(),
            amount=receiptamountfield.val(),
            errors=""
        if(paymentmode==""){
            errors="Please select Payment mode"
        }else if(paymentmoderef==""){
            errors="Please select Payment mode Reference"
        }else if(amount==""){
            errors="Please select the amount paid"
        }
        if(errors==""){
            // post the payment
            var data=[],unitid,meterid,accounttype,tariffid
            openreceivableslist.find("tr").each(function(){
                unitid=$(this).attr("data-unitid")
                meterid=$(this).attr("data-meterid")
                accounttype=$(this).attr("data-accounttype")
                tariffid=$(this).attr("data-tarrifid")
                data.push({unitid:unitid,meterid:meterid,accounttype:accounttype,tariffid:tariffid})
            })
            data=JSON.stringify(data)
            $.post(
                "../controllers/customeroperations.php",
                {
                    savecustomerpayment:true,
                    customerid:customerid,
                    paymentmode:paymentmode,
                    paymentmoderef:paymentmoderef,
                    amount:amount,
                    tableData:data
                },
                function(data){
                    var results=""
                    data=$.trim(data)
                    if(data=="success"){
                        results="<p class='text-success'><i class='fas fa-check-circle fa-fw fa-lg'></i> The payment has been received successfully.</p>"
                    }else{
                        results="<p class='text-danger'><i class='fas fa-times-circle fa-fw fa-lg'></i> "+data+"</p>"
                    }
                    receipterrors.html(results) 
                }
            )
        }else{
            // display errors
            errors="<p class='text-info'><i class='fas fa-info-circle fa-fw fa-lg'></i>"+errors+"</p>"
            receipterrors.html(errors)
        }
    })

    customerunitstable.on("click",".editunit",(e)=>{
        e.preventDefault()
    })

    customerunitstable.on("click",".deleteunit",(e)=>{
        e.preventDefault()
    })
})