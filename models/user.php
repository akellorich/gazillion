<?php
    require_once("db.php");
    class user extends db{
        public function checkUser($userid,$field,$searchvalue){ 
            $sql="CALL spcheckuser({$userid},'{$field}','{$searchvalue}')";
            $rst=$this->getData($sql);   
            if($rst->rowCount()){
                return true;
            }else{
                return false;
            }         
        }

        public function saveUser($userid,$username,$password,$firstname,$middlename,$lastname,$mobile,$email,$systemadmin,$accountactive,$changepasswordonlogon){
            // check username
            if($this->checkUser($userid,'username',$username)){
                return "Sorry, the username is already in use.";
            }else if ($this->checkUser($userid,'email',$email)){
               //check email 
                return "Sorry, the email address is already in use.";
            }else if ($this->checkUser($userid,'mobile',$mobile)){
                // check mobile
                return "Sorry, the mobile phone number is already in use.";
            }else{
                $sql="CALL  spsaveuser({$userid},'{$password}',{$systemadmin},'{$username}','{$firstname}','{$middlename}','{$lastname}','{$email}','{$mobile}',{$changepasswordonlogon},{$accountactive},{$_SESSION['userid']})";
                // echo $sql."<br/>";
                $rst=$this->getData($sql);   
                //echo $sql."<br/>";
                $row=$rst->fetch(PDO::FETCH_ASSOC);
                return $row['userid'];
            }
        }

        public function getUserDetails($username){
            $sql="CALL spgetuserdetails('{$username}')";
            return $this->getJSON($sql);
        }
        public function LoginUser($username,$password){
            $sql="CALL spgetuserdetails('{$username}')";
            $rst=$this->getData($sql);
            if($rst->rowCount()>0){
                while ($row = $rst->fetch()) {
                    if($row['password'] == md5($password)){
                        if($row['accountactive']==true){
                            if($row['changepaswordonlogon']==true){
                                return "change password";
                            }else{
                                $_SESSION['userid']=$row['userid'];
                                $_SESSION['username']=$row['firstname'].' '.$row['middlename'];
                                return "success";
                            }
                            
                        }else{
                            return "account inactive";
                        } 
                    }else{
                        return "invalid credentials";
                    }
                }
            }else{
                return "invalid credentials";
            }
        }

        public function validateUserDetails($username,$password){
            $sql="CALL spgetuserdetails('{$username}')";
            $rst=$this->getData($sql);
            if($rst->rowCount()>0){
                while ($row = $rst->fetch()) {
                    if($row['password'] == md5($password)){
                        return "success";
                    }else{
                        return "invalid password";
                    }
                }
            }else{
                return "invalid username";
            }

        }

        public function changeUserPassword($username,$password,$changepasswordonlogon){
            $message=$this->validateUserDetails($username,$password);
            if($message=='success'){
                // change pasword
                $sql="CALL spchangeuserpassword('{$username}','{$password}',{$changepasswordonlogon})";
                $this->getData($sql);
                // echo success message
                echo "The password has been changed successfully.";
            }else{
                echo $message;
            }
        }

        public  function getUsernameFromUserId($userid){
            $sql="CALL spgetusernamefromuserid({$userid})";
            $rst=$this->getData($sql);
            if($rst->rowCount()){
                $row=$rst->fetch();
                return $row['username'];
            }else{
                return '';
            }
        }

        public function logOutUser(){
            session_destroy();
        }

        public function addUserToRole($userid,$roleid){
            $sql="CALL spsaveroleusers({$userid},{$roleid},{$_SESSION['userid']})";
            //echo $sql."<br/>";
            $rst=$this->getData($sql);
            if($rst){
                return "success";
            }
        }

        public function savePrivileges($refno,$userid,$category){
            // category is either user or role
            $sql="CALL spsaveprivileges({$userid},'{$category}','{$refno}',{$_SESSION['userid']})";
            //echo $sql."<br/>";
            $rst=$this->getData($sql);
            return "Success";
        }

        public function saveRole($roleid,$rolename,$roledescription){
           if($this-> checkRole($roleid,$rolename)){
               return "Sorry, the role is already in use within the system.";
           }else{
                $sql="CALL spsaverole({$roleid},'{$rolename}','{$roledescription}',{$_SESSION['userid']})";
                //echo $sql;
                $rst=$this->getData($sql);
                //if($rst->rowCount()){
                $row=$rst->fetch(PDO::FETCH_ASSOC);
                return $row['roleid'];
           }
        }

        public function changeUserAccountStatus($userid,$status,$reason,$username){
            $sql="CALL spchangeuseraccountstatus({$userid},'status','{$reason}',{$_SESSION['userid']})";
            $this->getData($sql);
            if($rst){
                echo "success";
            }
        }

        public function validateUserPrivilege($userid,$objectid){
            $sql="CALL spvalidateuserprivilege({$userid},{$objectid})";
            $rst=$this->getData($sql);
            if($rst->rowCount()){
            $row=$rst->fetch();
                $valid= $row['valid'];
                if($valid==1){
                    return true;
                }else{
                    return false;
                }
            }
        }

        public function saveTempPrivileges($refno,$id,$objectid,$valid){
            // id is either userid or role id
            $sql="CALL spsavetempprivilege('{$refno}',{$id},{$objectid},{$valid})";
            $rst=$this->getData($sql);
            if($rst){
                return 'success';
            }
        }

        public function checkRole($roleid,$rolename){
            $sql="CALL spcheckrole({$roleid},'{$rolename}')";
            $rst=$this->getData($sql);
            if($rst->rowCount()){
                return true;
            }else{
                return false;
            }     
        }

        public function getObjects($moduleid){
            $sql="CALL spgetobjects({$moduleid})";
            return $this->getJSON($sql);
        }

        public function getUsersList(){
            $sql="CALL spgetallusers()";
            return $this->getJSON($sql);
        }

        public function getUserRoles($userid){
            $sql="CALL spgetuserroles({$userid})";
            return $this->getJSON($sql);
        }

        public function  getUserPrivileges($userid){
            $sql="CALL spgetuserprivileges({$userid})";
            return $this->getJSON($sql);
        }

        public function getRoles(){
            $sql="CALL spgetroles()";
            echo $this->getJSON($sql);
        }

        public function getRoleUsers($roleid){
            $sql="CALL spgetroleusers({$roleid})";
            echo $this->getJSON($sql);
        }

        public function getRoleDetails($roleid){
            $sql="CALL spgetroledetails({$roleid})";
            echo $this->getJSON($sql);
        }

        public function getRolesForAssignment(){
            $sql="CALL spgetrolesforuserassignment()";
            echo $this->addUserToRolegetJSON($sql);

        }

        public function getRolePrivileges($roleid){
            $sql="CALL spgetroleprivileges({$roleid})";
            echo $this->getJSON($sql);
        }

        public function getUserNonRoles($userid){
            $sql="CALL spgetnonuserroles({$userid})";
            echo $this->getJSON($sql);
        }

        public function removeUserRole($userid,$roleid){
            $sql="CALL spremoveuserrole({$userid},{$roleid},{$_SESSION['userid']})";
            echo $sql."<br/>";
            return $this->getData($sql);
        }
        public function logoffUser(){
            session_unset();
        }
    }
?>