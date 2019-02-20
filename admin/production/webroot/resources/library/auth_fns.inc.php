<?php

/**
 * Verifica si esta autentificado el usuario
 * 
 * Editado por Daniel Lepe, para que intente guardar los intentos de acceso
 * fallidos solo si hay variables que lo sustentnen
 */
function authenticar() {
    $aPostRequest = http_post_request();

    $sUsuarioIP = getRealIP();
    

    
    if ((isset($aPostRequest['username']) && !empty($aPostRequest['username'])) &&
            (isset($aPostRequest['password']) && !empty($aPostRequest['password']))) {
        if ($aUsuario = get_auth_usuario($aPostRequest['username'])) {
            if ($aUsuario['estado'] == 'I') {
                go_to('login/login-form', array('error' => '0011110'));
            }

            if (md5($aPostRequest['password']) ==  $aUsuario['auth_password']) {
                if ($aUsuario['estado'] == 'S') {
                    // ir a login y notificar
                    go_to('login/login-form', array('error' => '0101000'));
                }

                limpiar_intentos_login($aUsuario['auth_usuario']);

                // Asignamos el tiempo de cada sesion en 2 horas
                ini_set("session.gc_maxlifetime", "7200");

                // Usamos la sesion de autenticacion
                session_name("upale_auth");

                // Iniciamos el uso de sesiones
                session_start();

                $_SESSION['upale_usuario'] = $aUsuario['auth_usuario'];
                $_SESSION['upale_usuario_id'] = $aUsuario['id'];
                $_SESSION['upale_usuario_nombre'] = $aUsuario['nombre_completo'];
                $_SESSION['upale_usuario_cargo'] = $aUsuario['cargo_id'];
                $_SESSION['upale_usuario_departamento'] = $aUsuario['departamento_id'];
                $_SESSION['upale_usuario_oficina'] = $aUsuario['oficina_id'];

                go_to(DEFAULT_MODULE);
                
            } else {
                // Si no es correcto la autenticacion, registramos el intento
                // y mostramos error
                agregar_intento_login($aPostRequest['username']);

                $nIntentos = intentos_fallidos($aPostRequest['username']);
                if ($nIntentos == 4) {
                    suspender_usuario($aPostRequest['username']);
                    go_to('login/login-form', array('error' => '0101000'));
                }

                go_to('login/login-form', array('error' => '0001010'));
            }
        } else {
            // Si no es correcto el nombre de usuario, registramos el intento mediante la IP
            // y mostramos error
            agregar_intento_login_por_id($sUsuarioIP);

            $nIntentos = intentos_fallidos_por_ip($sUsuarioIP);
            if ($nIntentos == 4) {
                go_to('login/cuenta-suspendida', array('error' => '1010000'));
            }

            go_to('login/login-form', array('error' => '0010100'));
        }
    } else { // if (username & password)
        // Asignamos el tiempo de cada sesion en 2 horas
        ini_set("session.gc_maxlifetime", "7200");
          
        // Usamos la sesion de autenticacion
        session_name("upale_auth");
            
        // Iniciamos el uso de sesiones
        session_start();
            
        // Si no es correcto la autenticacion, registramos el intento
        // y mostramos error
        if (isset($aPostRequest['username'])) {
            agregar_intento_login($aPostRequest['username']);

            $nIntentos = intentos_fallidos($aPostRequest['username']);

            if ($nIntentos == 4) {
                suspender_usuario($aPostRequest['username']);
                go_to('login/cuenta-suspendida', array('error' => '1010000'));
            }
        }



        if (!isset($_SESSION['upale_usuario'])) {
            // Borramos la sesion creada por el inicio de session anterior
            session_destroy();

            //Redireccionamos al login
            go_to('login/login-form');
        } // if (_SESSION)
    } // else
}

function get_auth_usuario($sUser) {
    $sSql = "SELECT "
            . "    u.id, "
            . "    CONCAT( "
            . "        u.nombre, ' ', u.apell_paterno, ' ', u.apell_materno "
            . "    ) AS nombre_completo, "
            . "    u.auth_usuario, u.auth_password, "
            . "    u.estado,"
            . "    u.login_attempts, u.last_login_attempt, "
            . "    u.departamento_id "
            . "FROM usuarios u "
            . "    INNER JOIN departamentos d "
            . "            ON u.departamento_id = d.id "
            . "WHERE 1 = 1 "
            . "    AND auth_usuario = :usuario AND u.estado = 'A' "
            . "LIMIT 1;";
    $oConnection = db_connect();
    if (!$oConnection) {
        return false;
    }

    mysql_bind($sSql, array('usuario' => $sUser));
    $oResult = mysql_query($sSql, $oConnection);

    if (!$oResult) {
        return false;
    }

    if (mysql_num_rows($oResult) > 0) {
        return mysql_fetch_array($oResult);
    }

    return false;
}

