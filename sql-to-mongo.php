<?php

require_once __DIR__ . "/vendor/autoload.php";

$sqlConn;
$mongoConn;

function connectToSQL() {
	global $sqlConn;
	$serverName = "47.74.158.75";
	$username = "junwei";
	$password = "junwei";
	$dbName = "swiftmeal";

	// Create connection
	$sqlConn = new mysqli($serverName, $username, $password, $dbName);

	// Check connection
	if ($sqlConn->connect_error) {
		die("Connection failed: " . $sqlConn->connect_error);
	} 
	echo "Connected successfully";
}

function connectToMongo() {
	global $mongoConn;
	try {
		$mongoConn = new MongoDB\Driver\Manager("mongodb://47.88.157.236");
		echo "success";

		// $stats = new MongoDB\Driver\Command(["dbstats" => 1]);
		// $res = $mng->executeCommand("testdb", $stats);
		
		// $stats = current($res->toArray());

		// print_r($stats);

	} catch (MongoDB\Driver\Exception\Exception $e) {

		$filename = basename(__FILE__);
		
		echo "The $filename script has experienced an error.\n"; 
		echo "It failed with the following exception:\n";
		
		echo "Exception:", $e->getMessage(), "\n";
		echo "In file:", $e->getFile(), "\n";
		echo "On line:", $e->getLine(), "\n";       
	}
}

function AreaSqlToMongo() {

    $bulk = new MongoDB\Driver\BulkWrite;

	global $sqlConn;
	global $mongoConn;
	
	$sql = "SELECT * FROM area";
	$result = mysqli_query($sqlConn, $sql);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			$doc = ['_id' => $row["AreaID"], 'AreaName' => $row["AreaName"], 'PlaceCount' => $row["PlaceCount"], 'DefaultLat' => $row["defaultLat"], 'DefaultLong' => $row["defaultLong"]];
			$bulk->insert($doc);
			echo "Success!<br>";
		}

		$mongoConn->executeBulkWrite('swiftmeal.area', $bulk);
	} else {
		echo "0 results<br>";
	}
}

function CustomerSQLToMongo() {
	$bulk = new MongoDB\Driver\BulkWrite;

	global $sqlConn;
	global $mongoConn;
	
	$sql = "SELECT * FROM customer";
	$result = mysqli_query($sqlConn, $sql);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			$doc = ['_id' => $row["CustomerID"], 'UID' => $row["UID"], 'isValid' => $row["isValid"]];
			$bulk->insert($doc);
			echo "Success!<br>";
		}

		$mongoConn->executeBulkWrite('swiftmeal.customer', $bulk);
	} else {
		echo "0 results<br>";
	}
}

function FriendSQLToMongo() {
	$bulk = new MongoDB\Driver\BulkWrite;

	global $sqlConn;
	global $mongoConn;
	
	$sql = "SELECT * FROM friendrequest";
	$result = mysqli_query($sqlConn, $sql);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			$doc = ['_id' => new MongoDB\BSON\ObjectID, 'UID' => $row["UID"], 'RequestTo' => $row["RequestTo"], 'isAccepted' => $row["isAccepted"], 'RequestDate' => $row["RequestDate"], 'RequestTime' => $row["RequestTime"], 'isValid' => $row["isValid"]];
			$bulk->insert($doc);
			echo "Success!<br>";
		}

		$mongoConn->executeBulkWrite('swiftmeal.friendrequest', $bulk);
	} else {
		echo "0 results<br>";
	}
}

function HawkerCenterSQLToMongo() {
	$bulk = new MongoDB\Driver\BulkWrite;

	global $sqlConn;
	global $mongoConn;
	
	$sql = "SELECT * FROM hawkercenter";
	$result = mysqli_query($sqlConn, $sql);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			$doc = ['_id' => $row["HawkerCenterID"], 'PlaceID' => $row["PlaceID"], 'isValid' => $row["isValid"]];
			$bulk->insert($doc);
			echo "Success!<br>";
		}

		$mongoConn->executeBulkWrite('swiftmeal.hawkercenter', $bulk);
	} else {
		echo "0 results<br>";
	}
}

