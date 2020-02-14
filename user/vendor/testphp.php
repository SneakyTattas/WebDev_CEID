<?php
require("../../php_files/DBhandler.php");
require_once 'vendor/autoload.php';
session_start();
use Brick\Db\Bulk\BulkInserter;
$username = "root";
$password = "";
$pdo = new PDO('mysql:host=localhost;dbname=webdev_CEID', $username, $password);
$inserter = new BulkInserter($pdo, 'locations', ['username', 'timestamp', 'latitudeE7', 'longitudeE7', 'accuracy', 'type', 'confidence']);
$requestPayload = \JsonMachine\JsonMachine::fromFile('php://input');
$userid = $_SESSION["username"];
$query2 = "CREATE TABLE IF NOT EXISTS locations (username VARCHAR(25),timestamp BIGINT(13),latitudeE7 BIGINT(9), longitudeE7 BIGINT(9), accuracy VARCHAR(10), type VARCHAR(25) DEFAULT 'UNKNKOWN', confidence BIGINT(3))";
$result = $mysql_con->query($query2);
if (!($stmt = $mysql_con->prepare("INSERT INTO locations (username, timestamp, longitudeE7, latitudeE7, accuracy, type, confidence) VALUES ( ? , ? , ? , ? , ?, ?, ? )"))){
	echo "Prepare failed: (" . $mysql_con->errno . ") " . $mysql_con->error;
}


foreach ($requestPayload as $name => $data){
		$test = $data;
}
foreach ($test as $value){
	$inserter->queue($userid , $value['timestampMs'] , $value['latitudeE7'] , $value['longitudeE7'] , $value['accuracy'], $value['type'], $value['confidence'] );

}
$inserter->flush();
?>