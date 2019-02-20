<?php

defined('JZ_UPALE') or die('Acceso Incorrecto');
define('CONTROLLER', 'Municipios');


require_once MODEL_PATH . DS . 'municipiosModel.php';
require_once MODEL_PATH . DS . 'estadosModel.php';

authenticar();

if (!hasPermission('acceso_municipios')) {
	
    go_to('acceso/denegado');
	
}

function municipios_delete(){
	
	$aGet = http_get_request();
        
	$return = db_eliminado_logico('municipios', $aGet['id']);
	
	if($return) {
		set_flash('Eliminado exitoso', 'success');
	} else {
		set_flash('Ha ocurrido un error con el movimiento', 'success');
	}
        
        $buscar = array();
        $buscar['p'] = $aGet['p'];
        
	go_to('municipios',$buscar);
	
}

function municipios_default() {
    if (!hasPermission('municipios_nuevo')) {
        go_to('acceso/denegado');
    }
    return municipios_desktop();
}

function municipios_nuevo() {
    
    set_header(array('section' => 'Nuevo municipio'));        
    
    $estados = cargar_estados();
    
    $buscar = array();
    $buscar['p'] = 1;      
    
    return load_template(CONTROLLER . DS . "_municipiosForm.php", array('estados' => $estados, 'buscar' => $buscar));
}

function municipios_desktop($aExtData = array()) {
    
	$aGet = http_get_request();               
        
        if(!isset($aGet['p']))
        {
            $aGet['p'] = 1;
        }
        
        //$municipios = get_last_municipio();
        
        if(!isset($aGet['buscar']))
        {            
            $aGet['buscar']='';     
        }
                
        $municipios = buscar_municipio($aGet);  
        
        $datos = array();
        $datos['municipios'] = $municipios;
        $datos['buscar'] = $aGet;    
        
	set_header(array('section' => 'Listado'));
        return load_template(CONTROLLER . DS . '_municipiosList.php', $datos);
}

function municipios_aplicar() {

    if (!hasPermission('municipios_nuevo')) {
        go_to('acceso/denegado');
    }

    defined('BR') or define('BR', '<br />');

    set_header(array(
        'section' => 'Nuevo Municipio',
        'libraries' => array('Jquery')
    ));

    $aPost = http_post_request();
    
    $buscar = array();
    $buscar['p'] = $aPost['p'];       
    
    if(!isset($aPost['municipio']))
    {
        $aPost['municipio']= '';
    }
    if(!isset($aPost['estado_id']))
    {
        $aPost['estado_id']= '';
    }

    
    if( salvar_municipio($aPost)){        
	go_to('municipios',$buscar);
    } else {
        
        $estados = cargar_estados();
        return load_template(CONTROLLER . DS . "_municipiosForm.php", array('municipio' => $aPost, 'estados' => $estados, 'buscar' => $buscar));
    }
}

function municipios_editar( ) {

    if (!hasPermission('municipios_editar')) {
        go_to('acceso/denegado');
    }

    set_header(array(
        'section' => 'Municipio',
        'libraries' => array('Jquery')
    ));

    $aGet = http_get_request();
    
    $buscar = array();
    $buscar['p'] = $aGet['p'];    
    
    if(!empty($prevData)){
        $municipio = $prevData;
    } else {
        $municipio = municipios_read($aGet['id']);
    }
	
    $estados = cargar_estados();
    
    set_header(array('section' => sprintf('Edici&oacute;n del municipio "%s"', $municipio['municipio'])));

    if (!empty($municipio)) {
        return load_template(CONTROLLER . DS . "_municipiosForm.php", array('municipio' => $municipio, 'estados' => $estados, 'buscar' => $buscar));
    } else {
	go_to('municipios',$buscar);
    }
}

?>