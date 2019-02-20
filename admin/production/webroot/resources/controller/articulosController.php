<?php

defined('JZ_UPALE') or die('Acceso Incorrecto');
define('CONTROLLER', 'Articulos');


require_once MODEL_PATH . DS . 'articulosModel.php';
require_once MODEL_PATH . DS . 'categoriasModel.php';
require_once LIBRARY_PATH . DS . 'thumbnail.php';

authenticar();

if (!hasPermission('acceso_articulos')) {
	
    go_to('acceso/denegado');
	
}

function articulos_delete(){
	
	$aGet = http_get_request();
        
	$return = db_eliminado_logico('articulos', $aGet['id']);
	
	if($return) {
		set_flash('Eliminado exitoso', 'success');
	} else {
		set_flash('Ha ocurrido un error con el movimiento', 'success');
	}
        
        $buscar = array();
        $buscar['p'] = $aGet['p'];  
        
	go_to('articulos',$buscar);
	
}

function articulos_default() {
    if (!hasPermission('articulos_nuevo')) {
        go_to('acceso/denegado');
    }
           
    return articulos_desktop();
}

function articulos_nuevo() {
    
    set_header(array('section' => 'Nuevo articulo',
                    'libraries' => array('Jquery','JCalendar','ckeditor')            
              ));        
    
    
    $categorias = cargar_categorias();
    
    $buscar = array();
    $buscar['p'] = 1;       
        
    return load_template(CONTROLLER . DS . "_articulosForm.php", array('buscar' => $buscar, 'categorias' => $categorias));
}

function articulos_desktop($aExtData = array()) {    

	$aGet = http_get_request();               
        
        if(!isset($aGet['p']))
        {
            $aGet['p'] = 1;
        }
        
        if(!isset($aGet['buscar']))
        {            
            $aGet['buscar']='';     
        }

        if(!isset($aGet['categoria_id']))
        {            
            $aGet['categoria_id']='';     
        }
        
        $articulos = buscar_articulos($aGet);          
        
        $datos = array();
                
        $datos['categorias'] = cargar_categorias();
        $datos['articulos'] = $articulos;
        $datos['buscar'] = $aGet;      
        
	set_header(array('section' => 'Listado'));
        return load_template(CONTROLLER . DS . '_articulosList.php', $datos);
}

function articulos_aplicar() {

    if (!hasPermission('articulos_nuevo')) {
        go_to('acceso/denegado');
    }

    defined('BR') or define('BR', '<br />');

    set_header(array(
        'section' => 'Nueva Categoria',
        'libraries' => array('Jquery','JCalendar','ckeditor')
    ));

    $aPost = http_post_request();       

    $categorias = cargar_categorias();
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
    
    
    if(!isset($aPost['categoria_id']))
    {
        $aPost['categoria_id']= '';
    }
    
    if(!isset($aPost['fecha']))
    {
        $aPost['fecha']= '';
    }    

    if(!isset($aPost['autor']))
    {
        $aPost['autor']= '';
    } 

    if(!isset($aPost['correo']))
    {
        $aPost['correo']= '';
    } 
    
    if(!isset($aPost['titulo']))
    {
        $aPost['titulo']= '';
    } 

    if(!isset($aPost['video']))
    {
        $aPost['video']= '';
    } 

    if(!isset($aPost['texto_video']))
    {
        $aPost['texto_video']= '';
    } 
    
    if(!isset($aPost['palabras_clave']))
    {
        $aPost['palabras_clave']= '';
    } 

    if(!isset($aPost['autorizado']))
    {
        $aPost['autorizado']= '0';
    }     
    
    
    if( salvar_articulos($aPost)){        
	go_to('articulos',$buscar);
    } else {        
        return load_template(CONTROLLER . DS . "_articulosForm.php", array('articulo' => $aPost, 'buscar' => $buscar, 'categorias' => $categorias));
    }
}

function articulos_editar( ) {

    if (!hasPermission('articulos_editar')) {
        go_to('acceso/denegado');
    }

    set_header(array(
        'section' => 'Categoria',
        'libraries' => array('Jquery','JCalendar','ckeditor')
    ));

    $aGet = http_get_request();
    
    $buscar = array();
    $buscar['p'] = $aGet['p'];      
    $categorias = cargar_categorias();
    
    if(!empty($prevData)){
        $articulo = $prevData;
    } else {
        $articulo = articulos_read($aGet['id']);
    }
	  
    
    set_header(array('section' => sprintf('Edici&oacute;n del articulo "%s"', $articulo['titulo'])));

    if (!empty($articulo)) {       
        return load_template(CONTROLLER . DS . "_articulosForm.php", array('articulo' => $articulo, 'buscar' => $buscar, 'categorias' => $categorias));
    } else {
	go_to('articulos',$buscar);
    }
}


function articulos_comentarios( ) {

    if (!hasPermission('articulos_editar')) {
        go_to('acceso/denegado');
    }

    set_header(array(
        'section' => 'Comentarios',
        'libraries' => array('Jquery')
    ));

    $aGet = http_get_request();
    
    $buscar = array();
    $buscar['p'] = $aGet['p'];      
    
    $articulo = articulos_read($aGet['id']);
    $comentarios = cargar_comentarios($aGet['id']);
        
    set_header(array('section' => sprintf('Comentarios del articulo "%s"', $articulo['titulo'])));

    if (!empty($articulo)) {       
        return load_template(CONTROLLER . DS . "_articulosComentarios.php", array('articulo' => $articulo, 'buscar' => $buscar, 'comentarios' => $comentarios));
    } else {
	go_to('articulos',$buscar);
    }
}


function articulos_deleteComentario(){
	
	$aGet = http_get_request();
        
	$return = db_eliminar_por_id('comentarios', $aGet['comentario_id']);
	
	if($return) {
		set_flash('Eliminado exitoso', 'success');
	} else {
		set_flash('Ha ocurrido un error con el movimiento', 'success');
	}
        
        $buscar = array();
        $buscar['p'] = $aGet['p'];  
        
        $articulo = articulos_read($aGet['id']);
        $comentarios = cargar_comentarios($aGet['id']);
    
        if (!empty($articulo)) {       
            return load_template(CONTROLLER . DS . "_articulosComentarios.php", array('articulo' => $articulo, 'buscar' => $buscar, 'comentarios' => $comentarios));
        } else {
            go_to('articulos',$buscar);
        }
	
}

?>