<?php

//Connect to DB
function connect_db(){
        $serverName = "47.74.158.75";
        $username = "junwei";
        $password = "junwei";
        $dbName = "swiftmeal";
        
        $conn = new mysqli($serverName, $username, $password, $dbName);
        return $conn;
}
//check prefix
function checkPrefix($word){
    $prefix = substr($word, 0,4);
    if ($prefix == 'CUST'){
        return 0;
    }
    else if($prefix == 'REST'){
        return 1;
    }
}

// Login
function loginUser($email,$password){
    //check for user in user table if it exist.
    $loginSql = "SELECT * FROM user WHERE Email='$email' AND UP='$password'";
    $loginResult = connect_db()->query($loginSql) or die("Failed to query db".  mysqli_error('index.php')); 
    
    if(mysqli_num_rows($loginResult)==1){
        $loginData = mysqli_fetch_array($loginResult);
        $user_ID = $loginData['UID'];
        $userTypeCheck = checkPrefix($user_ID);
      
       
      
        if($userTypeCheck == 0){
            $checkValidCustomersql = "SELECT * FROM customer WHERE UID ='$user_ID'";
            $checkResult = connect_db()->query($checkValidCustomersql) or die("Fail to query db". mysqli_error('index.php'));
            if(mysqli_num_rows($checkResult)==1){
                $customerResult = mysqli_fetch_array($checkResult);
                $active = $customerResult['isValid'];
                if ($active ==1){
                    session_start();
                    $name = $loginData['Name'];
                    $contact_no = $loginData['MobileNo'];
                    $cust_id = $customerResult['CustomerID'];
                    $custSession = new customer($user_ID,$name,$email,$password,$contact_no,'login',$cust_id,1);
                    $isOnlinesql = "UPDATE user SET isOnline = '1' WHERE UID = '$user_ID'";
                    $isOnlineQuery = connect_db()->query($isOnlinesql) or die("Fail to query db".mysqli_error('index.php'));
                    $_SESSION['Obj'] = $custSession;
                    echo "Login in as Customer Welcome ". $custSession->getFullName();
                    
                }
                else{
                    Echo "Account doesn't Exisit";
                }
            }
        }
        else if($userTypeCheck == 1){
            $checkValidOwnersql = "SELECT * FROM restaurant_owner WHERE UID ='$user_ID'";
            $checkResult = connect_db()->query($checkValidOwnersql) or die("Fail to query db". mysqli_error('index.php'));
     
            if(mysqli_num_rows($checkResult)==1){
                $ownerResult = mysqli_fetch_array($checkResult);
                $active = $ownerResult['isValid'];
                if ($active ==1){
            
                    session_start();
                    $name = $loginData['Name'];
                    $contact_no = $loginData['ContactNo'];
                    $owner_id = $ownerResult['OwnerID'];
                    $ownerSession = new Owner($user_ID,$name,$email,$password,$contact_no,'login',$owner_id,1);
                    $_SESSION['Obj'] = $ownerSession;
                    echo "Login in as Owner Welcome ". $ownerSession->getFullName();
            
        }
        
    }
    
}
    }
    else{
        echo "Login Failed.";
        header( "refresh:5;url=../index.php" );
    }
}

//logout
function logOut($userID){
   $logOutSQL = "UPDATE user SET isOnline ='0' WHERE UID ='$userID'";
   $logOutResult = connect_db() ->query($logOutSQL) or die("unable to logout");
   
    
}
//Validate if user account exists when login.


//Validate user registration
function validateCustRegister($userObj){
    $email = $userObj->getEmail();
    $registerSql = "SELECT Email FROM user WHERE Email='$email'";
    
    $registerResult = connect_db()->query($registerSql) or die("validateRegister function fail");
    if (mysqli_num_rows($registerResult) >= 1){
        echo "ToDo: User already exist, validation alert";
    } else {
        //Can create account, insert all into DB.
        $fullName = $userObj->getFullName();
        $password = $userObj->getPassword();
        $phonenumber = $userObj->getPhone_number();
        $user_id = $userObj->getUser_id();
        $cust_id = $userObj->getCustID();
        $active = $userObj->isActive();
        //Name > Email > User_ID >> Pass > ContactNo > Valid
        $registerAccountSql = "INSERT INTO user (UID,UP,Name,Email,MobileNo) "
                . "VALUES ('$user_id', '$password', '$fullName','$email','$phonenumber')";
        $result = connect_db()->query($registerAccountSql) or die("Fail insert into user table - register");
        $insertOwner = "INSERT INTO customer(CustomerID,UID,isValid)"." VALUES ('$cust_id','$user_id','$active')";
        $resultOwner = connect_db()->query($insertOwner) or die ("Fail insert into owner table");
    }
}
//validate Owner Reigster
function validateOwnerRegister($ownerObj){
    $email = $ownerObj->getEmail();
    $registerSql = "SELECT Email FROM user WHERE Email='$email'";
    
    $registerResult = connect_db()->query($registerSql) or die("validateRegister function fail");
    if (mysqli_num_rows($registerResult) >= 1){
        echo "ToDo: User already exist, validation alert";
    } else {
        //Can create account, insert all into DB.
   
        $fullName = $ownerObj->getFullName();
        $password = $ownerObj->getPassword();
        $phonenumber = $ownerObj->getPhone_number();
        $user_id = $ownerObj->getUser_id();
        $owner_id = $ownerObj->getOwnerID();
        $active = $ownerObj->isActive();
        //Name > Email > User_ID >> Pass > ContactNo > Valid
        $registerAccountSql = "INSERT INTO user (UID,UP,Name,Email,MobileNo) "
                . "VALUES ('$user_id', '$password', '$fullName','$email','$phonenumber')";
        $result = connect_db()->query($registerAccountSql) or die("Fail insert into user table - register");
        
        $insertOwner = "INSERT INTO owner (OwnerID,UID,isValid)"." VALUES ('$owner_id','$user_id','$active')";
        $resultOwner = connect_db()->query($insertOwner) or die ("Fail insert into owner table");
                
    }
}

//getArea
function getAreas(){
    $array = array();
    $areaSQL = "SELECT * from area ORDER BY AreaName ASC ";
    $areaResult = connect_db()->query($areaSQL) or die(mysqli_error());
    while($row= mysqli_fetch_array($areaResult)){
        array_push($array,$row);
        
        
    }
    return $array;
    
}

function validateEditProfile($userObj){
    $email = $userObj->getEmail();
    $phone = $userObj->getPhone_number();
    $full_name = $userObj->getFullName();
    $userId = $userObj->getUser_id();
    $editSql = "UPDATE user SET Name='$full_name', Email='$email', MobileNo='$phone' WHERE UID='$userId'";
    $editResult = connect_db()->query($editSql) or die("validateEdit function fail");
}




?>