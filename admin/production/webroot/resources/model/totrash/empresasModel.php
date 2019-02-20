<?php
defined('JZ_UPALE')
    or die('Acceso Incorrecto');

function empresas_obtener_listado()
{
    if (hasPermission('perm_ver_todas_las_empresas')):
        $restriccion = "";
    else:    
        $restriccion = " AND (IF(gerente_asignado_id IS NULL OR gerente_asignado_id = '0', e.created_by = :usuario_id, "
                     . "           e.gerente_asignado_id = :usuario_id) OR e.gerente_asignado_id = :usuario_id)";
    endif;
        
    $sSql = " SELECT e.id, e.nombre, e.razon_social,  "
          . " e.situacion, e.prioridad, e.motivo_inactividad_id, "
          . " m.titulo AS motivo_de_inactividad, CONCAT('(', d.lada_telefono, ') ', d.telefono_fijo, ' - ext. ', d.extension) AS telefono, "
          . " d.calle, d.numero_exterior, d.numero_interior, d.cp, c.nombre AS colonia, "
          . " d.entre_calles, d.delegacion, mu.nombre AS municipio, es.nombre AS estado_republica  "
          . " FROM empresas e "
          . " LEFT JOIN motivos_inactividad m ON m.id = e.motivo_inactividad_id "  
          . " INNER JOIN domicilios_empresa d ON d.empresa_id = e.id "
          . " INNER JOIN colonias c ON c.id = d.colonia_id "
          . " INNER JOIN municipios mu ON mu.id = c.municipio_id "
          . " INNER JOIN estados es ON es.id = mu.estado_id "
          . " WHERE 1 = 1 "
          . "     AND e.estado != 'Eliminado' AND d.principal = 'SI' {$restriccion} "      
          . " ORDER BY e.created_at DESC, e.nombre ASC LIMIT 0,100;";
    
    $oConnection = db_connect();
    if (!$oConnection) { return false; }
    
    mysql_bind($sSql, array('usuario_id' => $_SESSION['upale_usuario_id']));
        
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aEmpresas = array();
    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aEmpresas[] = $aRow;
        }
    }
    return $aEmpresas;
}




function empresas_obtener_listado_por_asistente($nAsistenteId)
{
    $cadena_usuarios = $nAsistenteId;
    //---->Obtengo los usuarios donde se encuentra asignado este asistente
    $aUsuarios = obtener_listado_usuarios_por_asistente_asignado($nAsistenteId);
    if(!$aUsuarios) $aUsuarios = array();
    
    if(count($aUsuarios) > 0):
        foreach($aUsuarios as $i => $usuario):
            if($cadena_usuarios == ""):
                $cadena_usuarios = $usuario['id'];
            else:
                $cadena_usuarios .= "','" . $usuario['id'];
            endif;
        endforeach;
    endif;
    
    $sSql = " SELECT e.id, e.nombre, e.razon_social,  "
          . " e.situacion, e.prioridad, e.motivo_inactividad_id, "
          . " m.titulo AS motivo_de_inactividad, CONCAT('(', d.lada_telefono, ') ', d.telefono_fijo, ' - ext. ', d.extension) AS telefono, "
          . " d.calle, d.numero_exterior, d.numero_interior, d.cp, c.nombre AS colonia, "
          . " d.entre_calles, d.delegacion, mu.nombre AS municipio, es.nombre AS estado_republica  "
          . " FROM empresas e "
          . " LEFT JOIN motivos_inactividad m ON m.id = e.motivo_inactividad_id "  
          . " INNER JOIN domicilios_empresa d ON d.empresa_id = e.id "
          . " INNER JOIN colonias c ON c.id = d.colonia_id "
          . " INNER JOIN municipios mu ON mu.id = c.municipio_id "
          . " INNER JOIN estados es ON es.id = mu.estado_id "
          . " WHERE 1 = 1 "
          . "     AND e.estado != 'Eliminado' AND d.principal = 'SI' "      
          . "     AND (IF(gerente_asignado_id IS NULL OR gerente_asignado_id = '0', e.created_by IN('{$cadena_usuarios}'), "
          . "              e.gerente_asignado_id IN('{$cadena_usuarios}')) OR e.gerente_asignado_id IN('{$cadena_usuarios}')) "
          . " ORDER BY e.created_at DESC, e.nombre ASC LIMIT 0,100;";
          
    $oConnection = db_connect();
    if (!$oConnection) { return false; }
    
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aEmpresas = array();
    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aEmpresas[] = $aRow;
        }
    }
    return $aEmpresas;
}





