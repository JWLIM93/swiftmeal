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
	echo "SQL Connected successfully <br>";
}

function connectToMongo() {
	global $mongoConn;
	try {
		$mongoConn = new MongoDB\Client('mongodb://47.88.157.236');
		echo "Mongodb Connection Success <br>";

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
	// MERGE AREA and PLACEAREA
	global $sqlConn;
	global $mongoConn;
	
	$sqlArea = "SELECT * FROM area";
	$resultArea = mysqli_query($sqlConn, $sqlArea);

	$sqlPlaceArea = "SELECT * FROM placearea";
	$resultPlaceArea = mysqli_query($sqlConn, $sqlPlaceArea);

	$collection = $mongoConn->selectCollection('swiftmeal', 'area');

	echo "Converting Area ...<br>";

	if (mysqli_num_rows($resultArea) > 0) {
		while($row = mysqli_fetch_assoc($resultArea)) {
			$insertOneResult = $collection->insertOne([
				'_id' => $row["AreaID"],
				'AreaName' => $row["AreaName"],
				'PlaceCount' => (int)$row["PlaceCount"],
				'DefaultLat' => (double)$row["defaultLat"],
				'DefaultLong' => (double)$row["defaultLong"],
				'Places' => []
			]);
			printf("Inserted %d document(s)\n<br>", $insertOneResult->getInsertedCount());
		}
	}

	echo "Converting Place Area ...<br>";

	if (mysqli_num_rows($resultPlaceArea) > 0) {
		while($row = mysqli_fetch_assoc($resultPlaceArea)) {
			$updateResult = $collection->updateOne(
				['_id' => $row["AreaID"]],
				['$push' => ['Places' => ['PlaceID' => $row["PlaceID"], 'isValid' => 0]]]
			);

			printf("Matched %d document(s)\n<br>", $updateResult->getMatchedCount());
			printf("Modified %d document(s)\n<br>", $updateResult->getModifiedCount());
		}
	}

	echo "Indexing Area Collection ... <br>";

	$indexNames = $collection->createIndexes([
		[ 'key' => [ '_id' => 1, 'Places' => 1] ]
	]);
}

function PlaceSQLToMongo() {
	// MERGE PLACE and HAWKERCENTER and RESTAURANT
	global $sqlConn;
	global $mongoConn;
	
	$sqlPlace = "SELECT * FROM place";
	$resultPlace = mysqli_query($sqlConn, $sqlPlace);

	$sqlHawkerCenter = "SELECT * FROM hawkercenter";
	$resultHawkerCenter = mysqli_query($sqlConn, $sqlHawkerCenter);

	$sqlRestaurant = "SELECT * FROM restaurant";
	$resultRestaurant = mysqli_query($sqlConn, $sqlRestaurant);

	$sqlReview = "SELECT * FROM review";
	$resultReview = mysqli_query($sqlConn, $sqlReview);	

	$collection = $mongoConn->selectCollection('swiftmeal', 'place');

	echo "Converting Place ...<br>";

	if (mysqli_num_rows($resultPlace) > 0) {
		while($row = mysqli_fetch_assoc($resultPlace)) {
			$insertOneResult = $collection->insertOne([
				'_id' => $row["PlaceID"],
				'Block' => $row["Block"],
				'Building' => $row["Building"],
				'Floor' => $row["Floor"],
				'Street' => $row["Street"],
				'Unit' => $row["Unit"],
				'GeoX' => (double)$row["GeoX"],
				'GeoY' => (double)$row["GeoY"],
				'GeoLat' => (double)$row["GeoLat"],
				'GeoLong' => (double)$row["GeoLong"],
				'DateAdded' => $row["DateAdded"],
				'TimeAdded' => $row["TimeAdded"],
				'PostalCode' => $row["PostalCode"],
				'Type' => "",
				'Details' => []
			]);
			printf("Inserted %d document(s)\n<br>", $insertOneResult->getInsertedCount());
		}
	}

	echo "Converting Hawker Center ...<br>";

	if (mysqli_num_rows($resultHawkerCenter) > 0) {
		while($row = mysqli_fetch_assoc($resultHawkerCenter)) {
			$updateResult = $collection->updateOne(
				['_id' => $row["PlaceID"]],
				['$push' =>['Details' => ['HawkerCenterID' => $row["HawkerCenterID"], 'isValid' => (int)$row["isValid"]]]]
			);

			printf("Matched %d document(s)\n<br>", $updateResult->getMatchedCount());
			printf("Modified %d document(s)\n<br>", $updateResult->getModifiedCount());

			$updateResult = $collection->updateOne(
				['_id' => $row["PlaceID"]],
				['$set' =>['Type' => "HawkerCenter"]]
			);
			printf("Matched %d document(s)\n<br>", $updateResult->getMatchedCount());
			printf("Modified %d document(s)\n<br>", $updateResult->getModifiedCount());
		}
	}

	echo "Converting Restaurant ...<br>";

	if (mysqli_num_rows($resultRestaurant) > 0) {
		while($row = mysqli_fetch_assoc($resultRestaurant)) {
			$updateResult = $collection->updateOne(
				['_id' => $row["PlaceID"]],
				['$push' =>['Details' => ['RestaurantID' => $row["RestaurantID"], 'isValid' => (int)$row["isValid"], 'OwnerID' => $row["OwnerID"], 'RestaurantName' => $row["RestaurantName"], 'CountLikes' => (int)$row["CountLikes"], 'CountDislikes' => (int)$row["CountDislikes"], 'Reviews' => []]]]
			);

			printf("Matched %d document(s)\n<br>", $updateResult->getMatchedCount());
			printf("Modified %d document(s)\n<br>", $updateResult->getModifiedCount());

			$updateResult = $collection->updateOne(
				['_id' => $row["PlaceID"]],
				['$set' =>['Type' => "Restaurant"]]
			);
			printf("Matched %d document(s)\n<br>", $updateResult->getMatchedCount());
			printf("Modified %d document(s)\n<br>", $updateResult->getModifiedCount());
		}
	}

	echo "Converting Review ...<br>";

	if (mysqli_num_rows($resultReview) > 0) {
		while($row = mysqli_fetch_assoc($resultReview)) {
			$updateResult = $collection->updateOne(
				['Details.RestaurantID' => $row["RestaurantID"]],
				['$push' =>['Details.$.Reviews' => ['CustomerID' => $row["CustomerID"], 'isValid' => (int)$row["isValid"], 'DateReviewed' => $row["DateReviewed"], 'TimeReviewed' => $row["TimeReviewed"], 'Upvote' => (int)$row["Upvote"], 'Downvote' => (int)$row["Downvote"], 'isSpam' => (int)$row["isSpam"], 'isVisible' => (int)$row["isVisible"], 'Content' => $row["Content"]]]]
			);

			printf("Matched %d document(s)\n<br>", $updateResult->getMatchedCount());
			printf("Modified %d document(s)\n<br>", $updateResult->getModifiedCount());
		}
	}

	echo "Indexing Place Collection ... <br>";

	$indexNames = $collection->createIndexes([
		[ 'key' => [ '_id' => 1, 'Places' => 1] ]
	]);
	
}

function UserSQLToMongo() {
	global $sqlConn;
	global $mongoConn;
	
	$sqlUser = "SELECT * FROM user";
	$resultUser = mysqli_query($sqlConn, $sqlUser);

	$sqlOwner = "SELECT * FROM owner";
	$resultOwner = mysqli_query($sqlConn, $sqlOwner);

	$sqlCustomer = "SELECT * FROM customer";
	$resultCustomer = mysqli_query($sqlConn, $sqlCustomer);

	$sqlFriendRequest = "SELECT * FROM friendrequest";
	$resultFriendRequest = mysqli_query($sqlConn, $sqlFriendRequest);

	$sqlUsersPair = "SELECT * FROM userspair";
	$resultUsersPair = mysqli_query($sqlConn, $sqlUsersPair);

	$collection = $mongoConn->selectCollection('swiftmeal', 'user');

	echo "Converting User ...<br>";

	if (mysqli_num_rows($resultUser) > 0) {
		// output data of each row
		while($row = mysqli_fetch_assoc($resultUser)) {
			$insertOneResult = $collection->insertOne([
				'_id' => $row["UID"],
				'UP' => $row["UP"],
				'Name' => $row["Name"],
				'Email' => $row["Email"],
				'MobileNo' => $row["MobileNo"],
				'IsOnline' => (int)0,
				'Type' => "",
				'Details' => [],
				'FriendRequest' => [],
				'UsersPair' => [],
			]);
			printf("Inserted %d document(s)\n<br>", $insertOneResult->getInsertedCount());
		}
	}

	echo "Converting Owner ...<br>";

	if (mysqli_num_rows($resultOwner) > 0) {
		while($row = mysqli_fetch_assoc($resultOwner)) {
			$updateResult = $collection->updateOne(
				['_id' => $row["UID"]],
				['$push' =>['Details' => ['OwnerID' => $row["OwnerID"], 'isValid' => (int)$row["isValid"]]]]
			);

			printf("Matched %d document(s)\n<br>", $updateResult->getMatchedCount());
			printf("Modified %d document(s)\n<br>", $updateResult->getModifiedCount());

			$updateResult = $collection->updateOne(
				['_id' => $row["UID"]],
				['$set' =>['Type' => "Owner"]]
			);
			printf("Matched %d document(s)\n<br>", $updateResult->getMatchedCount());
			printf("Modified %d document(s)\n<br>", $updateResult->getModifiedCount());
		}
	}

	echo "Converting Customer ...<br>";

	if (mysqli_num_rows($resultCustomer) > 0) {
		while($row = mysqli_fetch_assoc($resultCustomer)) {
			$updateResult = $collection->updateOne(
				['_id' => $row["UID"]],
				['$push' =>['Details' => ['CustomerID' => $row["CustomerID"], 'isValid' => (int)$row["isValid"]]]]
			);

			printf("Matched %d document(s)\n<br>", $updateResult->getMatchedCount());
			printf("Modified %d document(s)\n<br>", $updateResult->getModifiedCount());

			$updateResult = $collection->updateOne(
				['_id' => $row["UID"]],
				['$set' =>['Type' => "Customer"]]
			);
			printf("Matched %d document(s)\n<br>", $updateResult->getMatchedCount());
			printf("Modified %d document(s)\n<br>", $updateResult->getModifiedCount());
		}
	}

	echo "Converting FriendRequest ...<br>";

	if (mysqli_num_rows($resultFriendRequest) > 0) {
		while($row = mysqli_fetch_assoc($resultFriendRequest)) {
			$updateResult = $collection->updateOne(
				['_id' => $row["UID"]],
				['$push' =>['FriendRequest' => ['RequestTo' => $row["RequestTo"], 'isAccepted' => (int)$row["isAccepted"], 'RequestDate' => $row["RequestDate"], 'RequestTime' => $row["RequestTime"], 'isValid' => (int)$row["isValid"]]]]
			);

			printf("Matched %d document(s)\n<br>", $updateResult->getMatchedCount());
			printf("Modified %d document(s)\n<br>", $updateResult->getModifiedCount());
		}
	}

	echo "Converting UsersPair ...<br>";

	if (mysqli_num_rows($resultUsersPair) > 0) {
		while($row = mysqli_fetch_assoc($resultUsersPair)) {
			$updateResult = $collection->updateOne(
				['_id' => $row["UID"]],
				['$push' =>['UsersPair' => ['PUID' => $row["PUID"], 'isValid' => (int)$row["isValid"], 'PairedDate' => $row["PairedDate"], 'PairedTime' => $row["PairedTime"]]]]
			);

			printf("Matched %d document(s)\n<br>", $updateResult->getMatchedCount());
			printf("Modified %d document(s)\n<br>", $updateResult->getModifiedCount());
		}
	}

	echo "Indexing UserCollection ... <br>";

	$indexNames = $collection->createIndexes([
		[ 'key' => [ '_id' => 1, 'Details' => 1] ],
		[ 'key' => [ '_id' => 1, 'FriendRequest' => 1] ],
		[ 'key' => [ '_id' => 1, 'UsersPair' => 1] ]
	]);
	
}

function CustomerFeatureSQLToMongo() {
	global $sqlConn;
	global $mongoConn;
	
	$sqlCustomer = "SELECT * FROM customer";
	$resultCustomer = mysqli_query($sqlConn, $sqlCustomer);
	
	$sqlReservation = "SELECT * FROM reservation";
	$resultReservation = mysqli_query($sqlConn, $sqlReservation);	

	$sqlRequest = "SELECT * FROM request";
	$resultRequest = mysqli_query($sqlConn, $sqlRequest);	

	$sqlUserRecommendations = "SELECT * FROM userrecommendation";
	$resultUserRecommendations = mysqli_query($sqlConn, $sqlUserRecommendations);

	$collection = $mongoConn->selectCollection('swiftmeal', 'customer');

	echo "Populating CustomerIDs ...<br>";

	if (mysqli_num_rows($resultCustomer) > 0) {
		// output data of each row
		while($row = mysqli_fetch_assoc($resultCustomer)) {
			$insertOneResult = $collection->insertOne([
				'_id' => $row["CustomerID"],
				'Requests' => [],
				'Reservations' => [],
				'UserRecommendations' => []
			]);
			printf("Inserted %d document(s)\n<br>", $insertOneResult->getInsertedCount());
		}
	}

	echo "Converting Requests ...<br>";

	if (mysqli_num_rows($resultRequest) > 0) {
		while($row = mysqli_fetch_assoc($resultRequest)) {
			$updateResult = $collection->updateOne(
				['_id' => $row["CustomerID"]],
				['$push' =>['Requests' => ['RequestTo' => $row["RequestTo"], 'isAccepted' => (int)$row["isAccepted"], 'RequestDate' => $row["RequestDate"], 'RequestTime' => $row["RequestTime"], 'isValid' => (int)$row["isValid"], 'PlaceID' => $row["PlaceID"]]]]
			);

			printf("Matched %d document(s)\n<br>", $updateResult->getMatchedCount());
			printf("Modified %d document(s)\n<br>", $updateResult->getModifiedCount());
		}
	}

	echo "Converting Reservations ...<br>";

	if (mysqli_num_rows($resultReservations) > 0) {
		while($row = mysqli_fetch_assoc($resultReservations)) {
			$updateResult = $collection->updateOne(
				['_id' => $row["CustomerID"]],
				['$push' =>['Reservations' => ['RestaurantID' => $row["RestaurantID"], 'Pax' => (int)$row["Pax"], 'DateReserved' => $row["DateReserved"], 'TimeReserved' => $row["TimeReserved"], 'isValid' => (int)$row["isValid"], 'isFulfilled' => (int)$row["isFulfilled"], 'DateCreated' => $row["DateCreated"], 'TimeCreated' => $row["TimeCreated"]]]]
			);

			printf("Matched %d document(s)\n<br>", $updateResult->getMatchedCount());
			printf("Modified %d document(s)\n<br>", $updateResult->getModifiedCount());
		}
	}

	echo "Converting User Recommendations ...<br>";

	if (mysqli_num_rows($resultUserRecommendations) > 0) {
		while($row = mysqli_fetch_assoc($resultUserRecommendations)) {
			$updateResult = $collection->updateOne(
				['_id' => $row["CustomerID"]],
				['$push' =>['UserRecommendations' => ['RecommendationID' => $row["RecommendationID"], 'Pax' => (int)$row["Pax"], 'DateRecommended' => $row["DateRecommended"], 'TimeRecommended' => $row["TimeRecommended"], 'RecommendedPlaces' => $row["RecommendedPlaces"], 'AreaID' => $row["AreaID"]]]]
			);

			printf("Matched %d document(s)\n<br>", $updateResult->getMatchedCount());
			printf("Modified %d document(s)\n<br>", $updateResult->getModifiedCount());
		}
	}
}

//////////////////////////////////////

function test() {
	echo "TEST RUNNING";

	global $sqlConn;
	global $mongoConn;

	$collection = $mongoConn->selectCollection('swiftmeal', 'user');

	$updateResult = $collection->updateOne(
		['_id' => 'UCUST3133ALE8201', 'UsersPair.PUID' => "CUST4945JERE8546"],
		['$set' => ['UsersPair.$.isValid' => 0]]
	);

	printf("Matched %d document(s)\n<br>", $updateResult->getMatchedCount());
	printf("Modified %d document(s)\n<br>", $updateResult->getModifiedCount());
}

connectToSQL();
connectToMongo();
//AreaSqlToMongo();
//PlaceSQLToMongo();
//UserSQLToMongo();
//CustomerFeatureSQLToMongo();

test();
?>