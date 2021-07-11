$(document).ready(function(){
    var ownertype=$("#type"),
        savebutton=$("#save"),
        namefield=$("#name"),
        pinnofield=$("#pinno"),
        physicaladdressfield=$("#physicaladdress"),
        postaladdressfield=$("#postaladdress"),
        townfield=$("#town"),
        mobilefield=$("#mobile"),
        emailfield=$("#email"),
        regdocidfield=$("#regdocid"),
        regdocreffield=$("#regdocref"),
        idfield=$("#id"),
        detailserrordiv=$("#detailserrors"),
        ownerslist=$("#propertyownerslist"),
        clearbutton=$("#addnew"),
        propertytypefield=$("#propertytype"),
        propertyidfield=$("#propertyid"),
        propertynamefield=$("#propertyname"),
        propertylocationfield=$("#propertyphysicallocation"),
        propertyblocksfield=$("#propertyblocks"),
        propertyunitsfield=$("#propertyunits"),
        propertycontactpersonfield=$("#propertycontactperson"),
        propertycontactpersonmobilefield=$("#propertycontactpersonmobile"),
        propertycontactpersonemailfield=$("#propertycontactpersonemail"),
        savepropertybutton=$("#saveproperty"),
        propertyerrors=$("#propertyerrors"),
        ownerproperties=$("#ownerproperties"),
        propertydetailsmodal=$("#propertydetails"),
        filterproperytblocksselect=$("#filterpropertyblockselect"),
        addpropertyblockselect=$("#addpropertyblockselect"),
        propertyblockidfield=$("#propertyblockid"),
        propertyblockunitsfield=$("#propertyblockunits"),
        propertyblocknamefield=$("#propertyblockname"),
        savepropertyblockbutton=$("#savepropertyblock"),
        blockerrors=$("#propertyblockerrors"),
        propertyblockslist=$("#propertyblockslist"),
        unitsaddoption=$(".unitsaddoption"),
        singleunitoption=$("#singleunitoptions"),
        multipleunitsoption=$("#multipleunitsoptions"),
        addpropertyunitselect=$("#addpropertyunitselect"),
        addblockunitselect=$("#addblockunitselect"),
        unitpropertyfilter=$("#unitspropertyfilterselect"),
        unitblockfilter=$("#unitsblockfilterselect"),
        serialtypefield=$("#serialtype"),
        unitstoaddfield=$("#unitnos"),
        startnofield=$("#unitnostartat"),
        prefixfield=$("#unitnoprefix"),
        suffixfield=$("#unitnosuffix"),
        generateunitnamesbutton=$("#generateunitnos"),
        uniterrorsdiv=$("#propertyblockuniterrors"),
        padzeros=$("#appendzeros"),
        unitnameslist=$("#unitnames"),
        removeunitlistbutton=$("#removeunitnos"),
        unittypeselect=$("#unittypeselect"),
        saveunitsbutton=$("#saveunit"),
        propertyblockunitslist=$("#propertyblockunitslist"),
        unitname=$("#unitname"),
        ownerpropertiestable=$("#ownerpropertiestable"),
        propertyblockstable=$("#propertyblockstable"),
        propertyunitstable=$("#propertyunitstable"),
        regionfield=$("#region"),
        uniterrors=$("#uniterrors"),
        unitmetermake=$("#unitmetermake"),
        unitmetermodel=$("#unitmetermodel"),
        unitmeterid=$("#unitmeterid"),
        unitmetererrors=$("#unitmetererrors"),
        unitmetersavebutton=$("#saveunitmeter")
        option='<option value="">&lt;Choose One&gt;</option>',
        option1='<option value="0">&lt;All&gt;</option>',
        propertytemplatelist=$("#documentdescription"),
        imageHex="",
        attachedfile=$("#documentfile"),
        uploaddocument=$("#saveattachment"),
        attachmenterror=$("#attachmenterrors"),
        propertyid,
        documentlist=$("#documentlist"),
        adddocument=$("#addattachment"),
        attacheddocumentdetails=$("#attachmentdetails"),
        deletedocumenterror=$("#deletedocumenterror")
    // hide attachment documents by default
    attacheddocumentdetails.hide()
    // initialize datatable
    propertyunitstable.DataTable()
    // initialize unit meter dropdowns
    unitmetermodel.html(option)
    unitmeterid.html(option)
    setLoggedInUserName()
    getPropertyOwnerTypeAsOptions(ownertype,'choose')
    getRegistrationDocumentAsOptions(regdocidfield,'choose')
    getPropertyOwnersAsOption(0,ownerslist)
    getPropertyTypesAsOptions(propertytypefield,'choose',0)
    getUnitTypesAsOptions(unittypeselect,0,'choose')
    // get regions
    getRegionsAsOptions(regionfield,'choose')
    // get meter makes
    getMeterMakesAsOptions(unitmetermake,'choose')
    // show single unit entry fields by default
    singleunitoption.show()
    multipleunitsoption.hide()
    // initialize all property blocks for the show units tab
    unitblockfilter.html("<option value='0'>&lt;All&gt;</option>")
    // populate property document templates
    $.getJSON(
        "../controllers/settingsoperations.php",
        {
            getpropertydocumenttemplates:true
        },
        function(data){
            var results="<option value=''>&lt;Choose One&gt;</option>"
            for(var i=0;i<data.length;i++){
                results+="<option value='"+data[i].id+"'>"+data[i].description+"</option>"
            }
            propertytemplatelist.html(results)
        }
    )
    savebutton.on("click",function(){
        // check for blank fields
        var name=namefield.val(),
            pinno=pinnofield.val(),
            physicaladdress=physicaladdressfield.val(),
            postaladdress=postaladdressfield.val(),
            town=townfield.val(),
            mobile=mobilefield.val(),
            email=emailfield.val(),
            regdocid=regdocidfield.val(),
            regdocref=regdocreffield.val(),
            id=idfield.val(),
            results="",
            errors="",
            type=ownertype.val()
        if(type==""){
            errors="Please provide the property owners Type"
        }else if(name==""){
            errors="Please provide the property owners Name"
        }else if(pinno==""){
            errors="Please provide the property owners PIN #"
        }else if(regdocid==""){
            errors="Please provide the property owners Registration Document"
        }else if(regdocref==""){
            errors="Please provide the property owners Registration Document Reference #"
        }else if(physicaladdress==""){
            errors="Please provide the property owners Physical Address"
        }else if (postaladdress==""){
            errors="Please provide the property owners Postal Address"
        }else if(town==""){
            errors="Please provide the property owners Town"
        }else if(mobile==""){
            errors="Please provide the property owners Mobile"
        }else if(email==""){
            errors="Please provide the property owners Email"
        }
        
        if(errors==""){
            $.post(
                "../controllers/propertyoperations.php",
                {
                    savepropertyowner:true,
                    id:id,
                    name:name,
                    type:type,
                    pinno:pinno,
                    physicaladdress:physicaladdress,
                    postaladdress:postaladdress,
                    town:town,
                    mobile:mobile,
                    email:email,
                    regdocid:regdocid,
                    regdocref:regdocref
                },
                function(data){
                    data=$.trim(data)
                    if(data=="success"){
                        results="<p class='text-success'><i class='fas fa-check-circle fa-fw fa-lg'></i> Property owner has been saved successfully</p>"
                        getPropertyOwnersAsOption(0,ownerslist)
                        clearPropertyOwnerDetails()
                    }else{
                        results="<p class='text-danger' ><i class='fas fa-times-circle fa-fw fa-lg'></i> "+data+"</p>"
                    }
                    detailserrordiv.html(results)
                }
            )
        }else{
            errors="<p class='text-info'><i class='fas fa-info-circle fa-fw fa-lg'></i>"+errors+"</p>"
            //console.log(errors)
            detailserrordiv.html(errors)
        }
    })

    clearbutton.on("click",function(){
        clearPropertyOwnerDetails()
        detailserrordiv.html("")
    })

    function clearPropertyOwnerDetails(){
        namefield.val(""),
        pinnofield.val(""),
        physicaladdressfield.val(""),
        postaladdressfield.val(""),
        townfield.val(""),
        mobilefield.val(""),
        emailfield.val(""),
        regdocidfield.val(""),
        regdocreffield.val(""),
        idfield.val("0"),
        ownertype.val("")
        namefield.focus()
    }

    ownerslist.on("click",function(){
        id=$("#propertyownerslist option:selected").val()
        // get owner details
        $.getJSON(
            "../controllers/propertyoperations.php",
            {
                getpropertyowners:true,
                id:id
            },
            function(data){
                namefield.val(data[0].names),
                pinnofield.val(data[0].pinno),
                physicaladdressfield.val(data[0].physicaladdress),
                postaladdressfield.val(data[0].postaladdress),
                townfield.val(data[0].town),
                mobilefield.val(data[0].mobile),
                emailfield.val(data[0].email),
                regdocidfield.val(data[0].regdocid),
                regdocreffield.val(data[0].regdocreference),
                idfield.val(data[0].ownerid),
                ownertype.val(data[0].ownertypeid)
            }
        )
        // get owner properties
        getOwnerProperties(id)  
        // populate select boxes with owner properties
        getOwnerPropertiesAsOptions(filterproperytblocksselect,id,option='all')
        getOwnerPropertiesAsOptions(addpropertyblockselect,id,option='choose')
        //also do the same for units dropdons
        getOwnerPropertiesAsOptions(addpropertyunitselect,id,option='choose')
        getOwnerPropertiesAsOptions(unitpropertyfilter,id,option='all')
    })

    savepropertybutton.on("click",function(){
        // check for blank fields
        var propertyid=propertyidfield.val(),
            propertyname=propertynamefield.val(),
            propertylocation=propertylocationfield.val(),
            propertyblocks=propertyblocksfield.val(),
            propertyunits=propertyunitsfield.val(),
            propertycontactperson=propertycontactpersonfield.val(),
            propertycontactpersonmobile=propertycontactpersonmobilefield.val(),
            propertycontactpersonemail=propertycontactpersonemailfield.val(),
            propertytype=propertytypefield.val(),
            errors='',
            results='',  
            regionid=regionfield.val()
        if(regionid==""){
            errors="Please select the Region"
        }else if(propertytype==""){
            errors="Please select Property Type"
        }else if(propertyname==""){
            errors="Please provide the Property Name";
        }else if(propertylocation==""){
            errors="Please provide the Property Location"
        }else if(propertyblocks==""){
            errors="Please provide Blocks in the property"
        }else if(propertyunits==""){
            errors="Please provide Units in the property"
        }
        // save the property
        console.log(errors)
        if(errors==""){
            $.post(
                "../controllers/propertyoperations.php",
                {
                    saveproperty:true,
                    ownerid:idfield.val(),
                    propertyid:propertyid,
                    propertytype:propertytype,
                    propertyname:propertyname,
                    propertylocation:propertylocation,
                    propertyblocks:propertyblocks,
                    propertyunits:propertyunits,
                    propertycontactperson:propertycontactperson,
                    propertycontactpersonmobile:propertycontactpersonmobile,
                    propertycontactpersonemail:propertycontactpersonemail,
                    regionid:regionid
                },
                function(data){
                    data=$.trim(data)
                    if(data=="success"){
                        results="<p class='text-success'><i class='fas fa-check-circle fa-fw fa-lg'></i> Property has been saved successfully</p>"
                        // refresh list

                        // clear form for the next entry
                    }else{
                        results="<p class='text-danger' ><i class='fas fa-times-circle fa-fw fa-lg'></i> "+data+"</p>"
                    }
                    propertyerrors.html(results) 
                }
            )
        }else{
            errors="<p class='text-info'><i class='fas fa-info-circle fa-fw fa-lg'></i>"+errors+"</p>"
            propertyerrors.html(errors)
        }
    })

    function getOwnerProperties(ownerid){
        $.getJSON(
            "../controllers/propertyoperations.php",
            {
                ownerid:ownerid,
                getownerproperties:true
            },
            function(data){
                var results=""
                for(var i=0;i<data.length;i++){
                    results+="<tr><td>"+parseFloat(i+1)+"</td>"
                    results+="<td>"+data[i].propertyname+"</td>"
                    results+="<td>"+data[i].propertytype+"</td>"
                    results+="<td>"+data[i].physicallocation+"</td>"
                    results+="<td>"+data[i].blocks+"</td>"
                    results+="<td>"+data[i].units+"</td>"
                    results+="<td><a href='javascript void(0)' class='showpropertylocation' data-id='"+data[i].propertyid+"' data-lon='"+data[i].longitude+"' data-lat='"+data[i].latitude+"' data-propertyname='"+data[i].propertyname+"' data-blocks='"+data[i].blocks+"' data-units='"+data[i].units+"'><span><i class='fas fa-map-marker-alt'></i></span></a></td>"
                    results+="<td><a href='javascript void(0)' class='editpropertydetails' data-id='"+data[i].propertyid+"'><span><i class='fas fa-edit'></i></span></a></td>"
                    results+="<td><a href='javascript void(0)' class='attacheddocument' data-id='"+data[i].propertyid+"'><span><i class='fas fa-paperclip'></i></span></a></td>"
                    results+="<td><a href='javascript void(0)' class='deleteproperty' data-id='"+data[i].propertyid+"'><span><i class='fas fa-trash-alt fa-sm'></i></span></a></td></tr>"  
                }
                ownerpropertiestable.DataTable().destroy()
                ownerproperties.html(results)
                ownerpropertiestable.DataTable().draw()
            }
        )
    }

    // listen to on click 
    ownerproperties.on("click",'.editpropertydetails',function(e){
        e.preventDefault()
        propertyid=$(this).attr("data-id")
        $.getJSON(
            "../controllers/propertyoperations.php",
            {
                getpropertydetails:true,
                id:propertyid
            },
            function(data){
                propertyidfield.val(data[0].propertyid),
                propertynamefield.val(data[0].propertyname),
                propertylocationfield.val(data[0].physicallocation),
                propertyblocksfield.val(data[0].blocks),
                propertyunitsfield.val(data[0].units),
                propertycontactpersonfield.val(data[0].contactperson),
                propertycontactpersonmobilefield.val(data[0].contactpersonmobile),
                propertycontactpersonemailfield.val(data[0].contactpersonemail),
                propertytypefield.val(data[0].typeid)
            }
        )
        propertydetailsmodal.modal('show')
    })

    // listen to save property button click event
    savepropertyblockbutton.on("click",function(){
        // check for blank fields
        var propertyid=addpropertyblockselect.val(),
            blockid=propertyblockidfield.val(),
            units=propertyblockunitsfield.val(),
            blockname=propertyblocknamefield.val(),
            errors=""
        if(propertyid==""){
            errors="Please select property for which to Add the block."
        }else if(blockname==""){
            errors="Please provide the Block name."
        }else if(units==""|| parseFloat(units)==0){
            errors="Please provide the number of Units in the Block."
        }
        if(errors==""){
            $.post(
                "../controllers/propertyoperations.php",
                {
                    savepropertyblock:true,
                    blockid:blockid,
                    propertyid:propertyid,
                    blockname:blockname,
                    blockunits:units
                },
                function(data){
                    data=$.trim(data)
                    if(data=="success"){
                        results="<p class='text-success'><i class='fas fa-check-circle fa-fw fa-lg'></i> Property Block has been saved successfully</p>"
                        // refresh the kist to show the added entry
                        getPropertyBlocks()
                        // reset fields for a new entry
                        propertyblockidfield.val("0")
                        propertyblockunitsfield.val("")
                        propertyblocknamefield.val("")
                        propertyblocknamefield.focus()
                    }else{
                        results="<p class='text-danger'><i class='fas fa-times-circle fa-fw fa-lg'></i> "+data+"</p>"
                    }
                    blockerrors.html(results)
                }
            )
        }else{
            errors="<p class='text-info'><i class='fas fa-info-circle fa-fw fa-lg'></i>"+errors+"</p>"
            blockerrors.html(errors)
        }
    })

    // listen to block filter select box change
    filterproperytblocksselect.on("change",function(){
        getPropertyBlocks(propertyid)
    })

    function getPropertyBlocks(){
        var propertyid=filterproperytblocksselect.val()
        if(propertyid!=""){
            $.getJSON(
                "../controllers/propertyoperations.php",
                {
                    getpropertyblocks:true,
                    propertyid:propertyid,
                    blockid:0
                },
                function(data){
                    var results=""
                    if(data.length<1){
                        results="<tr><td colspan='7'><p class='mt-3 mb-3 alert alert-info' role='alert'><i class='fas fa-info-circle fa-fw fa-lg'></i> Currently no Block(s) defined</p></td></tr>"
                    }else{
                        for(var i=0;i<data.length;i++){
                            results+="<tr><td>"+parseFloat(i+1)+"</td>"
                            results+="<td>"+data[i].propertyname+"</td>"
                            results+="<td>"+data[i].blockname+"</td>"
                            results+="<td>"+data[i].units+"</td>"
                            results+="<td>"+data[i].definedunits+"</td>"
                            results+="<td><a href='javascript void(0)' class='editblockdetails' data-id='"+data[i].blockid+"'><span><i class='fas fa-edit'></i></span></a></td>"
                            results+="<td><a href='javascript void(0)' class='deleteblock' data-id='"+data[i].blockid+"'><span><i class='fas fa-trash-alt fa-sm'></i></span></a></td></tr>"
                        }
                    }
                    propertyblockstable.DataTable().destroy()
                    propertyblockslist.html(results)
                    propertyblockstable.DataTable().draw()
                }
            )
        }
    }

    unitsaddoption.on("change",function(){
        switch($(this).val()){
            case "singleunit":
                singleunitoption.show()
                multipleunitsoption.hide()
                break;
            case "multipleunits":
                singleunitoption.hide()
                multipleunitsoption.show()
                break
        }
    })

    // listen to when a property is selected when adding a new unit
    addpropertyunitselect.on("change",function(){
        propertyid=addpropertyunitselect.val()
        getPropertyBlocksAsOptions(addblockunitselect,propertyid,option='choose')
    })

    // listen to when property is selected when filtering units 
    unitpropertyfilter.on("change",function(){
        propertyid=unitpropertyfilter.val()
        if (parseInt(propertyid==0)){
            blockid=0
            unitblockfilter.html("<option value='0'>&lt;All&gt;</option>")
        }
        
        getPropertyBlocksAsOptions(unitblockfilter,propertyid,option='all').done(function(){
            blockid=unitblockfilter.val()
            getpropertyunits(propertyid,blockid)
        })
        
    })
    
    //listen to change of unit block when filtering
    unitblockfilter.on("change",function(){
        propertyid=unitpropertyfilter.val()
        blockid=unitblockfilter.val()
        getpropertyunits(propertyid,blockid)
    })

    // listen to click event of generate unit names bbutton

    generateunitnamesbutton.on("click",function(){
        // check if required fields are blanks
        var serialtype=serialtypefield.val(),
            startno=startnofield.val(),
            unitstoadd=unitstoaddfield.val(),
            unitname="",
            zerostopad,
            unitnamesstring="",
            errors=""
        if(serialtype==""){
            errors="Please provide the serialization type to be used."
        }else if(startno==""){
            errors="Please provide the start number first."
        }else if (unitstoadd==""|| parseFloat(unitstoadd)==0){
            errors="Please provide the number of units to be added first."
        }
        if(errors==""){

            if(serialtype=="numerical"){
                if(parseInt(startno)==0){
                    errors="<p class='text-info' role='alert'><i class='fas fa-info-circle fa-fw fa-lg'></i> Please provide a valid start value.</p>"
                    uniterrorsdiv.html(errors)
                    startnofield.focus()
                }else{
                    for(i=startno;i<=unitstoadd;i++){
                        if(padzeros.prop("checked")){
                            zerostopad=parseInt(unitstoadd).toString().length-parseInt(i).toString().length
                            unitname=prefixfield.val()+pad(i, zerostopad)+suffixfield.val()
                        }else{
                            unitname=prefixfield.val()+i+suffixfield.val()
                        }
                        unitnamesstring+="<option value='"+unitname+"'>"+unitname+"</option>"
                    }
                    unitnameslist.html(unitnamesstring) 
                    uniterrorsdiv.html("")
                }
            }else{
                // generate alphabetical list 
            }
        }else{
            errors="<p class='text-info' role='alert'><i class='fas fa-info-circle fa-fw fa-lg'></i>"+errors+"</p>"
            uniterrorsdiv.html(errors)
        }
    })

    // listen to remove unitname button 
    removeunitlistbutton.on("click",function(){
        bootbox.dialog({
            title: "Confirm Unit(s) Removal",
            message: "Would you like to Remove selected unit(s)",
            buttons: {
                success: {
                    label: "No, Keep",
                    className: "btn-success",
                    callback: function() {
                        $('.bootbox').modal('hide');
                    }
                },
                danger: {
                    label: "Yes, Remove",
                    className: "btn-danger",
                    callback: function() {
                        $("#unitnames option:selected").each(function(){
                            value=$(this).val()
                            unitnameslist.find('option[value='+value+']').remove()
                        })
                        $('.bootbox').modal('hide');
                    }
                }
            }
        })
    })

    // listen to save unit button
    saveunitsbutton.on("click",function(){
        var errors="",
            data=[]
        // check for blank fields
        blockid=addblockunitselect.val(),
        unittypeid=unittypeselect.val(),
        propertyid=addpropertyunitselect.val(),
        selectedoption=$('input[name=options]:checked').val()
        // add the items to array
        if(selectedoption=="singleunit"){
            if(unitname.val()==""){
                errors="Please provide unit name first."
                unitname.focus()
            }else{
                data.push({unitname:unitname.val()})
            }
        }else{
            $("#unitnames").find("option").each(function(){
                value=$(this).val()
                data.push({unitname:value})
            })
        }

        if(propertyid==""){
            errors="Please select Property first."
        }else if(blockid==""){
            errors="Please select the Block from which to add the Unit"
        }else if(unittypeid==""){
            errors="Please select Unit Type"
        }else if(data.length==0){
            errors="Please provide at least a unit to be added"
        }
        if(errors==""){
            TableData=JSON.stringify(data)
            // save the data
            $.post(
                "../controllers/propertyoperations.php",
                {
                    savemultipleunits:true,
                    TableData:TableData,
                    blockid: blockid,
                    unittype:unittypeid
                },
                function(data){
                    data=$.trim(data)
                    results="<p class='text-success'><i class='fas fa-check-circle fa-fw fa-lg'></i> "+data+"</p>"
                    uniterrorsdiv.html(results)
                    if(selectedoption=="singleunit"){
                        unitname.val("")
                        unitname.focus()
                    }
                }
            )
            // refresh the list 
        }else{
            errors="<p class='text-info'><i class='fas fa-info-circle fa-fw fa-lg'></i>"+errors+"</p>"
            uniterrorsdiv.html(errors)
        }
    })

    // function to generate list of units existing in a property and or block
    function getpropertyunits(propertyid,blockid){
        var results=""
        $.getJSON(
            "../controllers/propertyoperations.php",
            {
                getpropertyunitslist:true,
                propertyid:propertyid,
                blockid:blockid
            },
            function(data){
                for(var i=0;i<data.length;i++){
                    results+="<tr><td>"+parseInt(i+1)+"</td>"
                    results+="<td>"+data[i].propertyname+"</td>"
                    results+="<td>"+data[i].blockname+"</td>"
                    results+="<td>"+data[i].unitname+"</td>"
                    results+="<td>"+data[i].unittype+"</td>"
                    results+="<td>"+data[i].status+"</td>"
                    results+="<td><a href='javascript void(0)' class='addunitmeter' data-id='"+data[i].unitid+"'><span><i class='fas fa-tachometer-alt fa-lg'></i></span></a></td>"
                    results+="<td><a href='javascript void(0)' class='viewunitcustomer' data-id='"+data[i].unitid+"'><span><i class='fas fa-address-card'></i></span></a></td>"
                    results+="<td><a href='javascript void(0)' class='editunit' data-id='"+data[i].unitid+"'><span><i class='fas fa-edit'></i></span></a></td>"
                    results+="<td><a href='javascript void(0)' class='deleteunit' data-id='"+data[i].unitid+"'><span><i class='fas fa-trash-alt'></i></span></a></td></tr>"
                }
                propertyunitstable.DataTable().destroy()
                propertyblockunitslist.html(results)
                propertyunitstable.DataTable().draw()
            }
        )
    }

    // listen to clear unit details button
    function clearForm(){
        addpropertyunitselect.val("")
        addblockunitselect.val("")
        unittypeselect.val("")
        serialtypefield.val("")
        startnofield.val("")
        unitstoaddfield.val("")
        uniterrorsdiv.html("")
    }
    
    // listen to unit meter makes change events
    unitmetermake.on("change",function(){
        makeid=unitmetermake.val()
        if(parseInt(makeid)>0){
            getMeterModelsAsOptions(makeid,unitmetermodel,'choose')
        }else{
            unitmetermodel.html(option)
        }
    })

    // listen to manage meters click
    propertyblockunitslist.on("click",".addunitmeter",function(e){
        e.preventDefault()
        unitid=$(this).attr("data-id")
        //reset all the dropdowns
        resetUnitMeterDetails()
        // display the modal
        $('#unitmeter').modal('show')
    })

    //listen to change event of Model
    unitmetermodel.on("change",function(){
        makeid=unitmetermake.val(),
        modelid=unitmetermodel.val()
        if(parseInt(modelid)>0){
            getMeterNumbersAsOption(makeid,modelid,unitmeterid,"choose")
        }else{
            unitmeterid.html(option) 
        }
    })

    // save unit meter
    unitmetersavebutton.on("click",function(){
        // check for blank fields
        var makeid=unitmetermake.val(),
            modelid=unitmetermodel.val(),
            meterid=unitmeterid.val(),
            errors=""
        if(makeid==""){
            errors="Please select Meter Make first."
        }else if(modelid==""){
            errors="Please select Meter Model first."
        }else if(meterid==""){
            errors="Please select Meter Number first."
        }
        if(errors==""){
            $.post(
                "../controllers/meteroperations.php",
                {
                    saveunitmeter:true,
                    id:0,
                    meterid:meterid,
                    unitid:unitid
                },
                function(data){
                    data=$.trim(data)
                    if(data=="success"){
                        results="<p class='text-success'><i class='fas fa-check-circle fa-fw fa-lg'></i> Meter attached to the Unit successfully</p>"
                        // rest the modal fields
                        resetUnitMeterDetails()
                    }else{
                        results="<p class='text-danger'><i class='fas fa-times-circle fa-fw fa-lg'></i> "+data+"</p>"
                    }
                    unitmetererrors.html(results)
                }
            )
        }else{
            errors="<p class='text-info'><i class='fas fa-info-circle fa-fw fa-lg'></i> "+errors+"</p>"
            unitmetererrors.html(errors)
        }
    })

    function resetUnitMeterDetails(){
        unitmetermake.val("")
        unitmetermodel.val("")
        unitmeterid.val("")
    }

    ownerpropertiestable.on("click",".showpropertylocation",function(e){
        e.preventDefault()
        var latlng=[],
            propertyname=$(this).attr("data-propertyname"),
            blocks=$(this).attr("data-blocks")
            units=$(this).attr("data-units")

        latlng.push($(this).attr("data-lat"),$(this).attr("data-lon"))
            // delete div then re-add
           
        $("#mapdetails").modal('show')
        
        $('#mapdetails').on('shown.bs.modal', function(){
            setTimeout(function() {
                $("#mapid").remove()
                $("#mapdetails").find(".modal-body").html('<div id="mapid" style="width: 470px; height: 400px;"></div>')
                var mymap=L.map('mapid').setView(latlng, 13);
                var marker = L.marker(latlng).addTo(mymap)
                
                var osm= L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 15,
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                })
                
                //  google streets map 
                googleStreets = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
                    maxZoom: 20,
                    subdomains:['mt0','mt1','mt2','mt3']
                })

                // Google hybrid
                googleHybrid = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}',{
                    maxZoom: 20,
                    subdomains:['mt0','mt1','mt2','mt3']
                });

                googleStreets.addTo(mymap)

                mymap.invalidateSize(true)

                marker.bindPopup("<b>"+propertyname+"</b><br>Blocks: "+blocks+"<br>Units: "+units).openPopup()
            }, 500);
        })
    })

    // listen to add attachment click
    ownerproperties.on("click",".attacheddocument",function(e){
        e.preventDefault()
        propertyid=$(this).attr("data-id")
        //reset all the dropdowns
        //resetUnitMeterDetails()
        // display the modal
        getPropertyDocuments(propertyid)
        $('#attacheddocuments').modal('show')
    })

    uploaddocument.on("click",function(e){
        // check for blank fields

        // save the document
        e.preventDefault()
        var fd = new FormData();
        var files = $('#documentfile')[0].files[0],
            id=0,
            templateid=propertytemplatelist.val(),
            errors=""
            //console.log(files)
        if (templateid==""){
            errors="Please select document description first."
        }else if(typeof files === 'undefined'){
            errors="Please select a file to upload first"
        }
        if(errors==""){
            fd.append('id',id)
            fd.append('templateid',templateid)
            fd.append('propertyid',propertyid)
            fd.append('file',files);
            fd.append('savedocument','true');

            attachmenterror.html("<p class='text-info'><i class='fas fa-shipping-fast fa-fw fa-lg'></i> Uploading Document. Please Wait ...</p>")
            $.ajax({
                url:  "../controllers/propertyoperations.php",
                type: 'post',
                data: fd,
                contentType: false,
                processData: false,
                success: function(response){
                    if(response =="success"){
                        results="<p class='text-success'><i class='fas fa-check-circle fa-fw fa-lg'></i> Document uploaded successfully</p>"
                        // refresh the attachments list
                        getPropertyDocuments(propertyid)
                        // rest the modal fields
                        propertytemplatelist.val("")
                        $('#documentfile').val("")
                    } else if(response=="exists"){
                        results="<p class='text-info'><i class='fas fa-info-circle fa-fw fa-lg'></i> Document already uploaded into the system</p>"
                    }else{
                        results="<p class='text-danger'><i class='fas fa-times-circle fa-fw fa-lg'></i> Upload unsuccessful.<br>"+data+"</p>"
                    }
                    attachmenterror.html(results)
                },
            })
        }else{
            errors="<p class='text-info'><i class='fas fa-info-circle fa-fw fa-lg'></i> "+errors+"</p>"
            attachmenterror.html(errors)
        }

    })

    function getPropertyDocuments(propertyid){
        $.getJSON(
            "../controllers/propertyoperations.php",
            {
                getpropertydocuments:true,
                propertyid:propertyid
            },
            function(data){
                var results=""
                for(var i=0;i<data.length;i++){
                    results+="<tr><td>"+parseFloat(i+1)+"</td>"
                    results+="<td>"+data[i].templatename+"</td>"
                    results+="<td><a href='"+data[i].base64+"'  target='_blank' class='downloadattachment' data-id='"+data[i].id+"' data-base64='"+data[i].base64+"'><span><i class='far fa-arrow-alt-circle-down'></i></span></a></td>"
                    results+="<td><a href='javascript void(0)' class='deleteattachment' data-id='"+data[i].id+"'><span><i class='fas fa-trash-alt'></i></span></a></td></tr>"
                }
                documentlist.html(results)
            }
        )
    }
  
    adddocument.on("click",function(){
        // check if it has a class of plus button
        documenticon=adddocument.find("i")
        if(documenticon.hasClass('fa-plus-circle')){
            // show document details
            attacheddocumentdetails.show()
            // remove the 'plus' class
            documenticon.removeClass('fa-plus-circle')
            // add the minus class
            documenticon.addClass('fa-minus-circle')
            //adddocument.text ("Hide Document Details")
        }else{
           // show document details
           attacheddocumentdetails.hide()
           // remove the 'plus' class
           documenticon.removeClass('fa-minus-circle')
           // add the minus class
           documenticon.addClass('fa-plus-circle')  
           //adddocument.text ("Add Document")
        }
    })

    documentlist.on("click",".deleteattachment",function(e){
        e.preventDefault()
        id=$(this).attr("data-id"),
        results=""
        // confirm delete 
        bootbox.dialog({
            title: "Confirm Document Removal",
            message: "Would you like to Remove the selected document",
            buttons: {
                success: {
                    label: "No, Keep",
                    className: "btn-success",
                    callback: function() {
                        $('.bootbox').modal('hide');
                    }
                },
                danger: {
                    label: "Yes, Remove",
                    className: "btn-danger",
                    callback: function() {
                        $.post(
                            "../controllers/propertyoperations.php",
                            {
                                deletepropertydocument:true,
                                id:id
                            },
                            function(data){
                                data=$.trim(data)
                                if(data =="success"){

                                    results="<p class='text-success'><i class='fas fa-check-circle fa-fw fa-lg'></i> Document deleted successfully from the system</p>"
                                    // refresh the attachments list
                                    getPropertyDocuments(propertyid)
                                }else{
                                    results="<p class='text-danger'><i class='fas fa-times-circle fa-fw fa-lg'></i> Upload unsuccessful.<br>"+data+"</p>"
                                } 
                                 // display success message
                                deletedocumenterror.html(results)
                            }
                        )  
                        $('.bootbox').modal('hide');
                    }
                }
            }
        })
    })

    propertyblockunitslist.on("click",".viewunitcustomer",(e)=>{
        e.preventDefault()
    })

    propertyblockunitslist.on("click",".editunit",(e)=>{
        e.preventDefault()
    })

    propertyblockunitslist.on("click",".deleteunit",(e)=>{
        e.preventDefault()
    })

    propertyblockslist.on("click",".editblockdetails",(e)=>{
        e.preventDefault()
    })

    propertyblockslist.on("click",".deleteblock",(e)=>{
        e.preventDefault()
    })
})