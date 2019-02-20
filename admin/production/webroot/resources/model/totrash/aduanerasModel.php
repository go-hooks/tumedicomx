<?php
defined('JZ_UPALE')
    or die('Acceso Incorrecto');

function aduaneras_obtener_listado()
{
    $sSql = "SELECT "
          . "    a.id, a.nombre, a.estado "
          . "    FROM aduaneras a "
          . "    WHERE 1 = 1 "
          . "        AND a.estado != 'Eliminado'"      
          . "    ORDER BY a.nombre ASC;";

    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aDuaneras = array();
    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aDuaneras[] = $aRow;
        }
    }
    return $aDuaneras;
}




function existe_aduanera($sAduanera)
{
    $sSql = "SELECT a.id "
          . "FROM aduaneras a "
          . "WHERE 1 = 1 "
          . "    AND a.nombre = :nombre AND a.estado != 'Eliminado';";

    $oConnection = db_connect();
    if (!$oConnection) { return true; }

    mysql_bind($sSql, array('nombre' => $sAduanera));
    $oResult = mysql_query($sSql, $oConnection);

    if (! $oResult) { return true; }

    if (mysql_num_rows($oResult) > 0) { return true; }

    return false;
}


function obtener_datos_aduanera($nAduaneraId)
{
    $sSql = "SELECT "
          . "    a.* "
          . "FROM aduaneras a "
          . "WHERE 1 = 1 "
          . "    AND a.id = :aduanera_id "
          . "LIMIT 1;";

    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    mysql_bind($sSql, array('aduanera_id' => $nAduaneraId));
    
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aDuanera = mysql_fetch_array($oResult, MYSQL_ASSOC);
    if (!is_array($aDuanera) || empty($aDuanera)) { return false; }

    return $aDuanera;
}
