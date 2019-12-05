  
<?php
session_start();
if ($_SESSION["isAdmin"] == false){
	header('Location: http://' . $_SERVER['HTTP_HOST'] . '/index.html');
}
?>
<html>
	<head>
	<link rel="stylesheet" href="../footer.css" type="text/css">
	<link rel="stylesheet" href="../login.css" type="text/css">
	<link rel="stylesheet" href="./grid.css" type="text/css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	</head>
	<body>
	<div class="topnav" id="topnav">
		<a href="#akv" id ="dbstate"> Απεικόνηση κατάστασης βάσης </a>
		<a href="#asx" id ="map"> Απεικόνηση στοιχείων σε χάρτη</a>
		<a href="#dd" id="deleteData"> Διαγραφή δεδομένων </a>
		<a href="#ed" id="explortData"> Εξαγωγή δεδομένων </a>
		<a href="./logout.php" class="dc" id="dc"> Αποσύνδεση </a>
		</div>
		<div class="container" id="container"></div>
		
	<div class="footer" id="adminfooter">
	<a href="../about/"><p> About</p> </a>
	</div>
	<script>
	$("#dbstate").on("click", function(){
		$("#container").fadeOut(0);
		$("#container").load("dbstate.html");
		$("#container").fadeIn(1000);

	});
	$("#map").on("click", function(){
		$("#container").fadeOut(0);
		$("#container").load("map.html");
		$("#container").fadeIn(1000);
	});
	$("#deleteData").on("click", function(){
		$("#container").fadeOut(0);
		$("#container").load("deleteData.html");
		$("#container").fadeIn(1000);
	});
	$("#exportData").on("click", function(){
		$("#container").fadeOut(0);
		$("#container").load("exportData.html");
		$("#container").fadeIn(1000);
	});
	</script>
	
	</body>
</html>
