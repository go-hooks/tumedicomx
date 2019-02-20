<?php

function categorias_read($id) {
    $sSql = 'SELECT * FROM '
            . ' categorias c'
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

function buscar_categorias($buscar) {
    
    if ($buscar['buscar']!=''){   

    $sSql = 'SELECT '
            . ' c.id,'
            . ' c.nombre, '
            . ' c.color, '
            . ' c.mostrar, '
            . ' c.imagen '
            . 'FROM '
            . ' categorias c '
            . 'WHERE '
            . ' elim=0 AND '                    
            . 'nombre like "%' . $buscar['buscar'] . '%"' 
            . 'ORDER BY c.nombre';
    
    }     
    else{
    $sSql = 'SELECT '
            . ' c.id,'
            . ' c.nombre, '
            . ' c.color, '            
            . ' c.mostrar, '            
            . ' c.imagen '
            . 'FROM '
            . ' categorias c '
            . ' WHERE elim=0 '                       
            . 'ORDER BY c.nombre';
    }     
    
    
    return  db_paginate($sSql, array('limit' => 30));      
    
   
}


function salvar_categorias($aData) {

    $required = array(
        'nombre' => $aData['nombre'],
        'imagen' => $aData['imagen'],
        'color' => $aData['color'],
        'mostrar' => $aData['mostrar'],
        
    );
    
    
    if (in_array('', $required)) {
        set_flash('Faltan Datos', 'warning');
        return false;
    }   
    
    
    if (isset($aData['id'])) {
        $sSql = "UPDATE categorias SET "
                . "`imagen` = :imagen, "
                . "`color` = :color, "
                . "`mostrar` = :mostrar, "
                . "`nombre` = :nombre "
                . "WHERE id =" . $aData['id'];
        $exit = "Catalogo exitosamente <strong>actualizado</strong>";
    } else {
        $sSql = "INSERT INTO categorias ("
                . " imagen, "
                . " color, "
                . " mostrar, "
                . " nombre) "
                . "VALUES ("
                . ":imagen,"
                . ":color,"
                . ":mostrar,"
                . ":nombre);";
        $exit = "Catalogo exitosamente <strong>creado</strong>";
    }

    
    mysql_bind($sSql, array(
        'imagen' => $aData['imagen'],
        'nombre' => $aData['nombre'],
        'color' => $aData['color'],
        'mostrar' => $aData['mostrar'],
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

function cargar_categorias( ) {
    $sSql = 'SELECT '
            . ' c.id,'
            . ' c.nombre, '
            . ' c.color, '            
            . ' c.mostrar, ' 
            . ' c.imagen '
            . 'FROM '
            . ' categorias c '
            . ' WHERE elim=0 '                       
            . 'ORDER BY c.nombre';


    return db_fetch($sSql);
}

