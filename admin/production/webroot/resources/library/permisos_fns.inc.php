<?php
function obtener_permisos_de_usuario($nUsuarioId, $nDepartamentoId)
{
    $aVecPerm = array();
    if (!is_numeric($nUsuarioId) || !is_numeric($nDepartamentoId)) { 
        return $aVecPerm;
    }

    $aVecPerm = obtener_permisos_por_departamento($nDepartamentoId);

    $sSql = "SELECT pu.id, pu.valor, p.nombre, p.key "
          . "FROM permisos_de_usuarios pu "
          . "    INNER JOIN permisos p ON p.id = pu.permiso_id "
          . "WHERE pu.usuario_id = :usuarioId ORDER BY pu.id ASC;";

    $oConnection = db_connect();
    if (!$oConnection) {
        return false;
    }

    mysql_bind($sSql, array('usuarioId' => $nUsuarioId));
    $oResult = mysql_query($sSql, $oConnection);

    if (! $oResult) {
        return false;
    }

    $aVecTmpPerm = array();
    if (mysql_num_rows($oResult) > 0) {
        while ($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            if (empty($aRow['key'])) continue;

            $value = false;
            if ($aRow['valor'] === '1') $value = true;

            $aVecTmpPerm[$aRow['key']] = array(
                'permiso'  => $aRow['key'],
                'heredado' => false,
                'valor'    => $value,
                'nombre'   => $aRow['nombre'],
                'id'       => $aRow['id']
            );
        }
    }
    $aVecPerm = array_merge($aVecPerm, $aVecTmpPerm);

    return $aVecPerm;
}

function hasPermission($sPermKey, $nUsuarioId = NULL)
{
    $aVecPerm = array();
    if ($nUsuarioId == NULL && isset($_SESSION["upale_usuario_id"])) {
        $aVecPerm = obtener_permisos_de_usuario(
            $_SESSION["upale_usuario_id"],
            $_SESSION['upale_usuario_departamento']
        );
        //print_r($aVecPerm);
    } elseif(is_numeric($nUsuarioId)) {
        if(! obtener_usuario_por_id($nUsuarioId)) {
            return false;
        }

        $aVecPerm = obtener_permisos_de_usuario(
            $nUsuarioId, 
            $_SESSION['upale_usuario_departamento']
        );
    } else {
        return false;
    }

    if (!is_array($aVecPerm) || count($aVecPerm) == 0) {
        return false;
    }
    
    
    $sPermKey = strtolower($sPermKey);
    if (array_key_exists($sPermKey, $aVecPerm))
    {
        if ($aVecPerm[$sPermKey]['valor'] === '1' || $aVecPerm[$sPermKey]['valor'] === true) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function obtener_todos_los_permisos()
{
    $sSql = "SELECT * FROM `permisos` ORDER BY `categoria` ASC , `nombre` ASC;";
    $oConnection = db_connect();
    if (!$oConnection) {
        return false;
    }

    $oResult = mysql_query($sSql, $oConnection);

    $aVecPerm = array();
    if (mysql_num_rows($oResult) > 0) {
        while ($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aVecPerm[$aRow['key']] = array(
                'id'     => $aRow['id'], 
                'nombre' => $aRow['nombre'], 
                'key'    => $aRow['key']
            );
        }
    }

    return $aVecPerm;
}

function obtener_permisos_por_departamento($nDepartamentoId)
{
    $aVecPerm = array();
    if (! is_numeric($nDepartamentoId)) { return $aVecPerm; }

    $sSql = "SELECT pd.id, pd.valor, p.nombre, p.key "
          . "FROM permisos_de_departamentos pd "
          . "    INNER JOIN permisos p ON p.id = pd.permiso_id "
          . "WHERE pd.departamento_id = :departamentoId ORDER BY pd.id ASC;";
    $oConnection = db_connect();
    if (!$oConnection) {
        return false;
    }

    mysql_bind($sSql, array('departamentoId' => $nDepartamentoId));
    $oResult = mysql_query($sSql, $oConnection);

    if (mysql_num_rows($oResult) > 0) {
        while ($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            if (empty($aRow['key'])) { continue; }

            $value = false;
            if ($aRow['valor'] === '1') { $value = true; }

            $aVecPerm[$aRow['key']] = array(
                'permiso'  => $aRow['key'],
                'heredado' => true,
                'valor'    => $value,
                'nombre'   => $aRow['nombre'],
                'id'       => $aRow['id']
            );
        }
    }

    return $aVecPerm;
}

function obtener_permisos_de_cargos_por_departamento($nCargoId, $nDepartamentoId, $bHeredado = false)
{
    $aVecPerm = array();

    if (! is_numeric($nCargoId))        { return $aVecPerm; }
    if (! is_numeric($nDepartamentoId)) { return $aVecPerm; }

    $aVecPerm = obtener_permisos_por_departamento($nDepartamentoId);

    $sSql = "SELECT pcd.id, pcd.valor, p.nombre, p.key "
          . "FROM permisos_de_cargos_por_departamento pcd "
          . "    INNER JOIN permisos p "
          . "            ON p.id = pcd.permiso_id "
          . "WHERE 1 = 1 "
          . "    AND pcd.cargo_id = :cargoId "
          . "    AND pcd.departamento_id = :departamentoId "
          . "ORDER BY pcd.id ASC;";
    $oConnection = db_connect();
    if (!$oConnection) {
        return false;
    }

    mysql_bind($sSql, array(
        'cargoId'        => $nCargoId,
        'departamentoId' => $nDepartamentoId
    ));
    $oResult = mysql_query($sSql, $oConnection);

    $aVecTmpPerm = array();
    if (mysql_num_rows($oResult) > 0) {
        while ($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            if (empty($aRow['key'])) { continue; }

            $bValue = false;
            if ($aRow['valor'] === '1') { $bValue = true; }

            $aVecTmpPerm[$aRow['key']] = array(
                'permiso'  => $aRow['key'],
                'heredado' => $bHeredado,
                'valor'    => $bValue,
                'nombre'   => $aRow['nombre'],
                'id'       => $aRow['id']
            );
        }
    }

    $aVecPerm = array_merge($aVecPerm, $aVecTmpPerm);

    return $aVecPerm;
}
