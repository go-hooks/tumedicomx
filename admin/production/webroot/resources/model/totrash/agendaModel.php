<?php
defined('JZ_UPALE')
    or die('Acceso Incorrecto');


function getNameMonth($mes) {
    switch ($mes) {
      case 1:  $nombre_mes="Enero";      break;
      case 2:  $nombre_mes="Febrero";    break;
      case 3:  $nombre_mes="Marzo";      break;
      case 4:  $nombre_mes="Abril";      break;
      case 5:  $nombre_mes="Mayo";       break;
      case 6:  $nombre_mes="Junio";      break;
      case 7:  $nombre_mes="Julio";      break;
      case 8:  $nombre_mes="Agosto";     break;
      case 9:  $nombre_mes="Septiembre"; break;
      case 10: $nombre_mes="Octubre";    break;
      case 11: $nombre_mes="Noviembre";  break;
      case 12: $nombre_mes="Diciembre";  break;
    }
    return $nombre_mes;
}


function getNameDay($dia) {
    switch ($dia){
      case 1: $nombre_mes = "Lunes";     break;
      case 2: $nombre_mes = "Martes";    break;
      case 3: $nombre_mes = "Mi&eacute;rcoles"; break;
      case 4: $nombre_mes = "Jueves";    break;
      case 5: $nombre_mes = "Viernes";   break;
      case 6: $nombre_mes = "S&aacute;bado";    break;
      case 7: $nombre_mes = "Domingo";   break;
      default:
        $nombre_mes = "No valido";
    }
    return $nombre_mes;
}


function calcula_numero_dia_semana($dia, $mes, $ano) {
    $numerodiasemana = date('N', mktime(0,0,0,$mes,$dia,$ano));
    return $numerodiasemana;
}


function calcula_numero_mes_binario($mes) {
    if($mes == 1):
        $mes_binario = $mes;
    else:    
        $mes_binario = pow(2, $mes - 1);
    endif;
    
    return $mes_binario;
}


function obtener_agenda_de_usuario($mktime, $usuario_id) {
    $vec_result = obtener_eventos_personales($mktime, $usuario_id);
    return $vec_result;
}


function obtener_agenda_del_dia($mktime, $usuario_id)
{
    $oConnection = db_connect();
    if (!$oConnection) { return false; }    
    
    list($dia, $mes, $anio, $hora, $min, $seg) = explode('-', date('d-n-Y-H-i-s', $mktime));
    $dia_semana = calcula_numero_dia_semana($dia, $mes, $anio);
    $mes_binario = calcula_numero_mes_binario($mes);
    
    if($dia_semana == 7):
        $dia_binario = 1;
    else:    
        $dia_binario = pow(2, $dia_semana);
    endif;
    
    
    $fecha_actual = date('Y-m-d', $mktime);
    
    $sql = " SELECT a.descripcion, a.usuario_id, a.created_by, "
         . " DATE_FORMAT(DATE_ADD(CONCAT(h.fecha_evento,' ',h.hora_evento),INTERVAL 0 MINUTE), '%H:%i') AS hora_fecha, "
         . " a.id, a.estado AS ap_estado, h.id As horario_id, h.fecha_evento, h.fecha_vencimiento, "
         . " TIME_FORMAT(h.hora_evento, '%h:%i') AS horario, h.hora_evento, HOUR(h.hora_evento) AS hora,"
         . " MINUTE(h.hora_evento) AS minuto, h.dias, "
         . " IF((h.fecha_evento = CURDATE()) && (CURTIME() >= h.hora_evento) && (TIME(NOW()) < ADDTIME(h.hora_evento, '00:30:00')), 1, 0) AS es_ahora, "
	 . " IF((h.fecha_evento = CURDATE() && CURTIME() >= ADDTIME(h.hora_evento, '00:30:00')) || (CURDATE() > h.fecha_evento), 1, 0) AS ha_expirado "
	 . " FROM agenda a "
	 . " INNER JOIN horarios h ON h.id = a.horario_id "
         . " WHERE 1 = 1 "
         . "     AND a.estado != 'Eliminado' "
         . "     AND (a.usuario_id = :usuario_id "
         . "         OR usuario_id IN(SELECT participante_id FROM participantes_cita WHERE agenda_id = a.id AND tipo_participante = 'agente') "
         . "         OR a.cita_tercero_id = :usuario_id "
         . "     ) "
         . "     AND IF(h.misma_fecha_vencimiento = 'NO' AND h.fecha_vencimiento != h.fecha_evento,  "
         . "         ((h.dias & :dia_hoy) = :dia_hoy && :fecha_inicio >= h.fecha_evento && :fecha_inicio <= h.fecha_vencimiento), h.fecha_evento = :fecha_inicio "
         . "     )";
    
    mysql_bind($sql, array('usuario_id' => $usuario_id, 'fecha_inicio' => $fecha_actual));
    mysql_bind($sql, array('dia_hoy' => $dia_binario));
    //echo $sql;
    
    $oResult = mysql_query($sql, $oConnection);
    if (! $oResult) { return false; }

    $vec_result = array();
    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $key = mktime($hora, $row['minuto'], 0, $mes, $dia, $anio);
            $vec_result[] = $aRow;
        }
    }
    
    return $vec_result;
}


