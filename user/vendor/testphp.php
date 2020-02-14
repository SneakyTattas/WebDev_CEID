<?php
require("../../php_files/DBhandler.php");
require_once('./autoload.php');
session_start();
use Brick\Db\Bulk\BulkInserter;
$username = "root";
$password = "";
$pdo = new PDO('mysql:host=localhost;dbname=webdev_CEID', $username, $password);
$inserter = new BulkInserter($pdo, 'locations', ['username', 'timestamp', 'latitudeE7', 'longitudeE7', 'accuracy', 'type', 'confidence'], 1000);
$requestPayload = \JsonMachine\JsonMachine::fromFile('php://input');
$userid = $_SESSION["username"];
$query2 = "CREATE TABLE IF NOT EXISTS locations (username VARCHAR(25),timestamp BIGINT(13) PRIMARY KEY,latitudeE7 BIGINT(9), longitudeE7 BIGINT(9), accuracy VARCHAR(10), type VARCHAR(25) DEFAULT 'UNKNKOWN', confidence BIGINT(3), userID VARCHAR(256))";
$result = $mysql_con->query($query2);

foreach ($requestPayload as $name => $data){
		$test = $data;
}
foreach ($test as $value){
	$inserter->queue($userid , $value['timestampMs'] , $value['latitudeE7'] , $value['longitudeE7'] , $value['accuracy'], $value['type'], $value['confidence'] );
}
$inserter->flush();
?>