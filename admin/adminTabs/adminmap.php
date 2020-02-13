<?php
session_start();
$username = $_SESSION["username"];
$timestamp = 0;
$timestamp2 = 0;
require("../login/DBhandler.php");
$monthsince = intval($_GET['monthsince']);
$yearsince = intval($_GET['yearsince']);
$monthuntil = intval($_GET['monthuntil']);
$yearuntil = intval($_GET['yearuntil']);
$daysince = intval($_GET['daysince']);
$hoursince = intval($_GET['hoursince']);
$dayuntil = intval($_GET['dayuntil']);
$houruntil = intval($_GET['houruntil']);

if(!$monthsince)
{
    $monthsince = "01";
}
if(!$monthuntil)
{
    $monthuntil = "12";

}
if(!$yearsince)
{
    $yearsince = "2015";

}
if(!$yearuntil)
{
    $yearuntil = "2025";
}
if(!$daysince)
{
    $daysince = "2";
}
if(!$dayuntil)
{
    $dayuntil = "1";
}
if(!$hoursince)
{
    $hoursince = "0";
}
if(!$houruntil)
{
    $houruntil = "23";
}


$timestamp = strtotime("$yearsince/$monthsince/01");
$timestamp2 = strtotime("$yearuntil/$monthuntil/31");

$query = "SELECT longitudeE7, latitudeE7, count(*) FROM locations WHERE timestamp BETWEEN ($timestamp*1000) AND ($timestamp2*1000) GROUP BY longitudeE7,latitudeE7";
$result = $mysql_con->query($query);





echo '{"data":[';
    echo "\n";

            //AFTO EDW EINAI TO DATA. DO NOT TOUCH. ITS MAGIC
$k = 0;
$rowcnt = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result)) {

    echo '{"long":' . ($row['longitudeE7']*0.0000001) . ",";
    echo '"latit": ' . ($row['latitudeE7']*0.0000001) . ",";
    if ($k != ($rowcnt-1))
    {
    echo '"count": ' . $row['count(*)'] . "},";
    echo "\n";
    $k++;
    }
    else {
        echo '"count": ' . $row['count(*)'] . "}";
        echo "\n";
    }

}
echo "]}";
?>

//SELECT longitudeE7, latitudeE7, count(*) FROM locations WHERE day(from_unixtime(timestamp/1000)) BETWEEN 1 AND 4 AND hour(from_unixtime(timestamp/1000)) BETWEEN 1 AND 4 AND month(from_unixtime(timestamp/1000)) BETWEEN 1 AND 4 AND YEAR(from_unixtime(timestamp/1000)) between 2019 and 2020 GROUP BY  longitudeE7,latitudeE7