function obtener_eventos_personales($mktime, $usuario_id)
{
    $oConnection = db_connect();
    if (!$oConnection) { return false; }    
    
    list($dia, $mes, $anio, $hora, $min, $seg) = explode('-', date('d-n-Y-H-i-s', $mktime));
    $dia_semana = calcula_numero_dia_semana($dia, $mes, $anio);
    $mes_binario = calcula_numero_mes_binario($mes);
    
    if($dia_semana == 7):
        $dia_binario = 1;
    else:    
        $dia_binario = pow(2, $dia_semana);
    endif;
    
    
    $fecha_actual = date('Y-m-d', $mktime);
    
    $sql = " SELECT a.descripcion, a.usuario_id, a.created_by, "
         . " DATE_FORMAT(DATE_ADD(CONCAT(h.fecha_evento,' ',h.hora_evento),INTERVAL 0 MINUTE), '%H:%i') AS hora_fecha, "
         . " a.id, a.estado AS ap_estado, h.id As horario_id, h.fecha_evento, h.fecha_vencimiento, "
         . " TIME_FORMAT(h.hora_evento, '%h:%i') AS horario, h.hora_evento, HOUR(h.hora_evento) AS hora,"
         . " MINUTE(h.hora_evento) AS minuto, h.dias, "
         . " CASE a.motivo  "
         . "     WHEN 'reunion' THEN CONCAT(a.motivo, ' - ',r.titulo) "   
         . "     WHEN 'llamada' THEN CONCAT(a.motivo, ' - ',l.titulo) "
         . "     WHEN 'tarea' THEN CONCAT(a.motivo, ' - ',t.titulo) "
         . " END AS titulo, "
         . " IF((h.fecha_evento = CURDATE()) && (CURTIME() >= h.hora_evento) && (TIME(NOW()) < ADDTIME(h.hora_evento, '00:30:00')), 1, 0) AS es_ahora, "
	 . " IF((h.fecha_evento = CURDATE() && CURTIME() >= ADDTIME(h.hora_evento, '00:30:00')) || (CURDATE() > h.fecha_evento), 1, 0) AS ha_expirado "
	 . " FROM agenda a "
	 . " INNER JOIN horarios h ON h.id = a.horario_id "
         . " LEFT JOIN tareas t ON t.id = a.tipo_tarea_id "
         . " LEFT JOIN reuniones r ON r.id = a.tipo_reunion_id "
         . " LEFT JOIN llamadas l ON l.id = a.tipo_llamada_id "
         . " WHERE 1 = 1 "
         . "     AND a.estado != 'Eliminado' "
         . "     AND (a.usuario_id = :usuario_id "
         . "         OR usuario_id IN(SELECT participante_id FROM participantes_cita WHERE agenda_id = a.id AND tipo_participante = 'agente') "
         . "         OR a.cita_tercero_id = :usuario_id "
         . "     ) "
         . "     AND CONCAT(':hora', ':00') < DATE_FORMAT(DATE_ADD(CONCAT(h.fecha_evento,' ',h.hora_evento),INTERVAL 1 MINUTE), '%H:%i') "
         . "     AND IF(h.misma_fecha_vencimiento = 'NO' AND h.fecha_vencimiento != h.fecha_evento,  "
         . "         ((h.dias & :dia_hoy) = :dia_hoy && :fecha_inicio >= h.fecha_evento && :fecha_inicio <= h.fecha_vencimiento), h.fecha_evento = :fecha_inicio "
         . "     )"
         . "     AND (HOUR(h.hora_evento) = :hora OR (:hora BETWEEN HOUR(h.hora_evento) AND DATE_FORMAT(DATE_ADD(CONCAT(h.fecha_evento,' ',h.hora_evento),INTERVAL 1 MINUTE), '%H')))";
    
    mysql_bind($sql, array('usuario_id' => $usuario_id, 'hora' => $hora, 'fecha_inicio' => $fecha_actual));
    mysql_bind($sql, array('mes_hoy'   =>$mes_binario, 'dia_hoy' => $dia_binario));
    //echo $sql;
    
    $oResult = mysql_query($sql, $oConnection);
    if (! $oResult) { return false; }

    $vec_result = array();
    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $key = mktime($hora, $row['minuto'], 0, $mes, $dia, $anio);
            $vec_result[$key][] = $aRow;
        }
    }
    
    return $vec_result;
}