function empresas_obtener_listado_por_busqueda_y_por_asistente($nAsistenteId, $busqueda, $situacion, $giro, $servicio)
{
    $restriccion = "";
    
    if(isset($busqueda) && trim($busqueda) != ''):
        $restriccion .= " AND e.nombre LIKE '%".$busqueda."%' ";
    endif;
    
    if(isset($situacion) && trim($situacion) != ''):
        $restriccion .= " AND e.situacion = :situacion ";
    endif;
    
    if(isset($giro) && is_numeric($giro)):
        $restriccion .= " AND ':giro' IN(select giro_id FROM giros_empresa WHERE empresa_id = e.id) ";
    endif;
    
    if(isset($servicio) && is_numeric($servicio)):
        $restriccion .= " AND ':servicio' IN(select servicio_id FROM servicios_empresa WHERE empresa_id = e.id) ";
    endif;
    
    $cadena_usuarios = $nAsistenteId;
    //---->Obtengo los usuarios donde se encuentra asignado este asistente
    $aUsuarios = obtener_listado_usuarios_por_asistente_asignado($nAsistenteId);
    if(!$aUsuarios) $aUsuarios = array();
    
    if(count($aUsuarios) > 0):
        foreach($aUsuarios as $i => $usuario):
            if($cadena_usuarios == ""):
                $cadena_usuarios = $usuario['id'];
            else:
                $cadena_usuarios .= "','" . $usuario['id'];
            endif;
        endforeach;
    endif;
    
    $sSql = " SELECT e.id, e.nombre, e.razon_social,  "
          . " e.situacion, e.prioridad, e.motivo_inactividad_id, "
          . " m.titulo AS motivo_de_inactividad, CONCAT('(', d.lada_telefono, ') ', d.telefono_fijo, ' - ext. ', d.extension) AS telefono, "
          . " d.calle, d.numero_exterior, d.numero_interior, d.cp, c.nombre AS colonia, "
          . " d.entre_calles, d.delegacion, mu.nombre AS municipio, e.nombre AS estado_republica  "
          . " FROM empresas e "
          . " LEFT JOIN motivos_inactividad m ON m.id = e.motivo_inactividad_id "  
          . " INNER JOIN domicilios_empresa d ON d.empresa_id = e.id "
          . " INNER JOIN colonias c ON c.id = d.colonia_id "
          . " INNER JOIN municipios mu ON mu.id = c.municipio_id "
          . " INNER JOIN estados es ON es.id = mu.estado_id "
          . " WHERE 1 = 1 "
          . "     AND e.estado != 'Eliminado' AND d.principal = 'SI' {$restriccion} "
          . "     AND (IF(gerente_asignado_id IS NULL OR gerente_asignado_id = '0', e.created_by IN('{$cadena_usuarios}'), "
          . "              e.gerente_asignado_id IN('{$cadena_usuarios}')) OR e.gerente_asignado_id IN('{$cadena_usuarios}')) "
          . " ORDER BY e.created_at DESC, e.nombre ASC LIMIT 0,100;";
          
    mysql_bind($sSql, array('busqueda'  => $busqueda, 'situacion'  => $situacion));
    mysql_bind($sSql, array('giro'   => $giro, 'servicio'  => $servicio));
              
    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aEmpresas = array();
    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aEmpresas[] = $aRow;
        }
    }
    return $aEmpresas;
}





