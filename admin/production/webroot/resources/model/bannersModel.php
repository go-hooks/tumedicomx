<?php

function set_timmer($time){
    
    $oConnection = db_connect();

    if (!$oConnection) {
        return false;
    }
    
        $sSql = "DELETE FROM timmer WHERE 1";
        $result = @mysql_query($sSql, $oConnection);
        
    
        $sSql = "INSERT INTO timmer ("
                . " tiempo) "
                . "VALUES ("
                . $time . " );";    
       
    $exit = "Timmer <strong>actualizado</strong>";        

    $result = mysql_query($sSql, $oConnection);
    if ($result) {
        set_flash($exit, 'success');
        return true;
    }
    
        
}


function get_timmer(){
    
    $sSql = 'SELECT * FROM '
            . ' timmer t ';
    $oConnection = db_connect();

    if (!$oConnection) {
        return false;
    }

    $result = mysql_query($sSql, $oConnection);

    if (mysql_num_rows($result) > 0) {
        return mysql_fetch_array($result, MYSQL_ASSOC);
    } else {
        return false;
    }    
    
}


function banners_read($id) {
    $sSql = 'SELECT * FROM '
            . ' banners b '
            . 'WHERE '
            . ' b.id = :bid';

    $oConnection = db_connect();

    if (!$oConnection) {
        return false;
    }
    mysql_bind($sSql, array('bid' => $id));
    $result = mysql_query($sSql, $oConnection);

    if (mysql_num_rows($result) > 0) {
        return mysql_fetch_array($result, MYSQL_ASSOC);
    } else {
        return false;
    }
}

function buscar_banners($buscar) {
    
    if ($buscar['buscar']!=''){   

    $sSql = 'SELECT '
            . ' b.id,'
            . ' b.cliente,'
            . ' b.tipo,'
            . ' b.localizacion,'
            . ' b.fecha_inicio,'
            . ' b.fecha_fin,'
            . ' b.imagen, '
            . ' b.elim '
            . 'FROM '
            . ' banners b '
            . 'WHERE '                  
            . ' cliente like "%' . $buscar['buscar'] . '%" ' 
            . 'ORDER BY b.tipo, b.fecha_inicio, b.fecha_fin';
    
    }     
    else{
    $sSql = 'SELECT '
            . ' b.id,'
            . ' b.cliente,'
            . ' b.tipo,'
            . ' b.localizacion,'
            . ' b.fecha_inicio,'
            . ' b.fecha_fin,'
            . ' b.imagen, '
            . ' b.elim '
            . 'FROM '
            . ' banners b '
            . 'ORDER BY b.tipo, b.fecha_inicio, b.fecha_fin';
    }     
    
    
    return  db_paginate($sSql, array('limit' => 30));      
    
   
}

function get_last_banner($cantidad = 1000) {
    $sSql = 'SELECT '
            . ' b.id,'
            . ' b.cliente,'
            . ' b.tipo,'
            . ' b.localizacion,'
            . ' b.fecha_inicio,'
            . ' b.fecha_fin,'
            . ' b.imagen, '
            . ' b.elim '
            . 'FROM '
            . ' banners b '
            . 'ORDER BY b.tipo, b.fecha_inicio, b.fecha_fin';

	$data = db_paginate($sSql, array('limit' => 30));

   if(!$data){
   		set_flash('<strong>¡No hay banners aun!</strong> <br />Talvez quieras agregar algunos cuantos...', 'info');
   }
   
   return $data;
}

function salvar_banner($aData) {

    $required = array(
        'imagen' => $aData['imagen'],        
        'fecha_inicio' => $aData['fecha_inicio'],        
        'fecha_fin' => $aData['fecha_fin'],        
        'localizacion' => $aData['localizacion'], 
        'tipo' => $aData['tipo']       
    );

    if (in_array('', $required)) {
        set_flash('Faltan datos', 'warning');
        return false;
    }           
    
    if (isset($aData['id'])) {
        $sSql = "UPDATE banners SET "               
                . "`url` = :url, "
                . "`fecha_inicio` = :fecha_inicio, "
                . "`fecha_fin` = :fecha_fin, "
                . "`cliente` = :cliente, "
                . "`localizacion` = :localizacion, "
                . "`tipo` = :tipo, "
                . "`imagen` = :imagen "
                . "WHERE id =" . $aData['id'];
        $exit = "Imagen exitosamente <strong>actualizada</strong>";
    } else {
        $sSql = "INSERT INTO banners ("
                . " url, "
                . " fecha_inicio, "
                . " fecha_fin, "
                . " cliente, "
                . " localizacion, "
                . " tipo, "
                . " imagen) "
                . "VALUES ("
                . ":url, "
                . ":fecha_inicio, "
                . ":fecha_fin, "
                . ":cliente, "
                . ":localizacion, "
                . ":tipo, "
                . ":imagen);";
        $exit = "Imagen exitosamente <strong>creada</strong>";
    }


    mysql_bind($sSql, array(        
        'url' => $aData['url'],
        'cliente' => $aData['cliente'],
        'fecha_inicio' => $aData['fecha_inicio'],            
        'fecha_fin' => $aData['fecha_fin'],            
        'localizacion' => $aData['localizacion'],            
        'tipo' => $aData['tipo'],            
        'imagen' => $aData['imagen'],
    ));

    $oConnection = db_connect();

    if (!$oConnection) {
        return false;
    }

    $result = mysql_query($sSql, $oConnection);
    if ($result) {
        set_flash($exit, 'success');
        return true;
    }
}

function cargar_banners( ) {
    $sSql = 'SELECT '
            . ' b.id,'
            . ' b.cliente,'
            . ' b.tipo,'
            . ' b.localizacion,'
            . ' b.fecha_inicio,'
            . ' b.fecha_fin,'
            . ' b.imagen '
            . 'FROM '
            . ' banners b '
            . 'ORDER BY b.tipo, b.fecha_inicio, b.fecha_fin';

    return db_fetch($sSql);
}
