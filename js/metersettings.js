$(document).ready(function(){
    var savemake=$("#savemake"),
        makeidfield=$("#makeid"),
        makenamefield=$("#makename"),
        makeerrorsdiv=$("#makeerrors"),
        metermakeslist=$("#metermakeslist"),
        metermodelsmakefilter=$("#modelmakefilter"),
        addmodelnamefield=$("#addmodelmakename"),
        modelnamefield=$("#modelname"),
        modelidfield=$("#modelid"),
        savemodelbutton=$("#savemodel"),
        modelerrors=$("#modelerrors"),
        modelslist=$("#modelslist"),
        metermakefilter=$("#metermakefilter"),
        metermodel=$("#metermodel"),
        meterslist=$("#meterslist"),
        option="<option value='0'>&lt;All&gt;</option>",
        option1="<option value=''>&lt;Choose One&gt;</option>",
        addmetermake=$("#addmetermake"),
        addmetermodel=$("#addmetermodel"),
        meterpaymenttypefield=$("#meterpaymenttype"),
        accountnofield=$("#meteraccountno"),
        serialnofield=$("#meterserialno"),
        meteridfield=$("#meterid"),
        metererrors=$("#metererrors")
        // preload meter model 
        metermodel.html(option)
        addmetermodel.html(option1),
        savemeterbutton=$("#savemeter")
    // show the logged in user
    setLoggedInUserName()
    // get all meter makes
    getMeterMakes()
    // populate filter model makes
    getMeterMakesAsOptions(metermodelsmakefilter,'all').done(function(){
        var makeid=metermodelsmakefilter.val()
        getModels(makeid)
    })

    getMeterMakesAsOptions(addmodelnamefield,'choose')
    getMeterMakesAsOptions(metermakefilter,'all')
    getMeterMakesAsOptions(addmetermake,'choose')
    getTariffsAsOptions(meterpaymenttypefield,"choose")

    savemake.on("click",function(){
        // check if make name is blank
        makename=makenamefield.val()
        makeid=makeidfield.val()
        if(makename==""){
            errors="Please provide the Make Name"
            errors="<p class='text-info'><i class='fas fa-info-circle fa-fw fa-lg'></i>"+errors+"</p>"
            makeerrorsdiv.html(errors)
            makenamefield.focus()
        }else{
            // save the make
            $.post(
                "../controllers/meteroperations.php",
                {
                    savemetermake:true,
                    makeid:makeid,
                    makename:makename
                },
                function(data){
                    data=$.trim(data)
                    if(data=="success"){
                        results="<p class='text-success'><i class='fas fa-check-circle fa-fw fa-lg'></i> Meter Make has been saved successfully</p>"
                        makenamefield.val("")
                        makenamefield.focus()
                        //refresh the list
                        getMeterMakes()
                    }else{
                        results="<p class='text-danger' ><i class='fas fa-times-circle fa-fw fa-lg'></i> "+data+"</p>"
                    }
                    makeerrorsdiv.html(results)
                }
            )
        }
    })   
    
    function getMeterMakes(){ 
        $.getJSON(
            "../controllers/meteroperations.php",
            {
                getmetermakes:true,
                makeid:0
            },
            function(data){
                var results=""
                if(data.length==0){
                    results="<tr class='mt-3'><td colspan='6'><div class='text-info'><i class='fas fa-info-circle fa-lg'></i> There are currently none defined in the system.</div></td></tr>"
                }else{
                    for(var i=0;i<data.length;i++){
                        results+="<tr><td>"+parseInt(i+1)+"</td>"
                        results+="<td>"+data[i].makename+"</td>"
                        results+="<td>"+data[i].models+"</td>"
                        results+="<td>"+data[i].units+"</td>"
                        results+="<td><a href='javascript void(0)' class='editmake' data-id='"+data[i].makeid+"'><span><i class='fas fa-edit fa-sm'></i></span></a></td>"
                        results+="<td><a href='javascript void(0)' class='deletemake' data-id='"+data[i].makeid+"'><span><i class='fas fa-trash-alt fa-sm'></i></span></a></td></tr>"
                    }
                }
                metermakeslist.html(results)
            }
        )
    }

    // listen to save model button
    savemodelbutton.on("click",function(){
        // check for blankfield
        var makeid=addmodelnamefield.val(),
            modelname=modelnamefield.val(),
            modelid=modelidfield.val(),
            errors=""

        if(makeid==""){
            errors="Please select the Model Make"
            addmodelnamefield.focus()
        }else if(modelname==""){
            errors="Please provide Model Name"
            modelnamefield.focus()
        }
        if(errors==""){
            // save model
            $.post(
                "../controllers/meteroperations.php",
                {
                    savemetermodel:true,
                    modelid:modelid,
                    makeid:makeid,
                    modelname:modelname
                },
                function(data){
                    data=$.trim(data)
                    if(data=="success"){
                        results="<p class='text-success'><i class='fas fa-check-circle fa-fw fa-lg'></i> Meter Model has been saved successfully</p>"
                        addmodelnamefield.val("")
                        modelnamefield.val("")
                        modelidfield.val("0")
                        //refresh list
                    }else{
                        results="<p class='text-danger' ><i class='fas fa-times-circle fa-fw fa-lg'></i> "+data+"</p>"
                    }
                    modelerrors.html(results)
                }
            )
        }else{
            // display error messages
            errors="<p class='text-info'><i class='fas fa-info-circle fa-fw fa-lg'></i>"+errors+"</p>"
            modelerrors.html(errors)
        }
    })

    function getModels(makeid){
        $.getJSON(
            "../controllers/meteroperations.php",
            {
                getmetermodels:true,
                makeid:makeid,
                modelid:0
            },
            function(data){
                var results=""
                if(data.length==0){
                    results="<tr class='mt-3'><td colspan='6'><div class='text-info'><i class='fas fa-info-circle fa-lg'></i> There are currently none defined in the system.</div></td></tr>"
                }else{
                    for(var i=0;i<data.length;i++){
                        results+="<tr><td>"+parseInt(i+1)+"</td>"
                        results+="<td>"+data[i].makename+"</td>"
                        results+="<td>"+data[i].modelname+"</td>"
                        results+="<td>"+data[i].units+"</td>"
                        results+="<td><a href='javascript void(0)' class='editmodel' data-id='"+data[i].modelid+"'><span><i class='fas fa-edit fa-sm'></i></span></a></td>"
                        results+="<td><a href='javascript void(0)' class='deletemodel' data-id='"+data[i].modelid+"'><span><i class='fas fa-trash-alt fa-sm'></i></span></a></td></tr>"
                    }
                }
                modelslist.html(results)
            }
        )
    }

    // listen to filter by Make in the models list
    metermakefilter.on("change",function(){
        makeid=metermakefilter.val()
        getMeterModelsAsOptions(makeid,metermodel,'all').done(function(){
            modelid=metermodel.val()
            getMeters(makeid,modelid)
        })
    })

    // get meters 
    function getMeters(makeid,modelid){
        $.getJSON(
            "../controllers/meteroperations.php",
            {
                getmeters:true,
                makeid:makeid,
                modelid:modelid,
                meterid:0
            },
            function(data){
                var results=""
                if(data.length==0){
                    results=  results="<tr class='mt-3'><td colspan='9'><div class='text-info'><i class='fas fa-info-circle fa-lg'></i> There are currently none defined in the system.</div></td></tr>"
                }else{
                    for(var i=0;i<data.length;i++){
                        results+="<tr><td>"+parseInt(i+1)+"</td>"
                        results+="<td>"+data[i].makename+"</td>"
                        results+="<td>"+data[i].modelname+"</td>"
                        results+="<td>"+data[i].serialno+"</td>"
                        results+="<td>"+data[i].meterno+"</td>"
                        results+="<td>"+data[i].propertyname+" - "+data[i].unitname+"</td>"
                        results+="<td><a href='customers.php?customerid="+data[i].customerid+"'>"+data[i].customername+"</a></td>"
                        results+="<td><a href='javascript void(0)' class='editmeter' data-id='"+data[i].meterid+"'><span><i class='fas fa-edit fa-sm'></i></span></a></td>"
                        results+="<td><a href='javascript void(0)' class='deletemeter data-id='"+data[i].meterid+"'><span><i class='fas fa-trash-alt fa-sm'></i></span></a></td></tr>"
                    }
                }
                meterslist.html(results)
            }
        )
    }

    // listen to change event of model drop-down when displaying meters
    metermodel.on("change",function(){
       var makeid=metermakefilter.val(),
            modelid=metermodel.val()
        getMeters(makeid,modelid)
    })

    //listen to click event of Meter Make and get corresponding models
    addmetermake.on("change",function(){
        var makeid=addmetermake.val()
        if(makeid!=""){
            getMeterModelsAsOptions(makeid,addmetermodel,'choose')
        }else{
            addmetermodel.html(option1)
        }
    })

    //listen to click of save meter
    savemeterbutton.on("click",function(){
        // check for blank fields
        var makeid=addmetermake.val(),
            modelid=addmetermodel.val(),
            meterid=meteridfield.val(),
            paymenttype=meterpaymenttypefield.val(),
            serialno=serialnofield.val(),
            accountno=accountnofield.val(),
            errors=''
            if(makeid==""){
                errors="Please provide the Meter Make"
            }else if(modelid==""){
                errors="Please provide the Meter Model"
            }else if(paymenttype==""){
                errors="Please provide Payment Type"
            }else if(serialno==""){
                errors="Please provide Meter Serial Number"
            }else if(accountno==""){
                errors="Please provide Meter Account No"
            }
            if(errors==""){
                $.post(
                    "../controllers/meteroperations.php",
                    {
                        savemeter:true,
                        meterid:meterid,
                        meterno:accountno,
                        serialno:serialno,
                        modelid:modelid,
                        metertype:paymenttype
                    },
                    function(data){
                        data=$.trim(data)
                        if(data=="success"){
                            results="<p class='text-success'><i class='fas fa-check-circle fa-fw fa-lg'></i> The Meter has been saved successfully</p>"
                            // clear fields
                            clearMeterDetails()
                            //refresh list
                            makeid=metermakefilter.val()
                            modelid=metermodel.val()
                            getMeters(makeid,modelid)
                        }else{
                            results="<p class='text-danger' ><i class='fas fa-times-circle fa-fw fa-lg'></i> "+data+"</p>"
                        }
                        metererrors.html(results)
                    }
                )
            }else{
                errors="<p class='text-info'><i class='fas fa-info-circle fa-fw fa-lg'></i>"+errors+"</p>"
                metererrors.html(errors)
            }
    })

    function clearMeterDetails(){
        addmetermake.val("")
        addmetermodel.val("")
        meteridfield.val("")
        meterpaymenttypefield.val("")
        serialnofield.val("")
        accountnofield.val("")
    }
})