<?php
include 'db-functions.php';
include 'user.php';
include 'customer.php';
include 'owner.php';
session_start();
$userObj = $_SESSION['Obj'];

function status() {
    global $userObj;
    global $mongoConnection;
    $UserCollection = $mongoConnection->selectCollection('swiftmeal', 'user');

    if(isset($_POST['currentPW']) && !empty($_POST['currentPW'])){
        $result = false;
        $userID = $userObj->getUser_id();
        $currentPassword = $_POST['currentPW'];
        $encryptedPassword = sha1($currentPassword);
        $count = $UserCollection->count(
            [
                '_id' => $userID,
                'UP' => $encryptedPassword,
            ]
        );
        if ($count == 1) {
            echo "success";
        }
        else {
            echo "fail";
        }
    }
}
status();
?>

