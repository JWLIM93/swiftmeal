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

$usercollection = $mongoConnection->selectCollection('swiftmeal', 'user');
$custcollection = $mongoConnection->selectCollection('swiftmeal', 'customer');
$placecollection = $mongoConnection->selectCollection('swiftmeal', 'place');

//Poll for Online Friends and All Friends
$uidmatch = ['_id'=>$UID];
$onlinefilter = array();
$pairdates = array();
$document = $usercollection->find($uidmatch);
foreach ($document as $row){
    foreach($row['UsersPair'] as $friends){
        if($friends['isValid']==1){
            array_push($onlinefilter,['_id'=>$friends['PUID']]);
            $pairdates[$friends['PUID']]=$friends['PairedDate'];
        }
    }
}

if (!empty($onlinefilter)) {
    $document2 = $usercollection->find(['$or'=>$onlinefilter]);
    foreach($document2 as $row2){
        if($row2['IsOnline']==1){
            $OnlineFriendsTemp=(array('Name'=>$row2['Name'],'UID'=>$row2['_id']));
            array_push($OnlineFriends, $OnlineFriendsTemp);
        }
        $FriendsTemp=(array('Name'=>$row2['Name'],'Date'=>$pairdates[$row2['_id']],'UID'=>$row2['_id']));
        array_push($Friends, $FriendsTemp);
    }
}

//Poll for Meal Requests
$requestinfo = array();
$placeinfo = array();
$restaurantinfo = array();
$requesterinfo = array();
$document3 = $custcollection->find([]);
foreach($document3 as $row3){
    foreach($row3['Requests'] as $requests){
        if($requests['RequestTo']==$CustID && $requests['isValid']==1){
            $temprequest = ['placeid'=>$requests['PlaceID'],'uid'=>$row3['_id'],'date'=>$requests['RequestDate'],'time'=>$requests['RequestTime']];
            array_push($requestinfo, $temprequest);
            array_push($placeinfo, ['_id'=>$requests['PlaceID']]);
            array_push($requesterinfo,['Details.CustomerID'=>$row3['_id']]);
        }
    }
}

if (!empty($placeinfo)) {
    $document4 = $placecollection->find(['$or'=>$placeinfo]);
    foreach($document4 as $row4){
        $restaurantinfo[$row4['_id']]=['restname'=>$row4['Details'][0]['RestaurantName'], 'id'=>$row4['Details'][0]['RestaurantID'],'lat'=>$row4['GeoLat'],'lng'=>$row4['GeoLong'],'street'=>$row4['Street']];
    }
}

if (!empty($requestinfo)) {
    $document5 = $usercollection->find(['$or'=>$requesterinfo]);
    foreach($document5 as $row5){
        foreach($requestinfo as $meal){
            if($meal['uid']==$row5['Details']['CustomerID']){
                $tempMeal = (array('Name'=>$row5['Name'],'UID'=>$meal['uid'],'Date'=>$meal['date'],'Time'=>$meal['time'],'Restname'=>$restaurantinfo[$meal['placeid']]['restname'],'PlaceID'=>$meal['placeid'],'Lat'=>$restaurantinfo[$meal['placeid']]['lat'],'Long'=>$restaurantinfo[$meal['placeid']]['lng'],'Street'=>$restaurantinfo[$meal['placeid']]['street'],'RestID'=>$restaurantinfo[$meal['placeid']]['id']));
                array_push($MealRequests,$tempMeal);
            }
        }
    }
}

////Poll for Friend Requests
$document6= $usercollection->find([]);
foreach($document6 as $row6){
    foreach($row6['FriendRequest'] as $frequest){
        if($frequest['RequestTo']==$UID && $frequest['isValid']==1){
            $Requests=(array('Name'=>$row6['Name'],'UID'=>$row6['_id'],'Date'=>$frequest['RequestDate']));
            array_push($FriendRequests,$Requests);
        }
    }
}

//Poll for Accepted Meal Requests
$mealaccept = array();
$cuidmatch = ['_id'=>$CustID];
$document7= $custcollection->find($cuidmatch);
foreach($document7 as $row7){
    foreach($row7['Requests'] as $accept){
        if($accept['isAccepted']==1 && $accept['isValid']==0 && $accept['PlaceID']==$Place){
            array_push($mealaccept,['Details.CustomerID'=>$accept['RequestTo']]);
        }
    }
}

if (!empty($mealaccept)) {
    $document8=$usercollection->find(['$or'=>$mealaccept]);
    foreach ($document8 as $row8){
        $AcceptMealsTemp = (array('Name'=>$row8['Name'],'UID'=>$row8['_id']));
        array_push($AcceptedMeals, $AcceptMealsTemp);
    }
}

//Poll for restaurants history
$places = array();
$historyrest = array();
$document9= $custcollection->find($cuidmatch);
foreach($document9 as $row9){
    foreach($row9['Reservations'] as $reserve){
        if($reserve['isFulfilled']==1){
            $places[$reserve['RestaurantID']]=['date'=>$reserve['DateReserved'],'time'=>$reserve['TimeReserved']];
            array_push($historyrest,['Details.RestaurantID'=>$reserve['RestaurantID']]);
        }
    }
}

if (!empty($historyrest)) {
    $document10 = $placecollection->find(['$or'=>$historyrest]);
    foreach($document10 as $row10){
        $historytemp=(array('Restname'=>$row10['Details'][0]['RestaurantName'],'Date'=>$places[$row10['Details'][0]['RestaurantID']]['date'],'Time'=>$places[$row10['Details'][0]['RestaurantID']]['time'],'Street'=>$row10['Street'],'RestID'=>$row10['Details'][0]['RestaurantID']));
        array_push($RestHistory, $historytemp);
    }
}
echo json_encode(array('OnlineFriends'=>$OnlineFriends,'MealRequests'=>$MealRequests,'FriendRequests'=>$FriendRequests,'Friends'=>$Friends,'AcceptedMealRequests'=>$AcceptedMeals,'History'=>$RestHistory));
?>