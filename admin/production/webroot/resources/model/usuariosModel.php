<?php
defined('JZ_UPALE')
    or die('Acceso Incorrecto');

function obtener_listado_usuarios($sOrderBy = 'nombre_completo', $sOrder = 'ASC')
{
    $sSql = "SELECT "
          . "    u.*, "
          . "    CONCAT( "
          . "        u.nombre, ' ', u.apell_paterno, ' ', u.apell_materno "
          . "    ) AS nombre_completo, "
          . "    IF(u.email = '', '<center>-</center>', u.email) AS email, "
          . "    CASE u.estado "
          . "        WHEN 'A' THEN 'Activo' "
          . "        WHEN 'I' THEN 'Inactivo' "
          . "        WHEN 'S' THEN 'Suspendido' "
          . "        WHEN 'E' THEN 'Eliminado' "
          . "    END AS status, "
          . "    d.nombre AS departamento_nombre "
          . "FROM usuarios u "
          . "    INNER JOIN departamentos d ON u.departamento_id = d.id "
          . "WHERE 1 = 1 "
          . "    AND (u.estado = 'A' OR u.estado = 'I' OR u.estado = 'S') "
          . "    AND d.estado = 'A' "
          . "ORDER BY {$sOrderBy} {$sOrder}";
    
    $oConnection = db_connect();

    if (!$oConnection) { return false; }
    
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aUsuario = array();
    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aUsuario[] = $aRow;
        }
    } else { return false; }

    return $aUsuario;
}

function obtener_datos_usuario($nUsuarioId){
    $sSql = "SELECT "
          . "    u.id, u.nombre, u.apell_paterno, u.apell_materno, "
          . "    u.tel_oficina, u.tel_movil, u.email, u.fecha_de_cumpleanos, "
          . "    u.auth_usuario, u.auth_password, u.estado, "
          . "    u.login_attempts, u.last_login_attempt, u.info_emergencia, "
          . "    CONCAT( "
          . "        u.nombre, ' ', u.apell_paterno, ' ', u.apell_materno "
          . "    ) AS nombre_completo, "
          . "    d.id AS departamento_id, d.nombre AS departamento_nombre "
          . " FROM usuarios u "
          . "    INNER JOIN departamentos d ON u.departamento_id = d.id "
          . " WHERE 1 = 1 "
          . "    AND d.estado = 'A' "
          . "    AND (u.estado = 'A' OR u.estado = 'I' OR u.estado = 'S') "
          . "    AND u.id = :usuario_id "
          . "LIMIT 1;";

    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    mysql_bind($sSql, array('usuario_id' => $nUsuarioId));
    
    $oResult = mysql_query($sSql, $oConnection);
    

    if (! $oResult) { return false; }

    $aUsuario = mysql_fetch_array($oResult, MYSQL_ASSOC);
    if (!is_array($aUsuario) || empty($aUsuario)) { return false; }

    return $aUsuario;
}


function obtener_listado_usuarios_por_oficina($nOficinaId, $nUsuarioId)
{
    $sSql = "SELECT "
          . "    u.*, "
          . "    CONCAT( "
          . "        u.nombre, ' ', u.apell_paterno, ' ', u.apell_materno "
          . "    ) AS nombre_completo, "
          . "    u.email, "
          . "    CASE u.estado "
          . "        WHEN 'A' THEN 'Activo' "
          . "        WHEN 'I' THEN 'Inactivo' "
          . "        WHEN 'S' THEN 'Suspendido' "
          . "        WHEN 'E' THEN 'Eliminado' "
          . "    END AS status, "
          . "    d.nombre AS departamento_nombre "
          . "FROM usuarios u "
          . "INNER JOIN departamentos d ON u.departamento_id = d.id "
          . "LEFT JOIN oficinas_aaa o ON o.id = u.oficina_id "  
          . "WHERE 1 = 1 "
          . "    AND u.estado = 'A' "
          . "    AND d.estado = 'A' "
          . "    AND u.id != :usuario_id "
          . "    AND o.id = :oficina_id "
          . "ORDER BY u.nombre,u.apell_paterno ASC;";

    $oConnection = db_connect();
    if (!$oConnection) { return false; }
    
    mysql_bind($sSql, array('usuario_id' => $nUsuarioId, 'oficina_id' => $nOficinaId));

    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aUsuario = array();
    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aUsuario[] = $aRow;
        }
    } else { return false; }

    return $aUsuario;
}