function OwnerSQLToMongo() {
	$bulk = new MongoDB\Driver\BulkWrite;

	global $sqlConn;
	global $mongoConn;
	
	$sql = "SELECT * FROM owner";
	$result = mysqli_query($sqlConn, $sql);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			$doc = ['_id' => $row["OwnerID"], 'UID' => $row["UID"], 'isValid' => $row["isValid"]];
			$bulk->insert($doc);
			echo "Success!<br>";
		}

		$mongoConn->executeBulkWrite('swiftmeal.owner', $bulk);
	} else {
		echo "0 results<br>";
	}
}

function PlaceSQLToMongo() {
	$bulk = new MongoDB\Driver\BulkWrite;

	global $sqlConn;
	global $mongoConn;
	
	$sql = "SELECT * FROM place";
	$result = mysqli_query($sqlConn, $sql);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			$doc = ['_id' => $row["PlaceID"], 'Block' => $row["Block"], 'Building' => $row["Building"], 'Floor' => $row["Floor"], 'Street' => $row["Street"], 'Unit' => $row["Unit"], 'GeoX' => $row["GeoX"], 'GeoY' => $row["GeoY"], 'GeoLat' => $row["GeoLat"], 'GeoLong' => $row["GeoLong"], 'DateAdded' => $row["DateAdded"], 'TimeAdded' => $row["TimeAdded"], 'PostalCode' => $row["PostalCode"]];
			$bulk->insert($doc);
			echo "Success!<br>";
		}

		$mongoConn->executeBulkWrite('swiftmeal.place', $bulk);
	} else {
		echo "0 results<br>";
	}
}

function PlaceAreaSQLToMongo() {
	$bulk = new MongoDB\Driver\BulkWrite;

	global $sqlConn;
	global $mongoConn;
	
	$sql = "SELECT * FROM placearea";
	$result = mysqli_query($sqlConn, $sql);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			$doc = ['_id' => new MongoDB\BSON\ObjectID, 'PlaceID' => $row["PlaceID"], 'AreaID' => $row["AreaID"], 'isValid' => $row["isValid"]];
			$bulk->insert($doc);
			echo "Success!<br>";
		}

		$mongoConn->executeBulkWrite('swiftmeal.placearea', $bulk);
	} else {
		echo "0 results<br>";
	}
}

function RequestSQLToMongo() {
	$bulk = new MongoDB\Driver\BulkWrite;

	global $sqlConn;
	global $mongoConn;
	
	$sql = "SELECT * FROM request";
	$result = mysqli_query($sqlConn, $sql);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			$doc = ['_id' => new MongoDB\BSON\ObjectID, 'CustomerID' => $row["CustomerID"], 'RequestTo' => $row["RequestTo"], 'PlaceID' => $row["PlaceID"], 'RequestDate' => $row["RequestDate"], 'RequestTime' => $row["RequestTime"], 'isValid' => $row["isValid"], 'isAccepted' => $row["isAccepted"]];
			$bulk->insert($doc);
			echo "Success!<br>";
		}

		$mongoConn->executeBulkWrite('swiftmeal.request', $bulk);
	} else {
		echo "0 results<br>";
	}
}

function ReservationSQLToMongo() {
	$bulk = new MongoDB\Driver\BulkWrite;

	global $sqlConn;
	global $mongoConn;
	
	$sql = "SELECT * FROM reservation";
	$result = mysqli_query($sqlConn, $sql);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			$doc = ['_id' => $row["BookingID"], 'CustomerID' => $row["CustomerID"], 'RestaurantID' => $row["RestaurantID"], 'Pax' => $row["Pax"], 'DateReserved' => $row["DateReserved"], 'TimeReserved' => $row["TimeReserved"], 'isValid' => $row["isValid"], 'isFulfilled' => $row["isFulfilled"], 'DateCreated' => $row["DateCreated"], 'TimeCreated' => $row["TimeCreated"]];
			$bulk->insert($doc);
			echo "Success!<br>";
		}

		$mongoConn->executeBulkWrite('swiftmeal.reservation', $bulk);
	} else {
		echo "0 results<br>";
	}
}

