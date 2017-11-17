let X; // Put your X coordinate here for the map if your variable is in PHP just var X = <?php echo $x_coordinate ?>:
let Y; // Put your Y coordinate here for the map if your variable is in PHP just var Y = <?php echo $Y_coordinate ?>:
let Lat = sessionStorage.getItem('Latitude'); // Put Latitude here
let Long = sessionStorage.getItem('Longitude'); // Put Longitude here
let Center;
let Origin = sessionStorage.getItem('startLocation'); // For the Directions
let Destination; // For the Directions
let DrivingMode = 'DRIVING';
let TransitMode = 'TRANSIT';
function initMap() {
    // Origin = new google.maps.LatLng(1.3730,103.94928); //temperory
    Center = new google.maps.LatLng(1.3521, 103.8198);
    Destination = new google.maps.LatLng(Long, Lat);
    //    if(X>1000 || Y>1000){
    //        var newlatlong = $.ajax({
    //            async: false,
    //            url: "https://developers.onemap.sg/commonapi/convert/3414to4326?X=" + X + "&Y=" + Y,
    //        }).responseJSON;
    //        Destination = new google.maps.LatLng(newlatlong["latitude"], newlatlong["longitude"]);
    //    }
    //    else{
    //        Destination = new google.maps.LatLng(Lat, Long);
    //    }
    let options = {
        zoom: 12,
        center: Center,
        styles: [
            { elementType: 'geometry', stylers: [{ color: '#242f3e' }] },
            {
                elementType: 'labels.text.stroke',
                stylers: [{ color: '#242f3e' }]
            },
            {
                elementType: 'labels.text.fill',
                stylers: [{ color: '#746855' }]
            },
            {
                featureType: 'administrative.locality',
                elementType: 'labels.text.fill',
                stylers: [{ color: '#d59563' }]
            },
            {
                featureType: 'poi',
                elementType: 'labels.text.fill',
                stylers: [{ color: '#d59563' }]
            },
            {
                featureType: 'poi.park',
                elementType: 'geometry',
                stylers: [{ color: '#263c3f' }]
            },
            {
                featureType: 'poi.park',
                elementType: 'labels.text.fill',
                stylers: [{ color: '#6b9a76' }]
            },
            {
                featureType: 'road',
                elementType: 'geometry',
                stylers: [{ color: '#38414e' }]
            },
            {
                featureType: 'road',
                elementType: 'geometry.stroke',
                stylers: [{ color: '#212a37' }]
            },
            {
                featureType: 'road',
                elementType: 'labels.text.fill',
                stylers: [{ color: '#9ca5b3' }]
            },
            {
                featureType: 'road.highway',
                elementType: 'geometry',
                stylers: [{ color: '#746855' }]
            },
            {
                featureType: 'road.highway',
                elementType: 'geometry.stroke',
                stylers: [{ color: '#1f2835' }]
            },
            {
                featureType: 'road.highway',
                elementType: 'labels.text.fill',
                stylers: [{ color: '#f3d19c' }]
            },
            {
                featureType: 'transit',
                elementType: 'geometry',
                stylers: [{ color: '#2f3948' }]
            },
            {
                featureType: 'transit.station',
                elementType: 'labels.text.fill',
                stylers: [{ color: '#d59563' }]
            },
            {
                featureType: 'water',
                elementType: 'geometry',
                stylers: [{ color: '#17263c' }]
            },
            {
                featureType: 'water',
                elementType: 'labels.text.fill',
                stylers: [{ color: '#515c6d' }]
            },
            {
                featureType: 'water',
                elementType: 'labels.text.stroke',
                stylers: [{ color: '#17263c' }]
            }
        ]
    };
    let map = new google.maps.Map(
        document.getElementById('google-map-driving'),
        options
    );
    let map2 = new google.maps.Map(
        document.getElementById('google-map-transit'),
        options
    );
    // google.maps.event.addListenerOnce(map, 'load', function() {
    //     $(window).trigger('resize');
    // });
    // google.maps.event.addListenerOnce(map2, 'load', function() {
    //     $(window).trigger('resize');
    // });
    let directionsService = new google.maps.DirectionsService();
    let directionsDisplay = new google.maps.DirectionsRenderer({
        draggable: true,
        map: map
    });
    let marker = new google.maps.Marker({
        position: Destination,
        map: map
    });

    let directionsDisplay2 = new google.maps.DirectionsRenderer({
        draggable: true,
        map: map2
    });
    let marker2 = new google.maps.Marker({
        position: Destination,
        map: map2
    });
    let infoWindow = new google.maps.InfoWindow({
        content: sessionStorage.getItem('RestName')
    }); // Add a text when you click the marker
    marker.addListener('click', function() {
        infoWindow.open(map, marker);
    });
    marker2.addListener('click', function() {
        infoWindow.open(map2, marker2);
    });
    displayRoute(directionsService, directionsDisplay);
    displayRoute2(directionsService, directionsDisplay2);
}

function displayRoute(service, display) {
    service.route(
        {
            origin: Origin,
            destination: Destination,
            travelMode: DrivingMode,
            avoidTolls: true
        },
        function(response, status) {
            if (status === 'OK') {
                display.setDirections(response);
            } else {
                alert('Could not display' + status);
            }
        }
    );
}

function displayRoute2(service, display) {
    service.route(
        {
            origin: Origin,
            destination: Destination,
            travelMode: TransitMode
        },
        function(response, status) {
            if (status === 'OK') {
                display.setDirections(response);
            } else {
                alert('Could not display' + status);
            }
        }
    );
}
