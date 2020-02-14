<?php
require_once("../../php_files/DBhandler.php");
require_once("../../php_files/sessionValidate.php");

if ($_SESSION['isAdmin'] == 1)
{
    $filename=$_SESSION['username'];
$JSONfile = fopen("JSONFile(".$filename.").json", "wr+") or die("Unable to open json file!");
$CSVfile = fopen("CSVfile(".$filename.").csv", "wr+") or die("Unable to open csv file!");
$KMLfile = fopen("KMLfile(".$filename.").kml", "wr+") or die("Unable to open kml file!");
fwrite($JSONfile, '{"locations":[');
fwrite($CSVfile, '"Timestamp", "longitudeE7", "latitudeE7", "accuracy", "activity", "userID"'.PHP_EOL);
fwrite($KMLfile, '<?xml version="1.0" encoding="UTF-8"?><kml xmlns="http://www.opengis.net/kml/2.2" xmlns:gx="http://www.google.com/kml/ext/2.2"><Document><Placemark><open>1</open><gx:Track><altitudeMode>clampToGround</altitudeMode>');
$queryjson = "select timestamp, latitudeE7 , longitudeE7 , accuracy, type, users.userID from locations INNER JOIN users ON users.username = locations.username";
$queryKML = 'select longitudeE7, latitudeE7, DATE_FORMAT(from_unixtime(timestamp/1000), "%Y-%m-%dT%H:%i:%sZ") AS date_formatted, users.userID	FROM locations INNER JOIN users where locations.username = users.username';
$resultjson = $mysql_con->query($queryjson);
$resultKML = $mysql_con->query($queryKML);
while($row = mysqli_fetch_array($resultjson))
{
  fwrite($JSONfile, "{");
  $queryjson = $row['timestamp'];
  fwrite($JSONfile,'"timestamp": ' . $queryjson .",");
  fwrite($CSVfile, $queryjson. ',');
  $queryjson = $row['latitudeE7'];
  fwrite($JSONfile,'"latitudeE7": ' . $queryjson .",");
  fwrite($CSVfile, $queryjson. ',');
  $queryjson = $row['longitudeE7'];
  fwrite($JSONfile,'"longitudeE7": ' . $queryjson. ",");
  fwrite($CSVfile, $queryjson. ',');
  $queryjson = $row['accuracy'];
  fwrite($JSONfile,'"accuracy":' . $queryjson . ",");
  fwrite($CSVfile, $queryjson. ',');
  $queryjson = $row['type'];
  fwrite($JSONfile,'"activity": "' . $queryjson. '",');
  fwrite($CSVfile, '"'.$queryjson.'",');
  $queryjson = $row['userID'];
  fwrite($JSONfile, '"userID": "' . $queryjson .'"},'.PHP_EOL);
  fwrite($CSVfile, '"'.$queryjson.'"'.PHP_EOL);
}
while($row = mysqli_fetch_array($resultKML))
{
    $queryKML1 = $row['date_formatted'];
    $queryKML2 = ($row['longitudeE7']/10000000);
    $queryKML3 = ($row['latitudeE7']/10000000);
    $queryKML4 = $row['userID'];
    fwrite($KMLfile, "<when>" .$queryKML1. "</when>".PHP_EOL ."<gx:coord>". $queryKML2. " " .$queryKML3 . " 0</gx:coord><userid>". $queryKML4 . "</userid>".PHP_EOL);
}

$position = fstat($JSONfile)['size']-3;
ftruncate($JSONfile, fstat($JSONfile)['size']-3);
fseek($JSONfile, ($position));
fwrite($JSONfile, "]}");
fclose($JSONfile);

$positionCSV = fstat($CSVfile)['size']-1;
ftruncate($CSVfile, fstat($CSVfile)['size']-2);
fseek($CSVfile, ($positionCSV-1));
fclose($CSVfile);


$positionKML = fstat($KMLfile)['size']-1;
ftruncate($KMLfile, fstat($KMLfile)['size']-2);
fseek($KMLfile, ($positionKML-1));
fwrite($KMLfile, "</gx:Track></Placemark></Document></kml>");
fclose($KMLfile);

 $zip = new ZipArchive;
 if($zip->open('locationexports('.$filename.').zip', ZipArchive::CREATE) === TRUE)
 {
     $zip->addFile('CSVfile('.$filename.').csv');
     $zip->addFile('JSONfile('.$filename.').json');
     $zip->addFile('KMLfile('.$filename.').kml');
     $zip->close();
 }
 $file = 'locationexports('.$filename.').zip';
 header("Content-type: application/zip");
 header("Content-Disposition: attachment;filename=locationexports.zip");
 header("Content-Transfer-Encoding: binary"); 
 header('Pragma: no-cache'); 
 header('Expires: 0');
 // Send the file contents.
 set_time_limit(0);
 ob_clean();
 flush();
 readfile($file);
}
?>