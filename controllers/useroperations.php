<?php
    require_once('../models/user.php');
    $user=new user();
    if(isset($_GET['loginuser'])){
        $username=$_GET['username'];
        $password=$_GET['password'];
        echo json_encode($user->LoginUser($username,$password));
    }

    if(isset($_GET['getobjects'])){
        if(isset($_GET['moduleid'])){
            $moduleid=$_GET['moduleid'];
        }else{
            $moduleid=0;
        }
        echo $user->getObjects($moduleid);
    }

    if(isset($_GET['getuserslist'])){
        echo $user->getUsersList();
    }
    
    if(isset($_GET['getuserroles'])){
        $userid=$_GET['userid'];
        echo $user->getUserRoles($userid);
    }
    
    if(isset($_GET['getusersdetails'])){
        $userid=$_GET['userid'];
        $username=$user->getUsernameFromUserId($userid);
        echo $user->getUserDetails($username);
    }

    if(isset($_GET['getuserprivileges'])){
        $userid=$_GET['userid'];
        echo $user->getUserPrivileges($userid);
    }

    if(isset($_POST['saveuser'])){
        $userid=$_POST['userid'];
        $username=$_POST['username'];
        $password=md5($_POST['password']);
        $email=$_POST['email'];
        $mobile=$_POST['mobile'];
        $firstname=$_POST['firstname'];
        $middlename=$_POST['middlename'];
        $lastname=$_POST['lastname'];
        $systemadmin=$_POST['systemadmin'];
        $changepasswordonlogon=$_POST['changepasswordonlogon'];
        $accountactive=$_POST['accountactive'];
        $refno=mt_rand(1000,9999);
        $category='user';

        $tableData = stripcslashes($_POST['TableData']);
        // Decode the JSON array
        $tableData = json_decode($tableData,TRUE);
        // save the user and return user id
        $userid= $user->saveUser($userid,$username,$password,$firstname,$middlename,$lastname,$mobile,$email,$systemadmin,$accountactive,$changepasswordonlogon);
    
        if(is_numeric($userid)){
            foreach($tableData as $userprivilege){
                $objectid=$userprivilege['id'];
                $valid=$userprivilege['valid'];
                $user->saveTempPrivileges($refno,$userid,$objectid,$valid);
            }
            echo $user->savePrivileges($refno,$userid,$category);
        }else{
            echo $userid;
        } 
   }

   if(isset($_GET['getroles'])){
       $user->getRoles();
   }

   if(isset($_GET['getroleusers'])){
       $roleid=$_GET['roleid'];
       $user->getRoleUsers($roleid);
   }

   if(isset($_POST['saverole'])){
       $category='role';
       $roleid=$_POST['roleid'];
       $rolename=$_POST['rolename'];
       $roledescription=$_POST['roledescription'];
       $refno=mt_rand(1000,9999);
       $tableData = stripcslashes($_POST['TableData']);
       // Decode the JSON array
       $tableData = json_decode($tableData,TRUE);
       // save the role
       $roleid=$user->saveRole($roleid,$rolename,$roledescription);
       if(is_numeric($roleid)){
            foreach($tableData as $roleprivilege){
                $objectid=$roleprivilege['id'];
                $valid=$roleprivilege['valid'];
                $user->saveTempPrivileges($refno,$roleid,$objectid,$valid);
            }
            echo $user->savePrivileges($refno,$roleid,$category);
       }else{
           echo $roleid;
       }
   }

   if(isset($_GET['getroledetails'])){
       $roleid=$_GET['roleid'];
       $user->getRoleDetails($roleid);
   }

   if(isset($_GET['getroleprivileges'])){
       $roleid=$_GET['roleid'];
       $user-> getRolePrivileges($roleid);
   }
   if(isset($_GET['getrolesforassignment'])){
       $user->getRolesForAssignment();
   }
   if(isset($_GET['getusernonroles'])){
       $userid=$_GET['userid'];
       $user->getUserNonRoles($userid);
   }
   if(isset($_POST['saveuserroles'])){
    $userid=$_POST['userid'];
    $tableData = stripcslashes($_POST['TableData']);
    // Decode the JSON array
    $tableData = json_decode($tableData,TRUE);
    foreach($tableData as $userrole){
        $roleid=$userrole['roleid'];
        $user->addUserToRole($userid,$roleid);
    }
    echo "success";
   }
   if(isset($_POST['removeuserrole'])){
       $userid=$_POST['userid'];
       $roleid=$_POST['roleid'];
       $user->removeUserRole($userid,$roleid);
   }
   if(isset($_GET['getloggedinusername'])){
        echo json_encode($_SESSION['username']);
   }
   if(isset($_GET['logout'])){
        $user->logoffUser();
        //redirect to the login page
        header('Location: ../index.php'); 
    }   

?>