function empresas_obtener_listado_por_busqueda($busqueda, $situacion, $giro, $servicio)
{
    $restriccion = "";
    
    if(isset($busqueda) && trim($busqueda) != ''):
        $restriccion .= " AND e.nombre LIKE '%".$busqueda."%' ";
    endif;
    
    if(isset($situacion) && trim($situacion) != ''):
        $restriccion .= " AND e.situacion = :situacion ";
    endif;
    
    if(isset($giro) && is_numeric($giro)):
        $restriccion .= " AND ':giro' IN(select giro_id FROM giros_empresa WHERE empresa_id = e.id) ";
    endif;
    
    if(isset($servicio) && is_numeric($servicio)):
        $restriccion .= " AND ':servicio' IN(select servicio_id FROM servicios_empresa WHERE empresa_id = e.id) ";
    endif;
    
    if (!hasPermission('perm_ver_todas_las_empresas')):
        $restriccion .= " AND (IF(gerente_asignado_id IS NULL, e.created_by = :usuario_id, e.gerente_asignado_id = :usuario_id) OR e.gerente_asignado_id = :usuario_id)";
    endif;
    
    $sSql = " SELECT e.id, e.nombre, e.razon_social,  "
          . " e.situacion, e.prioridad, e.motivo_inactividad_id, "
          . " m.titulo AS motivo_de_inactividad, CONCAT('(', d.lada_telefono, ') ', d.telefono_fijo, ' - ext. ', d.extension) AS telefono, "
          . " d.calle, d.numero_exterior, d.numero_interior, d.cp, c.nombre AS colonia, "
          . " d.entre_calles, d.delegacion, mu.nombre AS municipio, e.nombre AS estado_republica  "
          . " FROM empresas e "
          . " LEFT JOIN motivos_inactividad m ON m.id = e.motivo_inactividad_id "  
          . " INNER JOIN domicilios_empresa d ON d.empresa_id = e.id "
          . " INNER JOIN colonias c ON c.id = d.colonia_id "
          . " INNER JOIN municipios mu ON mu.id = c.municipio_id "
          . " INNER JOIN estados es ON es.id = mu.estado_id "
          . " WHERE 1 = 1 "
          . "     AND e.estado != 'Eliminado' AND d.principal = 'SI' {$restriccion} "      
          . " ORDER BY e.created_at DESC, e.nombre ASC LIMIT 0,100;";
          
    mysql_bind($sSql, array('busqueda'  => $busqueda, 'situacion'  => $situacion));
    mysql_bind($sSql, array('giro'   => $giro, 'servicio'  => $servicio));
              
    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aEmpresas = array();
    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aEmpresas[] = $aRow;
        }
    }
    return $aEmpresas;
}



function existe_empresa($sEmpresa)
{
    $sSql = "SELECT e.id "
          . "FROM empresas e "
          . "WHERE 1 = 1 "
          . "    AND e.nombre = :nombre AND e.estado != 'Eliminado';";

    $oConnection = db_connect();
    if (!$oConnection) { return true; }

    mysql_bind($sSql, array('nombre' => $sEmpresa));
    $oResult = mysql_query($sSql, $oConnection);

    if (! $oResult) { return true; }

    if (mysql_num_rows($oResult) > 0) { return true; }

    return false;
}




