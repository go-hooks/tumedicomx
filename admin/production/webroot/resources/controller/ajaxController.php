<?php

defined('JZ_UPALE') or die('Acceso Incorrecto');

authenticar();


function ajax_municipios() {
    
    $aGet = http_get_request();
    
    if (!isset($aGet['estado'])){        
        echo '0';        
    }         
     
    $estado =  $aGet['estado'];
    
    require_once MODEL_PATH . DS . 'municipiosModel.php';

    $datos = array();    
    $datos= estado_municipios($estado); 
    
    header('Content-type: application/json');
    echo json_encode($datos);
        
    
}

function ajax_hospitalSubcategoria() {
    
    $aGet = http_get_request();
    
    if (!isset($aGet['categoria'])){        
        echo '0';        
    }         
     
    $categoria =  $aGet['categoria'];
    
    require_once MODEL_PATH . DS . 'catalogosHospitalesModel.php';

    $datos = array();    
    $datos= padre_subcategorias($categoria); 
    
    header('Content-type: application/json');
    echo json_encode($datos);
        
    
}