function RestaurantSQLToMongo() {
	$bulk = new MongoDB\Driver\BulkWrite;

	global $sqlConn;
	global $mongoConn;
	
	$sql = "SELECT * FROM restaurant";
	$result = mysqli_query($sqlConn, $sql);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			$doc = ['_id' => $row["RestaurantID"], 'PlaceID' => $row["PlaceID"], 'OwnerID' => $row["OwnerID"], 'RestaurantName' => $row["RestaurantName"], 'CountLikes' => $row["CountLikes"], 'CountDislikes' => $row["CountDislikes"], 'isValid' => $row["isValid"]];
			$bulk->insert($doc);
			echo "Success!<br>";
		}

		$mongoConn->executeBulkWrite('swiftmeal.restaurant', $bulk);
	} else {
		echo "0 results<br>";
	}
}

function ReviewSQLToMongo() {
	$bulk = new MongoDB\Driver\BulkWrite;

	global $sqlConn;
	global $mongoConn;
	
	$sql = "SELECT * FROM review";
	$result = mysqli_query($sqlConn, $sql);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			$doc = ['_id' => $row["ReviewID"], 'CustomerID' => $row["CustomerID"], 'RestaurantID' => $row["RestaurantID"], 'DateReviewed' => $row["DateReviewed"], 'TimeReviewed' => $row["TimeReviewed"], 'Upvote' => $row["Upvote"], 'Downvote' => $row["Downvote"], 'isValid' => $row["isValid"], 'isSpam' => $row["isSpam"], 'isVisible' => $row["isVisible"], 'content' => $row["content"]];
			$bulk->insert($doc);
			echo "Success!<br>";
		}

		$mongoConn->executeBulkWrite('swiftmeal.review', $bulk);
	} else {
		echo "0 results<br>";
	}
}

function UserSQLToMongo() {
	$bulk = new MongoDB\Driver\BulkWrite;

	global $sqlConn;
	global $mongoConn;
	
	$sql = "SELECT * FROM user";
	$result = mysqli_query($sqlConn, $sql);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			$doc = ['_id' => $row["UID"], 'UP' => $row["UP"], 'Name' => $row["Name"], 'Email' => $row["Email"], 'MobileNo' => $row["MobileNo"], 'isOnline' => $row["isOnline"]];
			$bulk->insert($doc);
			echo "Success!<br>";
		}

		$mongoConn->executeBulkWrite('swiftmeal.user', $bulk);
	} else {
		echo "0 results<br>";
	}
}

function UserRecommendationSQLToMongo() {
	$bulk = new MongoDB\Driver\BulkWrite;

	global $sqlConn;
	global $mongoConn;
	
	$sql = "SELECT * FROM userrecommendation";
	$result = mysqli_query($sqlConn, $sql);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			$doc = ['_id' => $row["RecommendationID"], 'CustomerID' => $row["CustomerID"], 'DateRecommended' => $row["DateRecommended"], 'TimeRecommended' => $row["TimeRecommended"], 'RecommendedPlaces' => $row["RecommendedPlaces"], 'AreaID' => $row["AreaID"]];
			$bulk->insert($doc);
			echo "Success!<br>";
		}

		$mongoConn->executeBulkWrite('swiftmeal.userrecommendation', $bulk);
	} else {
		echo "0 results<br>";
	}
}

function UsersPairSQLToMongo() {
	$bulk = new MongoDB\Driver\BulkWrite;

	global $sqlConn;
	global $mongoConn;
	
	$sql = "SELECT * FROM userspair";
	$result = mysqli_query($sqlConn, $sql);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			$doc = ['_id' => new MongoDB\BSON\ObjectID, 'UID' => $row["UID"], 'PUID' => $row["PUID"], 'isValid' => $row["isValid"], 'PairedDate' => $row["PairedDate"], 'PairedTime' => $row["PairedTime"]];
			$bulk->insert($doc);
			echo "Success!<br>";
		}

		$mongoConn->executeBulkWrite('swiftmeal.userspair', $bulk);
	} else {
		echo "0 results<br>";
	}
}

connectToSQL();
connectToMongo();
AreaSqlToMongo();
CustomerSQLToMongo();
FriendSQLToMongo();
HawkerCenterSQLToMongo();
OwnerSQLToMongo();
PlaceSQLToMongo();
PlaceAreaSQLToMongo();
RequestSQLToMongo();
ReservationSQLToMongo();
RestaurantSQLToMongo();
ReviewSQLToMongo();
UserSQLToMongo();
UsersPairSQLToMongo();
UserRecommendationSQLToMongo();
?>