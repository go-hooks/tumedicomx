<?php
  /** ----------------------------------------------------               *
    * Agencia Aduanera de América                                        *
    * http://aaag.org.mx                                                 *
    * ----------------------------------------------------               *
    * Archivo:      departamentosController.php                          *
    * Descripción:  controlador para los departamentos o grupos de
    *               usuarios donde se asignan los permisos para cada
    *               rol de grupo existente
    *
    * Autor: 	    Omar Alejandro Garcia Santacruz                      *
    * E-mail:	    alejandro.delpiero@gmail.com                         *
    * ---------------------------------------------------- *
    */

defined('JZ_UPALE')
    or die('Acceso Incorrecto');
define('CONTROLLER', 'Departamentos');

require_once MODEL_PATH . DS . 'departamentosModel.php';

authenticar();
if (! hasPermission('acceso_departamentos')) { go_to('acceso/denegado'); }

/**
 * Accion por default
 */
function departamentos_default()
{
    return departamentos_listado();
}

function departamentos_listado($aExtData = array())
{
    set_header(array(
        'section'   => 'Listado de grupos',
        'libraries' => array('Jquery')
    ));

    $aGet = http_get_request();
    $aGet = array_merge($aGet, $aExtData);
    $aData = array();
    $aData['opcion_plantilla'] = 'muestra_listado';

    $aDepartamentos = departamentos_obtener_listado();
    if (! $aDepartamentos) { $aData['aDepartamentos'] = array(); }

    $aData['aDepartamentos'] = $aDepartamentos;

    if (isset($aGet['sMsgNotice'])) {
        $aData['sMsgNotice'] = $aGet['sMsgNotice'];
    }
    if (isset($aGet['msg_success'])) {
        $aData['msg_success'] = $aGet['msg_success'];
    }
    if (isset($aGet['msg_unsuccess'])) {
        $aData['msg_unsuccess'] = $aGet['msg_unsuccess'];
    }
    
    $sListado = load_template(CONTROLLER . DS . '_departamentos.php', $aData);

    return $sListado;
}


/*
 * funcion para un nuevo departamento
 */
function departamentos_nuevo($aExtData = array())
{
    if (! hasPermission('perm_crear')) { go_to('acceso/denegado'); }

    set_header(array(
        'javascript' => array(
            'add_form.js',
        ),
        'libraries'  => array('validadorFormHTML5'),
        'section'    => 'Nuevo grupo'
    ));

    $aGet = http_get_request();
    $aData = array();

    $aData = array_merge($aData, $aExtData);
    $sForm = load_template(CONTROLLER . DS . '_departamentosForm.php', $aData);

    return $sForm;
}

/*
 * funcion para guardar un nuevo departamento
 */
function departamentos_crear()
{
    if (! hasPermission('perm_crear')) { go_to('acceso/denegado'); }
    defined('BR') or define('BR', '<br />');

    set_header(array('section'   => 'Nuevo grupo'));

    $aPost = http_post_request();
    $aDepartamento = $aPost['departamento'];

    $_error = '';

    if (empty($aDepartamento['nombre'])) {
        $_error .= 'El nombre es obligatorio.' . BR; }

    if (empty($aDepartamento['estado'])) {
        $_error .= 'El estado es obligatorio.' . BR; }

    if (existe_departamento($aDepartamento['nombre'])) {
        $_error .= 'El nombre del grupo esta siendo utilizado actualmente. '
                .  'Este debe ser unico.' . BR; }

    if (empty($_error)) {
        $nDepartamentoId = db_insertar('departamentos', array(
                                       'nombre'            => $aDepartamento['nombre'],
                                       'estado'            => $aDepartamento['estado'],
                                       'created_at'        => date('Y-m-d H:i:s'),
        ));

        if (! $nDepartamentoId) {
                $_error .= 'Ha ocurrido un error al tratar guardar la informacion '
                        .  'en la base de datos, consulte a su administrador.' . BR;
        }
    }
    if (! empty($_error)) {
        $aData = array_merge($aDepartamento);
        $aData['msg_error'] = $_error;
        return departamentos_nuevo($aData);
    }

    if ($aD = obtener_datos_departamento($nDepartamentoId)) {
        return departamentos_listado(array(
            'msg_success' => 'El grupo "' . $aD['nombre'] . '" ha sido creado satisfactoriamente.'
        ));
    }
}

