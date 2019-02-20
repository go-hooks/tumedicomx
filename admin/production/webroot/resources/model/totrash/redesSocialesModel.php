<?php
defined('JZ_UPALE')
    or die('Acceso Incorrecto');

function redesSociales_obtener_listado()
{
    $sSql = "SELECT "
          . "    r.id, r.titulo, r.estado "
          . "    FROM redes_sociales r "
          . "    WHERE 1 = 1 "
          . "        AND r.estado != 'Eliminado'"      
          . "    ORDER BY r.titulo ASC;";

    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aRedes = array();
    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aRedes[] = $aRow;
        }
    }
    return $aRedes;
}




function existe_redSocial($sRedSocial)
{
    $sSql = "SELECT r.id "
          . "FROM redes_sociales r "
          . "WHERE 1 = 1 "
          . "    AND r.titulo = :nombre AND r.estado != 'Eliminado';";

    $oConnection = db_connect();
    if (!$oConnection) { return true; }

    mysql_bind($sSql, array('nombre' => $sMotivo));
    $oResult = mysql_query($sSql, $oConnection);

    if (! $oResult) { return true; }

    if (mysql_num_rows($oResult) > 0) { return true; }

    return false;
}



function obtener_datos_redSocial($nRedId)
{
    $sSql = "SELECT "
          . "    r.* "
          . "FROM redes_sociales r "
          . "WHERE 1 = 1 "
          . "    AND r.id = :red_id "
          . "LIMIT 1;";

    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    mysql_bind($sSql, array('red_id' => $nRedId));
    
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aRedSocial = mysql_fetch_array($oResult, MYSQL_ASSOC);
    if (!is_array($aRedSocial) || empty($aRedSocial)) { return false; }

    return $aRedSocial;
}
