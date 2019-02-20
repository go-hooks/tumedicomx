<?php
defined('JZ_UPALE')
    or die('Acceso Incorrecto');

function reuniones_obtener_listado()
{
    $sSql = "SELECT "
          . "    r.id, r.titulo, r.estado "
          . "    FROM reuniones r "
          . "    WHERE 1 = 1 "
          . "        AND r.estado != 'Eliminado'"      
          . "    ORDER BY r.titulo ASC;";

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




function existe_reunion($sReunion)
{
    $sSql = "SELECT r.id "
          . "FROM reuniones r "
          . "WHERE 1 = 1 "
          . "    AND r.titulo = :nombre AND r.estado != 'Eliminado';";

    $oConnection = db_connect();
    if (!$oConnection) { return true; }

    mysql_bind($sSql, array('nombre' => $sReunion));
    $oResult = mysql_query($sSql, $oConnection);

    if (! $oResult) { return true; }

    if (mysql_num_rows($oResult) > 0) { return true; }

    return false;
}




function obtener_datos_reunion($nReunionId)
{
    $sSql = "SELECT "
          . "    r.* "
          . "FROM reuniones r "
          . "WHERE 1 = 1 "
          . "    AND r.id = :reunion_id "
          . "LIMIT 1;";

    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    mysql_bind($sSql, array('reunion_id' => $nReunionId));
    
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aReunion = mysql_fetch_array($oResult, MYSQL_ASSOC);
    if (!is_array($aReunion) || empty($aReunion)) { return false; }

    return $aReunion;
}