<?php

defined('JZ_UPALE') or die('Acceso Incorrecto');
define('CONTROLLER', 'Suscripciones');


require_once MODEL_PATH . DS . 'suscripcionesModel.php';
require_once MODEL_PATH . DS . 'categoriasModel.php';

authenticar();

if (!hasPermission('acceso_suscripciones')) {
	
    go_to('acceso/denegado');
	
}

function suscripciones_delete(){
	
	$aGet = http_get_request();
        
	$return = db_eliminar_por_id('suscripciones', $aGet['id']);
	
	if($return) {
		set_flash('Eliminado exitoso', 'success');
	} else {
		set_flash('Ha ocurrido un error con el movimiento', 'success');
	}
        
        
        $buscar = array();
        $buscar['p'] = $aGet['p'];
        
	go_to('suscripciones',$buscar);
	
}

function suscripciones_default() {
    if (!hasPermission('suscripciones_nuevo')) {
        go_to('acceso/denegado');
    }
    return suscripciones_desktop();
}


function suscripciones_desktop($aExtData = array()) {
    
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
        
                
        $suscripciones = buscar_suscriptor($aGet);  
        
        
        
        $datos = array();
        $datos['suscripciones'] = $suscripciones;
        $datos['categorias'] = cargar_categorias();
        $datos['buscar'] = $aGet;    
             
        
	set_header(array('section' => 'Listado'));
        return load_template(CONTROLLER . DS . '_suscripcionesList.php', $datos);
}



function suscripciones_exportar()
{
    
    $suscripciones = cargar_suscriptores();  
   
        
    if(!empty($suscripciones))
    {
        
        require_once LIBRARY_PATH .  '/phpexcel/PHPExcel.php';
        $objPHPExcel = new PHPExcel();
   
        //Informacion del excel
        $objPHPExcel->
         getProperties()
             ->setCreator("TuMedicoLaguna")
             ->setLastModifiedBy("TuMedicoLaguna")
             ->setTitle("Suscriptores")
             ->setSubject("Suscriptores");

        
        $i="A";
        $renglon= 0;
        $categoria = "";
        
        //Datos
        foreach ($suscripciones as $key=>$suscripcion)
        {
           
           if($categoria != $suscripcion['categoria'])
           {
                $categoria = $suscripcion['categoria'];            
                
                if($key!=0)
                {
                    $i++;
                }
                
                $renglon = 1;
                
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue($i.$renglon, $suscripcion['categoria']);
           }                      
                      
           $renglon++;

                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue($i.$renglon, $suscripcion['correo']);
                
        }        

        //Cabeceras
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="suscriptores.xls"');
        header('Cache-Control: max-age=0');

        $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
        $objWriter->save('php://output');        
        exit;
        

    }
    
}

?>