<?php
require_once("../../login/index.html");
require_once("../../php_files/DBhandler.php");
//post username and password to database and hash it to validate login
$currentuser = $_POST["username"];
$currentpass = $_POST["psw"];
$hashedpass = md5($currentpass);
echo $hashedpass;

//query for validation
$query = "SELECT IsAdmin
		  FROM users
		  WHERE username =  '$currentuser'   
		  AND passwd = '$hashedpass'";
$result = $mysql_con->query($query);

$rowcnt = $result->num_rows;
	if ($rowcnt == 0) {		
	echo ('<script> alert("paketo"); <script>' ) ; 
	}
	else {
		session_start();
		$_SESSION["username"] = $currentuser;
		$_SESSION["password"] = $hashedpass;
		$timi = $result->fetch_array(MYSQLI_NUM);
		//check isAdmin to see if he is an admin or a user
			if ($timi[0] == 1)
			{
				$_SESSION["isAdmin"] = "1";
			header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin/');
			}
			else
			{
				$_SESSION["isAdmin"] = "0";
			header('Location: http://' . $_SERVER['HTTP_HOST'] . '/user/');
		}
	}

	



$mysql_con->close();
?>