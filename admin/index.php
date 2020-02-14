  
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
		<link rel="shortcut icon" href="../Pictures/tree.ico">
        <script src="../lib/jquery.min.js"></script>
        <script src="../lib/Chart.js" defer></script>
        <script src="../lib/leaflet.js" defer></script>
        <script src="../lib/heatmap.js" defer></script>
        <script src="../lib/leaflet-heatmap.js" defer></script>
	</head>
	<body>
	<div class="topnav" id="topnav">
		<a href="#dbstate" id ="dbstate" class="tablinks"> Απεικόνηση κατάστασης βάσης </a>
		<a href="#map" id ="map"class="tablinks"> Απεικόνηση στοιχείων σε χάρτη</a>
		<a href="#deleteData" id="deleteData"class="tablinks"> Διαγραφή δεδομένων </a>
		<a href="#exportData" id="exportData"class="tablinks"> Εξαγωγή δεδομένων </a>
		<a href="../php_files/logout.php"class="tablinks" style="float:right"> Αποσύνδεση </a>
		</div>
		<div class="container" id="container">
		<script> $("#container").load("./adminTabs/dbstate.html"); </script>
		</div>
	<script>
	$("#dbstate").on("click", function(){
		$("#container").fadeOut(0);
		$("#container").load("./adminTabs/dbstate.html");
		$("#container").fadeIn(1000);

	});
	$("#map").on("click", function(){
		$("#container").fadeOut(0);
		$("#container").load("./adminTabs/adminmap.html");
		$("#container").fadeIn(1000);
  	});
	$("#deleteData").on("click", function(){
		$("#container").fadeOut(0);
		$("#container").load("./adminTabs/deleteData.html");
		$("#container").fadeIn(1000);
	});
	$("#exportData").on("click", function(){
		$("#container").fadeOut(0);
		$("#container").load("./adminTabs/exportData.html");
		$("#container").fadeIn(1000);
	});
	</script>
	</body>
</html>
