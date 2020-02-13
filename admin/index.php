  
<?php
session_start();
if ($_SESSION["isAdmin"] == false){
	header('Location: http://' . $_SERVER['HTTP_HOST'] . '/index.html');
}
?>
<html>
	<head>
	<link rel="stylesheet" href="../css_files/user.css" type="text/css">
	<link rel="stylesheet" href="./admin.css" type="text/css">
	<script src="/user/leaflet.js"></script>
	<script src="/user/heatmap.js"></script>
	<script src="../../user/leaflet-heatmap.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	</head>
	<body>
	<div class="topnav" id="topnav">
		<a href="#dbstate" id ="dbstate" class="tablinks"> Απεικόνηση κατάστασης βάσης </a>
		<a href="#map" id ="map"class="tablinks"> Απεικόνηση στοιχείων σε χάρτη</a>
		<a href="#deleteData" id="deleteData"class="tablinks"> Διαγραφή δεδομένων </a>
		<a href="#exportData" id="exportData"class="tablinks"> Εξαγωγή δεδομένων </a>
		<a href="./logout.php"class="tablinks" style="float:right"> Αποσύνδεση </a>
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
