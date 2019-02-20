$(document).ready(function() {
    
    var latitud = $('#latitud').val();
    var longitud = $('#longitud').val();
    var stockholm = new google.maps.LatLng(latitud, longitud);
    var parliament = new google.maps.LatLng(latitud, longitud);
    
    $("#excepcion_fechas option").attr("selected","selected"); 
    $("#participantes option").attr("selected","selected"); 
    $("#notificantes option").attr("selected","selected"); 

    var marker;
    var map;
    
    function initialize() {
    
        var mapOptions = {
          zoom: 5,
          mapTypeId: google.maps.MapTypeId.ROADMAP,
          center: stockholm
        };

        var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
        var input = document.getElementById('searchTextField');
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);
        var autocomplete = new google.maps.places.Autocomplete(input);
        
        var infowindow = new google.maps.InfoWindow();
       
        marker = new google.maps.Marker({
          map:map,
          draggable:true,
          animation: google.maps.Animation.DROP,
          position: parliament
        });
       
        
        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            infowindow.close();
            //marker.setVisible(false);
            //input.className = '';
            var place = autocomplete.getPlace();
            if (!place.geometry) {
              // Inform the user that the place was not found and return.
              //input.className = 'notfound';
              return;
            }

            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
              map.fitBounds(place.geometry.viewport);
            } else {
              map.setCenter(place.geometry.location);
              map.setZoom(17);  // Why 17? Because it looks good.
            }
            /*
            marker.setIcon(/** @type {google.maps.Icon} ({
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(35, 35)
            }));
            */
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);

            var address = '';
            if (place.address_components) {
              address = [
                (place.address_components[0] && place.address_components[0].short_name || ''),
                (place.address_components[1] && place.address_components[1].short_name || ''),
                (place.address_components[2] && place.address_components[2].short_name || '')
              ].join(' ');
            }

            //infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
            //infowindow.open(map, marker);
        });

        // Sets a listener on a radio button to change the filter type on Places
        // Autocomplete.
        /*
        function setupClickListener(id, types) {
          var radioButton = document.getElementById(id);
          google.maps.event.addDomListener(radioButton, 'click', function() {
            autocomplete.setTypes(types);
          });
        }

        setupClickListener('changetype-all', []);
        setupClickListener('changetype-establishment', ['establishment']);
        setupClickListener('changetype-geocode', ['geocode']);
        */
            
        

        

        google.maps.event.addListener(marker, 'click', toggleBounce);

        //---->Obtengo los valores de latitud y longitud al arrastrar y soltar el marker
        google.maps.event.addListener(marker, 'dragend', function(e) {
            $('#latitud').val(e.latLng.lat());
            $('#longitud').val(e.latLng.lng());
        });
    }
    
    function toggleBounce() {
        if (marker.getAnimation() != null) {
          marker.setAnimation(null);
        } else {
          marker.setAnimation(google.maps.Animation.BOUNCE);
        }
    }

    google.maps.event.addDomListener(window, 'load', initialize);

    $('#form_registro').html5form({
        allBrowsers : true,
        responseDiv : '#response',
        messages: 'es',
        method : 'POST',
        emptyMessage : '<span style="color: #FF0000">Este campo es obligatorio</span>',
        responseDiv : '#respuesta',
        async : false
    });
    
    
    $('#sin_fecha_vencimiento').live({
        change: function() {
            if($("#sin_fecha_vencimiento").is(':checked')) {  
                $("#fecha_vencimiento").attr('disabled', 'disabled');
            }else{
                $("#fecha_vencimiento").removeAttr('disabled');
            }
            
        }
    });
    
    $("#tipo_cita").live({
       change: function()  {
           if($("#tipo_cita").val() == 'personal') {  
                $("#info_cita_empresarial").hide();
           }else{
                $("#info_cita_empresarial").show();
           }
       }
    });
    
    
    
    $("#motivo").live({
       change: function()  {
           switch($("#motivo").val()){
               case 'tarea':
                   $("#tipo_de_tarea").show();
                   $("#ubicacion_reunion").hide();
                   $("#tipo_de_reunion").hide();
                   $("#tipo_de_llamada").hide();
                   break;
               case 'reunion':
                   $("#tipo_de_reunion").show();
                   $("#ubicacion_reunion").show();
                   $("#tipo_de_llamada").hide();
                   $("#tipo_de_tarea").hide();
                   break;
               case 'llamada':
                   $("#tipo_de_llamada").show();
                   $("#ubicacion_reunion").hide();
                   $("#tipo_de_reunion").hide();
                   $("#tipo_de_tarea").hide();
                   break;
           }
       }
    });
    
    
    $('#agendar_tercero').live({
        change: function() {
            if($("#agendar_tercero").is(':checked')) {  
                $("#cita_tercero").show();
            }else{
                $("#cita_tercero").hide();
            }
            
        }
    });
    
    
    $('#empresa').live({
        change: function() {
            var url  = 'index.php?request=rpc/select-contactos-empresa&nocache=' + Math.random();
            var empresa = $('#empresa').val();
            var data = {empresa : empresa};

            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                success: function( html ) {
                    $('#contacto_empresa').html(html);
                },
                timeout: 5000
            });
        }
    });
    
    
});


function add() {
    if($('#excepcion_fecha').val() != "") {
        $("#excepcion_fechas").append(new Option($('#excepcion_fecha').val(), $('#excepcion_fecha').val()));
    }
    $('#excepcion_fecha').val('');
    $("#excepcion_fechas option").attr("selected","selected"); 
}

function del() {
    $("#excepcion_fechas option[value='"+$("#excepcion_fechas").val()+"']").remove();
}

function add_participante() {
    if($('#contacto_empresa').val() != "") {
        $("#participantes").append(new Option($('#contacto_empresa option').filter(':selected').text(), $('#contacto_empresa').val()));
        //---->Remuevo este contacto de la lista para evitar duplicidades
        $("#contacto_empresa option[value='"+$("#contacto_empresa").val()+"']").remove();
    }
    
    if($("#otro_contacto").val() != ""){
        $("#participantes").append(new Option($('#otro_contacto').val(), $('#otro_contacto').val()));
        $('#otro_contacto').val('');
    }
    
    if($('#colaborador').val() != "") {
        $("#participantes").append(new Option($('#colaborador option').filter(':selected').text(), $('#colaborador').val() + ':agente'));
        //---->Remuevo este contacto de la lista para evitar duplicidades
        $("#colaborador option[value='"+$("#colaborador").val()+"']").remove();
    }
    
        
    $("#participantes option").attr("selected","selected"); 
}

function del_participante()
{
    $("#participantes option[value='"+$("#participantes").val()+"']").remove();
}


function add_notificador() {
    if($("#notificar").val() != ""){
        $("#notificantes").append(new Option($('#notificar').val(), $('#notificar').val()));
        $('#notificar').val('');
    }
    $("#notificantes option").attr("selected","selected"); 
}

function del_notificador()
{
    $("#notificantes option[value='"+$("#notificantes").val()+"']").remove();
}

function selecciona_todos_los_elementos()
{
    $("#excepcion_fechas option").attr("selected","selected"); 
    $("#participantes option").attr("selected","selected"); 
    $("#notificantes option").attr("selected","selected"); 
}


function popup_detalle_agenda (pagina) {
    var opciones="toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=750, height=600, top=0, left=0";
    window.open(pagina,"",opciones);
}