function obtener_datos_empresa($nEmpresaId)
{
    $sSql = "SELECT "
          . "    e.*, d.id AS domicilio_id, d.calle, d.entre_calles, d.colonia_id, d.numero_interior, "
          . "    d.numero_exterior, d.delegacion, d.cp, d.lada_telefono, d.telefono_fijo, "
          . "    d.extension, es.id AS estado_id, m.id AS municipio_id, es.nombre AS nombre_estado,  "      
          . "    m.nombre AS nombre_municipio, c.nombre AS nombre_colonia, i.titulo AS motivo_de_inactividad, "
          . "    e.sitio_web "
          . "FROM empresas e "
          . "INNER JOIN domicilios_empresa d ON d.empresa_id = e.id "
          . "INNER JOIN colonias c ON c.id = d.colonia_id "
          . "INNER JOIN municipios m ON m.id = c.municipio_id  "
          . "INNER JOIN estados es ON es.id = m.estado_id "
          . "LEFT JOIN motivos_inactividad i ON  i.id = e.motivo_inactividad_id "
          . "WHERE 1 = 1 "
          . "    AND e.id = :empresa_id AND d.principal = 'SI' "
          . "LIMIT 1;";

    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    mysql_bind($sSql, array('empresa_id' => $nEmpresaId));
    
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aEmpresa = mysql_fetch_array($oResult, MYSQL_ASSOC);
    if (!is_array($aEmpresa) || empty($aEmpresa)) { return false; }

    return $aEmpresa;
}



function obtener_domicilios_empresa($nEmpresaId)
{
    $sSql = "SELECT d.*, m.id AS municipio_id, e.id AS estado_id, c.nombre AS colonia, "
          . "m.nombre AS municipio, e.nombre AS estado, d.principal "
          . "FROM domicilios_empresa d "
          . "INNER JOIN colonias c ON c.id = d.colonia_id "
          . "INNER JOIN municipios m on m.id = c.municipio_id "
          . "INNER JOIN estados e ON e.id = m.estado_id "
          . "WHERE d.empresa_id = :empresa_id ";
        
    $oConnection = db_connect();
    if (!$oConnection) { return false; }
    
    mysql_bind($sSql, array('empresa_id' => $nEmpresaId));

    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aDomicilios = array();
    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aDomicilios[] = $aRow;
        }
    }
    return $aDomicilios;
}


function obtener_datos_domicilio_empresa($nDomicilioId)
{
    $sSql = "SELECT d.*, m.id AS municipio_id, e.id AS estado_id, c.nombre AS colonia, "
          . "m.nombre AS municipio, e.nombre AS estado "
          . "FROM domicilios_empresa d "
          . "INNER JOIN colonias c ON c.id = d.colonia_id "
          . "INNER JOIN municipios m on m.id = c.municipio_id "
          . "INNER JOIN estados e ON e.id = m.estado_id "
          . "WHERE d.id = :domicilio_id LIMIT 1 ";
    
    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    mysql_bind($sSql, array('domicilio_id' => $nDomicilioId));
    
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aDomicilio = mysql_fetch_array($oResult, MYSQL_ASSOC);
    if (!is_array($aDomicilio) || empty($aDomicilio)) { return false; }

    return $aDomicilio;
}



function obtener_notas_empresa($nEmpresaId)
{
    $sSql = "SELECT n.*, DATE_FORMAT(n.created_at, '%Y-%m-%d') AS fecha_creacion "
          . "FROM notas_empresa n "
          . "WHERE n.empresa_id = :empresa_id "
          . "    AND n.estado != 'Eliminado' "
          . "ORDER BY n.created_at DESC ";
        
    $oConnection = db_connect();
    if (!$oConnection) { return false; }
    
    mysql_bind($sSql, array('empresa_id' => $nEmpresaId));

    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aNotas = array();
    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aNotas[] = $aRow;
        }
    }
    return $aNotas;
}



function obtener_datos_nota_empresa($notaId)
{
    $sSql = "SELECT n.* "
          . "FROM notas_empresa n "
          . "WHERE n.id = :nota_id LIMIT 1 ";
    
    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    mysql_bind($sSql, array('nota_id' => $notaId));
    
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aNota = mysql_fetch_array($oResult, MYSQL_ASSOC);
    if (!is_array($aNota) || empty($aNota)) { return false; }

    return $aNota;
}




