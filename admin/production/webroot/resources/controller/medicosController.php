<?php

defined('JZ_UPALE') or die('Acceso Incorrecto');
define('CONTROLLER', 'Medicos');


require_once MODEL_PATH . DS . 'medicosModel.php';
require_once MODEL_PATH . DS . 'estadosModel.php';
require_once MODEL_PATH . DS . 'municipiosModel.php';
require_once MODEL_PATH . DS . 'catalogosMedicosModel.php';
require_once MODEL_PATH . DS . 'tarjetasModel.php';
require_once MODEL_PATH . DS . 'aseguradorasModel.php';
require_once LIBRARY_PATH . DS . 'thumbnail.php';

authenticar();

if (!hasPermission('acceso_medicos')) {
	
    go_to('acceso/denegado');
	
}

function medicos_delete(){
	
	$aGet = http_get_request();
        
	$return = db_eliminado_logico('registros', $aGet['id']);
	
	if($return) {
		set_flash('Eliminado exitoso', 'success');
	} else {
		set_flash('Ha ocurrido un error con el movimiento', 'success');
	}
        
        $buscar = array();
        $buscar['p'] = $aGet['p'];         
        
	go_to('medicos', $buscar);
	
}

function medicos_default() {
    if (!hasPermission('medicos_nuevo')) {
        go_to('acceso/denegado');
    }
    return medicos_desktop();
}

function medicos_nuevo() {

    set_header(array(
                'section' => 'Nuevo Medico',
                'javascript' => array('municipios.js')
                ));
    
    $buscar = array();
    $buscar['p'] = 1;     
        
    $datos = array();
    $datos['categorias'] = cargar_catalogo_medico();
    $datos['estados'] = cargar_estados();
    $datos['buscar'] = $buscar;    
    
    return load_template(CONTROLLER . DS . "_medicosForm.php", $datos);
}

function medicos_desktop($aExtData = array()) {
    
	$aGet = http_get_request();               
        
        if(!isset($aGet['p']))
        {
            $aGet['p'] = 1;
        }
        
        if(!isset($aGet['buscar']))
        {            
            $aGet['buscar']='';     
        }  
        
        $medicos = buscar_medicos($aGet); 
        
        
        if(strtoupper($aGet['buscar'])=='PENDIENTE' || strtoupper($aGet['buscar'])=='AUTORIZADO'){
            
             $medicos = buscar_medicos_estatus($aGet); 
        }

        if(strtoupper($aGet['buscar'])=='INACTIVO' || strtoupper($aGet['buscar'])=='ACTIVO'){
            
            $medicos = buscar_medicos_sitio($aGet); 
            
        }

        $datos = array();
        $datos['medicos'] = $medicos;
        $datos['buscar'] = $aGet;      
        
        
	set_header(array('section' => 'Listado'));        
        return load_template(CONTROLLER . DS . '_medicosList.php', $datos);
}

