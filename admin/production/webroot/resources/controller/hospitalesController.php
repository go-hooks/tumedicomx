<?php

defined('JZ_UPALE') or die('Acceso Incorrecto');
define('CONTROLLER', 'Hospitales');


require_once MODEL_PATH . DS . 'hospitalesModel.php';
require_once MODEL_PATH . DS . 'estadosModel.php';
require_once MODEL_PATH . DS . 'municipiosModel.php';
require_once MODEL_PATH . DS . 'catalogosHospitalesModel.php';
require_once MODEL_PATH . DS . 'tarjetasModel.php';
require_once MODEL_PATH . DS . 'aseguradorasModel.php';
require_once LIBRARY_PATH . DS . 'thumbnail.php';

authenticar();

if (!hasPermission('acceso_hospitales')) {
	
    go_to('acceso/denegado');
	
}

function hospitales_delete(){
	
	$aGet = http_get_request();
        
	$return = db_eliminado_logico('registros', $aGet['id']);
	
	if($return) {
		set_flash('Eliminado exitoso', 'success');
	} else {
		set_flash('Ha ocurrido un error con el movimiento', 'success');
	}
        
        
        $buscar = array();
        $buscar['p'] = $aGet['p']; 
        
	go_to('hospitales', $buscar);
	
}

function hospitales_default() {
    if (!hasPermission('hospitales_nuevo')) {
        go_to('acceso/denegado');
    }
    return hospitales_desktop();
}

function hospitales_nuevo() {

    set_header(array(
                'section' => 'Nuevo Hospital',
                'javascript' => array('municipios.js','hospital_subcategorias.js')
                ));
        
    $buscar = array();
    $buscar['p'] = 1; 
    
    $datos = array();
    $datos['categorias'] = cargar_padres_catalogo_hospital();
    $datos['estados'] = cargar_estados();
    $datos['buscar'] = $buscar;
    
    return load_template(CONTROLLER . DS . "_hospitalesForm.php", $datos);
}

function hospitales_desktop($aExtData = array()) {
    
	$aGet = http_get_request();               
        
        if(!isset($aGet['p']))
        {
            $aGet['p'] = 1;
        }
        
        if(!isset($aGet['buscar']))
        {            
            $aGet['buscar']='';     
        }
        
        $hospitales = buscar_hospitales($aGet);  
        
        if(strtoupper($aGet['buscar'])=='PENDIENTE' || strtoupper($aGet['buscar'])=='AUTORIZADO'){
            
             $hospitales = buscar_hospitales_estatus($aGet); 
        }

        if(strtoupper($aGet['buscar'])=='INACTIVO' || strtoupper($aGet['buscar'])=='ACTIVO'){
            
            $hospitales = buscar_hospitales_sitio($aGet); 
            
        }
        
        
        $datos = array();
        $datos['hospitales'] = $hospitales;
        $datos['buscar'] = $aGet;      
        
        
	set_header(array('section' => 'Listado'));        
        return load_template(CONTROLLER . DS . '_hospitalesList.php',$datos);
}

