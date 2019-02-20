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
    
});