<?php
defined('JZ_UPALE')
    or die('Acceso Incorrecto');

function servicios_obtener_listado()
{
    $sSql = "SELECT "
          . "    s.id, s.titulo, s.estado "
          . "    FROM tipos_servicio s "
          . "    WHERE 1 = 1 "
          . "        AND s.estado != 'Eliminado'"      
          . "    ORDER BY s.titulo ASC;";

    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aServicios = array();
    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aServicios[] = $aRow;
        }
    }
    return $aServicios;
}




function existe_servicio($sServicio)
{
    $sSql = "SELECT s.id "
          . "FROM tipos_servicio s "
          . "WHERE 1 = 1 "
          . "    AND s.titulo = :nombre AND s.estado != 'Eliminado';";

    $oConnection = db_connect();
    if (!$oConnection) { return true; }

    mysql_bind($sSql, array('nombre' => $sServicio));
    $oResult = mysql_query($sSql, $oConnection);

    if (! $oResult) { return true; }

    if (mysql_num_rows($oResult) > 0) { return true; }

    return false;
}




function obtener_datos_servicio($nServicioId)
{
    $sSql = "SELECT "
          . "    s.* "
          . "FROM tipos_servicio s "
          . "WHERE 1 = 1 "
          . "    AND s.id = :servicio_id "
          . "LIMIT 1;";

    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    mysql_bind($sSql, array('servicio_id' => $nServicioId));
    
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aServicio = mysql_fetch_array($oResult, MYSQL_ASSOC);
    if (!is_array($aServicio) || empty($aServicio)) { return false; }

    return $aServicio;
}
