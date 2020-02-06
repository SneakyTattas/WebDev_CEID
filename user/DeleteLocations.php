<?php
require("../login/DBhandler.php");
session_start();
$userid = $_SESSION["username"];
$query2 = "DELETE FROM locations WHERE username = '$userid'";
$result = $mysql_con->query($query2);
?>