function obtener_total_usuarios()
{
    $sSql = "SELECT COUNT(*) AS total "
          . "FROM usuarios u "
          . "  INNER JOIN departamentos d ON u.departamento_id = d.id "
          . "WHERE 1 = 1 "
          . "    AND u.estado = 'A' "
          . "    AND d.estado = 'A'; ";
    
    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    $oResult = mysql_query($sSql, $oConnection);

    if (! $oResult) { return false; }

    $aUsuario = mysql_fetch_array($oResult, MYSQL_ASSOC);
    

    return $aUsuario['total'];
}

function existe_usuario($sAuthUsuario)
{
    $sSql = "SELECT u.id AS total "
          . "FROM usuarios u "
          . "WHERE estado = 'A' "
          . "    AND u.auth_usuario = :auth_usuario ;";

    $oConnection = db_connect();
    if (!$oConnection) { return true; }

    mysql_bind($sSql, array('auth_usuario' => $sAuthUsuario));
    $oResult = mysql_query($sSql, $oConnection);

    if (! $oResult) { return true; }

    if (mysql_num_rows($oResult) > 0) { return true; }

    return false;
}

/*
 * funcion para obtener el listado de usuarios pertenecientes a un departamento
 */
function obtener_select_usuarios($nDepartamentoId)
{
    $sSql = " SELECT u.id, CONCAT(u.nombre, ' ', u.apell_paterno, ' ', u.apell_materno) AS nombre "
          . " FROM usuarios u WHERE u.estado <>'E' AND u.departamento_id = :departamento_id ";

    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    mysql_bind($sSql, array('departamento_id' => $nDepartamentoId));
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aUsuarios = array();
    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aRow = array_map("htmlentities", $aRow);
            $aUsuarios[] = $aRow;
        }
        //$aUsuarios[] = array("id" => "Todos", "nombre" =>"Todos los usuarios");
    }

    return $aUsuarios;
}

/*
 * function que obtiene la lista de usuarios que pertenecen a un departamento
 */
function listado_usuarios_departamento($nDepartamentoId)
{
    $sSql = " SELECT u.id, CONCAT(u.nombre, ' ', u.apell_paterno, ' ', u.apell_materno) AS nombre "
          . " FROM usuarios u WHERE u.estado <>'E' AND u.departamento_id = :departamento_id ";

    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    mysql_bind($sSql, array('departamento_id' => $nDepartamentoId));
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aUsuarios = array();
    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aUsuarios[] = $aRow;
        }
    }

    return $aUsuarios;
}


function obtener_select_todos_los_usuarios()
{
    $sSql = " SELECT u.id, CONCAT(u.nombre, ' ', u.apell_paterno, ' ', u.apell_materno) AS nombre "
          . " FROM usuarios u "
          . " WHERE 1 = 1 "
          . "     AND u.estado <>'E' ";

    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aUsuarios = array();
    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aRow = array_map("htmlentities", $aRow);
            $aUsuarios[] = $aRow;
        }
    }
    return $aUsuarios;
}



function obtener_select_todos_los_usuarios_departamentos($nDepartamentoId)
{
    $sSql = " SELECT u.id, CONCAT(u.nombre, ' ', u.apell_paterno, ' ', u.apell_materno) AS nombre "
          . " FROM usuarios u "
          . " WHERE 1 = 1 "
          . "     AND u.estado <>'E' ";

    if (!hasPermission('perm_ver_agenda_de_usuarios')){
        $sSql .= "AND u.departamento_id = :departamento_id ";
    }

    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    mysql_bind($sSql, array('departamento_id' => $nDepartamentoId));
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aUsuarios = array();
    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aRow = array_map("htmlentities", $aRow);
            $aUsuarios[] = $aRow;
        }
    }
    return $aUsuarios;
}




