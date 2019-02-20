<?php
defined('JZ_UPALE')
    or die('Acceso Incorrecto');

function obtener_contactos_empresa($nEmpresaId)
{
    $sSql = "SELECT c.* "
          . "FROM contactos_empresa c "
          . "WHERE c.empresa_id = :empresa_id AND estado != 'Eliminado' ";
 
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



function obtener_telefonos_contacto($nContactoId, $nTipo)
{
    $oConnection = db_connect();
    if (!$oConnection) { return false; }
    
    $sSql = "SELECT t.* "
          . "FROM telefonos_contacto t "
          . "WHERE t.contacto_id = :contacto_id AND tipo_telefono_id = :tipo ";
    
    mysql_bind($sSql, array('contacto_id' => $nContactoId, 'tipo' => $nTipo));
    
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aTelefonos = array();
    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aTelefonos[] = $aRow;
        }
    }
    return $aTelefonos;
}



function obtener_correos_contacto($nContactoId)
{
    $oConnection = db_connect();
    if (!$oConnection) { return false; }
    
    $sSql = "SELECT c.* "
          . "FROM correos_contacto c "
          . "WHERE c.contacto_id = :contacto_id ";
    
    mysql_bind($sSql, array('contacto_id' => $nContactoId));
    
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aCorreos = array();
    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aCorreos[] = $aRow;
        }
    }
    return $aCorreos;
}



function obtener_redes_sociales_contacto($nContactoId)
{
    $oConnection = db_connect();
    if (!$oConnection) { return false; }
    
    $sSql = "SELECT r.* "
          . "FROM redes_sociales_contacto r "
          . "WHERE r.contacto_id = :contacto_id ";
    
    mysql_bind($sSql, array('contacto_id' => $nContactoId));
    
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aCorreos = array();
    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aCorreos[] = $aRow;
        }
    }
    return $aCorreos;
}



function obtener_datos_contacto_empresa($nContactoId)
{
    $sSql = "SELECT "
          . "    c.* "
          . "FROM contactos_empresa c "
          . "INNER JOIN empresas e ON e.id = c.empresa_id "
          . "WHERE 1 = 1 "
          . "    AND c.id = :contacto_id "
          . "LIMIT 1;";

    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    mysql_bind($sSql, array('contacto_id' => $nContactoId));
    
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aContacto = mysql_fetch_array($oResult, MYSQL_ASSOC);
    if (!is_array($aContacto) || empty($aContacto)) { return false; }

    return $aContacto;
}




function obtener_primer_puesto_contacto_empresa($nContactoId)
{
    $sSql = "SELECT "
          . "    pc.id, p.titulo AS puesto "
          . "FROM puestos_contacto pc "
          . "INNER JOIN puestos p ON p.id = pc.puesto_id "
          . "WHERE 1 = 1 "
          . "    AND pc.contacto_id = :contacto_id "
          . "LIMIT 1;";

    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    mysql_bind($sSql, array('contacto_id' => $nContactoId));
    
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aPuesto = mysql_fetch_array($oResult, MYSQL_ASSOC);
    if (!is_array($aPuesto) || empty($aPuesto)) { return false; }

    return $aPuesto;
}




function obtener_primer_telefono_contacto_empresa($nContactoId)
{
    $sSql = "SELECT "
          . "    tc.id, tc.telefono "
          . "FROM telefonos_contacto tc "
          . "WHERE 1 = 1 "
          . "    AND tc.contacto_id = :contacto_id AND tipo_telefono_id = '1' "
          . "LIMIT 1;";

    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    mysql_bind($sSql, array('contacto_id' => $nContactoId));
    
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aTelefono = mysql_fetch_array($oResult, MYSQL_ASSOC);
    if (!is_array($aTelefono) || empty($aTelefono)) { return false; }

    return $aTelefono;
}




function obtener_primer_email_contacto_empresa($nContactoId)
{
    $sSql = "SELECT "
          . "    c.* "
          . "FROM correos_contacto c "
          . "WHERE 1 = 1 "
          . "    AND c.contacto_id = :contacto_id "
          . "LIMIT 1;";

    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    mysql_bind($sSql, array('contacto_id' => $nContactoId));
    
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aCorreo = mysql_fetch_array($oResult, MYSQL_ASSOC);
    if (!is_array($aCorreo) || empty($aCorreo)) { return false; }

    return $aCorreo;
}



function verifica_puesto_existente_contacto($nContactoId, $nPuestoId)
{
    $oConnection = db_connect();
    if (!$oConnection) { return false; }
    
    $sSql = "SELECT puesto_id "
          . "FROM puestos_contacto "
          . "WHERE puesto_id = :puesto_id AND contacto_id = :contacto_id ";
    
    mysql_bind($sSql, array('puesto_id' => $nPuestoId, 'contacto_id' => $nContactoId));
    
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }
    
    if (mysql_num_rows($oResult) > 0) {
        return true;
    }
    
    return false;
}




function obtener_contacto_principal_empresa($nEmpresaId)
{
    $sSql = "SELECT "
          . "    c.* "
          . "FROM contactos_empresa c "
          . "INNER JOIN empresas e ON e.id = c.empresa_id "
          . "WHERE 1 = 1 "
          . "    AND c.principal = 'SI' "
          . "    AND c.empresa_id = :empresa_id "
          . "LIMIT 1;";

    $oConnection = db_connect();
    if (!$oConnection) { return false; }

    mysql_bind($sSql, array('empresa_id' => $nEmpresaId));
    
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aContacto = mysql_fetch_array($oResult, MYSQL_ASSOC);
    if (!is_array($aContacto) || empty($aContacto)) { return false; }

    return $aContacto;
}



function obtener_puestos_contacto($nContactoId)
{
    $oConnection = db_connect();
    if (!$oConnection) { return false; }
    
    $sSql = "SELECT pc.*, p.titulo AS puesto "
          . "FROM puestos_contacto pc "
          . "INNER JOIN puestos p ON p.id = pc.puesto_id "
          . "WHERE pc.contacto_id = :contacto_id ";
    
    mysql_bind($sSql, array('contacto_id' => $nContactoId));
    
    $oResult = mysql_query($sSql, $oConnection);
    if (! $oResult) { return false; }

    $aPuestos = array();
    if (mysql_num_rows($oResult) > 0) {
        while($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aPuestos[] = $aRow;
        }
    }
    return $aPuestos;
}