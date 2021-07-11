function setLoggedInUserName(){
    var username=''
    $.getJSON(
        "../controllers/useroperations.php",
        {
            getloggedinusername:true
        },
        function(data){
            username=$.trim(data.toString())
            $("#loggedinusername").html(username)
        }
    ).fail(function (jqxhr, status, error) { 
        //console.log('error', status, error) 
    }
)}

function getUnitOfMeasure(selectBox){
    $.getJSON(
        "../controllers/settingsoperations.php",
        {
            id:0,
            getuom:true
        },
        function(data){
            var results=''
            if(data.length<1){
                results="<div class='alert alert-info' role='alert'><i class='fas fa-info-circle'></i> None defined currently.</div>"
            }else{
                results="<select multiple class='form-control form-control-sm list-small' id='uomlist'>"
                for(var i=0;i<data.length;i++){
                    results+="<option value='"+data[i].id+"'>"+data[i].description+"</option>"
                }
                results+="</select>"
            }
            selectBox.html(results)
        }
    )
}

function getRegistrationDocuments(selectBox){
    $.getJSON(
        "../controllers/settingsoperations.php",
        {
            getregdocs:true,
            id:0
        },
        function(data){
            var results=''
            if(data.length<1){
                results="<div class='alert alert-info' role='alert'><i class='fas fa-info-circle'></i> None defined currently.</div>"
            }else{
                results="<select multiple class='form-control form-control-sm list-small' id='regcertslist'>"
                for(var i=0;i<data.length;i++){
                    results+="<option value='"+data[i].id+"'>"+data[i].description+"</option>"
                }
                results+="</select>"
            }
            selectBox.html(results)  
        }
    )
}

function getPropertyTypes(selectBox){
    $.getJSON(
        "../controllers/propertyoperations.php",
        {
            getpropertytypes:true,
            id:0
        },
        function(data){
            var results=''
            if(data.length<1){
                results="<div class='alert alert-info' role='alert'><i class='fas fa-info-circle'></i> None defined currently.</div>"
            }else{
                results="<select multiple class='form-control form-control-sm list-small' id='regcertslist'>"
                for(var i=0;i<data.length;i++){
                    results+="<option value='"+data[i].id+"'>"+data[i].description+"</option>"
                }
                results+="</select>"
            }
            selectBox.html(results)  
        }
    )
}

function getPropertyOwnersTypes(selectBox){
    $.getJSON(
        "../controllers/propertyoperations.php",
        {
            getpropertyownertypes:true,
            id:0
        },
        function(data){
            var results=''
            if(data.length<1){
                results="<div class='alert alert-info' role='alert'><i class='fas fa-info-circle'></i> None defined currently.</div>"
            }else{
                results="<select multiple class='form-control form-control-sm list-small' id='regcertslist'>"
                for(var i=0;i<data.length;i++){
                    results+="<option value='"+data[i].id+"'>"+data[i].description+"</option>"
                }
                results+="</select>"
            }
            selectBox.html(results)  
        }
    )
}

function getPropertyOwnerTypeAsOptions(selectBox,option='all'){
    $.getJSON(
        "../controllers/propertyoperations.php",
        {
            getpropertyownertypes:true,
            id:0
        },
        function(data){
            var results=''
            results=option=='all'?"<option value='0'>&lt;All&gt;</option>":"<option value=''>&lt;Choose One&gt;</option>"
            for(var i=0;i<data.length;i++){
                results+="<option value='"+data[i].id+"'>"+data[i].description+"</option>"
            }
            selectBox.html(results)  
        }
    )
}
function getRegistrationDocumentAsOptions(selectBox,option='all'){
    $.getJSON(
        "../controllers/settingsoperations.php",
        {
            getregdocs:true,
            id:0
        },
        function(data){
            var results=''
            
            results=option=='all'?"<option value='0'>&lt;All&gt;</option>":"<option value=''>&lt;Choose One&gt;</option>"
            for(var i=0;i<data.length;i++){
                results+="<option value='"+data[i].id+"'>"+data[i].description+"</option>"
            }
            selectBox.html(results)  
        }
    )
}

