<?php

$pagination;

function db_connect() {
	global $aConfig;
	$sDefaultDatabase = $aConfig['default-database'];

	$aDataBase = $aConfig['database'][$sDefaultDatabase];

	$oLink = mysql_connect($aDataBase['host'], $aDataBase['user'], $aDataBase['pass']);

	if (!$oLink) {
		return false;
	}

	if (!mysql_select_db($aDataBase['name'], $oLink)) {
		return false;
	}

	return $oLink;
}

function db_modificar($tabla, $registro_id, $valores) {
	if (empty($tabla) || !is_string($tabla))
		return false;
	if (empty($registro_id) || !is_numeric($registro_id))
		return false;
	if (!is_array($valores))
		return false;

	$conn = db_connect();
	if (!$conn) {
		return false;
	}

	$campos = array_keys($valores);
	$no_campos = count($campos);

	$campos_reales = db_obtener_campos($tabla);
	foreach ($campos as $campo) {
		if (!in_array($campo, $campos_reales)) {
			return false;
		}
	}

	$sql = "UPDATE `{$tabla}` SET ";
	$cont = 1;
	foreach ($campos as $campo) {
		$value = mysql_escape($valores[$campo]);
		$sql .= "`{$campo}` = {$value}";
		if ($cont < $no_campos) {
			$sql .= ", ";
		}
		$cont++;
	}
	$sql .= " WHERE `id` = '{$registro_id}';";

	$result = @mysql_query($sql, $conn);
	if (!$result)
		return false;

	return true;
}

function db_modificar_restriccion($tabla, $registro_id, $valores, $aWhere) {
	if (empty($tabla) || !is_string($tabla))
		return false;
	if (empty($registro_id) || !is_numeric($registro_id))
		return false;
	if (!is_array($valores))
		return false;
	if (!is_array($aWhere))
		return false;

	$conn = db_connect();
	if (!$conn) {
		return false;
	}

	$campos = array_keys($valores);
	$no_campos = count($campos);

	$campos_reales = db_obtener_campos($tabla);
	foreach ($campos as $campo) {
		if (!in_array($campo, $campos_reales)) {
			return false;
		}
	}
	$where = "";
	foreach ($aWhere as $campo => $restriccion) {
		$where .= " AND `{$campo}` = '{$restriccion}' ";
	}

	$sql = "UPDATE `{$tabla}` SET ";
	$cont = 1;
	foreach ($campos as $campo) {
		$value = mysql_escape($valores[$campo]);
		$sql .= "`{$campo}` = {$value}";
		if ($cont < $no_campos) {
			$sql .= ", ";
		}
		$cont++;
	}
	$sql .= " WHERE `id` = '{$registro_id}' {$where} ";

	$result = @mysql_query($sql, $conn);
	if (!$result)
		return false;

	return true;
}

function db_modificar_campos($tabla, $valores, $aWhere) {
	if (empty($tabla) || !is_string($tabla))
		return false;
	if (!is_array($valores))
		return false;
	if (!is_array($aWhere))
		return false;

	$conn = db_connect();
	if (!$conn) {
		return false;
	}

	$campos = array_keys($valores);
	$no_campos = count($campos);

	$campos_reales = db_obtener_campos($tabla);
	foreach ($campos as $campo) {
		if (!in_array($campo, $campos_reales)) {
			return false;
		}
	}
	$where = "";
	foreach ($aWhere as $campo => $restriccion) {
		$where .= " AND `{$campo}` = '{$restriccion}' ";
	}

	$sql = "UPDATE `{$tabla}` SET ";
	$cont = 1;
	foreach ($campos as $campo) {
		$value = mysql_escape($valores[$campo]);
		$sql .= "`{$campo}` = {$value}";
		if ($cont < $no_campos) {
			$sql .= ", ";
		}
		$cont++;
	}
	$sql .= " WHERE 1 = 1 {$where} ";

	$result = @mysql_query($sql, $conn);
	if (!$result)
		return false;

	return true;
}

