<?php
defined('JZ_UPALE')
    or die('Acceso Incorrecto');

function obtener_municipio_por_id($nMunicipioId)
{
    $sSql = "SELECT "
          . "    m.*, "
          . "    e.nombre AS estado_nombre "
          . "FROM municipios m "
          . "    INNER JOIN estados e "
          . "            ON m.estado_id = e.id "
          . "WHERE 1 = 1 "
          . "    AND m.id = :municipio_id "
          . "LIMIT 1;";

    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    mysql_bind($sSql, array('municipio_id' => $nMunicipioId));
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aMunicipio = mysql_fetch_array($oResult, MYSQL_ASSOC);
    if (!is_array($aMunicipio) || empty($aMunicipio)) { return false; }

    return $aMunicipio;
}

function obtener_select_municipios($nEstadoId)
{
    $sSql = "SELECT "
          . "    m.id AS value, m.nombre AS text "
          . "FROM municipios m "
          . "WHERE 1 = 1 "
          . "    AND m.estado_id = :estado_id "
          . "ORDER BY m.nombre ASC;";

    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    mysql_bind($sSql, array('estado_id' => $nEstadoId));
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aMunicipios = array();
    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aMunicipios[] = $aRow;
        }
    }

    return $aMunicipios;
}

function municipios_obtener_listado($nEstadoId)
{
    $sSql = "SELECT "
          . "    m.id, m.nombre, m.created_at, m.updated_at "
          . "    FROM  municipios AS m "
          . "    WHERE m.estado_id = :estado_id "
          . "    ORDER BY id ASC;";

    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    mysql_bind($sSql, array('estado_id' => $nEstadoId));

    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aMunicipios = array();
    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aMunicipios[] = $aRow;
        }
    }
    return $aMunicipios;
}


function existe_municipio($sMunicipio, $nEstadoId)
{
    $sSql = "SELECT m.id AS total "
          . "FROM municipios m "
          . "WHERE 1 = 1 "
          . "    AND m.nombre = :nombre AND estado_id = :estado_id";

    $oConnection = db_connect();
    if (!$oConnection) { return true; }

    mysql_bind($sSql, array('nombre' => $sMunicipio, 'estado_id' => $nEstadoId));
    $oResult = mysql_query($sSql, $oConnection);

    if (! $oResult) { return true; }

    if (mysql_num_rows($oResult) > 0) { return true; }

    return false;
}
