<?php
require("../login/DBhandler.php");
require_once 'vendor/autoload.php';
session_start();
use Brick\Db\Bulk\BulkInserter;
$username = "root";
$password = "";
$pdo = new PDO('mysql:host=localhost;dbname=webdev_CEID', $username, $password);
$inserter = new BulkInserter($pdo, 'locations', ['username', 'timestamp', 'longitudeE7', 'latitudeE7', 'accuracy']);
$requestPayload = \JsonMachine\JsonMachine::fromFile('php://input');
$i = 0;
$timestampArray = array();
$longitudeArray = array();
$latitudeArray = array();
$accuracyArray = array();
$timestamp = 0;
$longitudeE7 = 0;
$latitudeE7 = 0;
$accuracy = 0;
$resultArray = array();
$userid = $_SESSION["username"];
$query2 = "CREATE TABLE IF NOT EXISTS locations (username VARCHAR(25),timestamp BIGINT(13), longitudeE7 BIGINT(9),latitudeE7 BIGINT(9), accuracy VARCHAR(10)) ";
$result = $mysql_con->query($query2);
if (!($stmt = $mysql_con->prepare("INSERT INTO locations (username, timestamp, longitudeE7, latitudeE7, accuracy) VALUES ( ? , ? , ? , ? , ? )"))){
	echo "Prepare failed: (" . $mysql_con->errno . ") " . $mysql_con->error;
}


foreach ($requestPayload as $name => $data){
		$test = $data;
}
foreach ($test as $value){
	$inserter->queue($userid , $value['timestampMs'] , $value['latitudeE7'] , $value['longitudeE7'] , $value['accuracy'] );

}
$inserter->flush();
?>