<?php

function catalogos_hospitales_read($id) {
    $sSql = 'SELECT * FROM '
            . ' catalogos_hospitales c'
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

function buscar_catalogo_hospital($buscar) {
    
    if ($buscar['buscar']!=''){   

    $sSql = 'SELECT '
            . ' c.id,'
            . ' c.nombre, '
            . ' c.imagen, '
            . ' c.padre_id '
            . 'FROM '
            . ' catalogos_hospitales c '
            . 'WHERE '
            . ' elim=0 AND '                    
            . 'nombre like "%' . $buscar['buscar'] . '%"' 
            . 'ORDER BY c.nombre';
    
    }     
    else{
    $sSql = 'SELECT '
            . ' c.id,'
            . ' c.nombre, '
            . ' c.imagen, '
            . ' c.padre_id '
            . 'FROM '
            . ' catalogos_hospitales c '
            . ' WHERE elim=0 '                       
            . 'ORDER BY c.nombre';
    }     
    
    
    return  db_paginate($sSql, array('limit' => 30));      
    
   
}

function get_last_catalogo_hospital($cantidad = 1000) {
    
    $sSql = 'SELECT '
            . ' c.id,'
            . ' c.nombre, '
            . ' c.imagen, '
            . ' c.padre_id '
            . 'FROM '
            . ' catalogos_hospitales c '
            . ' WHERE elim=0 '                       
            . 'ORDER BY c.nombre';

	$data = db_paginate($sSql, array('limit' => 30));

   if(!$data){
   		set_flash('<strong>¡No hay catalogos aun!</strong> <br />Talvez quieras agregar algunos cuantos...', 'info');
   }
   
   return $data;
}


function salvar_catalogo_hospital($aData) {

    $required = array(
        'nombre' => $aData['nombre']
    );
    
    
    if (in_array('', $required)) {
        set_flash('El nombre no puede estar vacio.', 'warning');
        return false;
    }   

    if (isset($aData['id']) && isset($aData['padre_id'])) {    
        if ($aData['id'] == $aData['padre_id']){
            set_flash('El catalogo no puede ser el mismo.', 'warning');
            return false;            
        }        
    }
    
    if (isset($aData['padre_id'])) {    
        
        $padre = catalogos_hospitales_read($aData['padre_id']);
        
        if ($padre['padre_id']){
            set_flash('El catalogo no puede ser un subcatalogo.', 'warning');
            return false;            
        }        
    }

    
    if (isset($aData['id'])) {
        $sSql = "UPDATE catalogos_hospitales SET "
                . "`imagen` = :imagen, "
                . "`nombre` = :nombre, "
                . "`padre_id` = :padre_id "
                . "WHERE id =" . $aData['id'];
        $exit = "Catalogo exitosamente <strong>actualizado</strong>";
    } else {
        $sSql = "INSERT INTO catalogos_hospitales ("
                . " imagen, "
                . " padre_id, "
                . " nombre) "
                . "VALUES ("
                . ":imagen,"
                . ":padre_id,"
                . ":nombre);";
        $exit = "Catalogo exitosamente <strong>creado</strong>";
    }

    
    mysql_bind($sSql, array(
        'imagen' => $aData['imagen'],
        'nombre' => $aData['nombre'],
        'padre_id' => (int)$aData['padre_id']
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

function cargar_catalogo_hospital( ) {
    
    $sSql = 'SELECT '
            . ' c.id,'
            . ' c.nombre, '
            . ' c.imagen, '
            . ' c.padre_id '
            . 'FROM '
            . ' catalogos_hospitales c '
            . ' WHERE elim=0 '                     
            . 'ORDER BY c.nombre';


    return db_fetch($sSql);
}


function cargar_padres_catalogo_hospital( ) {
    
    $sSql = 'SELECT '
            . ' c.id,'
            . ' c.nombre, '
            . ' c.imagen, '            
            . ' c.padre_id '
            . 'FROM '
            . ' catalogos_hospitales c '
            . ' WHERE elim=0 AND padre_id=0 '                     
            . 'ORDER BY c.nombre';


    return db_fetch($sSql);
}

function padre_subcategorias($id) {
    
    $sSql = 'SELECT '
            . ' c.id,'
            . ' c.nombre, '
            . ' c.imagen, '            
            . ' c.padre_id '
            . 'FROM '
            . ' catalogos_hospitales c '
            . ' WHERE elim=0 AND padre_id='. $id                     
            . ' ORDER BY c.nombre';


    return db_fetch($sSql);
}