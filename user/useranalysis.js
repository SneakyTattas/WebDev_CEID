var monthsince;
var yearsince;
var monthuntil;
var yearuntil;
var data;
var response;
function showDate(monthsince,yearsince,monthuntil,yearuntil) {
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("txtHint").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET","Analysis.php?monthsince="+monthsince+"&yearsince="+yearsince+"&monthuntil="+monthuntil+"&yearuntil="+yearuntil,true);
    xmlhttp.send();
    xmlhttp.onreadystatechange = function()
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
        response = JSON.parse(xmlhttp.responseText);
        console.log(response);


        data = response.data;
        on200();
        //document.getElementById("test").innerHTML = response;
    }
}
}
function getForms()
{
monthsince = document.getElementById("monthsince").value;
yearsince = document.getElementById("yearsince").value;
monthuntil = document.getElementById("monthuntil").value;
yearuntil = document.getElementById("yearuntil").value;
showDate(monthsince, yearsince, monthuntil, yearuntil);
}
var baseLayer = L.tileLayer(
    'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{
        attribution: '...',
        maxZoom: 16,
        minZoom: 13
    }
    );
    var map1 = new L.Map('map1', {
    center: new L.LatLng(38.2466, 21.7345),
    zoom: 4,
    layers: [baseLayer]
    });

var cfg = {
// radius should be small ONLY if scaleRadius is true (or small radius is intended)
// if scaleRadius is false it will be the constant radius used in pixels
"radius": 0.0013,
"maxOpacity": .8,
// scales the radius based on map zoom
"scaleRadius": true,
// if set to false the heatmap uses the global maximum for colorization
// if activated: uses the data maximum within the current map boundaries
//   (there will always be a red spot with useLocalExtremas true)
"useLocalExtrema": true,
// which field name in your data represents the latitude - default "lat"
latField: 'long',
// which field name in your data represents the longitude - default "lng"
lngField: 'latit',
// which field name in your data represents the data value - default "value"
valueField: 'count'
};
var heatmapLayer = new HeatmapOverlay(cfg);
map1.addLayer(heatmapLayer);

function on200(){
var testData = {
max: data.length,
// data: [{lat: 24.6408, lng:46.7728, count: 3},{lat: 50.75, lng:-1.55, count: 1}]
data
};
console.log(testData);
heatmapLayer.setData(testData);}

function getTable(){
    var tabledivA = document.getElementById("resultTableA");
    switch (document.getElementById("tableSelect").value){
    default: 
        tabledivA.innerHTML = "" ;
    break;
    case "1":
        var tabledivA = document.getElementById("resultTableA");
        tabledivA.innerHTML ="";
        var table = document.createElement("table");
        table.setAttribute("class", "myTable");
        var tr = document.createElement("tr");
        tr.setAttribute("class", "trAnalysis");
        table.appendChild(tr);
        var th = document.createElement("th");
        th.setAttribute("class", "thAnalysis");
        th.appendChild(document.createTextNode("Type"));
        var th2 = document.createElement("th");
        th2.setAttribute("class", "thAnalysis");
        th2.appendChild(document.createTextNode("Counter"));
        tr.appendChild(th);
        tr.appendChild(th2);
        for (var i in response.setA){
            tabledivA.appendChild(table);
        var row = table.insertRow((parseInt(i))+1);
        row.setAttribute("class", "trAnalysis");
        var cell1 = row.insertCell(0);
        cell1.setAttribute("class", "tdAnalysis");
        var cell2 = row.insertCell(1);
        cell2.setAttribute("class", "tdAnalysis");
        cell1.innerHTML = response.setA[i].type;
        cell2.innerHTML = response.setA[i].counter;
        }
        tabledivA.innerHTML += "</table>";
    break;
    case "2":
        var tabledivB = document.getElementById("resultTableB");
        tabledivB.innerHTML ="";
        var table = document.createElement("table");
        table.setAttribute("class", "myTable");
        var tr = document.createElement("tr");
        tr.setAttribute("class", "trAnalysis");
        table.appendChild(tr);
        var th = document.createElement("th");
        th.setAttribute("class", "thAnalysis");
        th.appendChild(document.createTextNode("Type"));
        var th2 = document.createElement("th");
        th2.setAttribute("class", "thAnalysis");
        th2.appendChild(document.createTextNode("Peak Hour"));
        var th3 = document.createElement("th");
        th3.setAttribute("class", "thAnalysis");
        th3.appendChild(document.createTextNode("Amount"));
        tr.appendChild(th);
        tr.appendChild(th2);
        tr.appendChild(th3);
        for (var i in response.setA){
            tabledivB.appendChild(table);
        var row = table.insertRow((parseInt(i))+1);
        row.setAttribute("class", "trAnalysis");
        var cell1 = row.insertCell(0);
        cell1.setAttribute("class", "tdAnalysis");
        var cell2 = row.insertCell(1);
        cell2.setAttribute("class", "tdAnalysis");
        var cell3 = row.insertCell(2);
        cell3.setAttribute("class", "tdAnalysis");
        cell1.innerHTML = response.setB[i].type;
        cell2.innerHTML = response.setB[i].peakhour;
        cell3.innerHTML = response.setB[i].amount;
        }
        tabledivB.innerHTML += "</table>";
    break;
    case "3":
        var tabledivC = document.getElementById("resultTableC");
        tabledivC.innerHTML ="";
        var table = document.createElement("table");
        table.setAttribute("class", "myTable");
        var tr = document.createElement("tr");
        tr.setAttribute("class", "trAnalysis");
        table.appendChild(tr);
        var th = document.createElement("th");
        th.setAttribute("class", "thAnalysis");
        th.appendChild(document.createTextNode("Type"));
        var th2 = document.createElement("th");
        th2.setAttribute("class", "thAnalysis");
        th2.appendChild(document.createTextNode("Peak Day"));
        var th3 = document.createElement("th");
        th3.setAttribute("class", "thAnalysis");
        th3.appendChild(document.createTextNode("Amount"));
        tr.appendChild(th);
        tr.appendChild(th2);
        tr.appendChild(th3);
        for (var i in response.setA){
            tabledivC.appendChild(table);
        var row = table.insertRow((parseInt(i))+1);
        row.setAttribute("class", "trAnalysis");
        var cell1 = row.insertCell(0);
        cell1.setAttribute("class", "tdAnalysis");
        var cell2 = row.insertCell(1);
        cell2.setAttribute("class", "tdAnalysis");
        var cell3 = row.insertCell(2);
        cell3.setAttribute("class", "tdAnalysis");
        cell1.innerHTML = response.setC[i].type;
        cell2.innerHTML = response.setC[i].peakday;
        cell3.innerHTML = response.setC[i].amount;
        }
        tabledivC.innerHTML += "</table>";
    break;
    }
}