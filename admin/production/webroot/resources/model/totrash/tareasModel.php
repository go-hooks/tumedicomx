<?php
defined('JZ_UPALE')
    or die('Acceso Incorrecto');

function tareas_obtener_listado()
{
    $sSql = "SELECT "
          . "    t.id, t.titulo, t.estado "
          . "    FROM tareas t "
          . "    WHERE 1 = 1 "
          . "        AND t.estado != 'Eliminado'"      
          . "    ORDER BY t.titulo ASC;";

    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aTareas = array();
    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aTareas[] = $aRow;
        }
    }
    return $aTareas;
}



function existe_tarea($sTarea)
{
    $sSql = "SELECT t.id "
          . "FROM tareas t "
          . "WHERE 1 = 1 "
          . "    AND t.titulo = :nombre AND t.estado != 'Eliminado';";

    $oConnection = db_connect();
    if (!$oConnection) { return true; }

    mysql_bind($sSql, array('nombre' => $sTarea));
    $oResult = mysql_query($sSql, $oConnection);

    if (! $oResult) { return true; }

    if (mysql_num_rows($oResult) > 0) { return true; }

    return false;
}



function obtener_datos_tarea($nTareaId)
{
    $sSql = "SELECT "
          . "    t.* "
          . "FROM tareas t "
          . "WHERE 1 = 1 "
          . "    AND t.id = :tarea_id "
          . "LIMIT 1;";

    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    mysql_bind($sSql, array('tarea_id' => $nTareaId));
    
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aTarea = mysql_fetch_array($oResult, MYSQL_ASSOC);
    if (!is_array($aTarea) || empty($aTarea)) { return false; }

    return $aTarea;
}