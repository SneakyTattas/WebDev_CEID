  
<?php
session_start();
if ($_SESSION["isAdmin"] == false){
	header('Location: http://' . $_SERVER['HTTP_HOST'] . '/index.html');
}
?>
<html>
	<head>
	<link rel="stylesheet" href="./footer.css" type="text/css">
	<link rel="stylesheet" href="./login.css" type="text/css">
	<link rel="stylesheet" href="./grid.css" type="text/css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	</head>
	<body>
	<div class="topnav" id="topnav">
		<a href="#dbstate" id ="dbstate"> Απεικόνηση κατάστασης βάσης </a>
		<a href="#map" id ="map"> Απεικόνηση στοιχείων σε χάρτη</a>
		<a href="#deleteData" id="deleteData"> Διαγραφή δεδομένων </a>
		<a href="#exportData" id="exportData"> Εξαγωγή δεδομένων </a>
		<a href="./logout.php" class="dc" id="dc"> Αποσύνδεση </a>
		</div>
		<div class="container" id="container"></div>
		
	<div class="footer" id="adminfooter">
	<a href="../about/"><p> About</p> </a>
	</div>
	<script>
	$("#dbstate").on("click", function(){
		$("#tabcontent").fadeOut(0);
		$("#tabcontent").load("./adminTabs/dbstate.html");
		$("#tabcontent").fadeIn(1000);

	});
	$("#map").on("click", function(){
		$("#tabcontent").fadeOut(0);
		$("#tabcontent").load("./adminTabs/map.html");
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
