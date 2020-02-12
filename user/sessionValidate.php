<?php
session_start();
if (isset($_SESSION["username"])){
    if($_SESSION["isAdmin"] == 0 && $_SERVER['REQUEST_URI'] != "/user/index.php"){
        header("Loctaion: /user/index.php");
    }
    else if ($_SESSION["isAdmin"] ==1 && $_SERVER['REQUEST_URI'] != "/admin/index.php"){
        header("Location: /admin/index.php");
    }
}
else {
    $_SESSION = [];
    session_destroy();
    header("Location: ../index.html");
}
?>
