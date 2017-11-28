<?php
include 'db-functions.php';
include 'owner.php';
session_start();
$owner = $_SESSION['Obj'];
$UID = $owner->getUser_id(); 
$OwnerID = $owner->getOwnerID();


if(isset($_POST['action']) && !empty($_POST['action'])){
    $action=$_POST['action'];
    switch($action){
        case 'getRestaurants': GetRestaurants($OwnerID);break;
        case 'getReserveLikes': GetReservationLikes($_GET['restid']);break;
        case 'getReviews': GetReviewDetails($_GET['restid']);break;
        case 'getReservations': GetReservations($_GET['restid']);break;
        case 'accept' : AcceptReservation($_GET['BID']);break;
        case 'deny' : DenyReservation($_GET['BID']);break;
        case 'deleteRestaurant' : DeleteRestaurant($_GET['restid']);break;
        case 'addRestaurant' : AddRestaurant($OwnerID, $_GET['block'],$_GET['building'],$_GET['floor'],$_GET['street'],$_GET['unit'],$_GET['lat'],$_GET['long'],$_GET['postal'],$_GET['restname'],$_GET['area'],$conn);break;
        default: break;
    }
}

function GetRestaurants($ownid){
    global $mongoConnection;
    $Restaurants = array();
    $placecollection = $mongoConnection->selectCollection('swiftmeal', 'place');
    $uidmatch = ['Details.OwnerID'=>$ownid];
    $document = $placecollection->find($uidmatch);
    foreach($document as $row){
        if ($row["Details"][0]["isValid"] == 1) {
            $temprest= (array('Street'=>$row['Street'],'RestID'=>$row['Details'][0]['RestaurantID'],'Restname'=>$row['Details'][0]['RestaurantName']));
            array_push($Restaurants, $temprest);
        }
    }
    echo json_encode(array('Restaurants'=>$Restaurants));
}

function GetReservationLikes($restid){
    global $mongoConnection;
    $placecount = 0;
    $placecollection = $mongoConnection->selectCollection('swiftmeal', 'place');
    $custcollection = $mongoConnection->selectCollection('swiftmeal', 'customer');
    $document2 = $custcollection->find([]);
    foreach($document2 as $row2){
        foreach($row2['Reservations'] as $reserve){
            if($reserve['RestaurantID']==$restid &&  ($reserve['isFulfilled']+$reserve['isValid']==1)){
                $placecount++;
            }
        }
    }
    $ridmatch = ['Details.RestaurantID'=>$restid];
    $document = $placecollection->find($ridmatch);
    foreach($document as $row){
        $ReserveLikes = (array('Likes'=>$row['Details'][0]['CountLikes'],'DisLikes'=>$row['Details'][0]['CountDislikes'],'Count'=>$placecount));
    }
    echo json_encode(array('ReserveLikes'=>$ReserveLikes));
}

function GetReviewDetails($restid){
    global $mongoConnection;
    $Reviews = array();
    $reviewinfo = array();
    $ridmatch = ['Details.RestaurantID'=>$restid];
    $placecollection = $mongoConnection->selectCollection('swiftmeal', 'place');
    $document = $placecollection->find($ridmatch);
    foreach($document as $row){
        foreach($row['Details'][0]['Reviews'] as $review){
            $reviewinfo[$review['CustomerID']]=['date'=>$review['DateReviewed'],'time'=>$review['TimeReviewed'],'content'=>$review['Content'],'restid'=>$row['Details'][0]['RestaurantID']];
        }
    }
    $usercollection = $mongoConnection->selectCollection('swiftmeal', 'user');
    $document2=$usercollection->find(['Type'=>'Customer']);
    foreach($document2 as $row2){
        if(array_key_exists($row2['Details']['CustomerID'], $reviewinfo)){
            $tempreviews = (array('Name'=>$row2['Name'],'Content'=>$reviewinfo[$row2['Details']['CustomerID']]['content'],'Date'=>$reviewinfo[$row2['Details']['CustomerID']]['date'],'Time'=>$reviewinfo[$row2['Details']['CustomerID']]['time'],'RID'=>$reviewinfo[$row2['Details']['CustomerID']]['restid']));
            array_push($Reviews, $tempreviews);
        }
    }
    echo json_encode(array('Reviews'=>$Reviews));
}

