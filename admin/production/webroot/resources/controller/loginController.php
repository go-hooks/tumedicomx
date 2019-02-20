<?php

defined('JZ_UPALE') or die('Acceso Incorrecto');

require_once MODEL_PATH . DS . 'loginModel.php';

function login_default() {
    login_logout();
}

function login_cuentaSuspendida() {
    if (isset($_SESSION['upale_usuario'])) {
        logout();
    }

    $aGet = http_get_request();
    set_header(array('section' => 'Cuenta suspendida'));

    $aVars = array();
    if (isset($aGet['error'])) {
        $aVars['sErrorMessage'] = error_get_message($aGet['error']);
        $aVars['error'] = $aGet['error'];
    }

    $sLoginForm = load_template('_loginForm.php', $aVars);
    return $sLoginForm;
}

function login_loginForm() {
    if (isset($_SESSION['upale_usuario'])) {
        logout();
    }

    $aGet = http_get_request();

    $aVars = array();
    if (isset($aGet['error'])) {
        $aVars['sErrorMessage'] = error_get_message($aGet['error']);
        $aVars['error'] = $aGet['error'];
    }

    //--->Verifico si esta Ip se encuentra suspendida
    $sUsuarioIP = getRealIP();
    $nIntentos = intentos_fallidos_por_ip($sUsuarioIP);
    if ($nIntentos >= 4) {
        go_to('login/cuenta-suspendida', array('error' => '1010000'));
    }



    $sLoginForm = load_template('_loginForm.php', $aVars);
    return $sLoginForm;
}

function login_logout() {
    session_name("upale_auth");
    session_start();
    session_destroy();

    go_to('login/login-form');
}
