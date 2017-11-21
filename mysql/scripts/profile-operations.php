<?php
include 'db-functions.php';
include 'owner.php';
session_start();
$owner = $_SESSION['Obj'];
$conn = connect_db();
$UID = $owner->getUser_id(); 
$OwnerID = $owner->getOwnerID();

if(isset($_POST['action']) && !empty($_POST['action'])){
    $action=$_POST['action'];
    switch($action){
        case 'changepw': ChangePassword($_GET['OLDPW'],$UID,$_GET['PW'],$owner,$conn);break;
        case 'editProfileInformation': editProfile($_GET['name'],$_GET['email'],$_GET['mobile'],$UID,$conn);break;
        default: break;
    }
}

function ChangePassword($oldpassword,$uid,$password,$object,$con){
	global $owner;
    $oldpw = sha1($oldpassword);
    $pw = sha1($password);
    $checkoldpw = "SELECT UP FROM user WHERE UID='".$uid."'";
    $check = mysqli_query($con, $checkoldpw);
    $row = mysqli_fetch_array($check);
    if($row[0]!=$oldpw){
        echo "fail";
    }
    else{
        $object->setPassword($password);
        $editSql = "UPDATE user SET UP='".$pw."' WHERE UID='".$uid."'";
        mysqli_query($con, $editSql);
		$owner->setPassword($pw);
		$_SESSION['Obj'] = $owner;
        echo "succeed";
    }
}

function editProfile($name,$email,$mobileNo,$uid,$con){
	if($name != "" || $email != "" || $mobileNo != ""){
		global $owner;
		if($name != ""){			
			$updateNameSQL = "UPDATE user SET Name='".$name."' WHERE UID='".$uid."'";
			$owner->setFullName($name); 
			mysqli_query($con, $updateNameSQL);
		}
		if($email != ""){
			$updateEmailSQL = "UPDATE user SET Email='".$email."' WHERE UID='".$uid."'";
			$owner->setEmail($email); 
			mysqli_query($con, $updateEmailSQL);
		}
		if($mobileNo != ""){
			$mobileNoSQL = "UPDATE user SET MobileNo='".$mobileNo."' WHERE UID='".$uid."'";
			$owner->setPhone_number($mobileNo); 
			mysqli_query($con, $mobileNoSQL);
		}
		$_SESSION['Obj'] = $owner;
		echo "succeed";
	}else{
		echo "fail";
	}  
}

?>