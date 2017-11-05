mapboxgl.accessToken = "pk.eyJ1IjoianVzdGxuZiIsImEiOiJjajhzeXhrdWIwZ3p2MnFvNDFvZnF4cnh3In0.Fyue5JNW7KqTtDvd_fLGhQ";
let map = new mapboxgl.Map({
	container: "map",
	zoom: 14,
	center: [103.86033, 1.283951],
	style: "mapbox://styles/justlnf/cj8vbviqsf3de2rqnn2ns0a9p"
});

function updateMapToNewLocation(lat, lng) {
	var targetDestination = [lat, lng];

	map.flyTo({
		// These options control the ending camera position: centered at
		// the target, at zoom level 9, and north up.
		center: targetDestination,
		zoom: 14,
		bearing: 0,

		// These options control the flight curve, making it move
		// slowly and zoom out almost completely before starting
		// to pan.
		speed: 0.6, // make the flying slow
		curve: 1 // change the speed at which it zooms out
	});
}

function markerToMapFocus(lat, lng, zoom = 16) {
	var targetDestination = [lat, lng];

	map.flyTo({
		// These options control the ending camera position: centered at
		// the target, at zoom level 9, and north up.
		center: targetDestination,
		zoom: zoom,
		bearing: 0,
		// These options control the flight curve, making it move
		// slowly and zoom out almost completely before starting
		// to pan.
		speed: 0.6,
		curve: 1
	}); // make the flying slow // change the speed at which it zooms out
}

function populateMarkers(recommendationCoordinates) {
	var noOfRecommendations = 5;

	// For testing purpose - remove once merged with DB
	var coordinates = [];
	coordinates.push([103.86033, 1.283951]);
	coordinates.push([103.85444, 1.27664]);
	coordinates.push([103.852906, 1.280295]);
	coordinates.push([103.847203, 1.278788]);
	coordinates.push([103.859767, 1.286285]);

	for (i = 0; i < noOfRecommendations; i++) {
		var el = document.createElement("div");
		el.className = "marker mdc-elevation--z12";
		el.id = "r" + i;

		el.addEventListener("click", function() {
			if (recommendationFocusDialog.style.display != "block") {
				recommendationFocusDialog.style.display = "block";
				dialogUnderlay.style.display = "block";
			} else {
				// dialog.style.display= "none";
			}
		});

		new mapboxgl.Marker(el).setLngLat(coordinates[i]).addTo(map);
	}

	loadingBar.style.display = "none";
}
