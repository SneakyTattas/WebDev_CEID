<?php
require_once("../../php_files/DBhandler.php");
$queryA ="SELECT type, count(*) as amount FROM locations GROUP BY type";
$queryALL ="SELECT count(*) as amount FROM locations";
$queryB = "SELECT username,count(*) as amount FROM locations GROUP BY username";
$queryC = "SELECT x,count(*) from (Select *, monthname(from_unixtime(timestamp/1000))as x from locations) as X group by x";
$queryD = "SELECT x,count(*) from (Select *, DAYNAME(from_unixtime(timestamp/1000))as x from locations) as y group by x";
$queryE = "SELECT x,count(*) from (Select *, hour(from_unixtime(timestamp/1000))as x from locations) as y group by x";
$queryF = "SELECT x,count(*) from (Select *, year(from_unixtime(timestamp/1000))as x from locations) as y group by x";

$result1 = mysqli_fetch_all($mysql_con->query($queryA));
$result2 = mysqli_fetch_all($mysql_con->query($queryB));
$result3 = mysqli_fetch_all($mysql_con->query($queryC));
$result4 = mysqli_fetch_all($mysql_con->query($queryD));
$result5 = mysqli_fetch_all($mysql_con->query($queryE));
$result6 = mysqli_fetch_all($mysql_con->query($queryF));


// AdminData:[
 //   "labelsA": [d, j ,], "dataA":[4 , 7],
$l = 1;
$data = "data";
$label = "label";
$result = "result";
$str = "{";
for ($l = 1; $l < 7; $l++)
{
$random = "{$result}{$l}";
$PLabel = "{$label}{$l}";
$PData = "{$data}{$l}";
$k = 0;
$j = 0;
$str .= '"'.$PLabel.'":[';
    while(next($$random)){
        $str.='"'. $$random[$k][0].'",';
        $k++;
    }
    if ($l == 6){
        $str.='"'.$$random[$k][0].'"],';
    }
    else{$str.='"'.$$random[$k][0].'"],';}
    $str .= '"'.$PData.'":[';
    reset($$random);
    while(next($$random)){
        $str.= $$random[$j][1].',';
        $j++;
    }
    if ($l == 6){
        $str.=''.$$random[$j][1].']},';
    }
    else{$str.=$$random[$j][1].'],';}
}


$str = rtrim($str, ",");
echo $str;
?>