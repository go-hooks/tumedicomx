<?php

function db_connect()
{
        
    $oLink = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);

    if(! $oLink) {
        return false;
    }

    if(! mysql_select_db(DB_NAME, $oLink)) {
        return false;
    }
    
    mysql_set_charset('utf8',$oLink);        
    
    return $oLink;
}

function db_modificar($tabla, $registro_id, $valores)
{
    if (empty($tabla) || !is_string($tabla)) return false;
    if (empty($registro_id) || !is_numeric($registro_id)) return false;
    if (! is_array($valores)) return false;

    $conn = db_connect();
    if(! $conn) { return false; }

    $campos = array_keys($valores);
    $no_campos = count($campos);

    $campos_reales = db_obtener_campos($tabla);
    foreach ($campos as $campo) {
        if (! in_array($campo, $campos_reales)) { return false; }
    }

    $sql = "UPDATE `{$tabla}` SET ";
    $cont = 1;
    foreach ($campos as $campo) {
        $value = mysql_escape($valores[$campo]);
        $sql .= "`{$campo}` = {$value}";
        if($cont < $no_campos) {
            $sql .= ", ";
        }
        $cont++;
    }
    $sql .= " WHERE `id` = '{$registro_id}';";
    

    $result = @mysql_query($sql, $conn);
    if (! $result) return false;

    return true;
}

function db_modificar_por_campos($tabla, $campos = array(), $valores)
{
    if (empty($tabla) || !is_string($tabla)) return false;
    if (! is_array($campos)) return false;
    if (! is_array($valores)) return false;

    $campos_reales = db_obtener_campos($tabla);
    
    foreach ($campos as $campo => $valor) {
        if (! in_array($campo, $campos_reales)) { return false; }
        else { $where .= ' AND `'.$campo."` = '".$valor."' "; }
    }
    
    $conn = db_connect();
    if(! $conn) { return false; }

    $campos = array_keys($valores);
    $no_campos = count($campos);

    foreach ($campos as $campo) {
        if (! in_array($campo, $campos_reales)) { return false; }
    }

    $sql = "UPDATE `{$tabla}` SET ";
    $cont = 1;
    foreach ($campos as $campo) {
        $value = mysql_escape($valores[$campo]);
        $sql .= "`{$campo}` = '{$value}'";
        if($cont < $no_campos) {
            $sql .= ", ";
        }
        $cont++;
    }
    $sql .= " WHERE 1 = 1 {$where};";
    
    $result = @mysql_query($sql, $conn);
    if (! $result) return false;

    return true;
}

function db_insertar($tabla, $valores)
{    
    
    if (empty($tabla) || !is_string($tabla)) return false;
    if (! is_array($valores)) return false;

    $conn = db_connect();
    if(! $conn) { return false; }
    
    $campos = array_keys($valores);
    $no_campos = count($campos);
    $campos_reales = db_obtener_campos($tabla);    
    
    foreach ($campos as $campo) {
        if (! in_array($campo, $campos_reales)) { return false; }
    }

    $sql = "INSERT INTO `{$tabla}`  (" . implode(',', $campos) . ") VALUES (";

    $cont = 1;
    foreach ($campos as $campo) {
        $value = $valores[$campo];
        $sql .= mysql_escape($value);
        if($cont < $no_campos) {
            $sql .= ", ";
        }
        $cont++;
    }
    $sql .= ");";

    $result = @mysql_query($sql, $conn);
    
    if (! $result) { return false; }

    $reg_id = @mysql_insert_id($conn);

    return $reg_id;
}

function db_eliminar_por_id($tabla, $id)
{
    if (empty($tabla) || !is_string($tabla)) return false;
    if (! is_numeric($id)) return false;

    $sql = "DELETE FROM `{$tabla}` WHERE `id` = {$id} LIMIT 1;";

    $conn = db_connect();
    if(! $conn) return false;

    $result = @mysql_query($sql, $conn);
    if (! $result) return false;

    return true;
}

function db_eliminar_por_campos($tabla, $campos = array())
{
    if (empty($tabla) || !is_string($tabla)) return false;
    if (! is_array($campos)) return false;

    $campos_reales = db_obtener_campos($tabla);
    
    foreach ($campos as $campo => $valor) {
        if (! in_array($campo, $campos_reales)) { return false; }
    }
    

    foreach($campos as $campo => $valor){
        $where .= 'AND `'.$campo.'` = '.$valor;
    }

    $sql = "DELETE FROM `{$tabla}` WHERE 1 = 1 {$where}";

    $conn = db_connect();
    if(! $conn) return false;

    $result = @mysql_query($sql, $conn);
    if (! $result) return false;

    return true;
}

function db_obtener_campos($tabla)
{
    if (empty($tabla) || !is_string($tabla)) return false;

    $sql = "SHOW COLUMNS FROM `{$tabla}`;";

    $conn = db_connect();
    if(! $conn) return false;

    $result = @mysql_query($sql, $conn);
    if (! $result) return false;

    $vec_result = array();
    while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
        $vec_result[] = $row['Field'];
    }

    return $vec_result;
}

function db_contar($tabla, $valor = '*', $where = 1)
{
    if (empty($tabla) || !is_string($tabla)) return false;

    $sql = "SELECT COUNT($valor) as conteo FROM $tabla WHERE $where";

    $conn = db_connect();
    if(! $conn) return false;

    $result = @mysql_query($sql, $conn);
    if (! $result) return false;

    if ( $row = mysql_fetch_array($result, MYSQL_ASSOC) ) {
        return $row['conteo'];
    }

    return false;
}

function mysql_escape($values) {
    if (is_array($values)) {
        foreach ($values as $key => $value) {
            $values[$key] = mysql_escape($value, $quotes);
        }
    } else if ($values === NULL) {
        $values = 'NULL';
    } else if (is_bool($values)) {
        $values = $values ? 1 : 0;
    } else {
        if (get_magic_quotes_gpc()) {
            $values = stripslashes($values);
        }

        if (! is_numeric($values)) {
            $conn = db_connect();
            $values = "'" . mysql_real_escape_string($values) . "'";
        }
        else {
            $values = "'" . $values . "'";
        }
    }
    return $values;
}

function mysql_bind(&$sql, $vals) {
    foreach ($vals as $name => $val) {
        $sql = str_replace(":{$name}", mysql_escape($val), $sql);
    }
}
