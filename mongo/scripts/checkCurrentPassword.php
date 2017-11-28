<?php
include 'db-functions.php';
include 'user.php';
include 'customer.php';
include 'owner.php';
session_start();
$userObj = $_SESSION['Obj'];

function status() {
    $result = false;
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
            $result = true;
        }
        else {
            $result = false;
        }
    }
}
echo json_encode(status());
?>

