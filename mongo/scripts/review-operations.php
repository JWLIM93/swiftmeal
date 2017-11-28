<?php
include 'db-functions.php';
include 'customer.php';
session_start();
$customer = $_SESSION['Obj'];
$CustID = $customer->getCustID();
$con = $mongoConnection->selectCollection('swiftmeal', 'user');
$placeCon = $mongoConnection->selectCollection('swiftmeal', 'place');
$customerCon = $mongoConnection->selectCollection('swiftmeal', 'customer');

//List of variables i going to use
$reviewList = array();

if(isset($_POST['action']) && !empty($_POST['action'])){
    $action=$_POST['action'];
    switch($action){
        case 'reviewRequest': queryAllReview($_GET['RestaurantID']);break;
        case 'addReviews': insertCustomerReview($CustID,$_GET['restID'],$_GET['content']);break;
        case 'updateVoteStatus': voteStatus($_GET['reviewID'],$_GET['voteStatus']);break;   
        case 'updatelikes': LikeDisLike($_GET['flag'],$_GET['restID'],$_GET['count']);
        default: break;
    }
}
//queryAllReview(1);
//voteStatus($_GET['reviewID'],$_GET['voteStatus']);
/*
isValid isSpam isVisible
0		0		1
0		1		0
1		0		1
1		1		1
*/

//Query All Review
function queryAllReview($resturantID){
	global $reviewList;
	global $placeCon;
	global $con;
	$templikearray;

	$Place = $placeCon->find(
        [
			'Details.RestaurantID' => $resturantID
        ],
        []
	);

	foreach ($Place as $p) {
		$templikearray = (array('Likes'=>$p["Details"][0]["CountLikes"],'Dislikes'=>$p["Details"][0]["CountDislikes"]));

		foreach ($p["Details"][0]["Reviews"] as $reviews) {
			if ($reviews["isVisible"] == 1) {
				$Customer = $con->find([
					'_id' => $reviews["CustomerID"]
				], [
					'limit' => 1
				]);

				foreach ($Customer as $c) {
					$reviewTemp=(array('Name'=>$c["Name"],'ReviewID'=>$reviews['ReviewID'],'content'=>$reviews['Content'],'DateReviewed'=>$reviews['DateReviewed'],'TimeReviewed'=>$reviews['TimeReviewed'],'Upvote'=>(int)$reviews['Upvote'],'Downvote'=>(int)$reviews['Downvote'],'isValid'=>(int)$reviews['isValid'],'isSpam'=>(int)$reviews['isSpam'],'isVisible'=>(int)$reviews['isVisible']));
					array_push($reviewList, $reviewTemp);
				}
			} else {
				echo "";
			}
		}	
	}

	echo json_encode(array('Reviews'=>$reviewList,'Likes'=>$templikearray));
}

//Writing of Review
/*
1) CustomerID -> this must be the same as the CustomerID in customer table
2) RestaurantID -> this must be the same as the resturantID in resturant table
2) Content -> user input
3) DateReviewed  = todayData
4) TimeReviewed  = todayTime
5) upVote = 0
6) downVote = 0
7) isValid = 1
8) isSpam = 0
9) isVisible = 1
*/
//insertCustomerReview(1,'018960754',"hello HOLA");
function insertCustomerReview($custID,$restID,$content){
	global $placeCon;
	//Date , Time  , Generate ID
	$date = date("Y-m-d");
	$time = date("h:i:s");
	$uniqueId= ReviewIDGenerator($custID);

	$updateResult = $placeCon->updateOne(
		['Details.RestaurantID' => $restID],
		['$push' =>['Details.0.Reviews' => ['ReviewID' => $uniqueId,'CustomerID' => $custID, 'isValid' => 1, 'DateReviewed' => $date, 'TimeReviewed' => $time, 'Upvote' => 0, 'Downvote' => 0, 'isSpam' => 0, 'isVisible' => 1, 'Content' => $content]]]
	);

	if ($updateResult->getModifiedCount() != 0) {
		echo "Record Inserted successfully";
	} else {
		echo "Error updating record: ";
	}
}

//Update UPVote
function voteStatus($reviewID , $voteStatus){
    //Downvote
	if ($voteStatus == 1){
		upVote($reviewID);
	//UpVote
	} else if($voteStatus == 0){
		downVote($reviewID);
	}
	
}

//Update UPVote
function upVote($reviewID) {
	global $placeCon;

	$updateResult = $placeCon->updateOne(
		['Details.Reviews.ReviewID' => $reviewID],
		['$set' =>['Details.0.Reviews' => ['ReviewID' => $uniqueId,'CustomerID' => $custID, 'isValid' => 1, 'DateReviewed' => $date, 'TimeReviewed' => $time, 'Upvote' => 0, 'Downvote' => 0, 'isSpam' => 0, 'isVisible' => 1, 'Content' => $content]]]
	);

    $upVoteSQL = "UPDATE review SET Upvote = 1,Downvote = 0 WHERE ReviewID= '$reviewID';";
	//echo '<script>console.log("upVote")</script>';
	echo $upVoteSQL;
	echo '<script>console.log("upVoteSQL")</script>';
	if (connect_db()->query($upVoteSQL) == TRUE) {
		echo '<script>console.log("Record updated successfully")</script>';
		//Redirect to normal resturant
	} else {
		//echo "Error updating record: " . connect_db()->error;
		echo '<script>console.log("Error updating record:"'.connect_db()->error.')</script>';
	}
	
}
//Update DOWNVote
function downVote($reviewID){
    $downVoteSQL = "UPDATE review SET Upvote = 0,Downvote = 1 WHERE ReviewID= '$reviewID';";
    //console.log("downVote");
	echo $downVoteSQL;
	echo '<script>console.log("downVote")</script>';
	if (connect_db()->query($downVoteSQL) == TRUE) {
		echo '<script>console.log("Record updated successfully")</script>';
		//Redirect to normal resturant
	} else {
		echo '<script>console.log("Error updating record:"'.connect_db()->error.')</script>';
	}
	
}

function LikeDisLike($flag,$restid,$currentcount){
    $updatecount=$currentcount+1;
    if($flag==0){
		$updateResult = $placeCon->updateOne(
			['Details.RestaurantID' => $restid],
			['$set' =>['Details.0.CountDislikes' => $updatecount]]
		);
        if($updateResult->getModifiedCount() != 0) {
            echo "succeed";
        }
        else{
            echo "fail";
        }
    }
    else if($flag==1){
		$updateResult = $placeCon->updateOne(
			['Details.RestaurantID' => $restid],
			['$set' =>['Details.0.CountLikes' => $updatecount]]
		);
        $likequery="UPDATE restaurant SET CountLikes = '$updatecount' WHERE RestaurantID='".$restid."'";
        if($updateResult->getModifiedCount() != 0){
            echo "succeed";
        }
        else{
            echo "fail";
        }
    }
}
function ReviewIDGenerator($CustID){
    $prefix="REVW";
    $contact = rand(1000, 9999);
    $name = strtoupper(substr(str_replace(" ", "", $CustID),0,4));
    $ID = $prefix.date("is").$name.$contact;
    return $ID;
}

?>