function obtener_archivos_empresa($nEmpresaId)
{
    $sSql = "SELECT a.*, DATE_FORMAT(a.created_at, '%Y-%m-%d') AS fecha_creacion "
          . "FROM archivos_empresa a "
          . "WHERE a.empresa_id = :empresa_id "
          . "ORDER BY a.created_at ";
        
    $oConnection = db_connect();
    if (!$oConnection) { return false; }
    
    mysql_bind($sSql, array('empresa_id' => $nEmpresaId));

    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aRchivos = array();
    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aRchivos[] = $aRow;
        }
    }
    return $aRchivos;
}



function obtener_datos_archivo_empresa($nArchivoId)
{
    $sSql = "SELECT a.*, DATE_FORMAT(a.created_at, '%Y-%m-%d') AS fecha_creacion "
          . "FROM archivos_empresa a "
          . "WHERE a.id = :archivo_id LIMIT 1 ";
    
    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    mysql_bind($sSql, array('archivo_id' => $nArchivoId));
    
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aRchivo = mysql_fetch_array($oResult, MYSQL_ASSOC);
    if (!is_array($aRchivo) || empty($aRchivo)) { return false; }

    return $aRchivo;
}



function verifica_oficina_existente_empresa($nEmpresaId, $nOficinaId)
{
    $oConnection = db_connect();
    if (!$oConnection) { return false; }
    
    $sSql = "SELECT oficina_id "
          . "FROM oficinas_contacto_empresa "
          . "WHERE oficina_id = :oficina_id AND empresa_id = :empresa_id ";
    
    mysql_bind($sSql, array('oficina_id' => $nOficinaId, 'empresa_id' => $nEmpresaId));
    
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }
    
    if (mysql_num_rows($oResult) > 0) {
        return true;
    }
    
    return false;
}



function verifica_servicio_existente_empresa($nEmpresaId, $nServicioId)
{
    $oConnection = db_connect();
    if (!$oConnection) { return false; }
    
    $sSql = "SELECT servicio_id "
          . "FROM servicios_empresa "
          . "WHERE servicio_id = :servicio_id AND empresa_id = :empresa_id ";
    
    mysql_bind($sSql, array('servicio_id' => $nServicioId, 'empresa_id' => $nEmpresaId));
    
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }
    
    if (mysql_num_rows($oResult) > 0) {
        return true;
    }
    
    return false;
}


function verifica_giro_existente_empresa($nEmpresaId, $nGiroId)
{
    $oConnection = db_connect();
    if (!$oConnection) { return false; }
    
    $sSql = "SELECT giro_id "
          . "FROM giros_empresa "
          . "WHERE giro_id = :giro_id AND empresa_id = :empresa_id ";
    
    mysql_bind($sSql, array('giro_id' => $nGiroId, 'empresa_id' => $nEmpresaId));
    
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }
    
    if (mysql_num_rows($oResult) > 0) {
        return true;
    }
    
    return false;
}



function obtener_giros_empresa($nEmpresaId)
{
    $sSql = "SELECT ge.giro_id, ge.empresa_id, g.titulo AS giro_empresarial "
          . "FROM giros_empresa ge "
          . "INNER JOIN giros_empresariales g ON g.id = ge.giro_id "
          . "WHERE ge.empresa_id = :empresa_id "
          . "ORDER BY ge.giro_id ";
        
    $oConnection = db_connect();
    if (!$oConnection) { return false; }
    
    mysql_bind($sSql, array('empresa_id' => $nEmpresaId));
    
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



function obtener_servicios_empresa($nEmpresaId)
{
    $sSql = "SELECT se.servicio_id, se.empresa_id, t.titulo AS tipo_servicio "
          . "FROM servicios_empresa se "
          . "INNER JOIN tipos_servicio t ON t.id = se.servicio_id "
          . "WHERE se.empresa_id = :empresa_id "
          . "ORDER BY se.servicio_id ";
        
    $oConnection = db_connect();
    if (!$oConnection) { return false; }
    
    mysql_bind($sSql, array('empresa_id' => $nEmpresaId));

    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aServicios = array();
    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aServicios[] = $aRow;
        }
    }
    return $aServicios;
}