function ultimoDia($mes,$ano) {
    $ultimo_dia=28;
    while (checkdate($mes,$ultimo_dia + 1,$ano)){
        $ultimo_dia++;
    }
    return $ultimo_dia;
}


function obtener_evento_por_id($usuario_id, $nEventoId)
{
    $oConnection = db_connect();
    if (!$oConnection) { return false; }    
    
    $sql = " SELECT a.descripcion, a.usuario_id, a.direccion, a.latitud, a.longitud, "
         . " DATE_FORMAT(DATE_ADD(CONCAT(h.fecha_evento,' ',h.hora_evento),INTERVAL 0 MINUTE), '%H:%i') AS hora_fecha, "
         . " a.id, a.estado AS ap_estado, h.id As horario_id, h.fecha_evento, h.fecha_vencimiento, "
         . " TIME_FORMAT(h.hora_evento, '%h:%i') AS horario, h.hora_evento, HOUR(h.hora_evento) AS hora,"
         . " MINUTE(h.hora_evento) AS minuto, h.dias, "
         . " CASE a.motivo  "
         . "     WHEN 'reunion' THEN CONCAT(a.motivo, ' - ',r.titulo) "   
         . "     WHEN 'llamada' THEN CONCAT(a.motivo, ' - ',l.titulo) "
         . "     WHEN 'tarea' THEN CONCAT(a.motivo, ' - ',t.titulo) "
         . " END AS titulo, "
         . " IF((h.fecha_evento = CURDATE()) && (CURTIME() >= h.hora_evento) && (TIME(NOW()) < ADDTIME(h.hora_evento, '00:30:00')), 1, 0) AS es_ahora, "
	 . " IF((h.fecha_evento = CURDATE() && CURTIME() >= ADDTIME(h.hora_evento, '00:30:00')) || (CURDATE() > h.fecha_evento), 1, 0) AS ha_expirado, "
         . " h.fecha_evento, h.hora_evento, h.misma_fecha_vencimiento, a.tipo_cita, a.cita_tercero_id, a.motivo, "
         . " a.empresa_id, e.nombre AS empresa "
	 . " FROM agenda a "
	 . " INNER JOIN horarios h ON h.id = a.horario_id "
         . " LEFT JOIN tareas t ON t.id = a.tipo_tarea_id "
         . " LEFT JOIN reuniones r ON r.id = a.tipo_reunion_id "
         . " LEFT JOIN llamadas l ON l.id = a.tipo_llamada_id "
         . " INNER JOIN empresas e ON e.id = a.empresa_id "
         . " WHERE 1 = 1 "
         . "     AND a.estado != 'Eliminado' "
         . "     AND (a.usuario_id = :usuario_id "
         . "         OR usuario_id IN(SELECT participante_id FROM participantes_cita WHERE agenda_id = a.id AND tipo_participante = 'agente') "
         . "         OR a.cita_tercero_id = :usuario_id "            
         . "     ) "
         .  "    AND a.id = :agenda_id ";
    
    mysql_bind($sql, array('usuario_id' => $usuario_id, 'agenda_id' => $nEventoId));
        
    $oResult = mysql_query($sql, $oConnection);
    if (! $oResult) { return false; }

    $aEvento = mysql_fetch_array($oResult, MYSQL_ASSOC);
    if (!is_array($aEvento) || empty($aEvento)) { return false; }

    return $aEvento;
}



