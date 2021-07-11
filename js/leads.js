$(document).ready(function(){
    var regionsdropdown=$("#filterregion"),
        classificationdropdown=$("#filterclassification"),
        searchfield=$("#searchlead"),
        leadslist=$("#leadslist")
        leadregion=$("#leadregion"),
        leadclassification=$("#leadclassification"),
        saveleadbutton=$("#savelead"),
        clearbutton=$("#clearbutton"),
        leadidfield=$("#leadid"),
        leadnamefield=$("#leadname"),
        leadblockfield=$("#leadblocks"),
        leadunitsfield=$("#leadunits"),
        leadmanagementfield=$("#leadmanagement"),
        leadregionfield=$("#leadregion"),
        leadclassificationfield=$("#leadclassification"),
        leaderrors=$("#leaderrors"),
        recentlyaddedleads=$("#recentlyaddedleads"),
        editleadbutton=$("#editlead"),
        addnewleadbuttom=$("#addnewlead"),
        searchbutton=$("#searchbutton"),
        map=$("#leadmap"),
        timeoutVal = 10 * 1000 * 1000;
    // set logged in user
    setLoggedInUserName()
    
    var getlocation=function(position){
        //var sitename=sites.find('option:selected').text()
        var latitude=position.coords.latitude
        var longitude=position.coords.longitude
        
        //lat.val(position.coords.latitude)
        //lon.val(position.coords.longitude)
        
        // plot on the map
        var coords=new google.maps.LatLng(latitude,longitude)

        var mapOptions={
            zoom:16,
            center:coords,
            mapTypeId:google.maps.MapTypeId.ROADMAP
        }

        var map= new google.maps.Map(document.getElementById("map"),mapOptions)

        var marker= new google.maps.Marker({map: map, position: coords, title:sitename})
    }

    function displayError() {		  
       /* errormessageplacement.find("p").remove()
        notice="<p>An error occured. Check if GPS is enabled on your device<p>"
        $(notice).appendTo(errormessageplacement)
        errormessageanchor.click()
          //displayError("An error occured. Check if GPS is enabled on your device");
        */
    }

    getRegions(regionsdropdown).done(function(){
         getRegions(leadregion,'choose').done(function(){
            getLeads()
         })
    })

   // get recently added leads
    getRecentlyAddedLeads()

    // get all leads clasification and populate
    getClasification(classificationdropdown)
    getClasification(leadclassification,'choose')

    function getRegions(selectbox,option='all'){
        var dfd=new $.Deferred()
        $.getJSON(
            "../controllers/settingsoperations.php",
            {
                getregions:true
            },
            function(data){
                var results
                results=option=='all'?"<option value='0'>&lt;All Regions&gt;":"<option value=''>&lt;Choose One&gt;"
                for(var i=0;i<data.length;i++){
                    results+="<option value='"+data[i].regionid+"'>"+data[i].regionname+"</option>"
                }
                selectbox.html(results)
                dfd.resolve()
            }
        )
        return dfd.promise()
    }

    function getClasification(selectbox,option='all'){
        var dfd= new $.Deferred()
        $.getJSON(
            "../controllers/settingsoperations.php",
            {
                getcustomerclassifications:true
            },
            function(data){
                var results
                results=option=='all'?"<option value='0'>&lt;All Classes&gt;":"<option value=''>&lt;Choose One&gt;"
                for(var i=0;i<data.length;i++){
                    results+="<option value='"+data[i].classificationid+"'>"+data[i].classificationname+"</option>"
                }
                selectbox.html(results)
                dfd.resolve()
            }
        )
        return dfd.promise()
    }

    saveleadbutton.on("click",function(){
        var id=leadidfield.val(),
            leadname=leadnamefield.val(),
            classification=leadclassificationfield.val(),
            region=leadregionfield.val(),
            management=leadmanagementfield.val(),
            blocks=leadblockfield.val(),
            units=leadunitsfield.val(),
            errors=''
        // check for blank fields
        if(region==""){
            errors="Please select <strong>Region</string>"
            leadregionfield.focus()
        }else if(classification==""){
            errors="Please select <strong>Classification</strong>"
            leadclassificationfield.focus()
        }else if(leadname==""){
            errors="Please provide <strong>Lead Name</strong>"
            leadnamefield.focus()
        }else if(blocks==""){
            errors="Please provide <strong>Blocks</strong>"
            leadblockfield.focus()
        }else if(units==""){
            errors="Please provide <stron>Units</strong>"
            leadunitsfield.focus()
        }else if(management==""){
            errors="Please provide <strong>Management</strong>"
        }
        if(errors==""){
            $.post(
                "../controllers/leadoperations.php",
                {
                    savelead:true,
                    id:id,
                    region:region,
                    classification:classification,
                    leadname:leadname,
                    blocks:blocks,
                    units:units,
                    management:management
                },
                function(data){
                    data=$.trim(data)
                    if(data=="success"){
                        errors="<div class='alert alert-success font-weight-bold' role='alert'><i class='far fa-check-circle'></i> Lead has been saved sucessfully.</div>"
                        // clear form for a new entry
                        clearForm()
                        // refresh List
                        getLeads()
                        // repopulate recently added 
                        getRecentlyAddedLeads()
                    }else{
                        errors="<div class='alert alert-info font-weight-bold' role='alert'><i class='far fa-times-circle'></i> "+data+"</div>"
                    }
                    leaderrors.html(errors)
                }
            )
        }else{
            errors="<div class='alert alert-info' role='alert'><i class='fas fa-info-circle'></i> "+errors+"</div>"
            leaderrors.html(errors)
        }
    })

    function clearForm(){
        leadidfield.val("0")
        leadnamefield.val("")
        leadclassificationfield.val("")
        leadregionfield.val("")
        leadmanagementfield.val("")
        leadblockfield.val("")
        leadunitsfield.val("")
    }

    function getLeads(){
        var region=regionsdropdown.val(),
            classification=classificationdropdown.val(),
            leadname=searchfield.val()
        $.getJSON(
            "../controllers/leadoperations.php",
            {
                getleads:true,
                region:region,
                classification:classification,
                leadname:leadname
            },
            function(data){
                var results=''
                for(var i=0;i<data.length;i++){
                    results+="<option value='"+data[i].id+"'>"+data[i].leadname
                }
                leadslist.html(results)
            }
        )
        // display map 
        if(navigator.geolocation){
            map.find("p").remove()
            notice="<p>Generating Map. Please wait ...<p>"
            $(notice).appendTo(map)
            map.show()
            navigator.geolocation.getCurrentPosition(getlocation,displayError, { enableHighAccuracy: true, timeout: timeoutVal, maximumAge: 0 })
        }else{
            alert("Your browser does not support geolocation")
        }
    }

    function getRecentlyAddedLeads(){
        $.getJSON(
            "../controllers/leadoperations.php",
            {
                getrecentlyaddedleads:true
            },
            function(data){
                var results="<p class='font-weight-bold'>Recently Added Leads:</p><table class='table table-sm'>"
                for(var i=0;i<data.length;i++){
                    results+="<tr><td id='"+data[i].id+"'>"+data[i].leadname+"</td>"
                    results+="<td><a href='javascript void(0)' class='editlead' data-id='"+data[i].id+"'><span><i class='fas fa-user-edit'></i></span></a></td></tr>"
                }
                results+="</table>"
                recentlyaddedleads.html(results)
            }
        )
    }

    function getLeadDetails(id){
        var longitude,latitude

            $.getJSON(
                "../controllers/leadoperations.php",
                {
                    getleaddetails:true,
                    leadid:id
                },
                function(data){
                    $(".leadname").html(data[0].leadname)
                    $(".region").html(data[0].regionname)
                    $(".classification").html(data[0].classificationname)
                    $(".propertymanager").html(data[0].management)
                    $(".blocks").html(data[0].blocks)
                    $(".units").html(data[0].units)
                    longitude=data[0].longitude
                    latitude=data[0].latitude
                    // populate for editing
                    leadidfield.val(data[0].id)
                    leadnamefield.val(data[0].leadname)
                    leadclassificationfield.val(data[0].classificationid)
                    leadregionfield.val(data[0].regionid)
                    leadmanagementfield.val(data[0].management)
                    leadblockfield.val(data[0].blocks)
                    leadunitsfield.val(data[0].units)
                }
            )
       // display on map
    }

    leadslist.on("change",function(){
        var selected=[];
        $('#leadslist :selected').each(function(){
            selected.push($(this).val())
        })

        if(selected.length==1){
            id=selected[0]
            getLeadDetails(id)
        }else{

        }
    })

    addnewleadbuttom.on("click",function(){
        //console.log("Add new button clicked")
        clearForm()
        $(".leadname").html("")
        $(".region").html("")
        $(".classification").html("")
        $(".propertymanager").html("")
        $(".blocks").html("")
        $(".units").html("")
    })

    searchbutton.on("click",getLeads)
   
    clearbutton.on("click",function(e){
        clearForm()
        leaderrors.html("")
    }) 
    
    // listen to edit on recently added items
    $("body").on("click",'.editlead',function(e){
        e.preventDefault()
        var id = $(this).attr('data-id');
        getLeadDetails(id)
        // display modal 
        $("#leaddetails").modal()
    })
})