function obtener_listado_de_gerentes_por_oficina($nOficinaId)
{
    $sSql = "SELECT "
          . "    u.*, "
          . "    CONCAT( "
          . "        u.nombre, ' ', u.apell_paterno, ' ', u.apell_materno "
          . "    ) AS nombre_completo, "
          . "    u.email, "
          . "    d.nombre AS departamento_nombre "
          . "FROM usuarios u "
          . "INNER JOIN departamentos d ON u.departamento_id = d.id "
          . "LEFT JOIN oficinas_aaa o ON o.id = u.oficina_id "  
          . "WHERE 1 = 1 "
          . "    AND (u.estado = 'A' OR u.estado = 'I') "
          . "    AND d.estado = 'A' "
          . "    AND u.es_gerente = 'SI' "
          . "    AND u.oficina_id = :oficina_id "
          . "ORDER BY u.nombre,u.apell_paterno ASC;";

    $oConnection = db_connect();
    if (!$oConnection) { return false; }
    
    mysql_bind($sSql, array('oficina_id' => $nOficinaId));
    
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aUsuarios = array();
    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aUsuarios[] = $aRow;
        }
    } else { return false; }

    return $aUsuarios;
}



function obtener_listado_de_asesores_comerciales($nUsuarioId, $sOrderBy = 'nombre_completo', $sOrder = 'ASC')
{
    $sSql = "SELECT "
          . "    u.*, "
          . "    CONCAT( "
          . "        u.nombre, ' ', u.apell_paterno, ' ', u.apell_materno "
          . "    ) AS nombre_completo, "
          . "    IF(u.email = '', '<center>-</center>', u.email) AS email, "
          . "    CASE u.estado "
          . "        WHEN 'A' THEN 'Activo' "
          . "        WHEN 'I' THEN 'Inactivo' "
          . "        WHEN 'S' THEN 'Suspendido' "
          . "        WHEN 'E' THEN 'Eliminado' "
          . "    END AS status, "
          . "    d.nombre AS departamento_nombre, o.nombre AS oficina "
          . "FROM usuarios u "
          . "    INNER JOIN departamentos d ON u.departamento_id = d.id "
          . "    LEFT JOIN oficinas_aaa o ON o.id = u.oficina_id "
          . "WHERE 1 = 1 "
          . "    AND u.estado = 'A' AND u.id != :usuario_id "
          . "    AND d.estado = 'A' "
          . "ORDER BY {$sOrderBy} {$sOrder}";
    
    $oConnection = db_connect();
    if (!$oConnection) { return false; }
    
 mysql_bind($sSql, array('usuario_id' => $nUsuarioId));
    
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aUsuario = array();
    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aUsuario[] = $aRow;
        }
    } else { return false; }

    return $aUsuario;
}





function obtener_listado_usuarios_por_asistente_asignado($nAsistenteId)
{
    $sSql = "SELECT "
          . "    u.*, "
          . "    CONCAT( "
          . "        u.nombre, ' ', u.apell_paterno, ' ', u.apell_materno "
          . "    ) AS nombre_completo, "
          . "    u.email, "
          . "    CASE u.estado "
          . "        WHEN 'A' THEN 'Activo' "
          . "        WHEN 'I' THEN 'Inactivo' "
          . "        WHEN 'S' THEN 'Suspendido' "
          . "        WHEN 'E' THEN 'Eliminado' "
          . "    END AS status, "
          . "    d.nombre AS departamento_nombre "
          . "FROM usuarios u "
          . "INNER JOIN departamentos d ON u.departamento_id = d.id "
          . "LEFT JOIN oficinas_aaa o ON o.id = u.oficina_id "  
          . "WHERE 1 = 1 "
          . "    AND u.estado = 'A' "
          . "    AND d.estado = 'A' "
          . "    AND u.asistente_id = :asistente_id "
          . "ORDER BY u.nombre,u.apell_paterno ASC;";

    $oConnection = db_connect();
    if (!$oConnection) { return false; }
    
    mysql_bind($sSql, array('asistente_id' => $nAsistenteId));
    
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aUsuario = array();
    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aUsuario[] = $aRow;
        }
    } else { return false; }

    return $aUsuario;
}

