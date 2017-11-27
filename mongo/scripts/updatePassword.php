<?php
include 'db-functions.php';
include 'user.php';
include 'customer.php';
include 'owner.php';
session_start();
$UserCollection = $mongoConnection->selectCollection('swiftmeal', 'user');

function status() {
    global $UserCollection;

    $userObj =$_SESSION['Obj'];
    $result;

    if(isset($_POST['newPW']) && !empty($_POST['newPW'])) {
        $password = sha1($_POST['newPW']);
        $userId = $userObj->getUser_id();
        $UserCollection->updateOne(['_id' => $userId],
        ['$set' => ['UP' => $password]]);
        $count = $collection->count(
            [
                '_id' => $userID,
                'UP' => $password,
            ],
            []
        );
        if($count == 1) {
            $result = true;
        } else {
            $result = false;
        }
    }
    return $result;
}
echo json_encode(status());

?>