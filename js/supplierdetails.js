$(document).ready(function(){
    var  idfield=$("#id"),
    suppliernamefield=$("#suppliername"),
    physicaladdressfield=$("#physicaladdress"),
    postaladdressfield=$("#postaladdress"),
    emailfield=$("#email"),
    mobilefield=$("#mobile"),
    creditlimitfield=$("#creditlimit"),
    savebutton=$("#savesupplier"),
    errordiv=$("#errors"), 
    gotolist=$("#goback"),
    errors="",
    categorylist=$("#productcategory"),
    productslist=$("#productname"),
    saveproducts=$("#supplierproductsform"),
    errordiv1=$("#errorsproduct"),
    supplieridfield=$("#supplierid"),
    supplierproducts=$("#supplierproducts"),
    supplierproductslist=$("#productslist"),
    errordiv2=$("#errorproductlist"),
    addinvoicebutton=$("#addinvoice"),
    startdatefield=$("#startdate"),
    enddatefield=$("#enddate"),
    alldates=$("#alldates"),
    filterbutton=$("#filterbutton"),
    statusfield=$("#status"),
    invoicelist=$("#supplierinvoices"),
    errorinvoices=$("#errorinvoices"),
    supplierstatement=$("#supplierstatement"),
    supplieraging=$("#supplieraging"),
    statementerrors=$("#statementerrors")

    alldates.prop("checked",true)
    startdatefield.datepicker()
    enddatefield.datepicker()

    statementstartdate=$("#statementstartdate")
    statementenddate=$("#statementenddate")
    statementstartdate.datepicker({dateFormat: 'dd-M-yy', maxDate: new Date()})
    statementenddate.datepicker({dateFormat: 'dd-M-yy', maxDate: new Date()})

    generatestatement=$("#generatestatement")

    startdatefield.prop("disabled",true)
    enddatefield.prop("disabled",true)
    setLoggedInUserName()
    
    alldates.on("click",function(){
        if(alldates.prop("checked")){
            startdatefield.prop("disabled",true)
            enddatefield.prop("disabled",true)
        }else{
            startdatefield.prop("disabled",false)
            enddatefield.prop("disabled",false)
        }
    })

    // filter supplier statement
    generatestatement.on("click",function(){
        console.log("clicked")
        var errors="", results=""
        if(statementstartdate.val()==""){
            errors="<p class='alert alert-danger'>Please select start date</p>"
        }else if(statementenddate.val()==""){
            errors="<p class='alert alert-danger'>Please select end date</p>"
        }else{
            startdate=statementstartdate.val()
            enddate=statementenddate.val()
        }
        if(errors==""){
            var results=""
            // get supplier statement
            $.getJSON(
                "../controllers/reportoperations.php",
                {
                    getsupplierstatement:true,
                    startdate:startdate,
                    enddate:enddate,
                    supplierid:idfield.val()

                },
                function(data){
                    var closingbalance=parseFloat(data[0].openingbalance)+parseFloat(data[0].invoices)-parseFloat(data[0].payments),
                        runningbalance=parseFloat(data[0].openingbalance)

                    results+="<table class='table table-sm'><tr><td>Account #: <span class='font-weight-bold'> "+data[0].supplierid+"</span></td>"
                    results+="<td class='text-right'>Opening Balance: <span class='font-weight-bold'> "+$.number(data[0].openingbalance,2)+"</span></td></tr>"
                    results+="<tr><td>Name: <span class='font-weight-bold'> "+data[0].suppliername+"</span></td>"
                    results+="<td class='text-right'>Invoices: <span class='font-weight-bold'> "+$.number(data[0].invoices,2)+"</span></td></tr>"
                    results+="<tr><td>Address: <span class='font-weight-bold'> "+data[0].physicaladdress+" - "+data[0].postaladdress+"</span></td>"
                    results+="<td class='text-right'>Payments: <span class='font-weight-bold'> "+$.number(data[0].payments,2)+"</span></td></tr>"
                    results+="<tr><td>Mobile: <span class='font-weight-bold'> "+data[0].mobile+"</span> Email: <span class='font-weight-bold'>"+data[0].email+"</span></td>"
                    results+="<td class='text-right'>Closing Balance: <span class='font-weight-bold'> "+$.number(closingbalance,2)+"</span></td></tr></table>"

                    results+="<table class='table table-sm table-striped'><thead><th>Date</th><th>Reference</th><th>Narrative</th><th class='text-right'>Invoice</th><th class='text-right'>Payment</th><th class='text-right'>Balance</th></thead><tbody>"
                    for(var i=0;i<data.length;i++){
                        runningbalance+=parseFloat(data[i].invoiceamount)-parseFloat(data[i].invoicepayment)
                        results+="<tr><td>"+data[i].date+"</td>"
                        results+="<td>"+data[i].reference+"</td>"
                        results+="<td>"+data[i].narrative+"</td>"
                        results+="<td class='text-right'>"+$.number(data[i].invoiceamount,2)+"</td>"
                        results+="<td class='text-right'>"+$.number(data[i].invoicepayment,2)+"</td>"
                        results+="<td class='text-right'>"+$.number(runningbalance,2)+"</td></tr>"
                    }
                    supplierstatement.html(results)
                }
            )

            // get supplier aging analysis
            $.getJSON(
                "../controllers/reportoperations.php",
                {
                    getsupplieraginganalysis:true,
                    basedate:enddate,
                    supplierid:idfield.val()
                },
                function(data){
                    results="<p class='alert alert-secondary font-weight-bold'>Aging Analysis</p>"
                    results+="<table class='table table-sm'><thead><th class='text-right'>Current</th><th class='text-right'>31-60</th><th class='text-right'>61-90</th><th class='text-right'>91-120</th><th class='text-right'>120+</th><th class='text-right'>TOTAL</th></thead><tbody>"
                    results+="<tr><td class='text-right'>"+$.number(data[0].thirty,2)+"</td>"
                    results+="<td class='text-right'>"+$.number(data[0].sixty,2)+"</td>"
                    results+="<td class='text-right'>"+$.number(data[0].ninety,2)+"</td>"
                    results+="<td class='text-right'>"+$.number(data[0].onetwenty,2)+"</td>"
                    results+="<td class='text-right'>"+$.number(data[0].aboveonetwenty,2)+"</td>"
                    results+="<td class='text-right'>"+$.number(data[0].total,2)+"</td></tr></tbody></table>"
                    supplieraging.html(results)
                } 
            )
            statementerrors.html("")
        }else{
            statementerrors.html(errors)
        }
    })
    // get all product categories
    getProductCategories(categorylist, "all").done(function(){
        getFilterProducts().done(function(){
            // apply bootstrap select plugin format
            productslist.multiselect({
                nonSelectText: 'Please Select Product',
                includeSelectAllOption: true,
                //enableFiltering: true,
                //enableCaseInsensitiveFiltering: true,
                filterPlaceholder: 'Search for product...',
                buttonWidth:'470px'
            })
        })
    })
    
    // get existing supplier products
    getSupplierProducts()
    // listen to save button click event
    savebutton.on("click",function(){
        // check for blank fields

        var id=idfield.val(),
            suppliername=suppliernamefield.val(),
            physicaladdress=physicaladdressfield.val(),
            postaladdress=postaladdressfield.val(),
            email=emailfield.val(),
            mobile=mobilefield.val(),
            creditlimit=creditlimitfield.val(),
            errors="<ul>Please provide the following:"
        if(suppliername==""){
            errors+="<li>Supplier name</li>"
        }  
        if(physicaladdress==""){
            errors+="<li>Physical address</li>"
        }
        if(email==""){
            errors+="<li>Email address</li>"
        }
        if(mobile==""){
            errors+="<li>Mobile number</li>"
        }
        if(creditlimit==""){
            errors+="<li>Credit limit</li>"
        }

        errors+="</ul>"
        // save the supplier
        if(errors=="<ul>Please provide the following:</ul>"){
            $.post(
                "../controllers/savesupplier.php",
                {
                    savesupplier:"POST",
                    id:id,
                    suppliername:suppliername,
                    physicaladdress:physicaladdress,
                    postaladdress:postaladdress,
                    mobile:mobile,
                    email:email,
                    creditlimit:creditlimit
                },
                function(data){
                    errordiv.html("")
                    if($.trim(data.toString()=="The supplier has been saved successfully.")){
                        errors="<div class='alert alert-success'>"+data.toString()+"<button type='button' class='close' data-dismiss='alert'>&times;</div"
                    }else{
                        errors="<div class='alert alert-danger'>"+data.toString()+"<button type='button' class='close' data-dismiss='alert'>&times;</div"
                    }

                   errordiv.html(errors)
                }
            )
        }else{
            errordiv.html("")
            $(errors).appendTo(errordiv)
        }

        // refresh the list
    })

    gotolist.on("click",function(){
        //console.log("clicked")
        window.location.href="supplierlist.php"
    })

    // Check if we are in edit mode
    if(idfield.val()>0){
        // get the supplier's details
        $.getJSON(
            "../controllers/supplieroperations.php",
            {
                getsupplierdetails:true,
                supplierid:idfield.val()
            },
            function(data){
                suppliernamefield.val( data.suppliername),
                physicaladdressfield.val( data.physicaladdress)
                postaladdressfield.val(data.postaladdress)
                emailfield.val( data.email)
                mobilefield.val(data.mobile)
                creditlimitfield.val( data.creditlimit)
            }
        )
    }
    // filter product by category
    categorylist.on("click",function(){
        $("#productname option:selected").each(function(){
            $(this).prop("selected",false)
        })
        getFilterProducts().done(function(){
            $('#productname').multiselect('rebuild')
            $('#productname').multiselect('refresh')   
        })
    })

    function getFilterProducts(){
        var deferred=new $.Deferred()
        $.getJSON(
            "../controllers/productoperations.php",
            {   
                getproductbycategory:true,
                categoryid:categorylist.val()
            },
            function(data){
                var results=""
                for(var i=0;i<data.length;i++){
                    results+="<option value='"+data[i].productid+"'>"+data[i].itemname+"</option>"
                }
                productslist.html(results)
                deferred.resolve()
            }
        )
        return deferred.promise()
    }

    saveproducts.on("submit",function(e){
        e.preventDefault()
        //console.log("submitting")
        var form_data=$(this).serialize()
        supplierid=supplieridfield.val()
        if(supplierid==0){
            errors="<p class='alert alert-danger'>Please save the supplier first.</p>"
            errordiv1.html(errors)
        }else{
            if(productslist.val()==""){
                errors="<p class='alert alert-info'>Please select a product</p>"
                errordiv1.html(errors)
            }else{
                errors="<p class='alert alert-info'>Processing ...</p>"
                errordiv1.html(errors)
                $.ajax({
                    url:"../controllers/productoperations.php",
                    method:"POST",
                    data:form_data,
                    success: function(data){
                        var results=$.trim(data.toString())
                        // console.log(results.length)
                        if(results=="success"){
                            errors="<p class='alert alert-success'>Supplier's product(s) saved successfully</p>"
                            // reset fields
                            $("#productname option:selected").each(function(){
                                $(this).prop("selected",false)
                            })
                            // refresh list
                            $('#productname').multiselect('refresh')   
                            getSupplierProducts()

                        }else{
                            errors="<p class='alert alert-danger'>"+results+"</p>"
                        }
                        errordiv1.html(errors)
                    }
                })  
            }
        }
    })

    function getSupplierProducts(){
        var supplierid=supplieridfield.val()
        errordiv2.html("")
        $.getJSON(
            "../controllers/productoperations.php",
            {
                getsupplierproducts:true,
                supplierid:supplierid
            },
            function(data){
                var results=""
                for(var i=0;i<data.length;i++){
                    results+="<tr><td>"+parseInt(i+1)+"</td>"
                    results+="<td>"+data[i].itemcode+"</td>"
                    results+="<td>"+data[i].itemname+"</td>"
                    results+="<td>"+data[i].dateadded+"</td>"
                    results+="<td>"+data[i].addedbyuser+"</td>"
                    results+="<td><a href='javascript void(0)' class='delete' data-id="+data[i].id+"><span><i class='fas fa-trash-alt fa-sm'></span></i></a></td>" 
                    results+="</tr>"
                }
                supplierproductslist.html(results)
                supplierproducts.DataTable()
            }
        )
    }

    // listen to delete icon clicked event
    // listen to delete button
    supplierproductslist.on("click",".delete",function(e){
        errordiv2.html("")
        e.preventDefault();
        var id = $(this).attr('data-id');
        var parent = $(this).parent("td").parent("tr");
        var itemname=parent.find("td").eq(2).text()
        bootbox.dialog({
           // title: "Confirm Item Removal!",
            message: "Are you sure you want to DELETE <strong>"+itemname+"</strong>?",
            buttons: {
                success: {
                    label: "No, Keep",
                    className: "btn-success",
                    callback: function() {
                        // parent.remove()
                        $('.bootbox').modal('hide');
                    }
                },
                danger: {
                    label: "Yes, Remove",
                    className: "btn-danger",
                    callback: function() {
                        //console.log(parent)
                        $.post(
                            "../controllers/productoperations.php",
                            {
                                deletesupplierproduct:true,
                                id:id
                            },
                            function(data){
                                if($.trim(data.toString())=="The product has been deleted successfully."){
                                    errors="<p class='alert alert-success'>"+data.toString()+"</p>"
                                    parent.remove()
                                }else{
                                    errors="<p class='alert alert-danger'>"+data.toString()+"</p>"
                                }
                                errordiv2.html(errors)
                            }
                        )
                        $('.bootbox').modal('hide');
                    }
                }
            }
        })
    })

    addinvoicebutton.on("click",function(){
        //console.log("Add Invoice clicked!")
        window.location.href="invoicedetails.php"
    })

    filterbutton.on("click",function(){
        supplierid=idfield.val()
        status=statusfield.val()
        if(alldates.prop("checked")){
            startdate='01-Jan-2019'
            enddate='31-Dec-2100'
        }else{
           if(startdatefield.val()==""){
               errors="<p class='alert alert-danger'>Please select start date</p>"
           }else{
               startdate=startdatefield.val()
           }
           if(enddatefield.val()==""){
               errors="<p class='alert alert-danger'>Please select end date</p>"
           }else{
               enddate=enddatefield.val()
           }
        }
        if(errors==""){
            errorinvoices.html("")
            $.getJSON(
                "../controllers/supplieroperations.php",
                {
                    getsupplierinvoices:true,
                    startdate:startdate,
                    enddate:enddate,
                    status:status,
                    supplierid:supplierid
                },
                function(data){
                    var results=""
                    for(var i=0;i<data.length;i++){
                        results+="<tr><td>"+parseInt(i+1)+"</td>"
                        results+="<td>"+data[i].invoiceno+"</td>"
                        results+="<td>"+data[i].invoicedate+"</td>"
                        results+="<td>"+data[i].invoiceamount+"</td>"
                        results+="<td>"+data[i].amountpaid+"</td>"
                        results+="<td>"+parseFloat(data[i].invoiceamount-data[i].amountpaid)+"</td>"
                        results+="<td>"+data[i].status+"</td>"
                        results+="<td><a href='javascript void(0)' class='deletedata' data-id='"+randomId()+"'><span><i class='fas fa-trash-alt fa-sm'></i></span></a></td></tr>"
                    }
                    invoicelist.find("tbody").html(results)
                }
            )
        }else{
            errorinvoices.html(errors)
        }
    })
})