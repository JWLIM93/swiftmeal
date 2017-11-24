<?php
include 'db-functions.php';
include 'user.php';
include 'customer.php';
include 'owner.php';
session_start();
function status(){
$userObj =$_SESSION['Obj'];
if(isset($_POST['newPW']) && !empty($_POST['newPW'])){
    $password = sha1($_POST['newPW']);
    $userId = $userObj->getUser_id();
    $editSql = "UPDATE user SET UP='$password' WHERE UID='$userId'";
    $editResult = connect_db()->query($editSql) or die("validateEdit function fail");
    $checkPasswordSQL = "SELECT * from user WHERE UID='$userID' AND UP ='$password'";
    $checkResult = connect_db()->query($checktPasswordSQL) or die("Failed to query db".  mysqli_error('index.php'));
    if(mysqli_num_rows($checkResult)==1){
        $result= true;
    }
    else {
        $result =false;
    }
}
return $result;
}
echo json_encode(status());



?>