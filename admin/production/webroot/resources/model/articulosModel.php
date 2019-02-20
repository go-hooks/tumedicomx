<?php

function articulos_read($id) {
    $sSql = 'SELECT * FROM '
            . ' articulos c'
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

function buscar_articulos($buscar) {
    
    
    $sSql = 'SELECT '
            . ' * '
            . ' FROM '
            . ' articulos a '
            . ' WHERE elim=0';
    
    
    if($buscar['categoria_id']!= '')
    {
        
    $sSql .= ' AND '
            . ' categoria_id = ' . $buscar['categoria_id'];
    
    }
    
    if($buscar['buscar']!= '')
    {
        
    $sSql .= ' AND '
            . ' ('                    
            . ' titulo like "%' . $buscar['buscar'] . '%"'
            . ' OR'
            . ' autor like "%' . $buscar['buscar'] . '%"'
            . ' )';
    }    

    $sSql .=  ' ORDER BY a.categoria_id, a.titulo, a.fecha DESC';    

    return  db_paginate($sSql, array('limit' => 30));      
    
   
}


function salvar_articulos($aData) {

    $required = array(
        'categoria_id' => $aData['categoria_id'],
        'fecha' => $aData['fecha'],
        'autor' => $aData['autor'],
        'correo' => $aData['correo'],
        'titulo' => $aData['titulo'],
    );
    
    
    if (in_array('', $required)) {
        set_flash('Faltan Datos', 'warning');
        return false;
    }   
    
    
    if (isset($aData['id'])) {
        $sSql = "UPDATE articulos SET "
                . "`categoria_id` = :categoria_id, "
                . "`fecha` = :fecha, "
                . "`autor` = :autor, "
                . "`correo` = :correo, "
                . "`titulo` = :titulo, "
                . "`imagen` = :imagen, "
                . "`video` = :video, "
                . "`texto_video` = :texto_video, "
                . "`texto` = :texto, "                
                . "`autorizado` = :auth, " 
                . "`palabras_clave` = :palabras_clave "
                . "WHERE id =" . $aData['id'];
        $exit = "Articulo exitosamente <strong>actualizado</strong>";
    } else {
        $sSql = "INSERT INTO articulos ("
                . " categoria_id, "
                . " fecha, "
                . " autor, "
                . " correo, "
                . " titulo, "
                . " imagen, "
                . " video, "
                . " texto_video, "                
                . " texto, "
                . " autorizado, "
                . " palabras_clave) "
                . "VALUES ("
                . ":categoria_id,"
                . ":fecha,"
                . ":autor,"
                . ":correo,"
                . ":titulo,"
                . ":imagen,"
                . ":video,"
                . ":texto_video,"
                . ":texto,"
                . ":auth, "
                . ":palabras_clave);";
        $exit = "Articulo exitosamente <strong>creado</strong>";
    }

    
    mysql_bind($sSql, array(
        'categoria_id' => $aData['categoria_id'],
        'fecha' => $aData['fecha'],
        'autor' => $aData['autor'],
        'correo' => $aData['correo'],
        'titulo' => $aData['titulo'],
        'imagen' => $aData['imagen'], 
        'video' => $aData['video'], 
        'texto_video' => $aData['texto_video'], 
        'texto' => $aData['texto'], 
        'auth' => $aData['autorizado'], 
        'palabras_clave' => $aData['palabras_clave'], 
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

function cargar_articulos( ) {
    $sSql = 'SELECT '
            . ' c.id,'
            . ' c.nombre, '
            . ' c.color, '            
            . ' c.imagen '
            . 'FROM '
            . ' articulos c '
            . ' WHERE elim=0 '                       
            . 'ORDER BY c.nombre';


    return db_fetch($sSql);
}


function cargar_comentarios($id) {
    
    
    $sSql = 'SELECT '
            . ' * '
            . ' FROM '
            . ' comentarios c '
            . ' WHERE '
            . ' articulo_id = ' . $id                       
            . ' ORDER BY c.fecha DESC';


    return db_fetch($sSql);
}