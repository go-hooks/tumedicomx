<?php

function aseguradoras_read($id) {
    $sSql = 'SELECT * FROM '
            . ' aseguradoras a'
            . ' WHERE'
            . ' a.id = :aid';

    $oConnection = db_connect();

    if (!$oConnection) {
        return false;
    }
    mysql_bind($sSql, array('aid' => $id));
    $result = mysql_query($sSql, $oConnection);

    if (mysql_num_rows($result) > 0) {
        return mysql_fetch_array($result, MYSQL_ASSOC);
    } else {
        return false;
    }
}

function buscar_aseguradora($buscar) {
    
    if ($buscar['buscar']!=''){   

    $sSql = 'SELECT '
            . ' a.id,'
            . ' a.imagen,'
            . ' a.nombre '
            . 'FROM '
            . ' aseguradoras a '
            . 'WHERE '
            . ' elim=0 AND '                    
            . 'nombre like "%' . $buscar['buscar'] . '%"' 
            . 'ORDER BY a.nombre';
    
    }     
    else{
    $sSql = 'SELECT '
            . ' a.id,'
            . ' a.imagen,'
            . ' a.nombre '
            . 'FROM '
            . ' aseguradoras a '
            . 'WHERE '
            . ' elim=0 '            
            . 'ORDER BY a.nombre';
    }     
    
    
    return  db_paginate($sSql, array('limit' => 30));      
    
   
}

function get_last_aseguradora($cantidad = 1000) {
    $sSql = 'SELECT '
            . ' a.id,'
            . ' a.imagen,'
            . ' a.nombre '
            . 'FROM '
            . ' aseguradoras a '
            . 'WHERE '
            . ' elim=0 '            
            . 'ORDER BY a.nombre';

	$data = db_paginate($sSql, array('limit' => 30));

   if(!$data){
   		set_flash('<strong>¡No hay aseguradoras aun!</strong> <br />Talvez quieras agregar algunas cuantas...', 'info');
   }
   
   return $data;
}


function salvar_aseguradora($aData) {
    
    if (isset($aData['id'])) {
        $sSql = "UPDATE aseguradoras SET "
                . "`imagen` = :imagen, "
                . "`nombre` = :nombre "
                . "WHERE id =" . $aData['id'];
        $exit = "Aseguradora exitosamente <strong>actualizada</strong>";
    } else {
        $sSql = "INSERT INTO aseguradoras ("
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

function cargar_aseguradoras( ) {
    
    $sSql = 'SELECT '
            . ' a.id,'
            . ' a.imagen,'
            . ' a.nombre '
            . 'FROM '
            . ' aseguradoras a '
            . 'WHERE '
            . ' elim=0 '            
            . 'ORDER BY a.nombre';


    return db_fetch($sSql);
}


