<?php
defined('JZ_UPALE')
    or die('Acceso Incorrecto');

function puestos_obtener_listado()
{
    $sSql = "SELECT "
          . "    p.id, p.titulo, p.estado "
          . "    FROM puestos p "
          . "    WHERE 1 = 1 "
          . "        AND p.estado != 'Eliminado'"      
          . "    ORDER BY p.titulo ASC;";

    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aPuestos = array();
    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aPuestos[] = $aRow;
        }
    }
    return $aPuestos;
}



function existe_puestoLaboral($sPuesto)
{
    $sSql = "SELECT p.id "
          . "FROM puestos p "
          . "WHERE 1 = 1 "
          . "    AND p.titulo = :nombre AND p.estado != 'Eliminado';";

    $oConnection = db_connect();
    if (!$oConnection) { return true; }

    mysql_bind($sSql, array('nombre' => $sPuesto));
    $oResult = mysql_query($sSql, $oConnection);

    if (! $oResult) { return true; }

    if (mysql_num_rows($oResult) > 0) { return true; }

    return false;
}


function obtener_datos_puestoLaboral($nPuestoId)
{
    $sSql = "SELECT "
          . "    p.* "
          . "FROM puestos p "
          . "WHERE 1 = 1 "
          . "    AND p.id = :puesto_id "
          . "LIMIT 1;";

    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    mysql_bind($sSql, array('puesto_id' => $nPuestoId));
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aPuesto = mysql_fetch_array($oResult, MYSQL_ASSOC);
    if (!is_array($aPuesto) || empty($aPuesto)) { return false; }

    return $aPuesto;
}