/*
 * funcion para editar datos de un departamento
 */
function departamentos_editar($aExtData = array())
{
    if (! hasPermission('perm_modificar')) { go_to('acceso/denegado'); }

    $aGet = http_get_request();

    if (isset($aGet['departamento_id']) && is_numeric($aGet['departamento_id'])) {
        if ($aDepartamento = obtener_datos_departamento($aGet['departamento_id'])) {
           
            set_header(array(
                'javascript' => array(
                    'add_form.js'
                ),
                'libraries' => array('validadorFormHTML5'),
                'section'    => 'Modificar contacto'
            ));
            
            $aData = array();
            $aData = array_merge($aData, $aDepartamento, $aExtData);

            $sUpdateForm = load_template(CONTROLLER . DS . '_departamentosForm.php', $aData);
 
            return $sUpdateForm;
        }
    }else {
        return departamentos_listado(array(
            'sMsgNotice' => 'La informacion del grupo seleccionado es incorrecta.'
        ));
    }
}

/*
 * funcion para guardar la modificacion de un departamento
 */
function departamentos_modificar()
{
    if (! hasPermission('perm_modificar')) { go_to('acceso/denegado'); }
    defined('BR') or define('BR', '<br />');

    set_header(array('section'   => 'Modificar grupo'));

    $aPost = http_post_request();
    $aDepartamento = $aPost['departamento'];

    $_error = '';

    if(! empty($aDepartamento['id']) && is_numeric($aDepartamento['id'])) {
        if ($aDepa = obtener_datos_departamento($aDepartamento['id'])) {
            if (empty($aDepartamento['nombre'])) {
                $_error .= 'El nombre es obligatorio.' . BR; }

            if (empty($aDepartamento['estado'])) {
                $_error .= 'El estado es obligatorio.' . BR; }

            if ($aDepa['nombre'] !=  $aDepartamento['nombre']) {
                if (existe_departamento($aDepartamento['nombre'])) {
                    $_error .= 'El nombre del grupo esta siendo utilizado actualmente. '
                            .  'Este debe ser unico.' . BR; }
            }
            if (empty($_error)) {
                $bDepartamento = db_modificar('departamentos',$aDepartamento['id'],array(
                                              'nombre'      => $aDepartamento['nombre'],
                                              'updated_at'  => date('Y-m-d H:i:s'),
                                              'estado'      => $aDepartamento['estado'],
                ));
                if($bDepartamento){
                   return departamentos_listado(array(
                      'msg_success' => 'La informacion del grupo ha sido actualizada.'));
                }
            }else {
                $aData = array_merge($aDepartamento);
                $aData['msg_error'] = $_error;
                return departamentos_editar($aData);
            }
        }// if datos de departamento
    }// if (id)
}



function departamentos_eliminar()
{
    if (! hasPermission('perm_eliminar')) { go_to('acceso/denegado'); }
    defined('BR') or define('BR', '<br />');

    $aGet = http_get_request();
    if (isset($aGet['departamento_id']) && is_numeric($aGet['departamento_id'])) {
        if ($aDepartamento = obtener_datos_departamento($aGet['departamento_id'])) {
            if ($mod = db_modificar('departamentos', $aGet['departamento_id'], array('estado' => 'E'))) {
                return departamentos_listado(array(
                    'msg_success' => 'El grupo ' . $aDepartamento['nombre'] . ' ha sido eliminado satisfactoriamente.' . BR
                ));
            }
        }
    }

    return departamentos_listado(array(
        'sMsgNotice' => 'La informacion del grupo seleccionado es incorrecta.'
    ));
}