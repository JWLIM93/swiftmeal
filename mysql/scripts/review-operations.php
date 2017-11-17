<?php
include 'db-functions.php';
//include 'customer.php';
session_start();


//List of variables i going to use
$reviewList = array();

if(isset($_POST['action']) && !empty($_POST['action'])){
    $action=$_POST['action'];
    switch($action){
        case 'reviewRequest': queryAllReview($_GET['RestaurantID']);break;
        case 'addReviews': insertCustomerReview($_GET['custID'],$_GET['restID'],$_GET['content']);break;
        case 'updateVoteStatus': voteStatus($_GET['reviewID'],$_GET['voteStatus']);
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
        $queryAllReviewSQL = "SELECT user.Name,review.ReviewID ,review.content,review.DateReviewed,review.TimeReviewed,review.Upvote,review.Downvote,review.isValid,review.isSpam,review.isVisible FROM review INNER JOIN customer ON review.CustomerID = customer.CustomerID JOIN user ON user.UID = customer.UID where review.RestaurantID = $resturantID AND review.isVisible = 1;";
            //echo $queryAllReviewSQL;
            //$queryAllReviewSQL = "SELECT * FROM review INNER JOIN customer ON  customer.CustomerID = review.CustomerID JOIN user ON customer.UID == user.UID WHERE review.RestaurantID = '$resturantID';";
        $checkResult = connect_db()->query($queryAllReviewSQL) or die("Fail to query db");
	if(mysqli_num_rows($checkResult) > 0){
		while ($row = mysqli_fetch_assoc($checkResult)) {
			
			$reviewTemp=(array('Name'=>$row['Name'],'ReviewID'=>$row['ReviewID'],'content'=>$row['content'],'DateReviewed'=>$row['DateReviewed'],'TimeReviewed'=>$row['TimeReviewed'],'Upvote'=>$row['Upvote'],'Downvote'=>$row['Downvote'],'isValid'=>$row['isValid'],'isSpam'=>$row['isSpam'],'isVisible'=>$row['isVisible']));
			array_push($reviewList, $reviewTemp);
		}
		
	}else{
		echo "";
	}
	$getlikes="SELECT CountLikes, CountDislikes FROM restaurant WHERE RestaurantID=$resturantID";
                $getlikes2 = connect_db()->query($getlikes) or die("Fail to query db");
                $likedislikes = mysqli_fetch_array($getlikes2);
                $templikearray = (array('Likes'=>$likedislikes['CountLikes'],'Dislikes'=>$likedislikes['CountDislikes']));
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
	//Date , Time  , Generate ID
	$date = date("Y/m/d");
	$time = date("h:i:sa");
	$uniqueId= uniqid();

	$insertCustomerReviewSQL = "INSERT INTO `review` (`ReviewID`, `content`, `CustomerID`, `RestaurantID`, `DateReviewed`, `TimeReviewed`, `Upvote`, `Downvote`, `isValid`, `isSpam`, `isVisible`) ".
	"VALUES ('$uniqueId', '$content', $custID, '$restID', $date, '$time', '0', '0', '1', '0', '1')";
    
	if (connect_db()->query($insertCustomerReviewSQL) == TRUE) {
		echo "Record Inserted successfully";
	} else {
		echo "Error updating record: " . connect_db()->error;
	}
}

//Update UPVote
function voteStatus($reviewID , $voteStatus){
    //Downvote
	echo '<script>console.log("votStatus")</script>';
	if($voteStatus == 1){
		upVote($reviewID);
	//UpVote
	}else if($voteStatus == 0){
		downVote($reviewID);
	}
	
}

//Update UPVote
function upVote($reviewID){
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

//Set Review Valid
function validReview($reviewID){
    $validReviewSQL = "UPDATE review SET isValid = 1 WHERE ReviewID= '$reviewID';";
    echo $validReviewSQL ;
	if (connect_db()->query($validReviewSQL) == TRUE) {
		echo "Record updated successfully";
		//Redirect to normal resturant
	} else {
		echo "Error updating record: " . connect_db()->error;
	}
	
}

//Set Review Not Valid
function notValidReview($reviewID){
    $notValidReviewSQL = "UPDATE review SET isValid = 0 WHERE ReviewID= '$reviewID';";
    echo $notValidReviewSQL ;
	if (connect_db()->query($notValidReviewSQL) == TRUE) {
		echo "Record updated successfully";
		//Redirect to normal resturant
	} else {
		echo "Error updating record: " . connect_db()->error;
	}
	
}

//Set Review Spam
function isSpamReview($reviewID){
    $isSpamReviewSQL = "UPDATE review SET isSpam = 1 WHERE ReviewID= '$reviewID';";
    echo $isSpamReviewSQL ;
	if (connect_db()->query($isSpamReviewSQL) == TRUE) {
		echo "Record updated successfully";
		//Redirect to normal resturant
	} else {
		echo "Error updating record: " . connect_db()->error;
	}
	
}

//Set Review Not Spam
function isNotSpamReview($reviewID){
    $isNotSpamReviewSQL = "UPDATE review SET isSpam = 0 WHERE ReviewID= '$reviewID';";
    echo $isNotSpamReviewSQL ;
	if (connect_db()->query($isNotSpamReviewSQL) == TRUE) {
		echo "Record updated successfully";
		//Redirect to normal resturant
	} else {
		echo "Error updating record: " . connect_db()->error;
	}
	
}

//Set Review Visible
function isVisibleReview($reviewID){
    $isVisibleReviewSQL = "UPDATE review SET isVisible = 1 WHERE ReviewID= '$reviewID';";
    echo $isVisibleReviewSQL ;
	if (connect_db()->query($isVisibleReviewSQL) == TRUE) {
		echo "Record updated successfully";
		//Redirect to normal resturant
	} else {
		echo "Error updating record: " . connect_db()->error;
	}
	
}
//Set Review Not Visible
function isNotVisibleReview($reviewID){
    $isNotVisibleReviewSQL = "UPDATE review SET isVisible = 0 WHERE ReviewID= '$reviewID';";
    echo $isNotVisibleReviewSQL ;
	if (connect_db()->query($isNotVisibleReviewSQL) == TRUE) {
		echo "Record updated successfully";
		//Redirect to normal resturant
	} else {
		echo "Error updating record: " . connect_db()->error;
	}
	
}


?>