function hospitales_aplicar() {

    if (!hasPermission('hospitales_nuevo')) {
        go_to('acceso/denegado');
    }

    defined('BR') or define('BR', '<br />');    
        
    set_header(array(
        'section' => 'Nuevo Hospital',
        'libraries' => array('Jquery'),
        'javascript' => array('municipios.js','hospital_subcategorias.js')
    ));

    $aPost = http_post_request();
    
    $buscar = array();
    $buscar['p'] = $aPost['p'];     

    $datos = array();
    $datos['hospital'] = $aPost;
    $datos['categorias'] = cargar_padres_catalogo_hospital();
    $datos['estados'] = cargar_estados();  
    $datos['buscar'] = $buscar; 
    
    if (!filter_var($aPost['correo_contacto'], FILTER_VALIDATE_EMAIL)) {
            set_flash('El correo es incorrecto', 'warning'); 
            return load_template(CONTROLLER . DS . "_hospitalesForm.php", $datos);
    }

     if(isset($aPost['id'])) {
         
            $aUser = hospitales_read($aPost['id']);
            
            if($aUser['correo']!=$aPost['correo'])
            {
                if(comprobar_correo($aPost['correo'])){
                        set_flash('El usuario ya ha sido registrado', 'warning'); 
                        return load_template(CONTROLLER . DS . "_hospitalesForm.php", $datos);                
                }              
            }
            
            if (!empty($aPost['password']) && !empty($aPost['confirm_password'])) {
                if ($aPost['password'] != $aPost['confirm_password']) {
                    set_flash('La contraseña y la confirmacion no coinciden', 'warning'); 
                    return load_template(CONTROLLER . DS . "_hospitalesForm.php", $datos);
                }
            } else {
                $aPost['password'] =  Encrypter::decrypt($aUser['password']);
            }                                 
     }
     else{

            if(comprobar_correo($aPost['correo'])){
                    set_flash('El usuario ya ha sido registrado', 'warning'); 
                    return load_template(CONTROLLER . DS . "_hospitalesForm.php", $datos);                
            }         
            if (empty($aPost['password'])) {
                    set_flash('La contraseña es obligatoria', 'warning'); 
                    return load_template(CONTROLLER . DS . "_hospitalesForm.php", $datos);
            }
            if (empty($aPost['confirm_password'])) {
                    set_flash('La confirmacion de la contraseña es obligatoria', 'warning'); 
                    return load_template(CONTROLLER . DS . "_hospitalesForm.php", $datos);
            }
            if ($aPost['password'] != $aPost['confirm_password']) {
                    set_flash('La contraseña y la confirmacion no coinciden', 'warning'); 
                    return load_template(CONTROLLER . DS . "_hospitalesForm.php", $datos);
            }         
         
     }
    
    if(!isset($aPost['horario'])){
        $aPost['horario'] = '';
    }    
    
    if(!isset($aPost['correo_contacto'])){
        $aPost['correo_contacto'] = '';
    }            
    
    if(!isset($aPost['subcategoria_id'])){
        $aPost['subcategoria_id'] = '';
    }      

    if(!isset($aPost['categoria_id'])){
        $aPost['categoria_id'] = '';
    }      

    if(!isset($aPost['estado_id'])){
        $aPost['estado_id'] = '';
    }    

    if(!isset($aPost['municipio_id'])){
        $aPost['municipio_id'] = '';
    }    
    
    if(!isset($aPost['fax_contacto'])){
        $aPost['fax_contacto'] = '';
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
    
    if(!isset($aPost['encuesta'])){
        $aPost['encuesta'] = '';
    }      

    
    if( salvar_hospital($aPost)){        
        go_to('hospitales', $buscar);
    } else {        
        return load_template(CONTROLLER . DS . "_hospitalesForm.php", $datos);
    }
}

function hospitales_editar( ) {

    if (!hasPermission('hospitales_editar')) {
        go_to('acceso/denegado');
    }

    set_header(array(
        'section' => 'Hospitales',
        'libraries' => array('Jquery'),
        'javascript' => array('municipios.js','hospital_subcategorias.js')
    ));

    $aGet = http_get_request();
    
    $buscar = array();
    $buscar['p'] = $aGet['p'];     
    
    if(!empty($prevData)){
        $hospital = $prevData;
    } else {
        $hospital = hospitales_read($aGet['id']);
    }
    
    
    
    $datos = array();
    $datos['hospital'] = $hospital;
    $datos['categorias'] = cargar_padres_catalogo_hospital();
    $datos['subcategorias'] = padre_subcategorias($hospital['categoria_id']);    
    $datos['estados'] = cargar_estados();   
    $datos['municipios'] = estado_municipios($hospital['estado_id']);   
    $datos['buscar'] = $buscar;
        
    set_header(array('section' => sprintf('Edici&oacute;n del hospital "%s"', $hospital['nombre'] )));

    if (!empty($hospital)) {
        return load_template(CONTROLLER . DS . "_hospitalesForm.php", $datos);
    } else {
        go_to('hospitales', $buscar);
    }
}

function hospitales_datos( ) {

    if (!hasPermission('hospitales_editar')) {
        go_to('acceso/denegado');
    }

    set_header(array(
        'section' => 'Hospitales',
        'libraries' => array('Jquery')
    ));

    $aGet = http_get_request();
    
    $buscar = array();
    $buscar['p'] = $aGet['p'];  
    
    $hospital = hospitales_read($aGet['id']);
    
    $datos = array();
    $datos['hospital'] = $hospital;
    $datos['aseguradoras'] = cargar_aseguradoras();
    $datos['tarjetas'] = cargar_tarjetas();
    
    $datos['hospital_aseguradoras'] = hospitales_aseguradoras($aGet['id']);    
    $datos['hospital_tarjetas'] = hospitales_tarjetas($aGet['id']);    
    $datos['buscar'] = $buscar;   
        
    set_header(array('section' => sprintf('Edici&oacute;n del hospital "%s"', $hospital['nombre'] )));

    if (!empty($hospital)) {
        return load_template(CONTROLLER . DS . "_datosForm.php", $datos);
    } else {
        go_to('hospitales', $buscar);
    }
}


function hospitales_agregarAseguradora() {

    if (!hasPermission('hospitales_nuevo')) {
        go_to('acceso/denegado');
    }

    defined('BR') or define('BR', '<br />');    
        
    set_header(array(
        'section' => 'Hospitales',
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
                
        $hospital = hospitales_read($aPost['registro_id']);
        
        $datos = array();
        $datos['hospital'] = $hospital;
        $datos['aseguradoras'] = cargar_aseguradoras();
        $datos['tarjetas'] = cargar_tarjetas();

        $datos['hospital_aseguradoras'] = hospitales_aseguradoras($aPost['registro_id']);    
        $datos['hospital_tarjetas'] = hospitales_tarjetas($aPost['registro_id']);   
        $datos['buscar'] = $buscar;
        
        set_header(array('section' => sprintf('Edici&oacute;n del hospital "%s"', $hospital['nombre'] )));
        return load_template(CONTROLLER . DS . "_datosForm.php", $datos);

}

function hospitales_agregarTarjeta() {

    if (!hasPermission('hospitales_nuevo')) {
        go_to('acceso/denegado');
    }

    defined('BR') or define('BR', '<br />');    
        
    set_header(array(
        'section' => 'Hospital',
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
                
        $hospital = hospitales_read($aPost['registro_id']);
        
        $datos = array();
        $datos['hospital'] = $hospital;
        $datos['aseguradoras'] = cargar_aseguradoras();
        $datos['tarjetas'] = cargar_tarjetas();

        $datos['hospital_aseguradoras'] = hospitales_aseguradoras($aPost['registro_id']);    
        $datos['hospital_tarjetas'] = hospitales_tarjetas($aPost['registro_id']);  
        $datos['buscar'] = $buscar;
        
        set_header(array('section' => sprintf('Edici&oacute;n del hospital "%s"', $hospital['nombre']  )));
        return load_template(CONTROLLER . DS . "_datosForm.php", $datos);

}


function hospitales_deleteAseguradora( ) {

    if (!hasPermission('hospitales_editar')) {
        go_to('acceso/denegado');
    }

    set_header(array(
        'section' => 'Hospitales',
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
        
        $hospital = hospitales_read($aGet['registro_id']);
        
        $datos = array();
        $datos['hospital'] = $hospital;
        $datos['aseguradoras'] = cargar_aseguradoras();
        $datos['tarjetas'] = cargar_tarjetas();

        $datos['hospital_aseguradoras'] = hospitales_aseguradoras($aGet['registro_id']);    
        $datos['hospital_tarjetas'] = hospitales_tarjetas($aGet['registro_id']);    
        $datos['buscar'] = $buscar;
        
        set_header(array('section' => sprintf('Edici&oacute;n del hospital "%s"', $hospital['nombre'] )));
        
        return load_template(CONTROLLER . DS . "_datosForm.php", $datos);
        
}


function hospitales_deleteTarjeta( ) {

    if (!hasPermission('hospitales_editar')) {
        go_to('acceso/denegado');
    }

    set_header(array(
        'section' => 'Hospitales',
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
        
        $hospital = hospitales_read($aGet['registro_id']);
        
        $datos = array();
        $datos['hospital'] = $hospital;
        $datos['aseguradoras'] = cargar_aseguradoras();
        $datos['tarjetas'] = cargar_tarjetas();

        $datos['hospital_aseguradoras'] = hospitales_aseguradoras($aGet['registro_id']);    
        $datos['hospital_tarjetas'] = hospitales_tarjetas($aGet['registro_id']); 
        $datos['buscar'] = $buscar;
        
        set_header(array('section' => sprintf('Edici&oacute;n del hospital "%s"', $hospital['nombre'] )));
        
        return load_template(CONTROLLER . DS . "_datosForm.php", $datos);
        
}




function hospitales_sitio( ) {

    if (!hasPermission('hospitales_editar')) {
        go_to('acceso/denegado');
    }

    set_header(array(
        'section' => 'Hospitales',
        'libraries' => array('Jquery','JCalendar','ckeditor')
    ));

    $aGet = http_get_request();
    
    $buscar = array();
    $buscar['p'] = $aGet['p'];      
    
    if(!empty($prevData)){
        $hospital = $prevData;
    } else {
        $hospital = hospitales_read($aGet['id']);
    }
        
    
    $datos = array();
    $datos['hospital'] = $hospital;
    $datos['buscar'] = $buscar;
        
    set_header(array('section' => sprintf('Edici&oacute;n del hospital "%s"', $hospital['nombre'] )));

    if (!empty($hospital)) {
        return load_template(CONTROLLER . DS . "_sitioForm.php", $datos);
    } else {
        go_to('hospitales', $buscar);
    }
}


function hospitales_aplicarSitio() {

    if (!hasPermission('hospitales_nuevo')) {
        go_to('acceso/denegado');
    }

    defined('BR') or define('BR', '<br />');    
        
    set_header(array(
        'section' => 'Nuevo Hospital',
        'libraries' => array('Jquery','JCalendar','ckeditor')
    ));

    $aPost = http_post_request();
    
    $buscar = array();
    $buscar['p'] = $aPost['p'];     

    $datos = array();
    $datos['hospital'] = $aPost;
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
        go_to('hospitales', $buscar);
    } else {            
        return load_template(CONTROLLER . DS . "_sitioForm.php", $datos);
    }
}

function hospitales_exportar()
{
    
    $hospitales = cargar_hospitales_exportar();  
  
    
    if(!empty($hospitales))
    {
        
        require_once LIBRARY_PATH .  '/phpexcel/PHPExcel.php';
        $objPHPExcel = new PHPExcel();
   
        //Informacion del excel
        $objPHPExcel->
         getProperties()
             ->setCreator("TuMedicoLaguna")
             ->setLastModifiedBy("TuMedicoLaguna")
             ->setTitle("Hospitales")
             ->setSubject("Hospitales");

                
        $renglon= 1;                
        $i="A";
            
         $objPHPExcel->setActiveSheetIndex(0)->setCellValue($i.$renglon, "NOMBRE");                      
         $i++;
         $objPHPExcel->setActiveSheetIndex(0)->setCellValue($i.$renglon, "REPRESENTANTE");                      
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
        foreach ($hospitales as $key=>$hospital)
        {
            
                $i="A";
            
                 $objPHPExcel->setActiveSheetIndex(0)->setCellValue($i.$renglon, $hospital['nombre']);                      
                 $i++;
                 
                 $objPHPExcel->setActiveSheetIndex(0)->setCellValue($i.$renglon, $hospital['representante']);                      
                 $i++;

                 $objPHPExcel->setActiveSheetIndex(0)->setCellValue($i.$renglon, $hospital['telefono']);                      
                 $i++;
                 
                 $objPHPExcel->setActiveSheetIndex(0)->setCellValue($i.$renglon, $hospital['correo_contacto']);                      
                 $i++;                 
                 
                 $objPHPExcel->setActiveSheetIndex(0)->setCellValue($i.$renglon, $hospital['especialidad']);                      
                 $i++;                 

                 $objPHPExcel->setActiveSheetIndex(0)->setCellValue($i.$renglon, $hospital['calle_contacto']);                      
                 $i++;                 

                 $objPHPExcel->setActiveSheetIndex(0)->setCellValue($i.$renglon, $hospital['numero_contacto']);                      
                 $i++;                 
                 
                 $objPHPExcel->setActiveSheetIndex(0)->setCellValue($i.$renglon, $hospital['colonia_contacto']);                      
                 $i++;                 

                 $objPHPExcel->setActiveSheetIndex(0)->setCellValue($i.$renglon, $hospital['cp_contacto']);                      
                 $i++;                 
                 
                 $objPHPExcel->setActiveSheetIndex(0)->setCellValue($i.$renglon, $hospital['estado']);                      
                 $i++;                 

                 $objPHPExcel->setActiveSheetIndex(0)->setCellValue($i.$renglon, $hospital['municipio']);                      
                 $i++;                 
                 
                 
                 
                 $renglon++;
                
        }        

        //Cabeceras
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="hospitales.xls"');
        header('Cache-Control: max-age=0');

        $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
        $objWriter->save('php://output');        
        exit;
        

    }
    
}


?>