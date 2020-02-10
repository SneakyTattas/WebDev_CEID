

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
if(!$monthsince)
{
    $timestamp = strtotime("$yearsince/01/01");
}
else 
{
    $timestamp = strtotime("$yearsince/$monthsince/01");
}
if(!$monthuntil)
{
    $timestamp2 = strtotime("$yearuntil/12/31");
}
else 
{
    $timestamp2 = strtotime("$yearuntil/$monthuntil/31");
}


$sql="SELECT timestamp, longitudeE7, latitudeE7, accuracy, type FROM locations WHERE username = '$username' AND timestamp BETWEEN ($timestamp*1000) AND ($timestamp2*1000) ORDER BY timestamp ";
$result = $mysql_con->query($sql);
$queryA = "SELECT type,count(*) as counter FROM locations WHERE username = '$username' AND timestamp BETWEEN ($timestamp*1000) AND ($timestamp2*1000) GROUP BY type";
$queryB = "SELECT PeakHour, type, amount FROM (SELECT count(*) as amount,HOUR(FROM_UNIXTIME(timestamp/1000)) AS PeakHour,type FROM locations WHERE username = '$username' AND timestamp BETWEEN ($timestamp*1000) AND ($timestamp2*1000) group by PeakHour, type order by count(*) desc, type) as x group by type";
$queryC = "SELECT PeakDay, type, amount FROM (SELECT count(*) as amount,DAYNAME(FROM_UNIXTIME(timestamp/1000)) AS PeakDay,type FROM locations WHERE username = '$username' AND timestamp BETWEEN ($timestamp*1000) AND ($timestamp2*1000) group by PeakDay, type order by count(*) desc, type) as x group by type";
$queryD = "SELECT longitudeE7, latitudeE7, count(*) FROM locations WHERE username = '$username' AND timestamp BETWEEN ($timestamp*1000) AND ($timestamp2*1000) GROUP BY longitudeE7,latitudeE7";
$resultD = $mysql_con->query($queryD);
if (!$mysql_con->query($queryB)){ echo "ta pame";}
$resultA = $mysql_con->query($queryA);
$resultB = $mysql_con->query($queryB);
$resultC = $mysql_con->query($queryC);
$resultArowcnt = mysqli_num_rows($resultA);
$resultBrowcnt = mysqli_num_rows($resultB);
$resultCrowcnt = mysqli_num_rows($resultC);
$A = 0;
$B = 0;
$C = 0;
echo '{"setA": [';
echo "\n";
    while($row = mysqli_fetch_array($resultA)) {
        if ($A != ($resultArowcnt-1)){
        echo '{"'.$row['type'].'":'.$row['counter']."},";$A++;}
        else{
            echo '{"'.$row['type'].'":'.$row['counter']."}";}
        }
    
echo "],";
echo "\n";
echo '"setB":[{';
echo "\n";
    while($row = mysqli_fetch_array($resultB)) {
        if ($B != ($resultBrowcnt-1)){
            echo '"'.$B.'":[{"type":"'.$row['type'].'",';
            echo '"peakhour":'.$row['PeakHour'].",";
            echo '"amount":'.$row['amount']."}],";
            $B++;
        }
        else {
            echo '"'.$B.'":[{"type":"'.$row['type'].'",';
                echo '"peakhour":'.$row['PeakHour'].",";
                echo '"amount":'.$row['amount']."}]";
        }
    }
    echo "}],";
    echo "\n";
echo '"setC":[{';
echo "\n";
    while($row = mysqli_fetch_array($resultC)) {
        if ($C != ($resultCrowcnt-1)){
            echo '"'.$C.'":[{"type":"'.$row['type'].'",';
            echo '"peakday":"'.$row['PeakDay'].'",';
            echo '"amount":'.$row['amount']."}],";
            $C++;
        }
        else{
            echo '"'.$C.'":[{"type":"'.$row['type'].'",';
                echo '"peakday":"'.$row['PeakDay'].'",';
                echo '"amount":'.$row['amount']."}]";
        }
    }
    echo "}],";
    echo "\n";
    echo '"data":[';
    echo "\n";

            //AFTO EDW EINAI TO DATA. DO NOT TOUCH. ITS MAGIC
$k = 0;
$rowcnt = mysqli_num_rows($resultD);
while($row = mysqli_fetch_array($resultD)) {

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
        //MEXRI EDW HTAN TO DATA. YOU CAN TOUCH
mysqli_close($mysql_con);
?>