function agregar_intento_login($sUsuario) {
    $sSql = "UPDATE "
            . "    usuarios SET login_attempts = login_attempts + 1, "
            . "    last_login_attempt = NOW() "
            . "WHERE 1 = 1"
            . "    AND auth_usuario = :usuario "
            . "LIMIT 1;";
    $oConnection = db_connect();
    if (!$oConnection) {
        return false;
    }

    mysql_bind($sSql, array('usuario' => $sUsuario));
    $oResult = mysql_query($sSql, $oConnection);

    if (!$oResult) {
        return false;
    }

    return true;
}

function limpiar_intentos_login($sUsuario) {
    $sSql = "UPDATE "
            . "    usuarios SET login_attempts = 0, "
            . "    last_login_attempt = '0000-00-00 00:00:00' "
            . "WHERE 1 = 1"
            . "    AND auth_usuario = :usuario "
            . "LIMIT 1;";
    $oConnection = db_connect();
    if (!$oConnection) {
        return false;
    }

    mysql_bind($sSql, array('usuario' => $sUsuario));
    $oResult = mysql_query($sSql, $oConnection);

    if (!$oResult) {
        return false;
    }

    return true;
}

function intentos_fallidos($sUsuario) {
    $sSql = "SELECT login_attempts "
            . "FROM usuarios "
            . "WHERE auth_usuario = :usuario LIMIT 1;";

    $oConnection = db_connect();
    if (!$oConnection) {
        return false;
    }

    mysql_bind($sSql, array('usuario' => $sUsuario));
    $oResult = mysql_query($sSql, $oConnection);

    if (!$oResult) {
        return false;
    }

    $aIntentos = mysql_fetch_array($oResult, MYSQL_ASSOC);

    return $aIntentos['login_attempts'];
}

function suspender_usuario($sUsuario) {
    $sSql = "UPDATE usuarios "
            . "SET "
            . "    estado = 'S', "
            . "    last_login_attempt = NOW() "
            . "WHERE 1 = 1 "
            . "    AND auth_usuario = :usuario "
            . "LIMIT 1; ";
    $oConnection = db_connect();
    if (!$oConnection) {
        return false;
    }

    mysql_bind($sSql, array('usuario' => $sUsuario));
    $oResult = mysql_query($sSql, $oConnection);

    if (!$oResult) {
        return false;
    }

    return true;
}

function obtener_usuario_por_id($nUsuarioId, $bIncEliminados = false) {
    $sSql = "SELECT "
            . "    u.*, "
            . "    CONCAT( "
            . "        u.nombre, ' ', u.apell_paterno, ' ', u.apell_materno "
            . "    ) AS nombre_completo, "
            . "    CASE u.estado "
            . "        WHEN 'A' THEN 'Activo'"
            . "        WHEN 'I' THEN 'Inactivo'"
            . "        WHEN 'S' THEN 'Suspendido'"
            . "        WHEN 'E' THEN 'Eliminado'"
            . "    END AS status"
            . "    c.nombre AS cargo_nombre, "
            . "    d.nombre AS departamento_nombre "
            . "FROM usuarios u "
            . "    INNER JOIN cargos c "
            . "            ON u.cargo_id = c.id "
            . "    INNER JOIN departamentos d "
            . "            ON u.departamento_id = d.id "
            . "WHERE 1 = 1 "
            . "    AND u.id = :usuarioId "
            . "    AND d.estado = 'A'"
            . "LIMIT 1;";

    $oConnection = db_connect();
    if (!$oConnection) {
        return false;
    }

    mysql_bind($sSql, array('usuarioId' => $nUsuarioId));
    $oResult = mysql_query($sSql, $oConnection);

    if (!$oResult) {
        return false;
    }

    $aUsuario = array();
    if (mysql_num_rows($oResult) > 0) {
        $aUsuario = mysql_fetch_array($oResult, MYSQL_ASSOC);
    } else {
        return false;
    }

    return $aUsuario;
}

