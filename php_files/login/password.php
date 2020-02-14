<?php
require_once("../DBhandler.php");
$currentuser = $_POST["username"];
$currentpass = $_POST["password"];
$currentmail = $_POST["email"];
$hashedpass = md5($currentpass);


//$key should have been previously generated in a cryptographically safe way, like openssl_random_pseudo_bytes

$key = $currentuser;

$plaintext = $currentmail;
$cipher = "aes-256-cbc";
if (in_array($cipher, openssl_get_cipher_methods()))
{
	$iv = substr($hashedpass, 0, 16);
    $ciphertext = openssl_encrypt($plaintext, $cipher, $key, $options=0, $iv);
    //store $cipher, $iv, and $tag for decryption later
    $original_plaintext = openssl_decrypt($ciphertext, $cipher, $key, $options=0, $iv);
}

//insert user into the database
$query = "INSERT INTO users VALUES ('$currentuser', '$hashedpass', '$currentmail', 0, '$ciphertext', 0, 0)";
$result = $mysql_con->query($query);
echo $mysql_con->error;
$mysql_con->close();

session_start();
$_SESSION["username"] = $currentuser;
$_SESSION["password"] = $hashedpass;
$_SESSION["isAdmin"] = 0;
header('Location: http://' . $_SERVER['HTTP_HOST'] . '/user/');
?>