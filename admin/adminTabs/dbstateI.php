  
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
        <div id="placeholderstate">
            <h1 id = "placeholderstate"> <Center>Click the button to fetch graphs of current db state (you can also refresh with it)</Center> </h1>
            <div><center><button type="button" id="PresButtonstate" class="uploadButton" onclick="state()"> Click me </button></center></div>
        </div>
        <div class="gridstate">
            <div id="erwthmaA">
                <script src="/admin/adminTabs/dbstate.js" defer></script>
                <canvas id="chart1" class="chartjs" width="468" height="234" style="display: block; width: 468px; height: 234px;"></canvas>

            </div>
            <div id="erwthmaB">
                <canvas id="chart2" class="chartjs" width="468" height="234" style="display: block; width: 468px; height: 234px;"></canvas>
            </div>
            <div id="erwthmaC">
                <canvas id="chart3" class="chartjs" width="468" height="234" style="display: block; width: 468px; height: 234px;"></canvas>
            </div>
            <div id="erwthmaD">
                <canvas id="chart4" class="chartjs" width="468" height="234" style="display: block; width: 468px; height: 234px;"></canvas>
            </div>
            <div id="erwthmaE">
                <canvas id="chart5" class="chartjs" width="468" height="234" style="display: block; width: 468px; height: 234px;"></canvas>
            </div>
            <div id="erwthmaF">
                <canvas id="chart6" class="chartjs" width="468" height="234" style="display: block; width: 468px; height: 234px;"></canvas>
            </div>
        </div>

</body>
</html>