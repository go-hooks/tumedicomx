<?php
defined('JZ_UPALE')
    or die('Acceso Incorrecto');

function obtener_estado_por_id($nEstadoId)
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

function obtener_select_estados()
{
    $sSql = "SELECT "
          . "    e.id AS value, e.nombre AS text "
          . "FROM estados e "
          . "WHERE 1 = 1 "
          . "ORDER BY e.nombre ASC;";

    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aEstados = array();
    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aRow = array_map("htmlentities", $aRow);
            $aEstados[] = $aRow;
        }
    }

    return $aEstados;
}
