<?php
include 'db-functions.php';
include 'customer.php';
session_start();
$customer = $_SESSION['Obj'];
$conn = connect_db();
$UID = $customer->getUser_id(); //input session UID here
$CustID = $customer->getCustID();
$Rest=$customer->getRestID();

if(isset($_POST['action']) && !empty($_POST['action'])){
    $action=$_POST['action'];
    switch($action){
        case 'confirmRequest': confirmRequest($_GET['Requester'],$UID,$conn);break;
        case 'denyRequest': denyRequest($_GET['Deletee'],$UID,$conn);break;
        case 'friendRequest' :friendRequest($UID, $_GET['RequestEmail'], $conn);break;
        case 'SendMealRequest' :sendMealRequest($CustID,$_GET['Requester'],$Rest,$conn);break;
        case 'ReservePlace' :MakeReservation($CustID,$_GET['Pax'],$_GET['Time'],$_GET['Date'],$conn);break;
        case 'AcceptMealRequest' :ConfirmMealRequest($CustID,$_GET['Requester'],$_GET['PlaceID'],$conn);break;
        case 'DenyMealRequest' :DenyMealRequest($CustID,$_GET['Requester'],$_GET['PlaceID'],$conn);break;
        case 'ReservePlace2' :MakeReservation2($CustID,$_GET['Pax'],$_GET['Time'],$_GET['Date'],$conn);break;
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

function sendMealRequest($Requester,$Requestee,$RestID,$con){
    $getPlaceID = "SELECT PlaceID FROM restaurant WHERE RestaurantID='".$RestID."'";
    $placerun = mysqli_query($con, $getPlaceID);
    $PlaceID = mysqli_fetch_array($placerun);
    session_start();
    $customer = $_SESSION['Obj'];
    $customer->setPlaceID($PlaceID[0]);
    $getRequesteeCustID="SELECT CustomerID FROM customer WHERE UID='".$Requestee."'";
    $query_run = mysqli_query($con, $getRequesteeCustID);
    $RequesteeCID = mysqli_fetch_array($query_run);
    $MealRequest = "INSERT INTO request(CustomerID,RequestTo,PlaceID,RequestDate,RequestTime,isValid,isAccepted) VALUES('" . $Requester . "','" . $RequesteeCID[0] . "','" . $PlaceID[0] . "','" . date("Y-m-d") . "','" . date("h:i:s") . "',1,0)";
    if(mysqli_query($con, $MealRequest)){
        echo "succeed";
    }
    else{
        echo "fail";
    }
}

function MakeReservation($CustID,$Pax,$time,$date,$con){
    $customer = $_SESSION['Obj'];
    $PlaceID=$customer->getPlaceID();
    $RestID=$customer->getRestID();
    $UpdateRequestStatus="UPDATE request SET isAccepted=0 WHERE CustomerID='".$CustID."' AND PlaceID ='" .$PlaceID."'";
    mysqli_query($con, $UpdateRequestStatus);
    $BookingID = BookingIDGenerator($CustID);
    $Reserve = "INSERT INTO reservation(`BookingID`, `CustomerID`, `RestaurantID`, `Pax`, `DateReserved`, `TimeReserved`, `isValid`, `isFulfilled`, `DateCreated`, `TimeCreated`) VALUES ('".$BookingID."','".$CustID."','".$RestID."',$Pax,'" . $date . "','".$time."',1,0,'" . date("Y-m-d") . "','" . date("h:i:s") . "')";
    if(mysqli_query($con, $Reserve)){
        $customer->setBookingNum($BookingID);
        $customer->setBookingDate(date("Y-m-d"));
        $customer->setBookingTime(date("h:i:s"));
        $customer->setReservationTime($time);
        $customer->setReservationDate($date);
        $customer->setPax($Pax);
        echo "succeed";
    }
    else{
        echo "fail";
    }
}

function ConfirmMealRequest($CustID,$Requester,$PlaceID,$con){
    $updatemeal="UPDATE request SET isAccepted=1, isValid=0 WHERE CustomerID='".$Requester."' AND RequestTo='".$CustID."' AND PlaceID='".$PlaceID."'";
    mysqli_query($con, $updatemeal);
}

function DenyMealRequest($CustID,$Requester,$PlaceID,$con){
    $updatemeal="UPDATE request SET isAccepted=0, isValid=0 WHERE CustomerID='".$Requester."' AND RequestTo='".$CustID."' AND PlaceID='".$PlaceID."'";
    mysqli_query($con, $updatemeal);
}

function BookingIDGenerator($CustID){
    $prefix="RESV";
    $contact = rand(1000, 9999);
    $name = strtoupper(substr(str_replace(" ", "", $CustID),0,4));
    $ID = $prefix.date("is").$name.$contact;
    return $ID;
}

function MakeReservation2($CustID,$Pax,$time,$date,$con){
    session_start();
    $customer = $_SESSION['Obj'];
    $RestID=$customer->getRestID();
    $BookingID = BookingIDGenerator($CustID);
    $Reserve = "INSERT INTO reservation(`BookingID`, `CustomerID`, `RestaurantID`, `Pax`, `DateReserved`, `TimeReserved`, `isValid`, `isFulfilled`, `DateCreated`, `TimeCreated`) VALUES ('".$BookingID."','".$CustID."','".$RestID."',$Pax,'" . $date . "','".$time."',1,0,'" . date("Y-m-d") . "','" . date("h:i:s") . "')";
    if(mysqli_query($con, $Reserve)){
        $customer->setBookingNum($BookingID);
        $customer->setBookingDate(date("Y-m-d"));
        $customer->setBookingTime(date("h:i:s"));
        $customer->setReservationTime($time);
        $customer->setReservationDate($date);
        $customer->setPax($Pax);
        echo "succeed";
    }
    else{
        echo "fail";
    }
}

?>