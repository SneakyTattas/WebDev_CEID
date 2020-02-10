var monthsince;
var yearsince;
var monthuntil;
var yearuntil;
var data;
function showDate(monthsince,yearsince,monthuntil,yearuntil) {
if ((monthsince == "" && yearsince == "") || (monthuntil == "" && yearuntil == "")) {
    document.getElementById("txtHint").innerHTML = "";
    return;
} else {
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
        var response = JSON.parse(xmlhttp.responseText);
        console.log(response);
        console.log(response.setA);
        console.log(response.setB[0]);
        console.log(response.setC[0]);
        data = response.data;
        on200();
        //document.getElementById("test").innerHTML = response;
    }
}
    }
}
function getForms()
{
monthsince = document.getElementById("monthsince").value;
yearsince = document.getElementById("yearsince").value;
monthuntil = document.getElementById("monthuntil").value;
yearuntil = document.getElementById("yearuntil").value;
if(!yearsince && !yearuntil)
            {
                document.getElementById("Submit").disabled = true;
            }
            else
            {document.getElementById("Submit").disabled = false;
            }
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
var baseLayer = L.tileLayer(
'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{
 attribution: '...',
 maxZoom: 18
}
);

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