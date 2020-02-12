<?php
session_start();
if (isset($_SESSION["username"]))
{
echo "Hello!"
}
else if (!isset($_SESSION["username"])) {
    header("Location: index.html");
    $_SESSION = [];
    session_destroy();

}
?>
