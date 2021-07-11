$(document).ready(function(){
    var tarifferrors=$("#tarifferrors"),
    tarifftypefield=$("#addtarifftype"),
    tariffnamefield=$("#addtariffname"),
    savetariffbutton=$("#savetariff"),
    tariffidfield=$("#id"),
    tariffslist=$("#tariffslist"),
    tariffdisplayname=$("#tariffname"),
    tariffdisplaycategory=$("#tarifftype"),
    addtariffrangebutton=$("#addtariffrange"),
    minvaluefield=$("#minvalue"),
    maxvaluefield=$("#maxvalue"),
    priceperkgfield=$("#priceperkg"),
    rangeerrors=$("#rangeerrors"),
    rangetable=$("#rangetable"),
    deletetariffbutton=$("#deletetariff")
    // get existing tariffs
    getTariffs()
    setLoggedInUserName()
    // listen to save tariff button on click
    savetariffbutton.on("click",function(){
        var category=tarifftypefield.val(),
            tariffname=tariffnamefield.val(),
            id=tariffidfield.val()
            errors="",
            results=""
        if(category==""){
            errors="Please select the Tariff Type first."
        }else if(tariffname==""){
            errors="Please provide Tariff Name first."
        }
        if (errors==""){
            // save the tariff
            $.post(
                "../controllers/paymenttiersoperations.php",
                {
                    savepaymenttier:true,
                    id:id,
                    category:category,
                    tiername:tariffname
                },
                function(data){
                    data=$.trim(data)
                    if(data=="success"){
                        // clear fields for a new entry
                        results="<p class='text-success'><i class='fas fa-check-circle fa-fw fa-lg'></i> Tariff saved into the system successfully</p>"
                    }else{
                        results="<p class='text-danger'><i class='fas fa-times-circle fa-fw fa-lg'></i> "+data+"</p>"
                    }
                    tarifferrors.html(results)
                }
            )
        }else{
            //display ther errors
            errors="<p class='text-info'><i class='fas fa-info-circle fa-fw fa-lg'></i> "+errors+"</p>"
            tarifferrors.html(errors)
        }
    })

    function getTariffs(){
        var results=""
        $.getJSON(
            "../controllers/paymenttiersoperations.php",
            {
                getpaymenttiers:true,
                id:0
            },
            function(data){
                for(var i=0;i<data.length;i++){
                    results+="<option value='"+data[i].id+"'>"+data[i].tiername+"</option>"
                }
                tariffslist.html(results)
            }
        )
    }

    // listen to item click from the tariffs list
    tariffslist.on("click",function(){
        var id=$("#tariffslist option:selected").val(),
            results=""
        // get tariff details
        $.getJSON(
            "../controllers/paymenttiersoperations.php",
            {
                getpaymenttiers:true,
                id:id
            },
            function(data){
                tariffidfield.val(data[0].id)
                tariffnamefield.val(data[0].tiername)
                tariffdisplayname.val(data[0].tiername)
                tarifftypefield.val(data[0].category)
                tariffdisplaycategory.val(data[0].category)
            }
        )
        // get tariff range values
        $.getJSON(
            "../controllers/paymenttiersoperations.php",
            {
                gettariffrangevalues:true,
                id:id
            },
            function(data){
                for(var i=0;i<data.length;i++){
                    results+="<tr><td>"+parseInt(i+1)+"</td>"
                    results+="<td>"+data[i].minimumquantity+"</td>"
                    results+="<td>"+data[i].maximumquantity+"</td>"
                    results+="<td>"+data[i].priceperkg+"</td>"
                    results+="<td><a href='javascript void(0)' class='deleterange' data-id='"+data[i].id+"'><span><i class='fas fa-trash-alt fa-sm'></i></span></a></td></tr>"
                }
                rangetable.find("tbody").html(results)
            }
        )
    })

    addtariffrangebutton.on("click",function(){
       var  minvalue=minvaluefield.val(),
            maxvalue=maxvaluefield.val(),
            priceperkg=priceperkgfield.val(),
            tierid=$("#tariffslist option:selected").val()
            errors=""
        if(minvalue==""){
            errors="Please provide Minimum Quantity first"
        }else if(maxvalue=="")  {
            errors="Please provide Maximum Quantity first"
        }else if(priceperkg==""){
            errors="Please provide Price per KG"
        }else if(parseFloat(minvalue)>=parseFloat(maxvalue)){
            errors=="Minimum Quantity should be less than Maximum Quantity"
        }
        if(errors==""){
            $.post(
                "../controllers/paymenttiersoperations.php",
                {
                    savepaymenttierrange:true,
                    id:0,
                    tierid:tierid,
                    minvalue:minvalue,
                    maxvalue:maxvalue,
                    priceperkg:priceperkg
                },
                function(data){
                    data=$.trim(data)
                    if(data=="success"){
                        results="<p class='text-success'><i class='fas fa-check-circle fa-fw fa-lg'></i> Tariff Range saved successfully</p>"
                    }else{
                        results="<p class='text-danger'><i class='fas fa-times-circle fa-fw fa-lg'></i> "+data+"</p>"
                    }
                    rangeerrors.html(results)
                }
            )
        }else{
            errors="<p class='text-info'><i class='fas fa-info-circle fa-fw fa-lg'></i> "+errors+"</p>"
            rangeerrors.html(errors)
        }
    })

    rangetable.on("click",".deleterange",function(e){
        e.preventDefault()
        var id = $(this).attr('data-id'),
            parent = $(this).parent("td").parent("tr"),
            results=""

        bootbox.dialog({
            title: "Confirm Range Removal!",
            message: "Remove selected range from the Tariff?",
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
                        //console.log(parent)
                        $.post(
                            "../controllers/paymenttiersoperations.php",
                            {
                                id:id,
                                deletepaymenttierrange:true
                            },
                            function(data){
                                data=$.trim(data)
                                if(data=="success"){
                                    results="<p class='text-success'><i class='fas fa-check-circle fa-fw fa-lg'></i> Tariff Range removed successfully</p>" 
                                    parent.remove()
                                }else{
                                    results="<p class='text-danger'><i class='fas fa-times-circle fa-fw fa-lg'></i> "+data+"</p>"
                                } 
                                tarifferrors.html(results)
                                $('.bootbox').modal('hide');
                            }
                        ) 
                    }
                }
            }
        })
    })

    deletetariffbutton.on("click",function(){
        var id = $("#tariffslist option:selected").val(),
            results=""

        bootbox.dialog({
            title: "Confirm Tariff Deletion!",
            message: "Remove the Tariff <strong>"+ $("#tariffslist option:selected").text()+"</strong> from the system?",
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
                        //console.log(parent)
                        $.post(
                            "../controllers/paymenttiersoperations.php",
                            {
                                id:id,
                                deletepaymenttier:true
                            },
                            function(data){
                                data=$.trim(data)
                                if(data=="success"){
                                    results="<p class='text-success'><i class='fas fa-check-circle fa-fw fa-lg'></i> The Tariff <strong>"+$("#tariffslist option:selected").text()+"</strong> removed successfully.</p>" 
                                    $("#tariffslist option[value='"+$("#tariffslist option:selected").val()+"']").remove()
                                }else{
                                    results="<p class='text-danger'><i class='fas fa-times-circle fa-fw fa-lg'></i> "+data+"</p>"
                                } 
                                tarifferrors.html(results)
                                $('.bootbox').modal('hide');
                            }
                        ) 
                    }
                }
            }
        })
    })
})