function getPropertyOwnersAsOption(id,selectBox,option='all',ignoreoption=1){
    $.getJSON(
        "../controllers/propertyoperations.php",
        {
            getpropertyowners:true,
            id:id
        },
        function(data){
            var results=""
            if (ignoreoption==0){
                results=option=="all"?"<option value='0'>&lt;All&gt;</option>":"<option value=''>&lt;Choose One&gt;</option>"
            }
            for (var i=0;i<data.length;i++){
                results+="<option value='"+data[i].ownerid+"'>"+data[i].names+"</option>"
            }
            selectBox.html(results)
        }
    )
}

function getPropertyTypesAsOptions(selectBox,option,id){
    $.getJSON(
        "../controllers/propertyoperations.php",
        {
            getpropertytypes:true,
            id:id
        },
        function(data){
            var results=""
            results=option=="all"?"<option value='0'>&lt;All&gt;</option>":"<option value=''>&lt;Choose One&gt;</option>"
            for (var i=0;i<data.length;i++){
                results+="<option value='"+data[i].id+"'>"+data[i].description+"</option>"
            }
            selectBox.html(results)
        }
    )
}

function getOwnerPropertiesAsOptions(selectBox,ownerid,option='choose'){
    $.getJSON(
        "../controllers/propertyoperations.php",
        {
            ownerid:ownerid,
            getownerproperties:true
        },
        function(data){
            var results=""
            results=option=="all"?"<option value='0'>&lt;All&gt;</option>":"<option value=''>&lt;Choose One&gt;</option>"
            for(var i=0;i<data.length;i++){
                results+="<option value='"+data[i].propertyid+"'>"+data[i].propertyname+"</option>"
            }
            selectBox.html(results)
        }
    )
}

function getPropertyBlocksAsOptions(selectBox,propertyid,option='choose'){
    var dfd=new $.Deferred()
    $.getJSON(
        "../controllers/propertyoperations.php",
        {
            getpropertyblocks:true,
            propertyid:propertyid,
            blockid:0
        },
        function(data){
            var results=""
            results=option=="all"?"<option value='0'>&lt;All&gt;</option>":"<option value=''>&lt;Choose One&gt;</option>"
            for(var i=0;i<data.length;i++){
                results+="<option value='"+data[i].blockid+"'>"+data[i].blockname+"</option>"
            }
            selectBox.html(results)
            dfd.resolve()
        }
    )
    return dfd.promise()
}

function pad(number, length) {
    s=number.toString()
    for(var i=length;i>=1;i--){
        s="0"+s
    }
    return s
}

function getUnitTypes(selectBox){
    $.getJSON(
        "../controllers/settingsoperations.php",
        {
            getunittypes:true,
            id:0
        },
        function(data){
            var results=''
            if(data.length<1){
                results="<div class='alert alert-info' role='alert'><i class='fas fa-info-circle'></i> None defined currently.</div>"
            }else{
                results="<select multiple class='form-control form-control-sm list-small' id='unittypes'>"
                for(var i=0;i<data.length;i++){
                    results+="<option value='"+data[i].id+"'>"+data[i].description+"</option>"
                }
                results+="</select>"
            }
            selectBox.html(results)  
        }
    ) 
}

function getUnitTypesAsOptions(selectBox,id,option='choose'){
    $.getJSON(
        "../controllers/settingsoperations.php",
        {
            id:id,
            getunittypes:true
        },
        function(data){
            var results=""
            results=option=="all"?"<option value='0'>&lt;All&gt;</option>":"<option value=''>&lt;Choose One&gt;</option>"
            for(var i=0;i<data.length;i++){
                results+="<option value='"+data[i].id+"'>"+data[i].description+"</option>"
            }
            selectBox.html(results)
        }
    )
}
function getMeterMakesAsOptions(selectBox,option='choose'){
    var dfd =new $.Deferred()
    $.getJSON(
        "../controllers/meteroperations.php",
        {
            getmetermakes:true,
            makeid:0
        },
        function(data){
            var results
            results=option=="all"?"<option value='0'>&lt;All&gt;</option>":"<option value=''>&lt;Choose One&gt;</option>"
            for(var i=0;i<data.length;i++){
                results+="<option value='"+data[i].makeid+"'>"+data[i].makename+"</option>"
            }
            selectBox.html(results)
            dfd.resolve()
        }
    )
    return dfd.promise()
}

