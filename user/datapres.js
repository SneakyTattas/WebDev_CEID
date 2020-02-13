function callme(){
var data;
var labels;
var response;
if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp = new XMLHttpRequest();
} else {
    // code for IE6, IE5
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
}

xmlhttp.open("POST", "DataPreza.php",true);
xmlhttp.send();
xmlhttp.onreadystatechange = function()
{
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
        document.getElementById("PresButton").remove();
        document.getElementById("placeholder").remove();
    response = JSON.parse(xmlhttp.responseText);
    data = response.data;
    labels = response.labels;
    Chart.defaults.global.defaultFontColor = '#c7c7c7';
    new Chart(document.getElementById("dikomas"),
    {type:"line",
        data:
            {labels: labels,
            datasets:[
            {label:"Eco Score %",
                data: data
                ,fill:false,
                borderColor:"rgb(255, 51, 0)",
                lineTension:0.1}]},options:{
                }});
    console.log(response);
    LeaderTable();
    myInfo();


    data = response.data;
    }
};
function LeaderTable(){
var LBoard = document.getElementById("LDiv"); 
        LBoard.innerHTML = "" ;
        var LBoard = document.getElementById("LDiv");
        LBoard.innerHTML ="";
        var table = document.createElement("table");
        table.setAttribute("class", "myTable");
        var tr = document.createElement("tr");
        tr.setAttribute("class", "trPresentation");
        table.appendChild(tr);
        var th = document.createElement("th");
        th.setAttribute("class", "thPresentation");
        th.appendChild(document.createTextNode("Rank"));
        var th2 = document.createElement("th");
        th2.setAttribute("class", "thPresentation");
        th2.appendChild(document.createTextNode("User"));
        var th3 = document.createElement("th");
        th3.setAttribute("class", "thPresentation");
        th3.appendChild(document.createTextNode("Eco Score"));
        tr.appendChild(th);
        tr.appendChild(th2);
        tr.appendChild(th3);
        for (var i in response.QueryB){
            LBoard.appendChild(table);
        var row = table.insertRow((parseInt(i))+1);
        row.setAttribute("class", "trPresentation");
        var cell1 = row.insertCell(0);
        cell1.setAttribute("class", "tdPresentation");
        var cell2 = row.insertCell(1);
        cell2.setAttribute("class", "tdPresentation");
        var cell3 = row.insertCell(2);
        cell3.setAttribute("class", "tdPresentation");
        cell1.innerHTML = response.QueryB[i].rank;
        cell2.innerHTML = response.QueryB[i].username;
        cell3.innerHTML = response.QueryB[i].EcoScore;
        }
        LBoard.innerHTML += "</table>";
    }

function myInfo(){
    var ThisMonthEcoScore = response.currentmonth;
    var myRank = response.QueryC.rank;
    var myEcoScore = response.QueryC.EcoScore;
    var myLastUpload = response.QueryC.LastUpload;

    var myFileStarts = response.QueryD.UploadStart;
    var myFileEnds = response.QueryD.UploadEnd;
    var infodiv1 = document.getElementById("Stats1");
    infodiv1.innerHTML +="<center>Your Eco-transport score for the past month: <h2>" + ThisMonthEcoScore.toFixed(2) + "%</center> </h2>";


    var infodiv2 = document.getElementById("Stats2");
    infodiv2.innerHTML += "<center>Your rank is:  <big>" + myRank + "</big><br>";
    infodiv2.innerHTML += "with an Eco Score of:   <big>" +myEcoScore + "</center></big>";

    var infodiv3 = document.getElementById("Stats3");
    infodiv3.innerHTML += "Your last file upload was:  <big>" + myLastUpload + "</big>";
    infodiv3.innerHTML += "<br> and the period of your location history was  <big>" + myFileStarts + " - " + myFileEnds + "</big>";
}
}