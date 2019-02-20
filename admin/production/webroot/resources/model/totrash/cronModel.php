<?php
defined('JZ_UPALE')
    or die('Acceso Incorrecto');


function obtener_pagos_a_generarse_hoy($sFecha)
{
    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    $sSql = "SELECT p.id, p.dia_inicial, p.dia_final, p.periodicidad, p.frecuencia_pago, "
          . "p.monto_pagar, p.registro_carnet_menor_id, p.servicio_plan_terapeutico_menor_id,  "
          . "p.aplica_beca, p.monto_beca, p.beca_aprobada, p.fecha_proximo_pago, p.nombre, "
          . "c.menor_id, p.fecha_proximo_pago "
          . "FROM pagos_con_periodicidad p "
          . "INNER JOIN registro_carnet_menores r ON r.id = p.registro_carnet_menor_id "
          . "INNER JOIN carnets_menores c ON c.id = r.carnet_menor_id "
          . "WHERE 1 = 1 "
          . "    AND p.status = 'Activo' "
          . "    AND p.fecha_proximo_pago <= :fecha_actual ";

    mysql_bind($sSql, array('fecha_actual' => $sFecha));
    
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aPagos = array();
    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aPagos[] = $aRow;
        }
    }
    return $aPagos;
}


function obtener_pagos_activos($sFecha)
{
    defined('TERAPIA')
        or define('TERAPIA', 3);
    
    defined('ESTIMULACION_TEMPRANA')
        or define('ESTIMULACION_TEMPRANA', 1);

    $sSql = " SELECT p.id, p.status ,pr.fecha_primer_pago, pr.tipo_periodicidad, "
          . " CONCAT(m.nombre, ' ', m.apell_paterno, ' ', m.apell_materno) AS nombre_menor, "
          . " pr.dia_inicio, pr.dia_final, pr.frecuencia_pago, pr.id AS periodicidad_id, "
          . " p.registro_carnet_menor_id, p.nombre, p.terapeuta, p.descuento_aprobado, "
          . " p.monto_pagar, p.monto_descuento, p.descuento_aprobado, "
          . "    CASE pr.tipo_periodicidad "
          . "        WHEN '1' THEN CONCAT('Cada mes del dia ', pr.dia_inicio, ' al dia ', pr.dia_final) "
          . "        WHEN '2' THEN CONCAT('Cada bimestre del dia ', pr.dia_inicio, ' al dia ', pr.dia_final) "
          . "        WHEN '3' THEN CONCAT('Cada trimestre del dia ', pr.dia_inicio, ' al dia ', pr.dia_final) "
          . "        WHEN '4' THEN CONCAT('El dia ', pr.dia_inicio, ' cada ',  "
          . "            CASE pr.frecuencia_pago "
          . "                WHEN '1' THEN 'mes' "
          . "                WHEN '2' THEN 'bimestre' "
          . "                WHEN '3' THEN 'Trimestre' "
          . "            END)"
          . "    END AS forma_de_pago "
          . " FROM pagos p "
          . " Inner Join periodicidad_pago pr ON pr.pago_id = p.id "
          . " Inner Join registro_carnet_menores r ON r.id = p.registro_carnet_menor_id "
          . " Inner Join carnets_menores c ON c.id = r.carnet_menor_id "
          . " Inner Join menores m ON m.id = c.menor_id "
          . " Inner Join servicios s ON s.id = r.servicio_id "
          . " WHERE 1 = 1 "
          . "     AND s.etapa = :etapa AND s.tratamiento_id = :tratamiento "
          . "     AND m.estado = 'A' "
          . "     AND (pr.fecha_primer_pago = :fecha_actual OR :fecha_actual > pr.fecha_primer_pago ) "
          . "     AND r.estado = 'A' ";

    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    mysql_bind($sSql, array('fecha_actual' => $sFecha, 'etapa' => TERAPIA, 'tratamiento' => ESTIMULACION_TEMPRANA));
    //echo $sSql;

    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aPagos = array();
    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aPagos[] = $aRow;
        }
    }
    return $aPagos;
}



