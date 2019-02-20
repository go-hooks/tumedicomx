<?php

defined('JZ_UPALE') or die('Acceso Incorrecto');
define('CONTROLLER', 'CatalogosProveedores');


require_once MODEL_PATH . DS . 'catalogosProveedoresModel.php';

authenticar();

if (!hasPermission('acceso_catalogos_proveedores')) {
	
    go_to('acceso/denegado');
	
}

function catalogosProveedores_delete(){
	
	$aGet = http_get_request();
        
	$return = db_eliminado_logico('catalogos_proveedores', $aGet['id']);
	
	if($return) {
		set_flash('Eliminado exitoso', 'success');
	} else {
		set_flash('Ha ocurrido un error con el movimiento', 'success');
	}
        
        $buscar = array();
        $buscar['p'] = $aGet['p'];        
        
	go_to('catalogosProveedores',$buscar);
	
}

function catalogosProveedores_default() {
    if (!hasPermission('catalogos_proveedores_nuevo')) {
        go_to('acceso/denegado');
    }
    return catalogosProveedores_desktop();
}

function catalogosProveedores_nuevo() {
    
    set_header(array('section' => 'Nuevo catalogo'));        
    
    $buscar = array();
    $buscar['p'] = 1;   
    
    return load_template(CONTROLLER . DS . "_catalogosProveedoresForm.php", array('buscar' => $buscar));
}

function catalogosProveedores_desktop($aExtData = array()) {
    
        //$catalogos = get_last_catalogo_proveedor();

	$aGet = http_get_request();               
        
        if(!isset($aGet['p']))
        {
            $aGet['p'] = 1;
        }
        
        if(!isset($aGet['buscar']))
        {            
            $aGet['buscar']='';     
        }
                
        $catalogos = buscar_catalogo_proveedor($aGet);  
        
        $datos = array();
        $datos['catalogos'] = $catalogos;
        $datos['buscar'] = $aGet;      
        
	set_header(array('section' => 'Listado'));
        return load_template(CONTROLLER . DS . '_catalogosProveedoresList.php', $datos);
}

function catalogosProveedores_aplicar() {

    if (!hasPermission('catalogos_proveedores_nuevo')) {
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
    
    if( salvar_catalogo_proveedor($aPost)){        
        go_to('catalogosProveedores',$buscar);
    } else {        
        return load_template(CONTROLLER . DS . "_catalogosProveedoresForm.php", array('catalogo' => $aPost, 'buscar' => $buscar));
    }
}

function catalogosProveedores_editar( ) {

    if (!hasPermission('catalogos_proveedores_editar')) {
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
        $catalogo = catalogos_proveedores_read($aGet['id']);
    }
	  
    
    set_header(array('section' => sprintf('Edici&oacute;n del catalogo "%s"', $catalogo['nombre'])));

    if (!empty($catalogo)) {       
        return load_template(CONTROLLER . DS . "_catalogosProveedoresForm.php", array('catalogo' => $catalogo, 'buscar' => $buscar));
    } else {
        go_to('catalogosProveedores',$buscar);
    }
}

?>