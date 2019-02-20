<?php

function municipios_read($id) {
    $sSql = 'SELECT * FROM '
            . ' municipios m'
            . ' WHERE'
            . ' m.id = :mid';

    $oConnection = db_connect();

    if (!$oConnection) {
        return false;
    }
    mysql_bind($sSql, array('mid' => $id));
    $result = mysql_query($sSql, $oConnection);

    if (mysql_num_rows($result) > 0) {
        return mysql_fetch_array($result, MYSQL_ASSOC);
    } else {
        return false;
    }
}

function buscar_municipio($buscar) {
    
    if ($buscar['buscar']!=''){   

    $sSql = 'SELECT '
            . ' m.id,'
            . ' m.municipio, '
            . ' m.estado_id '
            . 'FROM '
            . ' municipios m '
            . 'WHERE '
            . ' elim=0 AND '                    
            . 'municipio like "%' . $buscar['buscar'] . '%"' 
            . 'ORDER BY m.estado_id, m.municipio';
    
    }     
    else{
    $sSql = 'SELECT '
            . ' m.id,'
            . ' m.municipio, '
            . ' m.estado_id '
            . 'FROM '
            . ' municipios m '
            . ' WHERE elim=0 '                       
            . 'ORDER BY m.estado_id, m.municipio';
    }     
    
    
    return  db_paginate($sSql, array('limit' => 30));      
    
   
}

function get_last_municipio($cantidad = 1000) {
    $sSql = 'SELECT '
            . ' m.id,'
            . ' m.municipio, '
            . ' m.estado_id '
            . 'FROM '
            . ' municipios m '
            . ' WHERE elim=0 '                       
            . 'ORDER BY m.estado_id, m.municipio';
    
	$data = db_paginate($sSql, array('limit' => 30));

   if(!$data){
   		set_flash('<strong>¡No hay municipios aun!</strong> <br />Talvez quieras agregar algunos cuantos...', 'info');
   }
   
   return $data;
}


function salvar_municipio($aData) {
    
    if (isset($aData['id'])) {
        $sSql = "UPDATE municipios SET "
                . "`municipio` = :municipio, "
                . "`estado_id` = :estado_id "
                . "WHERE id =" . $aData['id'];
        $exit = "Municipio exitosamente <strong>actualizado</strong>";
    } else {
        $sSql = "INSERT INTO municipios ("
                . " estado_id, "
                . " municipio) "
                . "VALUES ("
                . ":estado_id,"
                . ":municipio);";
        $exit = "Municipio exitosamente <strong>creado</strong>";
    }

    $required = array(
        'municipio' => $aData['municipio'],
        'estado_id' => $aData['estado_id']
    );
    
    
    if (in_array('', $required)) {
        set_flash('Faltan Datos', 'warning');
        return false;
    }   
    
    mysql_bind($sSql, array(
        'municipio' => $aData['municipio'],
        'estado_id' => $aData['estado_id']
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

function cargar_municipios( ) {
    $sSql = 'SELECT '
            . ' m.id,'
            . ' m.municipio, '
            . ' e.estado '
            . 'FROM '
            . ' municipios m '
            . ' INNER JOIN '
            . ' estados e '
            . 'ON m.estado_id = e.id '                              
            . 'ORDER BY e.estado, m.municipio';


    return db_fetch($sSql);
}


function estado_municipios($id) {
    
    $sSql = 'SELECT '
            . ' m.id,'
            . ' m.municipio '
            . 'FROM '
            . ' municipios m '
            . 'WHERE '
            . ' elim=0 AND m.estado_id=' . $id
            . ' ORDER BY municipio';


    return db_fetch($sSql);
}