function obtener_oficinas_aaa_mantiene_contacto_empresa($nEmpresaId)
{
    $sSql = "SELECT oc.oficina_id, oc.empresa_id, o.nombre AS oficina "
          . "FROM oficinas_contacto_empresa oc "
          . "INNER JOIN oficinas_aaa o ON o.id = oc.oficina_id "
          . "WHERE oc.empresa_id = :empresa_id "
          . "ORDER BY o.nombre ";
        
    $oConnection = db_connect();
    if (!$oConnection) { return false; }
    
    mysql_bind($sSql, array('empresa_id' => $nEmpresaId));

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



function empresas_obtener_listado_por_prioridad_alta($nUsuarioId)
{
    if (hasPermission('perm_ver_todas_las_empresas')):
        $restriccion = "";
    else:    
        $restriccion = " AND (IF(gerente_asignado_id IS NULL OR gerente_asignado_id = '0', e.created_by = :usuario_id, "
                     . "           e.gerente_asignado_id = :usuario_id) OR e.gerente_asignado_id = :usuario_id)";
    endif;
    
    $sSql = " SELECT e.id, e.nombre, d.extension, "
          . " e.situacion, e.prioridad, e.motivo_inactividad_id, "
          . " m.titulo AS motivo_de_inactividad, CONCAT('(', d.lada_telefono, ') ', d.telefono_fijo, ' - ext. ') AS telefono,  "
          . " d.calle, d.numero_exterior, d.numero_interior, d.cp, c.nombre AS colonia, "
          . " d.entre_calles, d.delegacion, mu.nombre AS municipio, es.nombre AS estado_republica,  "
          . " DATEDIFF(CONCAT(CURDATE(), ' ',CURTIME()), e.fecha_ultima_actividad) AS total_dias_ultima_accion "  
          . " FROM empresas e "
          . " LEFT JOIN motivos_inactividad m ON m.id = e.motivo_inactividad_id "  
          . " INNER JOIN domicilios_empresa d ON d.empresa_id = e.id "
          . " INNER JOIN colonias c ON c.id = d.colonia_id "
          . " INNER JOIN municipios mu ON mu.id = c.municipio_id "
          . " INNER JOIN estados es ON es.id = mu.estado_id "
          . " WHERE 1 = 1 "
          . "     AND e.situacion = 'Activa' AND e.prioridad = 'Alta' "
          . "     AND e.estado != 'Eliminado' AND d.principal = 'SI' {$restriccion} "
          . " ORDER BY e.created_at DESC, e.nombre ASC LIMIT 0,100;";
    
    $oConnection = db_connect();
    if (!$oConnection) { return false; }
    
    mysql_bind($sSql, array('usuario_id' => $nUsuarioId));

    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aEmpresas = array();
    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aEmpresas[] = $aRow;
        }
    }
    return $aEmpresas;
}




