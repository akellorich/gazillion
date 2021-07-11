$(document).ready(function(){
    var uomlist=$("#unitofmeasure"),
        errordiv=$("#errors"),
        registrationlist=$("#regcert"),
        propertytypelist=$("#propertytype"),
        propertyownertypelist=$("#propertyownertype"),
        unittypelist=$("#unittypeslist")
    setLoggedInUserName()
    getUnitOfMeasure(uomlist)
    getRegistrationDocuments(registrationlist)
    getPropertyTypes(propertytypelist)
    getPropertyOwnersTypes(propertyownertypelist)
    getUnitTypes(unittypelist)
    //listen to any link clicked
    $(".settingslink").on("click",function(e){
        e.preventDefault()
        var id=$(this).attr("data-id")
        switch(id){
            case "adduom":
                var id=0
                // display add a new uom bootbox
                bootbox.prompt({
                    title: "Please enter Unit of Measure",
                    inputType: 'text',
                    size: 'small',
                    callback: function (result) {
                        //console.log(result);
                        if(result==""){
                            errordiv.html("<span class='text-info'><i class='fas fa-exclamation-triangle fa-lg'></i> Please provide unit of measure name</span>")
                        }else{
                            // save
                            $.post(
                                "../controllers/settingsoperations.php",
                                {
                                    saveuom:true,
                                    id:id,
                                    name:result
                                },
                                function(data){
                                    var results=""
                                    data=$.trim(data)
                                    if(data=="success"){
                                        // repopulate list
                                        results="<span class='text-success'><i class='far fa-check-circle fa-lg'></i> The unit of measure saved sucessfully.</span>"
                                        //display success mesage
                                        getUnitOfMeasure(uomlist)
                                    }else{
                                        results="<span class='text-danger'><i class='fas fa-exclamation-triangle fa-lg'></i> "+data+"</span>"
                                    }
                                    errordiv.html(results)
                                }
                            )
                        }
                    }
                });
                break;
            case "deleteuom":
                var itemname=$("#unitofmeasure option:selected").text(),
                    id=$("#unitofmeasure option:selected").val(),
                    message="Proceed with removal of <strong>"+itemname+"</strong> from the system."

                bootbox.dialog({
                    title: "Delete Unit of Measure",
                    message: message,
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
                                // delete from the system
                                $.post(
                                    "../controllers/settingsoperations.php",
                                    {
                                        deleteuom:true,
                                        id: id
                                    },
                                    function(data){
                                        data=$.trim(data)
                                        if(data=="success"){
                                            results="<span class='text-success'><i class='far fa-check-circle fa-lg'></i> <strong>"+itemname +"</strong> delete successfully from the system.</span>"
                                            //Refresh the list
                                            getUnitOfMeasure(uomlist)
                                        }else{
                                            results="<span class='text-danger'><i class='fas fa-exclamation-triangle fa-lg'></i> "+data+"</span>"
                                        }
                                        errordiv.html(results)
                                    }
                                )
                                $('.bootbox').modal('hide');
                            }
                        }
                    }
                })
                break;
            case "addregdoc":
                var id=0
                // display add a new uom bootbox
                bootbox.prompt({
                    title: "Please enter Registration Document",
                    inputType: 'text',
                    callback: function (result) {
                        //console.log(result);
                        if(result==""){
                            errordiv.html("<span class='text-info'><i class='fas fa-exclamation-triangle fa-lg'></i> Please provide Registration Doc</span>")
                        }else{
                            // save
                            $.post(
                                "../controllers/settingsoperations.php",
                                {
                                    saveregdoc:true,
                                    id:id,
                                    name:result
                                },
                                function(data){
                                    var results=""
                                    data=$.trim(data)
                                    if(data=="success"){
                                        // repopulate list
                                        results="<span class='text-success'><i class='far fa-check-circle fa-lg'></i> The registration document saved sucessfully.</span>"
                                        //display success mesage
                                        getRegistrationDocuments(registrationlist)
                                    }else{
                                        results="<span class='text-danger'><i class='fas fa-exclamation-triangle fa-lg'></i> "+data+"</span>"
                                    }
                                    errordiv.html(results)
                                }
                            )
                        }
                    }
                });
                break;
            case "deleteregdoc":
                var itemname=$("#regcert option:selected").text(),
                id=$("#regcert option:selected").val(),
                message="Proceed with removal of <strong>"+itemname+"</strong> from the system."

                bootbox.dialog({
                    title: "Delete Registration Document",
                    message: message,
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
                                // delete from the system
                                $.post(
                                    "../controllers/settingsoperations.php",
                                    {
                                        deleteregdoc:true,
                                        id: id
                                    },
                                    function(data){
                                        data=$.trim(data)
                                        if(data=="success"){
                                            results="<span class='text-success'><i class='far fa-check-circle fa-lg'></i> <strong>"+itemname +"</strong> delete successfully from the system.</span>"
                                            //Refresh the list
                                            getRegistrationDocuments(registrationlist)
                                        }else{
                                            results="<span class='text-danger'><i class='fas fa-exclamation-triangle fa-lg'></i> "+data+"</span>"
                                        }
                                        errordiv.html(results)
                                    }
                                )
                                $('.bootbox').modal('hide');
                            }
                        }
                    }
                })
                break;
            // add and delete property types
            case "addpropertytype":
                var id=0
                // display add a new uom bootbox
                bootbox.prompt({
                    title: "Please enter property type",
                    inputType: 'text',
                    callback: function (result) {
                        //console.log(result);
                        if(result==""){
                            errordiv.html("<span class='text-info'><i class='fas fa-exclamation-triangle fa-lg'></i> Please provide property type</span>")
                        }else{
                            // save
                            $.post(
                                "../controllers/propertyoperations.php",
                                {
                                    savepropertytype:true,
                                    id:id,
                                    name:result
                                },
                                function(data){
                                    var results=""
                                    data=$.trim(data)
                                    if(data=="success"){
                                        // repopulate list
                                        results="<span class='text-success'><i class='far fa-check-circle fa-lg'></i> The property type was saved sucessfully.</span>"
                                        //display success mesage
                                        getPropertyTypes(propertytypelist)
                                    }else{
                                        results="<span class='text-danger'><i class='fas fa-exclamation-triangle fa-lg'></i> "+data+"</span>"
                                    }
                                    errordiv.html(results)
                                }
                            )
                        }
                    }
                });
                break;
            case "deletepropertytype":
                var itemname=$("#propertytype option:selected").text(),
                    id=$("#propertytype option:selected").val(),
                    message="Proceed with removal of <strong>"+itemname+"</strong> from the system."

                bootbox.dialog({
                    title: "Delete Property Type",
                    message: message,
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
                                // delete from the system
                                $.post(
                                    "../controllers/propertyoperations.php",
                                    {
                                        deletepropertytype:true,
                                        id: id
                                    },
                                    function(data){
                                        data=$.trim(data)
                                        if(data=="success"){
                                            results="<span class='text-success'><i class='far fa-check-circle fa-lg'></i> <strong>"+itemname +"</strong> delete successfully from the system.</span>"
                                            //Refresh the list
                                            getPropertyTypes(propertytypelist)
                                        }else{
                                            results="<span class='text-danger'><i class='fas fa-exclamation-triangle fa-lg'></i> "+data+"</span>"
                                        }
                                        errordiv.html(results)
                                    }
                                )
                                $('.bootbox').modal('hide');
                            }
                        }
                    }
                })
                break;
            // listen to add and delete property owner types
            case "addpropertyownertype":
                var id=0
                // display add a new uom bootbox
                bootbox.prompt({
                    title: "Please enter property owner type",
                    inputType: 'text',
                    callback: function (result) {
                        //console.log(result);
                        if(result==""){
                            errordiv.html("<span class='text-info'><i class='fas fa-exclamation-triangle fa-lg'></i> Please provide property owner type</span>")
                        }else{
                            // save
                            $.post(
                                "../controllers/propertyoperations.php",
                                {
                                    savepropertyownertype:true,
                                    id:id,
                                    name:result
                                },
                                function(data){
                                    var results=""
                                    data=$.trim(data)
                                    if(data=="success"){
                                        // repopulate list
                                        results="<span class='text-success'><i class='far fa-check-circle fa-lg'></i> The property owner type was saved sucessfully.</span>"
                                        //display success mesage
                                        getPropertyOwnersTypes(propertyownertypelist)
                                    }else{
                                        results="<span class='text-danger'><i class='fas fa-exclamation-triangle fa-lg'></i> "+data+"</span>"
                                    }
                                    errordiv.html(results)
                                }
                            )
                        }
                    }
                });
                break;
            case "deletepropertyownertype":
                var itemname=$("#propertyownertype option:selected").text(),
                    id=$("#propertyownertype option:selected").val(),
                    message="Proceed with removal of <strong>"+itemname+"</strong> from the system."

                bootbox.dialog({
                    title: "Delete Property Owner Type",
                    message: message,
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
                                // delete from the system
                                $.post(
                                    "../controllers/propertyoperations.php",
                                    {
                                        deletepropertyownertype:true,
                                        id: id
                                    },
                                    function(data){
                                        data=$.trim(data)
                                        if(data=="success"){
                                            results="<span class='text-success'><i class='far fa-check-circle fa-lg'></i> <strong>"+itemname +"</strong> delete successfully from the system.</span>"
                                            //Refresh the list
                                            getPropertyOwnersTypes(propertyownertypelist)
                                        }else{
                                            results="<span class='text-danger'><i class='fas fa-exclamation-triangle fa-lg'></i> "+data+"</span>"
                                        }
                                        errordiv.html(results)
                                    }
                                )
                                $('.bootbox').modal('hide');
                            }
                        }
                    }
                })
                break;
            // listen to add unit type
            case "addunittype":
                var id=0
                // display add a new uom bootbox
                bootbox.prompt({
                    title: "Please enter Unit Type",
                    inputType: 'text',
                    size: 'small',
                    callback: function (result) {
                        //console.log(result);
                        if(result==""){
                            errordiv.html("<span class='text-info'><i class='fas fa-exclamation-triangle fa-lg'></i> Please provide unit of measure name</span>")
                        }else{
                            // save
                            $.post(
                                "../controllers/settingsoperations.php",
                                {
                                    saveunittype:true,
                                    id:id,
                                    name:result
                                },
                                function(data){
                                    var results=""
                                    data=$.trim(data)
                                    if(data=="success"){
                                        // repopulate list
                                        results="<span class='text-success'><i class='far fa-check-circle fa-lg'></i> The unit of measure saved sucessfully.</span>"
                                        //display success mesage
                                        getUnitTypes(unittypelist)
                                    }else{
                                        results="<span class='text-danger'><i class='fas fa-exclamation-triangle fa-lg'></i> "+data+"</span>"
                                    }
                                    errordiv.html(results)
                                }
                            )
                        }
                    }
                });
                break;
            // listen to delete unit type
            case "deleteunittype":
                var itemname=$("#unittypeslist option:selected").text(),
                    id=$("#unittypeslist option:selected").val(),
                    message="Proceed with removal of <strong>"+itemname+"</strong> from the system."

                bootbox.dialog({
                    title: "Delete Unit Type",
                    message: message,
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
                                // delete from the system
                                $.post(
                                    "../controllers/settingsoperations.php",
                                    {
                                        deleteunittype:true,
                                        id: id
                                    },
                                    function(data){
                                        data=$.trim(data)
                                        if(data=="success"){
                                            results="<span class='text-success'><i class='far fa-check-circle fa-lg'></i> <strong>"+itemname +"</strong> delete successfully from the system.</span>"
                                            //Refresh the list
                                            getUnitTypes(unittypelist)
                                        }else{
                                            results="<span class='text-danger'><i class='fas fa-exclamation-triangle fa-lg'></i> "+data+"</span>"
                                        }
                                        errordiv.html(results)
                                    }
                                )
                                $('.bootbox').modal('hide');
                            }
                        }
                    }
                })
                break;
        }
    })

})