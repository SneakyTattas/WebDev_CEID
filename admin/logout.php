<?php
session_start();
$_SESSION["isAdmin"] == false;
session_destroy();
header('Location: http://' . $_SERVER['HTTP_HOST'] . '/index.html');
?>
