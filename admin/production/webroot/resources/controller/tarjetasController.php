<?php

defined('JZ_UPALE') or die('Acceso Incorrecto');
define('CONTROLLER', 'Tarjetas');


require_once MODEL_PATH . DS . 'tarjetasModel.php';

authenticar();

if (!hasPermission('acceso_tarjetas')) {
	
    go_to('acceso/denegado');
	
}

function tarjetas_delete(){
	
	$aGet = http_get_request();
        
	$return = db_eliminado_logico('tarjetas', $aGet['id']);
	
	if($return) {
		set_flash('Eliminado exitoso', 'success');
	} else {
		set_flash('Ha ocurrido un error con el movimiento', 'success');
	}
        
	go_to('tarjetas');
	
}

function tarjetas_default() {
    if (!hasPermission('tarjetas_nuevo')) {
        go_to('acceso/denegado');
    }
    return tarjetas_desktop();
}

function tarjetas_nuevo() {
	set_header(array('section' => 'Nueva tarjeta'));
    return load_template(CONTROLLER . DS . "_tarjetasForm.php");
}

function tarjetas_desktop($aExtData = array()) {
    
	$aPost = http_post_request();           
        //$tarjetas = get_last_tarjeta();


        if(!isset($aPost['buscar']))
        {            
            $aPost['buscar']='';     
        }
                
        $tarjetas = buscar_tarjeta($aPost);  
        
        $datos = array();
        $datos['tarjetas'] = $tarjetas;
        $datos['buscar'] = $aPost;    
        
        
	set_header(array('section' => 'Listado'));
        return load_template(CONTROLLER . DS . '_tarjetasList.php',$datos);
}

function tarjetas_aplicar() {

    if (!hasPermission('tarjetas_nuevo')) {
        go_to('acceso/denegado');
    }

    defined('BR') or define('BR', '<br />');

    set_header(array(
        'section' => 'Nueva Tarjeta',
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
    
    if( salvar_tarjeta($aPost)){        
        go_to('tarjetas');
    } else {
        return load_template(CONTROLLER . DS . "_tarjetasForm.php", array('tarjeta' => $aPost));
    }
}

function tarjetas_editar( ) {

    if (!hasPermission('tarjetas_editar')) {
        go_to('acceso/denegado');
    }

    set_header(array(
        'section' => 'Tarjeta',
        'libraries' => array('Jquery')
    ));

    $aGet = http_get_request();
    
    if(!empty($prevData)){
        $tarjeta = $prevData;
    } else {
        $tarjeta = tarjetas_read($aGet['id']);
    }
	
	set_header(array('section' => sprintf('Edici&oacute;n de la tarjeta "%s"', $tarjeta['nombre'])));

    if (!empty($tarjeta)) {
        return load_template(CONTROLLER . DS . "_tarjetasForm.php", array('tarjeta' => $tarjeta));
    } else {
        go_to('tarjetas');
    }
}

?>