function db_insertar($tabla, $valores) {
    
	if (empty($tabla) || !is_string($tabla))
		return false;
	if (!is_array($valores))
		return false;

	$conn = db_connect();
	if (!$conn) {
		return false;
	}

	$campos = array_keys($valores);
	$no_campos = count($campos);

	$campos_reales = db_obtener_campos($tabla);
	foreach ($campos as $campo) {
		if (!in_array($campo, $campos_reales)) {
			return false;
		}
	}

	$sql = "INSERT INTO `{$tabla}`  (" . implode(',', $campos) . ") VALUES (";

	$cont = 1;
	foreach ($campos as $campo) {
		$value = $valores[$campo];
		$sql .= mysql_escape($value);
		if ($cont < $no_campos) {
			$sql .= ", ";
		}
		$cont++;
	}
	$sql .= ");";

	$result = @mysql_query($sql, $conn);        
	if (!$result) {
		return false;
	}

	$reg_id = @mysql_insert_id($conn);
	return $reg_id;
}

function db_eliminar_por_id($tabla, $id) {
	if (empty($tabla) || !is_string($tabla))
		return false;
	if (!is_numeric($id))
		return false;

	$sql = "DELETE FROM `{$tabla}` WHERE `id` = {$id} LIMIT 1;";

	$conn = db_connect();
	if (!$conn)
		return false;

	$result = @mysql_query($sql, $conn);
	if (!$result)
		return false;

	return true;
}

/*
 *  El eliminado logico requiere el campo elim en la tabla.
 * 
 *  Por defecto todos los campos elim = 0 están disponibles, 
 *  mientras que los elim = 1 están "logicamente" eliminados.
 * 
 * */
function db_eliminado_logico($tabla, $id, $debug_sql = FALSE) {
	
	$return = db_modificar($tabla, $id, array('elim' => 1));
	
        if($debug_sql)
        {
	debug( $return );
        }
        
	if($return){
		return TRUE;
	} else {
		set_flash('Ha ocurrido un error de eliminado lógico', 'error');
		return FALSE;
	}
	
}

function db_eliminar_por_campo($tabla, $campo, $id) {
	if (empty($tabla) || !is_string($tabla))
		return false;
	if (empty($campo) || !is_string($campo))
		return false;
	if (!is_numeric($id))
		return false;

	$sql = "DELETE FROM `{$tabla}` WHERE `{$campo}` = {$id}";

	$conn = db_connect();
	if (!$conn)
		return false;

	$result = @mysql_query($sql, $conn);
	if (!$result)
		return false;

	return true;
}

function db_eliminar_por_restricciones($tabla, $aRestricciones) {
	if (empty($tabla) || !is_string($tabla))
		return false;
	if (!is_array($aRestricciones))
		return false;

	$campos = array_keys($aRestricciones);

	$campos_reales = db_obtener_campos($tabla);
	foreach ($campos as $campo) {
		if (!in_array($campo, $campos_reales)) {
			return false;
		}
	}

	$where = "";
	foreach ($aRestricciones as $campo => $restriccion) {
		$where .= " AND `{$campo}` = '{$restriccion}' ";
	}

	$sql = "DELETE FROM `{$tabla}` WHERE 1 = 1 {$where} ";

	$conn = db_connect();
	if (!$conn)
		return false;

	$result = @mysql_query($sql, $conn);
	if (!$result)
		return false;

	return true;
}

function db_eliminar_por_sql($sSql) {
	if (empty($sSql) || !is_string($sSql))
		return false;

	$conn = db_connect();
	if (!$conn)
		return false;

	$result = @mysql_query($sSql, $conn);
	if (!$result)
		return false;

	return true;
}

function db_obtener_campos($tabla) {
	if (empty($tabla) || !is_string($tabla))
		return false;

	$sql = "SHOW COLUMNS FROM `{$tabla}`;";

	$conn = db_connect();
	if (!$conn)
		return false;

	$result = @mysql_query($sql, $conn);
	if (!$result)
		return false;

	$vec_result = array();
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$vec_result[] = $row['Field'];
	}

	return $vec_result;
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

		if (!is_numeric($values)) {
			$values = "'" . mysql_real_escape_string($values) . "'";
		}
	}
	return $values;
}

function mysql_bind(&$sql, $vals) {
	foreach ($vals as $name => $val) {
		$sql = str_replace(":{$name}", mysql_escape($val), $sql);
	}
}

function db_inicio_transaccion() {
	$conn = db_connect();
	if (!$conn)
		return false;

	$sql = "BEGIN;";

	$result = @mysql_query($sql, $conn);
	if (!$result)
		return false;
}

