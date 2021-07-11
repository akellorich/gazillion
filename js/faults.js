$(document).ready(()=>{
    var addfaultbutton=$("#addfaultdetails"),
        faultdetailsmodal=$("#faultdetailsmodal"),
        faultcategorieslist=$("#faultdetailscategory"),
        faultnamefield=$("#faultsdetailsfaultname"),
        faultdescriptionfield=$("#faultsdetailsfaultdescription"),
        savefaultbutton=$("#savefaultdetails"),
        faultidfield=$("#faultid"),
        faulterrordiv=$("faultdetailserrors"),
        faultslist=$('#faultslist')
    
    // get fault categories
    getFaultCategoriesAsOptions(faultcategorieslist,'choose')
    
    // get existing faults list
    getexistingfaults()
    
    // Show Modal when Add button is clicked
    addfaultbutton.on("click",()=>{
        faultdetailsmodal.modal("show")
    })

    // save the fault
    savefaultbutton.on("click",function(){
        var faultid=faultidfield.val(),
            faultname=faultnamefield.val(),
            faultdescription=faultdescriptionfield.val(),
            categoryid=faultcategorieslist.val(),
            errors=""
        // check for blank fields
        if(categoryid==""){
            errors="Please select the <strong>Fault Category</strong>"
            faultcategorieslist.focus()
        }else if(faultname==""){
            errors="Please provide the <strong>Fault Name</strong>"
            faultnamefield.focus()
        }else if(faultdescription==""){
            errors="Please provide the <strong>Fault Description</strong>"
            faultdescriptionfield.focus()
        }

        if(errors==""){
            $.post(
                "../controllers/settingsoperations.php",
                {
                    savefault:true,
                    faultid,
                    categoryid,
                    faultname,
                    faultdescription
                },
                function(data){
                    data=$.trim(data)
                    if(data=="exists"){
                        errors="The fault already exists in the system"
                        faulterrordiv.html(showAlert("info",errors))
                    }else if(data=="success"){
                        errors="The fault has been saved successfully"
                        faulterrordiv.html(showAlert("success",errors))
                        // clear fields for a new entry
                        clearfaultdetailsform()
                        faultcategorieslist.focus()
                    }else{
                        errors=`Sorry, an error occured. ${data}`
                        faulterrordiv.html(showAlert("danger",errors))
                    }
                }
            )
        }else{
            faulterrordiv.html(showAlert("info",errors))
        }
    })

    function clearfaultdetailsform(){
        faultidfield.val("0")
        faultnamefield.val("")
        faultdescriptionfield.val("")
        faultcategorieslist.val("")
    }

    function getexistingfaults(){
        $.getJSON(
            "../controllers/settingsoperations.php",
            {
                getexistingfaults:true
            },
            function(data){
                var results=""
                for(var i=0;i<data.length;i++){
                    results=`<tr><td>${Number(i)+1}</td>`
                    results=`<td>${data[i].faultname}</td>`
                    results=`<td>${data[i].faultdescription}</td>`
                    results=`<td>${data[i].dateadded}</td>`
                    results=`<td>${data[i].addedby}</td>`
                    results=`<td>${data[i].faultname}</td>`
                    results=`<td>${data[i].faultname}</td>`
                }
                faultslist.find("tbody").html(results)
            }
        )
    }
})