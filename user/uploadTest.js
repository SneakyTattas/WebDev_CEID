	var map;
	var L = window.L;
	var dropzone;
	var drawnItems;
	var SCALAR_E7 = 0.0000001; // Since Google Takeout stores latlngs as integers
	var latlngs = [];
	var marker = [];
	var markers;
	markers = L.markerClusterGroup({spiderfyOnMaxZoom: false, chunkedLoading: true});
	var i = 0;
		map = L.map( 'map' ).setView( [38.246639,21.734573], 13 );
		L.tileLayer( 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		attribution: 'Eco-Friendly CEID',
		maxZoom: 18,
		minZoom: 2,
		} ).addTo( map );

		var southWest = L.latLng(-89.98155760646617, -180),
		northEast = L.latLng(89.99346179538875, 180);
		var bounds = L.latLngBounds(southWest, northEast);

		map.setMaxBounds(bounds);
		map.on('drag', function() 
				{
		map.panInsideBounds(bounds, { animate: false });
				});
	function getJSON(arrayID) {    
    var JSON = '{"locations": [';
    //should arrayID length equal arrayText lenght and both against null
    if (arrayID != null) {
        for (var i = 0; i < arrayID.length; i++) {
			var throwayayArray = arrayID[i];
            JSON += ',{';
			JSON += '"timestampMs": "' + throwayayArray[2] + '",'; 
            JSON += '"latitudeE7": ' + parseInt(throwayayArray[0]/SCALAR_E7) + ',';
            JSON += '"longitudeE7": ' + parseInt(throwayayArray[1]/SCALAR_E7) + ',';

			if (throwayayArray[4] != null){
				JSON += '"accuracy": ' + throwayayArray[3] + ',';
				JSON += '"type": "' + throwayayArray[4] +'",';
				JSON += '"confidence": ' + throwayayArray[5] + "}";
			}
			else{
				JSON += '"accuracy": ' + throwayayArray[3] + ',';
				JSON += '"type": "' + "UNKNOWN" +'",';
				JSON += '"confidence": ' + 0 + "}";
			}
        }
			JSON += "]}";
    }
	JSON = JSON.slice(0, 15) + JSON.slice(16);
	//JSON = Function("return " + JSON + ";");
	return JSON/*()*/;
	}
	function status( message ) {
			$( '#testdiv' ).text( message );
		}

	// For mobile browsers, allow direct file selection as well
		$( '#file' ).change( function () {
			status("Clearing map...");
			latlngs = [];
			map.removeLayer(markers);
			markers.clearLayers();
			status("Importing file...");
			stageTwo(this.files[0]);
		} );
		
		function stageTwo (file) {

			var os = new oboe();

		os.node( 'locations.[*]', function ( location ) {
			var latitude = location.latitudeE7 * SCALAR_E7,
				longitude = location.longitudeE7 * SCALAR_E7,
				timestamp = location.timestampMs,
				acc = location.accuracy,
				activity = location.activity;
				var maxvalue = 0;
				var bestactivity = "";
				var bestconfidence = 0;



			// Handle negative latlngs due to google unsigned/signed integer bug.
			if ( latitude > 180 ) latitude = latitude - (2 ** 32) * SCALAR_E7;
			if ( longitude > 180 ) longitude = longitude - (2 ** 32) * SCALAR_E7;
			var distancesquared = ((latitude-38.246639)*(latitude-38.246639))+((longitude-21.734573)*(longitude-21.734573));
			var circle = 0.011438148719;
							if (distancesquared < circle){
								if (activity != undefined){

									for (i in activity) {
											if(activity[i].activity[0].confidence > 50 && activity[i].activity[0].confidence > maxvalue && activity[i].activity[0].type != "TILTING") {
												maxvalue = activity[i].activity[0].confidence;
												bestconfidence = activity[i].activity[0].confidence;
												bestactivity = activity[i].activity[0].type;
												
											}else  {
												bestconfidence = activity[i].activity[0].confidence;
												bestactivity = "UNKNOWN";
											}
											
									}
									maxvalue =0;
									latlngs.push([latitude,longitude,timestamp,acc,bestactivity,bestconfidence]);

									}

									
								else 
								{
									latlngs.push([latitude,longitude,timestamp,acc]);
									}
								var a = latlngs[latlngs.length-1];
								marker[i] = L.marker(new L.LatLng(a[0], a[1]))
									.on('click', function(e) {
										map.removeLayer(this);
										markers.removeLayer(this);
										var arraym = marker2array(this);
										removelngs(latlngs, arraym);
									});
								markers.addLayer(marker[i]);
								map.addLayer(markers);
								i++;
								
							}
			return oboe.drop;
		} ).done( function () {
			stageThree(  /* numberProcessed */ latlngs.length );

		} );
		

		var fileSize = prettySize( file.size );	


		parseJSONFile( file, os );
		}
		
	

	function stageThree ( numberProcessed ) {
	var $done = $( '#done' );
	markers.on("clusterclick", function(event) {
  var cluster = event.layer,
    bottomCluster = cluster;

  while (bottomCluster._childClusters.length === 1) {
    bottomCluster = bottomCluster._childClusters[0];
  }

  if (bottomCluster._zoom === markers._maxZoom &&
    bottomCluster._childCount === cluster._childCount) {

    // All child markers are contained in a single cluster from this._maxZoom to this cluster.
	var NumChildren = event.layer.getChildCount();


	var AllChildMarkers = event.layer.getAllChildMarkers();
	for (var i=0; i<NumChildren; i++){
								MarkerRemover = marker2array(AllChildMarkers[i]);
								removelngs(latlngs, MarkerRemover);
								map.removeLayer(AllChildMarkers[i]);
								markers.removeLayer(AllChildMarkers[i]);
			}
	}
		});
	}
		function parseJSONFile( file, oboeInstance ) {
		var fileSize = file.size;
		var prettyFileSize = prettySize(fileSize);
		var chunkSize = 512 * 1024; // bytes
		var offset = 0;
		var self = this; // we need a reference to the current object
		var chunkReaderBlock = null;
		var startTime = Date.now();
		var endTime = Date.now();
		var readEventHandler = function ( evt ) {
			if ( evt.target.error == null ) {
				offset += evt.target.result.length;
				var chunk = evt.target.result;
				var percentLoaded = ( 100 * offset / fileSize ).toFixed( 0 );
				status(percentLoaded  +"% of " + prettyFileSize + " loaded. Please wait for the file to fully load.");
				if (percentLoaded == 100) {
					status("File fully loaded. Click on any marker to remove it before uploading. You can also click any cluster when on full zoom to also remove it before uploading. It is expected for the browser to freeze when removing big clusters, so don't worry.");
				}
				oboeInstance.emit( 'data', chunk ); // callback for handling read chunk
			} else {
				return;
			}
			if ( offset >= fileSize ) {
				oboeInstance.emit( 'done' );
				return;
			}

			// of to the next chunk
			chunkReaderBlock( offset, chunkSize, file );
		}

		chunkReaderBlock = function ( _offset, length, _file ) {
			var r = new FileReader();
			var blob = _file.slice( _offset, length + _offset );
			r.onload = readEventHandler;
			r.readAsText( blob );
		}

		// now let's start the read with the first block
		chunkReaderBlock( offset, chunkSize, file );
	}
		function removelngs(arr, point){
	for (var i=0;i<arr.length;i++){
    if ((arr[i])[0] === point[0] && (arr[i])[1] === point[1]){
		arr.splice(i,1); //this delete from the "i" index in the array to the "1" length
			}

		}  
			return arr;
	}
		function marker2array(marker){
								var thismarker = marker;
								var test = Object.values(thismarker)[1];
								var test2 = Object.values(test)[0];
								var test3 = Object.values(test)[1];
								var arrayMarker = [test2, test3];;
								return arrayMarker;
	}
	$( '#reset' ).click( function () {
		status("Please wait for the file to fully upload")
			var locationhistory;
			var requestcounter = 0;
			latlngsize = Math.floor(latlngs.length/10000);
			const xhr2 = new XMLHttpRequest();
			const xhr3 = new XMLHttpRequest();
			xhr2.open("POST", "DeleteLocations.php");
			xhr2.send();
			xhr2.onreadystatechange = function()
			{
			if (xhr2.readyState == 4 && xhr2.status == 200)
			{
			const xhr = new XMLHttpRequest();
			var k = 0;		
			function SendHistory(k, callback){
				locationhistory = getJSON(latlngs.slice(k*10000, 10000+k*10000));
				const xhr = new XMLHttpRequest();
				xhr.open("POST", "testphp.php");
				xhr.setRequestHeader("Content-Type", "application/json");
				xhr.send(locationhistory);
				xhr.onreadystatechange = function()
				{
					if (xhr.readyState == 4 && xhr.status == 200)
					{
						requestcounter++;
						if (requestcounter == (k+1)){
							CalculatePercentage();
						}
						console.log("hey", requestcounter);
					}
				}
				callback();
			};
			function TestCallback(){
				if (k<latlngsize)
				{
					
					k++;
					SendHistory(k, TestCallback);
				}
				else return;

			}

		SendHistory(k, TestCallback);
		console.log("heloo", k, requestcounter );
			function CalculatePercentage(){
			xhr3.open("POST", "percent.php")
			xhr3.send();
			xhr3.onreadystatechange = function()
			{
				if (xhr3.readyState == 4 && xhr3.status == 200)
				{
				status("File Uploaded!")
				}	
			}
		}
	}
	}});

