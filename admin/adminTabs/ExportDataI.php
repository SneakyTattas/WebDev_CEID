  
<?php
session_start();
if ($_SESSION["isAdmin"] == false){
	header('Location: http://' . $_SERVER['HTTP_HOST'] . '/index.html');
}
?>

<html>
    <head>

    </head>
    <body>     
        <h2><b>Click here to download a zip file of all records.</b></h2>
        <h4>File includes csv, json and kml formats</h4>
        <button id="ExportButton" class="uploadButton" onclick="location.href='./adminTabs/export.php'; name='locationhistoryX'">Press here!</button>
        <script>
        
        </script>
        
    </body>
</html>