<?php
defined('JZ_UPALE')
    or die('Acceso Incorrecto');

function motivosDeStatus_obtener_listado()
{
    $sSql = "SELECT "
          . "    m.id, m.nombre, m.estado, "
          . "    CASE m.situacion "
          . "        WHEN 'activo' THEN 'Al cambiar de cualquier status a activo' "  
          . "        WHEN 'cliente' THEN 'Al cambiar de cualquier status a cliente' "     
          . "    END AS motivo "
          . "    FROM motivos_status_empresa m "
          . "    WHERE 1 = 1 "
          . "        AND m.estado != 'Eliminado'"      
          . "    ORDER BY m.nombre ASC;";

    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aMotivos = array();
    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aMotivos[] = $aRow;
        }
    }
    return $aMotivos;
}




function existe_motivoDeStatus($sMotivo)
{
    $sSql = "SELECT m.id "
          . "FROM motivos_status_empresa m "
          . "WHERE 1 = 1 "
          . "    AND m.nombre = :nombre AND m.estado != 'Eliminado';";

    $oConnection = db_connect();
    if (!$oConnection) { return true; }

    mysql_bind($sSql, array('nombre' => $sMotivo));
    $oResult = mysql_query($sSql, $oConnection);

    if (! $oResult) { return true; }

    if (mysql_num_rows($oResult) > 0) { return true; }

    return false;
}



function obtener_datos_motivoDeStatus($nMotivoId)
{
    $sSql = "SELECT "
          . "    m.* "
          . "FROM motivos_status_empresa m "
          . "WHERE 1 = 1 "
          . "    AND m.id = :motivo_id "
          . "LIMIT 1;";

    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    mysql_bind($sSql, array('motivo_id' => $nMotivoId));
    
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aMotivo = mysql_fetch_array($oResult, MYSQL_ASSOC);
    if (!is_array($aMotivo) || empty($aMotivo)) { return false; }

    return $aMotivo;
}



function obtener_motivos_por_situacion($situacion)
{
    $sSql = "SELECT "
          . "    m.id, m.nombre, m.estado, "
          . "    CASE m.situacion "
          . "        WHEN 'activo' THEN 'Al cambiar de cualquier status a activo' "  
          . "        WHEN 'cliente' THEN 'Al cambiar de cualquier status a cliente' "     
          . "    END AS motivo "
          . "    FROM motivos_status_empresa m "
          . "    WHERE 1 = 1 "
          . "        AND m.estado = 'Activo'"      
          . "        AND m.situacion = :situacion "  
          . "    ORDER BY m.nombre ASC;";
    
    mysql_bind($sSql, array('situacion' => $situacion));

    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aMotivos = array();
    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aMotivos[] = $aRow;
        }
    }
    return $aMotivos;
}