function medicos_aplicar() {

    if (!hasPermission('medicos_nuevo')) {
        go_to('acceso/denegado');
    }

    defined('BR') or define('BR', '<br />');    
        
    set_header(array(
        'section' => 'Nuevo Medico',
        'libraries' => array('Jquery'),
        'javascript' => array('municipios.js')
    ));

    $aPost = http_post_request();
        
    $buscar = array();
    $buscar['p'] = $aPost['p'];    
    
    $datos = array();
    $datos['medico'] = $aPost;
    $datos['categorias'] = cargar_catalogo_medico();
    $datos['estados'] = cargar_estados();    
    $datos['buscar'] = $buscar; 
    
    if (!filter_var($aPost['correo_contacto'], FILTER_VALIDATE_EMAIL)) {
            set_flash('El correo es incorrecto', 'warning'); 
            return load_template(CONTROLLER . DS . "_medicosForm.php", $datos);
    }

     if(isset($aPost['id'])) {
         
            $aUser = medicos_read($aPost['id']);
            
            if($aUser['correo']!=$aPost['correo'])
            {
                if(comprobar_correo($aPost['correo'])){
                        set_flash('El usuario ya ha sido registrado', 'warning'); 
                        return load_template(CONTROLLER . DS . "_medicosForm.php", $datos);                
                }              
            }
            
            if (!empty($aPost['password']) && !empty($aPost['confirm_password'])) {
                if ($aPost['password'] != $aPost['confirm_password']) {
                    set_flash('La contraseña y la confirmacion no coinciden', 'warning'); 
                    return load_template(CONTROLLER . DS . "_medicosForm.php", $datos);
                }
            } else {
                $aPost['password'] = Encrypter::decrypt($aUser['password']);
            }                                 
     }
     else{
         
            if(comprobar_correo($aPost['correo'])){
                    set_flash('El usuario ya ha sido registrado', 'warning'); 
                    return load_template(CONTROLLER . DS . "_medicosForm.php", $datos);                
            }
            if (empty($aPost['password'])) {
                    set_flash('La contraseña es obligatoria', 'warning'); 
                    return load_template(CONTROLLER . DS . "_medicosForm.php", $datos);
            }
            if (empty($aPost['confirm_password'])) {
                    set_flash('La confirmacion de la contraseña es obligatoria', 'warning'); 
                    return load_template(CONTROLLER . DS . "_medicosForm.php", $datos);
            }
            if ($aPost['password'] != $aPost['confirm_password']) {
                    set_flash('La contraseña y la confirmacion no coinciden', 'warning'); 
                    return load_template(CONTROLLER . DS . "_medicosForm.php", $datos);
            }         
         
     }
     
    if(!isset($aPost['horario'])){
        $aPost['horario'] = '';
    }        
    
    if(!isset($aPost['correo_contacto'])){
        $aPost['correo_contacto'] = '';
    }           
     
    if(!isset($aPost['celular_contacto'])){
        $aPost['celular_contacto'] = '';
    }      
    
    if(!isset($aPost['radio_contacto'])){
        $aPost['radio_contacto'] = '';
    }      

    if(!isset($aPost['categoria_id'])){
        $aPost['categoria_id'] = '';
    }      

    if(!isset($aPost['cedula'])){
        $aPost['cedula'] = '';
    }      

    if(!isset($aPost['autorizado'])){
        $aPost['autorizado'] = '0';
    }      
    else{
        $aPost['autorizado'] = '1';
    }
    
    if(!isset($aPost['destacado'])){
        $aPost['destacado'] = '0';
    }      
    else{
        $aPost['destacado'] = '1';
    }
    
    if(!isset($aPost['palabras_clave'])){
        $aPost['palabras_clave'] = '';
    }      

    if(!isset($aPost['estado_id'])){
        $aPost['estado_id'] = '';
    }    

    if(!isset($aPost['municipio_id'])){
        $aPost['municipio_id'] = '';
    }        

    if(!isset($aPost['encuesta'])){
        $aPost['encuesta'] = '';
    }      

    
    if( salvar_medico($aPost)){        
        go_to('medicos', $buscar);
    } else {        
        return load_template(CONTROLLER . DS . "_medicosForm.php", $datos);
    }
}

function medicos_editar( ) {

    if (!hasPermission('medicos_editar')) {
        go_to('acceso/denegado');
    }

    set_header(array(
        'section' => 'Medicos',
        'libraries' => array('Jquery'),
        'javascript' => array('municipios.js')
    ));

    $aGet = http_get_request();
    
    $buscar = array();
    $buscar['p'] = $aGet['p'];      
    
    if(!empty($prevData)){
        $medico = $prevData;
    } else {
        $medico = medicos_read($aGet['id']);
    }
    
    
    
    $datos = array();
    $datos['medico'] = $medico;
    $datos['categorias'] = cargar_catalogo_medico();
    $datos['estados'] = cargar_estados();   
    $datos['municipios'] = estado_municipios($medico['estado_id']);  
    $datos['buscar'] = $buscar;
        
    set_header(array('section' => sprintf('Edici&oacute;n del medico "%s"', $medico['nombre'] . ' ' . $medico['apellidos'] )));

    if (!empty($medico)) {
        return load_template(CONTROLLER . DS . "_medicosForm.php", $datos);
    } else {
        go_to('medicos', $buscar);
    }
}

