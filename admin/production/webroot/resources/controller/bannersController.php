<?php

defined('JZ_UPALE') or die('Acceso Incorrecto');
define('CONTROLLER', 'Banners');

require_once LIBRARY_PATH . DS . 'thumbnail.php';
require_once MODEL_PATH . DS . 'bannersModel.php';

authenticar();

if (!hasPermission('acceso_banners')) {
	
    go_to('acceso/denegado');
	
}


function banners_timmer(){
    
        $aPost = http_post_request();       
        
        if(isset($aPost['timmer']))
        {            
             
            set_timmer($aPost['timmer']);
            
        }
                                   
    return banners_desktop();
    
}

function banners_delete(){
	
	$aGet = http_get_request();
	
        $banner = banners_read($aGet['id']);
        
            if($banner['imagen']!='')
            {  
                $borra_imagen_servidor = borrar_archivo_servidor($banner['imagen']);                                                 
            }
            
	$return = db_eliminar_por_id('banners', $aGet['id']);
	
        
	if($return) {
		set_flash('Eliminado exitoso', 'success');
	} else {
		set_flash('Ha ocurrido un error con el movimiento', 'success');
	}
	
        $buscar = array();
        $buscar['p'] = $aGet['p'];
        
	go_to('banners', $buscar);
	
}

function banners_default() {
    if (!hasPermission('banners_nuevo')) {
        go_to('acceso/denegado');
    }
    return banners_desktop();
}

function banners_nuevo() {
	set_header(array(
                        'section' => 'Nuevo banner',
                        'libraries' => array('Jquery','JCalendar'),
                        'javascript' => array('banners.js')
                    ));
        
    $buscar = array();
    $buscar['p'] = 1;      
    
    
    return load_template(CONTROLLER . DS . "_bannersForm.php", array('buscar' => $buscar));
}

function banners_desktop($aExtData = array()) {
    
        //$banners = get_last_banner();
	$aGet = http_get_request();               
        
        if(!isset($aGet['p']))
        {
            $aGet['p'] = 1;
        }     
        
        if(!isset($aGet['buscar']))
        {            
            $aGet['buscar']='';     
        }
                        
        $banners = buscar_banners($aGet);  
        
        $timmer = get_timmer();       
        
        $datos = array();
        $datos['banners'] = $banners;
        $datos['buscar'] = $aGet;       
        $datos['timmer'] = $timmer['tiempo'];       
        
    
    set_header(array('section' => 'Listado'));           
    return load_template(CONTROLLER . DS . '_bannersList.php',$datos);
}

function banners_aplicar() {

    if (!hasPermission('banners_nuevo')) {
        go_to('acceso/denegado');
    }

    defined('BR') or define('BR', '<br />');

    set_header(array(
        'section' => 'Nueva Imagen',
        'libraries' => array('Jquery','JCalendar'),
        'javascript' => array('banners.js')
    ));

    $aPost = http_post_request();
    
    $buscar = array();
    $buscar['p'] = $aPost['p'];      


    if(! isset($aPost['tipo']))
        {            
            set_flash('Falta tipo de Banner', 'warning');
            return load_template(CONTROLLER . DS . "_bannersForm.php", array('banner' => $aPost, 'buscar' => $buscar));
        }

    if(! isset($aPost['localizacion']))
        {            
            set_flash('Falta la Localizacion del Banner', 'warning');
            return load_template(CONTROLLER . DS . "_bannersForm.php", array('banner' => $aPost, 'buscar' => $buscar));
        }
        
    if(empty($aPost['fecha_inicio']))
        {    
            set_flash('Falta fecha de inicio', 'warning');
            return load_template(CONTROLLER . DS . "_bannersForm.php", array('banner' => $aPost, 'buscar' => $buscar));
        }
        
    if(empty($aPost['fecha_fin']))
        {            
             set_flash('Falta fecha final', 'warning');
            return load_template(CONTROLLER . DS . "_bannersForm.php", array('banner' => $aPost, 'buscar' => $buscar));
        } 
        
    $fecha_inicio = strtotime($aPost['fecha_inicio']);
    $fecha_fin = strtotime($aPost['fecha_fin']);
    
    
    if($fecha_inicio > $fecha_fin){
        set_flash('La fecha de inicio no puede ser mayor.', 'warning');
        return load_template(CONTROLLER . DS . "_bannersForm.php", array('banner' => $aPost, 'buscar' => $buscar));  
    }   
    
    
    //Cargando nuevo banner y eliminando la anterior si es que existe
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
                                    $x=960;
                                    $y=130;
                                    break;
                                }
                                case 2:
                                {
                                    $x=960;
                                    $y=220;
                                    break;
                                }
                                case 3:
                                {
                                    $x=400;
                                    $y=375;
                                    break;
                                }
                                case 4:
                                {
                                    $x=400;
                                    $y=275;
                                    break;
                                }
                                case 5:
                                {
                                    $x=400;
                                    $y=140;
                                    break;
                                }
                                case 6:
                                {
                                    $x=830;
                                    $y=250;
                                    break;
                                }                                
                                case 7:
                                {
                                    $x=830;
                                    $y=110;
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

      
        
    if( salvar_banner($aPost)){        
	go_to('banners', $buscar);
    } else {
        return load_template(CONTROLLER . DS . "_bannersForm.php", array('banner' => $aPost, 'buscar' => $buscar));
    }
}

function banners_editar( ) {

    if (!hasPermission('banners_editar')) {
        go_to('acceso/denegado');
    }

    set_header(array(
        'section' => 'Banner',
        'libraries' => array('Jquery','JCalendar'),
        'javascript' => array('banners.js')
    ));

    $aGet = http_get_request();

    $buscar = array();
    $buscar['p'] = $aGet['p'];  
    
    if(!empty($prevData)){
        $banner = $prevData;
    } else {
        $banner = banners_read($aGet['id']);
    }
	
    
    $datos = array();
    $datos['banner'] = $banner;
    $datos['buscar'] = $buscar;
        
    set_header(array('section' => 'Edici&oacute;n del banner'));

    if (!empty($banner)) {
        return load_template(CONTROLLER . DS . "_bannersForm.php", $datos);
    } else {
	go_to('banners', $buscar);
    }
}



?>