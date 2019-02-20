<?php
defined('JZ_UPALE')
    or die('Acceso Incorrecto');

function obtener_correo_de_presentacion()
{
    $sSql = "SELECT "
          . "    c.* "
          . "FROM correo_presentacion c "
          . "WHERE 1 = 1 "
          . "    AND c.id = '1' "
          . "LIMIT 1;";

    $oConnection = db_connect();
    if (!$oConnection) { return false; }
    
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aCorreo = mysql_fetch_array($oResult, MYSQL_ASSOC);
    if (!is_array($aCorreo) || empty($aCorreo)) { return false; }

    return $aCorreo;
}


function obtener_datos_correo_presentacion($nCorreoId)
{
    $sSql = "SELECT "
          . "    c.* "
          . "FROM correo_presentacion c "
          . "WHERE 1 = 1 "
          . "    AND c.id = :correo_id "
          . "LIMIT 1;";

    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    mysql_bind($sSql, array('correo_id' => $nCorreoId));
    
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aCorreo = mysql_fetch_array($oResult, MYSQL_ASSOC);
    if (!is_array($aCorreo) || empty($aCorreo)) { return false; }

    return $aCorreo;
}