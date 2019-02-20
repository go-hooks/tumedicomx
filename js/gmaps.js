var directionsDisplay;
var directionsService = new google.maps.DirectionsService();
var map;

function initialize() {
    directionsDisplay = new google.maps.DirectionsRenderer();
    var magno = new google.maps.LatLng(20.6430333, -103.4190458);
    var mapOptions = {
        zoom:18,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        center: magno
    }

    map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
    directionsDisplay.setMap(map);
    directionsDisplay.setPanel(document.getElementById('directions-panel'));

    //var image = 'img/diamante.png';
    var marker = new google.maps.Marker({
        position: magno,
        map: map,
        title: 'Bebe Baratisimo',
        //icon: image,
    });
}


function calcRoute() {

    var magno = new google.maps.LatLng(20.6430333, -103.4190458);
    var start = document.getElementById('start').value;
    var end = magno;
    var request = {
        origin:start,
        destination:end,
        travelMode: google.maps.DirectionsTravelMode.DRIVING
    };
    directionsService.route(request, function(response, status) {
        if (status == google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
        }
    });
}
google.maps.event.addDomListener(window, 'load', initialize);