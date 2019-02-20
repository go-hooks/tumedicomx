$(document).ready(function() {

    $('#form_registro').html5form({
        allBrowsers : true,
        responseDiv : '#response',
        messages: 'es',
        method : 'POST',
        emptyMessage : '<span style="color: #FF0000">Este campo es obligatorio</span>',
        responseDiv : '#respuesta',
        async : false
    });

   
   $('#add_puesto').live({
        click: function() {
            var url  = 'index.php?request=rpc/select-puestos&nocache=' + Math.random();
            var data = {};

            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                success: function( html ) {
                    $('#contenedor_puesto').append(html);
                },
                timeout: 5000
            });
            
        }
    });
    
    
    $('#add_email').live({
        click: function() {
            var url  = 'index.php?request=rpc/email-contacto&nocache=' + Math.random();
            var data = {};

            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                success: function( html ) {
                    $('#contenedor_email').append(html);
                },
                timeout: 5000
            });
            
        }
    });
    
    
    
    $('#add_telefono').live({
        click: function() {
            var url  = 'index.php?request=rpc/telefono-contacto&nocache=' + Math.random();
            var data = {};

            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                success: function( html ) {
                    $('#contenedor_telefono').append(html);
                },
                timeout: 5000
            });
            
        }
    });
    
    
    $('#add_movil').live({
        click: function() {
            var url  = 'index.php?request=rpc/movil-contacto&nocache=' + Math.random();
            var data = {};

            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                success: function( html ) {
                    $('#contenedor_movil').append(html);
                },
                timeout: 5000
            });
            
        }
    });
    
    
    
    $('#add_radio').live({
        click: function() {
            var url  = 'index.php?request=rpc/radio-contacto&nocache=' + Math.random();
            var data = {};

            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                success: function( html ) {
                    $('#contenedor_radio').append(html);
                },
                timeout: 5000
            });
            
        }
    });
    
    
    $('#add_red_social').live({
        click: function() {
            var url  = 'index.php?request=rpc/red-Social-contacto&nocache=' + Math.random();
            var data = {};

            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                success: function( html ) {
                    $('#contenedor_red').append(html);
                },
                timeout: 5000
            });
            
        }
    });
    
});



function openWindow (pagina) {
    var opciones="toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=750, height=600, top=0, left=0";
    window.open(pagina,"",opciones);
}




function popup_detalle_contacto(sRuta)
{
    openWindow(sRuta);
}