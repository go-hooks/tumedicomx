<?php
defined('JZ_UPALE')
    or die('Acceso Incorrecto');

function estados_obtener_listado()
{
    $sSql = "SELECT "
          . "    e.id, e.nombre "
          . "    FROM  estados AS e "
          . "    WHERE 1 = 1 "
          . "    ORDER BY id ASC;";

    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aEstados = array();
    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aEstados[] = $aRow;
        }
    }
    return $aEstados;
}

function obtener_datos_areaGeografica($nEstadoId)
{
    $sSql = "SELECT "
          . "    e.* "
          . "FROM estados e "
          . "WHERE 1 = 1 "
          . "    AND e.id = :estado_id "
          . "LIMIT 1;";

    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    mysql_bind($sSql, array('estado_id' => $nEstadoId));
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aEstado = mysql_fetch_array($oResult, MYSQL_ASSOC);
    if (!is_array($aEstado) || empty($aEstado)) { return false; }

    return $aEstado;
}

function existe_areaGeografica($sEstado)
{
    $sSql = "SELECT e.id AS total "
          . "FROM estados e "
          . "WHERE 1 = 1 "
          . "    AND e.nombre = :nombre ;";

    $oConnection = db_connect();
    if (!$oConnection) { return true; }

    mysql_bind($sSql, array('nombre' => $sEstado));
    $oResult = mysql_query($sSql, $oConnection);

    if (! $oResult) { return true; }

    if (mysql_num_rows($oResult) > 0) { return true; }

    return false;
}



