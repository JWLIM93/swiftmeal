<?php
include 'db-functions.php';
include 'customer.php';
session_start();
$customer = $_SESSION['Obj'];
$conn = connect_db();
$UID = $customer->getUser_id(); //input session UID here

if(isset($_POST['action']) && !empty($_POST['action'])){
    $action=$_POST['action'];
    switch($action){
        case 'confirmRequest': confirmRequest($_GET['Requester'],$UID,$conn);break;
        case 'denyRequest': denyRequest($_GET['Deletee'],$UID,$conn);break;
        case 'friendRequest' :friendRequest($UID, $_GET['RequestEmail'], $conn);
        default: break;
    }
}
function friendRequest($Requester, $Requestee,$con){
    $getUID2 = "SELECT UID FROM user WHERE Email='" . $Requestee . "'";
    $query_run2 = mysqli_query($con, $getUID2);
    $Requestee = mysqli_fetch_array($query_run2);
    $Request = "INSERT INTO friendrequest(UID,RequestTo,isAccepted,RequestDate,RequestTime,isValid) VALUES ('" . $Requester . "','" . $Requestee[0] . "',0,'" . date("Y-m-d") . "','" . date("h:i:s") . "',1) ";
    if(mysqli_query($con, $Request)){
        echo "success";
    }
    else{
        echo "failed";
    }
}

function deleteFriend($Deleter,$Deletee,$con){
    $delete="UPDATE userspair SET isValid=0 WHERE UID='" . $Deleter . "' AND PUID='" . $Deletee . "' OR UID='" . $Deletee . "' AND PUID='" . $Deleter . "'";
    mysqli_query($con, $delete);
}

function confirmRequest($Requester,$Requestee,$con){
    $cfmRequest = "UPDATE friendrequest SET isAccepted=1, isValid=0 WHERE UID='" . $Requester . "' AND RequestTo='" . $Requestee . "'";
    mysqli_query($con, $cfmRequest);
    $createFriendPair = "INSERT INTO userspair(UID,PUID,isValid,PairedDate,PairedTime) VALUES('" . $Requester . "','" . $Requestee . "',1,'" . date("Y-m-d") . "','" . date("h:i:s") . "')";
    mysqli_query($con, $createFriendPair);
    $createFriendPair2 = "INSERT INTO userspair(UID,PUID,isValid,PairedDate,PairedTime) VALUES('" . $Requestee . "','" . $Requester . "',1,'" . date("Y-m-d") . "','" . date("h:i:s") . "')";
    mysqli_query($con, $createFriendPair2);
}

function denyRequest($Requester, $Requestee,$con){
    $cfmRequest = "UPDATE friendrequest SET isAccepted=0, isValid=0 WHERE UID='" . $Requester . "' AND RequestTo='" . $Requestee . "'";
    mysqli_query($con, $cfmRequest);
}

function showFriends($User, $con){
    $showFriends = "SELECT us.Name FROM userspair AS u, user AS us WHERE u.UID = '" . $User . "' AND u.PUID=us.UID AND u.isValid=1";
    $query_run = mysqli_query($con, $showFriends);
    while($row = mysqli_fetch_array($query_run)){
        echo $row[0];
    }
}

?>