function GetReservations($restid){
    global $mongoConnection;
    $Reservations = array();
    $reserveinfo = array();
    $custinfo = array();
    $custcollection = $mongoConnection->selectCollection('swiftmeal', 'customer');
    $document = $custcollection->find([]);
    foreach($document as $row){
        foreach($row['Reservations'] as $reserve){
            if($reserve['RestaurantID']==$restid &&  ($reserve['isFulfilled']+$reserve['isValid']==1)){
                $reserveinfo[$reserve['BookingID']]=['cid'=>$row['_id'],'pax'=>$reserve['Pax'],'date'=>$reserve['DateReserved'],'time'=>$reserve['TimeReserved'],'bid'=>$reserve['BookingID']];
                array_push($custinfo, ['Details.CustomerID'=>$row['_id']]);
            }
        }
    }
    if(!empty($custinfo)){
        $usercollection = $mongoConnection->selectCollection('swiftmeal', 'user');
        $document2=$usercollection->find(['$or'=>$custinfo]);
        foreach($document2 as $row2){
            foreach($reserveinfo as $bookings){
                if($bookings['cid']==$row2['Details']['CustomerID']){
                    $tempreserve = (array('Name'=>$row2['Name'],'Pax'=>$bookings['pax'],'Date'=>$bookings['date'],'Time'=>$bookings['time'],'BID'=>$bookings['bid']));
                    array_push($Reservations, $tempreserve);
                }
            }
        }
    }
    echo json_encode(array('Reservations'=>$Reservations));
}

function AcceptReservation($BID){
    global $mongoConnection;
    $custcollection = $mongoConnection->selectCollection('swiftmeal', 'customer');
    $custcollection->updateOne(
            ['Reservations.BookingID' => $BID],
            ['$set' => ['Reservations.$.isFulfilled' => 1, 'Reservations.$.isValid' => 0]]
    );
}

function DenyReservation($BID){
    global $mongoConnection;
    $custcollection = $mongoConnection->selectCollection('swiftmeal', 'customer');
    $custcollection->updateOne(
            ['Reservations.BookingID' => $BID],
            ['$set' => ['Reservations.$.isValid' => 0, 'Reservations.$.isFulfilled' => 0]]
    );
}

function DeleteRestaurant($restid){
    global $mongoConnection;
    $placecollection = $mongoConnection->selectCollection('swiftmeal', 'place');
    $placecollection->updateOne(
            ['Details.RestaurantID' => $restid,'Details.isValid'=>1],
            ['$set' => ['Details.$.isValid' => 0]]
    );
}

function AddRestaurant($ownid, $Block,$Building,$Floor,$Street,$Unit,$lat,$long,$postal,$restname,$area){
    global $mongoConnection;
    $PlaceID = PlaceIDGenerator();
    $RestID = RestIDGenerator();
    $placecollection = $mongoConnection->selectCollection('swiftmeal', 'place');
    $areacollection = $mongoConnection->selectCollection('swiftmeal', 'area');
    $placecollection->insertOne([
                    '_id' => $PlaceID,
                    'Block' => $Block,
                    'Building' => $Building,
                    'Floor' => $Floor,
                    'Street' => $Street,
                    'Unit' => $Unit,
                    'GeoX' => NULL,
                    'GeoY' => NULL,
                    'GeoLat' => (double)$lat,
                    'GeoLong' => (double)$long,
                    'DateAdded' => date("Y-m-d"),
                    'TimeAdded' => date("h:i:s"),
                    'PostalCode' => (int)$postal,
                    'Type' => "Restaurant",
                    'Details' => []
            ]);
    $placecollection->updateOne(
                    ['_id' => $PlaceID],
                    ['$push' =>['Details' => ['RestaurantID' => $RestID, 'isValid' => 1, 'OwnerID' => $ownid, 'RestaurantName' => $restname, 'CountLikes' => 0, 'CountDislikes' => 0, 'Reviews' => []]]]
            );
    $areacollection->updateOne(
                    ['AreaName' => $area],
                    ['$push' => ['Places' => ['PlaceID' => $PlaceID, 'isValid' => 1]]]
            );
    $areacollection->updateOne(
                    ['AreaName' => $area],
                    ['$inc' => ['PlaceCount' => 1]]
            );
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