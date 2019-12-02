<?php
include("index.html");
$db_server["host"] = "localhost"; //database server
$db_server["username"] = "root"; // DB username
$db_server["password"] = ""; // DB password
$db_server["database"] = "webdev_ceid";// database name
$currentuser = $_POST["username"];
$currentpass = $_POST["password"];

$mysql_con = mysqli_connect($db_server["host"], $db_server["username"], $db_server["password"], $db_server["database"]);
$mysql_con->query ('SET CHARACTER SET utf8');
$mysql_con->query ('SET COLLATION_CONNECTION=utf8_general_ci');

$query = "SELECT IsAdmin
		  FROM users
		  WHERE username =  '$currentuser'   
		  AND passwd = '$currentpass'";

$result = $mysql_con->query($query);
$rowcnt = $result->num_rows;
	if ($rowcnt == 0) {}
	else {
		session_start();
		$_SESSION["username"] = $currentuser;
		$_SESSION["password"] = $currentpassword;
		$timi = $result->fetch_array(MYSQLI_NUM);
			if ($timi[0] == 1)
			{
			header('Location: http://' . $_SERVER['HTTP_HOST'] . '/AdminAccess.php');
			}
			else
			{
			header('Location: http://' . $_SERVER['HTTP_HOST'] . '/UserAccess.php');
		}
	}

	



$mysql_con->close();
?>