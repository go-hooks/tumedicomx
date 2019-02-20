<?php

function catalogos_medicos_read($id) {
    $sSql = 'SELECT * FROM '
            . ' catalogos_medicos c'
            . ' WHERE'
            . ' c.id = :cid';

    $oConnection = db_connect();

    if (!$oConnection) {
        return false;
    }
    mysql_bind($sSql, array('cid' => $id));
    $result = mysql_query($sSql, $oConnection);

    if (mysql_num_rows($result) > 0) {
        return mysql_fetch_array($result, MYSQL_ASSOC);
    } else {
        return false;
    }
}

function buscar_catalogo_medico($buscar) {
    
    if ($buscar['buscar']!=''){   

    $sSql = 'SELECT '
            . ' c.id,'
            . ' c.nombre '
            . 'FROM '
            . ' catalogos_medicos c '
            . 'WHERE '
            . ' elim=0 AND '                    
            . 'nombre like "%' . $buscar['buscar'] . '%"' 
            . 'ORDER BY c.nombre';
    
    }     
    else{
    $sSql = 'SELECT '
            . ' c.id,'
            . ' c.nombre '
            . 'FROM '
            . ' catalogos_medicos c '
            . 'WHERE '
            . ' elim=0 '            
            . 'ORDER BY c.nombre';
    }     
    
    
    return  db_paginate($sSql, array('limit' => 30));      
    
   
}

function get_last_catalogo_medico($cantidad = 1000) {
    $sSql = 'SELECT '
            . ' c.id,'
            . ' c.nombre '
            . 'FROM '
            . ' catalogos_medicos c '
            . 'WHERE '
            . ' elim=0 '            
            . 'ORDER BY c.nombre';

	$data = db_paginate($sSql, array('limit' => 30));

   if(!$data){
   		set_flash('<strong>¡No hay catalogos aun!</strong> <br />Talvez quieras agregar algunos cuantos...', 'info');
   }
   
   return $data;
}


function salvar_catalogo_medico($aData) {
    
    if (isset($aData['id'])) {
        $sSql = "UPDATE catalogos_medicos SET "
                . "`nombre` = :nombre "
                . "WHERE id =" . $aData['id'];
        $exit = "Catalogo exitosamente <strong>actualizado</strong>";
    } else {
        $sSql = "INSERT INTO catalogos_medicos ("
                . " nombre) "
                . "VALUES ("
                . ":nombre);";
        $exit = "Catalogo exitosamente <strong>creado</strong>";
    }

    $required = array(
        'nombre' => $aData['nombre']
    );
    
    
    if (in_array('', $required)) {
        set_flash('El nombre no puede estar vacío', 'warning');
        return false;
    }   
    
    mysql_bind($sSql, array(
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

function cargar_catalogo_medico( ) {
    
    $sSql = 'SELECT '
            . ' c.id,'
            . ' c.nombre '
            . 'FROM '
            . ' catalogos_medicos c '
            . 'WHERE '
            . ' elim=0 '            
            . 'ORDER BY c.nombre';


    return db_fetch($sSql);
}


