<?php

defined('JZ_UPALE') or die('Acceso Incorrecto');
define('CONTROLLER', 'Usuarios');

require_once MODEL_PATH . DS . 'usuariosModel.php';
require_once MODEL_PATH . DS . 'departamentosModel.php';

authenticar();
if (!hasPermission('acceso_usuarios')) {
    go_to('acceso/denegado');
}

function usuarios_default() {
    return usuarios_listado();
}

function usuarios_listado($aExtData = array()) {
    set_header(array(
        'section' => 'Listado de usuarios',
        'libraries' => array('Jquery')
    ));


    $aGet = http_get_request();
    $aGet = array_merge($aGet, $aExtData);

    $aData = array();

    $sOrderBy = 'nombre_completo';
    if (isset($aGet['order_by'])) {
        $sOrderBy = $aGet['order_by'];
    }

    $sOrder = 'ASC';
	
    if (isset($aGet['order'])) {
        $sOrder = $aGet['order'];
    }

    $aUsuarios = obtener_listado_usuarios($sOrderBy, $sOrder);
    if (!$aUsuarios) {
        $aData['aUsuarios'] = array();
    }

    $aData['sOrderBy'] = $sOrderBy;
    $aData['sOrder'] = $sOrder;
    $aData['aUsuarios'] = $aUsuarios;

    if (isset($aGet['sMsgNotice'])) {
        $aData['sMsgNotice'] = $aGet['sMsgNotice'];
    }
    if (isset($aGet['msg_success'])) {
        $aData['msg_success'] = $aGet['msg_success'];
    }
    if (isset($aGet['msg_unsuccess'])) {
        $aData['msg_unsuccess'] = $aGet['msg_unsuccess'];
    }
    $sListadoUsuarios = load_template(CONTROLLER . DS . '_usuariosListado.php', $aData);

    return $sListadoUsuarios;
}

function usuarios_nuevo($aExtData = array()) {
    if (!hasPermission('perm_crear')) {
        go_to('acceso/denegado');
    }

    set_header(array(
        'javascript' => array(
            'usuarios.js',
        ),
        'libraries' => array('validadorFormHTML5'),
        'section' => 'Nuevo usuario'
    ));

    $aGet = http_get_request();

    $asistentes = obtener_select_usuarios(27);
    if (!$asistentes)
        $asistentes = array();

    $aData = array();
    $aData['aDepartamentos'] = obtener_select_departamentos();
    $aData['aEstados'] = array('A' => 'Activo', 'I' => 'Inactivo');
    $aData['asistentes'] = $asistentes;
    $aData = array_merge($aData, $aExtData);

    $sForm = load_template(CONTROLLER . DS . '_usuariosForm.php', $aData);

    return $sForm;
}

function usuarios_crear() {
    if (!hasPermission('perm_crear')) {
        go_to('acceso/denegado');
    }
    defined('BR') or define('BR', '<br />');

    set_header(array('section' => 'Nuevo usuario'));

    $aPost = http_post_request();
    $aUsuario = $aPost['usuario'];

    $_error = '';

    if (empty($aUsuario['nombre'])) {
        $_error .= 'El nombre es obligatorio.' . BR;
    }
    if (empty($aUsuario['auth_usuario'])) {
        $_error .= 'El nombre de usuario es obligatorio.' . BR;
    }
    if (existe_usuario($aUsuario['auth_usuario'])) {
        $_error .= 'El nombre de usuario esta siendo utilizado actualmente.'
                . 'Este debe ser unico.' . BR;
    }
    if (empty($aUsuario['auth_password'])) {
        $_error .= 'El Password es obligatorio.' . BR;
    }
    if (empty($aUsuario['auth_confirm_password'])) {
        $_error .= 'La confirmacion del password es obligatoria.' . BR;
    }
    if ($aUsuario['auth_password'] != $aUsuario['auth_confirm_password']) {
        $_error .= 'El password y la confirmacion no coinciden.' . BR;
    }
    if (empty($aUsuario['departamento_id'])) {
        $_error .= 'Indique el grupo al que pertenece el usuario.' . BR;
    }
    if (empty($aUsuario['email'])) {
        $_error .= 'El email es obligatorio.' . BR;
    }
    if (!filter_var($aUsuario['email'], FILTER_VALIDATE_EMAIL)) {
        $_error .= 'El email es incorrecto.' . BR;
    }


    if (empty($_error)) {

        $nUsuarioId = db_insertar('usuarios', array(
            'nombre' => $aUsuario['nombre'],
            'apell_paterno' => $aUsuario['apell_paterno'],
            'apell_materno' => $aUsuario['apell_materno'],
            'tel_oficina' => $aUsuario['tel_oficina'],
            'tel_movil' => $aUsuario['tel_movil'],
            'email' => $aUsuario['email'],
            'auth_usuario' => $aUsuario['auth_usuario'],
            'auth_password' => md5($aUsuario['auth_password']),
            'estado' => 'A',
            'created_at' => date('Y-m-d H:i:s'),
            'departamento_id' => $aUsuario['departamento_id'],
        ));

        if (!$nUsuarioId) {
            db_eliminar_por_id('domicilios', $nDomicilioId);
            $_error .= 'Ha ocurrido un error al tratar guardar la informacion '
                    . 'en la base de datos, consulte a su administrador.' . BR;
        }
    }

    if (!empty($_error)) {
        $aData = array_merge($aUsuario);
        $aData['msg_error'] = $_error;
        return usuarios_nuevo($aData);
    }


    if ($aU = obtener_datos_usuario($nUsuarioId)) {
        return usuarios_listado(array(
            'msg_success' => 'El usuario "' . $aU['nombre_completo'] . '" ha sido creado satisfactoriamente.'
        ));
    }

    return usuarios_listado();
}

