<?php

defined('JZ_UPALE') or die('Acceso Incorrecto');
define('CONTROLLER', 'Aseguradoras');


require_once MODEL_PATH . DS . 'aseguradorasModel.php';

authenticar();

if (!hasPermission('acceso_aseguradoras')) {
	
    go_to('acceso/denegado');
	
}

function aseguradoras_delete(){
	
	$aGet = http_get_request();
        
	$return = db_eliminado_logico('aseguradoras', $aGet['id']);
	
	if($return) {
		set_flash('Eliminado exitoso', 'success');
	} else {
		set_flash('Ha ocurrido un error con el movimiento', 'success');
	}
        
	go_to('aseguradoras');
	
}

function aseguradoras_default() {
    if (!hasPermission('aseguradoras_nuevo')) {
        go_to('acceso/denegado');
    }
    return aseguradoras_desktop();
}

function aseguradoras_nuevo() {
	set_header(array('section' => 'Nueva aseguradora'));
    return load_template(CONTROLLER . DS . "_aseguradorasForm.php");
}

function aseguradoras_desktop($aExtData = array()) {
    
	$aPost = http_post_request();           
        //$aseguradoras = get_last_aseguradora();

        if(!isset($aPost['buscar']))
        {            
            $aPost['buscar']='';     
        }
                
        $aseguradoras = buscar_aseguradora($aPost);  
        
        $datos = array();
        $datos['aseguradoras'] = $aseguradoras;
        $datos['buscar'] = $aPost;    
        
	set_header(array('section' => 'Listado'));
        return load_template(CONTROLLER . DS . '_aseguradorasList.php', $datos);
}

function aseguradoras_aplicar() {

    if (!hasPermission('aseguradoras_nuevo')) {
        go_to('acceso/denegado');
    }

    defined('BR') or define('BR', '<br />');

    set_header(array(
        'section' => 'Nueva Aseguradora',
        'libraries' => array('Jquery')
    ));

    $aPost = http_post_request();

    
    if( $_FILES['Imagen']['error'] === UPLOAD_ERR_OK)
    {    

        if(isset($aPost['imagen']))
        {  
            $borra_imagen_servidor = borrar_archivo_servidor($aPost['imagen']);                                                 
        }

        $carga_al_servidor = subir_al_servidor($_FILES["Imagen"]);

        if ($carga_al_servidor) 
        {
            $aPost['imagen'] = $carga_al_servidor;
        }

    }
    else
    {
        if(! isset($aPost['imagen']))
        {            
            $aPost['imagen'] = '';     
        }
        
    }    
    
    if( salvar_aseguradora($aPost)){        
        go_to('aseguradoras');
    } else {
        return load_template(CONTROLLER . DS . "_aseguradorasForm.php", array('aseguradora' => $aPost));
    }
}

function aseguradoras_editar( ) {

    if (!hasPermission('aseguradoras_editar')) {
        go_to('acceso/denegado');
    }

    set_header(array(
        'section' => 'Aseguradora',
        'libraries' => array('Jquery')
    ));

    $aGet = http_get_request();
    
    if(!empty($prevData)){
        $aseguradora = $prevData;
    } else {
        $aseguradora = aseguradoras_read($aGet['id']);
    }
	
	set_header(array('section' => sprintf('Edici&oacute;n de la aseguradora "%s"', $aseguradora['nombre'])));

    if (!empty($aseguradora)) {
        return load_template(CONTROLLER . DS . "_aseguradorasForm.php", array('aseguradora' => $aseguradora));
    } else {
        go_to('aseguradoras');
    }
}

?>