<?php

defined('JZ_UPALE') or die('Acceso Incorrecto');
define('CONTROLLER', 'Estados');


require_once MODEL_PATH . DS . 'estadosModel.php';

authenticar();

if (!hasPermission('acceso_estados')) {
	
    go_to('acceso/denegado');
	
}

function estados_delete(){
	
	$aGet = http_get_request();
        
	$return = db_eliminado_logico('estados', $aGet['id']);
	
	if($return) {
		set_flash('Eliminado exitoso', 'success');
	} else {
		set_flash('Ha ocurrido un error con el movimiento', 'success');
	}
        
        
        $buscar = array();
        $buscar['p'] = $aGet['p'];
        
	go_to('estados',$buscar);
	
}

function estados_default() {
    if (!hasPermission('estados_nuevo')) {
        go_to('acceso/denegado');
    }
    return estados_desktop();
}

function estados_nuevo() {

    set_header(array('section' => 'Nuevo estado'));
        
    $buscar = array();
    $buscar['p'] = 1; 
    
    return load_template(CONTROLLER . DS . "_estadosForm.php", array('buscar' => $buscar));
}

function estados_desktop($aExtData = array()) {
    
	$aGet = http_get_request();                    
        
        if(!isset($aGet['p']))
        {
            $aGet['p'] = 1;
        }
        
        //$estados = get_last_estado();
        
        if(!isset($aGet['buscar']))
        {            
            $aGet['buscar']='';     
        }
                
        $estados = buscar_estado($aGet);  
        
        $datos = array();
        $datos['estados'] = $estados;
        $datos['buscar'] = $aGet;    
                
	set_header(array('section' => 'Listado'));
        return load_template(CONTROLLER . DS . '_estadosList.php', $datos);
}

function estados_aplicar() {

    if (!hasPermission('estados_nuevo')) {
        go_to('acceso/denegado');
    }

    defined('BR') or define('BR', '<br />');

    set_header(array(
        'section' => 'Nuevo Estado',
        'libraries' => array('Jquery')
    ));

    $aPost = http_post_request();

    $buscar = array();
    $buscar['p'] = $aPost['p'];    
    
    if( salvar_estado($aPost)){        
        go_to('estados',$buscar);
    } else {
        return load_template(CONTROLLER . DS . "_estadosForm.php", array('estado' => $aPost, 'buscar' => $buscar));
    }
}

function estados_editar( ) {

    if (!hasPermission('estados_editar')) {
        go_to('acceso/denegado');
    }

    set_header(array(
        'section' => 'Estado',
        'libraries' => array('Jquery')
    ));

    $aGet = http_get_request();
    
    if(!empty($prevData)){
        $estado = $prevData;
    } else {
        $estado = estados_read($aGet['id']);
    }
	
    $buscar = array();
    $buscar['p'] = $aGet['p'];    
    
    set_header(array('section' => sprintf('Edici&oacute;n del estado "%s"', $estado['estado'])));

    if (!empty($estado)) {
        return load_template(CONTROLLER . DS . "_estadosForm.php", array('estado' => $estado, 'buscar' => $buscar));
    } else {
        go_to('estados',$buscar);
    }
}

?>