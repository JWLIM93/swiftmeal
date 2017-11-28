<?php
include 'db-functions.php';
include 'customer.php';
session_start();
$customer = $_SESSION['Obj'];
$UID = $customer->getUser_id(); //input session UID here
$CustID = $customer->getCustID();
$Rest=$customer->getRestID();
$con = $mongoConnection->selectCollection('swiftmeal', 'user');
$placeCon = $mongoConnection->selectCollection('swiftmeal', 'place');
$customerCon = $mongoConnection->selectCollection('swiftmeal', 'customer');

if(isset($_POST['action']) && !empty($_POST['action'])){
    $action=$_POST['action'];
    switch($action){
        case 'confirmRequest': confirmRequest($_GET['Requester'],$UID);break;
        case 'denyRequest': denyRequest($_GET['Deletee'],$UID);break;
        case 'friendRequest' :friendRequest($UID, $_GET['RequestEmail']);break;
        case 'SendMealRequest' :sendMealRequest($CustID,$_GET['Requester'],$Rest);break;
        case 'ReservePlace' :MakeReservation($CustID,$_GET['Pax'],$_GET['Time'],$_GET['Date']);break;
        case 'AcceptMealRequest' :ConfirmMealRequest($CustID,$_GET['Requester'],$_GET['PlaceID']);break;
        case 'DenyMealRequest' :DenyMealRequest($CustID,$_GET['Requester'],$_GET['PlaceID']);break;
        case 'ReservePlace2' :MakeReservation2($CustID,$_GET['Pax'],$_GET['Time'],$_GET['Date'],$_GET['placeid'],$_GET['restid']);break;
        default: break;
    }
}
function friendRequest($Requester, $Requestee) {
    global $con;
    $requesteeId;

    $RequesteeUID = $con->find(
        [
            'Email' => $Requestee,
        ],
        [
            'limit' => 1,
			'projection' => [
				'_id' => 1
			]
        ]
    );

    foreach ($RequesteeUID as $rid) {
        $requesteeId = $rid["_id"];
    }

    $updateResult = $con->updateOne(
        ['_id' => $Requester],
        ['$push' => ['FriendRequest' => ['RequestTo' => $requesteeId, 'isAccepted' => 0, 'RequestDate' => date("Y-m-d"), 'RequestTime' => date("h:i:s"), 'isValid' => 1]]]);

    if ($updateResult->getModifiedCount() == 0) {
        echo "failed";
    } else {
        echo "success";
    }
}

function deleteFriend($Deleter,$Deletee) {
    global $con;

    $updateResult = $con->updateOne(
        [$OR => [['_id' => $Deleter, 'PUID' => $Deletee],['_id' => $Deletee, 'PUID' => $Deleter]]],
        ['$set' =>['Type.$.isValid' => 0]]
    );
}

function confirmRequest($Requester,$Requestee) {
    global $con;

    $updateResult = $con->updateOne(
        ['_id' => $Requester, 'FriendRequest.RequestTo' => $Requestee, 'FriendRequest.isValid' => 1, 'FriendRequest.isAccepted' => 0],
        ['$set' => ['FriendRequest.$.isAccepted' => 1, 'FriendRequest.$.isValid' => 0]]);

    if ($updateResult->getModifiedCount() == 1) {
        $con->updateOne(
            ['_id' => $Requester],
            ['$push' =>['UsersPair' => ['PUID' => $Requestee, 'isValid' => 1, 'PairedDate' => date("Y-m-d"), 'PairedTime' => date("h:i:s")]]]);

        $con->updateOne(
            ['_id' => $Requestee],
            ['$push' =>['UsersPair' => ['PUID' => $Requester, 'isValid' => 1, 'PairedDate' => date("Y-m-d"), 'PairedTime' => date("h:i:s")]]]);
    }
}

function denyRequest($Requester, $Requestee) {
    global $con;

    $con->updateOne(
        ['_id' => $Requester, 'FriendRequest.RequestTo' => $Requestee, 'FriendRequest.isValid' => 1],
        ['$set' => ['FriendRequest.$.isAccepted' => 0, 'FriendRequest.$.isValid' => 0]]);
}

