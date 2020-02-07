<?php
require("../login/DBhandler.php");
session_start();
$userid = $_SESSION["username"];
//scor oikologikhs metakinhshs
$queryEco = "SELECT EcoScore FROM users WHERE username = '$userid'";
$queryTop = "SELECT username, EcoScore FROM users ORDER BY EcoScore DESC LIMIT 3";
$result = $mysql_con->query($queryEco);
$resultTop = $mysql_con->query($queryTop);
$queryTimestamp = "SELECT LastUpload FROM users WHERE username = '$userid'";
$resultTimestamp = mysqli_fetch_array($mysql_con->query($queryTimestamp));



$timi = $result->fetch_array(MYSQLI_BOTH);
$times = mysqli_fetch_all ($resultTop);
echo("Kalhspera Xristi $userid. To pososto eco friendly politi sou einai $timi[0]%.");


function html_table($data = array())
{
    $rows = array();
    foreach ($data as $row){
        $cells = array();
            foreach ($row as $cell) {
                $cells[] = "<td>{$cell}</td>";
            }
            $rows[] = "<tr>" . implode ('', $cells) . "</tr>";
    }
    return " <table>" . implode('',$rows) . "</table>"; 
}

echo html_table($times);
echo ("H hmeromia teleftaiou upload dedomenwn topothesias einai " . date("F d, Y h:i:s A", $resultTimestamp[0]). ".");

//$Endresult = 100 * $resultEco / $result;
//apo pote ews pote einai ta timestamp tou json_decode

//hmeromhnia teleutaiou upload

//leaderboard top 3 oikologikoi xrhstes

?>