function getRealIP() {
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] != '') {
        $client_ip = (!empty($_SERVER['REMOTE_ADDR'])) ?
                $_SERVER['REMOTE_ADDR'] :
                ((!empty($_ENV['REMOTE_ADDR'])) ?
                        $_ENV['REMOTE_ADDR'] :
                        "unknown");

        // los proxys van añadiendo al final de esta cabecera
        // las direcciones ip que van "ocultando". Para localizar la ip real
        // del usuario se comienza a mirar por el principio hasta encontrar
        // una dirección ip que no sea del rango privado. En caso de no
        // encontrarse ninguna se toma como valor el REMOTE_ADDR

        $entries = split('[, ]', $_SERVER['HTTP_X_FORWARDED_FOR']);

        reset($entries);
        while (list(, $entry) = each($entries)) {
            $entry = trim($entry);
            if (preg_match("/^([0-9]+\.[0-9]+\.[0-9]+\.[0-9]+)/", $entry, $ip_list)) {
                // http://www.faqs.org/rfcs/rfc1918.html
                $private_ip = array(
                    '/^0\./',
                    '/^127\.0\.0\.1/',
                    '/^192\.168\..*/',
                    '/^172\.((1[6-9])|(2[0-9])|(3[0-1]))\..*/',
                    '/^10\..*/');
                $found_ip = preg_replace($private_ip, $client_ip, $ip_list[1]);

                if ($client_ip != $found_ip) {
                    $client_ip = $found_ip;
                    break;
                }
            }
        }
    } else {
        $client_ip = (!empty($_SERVER['REMOTE_ADDR'])) ?
                $_SERVER['REMOTE_ADDR'] :
                ((!empty($_ENV['REMOTE_ADDR'])) ?
                        $_ENV['REMOTE_ADDR'] :
                        "unknown");
    }

    return $client_ip;
}

function obtener_intentos_por_ip($sIPUsuario) {
    $sSql = "SELECT i.* "
            . "FROM intentos_login_por_ip i "
            . "WHERE 1 = 1 "
            . "    AND i.ip = :ipUusuario "
            . "LIMIT 1;";

    $oConnection = db_connect();
    if (!$oConnection) {
        return false;
    }

    mysql_bind($sSql, array('ipUusuario' => $sIPUsuario));
    $oResult = mysql_query($sSql, $oConnection);

    if (!$oResult) {
        return false;
    }

    $aIntento = array();
    if (mysql_num_rows($oResult) > 0) {
        $aIntento = mysql_fetch_array($oResult, MYSQL_ASSOC);
    } else {
        return false;
    }

    return $aIntento;
}

function agregar_intento_login_por_id($sIPUsuario) {
    //---->Verifico si ya existe la IP
    $aIpUusuario = obtener_intentos_por_ip($sIPUsuario);
    if (!$aIpUusuario):
        //--->Creo el registro
        $nInserta = db_insertar('intentos_login_por_ip', array(
            'intentos' => '1',
            'ip' => $sIPUsuario,
            'fecha_intento' => date('Y-m-d H:i:s')
        ));

        if (!$nInserta):
            return false;
        endif;
    else:
        $sSql = "UPDATE "
                . "    intentos_login_por_ip SET intentos = intentos + 1, "
                . "    fecha_intento = NOW() "
                . "WHERE 1 = 1"
                . "    AND ip = :ip_usuario "
                . "LIMIT 1;";

        $oConnection = db_connect();
        if (!$oConnection):
            return false;
        endif;

        mysql_bind($sSql, array('ip_usuario' => $sIPUsuario));
        $oResult = mysql_query($sSql, $oConnection);

        if (!$oResult):
            return false;
        endif;
    endif;

    return true;
}

function intentos_fallidos_por_ip($sIpUsuario) {
    $sSql = "SELECT id, intentos, timediff(NOW(), fecha_intento) AS diferencia_horas "
            . "FROM intentos_login_por_ip "
            . "WHERE ip = :ip_usuario LIMIT 1;";

    $oConnection = db_connect();
    if (!$oConnection) {
        return false;
    }

    mysql_bind($sSql, array('ip_usuario' => $sIpUsuario));
    $oResult = mysql_query($sSql, $oConnection);

    if (!$oResult) {
        return false;
    }

    $aIntentos = mysql_fetch_array($oResult, MYSQL_ASSOC);

    //---->Verifico si ya han pasado las 12 horas despues del bloqueo
    $aTiempo = explode(':', $aIntentos['diferencia_horas']);
    if ($aTiempo[0] >= 12):
        $modifica = db_modificar('intentos_login_por_ip', $aIntentos['id'], array(
            'intentos' => '0'
        ));

        return 0;
    endif;


    return $aIntentos['intentos'];
}
