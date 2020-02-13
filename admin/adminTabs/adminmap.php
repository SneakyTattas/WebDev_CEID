<?php
session_start();
$username = $_SESSION["username"];
$timestamp = 0;
$timestamp2 = 0;
require_once("../../php_files/DBhandler.php");


$queryTypes = "SELECT type FROM locations GROUP BY type";
$resultTypes =$mysql_con->query($queryTypes);
if($_GET['queryTypes'] == 'gettypes'){
    $qType = '{"types": [';
    while ($row = mysqli_fetch_array($resultTypes))
    {
        $qType .= '"' . $row['type'] . '",';
    }
$qType = rtrim($qType, ",");
$qType .= ' ]}';
echo $qType;
}






?>

