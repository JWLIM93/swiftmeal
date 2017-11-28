<?php
//Connect to DB
require_once __DIR__ . "/vendor/autoload.php";

$mongoConnection;
connect_db();

function connect_db(){
    global $mongoConnection;

    try {
        $mongoConnection = new MongoDB\Client('mongodb://47.88.157.236');
    } catch (MongoDB\Driver\Exception\Exception $e) {

        $filename = basename(__FILE__);
        
        echo "The $filename script has experienced an error.\n"; 
        echo "It failed with the following exception:\n";
        
        echo "Exception:", $e->getMessage(), "\n";
        echo "In file:", $e->getFile(), "\n";
        echo "On line:", $e->getLine(), "\n";       
    }
}
//check prefix
function checkPrefix($word){
    $prefix = substr($word, 0,5);
    if ($prefix == 'UCUST'){
        return 0;
    }
    else if($prefix == 'UREST'){
        return 1;
    }
}

// Login
function loginUser($email,$password){
    //check for user in user table if it exist.
    global $mongoConnection;

    $collection = $mongoConnection->selectCollection('swiftmeal', 'user');
    
    $cursor = $collection->find(
        [
            'Email' => $email,
            'UP' => $password,
        ],
        [
            'limit' => 1,
        ]
    );
    foreach ($cursor as $user) {
        if ($user["Type"] == "Customer") {
            if ($user["Details"]["isValid"] == 1) {
                session_start();
                $name = $user["Name"];
                $contact_no = $user["MobileNo"];
                $cust_id = $user["Details"]["CustomerID"];
                $custSession = new customer($user["_id"],$name,$email,$password,$contact_no,'login',$cust_id,1);
                $collection->updateOne(['_id' => $user["_id"]],
                ['$set' => ['IsOnline' => 1]]);
                $_SESSION['Obj'] = $custSession;
            } 
            else {
                echo "Account doesn't exist";
            }
        } else if ($user["Type"] == "Owner") {
            if ($user["Details"]["isValid"] == 1) {
                session_start();
                $name = $user['Name'];
                $contact_no = $user['MobileNo'];
                $owner_id = $user["Details"]["OwnerID"];
                $ownerSession = new owner($user["_id"],$name,$email,$password,$contact_no,'login',$owner_id,1);
                $collection->updateOne(['_id' => $user["_id"]],
				['$set' => ['IsOnline' => 1]]);
                $_SESSION['Obj'] = $ownerSession;
            } else {
                echo "Account doesn't exist";
            }
        } else {
            echo "Login Failed.";
            session_destroy();
        }
    }
}

//logout
function logOut($userID){
    global $mongoConnection;

    $collection = $mongoConnection->selectCollection('swiftmeal', 'user');
    
    $collection->updateOne(['_id' => $userID],
    ['$set' => ['IsOnline' => 0]]);
}

//Validate user registration
function validateCustRegister($userObj){
    global $mongoConnection;
    $collection = $mongoConnection->selectCollection('swiftmeal', 'user');
    $email = $userObj->getEmail();
    $emailquery = ['Email'=>$email];
    $document = $collection->findOne($emailquery);

    if(gettype($document) != "NULL") {
        echo "ToDo: User already exist, validation alert";
    }
    else{
        $fullName = $userObj->getFullName();
        $password = $userObj->getPassword();
        $phonenumber = $userObj->getPhone_number();
        $user_id = $userObj->getUser_id();
        $cust_id = $userObj->getCustID();
        $active = $userObj->isActive();
        //-------------------------------------
        $collection->insertOne([
                '_id' => $user_id,
                'UP' => $password,
                'Name' => $fullName,
                'Email' => $email,
                'MobileNo' => $phonenumber,
                'IsOnline' => 0,
                'Type' => "Customer",
                'Details' => ['CustomerID' => $cust_id, 'isValid' => 1],
                'FriendRequest' => [],
                'UsersPair' => [],
        ]);
    }
    $collection2 = $mongoConnection->selectCollection('swiftmeal', 'customer');
    $collection2->insertOne([
                '_id' => $cust_id,
                'Requests' => [],
                'Reservations' => [],
                'UserRecommendations' => []
        ]);
}
//validate Owner Reigster
function validateOwnerRegister($ownerObj){
    global $mongoConnection;
    $collection = $mongoConnection->selectCollection('swiftmeal', 'user');
    $email = $ownerObj->getEmail();
    $emailquery = ['Email'=>$email];
    $document  =  $collection->findOne($emailquery);
    if(gettype($document) != "NULL") {
        echo "ToDo: User already exist, validation alert";
    }
    else{
        $fullName = $ownerObj->getFullName();
        $password = $ownerObj->getPassword();
        $phonenumber = $ownerObj->getPhone_number();
        $user_id = $ownerObj->getUser_id();
        $owner_id = $ownerObj->getOwnerID();
        $active = $ownerObj->isActive();
        $collection->insertOne([
                '_id' => $user_id,
                'UP' => $password,
                'Name' => $fullName,
                'Email' => $email,
                'MobileNo' => $phonenumber,
                'IsOnline' => 0,
                'Type' => "Owner",
                'Details' => ['OwnerID' => $owner_id, 'isValid' => 1],
                'FriendRequest' => [],
                'UsersPair' => [],
        ]);
    }
}
//getArea
function getAreas(){
    global $mongoConnection;
    $array = array();
    $collection = $mongoConnection->selectCollection('swiftmeal', 'area');
    $document = $collection->find([],['sort' => ['AreaName' => 1]]);

    foreach($document as $row) {
        $area = new Area($row['_id'],$row['AreaName'],$row['PlaceCount'],$row['DefaultLat'],$row['DefaultLong']);
        array_push($array,$area);
    }
    return $array;
}

function generateRandomID() {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomID = '';
    for ($i = 0; $i < 16; $i++) {
        $randomID .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomID;
}
?>