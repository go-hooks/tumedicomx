<?php

function suscripciones_read($id) {
    $sSql = 'SELECT * FROM '
            . ' suscripciones e'
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

function buscar_suscriptor($buscar) {
    
    
    $sSql = 'SELECT '
            . ' s.id,'
            . ' s.nombre,'
            . ' s.correo,'
            . ' c.nombre as categoria '
            . 'FROM '
            . ' suscripciones s '
            . ' INNER JOIN'
            . ' categorias c'
            . ' ON s.categoria_id = c.id'
            . ' WHERE 1 = 1';
    
    
    if($buscar['categoria_id']!= '')
    {
        
    $sSql .= ' AND '
            . ' categoria_id = ' . $buscar['categoria_id'];
    
    }
    
    if($buscar['buscar']!= '')
    {
        
    $sSql .= ' AND '
            . ' correo like "%' . $buscar['buscar'] . '%"';
    }    

    $sSql .=  ' ORDER BY s.categoria_id';    
    

    
    return  db_paginate($sSql, array('limit' => 30));      
    
   
}


function cargar_suscriptores() {
    

    $sSql = 'SELECT '
            . ' s.id,'
            . ' s.nombre,'
            . ' s.correo,'
            . ' c.nombre as categoria '
            . 'FROM '
            . ' suscripciones s '
            . ' INNER JOIN'
            . ' categorias c'
            . ' ON s.categoria_id = c.id'
            . ' ORDER BY s.categoria_id';
    
        
    return db_fetch($sSql);
   
}


