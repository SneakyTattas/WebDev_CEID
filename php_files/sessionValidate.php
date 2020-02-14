<?php
session_start();
if (isset($_SESSION["username"])){
    if($_SESSION["isAdmin"] == 0 && $_SERVER['REQUEST_URI'] != "/user/index.php"){
        header("Location: /user/index.php");
    }

}
else {
    $_SESSION = [];
    session_destroy();
    header("Location: ../index.html");
}
?>