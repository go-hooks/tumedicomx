<?php
defined('JZ_UPALE')
    or die('Acceso Incorrecto');

function tarifas_obtener_listado_por_empresa($nEmpresaId)
{
    $sSql = "SELECT "
          . "    p.*, DATE_FORMAT(p.created_at, '%d/%m/%Y') AS fecha_creacion "
          . "    FROM propuesta_tarifa p "
          . "    WHERE 1 = 1 "
          . "        AND p.estado != 'Eliminado' AND p.empresa_id = :empresa_id "      
          . "    ORDER BY p.created_at DESC;";
    
    mysql_bind($sSql, array('empresa_id' => $nEmpresaId));
        
    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aTarifas = array();
    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aTarifas[] = $aRow;
        }
    }
    return $aTarifas;
}



function obtener_datos_tarifa($nTarifaId)
{
    $sSql = "SELECT "
          . "    t.*, DATE_FORMAT(t.created_at, '%d/%m/%Y') AS fecha_tarifa "
          . "FROM propuesta_tarifa t "
          . "WHERE 1 = 1 "
          . "    AND t.id = :tarifa_id "
          . "LIMIT 1;";

    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    mysql_bind($sSql, array('tarifa_id' => $nTarifaId));
    
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aTarifa = mysql_fetch_array($oResult, MYSQL_ASSOC);
    if (!is_array($aTarifa) || empty($aTarifa)) { return false; }

    return $aTarifa;
}




function obtener_tarifa_mas_reciente($nEmpresaId)
{
    $sSql = "SELECT t.id AS tarifa_id, t.empresa_id, t.requiere_regulaciones, t.cuales_regulaciones, "
          . " t.cantidad_facturas_embarque, t.cantidad_partidas_embarque, t.condiciones_mercancia,    "
          . " DATE_FORMAT(t.created_at, '%d/%m/%Y') AS fecha_tarifa, "
          . " t.cantidad_carton, t.cantidad_tarima, t.identificador_producto, t.pais_origen, t.requiere_etiquetado, "
          . " t.requiere_manejo_especial, t.cual_manejo, t.porcentaje_embarques, t.empresa_certificada, "
          . " t.revision_origen, t.immex, t.prosec, t.altex, t.ecex, t.brownsville_espacio, t.brownsville_tiempo, "
          . " t.laredo_espacio, t.laredo_tiempo, t.tijuana_espacio, t.tijuana_tiempo, t.requiere_transbordo, "
          . " t.estado "
          . "FROM propuesta_tarifa t "
          . "WHERE 1 = 1 "
          . "    AND t.empresa_id = :empresa_id "
          . "ORDER BY t.id DESC "
          . "LIMIT 1;";
    
    mysql_bind($sSql, array('empresa_id' => $nEmpresaId));

    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aTarifa = mysql_fetch_array($oResult, MYSQL_ASSOC);
    if (!is_array($aTarifa) || empty($aTarifa)) { return false; }

    return $aTarifa;
}



function obtener_datos_propuesta_aduanera($nAduanaId, $nPropuestaId)
{
    $sSql = "SELECT "
          . "    p.* "
          . "FROM propuesta_aduaneras p "
          . "WHERE 1 = 1 "
          . "    AND p.aduana_id = :aduana_id AND p.propuesta_tarifa_id = :propuesta_id "
          . "LIMIT 1;";

    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    mysql_bind($sSql, array('aduana_id' => $nAduanaId, 'propuesta_id' => $nPropuestaId));
        
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aTarifa = mysql_fetch_array($oResult, MYSQL_ASSOC);
    if (!is_array($aTarifa) || empty($aTarifa)) { return false; }

    return $aTarifa;
}


function tarifas_obtener_historial($nTarifaId)
{
    $sSql = "SELECT t.id, t.archivo, t.fecha_respuesta, t.created_at, "
          . " DATE_FORMAT(t.created_at, '%d/%m/%Y') AS fecha_creacion, "
          . " DATE_FORMAT(t.created_at, '%Y-%m-%d') AS fecha "
          . " FROM tarifas_propuesta t "
          . " INNER JOIN propuesta_tarifa p ON p.id = t.propuesta_tarifa_id "
          . " WHERE 1 = 1 "
          . "     AND t.propuesta_tarifa_id = :tarifa_id "      
          . "    ORDER BY t.created_at DESC;";
    
    mysql_bind($sSql, array('tarifa_id' => $nTarifaId));
            
    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aTarifas = array();
    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aTarifas[] = $aRow;
        }
    }
    return $aTarifas;
}


