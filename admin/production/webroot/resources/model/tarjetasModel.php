<?php

function tarjetas_read($id) {
    $sSql = 'SELECT * FROM '
            . ' tarjetas t'
            . ' WHERE'
            . ' t.id = :tid';

    $oConnection = db_connect();

    if (!$oConnection) {
        return false;
    }
    mysql_bind($sSql, array('tid' => $id));
    $result = mysql_query($sSql, $oConnection);

    if (mysql_num_rows($result) > 0) {
        return mysql_fetch_array($result, MYSQL_ASSOC);
    } else {
        return false;
    }
}

function buscar_tarjeta($buscar) {
    
    if ($buscar['buscar']!=''){   

    $sSql = 'SELECT '
            . ' t.id,'
            . ' t.imagen,'
            . ' t.nombre '
            . 'FROM '
            . ' tarjetas t '
            . 'WHERE '
            . ' elim=0 AND '                    
            . 'nombre like "%' . $buscar['buscar'] . '%"' 
            . 'ORDER BY t.nombre';
    
    }     
    else{
    $sSql = 'SELECT '
            . ' t.id,'
            . ' t.imagen,'
            . ' t.nombre '
            . 'FROM '
            . ' tarjetas t '
            . 'WHERE '
            . ' elim=0 '            
            . 'ORDER BY t.nombre';
    }     
    
    
    return  db_paginate($sSql, array('limit' => 30));      
    
   
}

function get_last_tarjeta($cantidad = 1000) {
    $sSql = 'SELECT '
            . ' t.id,'
            . ' t.imagen,'
            . ' t.nombre '
            . 'FROM '
            . ' tarjetas t '
            . 'WHERE '
            . ' elim=0 '            
            . 'ORDER BY t.nombre';

	$data = db_paginate($sSql, array('limit' => 30));

   if(!$data){
   		set_flash('<strong>¡No hay tarjetas aun!</strong> <br />Talvez quieras agregar algunas cuantas...', 'info');
   }
   
   return $data;
}


function salvar_tarjeta($aData) {
    
    if (isset($aData['id'])) {
        $sSql = "UPDATE tarjetas SET "
                . "`imagen` = :imagen, "
                . "`nombre` = :nombre "
                . "WHERE id =" . $aData['id'];
        $exit = "Aseguradora exitosamente <strong>actualizada</strong>";
    } else {
        $sSql = "INSERT INTO tarjetas ("
                . " imagen, "
                . " nombre) "
                . "VALUES ("
                . ":imagen, "
                . ":nombre);";
        $exit = "Aseguradora exitosamente <strong>creada</strong>";
    }

    $required = array(
        'nombre' => $aData['nombre']
    );
    
    
    if (in_array('', $required)) {
        set_flash('El nombre no puede estar vacío', 'warning');
        return false;
    }   
    
    mysql_bind($sSql, array(
        'imagen' => $aData['imagen'],
        'nombre' => $aData['nombre']
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

function cargar_tarjetas( ) {
    
    $sSql = 'SELECT '
            . ' t.id,'
            . ' t.imagen,'
            . ' t.nombre '
            . 'FROM '
            . ' tarjetas t '
            . 'WHERE '
            . ' elim=0 '            
            . 'ORDER BY t.nombre';

    return db_fetch($sSql);
}


