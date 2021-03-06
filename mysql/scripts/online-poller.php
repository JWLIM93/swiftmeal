<?php

include 'db-functions.php';
include 'customer.php';
session_start();
$customer = $_SESSION['Obj'];
$conn = connect_db();
$CustID = $customer->getCustID();
$UID = $customer->getUser_id(); //input session UID here
$Place=$customer->getPlaceID();
//$OnlineFriends will be all the name and uid of friends who are online, $Requests
$OnlineFriends= array();
$MealRequests = array();
$FriendRequests = array();
$Friends = array();
$AcceptedMeals = array();
$RestHistory= array();
//Poll for Online Friends
$findfrens = "SELECT PUID FROM userspair WHERE UID = '" . $UID . "' AND isValid=1";
$countResult = mysqli_query($conn, $findfrens);
while ($row = mysqli_fetch_array($countResult)) {
    $findonline = "SELECT Name AS name FROM user WHERE UID = '" . $row[0] . "' AND isOnline=1";
    $OnlineResult = mysqli_query($conn, $findonline);
    $OnlineData = mysqli_fetch_array($OnlineResult);
    if($OnlineData['name']!=null){
        $OnlineFriendsTemp=(array('Name'=>$OnlineData['name'],'UID'=>$row[0]));
        array_push($OnlineFriends, $OnlineFriendsTemp);
    }
}
//Poll for Meal Requests
$findrequests = "SELECT u.Name AS name, r.CustomerID AS uid ,r.RequestDate AS date, r.RequestTime AS time, rest.RestaurantName AS restname , rest.PlaceID AS placeid, p.GeoLat AS lat, p.GeoLong AS lng, p.Street AS street, rest.RestaurantID AS id FROM place AS p, restaurant AS rest, request AS r, customer AS c, user AS u WHERE r.isValid=1 AND r.RequestTo = '" . $CustID . "' AND r.CustomerID=c.CustomerID AND c.UID=u.UID AND rest.PlaceID=r.PlaceID AND r.PlaceID=p.PlaceID";
$MealResult = mysqli_query($conn, $findrequests);
while ($row2 = mysqli_fetch_array($MealResult)) {
    $tempMeal = (array('Name'=>$row2['name'],'UID'=>$row2['uid'],'Date'=>$row2['date'],'Time'=>$row2['time'],'Restname'=>$row2['restname'],'PlaceID'=>$row2['placeid'],'Lat'=>$row2['lat'],'Long'=>$row2['lng'],'Street'=>$row2['street'],'RestID'=>$row2['id']));
    array_push($MealRequests,$tempMeal);
}
//Poll for Friend Requests
$friendRequest = "SELECT u.Name AS name, u.UID AS uid, RequestDate AS date FROM friendrequest AS f, user AS u WHERE f.RequestTo = '" . $UID . "' AND f.UID=u.UID AND f.isValid=1";
$RequestResult = mysqli_query($conn, $friendRequest);
while ($row3 = mysqli_fetch_array($RequestResult)) {
    $Requests=(array('Name'=>$row3['name'],'UID'=>$row3['uid'],'Date'=>$row3['date']));
    array_push($FriendRequests,$Requests);
}

// All Friends
$showFriends = "SELECT us.Name AS name, u.PairedDate AS date, us.UID AS uid FROM userspair AS u, user AS us WHERE u.UID = '" . $UID . "' AND u.PUID=us.UID AND u.isValid=1";
$query_run = mysqli_query($conn, $showFriends);
while($row4 = mysqli_fetch_array($query_run)){
    $FriendsTemp=(array('Name'=>$row4['name'],'Date'=>$row4['date'],'UID'=>$row4['uid']));
    array_push($Friends, $FriendsTemp);
}
//Poll for Accepted Meal Requests
$AcceptedMealRequests = "SELECT u.Name AS name, u.UID AS uid FROM request AS r, user AS u, customer AS c WHERE r.PlaceID='".$Place."'AND r.CustomerID='" . $CustID . "' AND r.isValid=0 AND r.isAccepted=1 AND c.CustomerID=r.RequestTo AND c.UID=u.UID";
$AcceptedRun = mysqli_query($conn, $AcceptedMealRequests);
while($row5=mysqli_fetch_array($AcceptedRun)){
    $AcceptMealsTemp = (array('Name'=>$row5['name'],'UID'=>$row5['uid']));
    array_push($AcceptedMeals, $AcceptMealsTemp);
}

//Poll for restaurants history
$history = "SELECT r.RestaurantID AS restid, p.Street AS street, r.RestaurantName AS name, res.DateReserved AS date, res.TimeReserved AS time FROM restaurant AS r, reservation AS res, place AS p WHERE res.CustomerID='" . $CustID . "' AND res.RestaurantID=r.RestaurantID AND res.isFulfilled=1 AND p.PlaceID=r.PlaceID";
$historyrun=mysqli_query($conn, $history);
while($row6=mysqli_fetch_array($historyrun)){
    $historytemp=(array('Restname'=>$row6['name'],'Date'=>$row6['date'],'Time'=>$row6['time'],'Street'=>$row6['street'],'RestID'=>$row6['restid']));
    array_push($RestHistory, $historytemp);
}

mysqli_close($conn);
echo json_encode(array('OnlineFriends'=>$OnlineFriends,'MealRequests'=>$MealRequests,'FriendRequests'=>$FriendRequests,'Friends'=>$Friends,'AcceptedMealRequests'=>$AcceptedMeals,'History'=>$RestHistory));
?>