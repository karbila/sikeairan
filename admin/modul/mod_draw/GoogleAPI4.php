<html>
	<head>
		<title>Google Maps</title>
		<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script> 
		<!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>-->

		<script type="text/javascript" src="jquery-1.4.3.min.js"></script>
		<script type="text/javascript">
			var polyLine;
			var map;
			
			var tourList = [];
			
			
			window.onload = function() {

				var coba = [{
					lat: -7.812832,
					lon: 112.003855},
				{
					lat: -7.811386,
					lon: 112.012567},
				{
					lat: -7.811471,
					lon: 112.020850},
				{
					lat: -7.812832,
					lon: 112.031407}];
				//set initial map location

				var mapOptions = {
				center: new google.maps.LatLng(-7.813384,112.017674),
				zoom: 15,
				mapTypeId: google.maps.MapTypeId.TERRAIN
			};

		//		map = new google.maps.Map(
					document.getElementById("map"), mapOptions);

				//visitPoints.push(new google.maps.LatLng(0,0));
				//set up polyline capability
				var polyOptions = new google.maps.Polyline({
					//path: visitPoints,
					map: map
				});

				polyLine = new google.maps.Polyline(polyOptions);
				//polyLine.setMap(map);
				
				
    
				// DUMMY VALUES
				makeMarkers(coba);

				//Populate the map view with the locations and save tour stops in array

				function makeMarkers(response) {
					console.log("Response Length: " + response.length)
					for (var i = 0; i < response.length; i++) {
						var marker = new google.maps.Marker({
							position: new google.maps.LatLng(response[i].lat, response[i].lon),
							map: map,
							title: response[i].fileName
						});

						//anonymous function wrapper to create distinct markers
						(function(marker) {
							google.maps.event.addListener(marker, 'click', function() {
	
								//tourList.push(marker); //add marker to tour list
								//CHANGED
								path = polyLine.getPath();
								path.push(marker.getPosition());

								//visitPoints.push(marker.getPosition()); //add location to polyline array
								console.log("Tour List length- # stops: " + tourList.length);

							});
						})(marker);
					}
				}

				//listener for poline click
				google.maps.event.addListener(map, 'click', updatePolyline)
				

			} //end onload function
			
			//updates the polyline user selections
			function updatePolyline(event) {
				var path = polyLine.getPath();

				//CHANGED WATCH CAPITALIZATION
				path.push(event.latLng);
			} //end updatePolyline
		</script>
	</head>

	<body>
		<div id="map" style="width:800px; height: 600px; position: absolute; top: 50%; left: 50%; margin-top: -301px; margin-left: -401px; border: 1px solid black;">
		</div>
		<input type="submit" value="Simpan" class="submitButton" />
	</body>
</html>