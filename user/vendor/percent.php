<?php
require("../../php_files/DBhandler.php");
session_start();
$userid = $_SESSION["username"];
//scor oikologikhs metakinhshs
$queryALL = "SELECT count(*) AS counter FROM locations WHERE username = '$userid' AND (type != 'UNKNOWN')";
$queryEco = "SELECT count(*) AS Ecocounter FROM locations WHERE username = '$userid' AND (type = 'WALKING' OR type = 'RUNNING' OR type = 'ON_FOOT' OR type = 'ON_BICYCLE')";
$result = $mysql_con->query($queryALL);
$resultEco = $mysql_con->query($queryEco);

$timi = $result->fetch_array(MYSQLI_NUM);
$timiEco = $resultEco->fetch_array(MYSQLI_NUM);
$percentage = round((100*$timiEco[0])/$timi[0]);
$queryInsert = "UPDATE users SET EcoScore = $percentage WHERE username = '$userid'";
$resultPercent = $mysql_con->query($queryInsert);
$timestamp = time();
$queryTimestamp = "UPDATE users SET LastUpload = $timestamp WHERE username = '$userid'";
$mysql_con->query($queryTimestamp);
?>