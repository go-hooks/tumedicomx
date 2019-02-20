<?php
defined('JZ_UPALE')
    or die('Acceso Incorrecto');

function oficinas_obtener_listado()
{
    $sSql = "SELECT "
          . "    o.id, o.nombre, o.estado, o.tipo "
          . "    FROM oficinas_aaa o "
          . "    WHERE 1 = 1 "
          . "        AND o.estado != 'Eliminado'"      
          . "    ORDER BY o.nombre ASC;";

    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aOficinas = array();
    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aOficinas[] = $aRow;
        }
    }
    return $aOficinas;
}




function existe_oficina($sOficina)
{
    $sSql = "SELECT o.id "
          . "FROM oficinas_aaa o "
          . "WHERE 1 = 1 "
          . "    AND o.nombre = :nombre AND o.estado != 'Eliminado';";

    $oConnection = db_connect();
    if (!$oConnection) { return true; }

    mysql_bind($sSql, array('nombre' => $sOficina));
    $oResult = mysql_query($sSql, $oConnection);

    if (! $oResult) { return true; }

    if (mysql_num_rows($oResult) > 0) { return true; }

    return false;
}



function obtener_datos_oficina($nOficinaId)
{
    $sSql = "SELECT "
          . "    o.* "
          . "FROM oficinas_aaa o "
          . "WHERE 1 = 1 "
          . "    AND o.id = :oficina_id "
          . "LIMIT 1;";

    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    mysql_bind($sSql, array('oficina_id' => $nOficinaId));
    
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aOficina = mysql_fetch_array($oResult, MYSQL_ASSOC);
    if (!is_array($aOficina) || empty($aOficina)) { return false; }

    return $aOficina;
}
