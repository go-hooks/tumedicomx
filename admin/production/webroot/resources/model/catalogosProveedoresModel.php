<?php

function catalogos_proveedores_read($id) {
    $sSql = 'SELECT * FROM '
            . ' catalogos_proveedores c'
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

function buscar_catalogo_proveedor($buscar) {
    
    if ($buscar['buscar']!=''){   

    $sSql = 'SELECT '
            . ' c.id,'
            . ' c.nombre, '
            . ' c.imagen '
            . 'FROM '
            . ' catalogos_proveedores c '
            . 'WHERE '
            . ' elim=0 AND '                    
            . 'nombre like "%' . $buscar['buscar'] . '%"' 
            . 'ORDER BY c.nombre';
    
    }     
    else{
    $sSql = 'SELECT '
            . ' c.id,'
            . ' c.nombre, '
            . ' c.imagen '
            . 'FROM '
            . ' catalogos_proveedores c '
            . ' WHERE elim=0 '                       
            . 'ORDER BY c.nombre';
    }     
    
    
    return  db_paginate($sSql, array('limit' => 30));      
    
   
}

function get_last_catalogo_proveedor($cantidad = 1000) {
    
    $sSql = 'SELECT '
            . ' c.id,'
            . ' c.nombre, '
            . ' c.imagen '
            . 'FROM '
            . ' catalogos_proveedores c '
            . ' WHERE elim=0 '                       
            . 'ORDER BY c.nombre';

	$data = db_paginate($sSql, array('limit' => 30));

   if(!$data){
   		set_flash('<strong>¡No hay catalogos aun!</strong> <br />Talvez quieras agregar algunos cuantos...', 'info');
   }
   
   return $data;
}


function salvar_catalogo_proveedor($aData) {

    $required = array(
        'nombre' => $aData['nombre']
    );
    
    
    if (in_array('', $required)) {
        set_flash('El nombre no puede estar vacio.', 'warning');
        return false;
    }   
    
    
    if (isset($aData['id'])) {
        $sSql = "UPDATE catalogos_proveedores SET "
                . "`imagen` = :imagen, "
                . "`nombre` = :nombre "
                . "WHERE id =" . $aData['id'];
        $exit = "Catalogo exitosamente <strong>actualizado</strong>";
    } else {
        $sSql = "INSERT INTO catalogos_proveedores ("
                . " imagen, "
                . " nombre) "
                . "VALUES ("
                . ":imagen,"
                . ":nombre);";
        $exit = "Catalogo exitosamente <strong>creado</strong>";
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

function cargar_catalogo_proveedor( ) {
    $sSql = 'SELECT '
            . ' c.id,'
            . ' c.nombre, '
            . ' c.imagen '
            . 'FROM '
            . ' catalogos_proveedores c '
            . ' WHERE elim=0 '                       
            . 'ORDER BY c.nombre';


    return db_fetch($sSql);
}

