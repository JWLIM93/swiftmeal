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
    $Accept = "UPDATE reservation SET isValid=1 WHERE BookingID='".$BID."'";
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

















?>