function usuarios_editar($aExtData = array()) {
    if (!hasPermission('perm_modificar')) {
        go_to('acceso/denegado');
    }
    
    $aGet = http_get_request();
    if (isset($aGet['usuario']) && is_numeric($aGet['usuario'])) {
        if ($aUsuario = obtener_datos_usuario($aGet['usuario'])) {
            set_header(array(
                'javascript' => array(
                    'usuarios.js',
                ),
                'libraries' => array('validadorFormHTML5'),
                'section' => 'Editar usuario'
            ));

            $aData = array();

            $asistentes = obtener_select_usuarios(27);
            if (!$asistentes)
                $asistentes = array();

            $aData['asistentes'] = $asistentes;
            $aData['aDepartamentos'] = obtener_select_departamentos();
            $aData['aEstados'] = array('A' => 'Activo', 'I' => 'Inactivo', 'S' => 'Suspendido');

            $aData = array_merge($aData, $aUsuario, $aExtData);

            $sUpdateForm = load_template(CONTROLLER . DS . '_usuariosForm.php', $aData);

            return $sUpdateForm;
        }
    } else {
        return usuarios_listado(array(
            'sMsgNotice' => 'La informacion del usuario seleccionado es incorrecta.'
        ));
    }
}

function usuarios_modificar() {
    if (!hasPermission('perm_modificar')) {
        go_to('acceso/denegado');
    }
    defined('BR') or define('BR', '<br />');

    set_header(array('section' => 'Modificar usuario'));

    $aPost = http_post_request();
    $aUsuario = $aPost['usuario'];

    $_error = '';
    if (isset($aUsuario['id']) && is_numeric($aUsuario['id'])) {

        if ($aUser = obtener_datos_usuario($aUsuario['id'])) {
            if (empty($aUsuario['nombre'])) {
                $_error .= 'El nombre es obligatorio.' . BR;
            }

            if (empty($aUsuario['auth_usuario'])) {
                $_error .= 'El nombre de usuario es obligatorio.' . BR;
            }

            if ($aUser['auth_usuario'] != $aUsuario['auth_usuario']) {
                if (existe_usuario($aUsuario['auth_usuario'])) {
                    $_error .= 'El nombre de usuario esta siendo utilizado actualmente.'
                            . 'Este debe ser unico.' . BR;
                }
            }

            if (!empty($aUsuario['auth_password']) && !empty($aUsuario['auth_confirm_password'])) {
                if ($aUsuario['auth_password'] != $aUsuario['auth_confirm_password']) {
                    $_error .= 'El password y la confirmacion no coinciden.' . BR;
                }
            } else {
                $aUsuario['auth_password'] = $aUser['auth_password'];
            }

            if (empty($aUsuario['departamento_id'])) {
                $_error .= 'Indique el departamento al que pertenece el usuario.' . BR;
            }

            if (empty($_error)) {

                $bUsuario = db_modificar('usuarios', $aUser['id'], array(
                    'nombre' => $aUsuario['nombre'],
                    'apell_paterno' => $aUsuario['apell_paterno'],
                    'apell_materno' => $aUsuario['apell_materno'],
                    'tel_oficina' => $aUsuario['tel_oficina'],
                    'tel_movil' => $aUsuario['tel_movil'],
                    'email' => $aUsuario['email'],
                    'auth_usuario' => $aUsuario['auth_usuario'],
                    'auth_password' => md5($aUsuario['auth_password']),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'departamento_id' => $aUsuario['departamento_id'],
                ));

                if ($bUsuario) {
                    return usuarios_listado(array(
                        'msg_success' => 'La informacion del usuario ha sido actualizada.'));
                }
            } else { // if (! error)
                $aData = array_merge($aUsuario);
                $aData['msg_error'] = $_error;
                return usuarios_editar($aData);
            }
            // msg_error
        } // if (datos de usuario)
    } // if (id)

    return usuarios_listado(array('msg_unsuccess' => 'La informacion enviada no es valida.'));
}

function usuarios_eliminar() {
    if (!hasPermission('perm_eliminar')) {
        go_to('acceso/denegado');
    }
	
    defined('BR') or define('BR', '<br />');

    $aGet = http_get_request();
	
    if (isset($aGet['usuario']) && is_numeric($aGet['usuario'])) {
        if ($aUsuario = obtener_datos_usuario($aGet['usuario'])) {
            if ($mod = db_modificar('usuarios', $aGet['usuario'], array('estado' => 'E'))) {
                set_flash('Usuario exitosamente eliminado', 'success');
            } else {
            	set_flash('Ha ocurrido un error', 'error');
            }
        } else {
        		set_flash('No se ha podido acceder al usuario.', 'error');
        }
    } else {
    	set_flash('La informacion del usuario seleccionado es incorrecta.', 'warning');		
	}
	
	go_to('usuarios');
}