function obtener_pagos_activos_planes_terapeuticos($sFecha)
{
    defined('TERAPIA')
        or define('TERAPIA', 3);

    defined('ESTIMULACION_TEMPRANA')
        or define('ESTIMULACION_TEMPRANA', 1);

    $sSql = " SELECT p.id, p.status ,pr.fecha_primer_pago, pr.tipo_periodicidad, "
          . " CONCAT(m.nombre, ' ', m.apell_paterno, ' ', m.apell_materno) AS nombre_menor, "
          . " pr.dia_inicio, pr.dia_final, pr.frecuencia_pago, pr.id AS periodicidad_id, "
          . " p.registro_carnet_menor_id, p.nombre, p.terapeuta, p.descuento_aprobado, "
          . " pr.monto_por_periodo AS monto_pagar, p.monto_descuento, p.descuento_aprobado, "
          . "    CASE pr.tipo_periodicidad "
          . "        WHEN '1' THEN CONCAT('Cada mes del dia ', pr.dia_inicio, ' al dia ', pr.dia_final) "
          . "        WHEN '2' THEN CONCAT('Cada bimestre del dia ', pr.dia_inicio, ' al dia ', pr.dia_final) "
          . "        WHEN '3' THEN CONCAT('Cada trimestre del dia ', pr.dia_inicio, ' al dia ', pr.dia_final) "
          . "        WHEN '4' THEN CONCAT('El dia ', pr.dia_inicio, ' cada ',  "
          . "            CASE pr.frecuencia_pago "
          . "                WHEN '1' THEN 'mes' "
          . "                WHEN '2' THEN 'bimestre' "
          . "                WHEN '3' THEN 'Trimestre' "
          . "            END)"
          . "    END AS forma_de_pago "
          . " FROM pagos p "
          . " Inner Join periodicidad_pago pr ON pr.pago_id = p.id "
          . " Inner Join registro_carnet_menores r ON r.id = p.registro_carnet_menor_id "
          . " Inner Join carnets_menores c ON c.id = r.carnet_menor_id "
          . " Inner Join menores m ON m.id = c.menor_id "
          . " WHERE 1 = 1 "
          . "     AND m.estado = 'A' "
          . "     AND (pr.fecha_primer_pago = :fecha_actual OR :fecha_actual > pr.fecha_primer_pago ) "
          . "     AND r.estado = 'A' ";

    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    mysql_bind($sSql, array('fecha_actual' => $sFecha, 'etapa' => TERAPIA, 'tratamiento' => ESTIMULACION_TEMPRANA));
    //echo $sSql;

    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aPagos = array();
    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aPagos[] = $aRow;
        }
    }
    return $aPagos;
}





function obtener_calendario_upale()
{
    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    $sql = " SELECT ca.titulo, ca.descripcion, ca.fecha_especifico, ca.dia, "
         . " h.id AS horario_id, h.fecha_inicio AS fecha_evento, h.meses, h.hora, "
         . " h.duracion, c.color, ca.id "
		 . " FROM calendario_administrativo ca "
		 . " INNER JOIN citas c ON ca.cita_id = c.id "
		 . " INNER JOIN horarios h ON h.id = c.horario_id "
         . " WHERE 1 = 1 "
         . "     AND ca.estado != 'E' "
         . "     AND ca.fecha_especifico = '2' "
         . "     AND ca.padre_id IS NULL "
         . "     AND c.estado != 'C' ";
    //echo $sql;

    $oResult = mysql_query($sql, $oConnection);
    if (! $oResult) { return false; }

    $aEventos = array();

    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aEventos[] = $aRow;
        }
    }

    return $aEventos;
                 
}


function obtener_excepciones_evento_upale($nHorarioId, $sFecha)
{
    $oConnection = db_connect();
    if (!$oConnection) { return false; }
    
    $sSql = " SELECT excepcion, tipo "
          . " FROM excepciones_de_horario "
          . " WHERE horario_id = :horario_id "
          . " AND excepcion = :fecha ";

    mysql_bind($sSql, array('horario_id' => $nHorarioId, 'fecha' => $sFecha));

    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aExcepcion = mysql_fetch_array($oResult, MYSQL_ASSOC);
    if(!$aExcepcion) return false;

    return $aExcepcion;
}