function medicos_datos( ) {

    if (!hasPermission('medicos_editar')) {
        go_to('acceso/denegado');
    }

    set_header(array(
        'section' => 'Medicos',
        'libraries' => array('Jquery')
    ));

    $aGet = http_get_request();
    
    $buscar = array();
    $buscar['p'] = $aGet['p'];  
    
    $medico = medicos_read($aGet['id']);
    
    $datos = array();
    $datos['medico'] = $medico;
    $datos['aseguradoras'] = cargar_aseguradoras();
    $datos['tarjetas'] = cargar_tarjetas();
    
    $datos['medico_aseguradoras'] = medicos_aseguradoras($aGet['id']);    
    $datos['medico_tarjetas'] = medicos_tarjetas($aGet['id']);    
    $datos['buscar'] = $buscar;  
        
    set_header(array('section' => sprintf('Edici&oacute;n del medico "%s"', $medico['nombre'] . ' ' . $medico['apellidos'] )));

    if (!empty($medico)) {
        return load_template(CONTROLLER . DS . "_datosForm.php", $datos);
    } else {
        go_to('medicos', $buscar);
    }
}


function medicos_agregarAseguradora() {

    if (!hasPermission('medicos_nuevo')) {
        go_to('acceso/denegado');
    }

    defined('BR') or define('BR', '<br />');    
        
    set_header(array(
        'section' => 'Medicos',
        'libraries' => array('Jquery')
    ));

    $aPost = http_post_request();
    
    $buscar = array();
    $buscar['p'] = $aPost['p'];      
        
    if(!isset($aPost['registro_id'])){
        $aPost['registro_id'] = '';
    }      
    
    if(!isset($aPost['aseguradora_id'])){
        $aPost['aseguradora_id'] = '';
    }      
          
    agregar_aseguradora($aPost);
                
        $medico = medicos_read($aPost['registro_id']);
        
        $datos = array();
        $datos['medico'] = $medico;
        $datos['aseguradoras'] = cargar_aseguradoras();
        $datos['tarjetas'] = cargar_tarjetas();

        $datos['medico_aseguradoras'] = medicos_aseguradoras($aPost['registro_id']);    
        $datos['medico_tarjetas'] = medicos_tarjetas($aPost['registro_id']);    
        $datos['buscar'] = $buscar;
        
        set_header(array('section' => sprintf('Edici&oacute;n del medico "%s"', $medico['nombre'] . ' ' . $medico['apellidos'] )));
        return load_template(CONTROLLER . DS . "_datosForm.php", $datos);

}

function medicos_agregarTarjeta() {

    if (!hasPermission('medicos_nuevo')) {
        go_to('acceso/denegado');
    }

    defined('BR') or define('BR', '<br />');    
        
    set_header(array(
        'section' => 'Medicos',
        'libraries' => array('Jquery')
    ));

    $aPost = http_post_request();
    
    $buscar = array();
    $buscar['p'] = $aPost['p'];     
        
    if(!isset($aPost['registro_id'])){
        $aPost['registro_id'] = '';
    }      
    
    if(!isset($aPost['tarjeta_id'])){
        $aPost['tarjeta_id'] = '';
    }      
          
    agregar_tarjeta($aPost);
                
        $medico = medicos_read($aPost['registro_id']);
        
        $datos = array();
        $datos['medico'] = $medico;
        $datos['aseguradoras'] = cargar_aseguradoras();
        $datos['tarjetas'] = cargar_tarjetas();

        $datos['medico_aseguradoras'] = medicos_aseguradoras($aPost['registro_id']);    
        $datos['medico_tarjetas'] = medicos_tarjetas($aPost['registro_id']);   
        $datos['buscar'] = $buscar;
        
        set_header(array('section' => sprintf('Edici&oacute;n del medico "%s"', $medico['nombre'] . ' ' . $medico['apellidos'] )));
        return load_template(CONTROLLER . DS . "_datosForm.php", $datos);

}


function medicos_deleteAseguradora( ) {

    if (!hasPermission('medicos_editar')) {
        go_to('acceso/denegado');
    }

    set_header(array(
        'section' => 'Medicos',
        'libraries' => array('Jquery')
    ));
    
    $aGet = http_get_request();
    
    $buscar = array();
    $buscar['p'] = $aGet['p'];      

    if(!isset($aGet['registro_id'])){
        $aGet['registro_id'] = '';
    }      
    
    if(!isset($aGet['aseguradora_id'])){
        $aGet['aseguradora_id'] = '';
    }      
    
    $return = db_eliminar_por_sql('DELETE FROM registro_aseguradora WHERE registro_id=' . $aGet['registro_id'] . ' AND aseguradora_id=' . $aGet['aseguradora_id']);
    
	if($return) {
		set_flash('Eliminado exitoso', 'success');
	} else {
		set_flash('Ha ocurrido un error con el movimiento', 'success');
	}
        
        $medico = medicos_read($aGet['registro_id']);
        
        $datos = array();
        $datos['medico'] = $medico;
        $datos['aseguradoras'] = cargar_aseguradoras();
        $datos['tarjetas'] = cargar_tarjetas();

        $datos['medico_aseguradoras'] = medicos_aseguradoras($aGet['registro_id']);    
        $datos['medico_tarjetas'] = medicos_tarjetas($aGet['registro_id']);
        $datos['buscar'] = $buscar;
        
        set_header(array('section' => sprintf('Edici&oacute;n del medico "%s"', $medico['nombre'] . ' ' . $medico['apellidos'] )));
        
        return load_template(CONTROLLER . DS . "_datosForm.php", $datos);
        
}


