<?php
defined('JZ_UPALE')
    or die('Acceso Incorrecto');

function llamadas_obtener_listado()
{
    $sSql = "SELECT "
          . "    l.id, l.titulo, l.estado "
          . "    FROM llamadas l "
          . "    WHERE 1 = 1 "
          . "        AND l.estado != 'Eliminado'"      
          . "    ORDER BY l.titulo ASC;";

    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aLlamadas = array();
    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aLlamadas[] = $aRow;
        }
    }
    return $aLlamadas;
}



function existe_llamada($sLlamada)
{
    $sSql = "SELECT l.id "
          . "FROM llamadas l "
          . "WHERE 1 = 1 "
          . "    AND l.titulo = :nombre AND l.estado != 'Eliminado';";

    $oConnection = db_connect();
    if (!$oConnection) { return true; }

    mysql_bind($sSql, array('nombre' => $sLlamada));
    $oResult = mysql_query($sSql, $oConnection);

    if (! $oResult) { return true; }

    if (mysql_num_rows($oResult) > 0) { return true; }

    return false;
}



function obtener_datos_llamada($nLlamadaId)
{
    $sSql = "SELECT "
          . "    l.* "
          . "FROM llamadas l "
          . "WHERE 1 = 1 "
          . "    AND l.id = :llamada_id "
          . "LIMIT 1;";

    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    mysql_bind($sSql, array('llamada_id' => $nLlamadaId));
    
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aLlamada = mysql_fetch_array($oResult, MYSQL_ASSOC);
    if (!is_array($aLlamada) || empty($aLlamada)) { return false; }

    return $aLlamada;
}
