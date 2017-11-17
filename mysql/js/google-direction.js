
var X; //Put your X coordinate here for the map if your variable is in PHP just var X = <?php echo $x_coordinate ?>:
var Y; //Put your Y coordinate here for the map if your variable is in PHP just var Y = <?php echo $Y_coordinate ?>:
var Lat; //Put Latitude here
var Long; //Put Longitude here
var Origin; // For the Directions
var Destination; // For the Directions
var TravelMode='DRIVING'; //Default driving but can change
function initMap() {
    Origin = new google.maps.LatLng(1.3730,103.94928); //temperory 
    X = 29990.9;
    Y = 29038.5;
    if(X>1000 || Y>1000){
        var newlatlong = $.ajax({
            async: false,
            url: "https://developers.onemap.sg/commonapi/convert/3414to4326?X=" + X + "&Y=" + Y,
        }).responseJSON;
        Destination = new google.maps.LatLng(newlatlong["latitude"], newlatlong["longitude"]);
    }
    else{
        Destination = new google.maps.LatLng(Lat, Long);
    }
    var options = {
        zoom: 12, center:Origin,
        styles: [
            {elementType: 'geometry', stylers: [{color: '#242f3e'}]},
            {elementType: 'labels.text.stroke', stylers: [{color: '#242f3e'}]},
            {elementType: 'labels.text.fill', stylers: [{color: '#746855'}]},
            {
              featureType: 'administrative.locality',
              elementType: 'labels.text.fill',
              stylers: [{color: '#d59563'}]
            },
            {
              featureType: 'poi',
              elementType: 'labels.text.fill',
              stylers: [{color: '#d59563'}]
            },
            {
              featureType: 'poi.park',
              elementType: 'geometry',
              stylers: [{color: '#263c3f'}]
            },
            {
              featureType: 'poi.park',
              elementType: 'labels.text.fill',
              stylers: [{color: '#6b9a76'}]
            },
            {
              featureType: 'road',
              elementType: 'geometry',
              stylers: [{color: '#38414e'}]
            },
            {
              featureType: 'road',
              elementType: 'geometry.stroke',
              stylers: [{color: '#212a37'}]
            },
            {
              featureType: 'road',
              elementType: 'labels.text.fill',
              stylers: [{color: '#9ca5b3'}]
            },
            {
              featureType: 'road.highway',
              elementType: 'geometry',
              stylers: [{color: '#746855'}]
            },
            {
              featureType: 'road.highway',
              elementType: 'geometry.stroke',
              stylers: [{color: '#1f2835'}]
            },
            {
              featureType: 'road.highway',
              elementType: 'labels.text.fill',
              stylers: [{color: '#f3d19c'}]
            },
            {
              featureType: 'transit',
              elementType: 'geometry',
              stylers: [{color: '#2f3948'}]
            },
            {
              featureType: 'transit.station',
              elementType: 'labels.text.fill',
              stylers: [{color: '#d59563'}]
            },
            {
              featureType: 'water',
              elementType: 'geometry',
              stylers: [{color: '#17263c'}]
            },
            {
              featureType: 'water',
              elementType: 'labels.text.fill',
              stylers: [{color: '#515c6d'}]
            },
            {
              featureType: 'water',
              elementType: 'labels.text.stroke',
              stylers: [{color: '#17263c'}]
            }
          ]
    }
    var map = new google.maps.Map(document.getElementById('googlemap'), options);
    var directionsService = new google.maps.DirectionsService();
    var directionsDisplay = new google.maps.DirectionsRenderer({
        draggable:true,
        map:map
    });
    var marker = new google.maps.Marker({
        position: Destination,
        map: map
    });
    var infoWindow = new google.maps.InfoWindow({content: '<h2>test test</h2>'}); //Add a text when you click the marker
    marker.addListener('click', function () {
        infoWindow.open(map, marker);
    });
    displayRoute(directionsService, directionsDisplay);
}

function displayRoute(service,display){
    service.route({
        origin: 'Jurong West',
        destination: Destination,
        travelMode: TravelMode,
        avoidTolls: true
    }, function(response, status){
        if (status === 'OK'){
            alert('display');
            display.setDirections(response);
        }
        else{
            alert('Could not display' + status);
        }
    });
}