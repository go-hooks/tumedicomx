<?php

if(isset($_GET['funcion']))
{
    
if($_GET['funcion']=='municipios') municipios();
if($_GET['funcion']=='hospitales') hospitales();

    
}


function municipios()
{
    if (!isset($_GET['estado'])){        
        echo '0';        
    }         
     
    $estado =  $_GET['estado'];
    
    //echo $estado;    
    //$datos = array();     
    
    require_once(dirname(__FILE__) . "/ini.php");           
        
    
    $where = "elim = 0"
            . " AND estado_id =". $estado;
    $datos = get_all_actived_inactived('municipios', $where, 'municipio');               
    header('Content-type: application/json');
    echo json_encode($datos);
  
}   

function hospitales()
{
    if (!isset($_GET['categoria'])){        
        echo '0';        
    }         
     
    $categoria=  $_GET['categoria'];
    
    
    require_once(dirname(__FILE__) . "/ini.php");           
        
    $where = "elim = 0"
            . " AND padre_id = ". $categoria;
    $datos = get_all_actived_inactived('catalogos_hospitales', $where, 'nombre');   
    
    
    header('Content-type: application/json');
    echo json_encode($datos);
  
}   

?>
    
