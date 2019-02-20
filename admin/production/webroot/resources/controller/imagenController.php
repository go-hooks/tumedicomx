<?php

defined('JZ_UPALE') or die('Acceso Incorrecto');
define('CONTROLLER', 'Imagen');


require_once MODEL_PATH . DS . 'imagenModel.php';

authenticar();

if (!hasPermission('acceso_imagen')) {
	
    go_to('acceso/denegado');
	
}


function imagen_default() {
    if (!hasPermission('imagen_nuevo')) {
        go_to('acceso/denegado');
    }
    return imagen_editar();
}



function imagen_aplicar() {

    if (!hasPermission('imagen_nuevo')) {
        go_to('acceso/denegado');
    }

    defined('BR') or define('BR', '<br />');

    set_header(array(
        'section' => 'Nuevo Video',
        'libraries' => array('Jquery')
    ));

    $aPost = http_post_request();
 
    
    //Cargando y eliminando la anterior si es que existe
        if( $_FILES['imagen']['error'] === UPLOAD_ERR_OK)
        {    

            if(isset($aPost['imagen']))
            {  
                $borra_imagen_servidor = borrar_archivo_servidor($aPost['imagen']);                                                 
            }

            $carga_al_servidor = subir_al_servidor($_FILES["imagen"]);
            
            if ($carga_al_servidor) 
            {                
                $aPost['imagen'] = $carga_al_servidor;                
            }

        }
    //Fin Imagen
        
        
    //Home
        if( $_FILES['home_imagen']['error'] === UPLOAD_ERR_OK)
        {    

            if(isset($aPost['home_imagen']))
            {  
                $borra_imagen_servidor = borrar_archivo_servidor($aPost['home_imagen']);                                                 
            }

            $carga_al_servidor = subir_al_servidor($_FILES["home_imagen"]);
            
            if ($carga_al_servidor) 
            {                
                $aPost['home_imagen'] = $carga_al_servidor;                
            }

        }
    //Fin Home
        
        
    //Noticia
        if( $_FILES['noticias_imagen']['error'] === UPLOAD_ERR_OK)
        {    

            if(isset($aPost['noticias_imagen']))
            {  
                $borra_imagen_servidor = borrar_archivo_servidor($aPost['noticias_imagen']);                                                 
            }

            $carga_al_servidor = subir_al_servidor($_FILES["noticias_imagen"]);
            
            if ($carga_al_servidor) 
            {                
                $aPost['noticias_imagen'] = $carga_al_servidor;                
            }

        }
    //Fin Noticia        
        

    //Noticia
        if( $_FILES['contacto_imagen']['error'] === UPLOAD_ERR_OK)
        {    

            if(isset($aPost['contacto_imagen']))
            {  
                $borra_imagen_servidor = borrar_archivo_servidor($aPost['contacto_imagen']);                                                 
            }

            $carga_al_servidor = subir_al_servidor($_FILES["contacto_imagen"]);
            
            if ($carga_al_servidor) 
            {                
                $aPost['contacto_imagen'] = $carga_al_servidor;                
            }

        }
    //Fin Noticia     
        
    //Terminos
        if( $_FILES['terminos_imagen']['error'] === UPLOAD_ERR_OK)
        {    

            if(isset($aPost['terminos_imagen']))
            {  
                $borra_imagen_servidor = borrar_archivo_servidor($aPost['terminos_imagen']);                                                 
            }

            $carga_al_servidor = subir_al_servidor($_FILES["terminos_imagen"]);
            
            if ($carga_al_servidor) 
            {                
                $aPost['terminos_imagen'] = $carga_al_servidor;                
            }

        }
    //Fin Terminos    
        
        
        
    if(! isset($aPost['imagen']))
    {            
        $aPost['imagen'] = '';     
    }
        
    if(! isset($aPost['home_imagen']))
    {            
        $aPost['home_imagen'] = '';     
    }
    
    if(! isset($aPost['noticias_imagen']))
    {            
        $aPost['noticias_imagen'] = '';     
    }
    
    if(! isset($aPost['contacto_imagen']))
    {            
        $aPost['contacto_imagen'] = '';     
    }
    
    if(! isset($aPost['terminos_imagen']))
    {            
        $aPost['terminos_imagen'] = '';     
    }    
    
    salvar_imagen($aPost);    
    go_to('imagen');
    
}

function imagen_editar( ) {

    if (!hasPermission('imagen_editar')) {
        go_to('acceso/denegado');
    }

    set_header(array(
        'section' => 'Imagen',
        'libraries' => array('Jquery')
    ));

    $aGet = http_get_request();
    
    $imagen = imagen_read();  
	
    set_header(array('section' => 'Edici&oacute;n de la imagen'));

    return load_template(CONTROLLER . DS . "_imagenForm.php", array('imagen' => $imagen));

}

?>