function getMeterModelsAsOptions(makeid,selectBox,option='choose'){
    var dfd=new $.Deferred()
    $.getJSON(
        "../controllers/meteroperations.php",
        {
            getmetermodels:true,
            makeid:makeid,
            modelid:0
        },
        function(data){
            var results
            results=option=="all"?"<option value='0'>&lt;All&gt;</option>":"<option value=''>&lt;Choose One&gt;</option>"
            for(var i=0;i<data.length;i++){
                results+="<option value='"+data[i].modelid+"'>"+data[i].modelname+"</option>"
            }
            selectBox.html(results)
            dfd.resolve()
            
        }
    )
    return dfd.promise()
}

function getUnitsAsOption(propertyid,selectBox,option='choose'){
    $.getJSON(
        "../controllers/propertyoperations.php",
        {
            getpropertyunits:true,
            propertyid:propertyid,
            blockid:0
        },
        function(data){
            var results
            results=option=="all"?"<option value='0'>&lt;All&gt;</option>":"<option value=''>&lt;Choose One&gt;</option>"
            for(var i=0;i<data.length;i++){
                results+="<option value='"+data[i].unitid+"'>"+data[i].unitname+"</option>"
            }
            selectBox.html(results)
        }
    )
}

function getRegionsAsOptions(selectBox,option='choose'){
    $.getJSON(
        "../controllers/settingsoperations.php",
        {
            getregions:true
        },
        function(data){
            var results
            results=option=="all"?"<option value='0'>&lt;All&gt;</option>":"<option value=''>&lt;Choose One&gt;</option>"
            for(var i=0;i<data.length;i++){
                results+="<option value='"+data[i].regionid+"'>"+data[i].regionname+"</option>"
            }
            selectBox.html(results)
        }
    )
}

function getMeterNumbersAsOption(makeid,modelid,selectBox,option="choose"){
    $.getJSON(
        "../controllers/meteroperations.php",
        {
            getmeters:true,
            meterid:0,
            makeid:makeid,
            modelid:modelid
        },
        function(data){
            var results
            results=option=="all"?"<option value='0'>&lt;All&gt;</option>":"<option value=''>&lt;Choose One&gt;</option>"
            for(var i=0;i<data.length;i++){
                results+="<option value='"+data[i].id+"'>"+data[i].meterno+"</option>"
            }
            selectBox.html(results)
        }
    )
}

function getCustomerMetersAsOptions(customerid,selectBox,option='choose'){
    $.getJSON(
        "../controllers/customeroperations.php",
        {
            getcustomerunits:true,
            customerid:customerid
        },
        function(data){
            var results
            results=option=="all"?"<option value='0'>&lt;All&gt;</option>":"<option value=''>&lt;Choose One&gt;</option>"
            for(var i=0;i<data.length;i++){
                results+="<option value='"+data[i].meterid+"'>"+data[i].meterno+"</option>"
            }
            selectBox.html(results)
        }
    )
}

function getPaymentMethodsAsOptions(selectBox,option="choose"){
    $.getJSON(
        "../controllers/settingsoperations.php",
        {
            getpaymentmethods:true
        },
        function(data){
            var results
            results=option=="all"?"<option value='0'>&lt;All&gt;</option>":"<option value=''>&lt;Choose One&gt;</option>"
            for(var i=0;i<data.length;i++){
                results+="<option value='"+data[i].id+"'>"+data[i].paymentmethod+"</option>"
            }
            selectBox.html(results)
        }
    )
}

function formatDate(date) {

    var month_names =["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"]
    var date= new Date(date)
    var day = date.getDate()
    var month_index = date.getMonth()
    var year = date.getFullYear()
    
    return "" + day + "-" + month_names[month_index] + "-" + year;
}


function getTariffsAsOptions(selectBox,option="choose"){
    $.getJSON(
        "../controllers/paymenttiersoperations.php",
        {   
            id:0,
            getpaymenttiers:true
        },
        function(data){
            var results
            results=option=="all"?"<option value='0'>&lt;All&gt;</option>":"<option value=''>&lt;Choose One&gt;</option>"
            for(var i=0;i<data.length;i++){
                results+="<option value='"+data[i].id+"'>"+data[i].tiername+"</option>"
            }
            selectBox.html(results)
        }
    )
}