function medicos_deleteTarjeta( ) {

    if (!hasPermission('medicos_editar')) {
        go_to('acceso/denegado');
    }

    set_header(array(
        'section' => 'Medicos',
        'libraries' => array('Jquery')
    ));
    
    $aGet = http_get_request();
    
    $buscar = array();
    $buscar['p'] = $aGet['p'];
    
    if(!isset($aGet['registro_id'])){
        $aGet['registro_id'] = '';
    }      
    
    if(!isset($aGet['tarjeta_id'])){
        $aGet['tarjeta_id'] = '';
    }      
    
    $return = db_eliminar_por_sql('DELETE FROM registro_tarjeta WHERE registro_id=' . $aGet['registro_id'] . ' AND tarjeta_id=' . $aGet['tarjeta_id']);
    
	if($return) {
		set_flash('Eliminado exitoso', 'success');
	} else {
		set_flash('Ha ocurrido un error con el movimiento', 'success');
	}
        
        $medico = medicos_read($aGet['registro_id']);
        
        $datos = array();
        $datos['medico'] = $medico;
        $datos['aseguradoras'] = cargar_aseguradoras();
        $datos['tarjetas'] = cargar_tarjetas();

        $datos['medico_aseguradoras'] = medicos_aseguradoras($aGet['registro_id']);    
        $datos['medico_tarjetas'] = medicos_tarjetas($aGet['registro_id']);    
        $datos['buscar'] = $buscar;
        
        set_header(array('section' => sprintf('Edici&oacute;n del medico "%s"', $medico['nombre'] . ' ' . $medico['apellidos'] )));
        
        return load_template(CONTROLLER . DS . "_datosForm.php", $datos);
        
}


function medicos_facturacion( ) {

    if (!hasPermission('medicos_editar')) {
        go_to('acceso/denegado');
    }

    set_header(array(
        'section' => 'Medicos',
        'libraries' => array('Jquery')
    ));

    $aGet = http_get_request();
    
    $buscar = array();
    $buscar['p'] = $aGet['p'];
    
    if(!empty($prevData)){
        $medico = $prevData;
    } else {
        $medico = medicos_read($aGet['id']);
    }
        
    
    $datos = array();
    $datos['medico'] = $medico;
    $datos['buscar'] = $buscar;
        
    set_header(array('section' => sprintf('Edici&oacute;n del medico "%s"', $medico['nombre'] . ' ' . $medico['apellidos'] )));

    if (!empty($medico)) {
        return load_template(CONTROLLER . DS . "_facturacionForm.php", $datos);
    } else {
        go_to('medicos', $buscar);
    }
}


function medicos_aplicarFacturacion() {

    if (!hasPermission('medicos_nuevo')) {
        go_to('acceso/denegado');
    }

    defined('BR') or define('BR', '<br />');    
        
    set_header(array(
        'section' => 'Nuevo Medico',
        'libraries' => array('Jquery')
    ));

    $aPost = http_post_request();

    $buscar = array();
    $buscar['p'] = $aPost['p'];       
        
    if(!isset($aPost['razon_social'])){
        $aPost['razon_social'] = '';
    }      
    
    if(!isset($aPost['rfc'])){
        $aPost['rfc'] = '';
    }      

    if(!isset($aPost['calle_facturacion'])){
        $aPost['calle_facturacion'] = '';
    }      

    if(!isset($aPost['numero_facturacion'])){
        $aPost['numero_facturacion'] = '';
    }      
    
    if(!isset($aPost['cp_facturacion'])){
        $aPost['cp_facturacion'] = '';
    }      
    
    if(!isset($aPost['colonia_facturacion'])){
        $aPost['colonia_facturacion'] = '';
    }      
    
    
    if( salvar_facturacion($aPost)){        
        go_to('medicos', $buscar);
    } else {        

        $datos = array();
        $datos['medico'] = $aPost;
        $datos['buscar'] = $buscar;
    
        return load_template(CONTROLLER . DS . "_facturacionForm.php", $datos);
    }
}


