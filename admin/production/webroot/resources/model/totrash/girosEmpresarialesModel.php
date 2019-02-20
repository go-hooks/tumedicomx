<?php
defined('JZ_UPALE')
    or die('Acceso Incorrecto');

function girosEmpresariales_obtener_listado()
{
    $sSql = "SELECT "
          . "    g.id, g.titulo, g.estado "
          . "    FROM giros_empresariales g "
          . "    WHERE 1 = 1 "
          . "        AND g.estado != 'Eliminado'"      
          . "    ORDER BY g.titulo ASC;";

    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aGiros = array();
    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aGiros[] = $aRow;
        }
    }
    return $aGiros;
}




function existe_giroEmpresarial($sGiro)
{
    $sSql = "SELECT g.id "
          . "FROM giros_empresariales g "
          . "WHERE 1 = 1 "
          . "    AND g.titulo = :nombre AND g.estado != 'Eliminado';";

    $oConnection = db_connect();
    if (!$oConnection) { return true; }

    mysql_bind($sSql, array('nombre' => $sGiro));
    $oResult = mysql_query($sSql, $oConnection);

    if (! $oResult) { return true; }

    if (mysql_num_rows($oResult) > 0) { return true; }

    return false;
}




function obtener_datos_giroEmpresarial($nGiroId)
{
    $sSql = "SELECT "
          . "    g.* "
          . "FROM giros_empresariales g "
          . "WHERE 1 = 1 "
          . "    AND g.id = :giro_id "
          . "LIMIT 1;";

    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    mysql_bind($sSql, array('giro_id' => $nGiroId));
    
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aGiro = mysql_fetch_array($oResult, MYSQL_ASSOC);
    if (!is_array($aGiro) || empty($aGiro)) { return false; }

    return $aGiro;
}