function agenda_obtener_observaciones($nAgendaId)
{
    $sSql = "SELECT "
          . " a.id, a.comentario, a.fecha, a.agenda_id, "
          . " CONCAT(u.nombre, ' ', u.apell_paterno, ' ', u.apell_materno) AS creador_nota "
          . " FROM  anotaciones a "
          . " INNER JOIN usuarios u ON u.id = a.created_by "
          . " WHERE a.agenda_id = :agenda_id "
          . " ORDER BY id ASC;";

    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    mysql_bind($sSql, array('agenda_id' => $nAgendaId));
    
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aNotaciones = array();
    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aNotaciones[] = $aRow;
        }
    }
    return $aNotaciones;
}




function agenda_obtener_participantes($nAgendaId, $tipo = NULL)
{
    $sSql = "SELECT "
          . " p.participante_id, p.agenda_id, p.email_otro_participante, p.tipo_participante, "
          . " CONCAT(u.nombre, ' ', u.apell_paterno, ' ', u.apell_materno) AS participante_agente, u.email, "
          . " CONCAT(c.nombre,' ', c.apellidos) AS participante_empresa "
          . " FROM  participantes_cita p "
          . " LEFT JOIN usuarios u ON u.id = p.participante_id "
          . " LEFT JOIN contactos_empresa c ON c.id = p.participante_id "
          . " WHERE p.agenda_id = :agenda_id ";
    
    if($tipo != NULL):
        $sSql .= " AND p.tipo_participante = :tipo ";
    endif;
          

    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    mysql_bind($sSql, array('agenda_id' => $nAgendaId, 'tipo' => $tipo));
        
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aParticipantes = array();
    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aParticipantes[] = $aRow;
        }
    }
    return $aParticipantes;
}




function agenda_obtener_notificantes($nAgendaId)
{
    $sSql = "SELECT "
          . " email, agenda_id "
          . " FROM notificados "
          . " WHERE agenda_id = :agenda_id ";
          

    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    mysql_bind($sSql, array('agenda_id' => $nAgendaId));
        
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aNotificantes = array();
    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aNotificantes[] = $aRow;
        }
    }
    return $aNotificantes;
}


function agenda_obtener_contactos_empresa_sin_asignar($nAgendaId)
{
    $sSql = "SELECT c.* "
          . "FROM contactos_empresa c "
          . "WHERE 1 = 1 "
          . "    AND c.empresa_id = :empresa_id AND estado != 'Eliminado' "
          . "    AND c.id NOT IN(SELECT participante_id FROM participantes_cita WHERE agenda_id = :agenda_id "
          . "        AND tipo_participante = 'empresa' AND participante_id IS NOT NULL) ";
 
    $oConnection = db_connect();
    if (!$oConnection) { return false; }
    
    mysql_bind($sSql, array('empresa_id' => $nEmpresaId));

    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aContactos = array();
    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aContactos[] = $aRow;
        }
    }
    return $aContactos;
}


function obtener_excepciones_horario($nHorarioId)
{
    $oConnection = db_connect();
    if (!$oConnection) { return false; }
    
    $sSql = "SELECT fecha, horario_id "
          . "FROM excepciones_horario "
          . "WHERE horario_id = :horario_id ";
    
    mysql_bind($sSql, array('horario_id' => $nHorarioId));
    
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aExcepciones = array();
    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aExcepciones[] = $aRow;
        }
    }
    return $aExcepciones;
}


function verifica_existencia_participante($ParticipanteId, $nAgendaId, $tipo)
{
    $oConnection = db_connect();
    if (!$oConnection) { return false; }
    
    if($tipo == 'empresa'):
        if(is_numeric($ParticipanteId)):
            $sSql = "SELECT * "
                  . "FROM participantes_cita "
                  . "WHERE participante_id = :participante AND agenda_id = :agenda_id "
                  . "    AND tipo_participante = 'empresa' ";
        else:    
            $sSql = "SELECT * "
                  . "FROM participantes_cita "
                  . "WHERE email_otro_participante = :participante AND agenda_id = :agenda_id "
                  . "    AND tipo_participante = 'empresa' ";
        endif;
    else:   
        $sSql = "SELECT * "
              . "FROM participantes_cita "
              . "WHERE participante_id = :participante AND agenda_id = :agenda_id "
              . "    AND tipo_participante = 'agente' ";
    endif;    
    
    mysql_bind($sSql, array('participante_id' => $ParticipanteId, 'agenda_id' => $nAgendaId));
        
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    if(mysql_num_rows($oResult) > 0)
        return true;

    return false;
}





