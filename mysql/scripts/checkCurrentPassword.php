<?php
include 'db-functions.php';
include 'user.php';
include 'customer.php';
include 'owner.php';
session_start();
function status(){
$userObj =$_SESSION['Obj'];
if(isset($_POST['currentPW']) && !empty($_POST['currentPW'])){
    $result = false;
    $userID = $userObj->getUser_id();
    $currentPassword = $_POST['currentPW'];
    $encrpytedPassword = sha1($currentPassword);
    $checkCurrentPasswordSQL = "SELECT * from user WHERE UID='$userID' AND UP ='$encrpytedPassword'";
    $checkResult = connect_db()->query($checkCurrentPasswordSQL) or die("Failed to query db".  mysqli_error('index.php'));
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

