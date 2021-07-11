$(document).ready(function(){

    var userdetailstab=$("#userdetails"),
        roledetailstab=$("#roledetails"),
        userprivileges=$("#userprivileges"),
        roleprivileges=$("#roleprivileges"),  
        userslist=$("#userslist"),
        userroleslist=$("#userroleslist"),
        useridfield=$("#userid"),
        usernamefield=$("#username"),
        passwordfield=$("#password"),
        confirmpasswordfiel=$("#confirmpassword"),
        firstnamefield=$("#firstname"),
        middlenamefield=$("#middlename"),
        lastnamefield=$("#lastname"),
        emailfield=$("#email"),
        mobilefield=$("#mobile"),
        changestatusbutton=$("#changestatusbutton"),
        systemadminbutton=$("#systemadmin"),
        changepasswordonlogonbutton=$("#changepasswordonlogon"),
        accountactivefield=$("#accountactive"),
        saveuserbutton=$("#saveuser"),
        errordiv=$("#errordiv"),
        clearuserbutton=$("#clearuser"),
        rolesdropdown=$("#roles"),
        roleusers=$("#roleusers"),
        saverolebutton=$("#saverole"),
        roleidfield=$("#roleid"),
        rolenamefield=$("#rolename"),
        roledescriptionfield=$("#roledescription"),
        roleerrors=$("#roleerrors"),
        adduserrole=$("#adduserrole"),
        addroleuser=$("#addroleuser"),
        usernonroles=$("#usernonroles"),
        userroleerrors=$("#userroleerrors"),
        saveuserrole=$("#saveuserrole")
    // set logged in user
    setLoggedInUserName()
    // hide roles tab details by default
    roledetailstab.hide()
    //get all users
    getUsers()
    // get existing roles
    getRoles()
    // get all objects
    $.getJSON(
        "../controllers/useroperations.php",
        {
            getobjects:true
        },function(data){
            var results="<p class='alert alert-secondary'>Privileges</p><table class='table table-sm'>"
            for(var i=0;i<data.length;i++){
                results+="<tr><td><input type='checkbox' id='"+data[i].objectid+"' class='checkoption'>&nbsp;&nbsp;"
                results+=data[i].description+"</td></tr>"
            }
            results+="</table>"
            userprivileges.html(results)
            roleprivileges.html(results)
        }
    )

    $('#nav-tab a').click(function (link) {
        selection=link.currentTarget.innerText
        if (selection=="Users"){
            userdetailstab.show()
            roledetailstab.hide()
        }else{
            userdetailstab.hide()
            roledetailstab.show() 
        }
    })

    userslist.on("change",function(){
        userid=userslist.val()
        errordiv.html("")
        // get users details
        $.getJSON(
            "../controllers/useroperations.php",
            {
                getusersdetails:true,
                userid:userid
            },
            function(data){
                useridfield.val(data[0].userid)
                usernamefield.val(data[0].username)
                firstnamefield.val(data[0].firstname)
                middlenamefield.val(data[0].middlename)
                lastnamefield.val(data[0].lastname)
                mobilefield.val(data[0].telephone)
                emailfield.val(data[0].email)
                passwordfield.prop("disabled",true)
                confirmpasswordfiel.prop("disabled",true)
                // check status and change the caption od change status button as approriate
                if(data[0].accountactive==1){
                    changestatusbutton.button( "option", "label", "Disable" )
                    accountactivefield.val(1)
                }else{
                    changestatusbutton.button( "option", "label", "Enable" )
                    accountactivefield.val(0)
                }
                if(data[0].systemadmin==1){
                    systemadminbutton.prop("checked",true)
                }else{
                    systemadminbutton.prop("checked",false)
                }
                if(data[0].changepaswordonlogon==1){
                    changepasswordonlogonbutton.prop("checked",true)
                }else{
                    changepasswordonlogonbutton.prop("checked",false)
                }
            }
        )
        // get user roles
        if(userid!=""){
            $.getJSON(
                "../controllers/useroperations.php",
                {
                    getuserroles:true,
                    userid:userid
                },
                function(data){
                    if(data.length>0){
                        var userroles="<table class='table table-sm'>"
                        for(var i=0;i<data.length;i++){
                            userroles+="<tr class='clickable-row' id='"+data[i].roleid+"'>"
                            userroles+="<td>"+data[i].rolename+"</td>"
                            userroles+="<td><a href='javascript void(0)' class='deleteuserrole' data-id='"+data[i].roleid+"'><span><i class='fas fa-trash-alt fa-sm'></i></span></a></td></tr>"
                        }
                        userroles+="<table>"
                    }else{
                        userroles="<div class='alert alert-info' role='alert'><i class='fas fa-info-circle'></i> User assigned to no Role(s).</div>"
                    }
                
                userroleslist.html(userroles)
                }
            )
        }

        // get users privileges
        $.getJSON(
            "../controllers/useroperations.php",
            {
                userid:userid,
                getuserprivileges:true
            },
            function(data){
                //remove all checks based on class 
                $(".checkoption").prop("checked",false)
                for(var i=0;i<data.length;i++){
                    // locate the object on the list
                    if(data[i].valid==1){
                        $("#"+data[i].objectid).prop("checked",true)
                    }
                }
            }
        )
    })

    saveuserbutton.on("click",function(){
        // check for blank fields
        var userid=useridfield.val(),
            username=usernamefield.val(),
            password=passwordfield.val(),
            confirmpassword=confirmpasswordfiel.val()
            firstname=firstnamefield.val(),
            middlename=middlenamefield.val(),
            lastname=lastnamefield.val(),
            mobile=mobilefield.val(),
            email=emailfield.val()
            systemadmin=systemadminbutton.prop("checked")?1:0,
            accountactive=accountactivefield.val()==1?1:0,
            changepasswordonlogon=changepasswordonlogonbutton.prop("checked")?1:0,
            errors='',
            data=[]
        if(username==""){
            errors="Please provide a <strong>USERNAME</strong>"
            usernamefield.focus()
        }else if(firstname==""){
            errors="Please provide <strong>FIRST NAME</strong></p>"
            firstnamefield.focus()
        }else if(middlename==""){
            errors="Please provide <strong>MIDDLE NAME</strong></p>"
            middlenamefield.focus()
        }else if (password=="" && !passwordfield.prop("disabled")){
            errors="Please provide a <strong>PASSWORD</strong></p>"
            passwordfield.focus()
        }else if(email==""){
            errors="Please provide <strong>EMAIL ADDRESS</strong></p>"
            emailfield.focus()
        }else if(mobile==""){
            errors="Please provide <strong>MOBILE NUMBER</strong></p>"
            mobilefield.focus()
        }else if(password!=confirmpassword && !passwordfield.prop("disabled")){ 
            // check if password entries match
            errors="<strong>PASSWORD</strong> entries do not match</p>"
        }

        /* get the privileges set */
        $("#userprivileges").find(".checkoption").each(function(){
            if($(this).prop("checked")){
                id=$(this).prop("id")
                data.push({id: id, valid:1})
            }
        })

        TableData=JSON.stringify(data)

        if(errors==""){ 
            // save the user  
            errordiv.html("<p class='alert alert-info'>Processing...</p>")
           $.post(
               "../controllers/useroperations.php",
               {
                   saveuser:true,
                   userid:userid,
                   username:username,
                   password:password,
                   firstname:firstname,
                   middlename:middlename, 
                   lastname:lastname,
                   email:email,
                   mobile:mobile,
                   systemadmin:systemadmin,
                   changepasswordonlogon: changepasswordonlogon,
                   accountactive:accountactive,
                   TableData:TableData
               },
               function(data){
                   data=$.trim(data)
                   if(data=="Success"){
                    errors="<div class='alert alert-success font-weight-bold' role='alert'><i class='far fa-check-circle'></i> User has been saved sucessfully.</div>"
                        //errors="<p class='alert alert-success'>The User has been saved successfully.</p>"
                        // clear the form
                        clearUserForm()
                        // refresh the list
                        getUsers()
                   }else{
                    errors="<div class='alert alert-danger font-weight-bold' role='alert'><i class='far fa-times-circle'></i> "+data+"</div>"
                   }
                   errordiv.html(errors)
               }
           )
        }else{
            errors="<div class='alert alert-info' role='alert'><i class='fas fa-info-circle'></i> "+errors+"</div>"
            errordiv.html(errors)
        }
    })
    
    clearuserbutton.on("click", clearUserForm)
    
    function clearUserForm(){
        useridfield.val(0)
        usernamefield.val("")
        passwordfield.val("")
        confirmpasswordfiel.val("")
        firstnamefield.val("")
        middlenamefield.val("")
        lastnamefield.val("")
        mobilefield.val("")
        emailfield.val("")
        systemadminbutton.prop("checked",0)
        accountactivefield.val(1)
        changepasswordonlogonbutton.prop("checked",1)
        // reset all issued privileges
        $(".checkoption").prop("checked",false)
        passwordfield.prop("disabled",false)
        confirmpasswordfiel.prop("disabled",false)
        usernamefield.focus()
    }

    function getUsers(){
        // get users list
        $.getJSON(
            "../controllers/useroperations.php",
            {
                getuserslist:true
            },
            function(data){
                var results="<option value=''>&lt;Choose One&gt;</option>"
                for(var i=0;i<data.length;i++){
                    results+="<option value='"+data[i].userid+"'>"+data[i].firstname+" "+data[i].middlename+" "+data[i].lastname+"</option>"
                }
                userslist.html(results)
            }
        )
    }

    // listen to change event of any text box
    $("input").on("input",function(){
        errordiv.html("")
        roleerrors.html("")
    })

    function getRoles(){
        $.getJSON(
            "../controllers/useroperations.php",
            {
                getroles:true
            },
            function(data){
                if(data.length>0){
                    var results="<label for='rolelist'>Rolename:</label><select name='roleslist' id='roleslist' class='form-control form-control-sm'><option value=''>&lt;Choose One&gt;</option>"
                    for(var i=0;i<data.length;i++){
                        results+="<option value='"+data[i].roleid+"'>"+data[i].rolename+"</option>"
                    }
                    results+='</select>'
                }else{
                    results="<div class='alert alert-info' role='alert'><i class='fas fa-info-circle'></i> No roles defined currently.</div>"
                }
                rolesdropdown.html(results) 
            }
        )
    }

    // listen to click event of roles dop down
    $("body").on("click",'#roleslist',function(){
        //console.log("clicked")
        var roleid=$(this).val()
        if(roleid!=""){
            $.getJSON(
                "../controllers/useroperations.php",
                {
                    getroleusers:true,
                    roleid:roleid
                },
                function(data){
                    if(data.length>0){
                        var results="<p class='font-weight-bold'>Users in the Role:</p><table class='table table-sm'>"
                        for(var i=0;i<data.length;i++){
                            results+="<tr><td id='"+data[i].userid+"'>"+data[i].firstname+" "+data[i].middlename+" "+data[i].lastname+"</td>"
                            results+="<td><a href='javascript void(0)' class='deleteroleuser'><span><i class='fas fa-trash-alt fa-sm'></i></span></a></td></tr>"
                        }
                        results+="</table>"
                    }else{
                        results="<div class='alert alert-info' role='alert'><i class='fas fa-info-circle'></i>&nbsp;&nbsp;Currently no users in the role.</div>"
                    }
                    roleusers.html(results)
                }
            )

            // get role details for editing
            $.getJSON(
                "../controllers/useroperations.php",
                {
                    getroledetails:true,
                    roleid:roleid
                },
                function(data){
                    roleidfield.val(data[0].roleid)
                    rolenamefield.val(data[0].rolename)
                    roledescriptionfield.val(data[0].roledescription)
                }
            )

            // get role privileges
            $.getJSON(
                "../controllers/useroperations.php",
                {
                    getroleprivileges:true,
                    roleid:roleid
                },
                function(data){
                    $("#roleprivileges").find(".checkoption").prop("checked",false)
                    for (var i=0;i<data.length;i++){
                        $("#roleprivileges").find(".checkoption").each(function(){
                            //console.log($(this).prop("id"))
                            if($(this).prop("id")==data[i].objectid){
                               // console.log("Match Found!")
                               if(data[i].valid==1){
                                   $(this).prop("checked",true)
                               }
                            }
                        })
                    }
                }
            )
        }
    })

    saverolebutton.on("click",function(){
        var roleid=roleidfield.val(),
            rolename=rolenamefield.val(),
            roledescription=roledescriptionfield.val(),
            errors='',
            data=[],
            results
        // check blank fields
        if(rolename==""){
            errors="Please provide <strong>ROLE NAME</strong>"
            rolenamefield.focus()
        }else if(roledescription==""){
            errors="Please provide <strong>ROLE DESCRIPTION</strong>"
            roledescriptionfield.focus()
        }
        if(errors==""){
            // generate selected privileges
            $("#roleprivileges").find(".checkoption").each(function(){
                if($(this).prop("checked")){
                    id=$(this).prop("id")
                    data.push({id: id, valid:1})
                }
            })
            TableData=JSON.stringify(data)
            $.post(
                "../controllers/useroperations.php",
                {
                    saverole:true,
                    rolename:rolename,
                    roledescription:roledescription,
                    roleid:roleid,
                    TableData:TableData
                },
                function(data){
                    data=$.trim(data)
                    if(data==="Success"){
                        results="<div class='alert alert-info' role='alert'><i class='fas fa-check-circle'></i> Role has been saved successfully.</div>"
                        // refresh list
                        // clear form
                    }else{
                        results="<div class='alert alert-info' role='alert'><i class='fas fa-times-circle'></i> "+data1+"</div>"
                    }
                     roleerrors.html(results)
                }
            )
        }else{
            errors="<div class='alert alert-danger' role='alert'><i class='fas fa-exclamation-triangle'></i> "+errors+"</div>"
            roleerrors.html(errors)
        }
    })

    adduserrole.on("click",function(){
        // get all roles not belonging to the user
        userid=useridfield.val()
        $.getJSON(
            "../controllers/useroperations.php",
            {
                getusernonroles:true,
                userid:userid
            },
            function(data){
                var results=''
                for(var i=0;i<data.length;i++){
                    results+="<input type='checkbox' class='"+data[i].roleid+" usersrolestoadd'>&nbsp;"+data[i].rolename+"<br/>"
                }
              //console.log(results)
                usernonroles.html(results)
            }
        )
    })

    saveuserrole.on("click",function(){
        data=[]
        $(".usersrolestoadd").each(function(){
            var roleid,userid=useridfield.val()
            if($(this).prop("checked")){
                roleid=$(this).prop('class').split(' ')[0]
                data.push({roleid: roleid})
            }
        })
        //console.log(data)
        if(data.length>0){
            TableData=JSON.stringify(data)
            $.post(
                "../controllers/useroperations.php",
                {
                    saveuserroles:true,
                    userid:userid,
                    TableData:TableData
                },
                function(data){
                    // check if successful
                    data=$.trim(data)
                    if(data=="success"){
                        results="<div class='alert alert-info' role='alert'><i class='fas fa-check-circle'></i> Role(s) added to the user successfully.</div>"
                    }else{
                        results="<div class='alert alert-danger' role='alert'><i class='fas fa-times-circle'></i> "+data+"</div>"
                    }
                    userroleerrors.html(results)
                }
            )
        }else{
            results="<div class='alert alert-danger' role='alert'><i class='fas fa-exclamation-triangle'></i> Please select a <strong>ROLE</strong> first.</div>"
            userroleerrors.html(results)
        }
    })

    userroleslist.on("click",".deleteuserrole",function(e){
        e.preventDefault();
        var id = $(this).attr('data-id')
        var parent = $(this).parent("td").parent("tr")
        var itemname=parent.find("td").eq(0).text()
        var userid=useridfield.val()
        bootbox.dialog({
            title: "Confirm Role Removal!",
            message: "Remove <strong>"+itemname+"</strong> role from the user?",
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
                            "../controllers/useroperations.php",
                            {
                                userid:userid,
                                roleid:id,
                                removeuserrole:true
                            },
                            function(data){

                            }
                        )
                        parent.remove()
                        $('.bootbox').modal('hide');
                    }
                }
            }
        })
    })
})