function empresas_obtener_listado_por_prioridad_alta_y_por_asistente($nAsistenteId)
{
    $cadena_usuarios = $nAsistenteId;
    //---->Obtengo los usuarios donde se encuentra asignado este asistente
    $aUsuarios = obtener_listado_usuarios_por_asistente_asignado($nAsistenteId);
    if(!$aUsuarios) $aUsuarios = array();
    
    if(count($aUsuarios) > 0):
        foreach($aUsuarios as $i => $usuario):
            if($cadena_usuarios == ""):
                $cadena_usuarios = $usuario['id'];
            else:
                $cadena_usuarios .= "','" . $usuario['id'];
            endif;
        endforeach;
    endif;
    
    $sSql = " SELECT e.id, e.nombre, d.extension, "
          . " e.situacion, e.prioridad, e.motivo_inactividad_id, "
          . " m.titulo AS motivo_de_inactividad, CONCAT('(', d.lada_telefono, ') ', d.telefono_fijo, ' - ext. ') AS telefono,  "
          . " d.calle, d.numero_exterior, d.numero_interior, d.cp, c.nombre AS colonia, "
          . " d.entre_calles, d.delegacion, mu.nombre AS municipio, es.nombre AS estado_republica,  "
          . " DATEDIFF(CONCAT(CURDATE(), ' ',CURTIME()), e.fecha_ultima_actividad) AS total_dias_ultima_accion "  
          . " FROM empresas e "
          . " LEFT JOIN motivos_inactividad m ON m.id = e.motivo_inactividad_id "  
          . " INNER JOIN domicilios_empresa d ON d.empresa_id = e.id "
          . " INNER JOIN colonias c ON c.id = d.colonia_id "
          . " INNER JOIN municipios mu ON mu.id = c.municipio_id "
          . " INNER JOIN estados es ON es.id = mu.estado_id "
          . " WHERE 1 = 1 "
          . "     AND e.situacion = 'Activa' AND e.prioridad = 'Alta' "
          . "     AND e.estado != 'Eliminado' AND d.principal = 'SI' "
          . "     AND (IF(gerente_asignado_id IS NULL OR gerente_asignado_id = '0', e.created_by IN('{$cadena_usuarios}'), "
          . "              e.gerente_asignado_id IN('{$cadena_usuarios}')) OR e.gerente_asignado_id IN('{$cadena_usuarios}')) "
          . " ORDER BY e.created_at DESC, e.nombre ASC LIMIT 0,100;";
    
    $oConnection = db_connect();
    if (!$oConnection) { return false; }
    
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aEmpresas = array();
    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aEmpresas[] = $aRow;
        }
    }
    return $aEmpresas;
}



function obtener_registro_historial_empresa($nEmpresaId)
{
    $sSql = " SELECT e.nombre AS empresa, h.referencia_id, "
          . " h.id, h.empresa_id, h.tipo, h.titulo, DATE_FORMAT(h.created_at, '%Y-%m-%d') AS fecha_creacion, "  
          . " CONCAT(u.nombre,  ' ', u.apell_paterno, ' ', u.apell_materno) AS agente, "
          . " o.nombre AS aduana "
          . " FROM historial h "
          . " INNER JOIN empresas e ON e.id = h.empresa_id "  
          . " INNER JOIN usuarios u ON u.id = h.created_by "
          . " INNER JOIN oficinas_aaa o ON o.id = u.oficina_id "
          . " WHERE 1 = 1 "
          . "    AND h.empresa_id = :empresa_id "
          . " ORDER BY h.created_at DESC; ";
    
    $oConnection = db_connect();
    if (!$oConnection) { return false; }
    
    mysql_bind($sSql, array('empresa_id' => $nEmpresaId));
    
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aHistorial = array();
    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aHistorial[] = $aRow;
        }
    }
    return $aHistorial;
}




