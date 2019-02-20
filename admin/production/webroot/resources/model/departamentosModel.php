<?php
defined('JZ_UPALE')
    or die('Acceso Incorrecto');

function obtener_select_departamentos()
{
    $sSql = "SELECT "
          . "    d.*, "
          . "    CASE d.estado "
          . "        WHEN 'A' THEN 'Activo' "
          . "        WHEN 'I' THEN 'Inactivo' "
          . "        WHEN 'E' THEN 'Eliminado' "
          . "    END AS status "
          . "FROM departamentos d "
          . "WHERE 1 = 1 "
          . "    AND d.estado = 'A' "
          . "ORDER BY d.nombre ASC;";

    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aDepartamentos = array();
    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aDepartamentos[] = $aRow;
        }
    } else { return false; }

    return $aDepartamentos;
}


function departamentos_obtener_listado()
{
    $sSql = "SELECT "
          . "    d.* "
          . "FROM departamentos d "
          . "WHERE 1 = 1 "
          . "    AND d.estado != 'E' "
          . "ORDER BY d.nombre ASC;";

     $oConnection = db_connect();
     if (!$oConnection) { return false; }

     $oResult = mysql_query($sSql, $oConnection);
     if (! $oResult) { return false; }

     $aDepartamentos = array();
     if (mysql_num_rows($oResult) > 0) {
         while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
             $aDepartamentos[] = $aRow;
         }
     }
     return $aDepartamentos;
}

function departamentos_nombre_estado($cEstado)
{
    switch($cEstado)
    {
        case 'A': return 'Activo';
            break;
        case 'I': return 'Inactivo';
            break;
        case 'E': return 'Eliminado';
            break;
        case 'S': return 'suspendido';
            break;
        default: return 'Desconocido';
            break;
    }
}
/*
 * funcion para mostrar los estados en los que puede estar un departamento
 */
function departamentos_estado()
{
    $aEstados = array('A' => 'Activo' , 'I' => 'Inactivo' , 'E' => 'Eliminado' , 'S' => 'Suspendido');
    return $aEstados;
}

function existe_departamento($sDepartamento)
{
    $sSql = "SELECT d.id AS total "
          . "FROM departamentos d "
          . "WHERE 1 = 1 "
          . "    AND d.nombre = :nombre AND d.estado != 'E';";

    $oConnection = db_connect();
    if (!$oConnection) { return true; }

    mysql_bind($sSql, array('nombre' => $sDepartamento));
    $oResult = mysql_query($sSql, $oConnection);

    if (! $oResult) { return true; }

    if (mysql_num_rows($oResult) > 0) { return true; }

    return false;
}

function obtener_datos_departamento($nDepartamentoId)
{
    $sSql = "SELECT id, nombre, estado, created_at, updated_at "
          . "   FROM departamentos "
          . "   WHERE id = :departamento_id";

    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    mysql_bind($sSql, array('departamento_id' => $nDepartamentoId));
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aDepartamento = mysql_fetch_array($oResult, MYSQL_ASSOC);
    if (!is_array($aDepartamento) || empty($aDepartamento)) { return false; }

    return $aDepartamento;
}