function obtener_citas_del_dia_por_clasificacion($sMotivo, $nUsuarioId)
{
    $oConnection = db_connect();
    if (!$oConnection) { return false; }    
    
    list($dia, $mes, $anio, $hora, $min, $seg) = explode('-', date('d-n-Y-H-i-s'));
    $dia_semana = calcula_numero_dia_semana($dia, $mes, $anio);
    $fecha_actual = date('Y-m-d');
    
    if($dia_semana == 7):
        $dia_binario = 1;
    else:    
        $dia_binario = pow(2, $dia_semana);
    endif;
    
    $sql = " SELECT a.descripcion, a.usuario_id, a.direccion, a.latitud, a.longitud, "
         . " DATE_FORMAT(DATE_ADD(CONCAT(h.fecha_evento,' ',h.hora_evento),INTERVAL 0 MINUTE), '%H:%i') AS hora_fecha, "
         . " a.id, a.estado AS ap_estado, h.id As horario_id, h.fecha_evento, h.fecha_vencimiento, "
         . " TIME_FORMAT(h.hora_evento, '%h:%i') AS horario, h.hora_evento, HOUR(h.hora_evento) AS hora,"
         . " MINUTE(h.hora_evento) AS minuto, h.dias, IF(DATE_FORMAT(h.hora_evento, '%H') >= 12, 'pm', 'am') AS turno, "
         . " IF((h.fecha_evento = CURDATE()) && (CURTIME() >= h.hora_evento) && (TIME(NOW()) < ADDTIME(h.hora_evento, '00:30:00')), 1, 0) AS es_ahora, "
	 . " IF((h.fecha_evento = CURDATE() && CURTIME() >= ADDTIME(h.hora_evento, '00:30:00')) || (CURDATE() > h.fecha_evento), 1, 0) AS ha_expirado, "
         . " h.fecha_evento, h.hora_evento, h.misma_fecha_vencimiento, a.tipo_cita, a.cita_tercero_id, a.motivo, "
         . " a.empresa_id, t.titulo AS tarea "
	 . " FROM agenda a "
	 . " INNER JOIN horarios h ON h.id = a.horario_id "
         . " LEFT JOIN tareas t ON t.id = a.tarea_id "  
         . " WHERE 1 = 1 "
         . "     AND a.estado != 'Eliminado' "
         . "     AND (a.usuario_id = :usuario_id "
         . "         OR usuario_id IN(SELECT participante_id FROM participantes_cita WHERE agenda_id = a.id AND tipo_participante = 'agente') "
         . "         OR a.cita_tercero_id = :usuario_id "        
         . "     ) "
         . "     AND IF(h.misma_fecha_vencimiento = 'NO' AND h.fecha_vencimiento != h.fecha_evento,  "
         . "         ((h.dias & :dia_hoy) = :dia_hoy && :fecha_inicio >= h.fecha_evento && :fecha_inicio <= h.fecha_vencimiento), h.fecha_evento = :fecha_inicio "
         . "     )"
         .  "    AND a.motivo = :motivo ";
    
    mysql_bind($sql, array('usuario_id' => $nUsuarioId, 'motivo' => $sMotivo, 'dia_hoy' => $dia_binario, 'fecha_inicio' => $fecha_actual));
    
    $oResult = mysql_query($sql, $oConnection);
    if (! $oResult) { return false; }

    $aCitas = array();
    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aCitas[] = $aRow;
        }
    }
    return $aCitas;
}



function obtener_participantes_cita($nAgendaId)
{
    $oConnection = db_connect();
    if (!$oConnection) { return false; }
    
    $sSql = "SELECT  "
          . "CASE p.tipo_participante "
          . "    WHEN 'empresa' THEN CONCAT('<i>Empresa</i> ', c.nombre, ' ', c.apellidos) "
          . "    WHEN 'agente' THEN CONCAT('<i>Asesor</i> ', u.nombre, ' ', u.apell_paterno, ' ', u.apell_materno) "
          . "    WHEN 'externo' THEN CONCAT('<i>Externo</i> ', p.email_otro_participante) "
          . "END AS nombre_contacto, "  
          . "p.participante_id, p.tipo_participante "
          . "FROM participantes_cita p "
          . "LEFT JOIN usuarios u ON u.id = p.participante_id "
          . "LEFT JOIN contactos_empresa c ON c.id = p.participante_id "
          . "WHERE p.agenda_id = :agenda_id ";
    
    mysql_bind($sSql, array('agenda_id' => $nAgendaId));
    
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aParticipantes = array();
    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aParticipantes[] = $aRow;
        }
    }
    return $aParticipantes;
}