<?php

defined('JZ_UPALE') or die('Acceso Incorrecto');
define('CONTROLLER', 'Invasivos');

require_once LIBRARY_PATH . DS . 'thumbnail.php';
require_once MODEL_PATH . DS . 'invasivosModel.php';

authenticar();

if (!hasPermission('acceso_invasivos')) {
	
    go_to('acceso/denegado');
	
}


function invasivos_timmer(){
    
        $aPost = http_post_request();       
        
        if(isset($aPost['timmer']))
        {            
             
            set_timmer($aPost['timmer']);
            
        }
                                   
    return invasivos_desktop();
    
}

function invasivos_delete(){
	
	$aGet = http_get_request();
	
        $invasivo = invasivos_read($aGet['id']);        
	
        $return = db_eliminado_logico('invasivos', $aGet['id']);
        
	if($return) {
		set_flash('Eliminado exitoso', 'success');
	} else {
		set_flash('Ha ocurrido un error con el movimiento', 'success');
	}
	
        $buscar = array();
        $buscar['p'] = $aGet['p'];
        
	go_to('invasivos', $buscar);
	
}

function invasivos_default() {
    if (!hasPermission('invasivos_nuevo')) {
        go_to('acceso/denegado');
    }
    return invasivos_desktop();
}

function invasivos_nuevo() {
	set_header(array(
                        'section' => 'Nuevo invasivo',
                        'libraries' => array('Jquery','JCalendar'),
                        'javascript' => array('invasivos.js')
                    ));
        
    $buscar = array();
    $buscar['p'] = 1;      
    
    
    return load_template(CONTROLLER . DS . "_invasivosForm.php", array('buscar' => $buscar));
}

function invasivos_desktop($aExtData = array()) {
    
        //$invasivos = get_last_invasivo();
	$aGet = http_get_request();               
        
        if(!isset($aGet['p']))
        {
            $aGet['p'] = 1;
        }     
        
        if(!isset($aGet['buscar']))
        {            
            $aGet['buscar']='';     
        }
                        
        $invasivos = buscar_invasivos($aGet);          
        
        $datos = array();
        $datos['invasivos'] = $invasivos;
        $datos['buscar'] = $aGet;       
        
    
    set_header(array('section' => 'Listado'));           
    return load_template(CONTROLLER . DS . '_invasivosList.php',$datos);
}

function invasivos_aplicar() {

    if (!hasPermission('invasivos_nuevo')) {
        go_to('acceso/denegado');
    }

    defined('BR') or define('BR', '<br />');

    set_header(array(
        'section' => 'Nueva Imagen',
        'libraries' => array('Jquery','JCalendar'),
        'javascript' => array('invasivos.js')
    ));

    $aPost = http_post_request();
    
    $buscar = array();
    $buscar['p'] = $aPost['p'];      


    if(! isset($aPost['tipo']))
        {            
            set_flash('Falta tipo de Banner', 'warning');
            return load_template(CONTROLLER . DS . "_invasivosForm.php", array('invasivo' => $aPost, 'buscar' => $buscar));
        }

    if(! isset($aPost['localizacion']))
        {            
            set_flash('Falta la Localizacion del Banner', 'warning');
            return load_template(CONTROLLER . DS . "_invasivosForm.php", array('invasivo' => $aPost, 'buscar' => $buscar));
        }
        
    if(empty($aPost['fecha_inicio']))
        {    
            set_flash('Falta fecha de inicio', 'warning');
            return load_template(CONTROLLER . DS . "_invasivosForm.php", array('invasivo' => $aPost, 'buscar' => $buscar));
        }
        
    if(empty($aPost['fecha_fin']))
        {            
             set_flash('Falta fecha final', 'warning');
            return load_template(CONTROLLER . DS . "_invasivosForm.php", array('invasivo' => $aPost, 'buscar' => $buscar));
        } 
        
    $fecha_inicio = strtotime($aPost['fecha_inicio']);
    $fecha_fin = strtotime($aPost['fecha_fin']);
    
    
    if($fecha_inicio > $fecha_fin){
        set_flash('La fecha de inicio no puede ser mayor.', 'warning');
        return load_template(CONTROLLER . DS . "_invasivosForm.php", array('invasivo' => $aPost, 'buscar' => $buscar));  
    }   
    
    
    //Cargando nuevo invasivo y eliminando la anterior si es que existe
        if( $_FILES['Imagen']['error'] === UPLOAD_ERR_OK)
        {    

            if(isset($aPost['imagen']))
            {  
                $borra_imagen_servidor = borrar_archivo_servidor($aPost['imagen']);                                                 
            }

            $carga_al_servidor = subir_al_servidor($_FILES["Imagen"]);

            
            if ($carga_al_servidor) 
            {

                $extension = explode('.',$carga_al_servidor);
                if ( strtolower($extension{count($extension)-1}) != 'gif' ) 
                {            
                
                
                //REDIMENSIONAR
                        $path = APP_PATH . DS . "uploads" . DS . "images" . DS;                       
                            
                            switch($aPost['tipo'])
                            {
                                case 1:
                                {
                                    $x=800;
                                    $y=500;
                                    break;
                                }
                            }
                            
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
                }
                
                $aPost['imagen'] = $carga_al_servidor;                
            }

        }


    if(! isset($aPost['cliente']))
        {            
            $aPost['cliente'] = '';     
        }   
        
    if(! isset($aPost['url']))
        {            
            $aPost['url'] = '';     
        }                
        
    if(! isset($aPost['imagen']))
        {            
            $aPost['imagen'] = '';     
        }

      
        
    if( salvar_invasivo($aPost)){        
	go_to('invasivos', $buscar);
    } else {
        return load_template(CONTROLLER . DS . "_invasivosForm.php", array('invasivo' => $aPost, 'buscar' => $buscar));
    }
}

function invasivos_editar( ) {

    if (!hasPermission('invasivos_editar')) {
        go_to('acceso/denegado');
    }

    set_header(array(
        'section' => 'Banner',
        'libraries' => array('Jquery','JCalendar'),
        'javascript' => array('invasivos.js')
    ));

    $aGet = http_get_request();

    $buscar = array();
    $buscar['p'] = $aGet['p'];  
    
    if(!empty($prevData)){
        $invasivo = $prevData;
    } else {
        $invasivo = invasivos_read($aGet['id']);
    }
	
    
    $datos = array();
    $datos['invasivo'] = $invasivo;
    $datos['buscar'] = $buscar;
        
    set_header(array('section' => 'Edici&oacute;n del invasivo'));

    if (!empty($invasivo)) {
        return load_template(CONTROLLER . DS . "_invasivosForm.php", $datos);
    } else {
	go_to('invasivos', $buscar);
    }
}



?>