function getAllUsersAsOptions(selectBox,option='choose'){
    $.getJSON(
        "../controllers/useroperations.php",
        {   
            getuserslist:true
        },
        function(data){
            var results
            results=option=="all"?"<option value='0'>&lt;All&gt;</option>":"<option value=''>&lt;Choose One&gt;</option>"
            for(var i=0;i<data.length;i++){
                results+="<option value='"+data[i].userid+"'>"+data[i].firstname+" "+data[i].middlename+" "+data[i].lastname+"</option>"
            }
            selectBox.html(results)
        }
    )
}

function getFaultCategoriesAsOptions(selectBox,option='choose'){
    $.getJSON(
        "../controllers/settingsoperations.php",
        {   
            getfaultcategories:true
        },
        function(data){
            var results
            results=option=="all"?"<option value='0'>&lt;All&gt;</option>":"<option value=''>&lt;Choose One&gt;</option>"
            for(var i=0;i<data.length;i++){
                results+="<option value='"+data[i].id+"'>"+data[i].categoryname+"</option>"
            }
            //console.log(results)
            selectBox.html(results)
        }
    )
}

function getProductCategories(selectname, opt){
    var deferred=new $.Deferred()
    // get all product categories
    $.getJSON(
      "../controllers/inventoryoperations.php",
      {
        getcategories:true
      },
      function(data){
        var results=''
        opt==="all"?results+='<option value="0">&lt;All&gt</option>':results+='<option value="0">&lt;Choose One&gt;</option>'
        for(var i=0;i<data.length;i++){
          results+="<option value='"+data[i].categoryid+"'>"+data[i].categoryname+"</option>"
        }
        //console.log(results)
        selectname.html(results)
        deferred.resolve()
      }
    )
    return  deferred.promise()
  }

  
function getPaymentModes(selectBox,option='all'){
    $.getJSON(
      "../controllers/settingsopeerations.php",
      {
        getpaymentmethods:true
      },
      function(data){
          var results
          option=='all'?results="<option value='0'>&lt;All&gt;</option>":results="<option value=''>&lt;Choose One&gt;</option>"
          for (var i = 0; i < data.length; i++) {
              results+="<option value='"+data[i].id+"'>"+data[i].description+"</option>"
          } 
          $(results).appendTo(selectBox)
      })
  }
  
  function getSuppliers(selectBox, option='all'){
    $.getJSON(
      "../controllers/getsuppliers.php",
      function(data){
          var results
          option=='all'?results="<option value='0'>&lt;All&gt;</option>":results="<option value=''>&lt;Choose One&gt;</option>"
          for (var i = 0; i < data.length; i++) {
              results+="<option value='"+data[i].supplierid+"'>"+data[i].suppliername+"</option>"
          } 
          $(results).appendTo(selectBox)
      })
  }
  
  function getCashbookAccounts(selectBox,option='all'){
    $.getJSON(
      "../controllers/glaccountoperations.php",
      {
        getcashbookaccounts:true
      },
      function(data){
        var results=''
        option=='all'?results="<option value='0'>&lt;All&gt;</option>":results="<option value=''>&lt;Choose One&gt;</option>"
        for(var i=0;i<data.length;i++){
          results+="<option value='"+data[i].id+"'>"+data[i].accountname+"</option>"
        }
        selectBox.html(results)
      }
    )
  }
  
  function getGLAccounts(selectBox,groupid=0,option='all'){
    $.getJSON(
      "../controllers/glaccountoperations.php",
      {
        getglaccounts:true,
        groupid:groupid
      },
      function(data){
        var results=""
        option=='all'?results="<option value='0'>&lt;All&gt;</option>":results="<option value=''>&lt;Choose One&gt;</option>"
        for(var i=0;i<data.length;i++){
          results+="<option value='"+data[i].id+"'>"+data[i].accountname+"</option>"
        }
        selectBox.html(results)
      }
    )
  }