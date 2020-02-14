<?php require_once('../php_files/sessionValidate.php'); ?>
<!DOCTYPE html>
<html>
<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Eco-friendly CEIDades</title> 
        <script src="../lib/jquery.min.js"></script>
        <script src="../lib/oboe-browser.min.js" defer></script>
        <script src="../lib/prettysize.js" defer></script>
        <script src="../lib/Chart.js" defer></script>
        <script src="../lib/leaflet.js" defer></script>
        <script src="../lib/heatmap.js" defer></script>
        <script src="../lib/leaflet-heatmap.js" defer></script>
        <script src="../lib/leaflet.markercluster.js" defer></script>
        <link  rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu:300">
        <link rel="stylesheet" href="../lib/Chart.css">
        <link rel="stylesheet" href="../css_files/user.css">
        <link rel="shortcut icon" href="../Pictures/tree.ico">
        <link rel="stylesheet" href="../lib/leaflet.css">
        <link rel="stylesheet" href="../lib/MarkerCluster.default.css">
        <link rel="stylesheet" href="../lib/MarkerCluster.css">
</head>

<body>
    <div class="topnav">
      <div id="computer">
      <a href="./index.php" id="HomePage" > <div id="mobile"></div> <img src="../Pictures/tree.ico"></img> </a>
      <a class="tablinks" onclick="openAction(event, 'DataPresentation')" id="computerDP">Data Presentation</a>
      <a class="tablinks" onclick="openAction(event, 'Analysis')" id="computerAn">Analysis</a>
      <a class="tablinks" onclick="openAction(event, 'DataUpload')" id="computerDU">Data Upload</a>
      <a href="../php_files/logout.php" class="tablinks" style="float:right; margin-top: 50px;">Logout</a>
      </div>
      <div id="mobile" style="text-align: center;">
      <form style="display:inline-block;"> <select id="mobileForm"  onchange='openAction(event,document.getElementById("mobileForm").value)'>
        <option name=""disabled selected hidden>Choose Tab</option>
        <option name="DataPresentation" id="mobileDP">DataPresentation</option>
        <option name="'Analysis'" id="mobileAn">Analysis</option>
        <option name="'DataUpload'" id="mobileDU">DataUpload</option>
      </select>
    </form>
    <a href="../php_files/logout.php" class="tablinks" style="float:right; margin-top: 50px;" id="mobileButton">Logout</a>
      </div>

    </div>
    <div id="DataPresentation" class="tabcontent">
	    <script>
		  $("#DataPresentation").load("./html/DataPresentation.html");
		  </script>
    </div>
    <div id="Analysis" class="tabcontent">
        <script>
        $("#Analysis").load("./html/userAnalysis.html");
        $("#Analysis").on("click", function(){
        map1.invalidateSize();
        map.invalidateSize();
				});
        </script>
    </div>
    <div id="DataUpload" class="tabcontent">
		  <script>
			$("#DataUpload").load("./html/UploadMap.html");
			$("#DataUpload").on("click", function(){
        map.invalidateSize();
				});
		  </script>
    </div>

      <script src="../lib/tab_switch.js"></script>
		  <script>
      document.getElementById("computerDP").click();
      </script>
      
</body>