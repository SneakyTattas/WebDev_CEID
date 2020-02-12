<?php
require("../login/DBhandler.php");
session_start();
$userid = $_SESSION["username"];
$k = 0;

//grafhma

$thisMonthEcoScore = 'SELECT ( select count(*) from locations where (username="'.$userid.'") AND (year(from_unixtime(timestamp/1000)) = year(current_date)) AND (month(from_unixtime(timestamp/1000)) = month(current_date)) AND (type="ON_FOOT" OR type="RUNNING" OR type="WALKING" OR type="ON_BICYCLE")) as econetries, ( select count(*) from locations where (username="'.$userid.'") AND (year(from_unixtime(timestamp/1000)) = year(current_date)) AND (month(from_unixtime(timestamp/1000)) = month(current_date)) AND type!="UNKNOWN") as entries';
$thisMonthEcoResult = $mysql_con->query($thisMonthEcoScore);
$thisMonthEcoArray = mysqli_fetch_all($thisMonthEcoResult);
$thisMonthEcoPercentage = 100 * ($thisMonthEcoArray[0][0]/$thisMonthEcoArray[0][1]);
$jsonObject = '{"data":[';

for ($j = 0; $j<12; $j++){
    $k = $j-11;
    $l = $j-10;
    $lastmonth = strtotime("$k months");
    $almostlastmonth = strtotime("$l months");
    $thisMonthEcoScores = 'SELECT (select count(*) from locations where (username="'.$userid.'") AND ((timestamp/1000) BETWEEN '.$lastmonth.' AND '.$almostlastmonth.') AND (type="ON_FOOT" OR type="RUNNING" OR type="WALKING" OR type="ON_BICYCLE")) as econetries, ( select count(*) from locations where ((timestamp/1000) between '.$lastmonth.' and '.$almostlastmonth.' AND username="'.$userid.'") AND type!="UNKNOWN") as entries';
    $resultquery = $mysql_con->query($thisMonthEcoScores);
    $thisMonthEcoArrays = mysqli_fetch_all($resultquery);
    
    if ($thisMonthEcoArrays[0][1] == 0){
        $thisMonthEcoPercentages = 0;
    }
    else {
        $thisMonthEcoPercentages = 100 * ($thisMonthEcoArrays[0][0]/$thisMonthEcoArrays[0][1]);
    }
    if ($j<11){
    $jsonObject .= $thisMonthEcoPercentages.",";
    }
    else{
        $jsonObject .= $thisMonthEcoPercentages .'],"currentmonth":'.$thisMonthEcoPercentage.', "labels":[ ';
    }
}

for ($j = 0; $j<12; $j++){
    $m = $j-11;
    $month = strtotime("$m months");
    $TheMonth = date("F Y", ($month));
    if ($j<11)
    {
    $jsonObject .= '"'.$TheMonth.'",';
    }
    else {
        $jsonObject .= '"'.$TheMonth.'"],';
    }
}


    $jsonObject .= '"QueryB":[';

//leaderboard 
//gia tous 3
$queryLeaderboard = "SELECT @rownum := @rownum + 1 AS rank, username, EcoScore FROM users, (SELECT @rownum := 0) r order by EcoScore desc LIMIT 3";
$resultLeaderboard = mysqli_fetch_all($mysql_con->query($queryLeaderboard));
for($k = 0; $k<3; $k++){
    $jsonObject .= '{"rank":' . $resultLeaderboard[$k][0] .",";
    $jsonObject .= '"username":"' . $resultLeaderboard[$k][1] .'",';
    if ($k < 2){
        $jsonObject .= '"EcoScore":' . $resultLeaderboard[$k][2] ."},";
    }
    else {
        $jsonObject .= '"EcoScore":' . $resultLeaderboard[$k][2] ."}],";
    }

}
//gia ton filo mas rank, onoma, ecoscore, last upload
$queryfilos = 'SELECT rank, EcoScore, LastUpload from (SELECT @rownum := @rownum + 1 AS rank, username, LastUpload, EcoScore FROM users, (SELECT @rownum := 0) r order by EcoScore desc) as x WHERE username = "'.$userid.'"';
$resultfilos = mysqli_fetch_all($mysql_con->query($queryfilos));
$jsonObject .= '"QueryC":{"rank":' . $resultfilos[0][0] . ', "EcoScore":' . $resultfilos[0][1] .', "LastUpload":"' . date("d.m.y", $resultfilos[0][2]) . '"},';



//timeframe tou location history
$historyts1 = "SELECT timestamp from locations where username = '$userid' order by timestamp DESC LIMIT 1";
$historyts2 = "SELECT timestamp from locations where username = '$userid' order by timestamp LIMIT 1";
$resultTs1 = mysqli_fetch_all($mysql_con->query($historyts1))[0][0];
$resultTs2 = mysqli_fetch_all($mysql_con->query($historyts2))[0][0];
$Result1 = date("d.m.y", ($resultTs1/1000));
$Result2 = date("d.m.y", ($resultTs2/1000));

$jsonObject .= '"QueryD":{"UploadStart":"' . $Result2 . '", "UploadEnd":"' . $Result1 .'"}}';

echo $jsonObject;
?>

