<?php

defined('JZ_UPALE') or die('Acceso Incorrecto');
define('CONTROLLER', 'Categorias');


require_once MODEL_PATH . DS . 'categoriasModel.php';
require_once LIBRARY_PATH . DS . 'thumbnail.php';

authenticar();

if (!hasPermission('acceso_categorias')) {
	
    go_to('acceso/denegado');
	
}

function categorias_delete(){
	
	$aGet = http_get_request();
        
	$return = db_eliminado_logico('categorias', $aGet['id']);
	
	if($return) {
		set_flash('Eliminado exitoso', 'success');
	} else {
		set_flash('Ha ocurrido un error con el movimiento', 'success');
	}
        
        $buscar = array();
        $buscar['p'] = $aGet['p'];  
        
	go_to('categorias',$buscar);
	
}

function categorias_default() {
    if (!hasPermission('categorias_nuevo')) {
        go_to('acceso/denegado');
    }
    return categorias_desktop();
}

function categorias_nuevo() {
    
    set_header(array('section' => 'Nuevo categoria'));        
    
    $buscar = array();
    $buscar['p'] = 1;       
    
    return load_template(CONTROLLER . DS . "_categoriasForm.php", array('buscar' => $buscar));
}

function categorias_desktop($aExtData = array()) {    

	$aGet = http_get_request();               
        
        if(!isset($aGet['p']))
        {
            $aGet['p'] = 1;
        }
        
        if(!isset($aGet['buscar']))
        {            
            $aGet['buscar']='';     
        }
                
        $categorias = buscar_categorias($aGet);  
        
        $datos = array();
        $datos['categorias'] = $categorias;
        $datos['buscar'] = $aGet;      
        
	set_header(array('section' => 'Listado'));
        return load_template(CONTROLLER . DS . '_categoriasList.php', $datos);
}

function categorias_aplicar() {

    if (!hasPermission('categorias_nuevo')) {
        go_to('acceso/denegado');
    }

    defined('BR') or define('BR', '<br />');

    set_header(array(
        'section' => 'Nueva Categoria',
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
            
                //REDIMENSIONAR
                        $path = APP_PATH . DS . "uploads" . DS . "images" . DS;                       
                            
                        $x=1920;
                        $y=2086;

                            
                        $imagen_test = explode('.',$carga_al_servidor);
                        if ( strtolower($imagen_test{count($imagen_test)-1}) == 'jpeg' ) {
                          $imagen_test{count($imagen_test)-1} = 'jpg';
                          $imagen_test = implode('.',$imagen_test);
                          rename($path . $carga_al_servidor, $path . $imagen_test);
                          $carga_al_servidor = $imagen_test;
                        }
                        if ( ($imagen_tmb = new Img2Thumb($path . $carga_al_servidor, $x,$y, $path . 'tmb_' . $carga_al_servidor)) ) {
                          unlink($path . $carga_al_servidor);
                          rename($path . 'tmb_' . $carga_al_servidor, $path . $carga_al_servidor);
                        }
                        else {
                          unlink($path . $carga_al_servidor);
                          $carga_al_servidor = '';
                        }                                                
                        
                //FIN REDIMENSIONAR            
                        
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
    
    if(!isset($aPost['color']))
    {
        $aPost['color']= '';
    }    
    
    if(!isset($aPost['mostrar']))
    {
        $aPost['mostrar']= '0';
    }   
    else
    {
        $aPost['mostrar']= '1';
    }
    
    if( salvar_categorias($aPost)){        
	go_to('categorias',$buscar);
    } else {        
        return load_template(CONTROLLER . DS . "_categoriasForm.php", array('categoria' => $aPost, 'buscar' => $buscar));
    }
}

function categorias_editar( ) {

    if (!hasPermission('categorias_editar')) {
        go_to('acceso/denegado');
    }

    set_header(array(
        'section' => 'Categoria',
        'libraries' => array('Jquery')
    ));

    $aGet = http_get_request();
    
    $buscar = array();
    $buscar['p'] = $aGet['p'];      
    
    if(!empty($prevData)){
        $categoria = $prevData;
    } else {
        $categoria = categorias_read($aGet['id']);
    }
	  
    
    set_header(array('section' => sprintf('Edici&oacute;n de la categoria "%s"', $categoria['nombre'])));

    if (!empty($categoria)) {       
        return load_template(CONTROLLER . DS . "_categoriasForm.php", array('categoria' => $categoria, 'buscar' => $buscar));
    } else {
	go_to('categorias',$buscar);
    }
}

?>