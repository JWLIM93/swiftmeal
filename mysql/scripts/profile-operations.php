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
        default: break;
    }
}

function ChangePassword($oldpassword,$uid,$password,$object,$con){
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
        echo "succeed";
    }
}


