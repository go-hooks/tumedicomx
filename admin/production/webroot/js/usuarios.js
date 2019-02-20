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
    
    
    
    
    $('#departamento_id').live({
        change: function() {
            var valor = $('#departamento_id').val();
            
            if(valor != '27'){
                $('#combo_asistentes').show();
            }else{
                $('#combo_asistentes').hide();
            }
        }
    });
    
});