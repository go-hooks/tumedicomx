<?php
defined('JZ_UPALE')
    or die('Acceso Incorrecto');

function obtener_select_colonias($nMunicipioId)
{
    $sSql = "SELECT "
          . "    c.id AS value, c.nombre AS text "
          . "FROM colonias c "
          . "WHERE 1 = 1 "
          . "    AND c.municipio_id = :municipio_id "
          . "ORDER BY c.nombre ASC;";

    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    mysql_bind($sSql, array('municipio_id' => $nMunicipioId));
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aColonias = array();
    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aColonias[] = $aRow;
        }
    }

    return $aColonias;
}

/*
 * funcion para obtener el listado de colonias pertenecientes a un municipio
 */
function colonias_obtener_listado($nMunicipioId)
{
    $sSql = "SELECT "
          . "    c.*, "
          . "    m.nombre AS municipio_nombre "
          . "FROM colonias c "
          . "    INNER JOIN municipios m ON m.id = c.municipio_id "
          . "WHERE 1 = 1 "
          . "    AND c.municipio_id = :municipio_id "
          . "ORDER BY c.nombre ASC;";
     
     $oConnection = db_connect();
     if (!$oConnection) { return false; }

     mysql_bind($sSql, array('municipio_id' => $nMunicipioId));
     
     $oResult = mysql_query($sSql, $oConnection);
     if (! $oResult) { return false; }

     $aColonias = array();
     if (mysql_num_rows($oResult) > 0) {
         while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
             $aColonias[] = $aRow;
         }
     }
     return $aColonias;
}

/*
 * Funcion para obtener informacion de una colonia en especifico
 */
function obtener_colonia_por_id($nColoniaId)
{
    $sSql = "SELECT "
          . "    c.*, "
          . "    m.nombre AS municipio_nombre "
          . "FROM colonias c "
          . "    INNER JOIN municipios m ON m.id = c.municipio_id "
          . "WHERE 1 = 1 "
          . "    AND c.id = :colonia_id "
          . "LIMIT 1";

    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    mysql_bind($sSql, array('colonia_id' => $nColoniaId));
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aColonia = mysql_fetch_array($oResult, MYSQL_ASSOC);
    if (!is_array($aColonia) || empty($aColonia)) { return false; }

    return $aColonia;
}

function existe_colonia($sColonia , $nMunicipioId)
{
    $sSql = "SELECT c.id AS total "
          . "FROM colonias c "
          . "WHERE 1 = 1 "
          . "    AND c.nombre = :nombre AND municipio_id = :municipio_id";

    $oConnection = db_connect();
    if (!$oConnection) { return true; }

    mysql_bind($sSql, array('nombre' => $sColonia, 'municipio_id' => $nMunicipioId));
    $oResult = mysql_query($sSql, $oConnection);

    if (! $oResult) { return true; }

    if (mysql_num_rows($oResult) > 0) { return true; }

    return false;
}