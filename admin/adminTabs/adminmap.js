var baseLayer = L.tileLayer(
    'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{
        attribution: '...',
        maxZoom: 16,
        minZoom: 12
    }
    );
      var map1 = new L.Map('map1', {
    center: new L.LatLng(38.2466, 21.7345),
    zoom: 4,
    layers: [baseLayer]
    });
    var cfg = {
 
        "radius": 0.0013,
      "maxOpacity": .8,
      "scaleRadius": true,
      "useLocalExtrema": true,
      latField: 'latit',
      lngField: 'long',
      valueField: 'count'
};

var heatmapLayer = new HeatmapOverlay(cfg);
map1.addLayer(heatmapLayer);

  function formSubmit(event) {
  var url = "/admin/adminTabs/adminmap.php";
  var request = new XMLHttpRequest();
  var serialized = $('form').serialize();

  newurl = url + "?" + serialized;
  request.open('GET', newurl, true);
  request.onload = function() { // request successful
  // we can use server response to our request now
    var data1 = JSON.parse(request.responseText);
    var data = data1.data;
    var testData = {
    max: data.length,
    data: data  
    };
    heatmapLayer.setData(testData);
  };

  request.onerror = function() {
    // request failed
  };

  request.send(new FormData(event.target)); // create FormData from form that triggered event
  event.preventDefault();
  
}
function attachFormSubmitEvent(formId){
  document.getElementById(formId).addEventListener("submit", formSubmit);
}
attachFormSubmitEvent("form");