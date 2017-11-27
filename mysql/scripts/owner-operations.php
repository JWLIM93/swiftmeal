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
        case 'getRestaurants': GetRestaurants($OwnerID,$conn);break;
        case 'getReserveLikes': GetReservationLikes($_GET['restid'],$conn);break;
        case 'getReviews': GetReviewDetails($_GET['restid'],$conn);break;
        case 'getReservations': GetReservations($_GET['restid'],$conn);break;
        case 'accept' : AcceptReservation($_GET['BID'], $conn);break;
        case 'deny' : DenyReservation($_GET['BID'], $conn);break;
        case 'deleteRestaurant' : DeleteRestaurant($_GET['restid'], $conn);break;
        case 'addRestaurant' : AddRestaurant($OwnerID, $_GET['block'],$_GET['building'],$_GET['floor'],$_GET['street'],$_GET['unit'],$_GET['lat'],$_GET['long'],$_GET['postal'],$_GET['restname'],$_GET['area'],$conn);break;
        default: break;
    }
}

function GetRestaurants($ownid,$con){
    $Restaurants = array();
    $GetRestaurantQuery = "SELECT p.Street AS street, r.RestaurantID AS restid, r.RestaurantName AS name FROM place AS p, restaurant AS r WHERE r.OwnerID = '".$ownid."' AND r.PlaceID=p.PlaceID AND r.isValid = 1";
    $queryrun = mysqli_query($con, $GetRestaurantQuery);
    while ($row = mysqli_fetch_array($queryrun)) {
        $temprest= (array('Street'=>$row['street'],'RestID'=>$row['restid'],'Restname'=>$row['name']));
        array_push($Restaurants, $temprest);
    }
    echo json_encode(array('Restaurants'=>$Restaurants));
}

function GetReservationLikes($restid,$con){
    $GetDetails = "SELECT r.CountLikes AS likes, r.CountDislikes AS dislikes, COUNT(res.RestaurantID) AS count FROM reservation AS res, restaurant AS r WHERE r.RestaurantID='".$restid."' AND r.RestaurantID=res.RestaurantID AND res.isFulfilled=0 AND res.isValid=1"; 
    $queryrun = mysqli_query($con, $GetDetails);
    $row = mysqli_fetch_array($queryrun);
    $ReserveLikes = (array('Likes'=>$row['likes'],'DisLikes'=>$row['dislikes'],'Count'=>$row['count']));
    echo json_encode(array('ReserveLikes'=>$ReserveLikes));
}

function GetReviewDetails($restid,$con){
    $Reviews = array();
    $GetReviews = "SELECT u.Name AS name, r.content AS content, r.DateReviewed AS date, r.TimeReviewed AS time, r.ReviewID AS id FROM customer AS c, review AS r, user AS u WHERE r.RestaurantID = '".$restid."' AND r.CustomerID=c.CustomerID AND c.UID=u.UID";
    $queryrun = mysqli_query($con, $GetReviews);
    while ($row = mysqli_fetch_array($queryrun)) {
        $tempreviews = (array('Name'=>$row['name'],'Content'=>$row['content'],'Date'=>$row['date'],'Time'=>$row['time'],'RID'=>$row['id']));
        array_push($Reviews, $tempreviews);
    }
    echo json_encode(array('Reviews'=>$Reviews));
}

function GetReservations($restid, $con){
    $Reservations = array();
    $GetReservations = "SELECT u.Name AS name, r.Pax AS pax, r.DateReserved AS date, r.TimeReserved AS time, r.BookingID AS bid FROM user AS u, reservation AS r, customer AS c WHERE r.RestaurantID='".$restid."' AND r.CustomerID = c.CustomerID AND c.UID=u.UID AND r.isFulfilled=0 AND r.isValid=1";
    $queryrun = mysqli_query($con, $GetReservations);
    while ($row = mysqli_fetch_array($queryrun)) {
        $tempreserve = (array('Name'=>$row['name'],'Pax'=>$row['pax'],'Date'=>$row['date'],'Time'=>$row['time'],'BID'=>$row['bid'],));
        array_push($Reservations, $tempreserve);
    }
    echo json_encode(array('Reservations'=>$Reservations));
}

function AcceptReservation($BID, $con){
    $Accept = "UPDATE reservation SET isFulfilled=1 WHERE BookingID='".$BID."'";
    mysqli_query($con, $Accept);
}

function DenyReservation($BID, $con){
    $Deny = "UPDATE reservation SET isValid=0 WHERE BookingID='".$BID."'";
    mysqli_query($con, $Deny);
}

function DeleteRestaurant($restid, $con){
    $Delete = "UPDATE restaurant SET isValid=0 WHERE RestaurantID='".$restid."'";
    mysqli_query($con, $Delete);
}

function AddRestaurant($ownid, $Block,$Building,$Floor,$Street,$Unit,$lat,$long,$postal,$restname,$area,$con){
    $PlaceID = PlaceIDGenerator();
    $RestID = RestIDGenerator();
    $InsertPlace = "INSERT INTO `place`(`PlaceID`, `Block`, `Building`, `Floor`, `Street`, `Unit`,`GeoLat`, `GeoLong`, `DateAdded`, `TimeAdded`,`PostalCode`) VALUES ('".$PlaceID."','".$Block."','".$Building."','".$Floor."','".$Street."','".$Unit."','".$lat."','".$long."','" . date("Y-m-d") . "','" . date("h:i:s") . "','".$postal."')";
    mysqli_query($con, $InsertPlace);
    $InsertRest = "INSERT INTO `restaurant`(`PlaceID`, `RestaurantID`, `OwnerID`, `RestaurantName`, `CountLikes`, `CountDislikes`, `isValid`) VALUES ('".$PlaceID."','".$RestID."','".$ownid."','".$restname."',0,0,1)";
    mysqli_query($con, $InsertRest);
    $GetAreaID = "SELECT AreaID FROM area WHERE AreaName='".$area."'";
    $queryrun = mysqli_query($con, $GetAreaID);
    $row = mysqli_fetch_array($queryrun);
    $InsertPlaceArea = "INSERT INTO `placearea`(`PlaceID`, `AreaID`, `isValid`) VALUES ('".$PlaceID."','".$row[0]."',1)";
    mysqli_query($con, $InsertPlaceArea);
    $IncrementArea = "UPDATE area SET PlaceCount=PlaceCount+1 WHERE AreaID='".$row[0]."'";
    mysqli_query($con, $IncrementArea);
}


function PlaceIDGenerator(){
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $string = '';
    $max = strlen($characters) - 1;
    for ($i = 0; $i < 19; $i++) {
         $string .= $characters[mt_rand(0, $max)];
    }
    return $string;
}

function RestIDGenerator(){
    $characters = '0123456789';
    $string = '';
    $max = strlen($characters) - 1;
    for ($i = 0; $i < 9; $i++) {
         $string .= $characters[mt_rand(0, $max)];
    }
    return $string;
}

?>