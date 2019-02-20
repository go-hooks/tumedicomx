$(document).ready(function() {
    var latitud = $('#latitud').val();
    var longitud = $('#longitud').val()
    var stockholm = new google.maps.LatLng(latitud, longitud);
    var parliament = new google.maps.LatLng(latitud, longitud);
    var marker;
    var map;
    
    
    function initialize() {
        
        var mapOptions = {
          zoom: 14,
          mapTypeId: google.maps.MapTypeId.ROADMAP,
          center: stockholm
        };

        map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
  
        marker = new google.maps.Marker({
          map:map,
          draggable:false,
          position: parliament
        });
    }
    
    google.maps.event.addDomListener(window, 'load', initialize);
});
