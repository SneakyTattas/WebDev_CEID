

<?php
session_start();
$username = $_SESSION["username"];
$timestamp = 0;
$timestamp2 = 0;

require("../login/DBhandler.php");
$monthsince = intval($_GET['monthsince']);
$yearsince = intval($_GET['yearsince']);
//echo $yearsince;
//echo "\n";
$monthuntil = intval($_GET['monthuntil']);
$yearuntil = intval($_GET['yearuntil']);
//echo $yearuntil;
//echo "\n";
if(!$monthsince)
{
    $timestamp = strtotime("$yearsince/01/01");
    //echo ("Geia sou eimai to str to time: ".strtotime("$yearsince/01/01"). " ! ");
    //echo $timestamp;
}
else 
{
    $timestamp = strtotime("$yearsince/$monthsince/01");
}
if(!$monthuntil)
{
    $timestamp2 = strtotime("$yearuntil/12/31");
    //echo ("Geia sou eimai to str to time until:" .strtotime("$yearuntil/12/31"). "!");
    //echo $timestamp2;
}
else 
{
    $timestamp2 = strtotime("$yearuntil/$monthuntil/31");
}


$sql="SELECT timestamp, longitudeE7, latitudeE7, accuracy, type FROM locations WHERE username = '$username' AND timestamp BETWEEN ($timestamp*1000) AND ($timestamp2*1000) ORDER BY timestamp ";
$result = $mysql_con->query($sql);
$queryA = "SELECT type,count(*) FROM locations WHERE username = '$username' GROUP BY type";
$queryD = "SELECT longitudeE7, latitudeE7, count(*) FROM locations WHERE username = '$username' AND timestamp BETWEEN ($timestamp*1000) AND ($timestamp2*1000) GROUP BY longitudeE7,latitudeE7";
$resultD = $mysql_con->query($queryD);

/*echo '{"locations" : [{
    Location[i] : [{logitude }]

    }], 
        "percentages" : 
        [{ "percentages" : [{"type[i]": timi, 
                }], 
                "BestHour" : ,
                "BestDay" : 
                }]
            }' */

            //AFTO EDW EINAI TO DATA. DO NOT TOUCH. ITS MAGIC
$k = 0;
$rowcnt = mysqli_num_rows($resultD);
echo '{"data":[';
echo "\n";
while($row = mysqli_fetch_array($resultD)) {

    //echo '"location'.$k.'":';
    echo '{"long":' . $row['longitudeE7'] . ",";
    echo '"latit": ' . $row['latitudeE7'] . ",";
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
        //TO KATW VRISKEI EGGRAFES ANA EVDOMADA ASXETOU ETOUS KAI TO PLITHOS ANA EVDOMADA. OMOIWS ANA MERA KAI ANA ETOS
        //SELECT WEEK(FROM_UNIXTIME(timestamp/1000)) AS TEST,count(*) FROM locations WHERE username = 'aristomenis' group by TEST 
mysqli_close($mysql_con);
?>