function db_fin_transaccion() {
	$conn = db_connect();
	if (!$conn)
		return false;

	$sql = "COMMIT;";

	$result = @mysql_query($sql, $conn);
	if (!$result)
		return false;
}

function db_rollback_transaccion() {
	$conn = db_connect();
	if (!$conn)
		return false;

	$sql = "ROLLBACK;";

	$result = @mysql_query($sql, $conn);
	if (!$result)
		return false;
}

function db_fetch($sql, $binding = array(), $debug_sql = FALSE) {

	$link = db_connect();
	
	$sql = str_replace(';', '', $sql);
	
	mysql_bind($sql, $binding);
	
	// Si hay un campo de eliminado logico, filtra.
	if(stripos($sql, '.elim') > 0){
		$sql = sprintf("SELECT * FROM ( %s ) A WHERE A.elim = 0", $sql);	
	}
	
	if ($link) {

		$query = mysql_query($sql);

		$return = array();
                                
		if (mysql_num_rows($query) > 0) {
			while ($row = mysql_fetch_array($query, MYSQL_ASSOC)) {
				$return[] = $row;
			}
		}
		if ($debug_sql) {
			debug($sql);
			debug($return);
		}
		return $return;
	} else {
		return false;
	}
}

function db_paginate($sql, $binding = array(), $options = array(), $debug_sql = false) {
	global $pagination;
	
	if(isset($options['limit'])){
		$limit = $options['limit'];
	} else {
		$limit = 15;
	}
	
	$pagination = _get_pages($sql, $binding, $limit);

	$start = 0; // Siempre debe empezar en 0
	
	$aGet = http_get_request();
	
	if(isset($aGet['p'])){
		$start = $start + ($aGet['p'] - 1) * $limit;
		// $limit = $limit;
		$pagination['current'] = $aGet['p'];
	} else {
		$pagination['current'] = 1;
	}

	$link = db_connect();
	
	
	// Determina si se está mandando campo para validación de eliminados lógicos.
	
	if(stripos($sql, '.elim') > 0){
		$sql_pag = sprintf("SELECT * FROM ( %s ) A WHERE A.elim = 0 limit %s, %s", $sql, $start, $limit);	
	} else {
		$sql_pag = sprintf("SELECT * FROM ( %s ) A limit %s, %s", $sql, $start, $limit);
	}

	mysql_bind($sql_pag, $binding);	

	if ($debug_sql) {
		debug($sql_pag);
	}

	if ($link) {

		$query = mysql_query($sql_pag);

		$return = array();
		
		if($query){
		
			if (mysql_num_rows($query) > 0) {
				while ($row = mysql_fetch_array($query, MYSQL_ASSOC)) {
					$return[] = $row;
				}
			}
			
			$pagination['fetched'] = count($return);
			
			if ($debug_sql) {
				debug($return);
			}
			
			return $return;	
			
		} else {
			return array();
		}
	} else {
		return false;
	}
}

function db_read($sql, $binding = array(), $debug_sql = false) {

	$link = db_connect();

	mysql_bind($sql, $binding);

	if ($debug_sql) {
		debug($sql);
	}

	if ($link) {

		$query = mysql_query($sql);

		$return = array();

		if (mysql_num_rows($query) > 0) {

			while ($row = mysql_fetch_array($query, MYSQL_ASSOC)) {
				$return[] = $row;
			}
		}
		if ($debug_sql) {
			debug($return);
		}
		return $return[0];
	} else {
		return false;
	}
}

function _get_pages($sql, $binding, $limit) {
	
	$link = db_connect();	
	
	if(stripos($sql, '.elim') > 0){
		$sql= "SELECT COUNT(*) FROM ($sql) A WHERE A.elim = 0";	
	} else {
		$sql= "SELECT COUNT(*) FROM ($sql) A";
	}
	
	mysql_bind($sql, $binding);

	if ($link) {
		// Perform the logic of the query
		$query = mysql_query($sql);
	
		if($query){
			$count = mysql_fetch_array($query, MYSQL_NUM);
		} else {
			$count = 0;
			$pages = 0;
		}
		
		$pages = ceil($count[0] / $limit);
	
		return array(
			'rows' 	=> $count[0],
			'pages'	=> $pages,
			'limit'	=> $limit
		);
	}

	
}
