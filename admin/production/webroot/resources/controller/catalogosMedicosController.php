<?php

defined('JZ_UPALE') or die('Acceso Incorrecto');
define('CONTROLLER', 'CatalogosMedicos');


require_once MODEL_PATH . DS . 'catalogosMedicosModel.php';

authenticar();

if (!hasPermission('acceso_catalogos_medicos')) {
	
    go_to('acceso/denegado');
	
}

function catalogosMedicos_delete(){
	
	$aGet = http_get_request();
        
	$return = db_eliminado_logico('catalogos_medicos', $aGet['id']);
	
	if($return) {
		set_flash('Eliminado exitoso', 'success');
	} else {
		set_flash('Ha ocurrido un error con el movimiento', 'success');
	}
        
        
        $buscar = array();
        $buscar['p'] = $aGet['p']; 
        
	go_to('catalogosMedicos',$buscar);
	
}

function catalogosMedicos_default() {
    if (!hasPermission('catalogos_medicos_nuevo')) {
        go_to('acceso/denegado');
    }
    return catalogosMedicos_desktop();
}

function catalogosMedicos_nuevo() {
    
    set_header(array('section' => 'Nuevo catalogo'));
        
    $buscar = array();
    $buscar['p'] = 1; 
    
    return load_template(CONTROLLER . DS . "_catalogosMedicosForm.php", array('buscar' => $buscar));
}

function catalogosMedicos_desktop($aExtData = array()) {
    
	$aGet = http_get_request();               
        
        if(!isset($aGet['p']))
        {
            $aGet['p'] = 1;
        }
        
        if(!isset($aGet['buscar']))
        {            
            $aGet['buscar']='';     
        }
                
        $catalogos = buscar_catalogo_medico($aGet);  
        
        $datos = array();
        $datos['catalogos'] = $catalogos;
        $datos['buscar'] = $aGet;      
        
	set_header(array('section' => 'Listado'));
        return load_template(CONTROLLER . DS . '_catalogosMedicosList.php', $datos);
}

function catalogosMedicos_aplicar() {

    if (!hasPermission('catalogos_medicos_nuevo')) {
        go_to('acceso/denegado');
    }

    defined('BR') or define('BR', '<br />');

    set_header(array(
        'section' => 'Nuevo Catalogo',
        'libraries' => array('Jquery')
    ));

    $aPost = http_post_request();
    
    $buscar = array();
    $buscar['p'] = $aPost['p'];      
        
    
    if( salvar_catalogo_medico($aPost)){        
	go_to('catalogosMedicos',$buscar);
    } else {
        return load_template(CONTROLLER . DS . "_catalogosMedicosForm.php", array('catalogo' => $aPost, 'buscar' => $buscar));
    }
}

function catalogosMedicos_editar( ) {

    if (!hasPermission('catalogos_medicos_editar')) {
        go_to('acceso/denegado');
    }

    set_header(array(
        'section' => 'Catalogo',
        'libraries' => array('Jquery')
    ));

    $aGet = http_get_request();
    
    $buscar = array();
    $buscar['p'] = $aGet['p'];      
    
    if(!empty($prevData)){
        $catalogo = $prevData;
    } else {
        $catalogo = catalogos_medicos_read($aGet['id']);
    }
	
	set_header(array('section' => sprintf('Edici&oacute;n del catalogo "%s"', $catalogo['nombre'])));

    if (!empty($catalogo)) {
        return load_template(CONTROLLER . DS . "_catalogosMedicosForm.php", array('catalogo' => $catalogo, 'buscar' => $buscar));
    } else {
	go_to('catalogosMedicos',$buscar);
    }
}

?>