function sendMealRequest($Requester,$Requestee,$RestID) {
    global $placeCon;
    global $con;
    global $customerCon;

    $pID;
    $cID;

    $PlaceID = $placeCon->find(
        [
            'Details.RestaurantID' => $RestID,
        ],
        [
            'limit' => 1,
			'projection' => [
                '_id' => 1
			]
        ]
    );

    foreach ($PlaceID as $id) {
        session_start();
        $customer = $_SESSION['Obj'];
        $customer->setPlaceID($id["_id"]);
        $pID = $id["_id"];
    }
    
    $CustomerID = $con->find(
        [
            '_id' => $Requestee,
        ],
        [
            'limit' => 1,
        ]
    );

    foreach ($CustomerID as $cid) {
        $cID = $cid["Details"]["CustomerID"];
    }

    $updateResult = $customerCon->updateOne(
        ['_id' => $Requester],
        ['$push' =>['Requests' => ['RequestTo' => $cID, 'isAccepted' => 0, 'RequestDate' => date("Y-m-d"), 'RequestTime' => date("h:i:s"), 'isValid' => 1, 'PlaceID' => $pID]]]
    );

    if ($updateResult->getModifiedCount() != 0) {
        echo "succeed";
    }
    else {
        echo "fail";
    }
}

function MakeReservation($CustID,$Pax,$time,$date){
    global $customerCon;
    session_start();
    $customer = $_SESSION['Obj'];
    $PlaceID=$customer->getPlaceID();
    $RestID=$customer->getRestID();
    
    $customerCon->updateOne(
        ['_id' => $CustID, 'PlaceID' => $PlaceID],
        ['$set' => ['Requests.$.isAccepted' => 0]]);

    $BookingID = BookingIDGenerator($CustID);

    $updateResult = $customerCon->updateOne(
        ['_id' => $CustID],
        ['$push' =>['Reservations' => ['BookingID' => $BookingID, 'RestaurantID' => $RestID, 'Pax' => (int)$Pax, 'DateReserved' => $date, 'TimeReserved' => $time, 'isValid' => 1, 'isFulfilled' => 0, 'DateCreated' => date("Y-m-d"), 'TimeCreated' => date("h:i:s")]]]
    );

    if($updateResult->getModifiedCount() != 0) {
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

function ConfirmMealRequest($CustID,$Requester,$PlaceID) {
    global $customerCon;

    $customerCon->updateOne(
        ['_id' => $Requester, 'RequestTo' => $CustID,'PlaceID' => $PlaceID],
        ['$set' => ['Requests.$.isAccepted' => 1, 'Requests.$.isValid' => 0]]);
}

function DenyMealRequest($CustID,$Requester,$PlaceID) {
    global $customerCon;

    $customerCon->updateOne(
        ['_id' => $Requester, 'RequestTo' => $CustID,'PlaceID' => $PlaceID],
        ['$set' => ['Requests.$.isAccepted' => 0, 'Requests.$.isValid' => 0]]);
}

function BookingIDGenerator($CustID){
    $prefix="RESV";
    $contact = rand(1000, 9999);
    $name = strtoupper(substr(str_replace(" ", "", $CustID),0,4));
    $ID = $prefix.date("is").$name.$contact;
    return $ID;
}

function MakeReservation2($CustID,$Pax,$time,$date,$PlaceID,$RestID){
    global $customerCon;

    $customer = $_SESSION['Obj'];
    
    $BookingID = BookingIDGenerator($CustID);

    $updateResult = $customerCon->updateOne(
        ['_id' => $CustID],
        ['$push' =>['Reservations' => ['BookingID' => $BookingID, 'RestaurantID' => $RestID, 'Pax' => $Pax, 'DateReserved' => $date, 'TimeReserved' => $time, 'isValid' => 1, 'isFulfilled' => 0, 'DateCreated' => date("Y-m-d"), 'TimeCreated' => date("h:i:s")]]]
    );

    if($updateResult->getModifiedCount() != 0) {
        $customer->setBookingNum($BookingID);
        $customer->setBookingDate(date("Y-m-d"));
        $customer->setBookingTime(date("h:i:s"));
        $customer->setReservationTime($time);
        $customer->setReservationDate($date);
        $customer->setPax($Pax);
        echo "succeed";
    }
    else {
        echo "fail";
    }
}

?>