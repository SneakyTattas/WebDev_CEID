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
        $monthsince = "1";
    }
    if(!$monthuntil)
    {
        $monthuntil = "12";
    
    }
    if(!$yearsince)
    {
        $yearsince = "1970";
    
    }
    if(!$yearuntil)
    {
        $yearuntil = "3000";
    }
    if(!$daysince)
    {
        $daysince = "1";
    }
    if(!$dayuntil)
    {
        $dayuntil = "7";
    }
    if(!$hoursince)
    {
        $hoursince = "0";
    }
    if(!$houruntil)
    {
        $houruntil = "23";
    }
    
    $type = '(type ="';
    if(isset($_GET['types'])){

            $type .= implode($_GET['types'], '" OR type="');
            
            $type .='")';
          //  echo $type;
        }
        
        if ($_GET['types'] == "")
        {
            $type = 1;
        }

    $queryselect1 = "SELECT latitudeE7, longitudeE7, count(*) FROM LOCATIONS WHERE day(from_unixtime(timestamp/1000)) BETWEEN ";
    $queryselect2 = $daysince . " AND " . $dayuntil . " AND ";
    $queryselect3 = "HOUR(FROM_UNIXTIME(timestamp/1000)) BETWEEN ";
    $queryselect4 = $hoursince . " AND " . $houruntil . " AND ";
    $queryselect5 = "MONTH(FROM_UNIXTIME(timestamp/1000)) BETWEEN ";
    $queryselect6 = $monthsince . " AND " .$monthuntil . " AND ";
    $queryselect7 = "YEAR(FROM_UNIXTIME(timestamp/1000)) BETWEEN ";
    $queryselect8 = $yearsince . " AND " . $yearuntil . " AND ";
    $queryselect9 = $type;
    $queryselect10 = "GROUP BY latitudeE7, longitudeE7 ";


    $finalquery = $queryselect1.$queryselect2.$queryselect3.$queryselect4.$queryselect5.$queryselect6.$queryselect7.$queryselect8.$queryselect9.$queryselect10;
    

    $resultselect = $mysql_con->query($finalquery);

    


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