function medicos_sitio( ) {

    if (!hasPermission('medicos_editar')) {
        go_to('acceso/denegado');
    }

    set_header(array(
        'section' => 'Medicos',
        'libraries' => array('Jquery','JCalendar','ckeditor')
    ));

    $aGet = http_get_request();
    
    $buscar = array();
    $buscar['p'] = $aGet['p'];   
    
    if(!empty($prevData)){
        $medico = $prevData;
    } else {
        $medico = medicos_read($aGet['id']);
    }
        
    
    $datos = array();
    $datos['medico'] = $medico;
    $datos['buscar'] = $buscar;
        
    set_header(array('section' => sprintf('Edici&oacute;n del medico "%s"', $medico['nombre'] . ' ' . $medico['apellidos'] )));

    if (!empty($medico)) {
        return load_template(CONTROLLER . DS . "_sitioForm.php", $datos);
    } else {
        go_to('medicos', $buscar);
    }
}


function medicos_aplicarSitio() {

    if (!hasPermission('medicos_nuevo')) {
        go_to('acceso/denegado');
    }

    defined('BR') or define('BR', '<br />');    
        
    set_header(array(
        'section' => 'Nuevo Medico',
        'libraries' => array('Jquery','JCalendar','ckeditor')
    ));

    $aPost = http_post_request();

    $buscar = array();
    $buscar['p'] = $aPost['p'];  
    
    $datos = array();
    $datos['medico'] = $aPost;
    $datos['buscar'] = $buscar;
        
    if(empty($aPost['fecha_inicio']))
        {    
            set_flash('Falta fecha de inicio', 'warning');
            return load_template(CONTROLLER . DS . "_sitioForm.php", $datos);
        }
        
    if(empty($aPost['fecha_fin']))
        {            
            set_flash('Falta fecha final', 'warning');
            return load_template(CONTROLLER . DS . "_sitioForm.php", $datos);
        } 
        
    $fecha_inicio = strtotime($aPost['fecha_inicio']);
    $fecha_fin = strtotime($aPost['fecha_fin']);
    
    
    if($fecha_inicio > $fecha_fin){
        set_flash('La fecha de inicio no puede ser mayor.', 'warning');
        return load_template(CONTROLLER . DS . "_sitioForm.php", $datos);
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
                
                //REDIMENSIONAR
                        $path = APP_PATH . DS . "uploads" . DS . "images" . DS;                       
                            
                        $x=400;
                        $y=375;
                        
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
    
    //Cargando nuevo banner y eliminando la anterior si es que existe
        if( $_FILES['Banner']['error'] === UPLOAD_ERR_OK)
        {    

            if(isset($aPost['banner']))
            {  
                $borra_imagen_servidor = borrar_archivo_servidor($aPost['banner']);                                                 
            }

            $carga_al_servidor = subir_al_servidor($_FILES["Banner"]);

            if ($carga_al_servidor) 
            {
                
                //REDIMENSIONAR
                        $path = APP_PATH . DS . "uploads" . DS . "images" . DS;                       
                            
                        $x=400;
                        $y=375;
                        
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
                
                $aPost['banner'] = $carga_al_servidor;
            }

        }            
        
    if(!isset($aPost['imagen'])){
        $aPost['imagen'] = '';
    }      

    if(!isset($aPost['banner'])){
        $aPost['banner'] = '';
    }      

    if(!isset($aPost['url'])){
        $aPost['url'] = '';
    }      
    
    if(!isset($aPost['descripcion'])){
        $aPost['descripcion'] = '';
    }   
    
    if(!isset($aPost['facebook'])){
        $aPost['facebook'] = '';
    }      

    if(!isset($aPost['twitter'])){
        $aPost['twitter'] = '';
    }      

    if(!isset($aPost['skype'])){
        $aPost['skype'] = '';
    }      
    
    if(!isset($aPost['sitio_web'])){
        $aPost['sitio_web'] = '';
    }      
    
    if(!isset($aPost['mapa'])){
        $aPost['mapa'] = '';
    }      
    
    if(!isset($aPost['pagado'])){
        $aPost['pagado'] = '0';
    }   
    else
    {
        $aPost['pagado'] = '1';
    }

    
    
    if( salvar_sitio($aPost)){        
        go_to('medicos', $buscar);
    } else {            
        return load_template(CONTROLLER . DS . "_sitioForm.php", $datos);
    }
}



function medicos_exportar()
{
    
    $medicos = cargar_medicos_exportar();  
  
    
    if(!empty($medicos))
    {
        
        require_once LIBRARY_PATH .  '/phpexcel/PHPExcel.php';
        $objPHPExcel = new PHPExcel();
   
        //Informacion del excel
        $objPHPExcel->
         getProperties()
             ->setCreator("TuMedicoLaguna")
             ->setLastModifiedBy("TuMedicoLaguna")
             ->setTitle("Medicos")
             ->setSubject("Medicos");

                
        $renglon= 1;                
        $i="A";
            
         $objPHPExcel->setActiveSheetIndex(0)->setCellValue($i.$renglon, "NOMBRE");                      
         $i++;
         $objPHPExcel->setActiveSheetIndex(0)->setCellValue($i.$renglon, "APELLIDOS");                      
         $i++;
         $objPHPExcel->setActiveSheetIndex(0)->setCellValue($i.$renglon, "TELÉFONO");                      
         $i++;
         $objPHPExcel->setActiveSheetIndex(0)->setCellValue($i.$renglon, "CORREO");                      
         $i++;
         $objPHPExcel->setActiveSheetIndex(0)->setCellValue($i.$renglon, "ESPECIALIDAD");                      
         $i++;
         $objPHPExcel->setActiveSheetIndex(0)->setCellValue($i.$renglon, "CALLE");                      
         $i++;
         $objPHPExcel->setActiveSheetIndex(0)->setCellValue($i.$renglon, "NUMERO");                      
         $i++;
         $objPHPExcel->setActiveSheetIndex(0)->setCellValue($i.$renglon, "COLONIA");                      
         $i++;
         $objPHPExcel->setActiveSheetIndex(0)->setCellValue($i.$renglon, "CP");                      
         $i++;
         $objPHPExcel->setActiveSheetIndex(0)->setCellValue($i.$renglon, "ESTADO");                      
         $i++;
         $objPHPExcel->setActiveSheetIndex(0)->setCellValue($i.$renglon, "MUNICIPIO");                      
         $i++;

         $renglon = 2;
         
        //Datos
        foreach ($medicos as $key=>$medico)
        {
            
                $i="A";
            
                 $objPHPExcel->setActiveSheetIndex(0)->setCellValue($i.$renglon, $medico['nombre']);                      
                 $i++;
                 
                 $objPHPExcel->setActiveSheetIndex(0)->setCellValue($i.$renglon, $medico['apellidos']);                      
                 $i++;

                 $objPHPExcel->setActiveSheetIndex(0)->setCellValue($i.$renglon, $medico['telefono']);                      
                 $i++;
                 
                 $objPHPExcel->setActiveSheetIndex(0)->setCellValue($i.$renglon, $medico['correo_contacto']);                      
                 $i++;                 
                 
                 $objPHPExcel->setActiveSheetIndex(0)->setCellValue($i.$renglon, $medico['especialidad']);                      
                 $i++;                 

                 $objPHPExcel->setActiveSheetIndex(0)->setCellValue($i.$renglon, $medico['calle_contacto']);                      
                 $i++;                 

                 $objPHPExcel->setActiveSheetIndex(0)->setCellValue($i.$renglon, $medico['numero_contacto']);                      
                 $i++;                 
                 
                 $objPHPExcel->setActiveSheetIndex(0)->setCellValue($i.$renglon, $medico['colonia_contacto']);                      
                 $i++;                 

                 $objPHPExcel->setActiveSheetIndex(0)->setCellValue($i.$renglon, $medico['cp_contacto']);                      
                 $i++;                 
                 
                 $objPHPExcel->setActiveSheetIndex(0)->setCellValue($i.$renglon, $medico['estado']);                      
                 $i++;                 

                 $objPHPExcel->setActiveSheetIndex(0)->setCellValue($i.$renglon, $medico['municipio']);                      
                 $i++;                 
                 
                 
                 
                 $renglon++;
                
        }        

        //Cabeceras
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="medicos.xls"');
        header('Cache-Control: max-age=0');

        $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
        $objWriter->save('php://output');        
        exit;
        

    }
    
}


?>