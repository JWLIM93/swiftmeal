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
			echo "AreaId: " . $row["AreaID"]. "AreaName: " . $row["AreaName"]. "PlaceCount" . $row["PlaceCount"]. "DefaultLat" . $row["defaultLat"] . "DefaultLng" . $row["defaultLong"]. "<br>";
		}

		$mongoConn->executeBulkWrite('swiftmeal.area', $bulk);
	} else {
		echo "0 results<br>";
	}
}

connectToSQL();
connectToMongo();
AreaSqlToMongo();

?>