function tarifas_obtener_respuestas_aduanera($nTarifaId)
{
    $sSql = "SELECT t.aprobada, t.leida, t.aduana_id, "
          . " o.nombre AS aduana, "
          . " IF(t.updated_at != NULL, DATE_FORMAT(t.updated_at, '%d/%m/%Y'), '-') AS fecha_aprobacion "
          . " FROM tarifas_aprobar_aduanera t "
          . " INNER JOIN oficinas_aaa o ON o.id = t.aduana_id "
          . " WHERE 1 = 1 "
          . "     AND t.tarifa_propuesta_id = :tarifa_id "      
          . "    ORDER BY o.nombre ASC;";
    
    mysql_bind($sSql, array('tarifa_id' => $nTarifaId));
        
    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aTarifas = array();
    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aTarifas[] = $aRow;
        }
    }
    return $aTarifas;
}





function obtener_datos_tarifa_aprobar($aLlave)
{
    $aLlave = explode('-', $aLlave);
    
    $sSql = "SELECT p.*, "
          . " t.archivo AS archivo_tarifa, t.propuesta_tarifa_id, t.fecha_respuesta, "
          . "e.nombre AS empresa, DATE_FORMAT(p.created_at, '%d/%m/%Y') AS fecha_tarifa, "
          . "DATE_FORMAT(t.created_at, '%Y-%m-%d') AS fecha_archivo, ta.id As tarifa_aprobar_id, "
          . "ta.aprobada "
          . "FROM propuesta_tarifa p "
          . "INNER JOIN tarifas_propuesta t ON t.propuesta_tarifa_id = p.id "
          . "INNER JOIN tarifas_aprobar_aduanera ta ON ta.tarifa_propuesta_id = t.id  "
          . "INNER JOIN empresas e ON e.id = p.empresa_id "
          . "WHERE 1 = 1 "
          . "    AND MD5(ta.id) = :tarifa_id "
          . "    AND MD5(ta.aduana_id) = :aduana_id "
          . "    AND ta.llave = :llave "
          . "LIMIT 1;";

    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    mysql_bind($sSql, array('tarifa_id' => $aLlave[0], 'aduana_id' => $aLlave[1], 'llave' => $aLlave[3]));
        
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aTarifa = mysql_fetch_array($oResult, MYSQL_ASSOC);
    if (!is_array($aTarifa) || empty($aTarifa)) { return false; }
    
    return $aTarifa;
}




function obtener_datos_propuesta_tarifa($nTarifa)
{
    $aLlave = explode('-', $aLlave);
    
    $sSql = "SELECT t.* "
          . "FROM tarifas_aprobar_aduanera t "
          . "WHERE 1 = 1 "
          . "    AND t.id = :tarifa_id "
          . "LIMIT 1;";

    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    mysql_bind($sSql, array('tarifa_id' => $nTarifa));
        
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aTarifa = mysql_fetch_array($oResult, MYSQL_ASSOC);
    if (!is_array($aTarifa) || empty($aTarifa)) { return false; }
    
    return $aTarifa;
}



function obtener_info_tarifa($nTarifaId)
{
    $oConnection = db_connect();
    if (!$oConnection) { return false; }
    
    $sSql = "SELECT t.id, t.archivo, t.fecha_respuesta, t.created_at, "
          . " DATE_FORMAT(t.created_at, '%d/%m/%Y') AS fecha_creacion, "
          . " DATE_FORMAT(t.created_at, '%Y-%m-%d') AS fecha, "
          . " t.propuesta_tarifa_id "
          . " FROM tarifas_propuesta t "
          . " WHERE 1 = 1 "
          . "     AND t.id = :tarifa_id "      
          . "    LIMIT 1;";
    
    mysql_bind($sSql, array('tarifa_id' => $nTarifaId));
            
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aTarifa = mysql_fetch_array($oResult, MYSQL_ASSOC);
    if (!is_array($aTarifa) || empty($aTarifa)) { return false; }
    
    return $aTarifa;
}
