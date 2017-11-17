mapboxgl.accessToken =
    'pk.eyJ1IjoianVzdGxuZiIsImEiOiJjajhzeXhrdWIwZ3p2MnFvNDFvZnF4cnh3In0.Fyue5JNW7KqTtDvd_fLGhQ';
let map = new mapboxgl.Map({
    container: 'map',
    zoom: 14,
    center: [103.86033, 1.283951],
    style: 'mapbox://styles/justlnf/cj8vbviqsf3de2rqnn2ns0a9p'
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

function populateMarkers() {
    $('.marker').remove();

    for (i = 0; i < coordinates.length; i++) {
        var el = document.createElement('div');
        el.className = 'marker mdc-elevation--z12';
        el.id = 'r' + i;

        el.addEventListener('click', function() {
            if (recommendationFocusDialog.style.display != 'block') {
                viewAllReviews();
                var nameadd = document.getElementById('restaurant').name;
                var nameadd2 = nameadd.split(',');
                document.getElementById(
                    'reviews-dialog-header'
                ).childNodes[0].nodeValue =
                    nameadd2[0];
                document.getElementById(
                    'reviews-dialog-description'
                ).childNodes[0].nodeValue =
                    nameadd2[1];
                sessionStorage.setItem('RestName', nameadd2[0]);
                sessionStorage.setItem('RestAdd', nameadd2[1]);
                recommendationFocusDialog.style.display = 'block';
                dialogUnderlay.style.display = 'block';
            } else {
                // dialog.style.display= "none";
            }
        });

        new mapboxgl.Marker(el).setLngLat(coordinates[i]).addTo(map);
    }

    loadingBar.style.display = 'none';
}