function obtener_datos_empresa_asignada($nEmpresaId, $nUsuarioId)
{
    /*
     * Verifico que la empresa que se solicita su información pertenezca a el usuario que la esta
     * solicitando
     */
    
    if (hasPermission('perm_ver_todas_las_empresas')):
        $restriccion = "";
    else:
        if($_SESSION['upale_usuario_departamento'] == 27):
            $cadena_usuarios = $nAsistenteId;
            //---->Obtengo los usuarios donde se encuentra asignado este asistente
            $aUsuarios = obtener_listado_usuarios_por_asistente_asignado($nAsistenteId);
            if(!$aUsuarios) $aUsuarios = array();

            if(count($aUsuarios) > 0):
                foreach($aUsuarios as $i => $usuario):
                    if($cadena_usuarios == ""):
                        $cadena_usuarios = $usuario['id'];
                    else:
                        $cadena_usuarios .= "','" . $usuario['id'];
                    endif;
                endforeach;
            endif;

            $restriccion = " AND (IF(gerente_asignado_id IS NULL OR gerente_asignado_id = '0', e.created_by IN('{$cadena_usuarios}'), "
                         . "         e.gerente_asignado_id IN('{$cadena_usuarios}')) OR e.gerente_asignado_id IN('{$cadena_usuarios}')) ";

        else:    
            $restriccion = " AND (IF(gerente_asignado_id IS NULL OR gerente_asignado_id = '0', e.created_by = :usuario_id, "
                         . "           e.gerente_asignado_id = :usuario_id) OR e.gerente_asignado_id = :usuario_id)";
        endif;
    endif;
    
    $sSql = "SELECT "
          . "    e.*, d.id AS domicilio_id, d.calle, d.entre_calles, d.colonia_id, d.numero_interior, "
          . "    d.numero_exterior, d.delegacion, d.cp, d.lada_telefono, d.telefono_fijo, "
          . "    d.extension, es.id AS estado_id, m.id AS municipio_id, es.nombre AS nombre_estado,  "      
          . "    m.nombre AS nombre_municipio, c.nombre AS nombre_colonia, i.titulo AS motivo_de_inactividad, "
          . "    e.sitio_web "
          . "FROM empresas e "
          . "INNER JOIN domicilios_empresa d ON d.empresa_id = e.id "
          . "INNER JOIN colonias c ON c.id = d.colonia_id "
          . "INNER JOIN municipios m ON m.id = c.municipio_id  "
          . "INNER JOIN estados es ON es.id = m.estado_id "
          . "LEFT JOIN motivos_inactividad i ON  i.id = e.motivo_inactividad_id "
          . "WHERE 1 = 1 "
          . "    AND e.id = :empresa_id AND d.principal = 'SI' {$restriccion} "
          . "LIMIT 1;";

    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    mysql_bind($sSql, array('empresa_id' => $nEmpresaId, 'usuario_id' => $nUsuarioId));
        
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aEmpresa = mysql_fetch_array($oResult, MYSQL_ASSOC);
    if (!is_array($aEmpresa) || empty($aEmpresa)) { return false; }

    return $aEmpresa;
}



function obtener_listado_reuniones_a_ejecutarse_empresa($nEmpresaId, $sFecha, $sMotivo)
{
    $sSql = " SELECT a.descripcion, DATE_FORMAT(h.fecha_evento, '%d/%m/%Y') AS fecha, a.id,  "
          . " DATE_FORMAT(DATE_ADD(CONCAT(h.fecha_evento,' ',h.hora_evento),INTERVAL 0 MINUTE), '%H:%i') AS hora_fecha, "
          . " a.fue_concretada, h.fecha_evento, h.fecha_vencimiento, a.direccion,  "          
          . " a.latitud, a.longitud, "
          . " CASE a.motivo  "
          . "     WHEN 'reunion' THEN CONCAT('Reunión', ' - ',r.titulo, ' ',e.nombre) "   
          . "     WHEN 'llamada' THEN CONCAT('Llamada', ' - ',l.titulo, ' ',e.nombre) "
          . "     WHEN 'tarea' THEN CONCAT('Tarea', ' - ',t.titulo, ' ',e.nombre) "
          . " END AS titulo "
          . " FROM agenda a "
          . " INNER JOIN empresas e ON e.id = a.empresa_id "  
          . " INNER JOIN horarios h ON h.id = a.horario_id "
          . " LEFT JOIN tareas t ON t.id = a.tipo_tarea_id "
          . " LEFT JOIN reuniones r ON r.id = a.tipo_reunion_id "
          . " LEFT JOIN llamadas l ON l.id = a.tipo_llamada_id "
          . " WHERE 1 = 1 "
          . "    AND a.empresa_id = :empresa_id "
          . "    AND h.fecha_evento >= :fecha "
          . "    AND a.motivo = :motivo "
          . " ORDER BY a.created_at DESC; ";
    
    $oConnection = db_connect();
    if (!$oConnection) { return false; }
    
    mysql_bind($sSql, array('empresa_id' => $nEmpresaId, 'fecha'  => $sFecha, 'motivo' => $sMotivo));
        
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aReuniones = array();
    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aReuniones[] = $aRow;
        }
    }
    return $aReuniones;
}