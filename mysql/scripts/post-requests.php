<?php
include 'customer.php';
include 'owner.php';
include 'db-functions.php';
session_start();
//Edit Profile
function editProfile(){
    
//---------------Remove comment this portion to test with session obj
   // $userType = $_POST['typeOfUser'];
   // $userDetails = $_SESSION['Obj'];
    $customer = $_SESSION['Obj'];
    $user_id = $customer->getUser_id();
    
    $email = $_POST['Email'];
    $phone_number = $_POST['Phone_number'];
    $full_name = $_POST['FullName'];

    if ($email != "" && $phone_number != "" && $full_name != ""){
   
            $editProf = new customer($user_id,$full_name,$email,"",$phone_number,'edit',"",1);
            validateEditProfile($editProf);
            header('Location: ../customer-home.php');
     
    } else {
        echo "ToDo: Message alert validation - blank name or email or phone number";
    } 
}




if(!empty($_POST) and isset($_POST['register'])){
    $password = $_POST['userPassword'];
    $retypePassword = $_POST['retypePassword'];
    if ($password != "" && $retypePassword != "" && $password === $retypePassword){
        $fullName = $_POST['usersName'];
        $email = $_POST['userEmail'];
        $phone_number = $_POST['userPhone'];
        if ($fullName != "" && $email != "" && $phone_number != ""){
            $userType = $_POST['typeOfUser'];
            if(strcmp($userType,"Customer")){
                $user_id = userIDGenerator($userType, $phone_number, $fullName);
                $cust_id = userIDGenerator($userType, $phone_number, $email);
                $password = sha1($password);
                $registerCustomer = new customer($user_id,$fullName,$email,$password,$phone_number,'register',$cust_id,1);
                validateCustRegister($registerCustomer);
            }
          
            else{
                $user_id = userIDGenerator($userType, $phone_number, $fullName);
                $owner_id = userIDGenerator($userType, $phone_number,$email);
                $password = sha1($password);
                $registerOwner = new owner($user_id,$fullName,$email,$password,$phone_number,'register',$owner_id,1);
                validateOwnerRegister($registerOwner);
            }
        
         
        } else {
            echo "ToDo: Message alert validation - blank name or email or phone number";
        }
        
    } else {
        echo "ToDo: Validation when user doesn't retype same pw for register.";
    }          
    header('Location: ../index.php');
}
else if(!empty($_POST) and isset($_POST['login'])){
    $email = $_POST['userEmail'];
    $password = $_POST['userPassword'];
    $password = sha1($password);
    loginUser($email, $password);
    if(isset($_SESSION)){
    $sessionObj=$_SESSION['Obj'];
     if ($sessionObj instanceof customer){
         header('Location: ../customer-home.php');
     }
     elseif($sessionObj instanceof owner){
         header('Location: ../owner_index.php');
     }
    }else{
        header('Location: ../index.php');
    }
     
    
}
else if(!empty($_POST) && isset($_POST['edit'])){
    editProfile();
}


//user id genreator    
function userIDGenerator($user,$contact,$name){
    $prefix="";
    if (strcmp($user,"Customer")){
        $prefix="CUST";
    }
    else if (strcmp($user,"Owner")){
        $prefix="REST";
    }
    $contact = substr($contact,0,4);
    $name = strtoupper(substr(str_replace(" ", "", $name),0,4));
    $ID = $prefix.date("is").$name.$contact;
    return $ID;
}
?>