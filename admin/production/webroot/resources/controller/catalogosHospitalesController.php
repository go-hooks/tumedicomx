<?php

defined('JZ_UPALE') or die('Acceso Incorrecto');
define('CONTROLLER', 'CatalogosHospitales');


require_once MODEL_PATH . DS . 'catalogosHospitalesModel.php';

authenticar();

if (!hasPermission('acceso_catalogos_hospitales')) {
	
    go_to('acceso/denegado');
	
}

function catalogosHospitales_delete(){
	
	$aGet = http_get_request();
        
	$return = db_eliminado_logico('catalogos_hospitales', $aGet['id']);
	
	if($return) {
		set_flash('Eliminado exitoso', 'success');
	} else {
		set_flash('Ha ocurrido un error con el movimiento', 'success');
	}
        
        
        $buscar = array();
        $buscar['p'] = $aGet['p'];          
        
	go_to('catalogosHospitales',$buscar);
	
}

function catalogosHospitales_default() {
    if (!hasPermission('catalogos_hospitales_nuevo')) {
        go_to('acceso/denegado');
    }
    return catalogosHospitales_desktop();
}

function catalogosHospitales_nuevo() {
    
    set_header(array('section' => 'Nuevo catalogo'));
        
    $padres = cargar_padres_catalogo_hospital();
    
    $buscar = array();
    $buscar['p'] = 1;       
    
    return load_template(CONTROLLER . DS . "_catalogosHospitalesForm.php", array('padres' => $padres, 'buscar' => $buscar));
}

function catalogosHospitales_desktop($aExtData = array()) {
    

        //$catalogos = get_last_catalogo_hospital();
        
	$aGet = http_get_request();               
        
        if(!isset($aGet['p']))
        {
            $aGet['p'] = 1;
        }
        
        if(!isset($aGet['buscar']))
        {            
            $aGet['buscar']='';     
        }
                
        $catalogos = buscar_catalogo_hospital($aGet);  
        
        $datos = array();
        $datos['catalogos'] = $catalogos;
        $datos['buscar'] = $aGet;      
        
	set_header(array('section' => 'Listado'));
        return load_template(CONTROLLER . DS . '_catalogosHospitalesList.php', $datos);
}

function catalogosHospitales_aplicar() {

    if (!hasPermission('catalogos_hospitales_nuevo')) {
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
    
    
    if(!isset($aPost['nombre']))
    {
        $aPost['nombre']= '';
    }
    if(!isset($aPost['padre_id']))
    {
        $aPost['padre_id']= '';
    }

    
    if( salvar_catalogo_hospital($aPost)){        
	go_to('catalogosHospitales',$buscar);
    } else {        
        $padres = cargar_padres_catalogo_hospital();
        return load_template(CONTROLLER . DS . "_catalogosHospitalesForm.php", array('catalogo' => $aPost, 'padres' => $padres, 'buscar' => $buscar));
    }
}

function catalogosHospitales_editar( ) {

    if (!hasPermission('catalogos_hospitales_editar')) {
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
        $catalogo = catalogos_hospitales_read($aGet['id']);
    }
	  
    
    set_header(array('section' => sprintf('Edici&oacute;n del catalogo "%s"', $catalogo['nombre'])));

    if (!empty($catalogo)) {
        $padres = cargar_padres_catalogo_hospital();
                
        return load_template(CONTROLLER . DS . "_catalogosHospitalesForm.php", array('catalogo' => $catalogo, 'padres' => $padres, 'buscar' => $buscar));
    } else {
	go_to('catalogosHospitales',$buscar);
    }
}

?>