<?php

function estados_read($id) {
    $sSql = 'SELECT * FROM '
            . ' estados e'
            . ' WHERE'
            . ' e.id = :eid';

    $oConnection = db_connect();

    if (!$oConnection) {
        return false;
    }
    mysql_bind($sSql, array('eid' => $id));
    $result = mysql_query($sSql, $oConnection);

    if (mysql_num_rows($result) > 0) {
        return mysql_fetch_array($result, MYSQL_ASSOC);
    } else {
        return false;
    }
}

function buscar_estado($buscar) {
    
    if ($buscar['buscar']!=''){   

    $sSql = 'SELECT '
            . ' e.id,'
            . ' e.estado '
            . 'FROM '
            . ' estados e '
            . 'WHERE '
            . ' elim=0 AND '                    
            . 'estado like "%' . $buscar['buscar'] . '%"' 
            . 'ORDER BY e.estado';
    
    }     
    else{
    $sSql = 'SELECT '
            . ' e.id,'
            . ' e.estado '
            . 'FROM '
            . ' estados e '
            . 'WHERE '
            . ' elim=0 '            
            . 'ORDER BY e.estado';
    }     
    
    
    return  db_paginate($sSql, array('limit' => 30));      
    
   
}


function get_last_estado($cantidad = 1000) {
    $sSql = 'SELECT '
            . ' e.id,'
            . ' e.estado '
            . 'FROM '
            . ' estados e '
            . 'WHERE '
            . ' elim=0 '            
            . 'ORDER BY e.estado';

	$data = db_paginate($sSql, array('limit' => 30));

   if(!$data){
   		set_flash('<strong>¡No hay estados aun!</strong> <br />Talvez quieras agregar algunos cuantos...', 'info');
   }
   
   return $data;
}


function salvar_estado($aData) {
    
    if (isset($aData['id'])) {
        $sSql = "UPDATE estados SET "
                . "`estado` = :estado "
                . "WHERE id =" . $aData['id'];
        $exit = "Estado exitosamente <strong>actualizado</strong>";
    } else {
        $sSql = "INSERT INTO estados ("
                . " estado) "
                . "VALUES ("
                . ":estado);";
        $exit = "Estado exitosamente <strong>creado</strong>";
    }

    $required = array(
        'estado' => $aData['estado']
    );
    
    
    if (in_array('', $required)) {
        set_flash('El estado no puede estar vacío', 'warning');
        return false;
    }   
    
    mysql_bind($sSql, array(
        'estado' => $aData['estado']
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

function cargar_estados( ) {
    
    $sSql = 'SELECT '
            . ' e.id,'
            . ' e.estado '
            . 'FROM '
            . ' estados e '
            . 'WHERE '
            . ' elim=0 '
            . 'ORDER BY estado';


    return db_fetch($sSql);
}



