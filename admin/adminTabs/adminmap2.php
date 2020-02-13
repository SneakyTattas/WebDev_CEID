<?php

    require_once("../../php_files/DBhandler.php");
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
    /*$type = "";
    if(isset($_GET['types[]'])){

        while($row = $_GET['types[]'])
        {
            $type .= ' type="'.$row.'" OR';
        }
        $type = substr($type, 0, -3);
        }else{
            $type = " 1";
        }*/
    
    $queryselect = "SELECT longitudeE7, latitudeE7, count(*) FROM locations WHERE day(from_unixtime(timestamp/1000)) BETWEEN $daysince AND $dayuntil AND hour(from_unixtime(timestamp/1000)) BETWEEN $hoursince AND $houruntil AND month(from_unixtime(timestamp/1000)) BETWEEN $monthsince AND $monthuntil AND YEAR(from_unixtime(timestamp/1000)) between $yearsince AND $yearuntil GROUP BY  longitudeE7,latitudeE7,type";
    $resultselect = $mysql_con->query($queryselect);
    


    echo '{"data":[';
        echo "\n";
    
                //AFTO EDW EINAI TO DATA. DO NOT TOUCH. ITS MAGIC
    $k = 0;
    $rowcnt = mysqli_num_rows($resultselect);
    while($row = mysqli_fetch_array($resultselect)) {
    
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