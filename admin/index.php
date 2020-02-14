  
<?php
session_start();
if ($_SESSION["isAdmin"] == false){
	header('Location: http://' . $_SERVER['HTTP_HOST'] . '/index.html');
}
?>
<html>
	<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Eco-friendly CEIDades</title> 
		<link rel="stylesheet" href="../css_files/user.css" type="text/css">
		<link rel="stylesheet" href="../css_files/admin.css" type="text/css">
		<link rel="stylesheet" href="../lib/leaflet.css" type="text/css">
		<link rel="shortcut icon" href="../Pictures/tree.ico">
        <script src="../lib/jquery.min.js"></script>
		<script src="../lib/Chart.js"></script>
        <script src="../lib/leaflet.js" ></script>
        <script src="../lib/heatmap.js" ></script>
        <script src="../lib/leaflet-heatmap.js"></script>
	</head>
	<body>
	<div class="topnav" id="topnav">
		<a href="#dbstate" id ="dbstate" class="tablinks">Database state</a>
		<a href="#map" id ="map"class="tablinks">Heatmap representation</a>
		<a href="#deleteData" id="deleteData"class="tablinks"> Clear database </a>
		<a href="#exportData" id="exportData"class="tablinks"> Export data</a>
		<a href="../php_files/logout.php"class="tablinks" style="float:right">Logout </a>
		</div>
		<div class="container" id="container">
		<script> $("#container").load("./adminTabs/dbstateI.php"); </script>
		</div>
	<script>
	$("#dbstate").on("click", function(){
		$("#container").fadeOut(0);
		$("#container").load("./adminTabs/dbstateI.php");
		$("#container").fadeIn(1000);

	});
	$("#map").on("click", function(){
		$("#container").fadeOut(0);
		$("#container").load("./adminTabs/adminmapI.php");
		$("#container").fadeIn(1000);
  	});
	$("#deleteData").on("click", function(){
		$("#container").fadeOut(0);
		$("#container").load("./adminTabs/deleteDataI.php");
		$("#container").fadeIn(1000);
	});
	$("#exportData").on("click", function(){
		$("#container").fadeOut(0);
		$("#container").load("./adminTabs/exportDataI.php");
		$("#container").fadeIn(1000);
	});
	</script>
	</body>
</html>
