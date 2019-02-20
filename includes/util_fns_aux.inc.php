<?php
    /*
    Nombre del archivo: util_fns_aux.php
    Descripcion: funciones auxiliares del cms, no son parte de la version inicial
    ---------------------------------------------------------------------------------------
    @autor Sustam.com ©
    @version 1.0

    Develop by
    01/02/2012 : Jesus Nazareth Gutierrez Hernandez (Developer)
    01/02/2012 : Ricardo Castellanos Rivera (Developer)
    01/12/2012 : Jose Luis Quintero Malacon (Css structuring)

    Updated by
    dd/mm/yyyy : Nombre de quien modifico el archivo
*/

    
    //Función que executa un sql
    function get_sql($sSql) {
        $nConn = db_connect();
        if (! $nConn) return false;        
        
        $sResult = mysql_query($sSql, $nConn);
        if (! $sResult) return false;

        $aVecResult = array();
        while ($aRow = mysql_fetch_array($sResult, MYSQL_ASSOC)) {
            $aVecResult[] = $aRow;
        }
        return $aVecResult;
    }

    
    //Función que executa un sql y solo devuelve un registro
    function get_one_sql($sSql) {
        $nConn = db_connect();
        if (! $nConn) return false;        
        
        $sResult = mysql_query($sSql, $nConn);
        if (! $sResult) return false;
        $aResult = mysql_fetch_array($sResult, MYSQL_ASSOC);

        return $aResult;
    }    
    
    
    //Función que entrega un valor de un registro
    function get_one_value($value,$sTable,$nId) {
        if (!is_numeric($nId)) return false;
        $nConn = db_connect();
        if (! $nConn) return false;
        
        $sSql = " SELECT $value FROM $sTable WHERE id = '$nId'; ";
        $sResult = mysql_query($sSql, $nConn);
        if (! $sResult) return false;
        $aResult = mysql_fetch_array($sResult, MYSQL_ASSOC);

        return $aResult{$value};
    }

    // Function created to get all the datas from a table by ID --- Nov 25th 2010
    function get_all_data_from($sTable, $nId) {

        if (!is_numeric($nId)) return false;
        $nConn = db_connect();
        if (! $nConn) return false;
        
        $sSql = " SELECT * FROM $sTable WHERE id = '$nId'; ";
        $sResult = mysql_query($sSql, $nConn);
        if (! $sResult) return false;
        $aResult = mysql_fetch_array($sResult, MYSQL_ASSOC);

        return $aResult;
    }

    // Function created to get the previos datas of a specific position --- Nov 25th 2010, Dec 15th 2010
    function get_previous_array($sTable, $nPosicion, $sCondition) {
        if (! is_numeric($nPosicion)) return false;
        $nConn = db_connect();
        if (! $nConn) return false;

        $sSql = " SELECT * FROM $sTable WHERE posicion < '{$nPosicion}' AND estado != 'E' ";
        if ($sCondition != '' ) {
            $sSql .= ' AND ' . $sCondition;
        }
        $sSql .= " ORDER BY posicion DESC LIMIT 1;";

        $sResult = mysql_query($sSql, $nConn);
        $aResult = mysql_fetch_array($sResult, MYSQL_ASSOC);
        return $aResult;
    }

    // Function created to get the next datas of a specific position --- Nov 25th 2010, Dec 15th 2010
    function get_next_array($sTable, $nPosicion, $sCondition) {
        if (!is_numeric($nPosicion)) return false;
        $nConn = db_connect();
        if (! $nConn) return false;

        $sSql = " SELECT * FROM $sTable WHERE posicion > '{$nPosicion}' AND estado != 'E' ";
        if ($sCondition != '' ) {
            $sSql .= ' AND ' . $sCondition;
        }
        $sSql .= " ORDER BY posicion ASC LIMIT 1;";

        $sResult = mysql_query($sSql, $nConn);
        $aResult = mysql_fetch_array($sResult, MYSQL_ASSOC);
        return $aResult;
    }

    // Function created to get all the actived and inactived datas from a table --- Dec 13th 2010
    function get_all_actived_inactived($sTable, $sConditions, $sOrderBy = 'posicion', $sOrder = 'ASC') {
        $nConn = db_connect();

        if (! $nConn) return false;

        $sSql = " SELECT * FROM $sTable WHERE $sConditions ORDER BY $sOrderBy $sOrder; ";

        $sResult = mysql_query($sSql, $nConn);
        if (! $sResult) return false;

        $aVecResult = array();
        while ($aRow = mysql_fetch_array($sResult, MYSQL_ASSOC)) {
            $aVecResult[] = $aRow;
        }
        return $aVecResult;
    }
    
    
    function get_all_actived_inactived_paginado($sTable, $sConditions, $paginas, $sOrderBy = 'posicion', $sOrder = 'ASC') {
        $nConn = db_connect();
        if (! $nConn) return false;

        $sSql = " SELECT * FROM $sTable WHERE $sConditions ORDER BY $sOrderBy $sOrder ";

        $_pagi_sql = $sSql;
        $_pagi_cuantos = $paginas;
        $_pagi_propagar = array('indice', 'busqueda','especialidad');
        require_once 'paginator.inc.php';

        $aVecResult = array();
        while ($aRow = mysql_fetch_array($_pagi_result, MYSQL_ASSOC)) {
            $aVecResult[] = $aRow;
        }

        $aContenidos = array();
        $aContenidos['usuarios'] = $aVecResult;
        $aContenidos['navegacion'] = $_pagi_navegacion;
        $aContenidos['pagina_actual'] = $_pagi_actual;
        $aContenidos['total_paginas'] = $_pagi_totalPags;

        return $aContenidos;
    }
    
    
    
    
    function existe_email_usuario($sEmail, $nId = NULL)
    {
        if(empty($sEmail)) { return false; }

        $sSql = "SELECT COUNT(*)"
              . "FROM usuario WHERE email = :email AND estado != 'E' ";
        
        if(is_numeric($nId)):
            $sSql .= "AND id != :usuario_id ";
        endif;

        mysql_bind($sSql, array('email' => $sEmail, 'usuario_id' => $nId));
        
        $nConn = db_connect();
        if(! $nConn) { return false; }

        $nResult = mysql_query($sSql, $nConn);
        if (! $nResult) { return false; }

        $nTotal = mysql_result($nResult, 0);

        if ($nTotal > 0) {
            return true;
        }

        return false;
    }
    
    
    
    function existe_usuario_login($sEmail, $sPassword)
    {
        if(empty($sEmail)) { return false; }
        if(empty($sPassword)) { return false; }
        
        $nConn = db_connect();
        if(! $nConn) { return false; }

        $sSql = "SELECT * "
              . "FROM registros "
              . "WHERE correo = '" . $sEmail . "' "
              . "AND password = '" .  Encrypter::encrypt($sPassword) . "' "
              . "AND elim = 0 LIMIT 1";
                
        $nResult = mysql_query($sSql, $nConn);
                
        if (! $nResult) { return false; }

        $aResult = mysql_fetch_array($nResult, MYSQL_ASSOC);

        return $aResult;
    }
   