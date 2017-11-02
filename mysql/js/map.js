mapboxgl.accessToken = 'pk.eyJ1IjoianVzdGxuZiIsImEiOiJjajhzeXhrdWIwZ3p2MnFvNDFvZnF4cnh3In0.Fyue5JNW7KqTtDvd_fLGhQ';
let map = new mapboxgl.Map({
    container: 'map',
    zoom: 14,
    center: [103.860330, 1.283951],
    style: 'mapbox://styles/justlnf/cj8vbviqsf3de2rqnn2ns0a9p',
});

document.getElementById('recommended-list').addEventListener('click', () => {
    // Fly to a random location by offsetting the point -74.50, 40
    // by up to 5 degrees.
    map.flyTo({
        center: [-74.50 + (Math.random() - 0.5) * 10,
            40 + (Math.random() - 0.5) * 10
        ]
    });
})

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
        curve: 1, // change the speed at which it zooms out
    });
}

function addMultipleMarkersToMap(listOfCoordinates) {
    // if (listOfCoordinates.isArray) {
    //     for (i = 0; i < listOfCoordinates.length; i++) {
    //         var marker = new mapboxgl.Marker()
    //             .setLngLat([listOfCoordinates[i].lat, listOfCoordinates[i].lng])
    //             .addTo(map);
    //     }
    // } else {
    //     console.log('Array not found for listOfCoordinates');
    // }

    // for (i = 0; i < listOfCoordinates.length; i++) {
    //     var marker = new mapboxgl.Marker()
    //         .setLngLat([103.860330, 1.283951])
    //         .addTo(map);
    // }

    // 

    //TODO!!!
}