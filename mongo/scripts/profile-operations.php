<?php
include 'db-functions.php';
include 'owner.php';
include 'customer.php';
session_start();
$owner = $_SESSION['Obj'];
$UID = $owner->getUser_id();
$UserCollection = $mongoConnection->selectCollection('swiftmeal', 'user'); 

if(isset($_POST['action']) && !empty($_POST['action'])){
    $action=$_POST['action'];
    switch($action){
        case 'changepw': ChangePassword($_GET['OLDPW'],$UID,$_GET['PW'],$owner,$conn);break;
        case 'editProfileInformation': editProfile($_GET['name'],$_GET['email'],$_GET['mobile'],$UID,$conn);break;
        case 'editProfileInformationCUST': editProfileCUST($_GET['name'],$_GET['email'],$_GET['mobile'],$UID,$conn);break;
        default: break;
    }
}

function ChangePassword($oldpassword,$uid,$password,$object,$con){
	global $owner;
	global $mongoConnection;
	global $UserCollection;

    $oldpw = sha1($oldpassword);
	$pw = sha1($password);

	$password = $UserCollection->find(
        [
            '_id' => $uid,
        ],
        [
			'projection' => [
				'UP' => 1
			]
        ]
    );
    if ($password["UP"] != $oldpw) {
		echo "FAIL";
	} else {
		$object->setPassword($password);
		$UserCollection->updateOne(['_id' => $uid],
		['$set' => ['UP' => $pw]]);
		$owner->setPassword($pw);
		$_SESSION['Obj'] = $owner;
	}
}

function editProfile($name,$email,$mobileNo,$uid,$con) {
	global $mongoConnection;
	global $UserCollection;

	if($name != "" || $email != "" || $mobileNo != "") {
		global $owner;
		if($name != "") {		
			$UserCollection->updateOne(['_id' => $uid],
			['$set' => ['Name' => $name]]);	
			$owner->setFullName($name); 
		}
		if($email != "") {
			$UserCollection->updateOne(['_id' => $uid],
			['$set' => ['Email' => $email]]);
			$owner->setEmail($email); 
		}
		if($mobileNo != "") {
			$UserCollection->updateOne(['_id' => $uid],
			['$set' => ['MobileNo' => $mobileNo]]);
			$owner->setPhone_number($mobileNo); 
		}
		$_SESSION['Obj'] = $owner;
		echo "succeed";
	} else {
		echo "fail";
	}
}


function editProfileCUST($name,$email,$mobileNo,$uid,$con) {
	global $mongoConnection;
	global $UserCollection;

	if($name != "" || $email != "" || $mobileNo != ""){
		global $owner;
		if($name != "") {		
			$UserCollection->updateOne(['_id' => $uid],
			['$set' => ['Name' => $name]]);		
			$owner->setFullName($name); 
			mysqli_query($con, $updateNameSQL);
		}
		if($email != "") {
			$UserCollection->updateOne(['_id' => $uid],
			['$set' => ['Email' => $email]]);
			$owner->setEmail($email); 
			mysqli_query($con, $updateEmailSQL);
		}
		if($mobileNo != "") {
			$UserCollection->updateOne(['_id' => $uid],
			['$set' => ['MobileNo' => $mobileNo]]);
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