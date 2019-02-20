<?php

defined('JZ_UPALE') or die('Acceso Incorrecto');

function init_app() {
    $aRouter = http_get_rout();
           
    $sControlador = $aRouter['module'];
    $sAccion = $aRouter['action'];
    
    
    $sPathControlador = CONTROLLER_PATH . DS . $sControlador . 'Controller.php';
    if (file_exists($sPathControlador)) {
        require_once $sPathControlador;
    } else {
        //die('No existe el modulo.');
        header("HTTP/1.0 404 Not Found");
        exit;
    }

    $sAccion = $sControlador . '_' . $sAccion;
    if (is_callable($sAccion)) {
        $sContent = $sAccion();

        $sTemplateFile = '_' . $sControlador . 'Template.php';
        if (file_exists(TEMPLATE_PATH . DS . $sTemplateFile)) {
            echo load_template($sTemplateFile, array(
                's' . $sControlador . 'Content' => $sContent
            ));
        } else {
            echo load_template('_mainTemplate.php', array(
                'sContent' => $sContent
            ));
        }
    } else {
        //die('La accion solicitada no existe.');
        header("HTTP/1.0 404 Not Found");
        exit;
    }
}

function app_render_nav_menu() {
    $aModulos = obtener_modulos_usuario();
    
    $sHtml = ""; // Elimina el error de volcado en variable sin inicializar.
    
    $sHtml .= '<div id="side-content"><dl>';
    foreach ($aModulos as $sKey => $aModulo) {
      
        

        if ($aModulo['es_modulo'] == 1):
           
            $sHtml .= '<dt>'
                    . '    <a href="#"><strong>&raquo; ' . $aModulo['nombre'] . '</strong></a>'
                    . '</dt>';
            $aHijos = obtener_hijos_modulo($aModulo['id']);
            if (!$aHijos): $aHijos = array();
            endif;

            if (count($aHijos) > 0):
                $sHtml .= '<dd id="submenu' . $aModulo['id'] . '" style="display:">';
                foreach ($aHijos as $x => $hijo):
                    $sHtml .= '<a href="' . url_format($hijo['controlador']) . '">&raquo; ' . $hijo['nombre'] . '</a><br />';
                endforeach;
                $sHtml .= '</dd>';
            endif;
            
            //$sHtml .= '<br />';
            
        else:
            $sHtml .= '<dt><a href="' . url_format($aModulo['controlador']) . '">&raquo; ' . $aModulo['nombre'] . '</a></dt>';
        endif;
    }
    $sHtml .='<dt><a href="' . url_format('login/logout') . '">Salir</a></dt>'
            . '</dl></div>';

    return $sHtml;
}

function obtener_hijos_modulo($nModuloId) {
    $sSql = "SELECT * FROM `modulos` WHERE padre = :padre AND estado = 'A' ORDER BY `posicion` ASC;";

    mysql_bind($sSql, array('padre' => $nModuloId));
    $oConnection = db_connect();
    if (!$oConnection) {
        return false;
    }

    $oResult = mysql_query($sSql, $oConnection);

    $aVecMod = array();
    if (mysql_num_rows($oResult) > 0) {
        while ($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            if (hasPermission($aRow['key_word'])) {
                $aVecMod[$aRow['key_word']] = $aRow;
            }
        }
    }

    return $aVecMod;
}

function obtener_modulos_usuario() {
    //$aPermUsuario = obtener_permisos_de_usuario();
    $sSql = "SELECT * FROM modulos WHERE padre = 0 AND estado = 'A' ORDER BY posicion ASC";
    $oConnection = db_connect();
    if (!$oConnection) {
        return false;
    }

    $oResult = mysql_query($sSql, $oConnection);


        
    $aVecMod = array();
    if (mysql_num_rows($oResult) > 0) {
        while ($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            if (hasPermission($aRow['key_word'])) {
                $aVecMod[$aRow['key_word']] = $aRow;
            }                        
            
        }
    }
        
    return $aVecMod;
}

function load_template($archivo, $datos = array(), $return = true) {
	global $aMetas;
    if (!file_exists(TEMPLATE_PATH . DS . $archivo)) {
        return false;
    }
    if (!is_array($datos)) {
        return false;
    }
	
	$datos['aMetas'] = $aMetas; // Manda el valor e metas a las vistas.

    if ($return) {
        ob_start();
        extract($datos);
        include TEMPLATE_PATH . DS . $archivo;
        $salida = ob_get_contents();
        ob_end_clean();

        return $salida;
    } else {
        extract($datos);
        include TEMPLATE_PATH . DS . $archivo;
    }
}

function set_header($metas = array()) {
    global $aMetas;
    if (!is_array($metas)) {
        return false;
    }

    $keys = array_keys($metas);

    foreach ($metas as $kmeta => $vmeta) {
        if (isset($aMetas[$kmeta])) {
            $_tmp = $aMetas[$kmeta];
            if (is_array($vmeta)) {
                foreach ($vmeta as $m) {
                    if (!in_array($m, $_tmp)) {
                        $aMetas[$kmeta][] = $m;
                    }
                }
            } else if (is_string($vmeta) && is_string($_tmp)) {
                $aMetas[$kmeta] = $vmeta;
            }
        }
    }

    return true;
}

function render_header() {
    global $aMetas;
    if (!is_array($aMetas)) {
        return false;
    }

    $sHeader = '';

    $titulo = '<title>' . $aMetas['title'] . ' - ' . $aMetas['section'] . '</title>';
    $sHeader .= $titulo;

    foreach ($aMetas as $sKey => $aVmetas) {
        if ($sKey == 'css') {
            if (!is_array($aVmetas)) {
                continue;
            }
            foreach ($aVmetas as $nombre_archivo) {
                $sCss = css_loadStylesheet($nombre_archivo);
                $sHeader .= $sCss;
            }
        } else if ($sKey == 'libraries') {
            if (!is_array($aVmetas)) {
                continue;
            }
            foreach ($aVmetas as $nombre_libreria) {
                $sLib = js_load_library($nombre_libreria);
                $sHeader .= $sLib;
            }
        } else if ($sKey == 'javascript') {
            if (!is_array($aVmetas)) {
                continue;
            }
            foreach ($aVmetas as $nombre_archivo) {
                $sJScript = js_loadScript($nombre_archivo);
                $sHeader .= $sJScript;
            }
        }
    }

    return $sHeader;
}

function js_loadScript($sNombreArchivo) {
    global $aConfig;

    $sFileUrl = $aConfig['urls']['js'] . "{$sNombreArchivo}";
    $sFilePath = $aConfig['paths']['js'] . DS . "{$sNombreArchivo}";

    if (file_exists($sFilePath)) {
        return '<script type="text/javascript" src="' . $sFileUrl . '"></script>';
    }
}

function css_loadStylesheet($sNombreArchivo) {
    global $aConfig;

    $sFileUrl = $aConfig['urls']['css'] . "{$sNombreArchivo}";
    $sFilePath = $aConfig['paths']['css'] . DS . "{$sNombreArchivo}";

    if (file_exists($sFilePath)) {
        return '<link href="' . $sFileUrl . '" rel="stylesheet" type="text/css" />';
    }
}

function js_load_library($nombre_libreria) {
    // Verifica si hay parametros
    $params = '';
    if (preg_match('/(Scriptaculous)-([a-zA-Z,]*)/', $nombre_libreria, $match)) {
        $nombre_libreria = $match[1];
        $params = $match[2];
    }

    switch ($nombre_libreria) {
        case "ckeditor": return js_load_ckeditor();
            break;
        case "tiniMCE": return js_load_tinyMCE();
            break;
        case "Jquery": return js_load_JQuery();
            break;
        case "Scriptaculous": return js_load_scriptaculous($params);
            break;
        case "Validation": return js_load_validation();
            break;
        case "JCalendar": return js_load_jcalendar();
            break;
        case "AutoComplete": return js_load_AutoComplete();
            break;
        case "validadorFormHTML5": return js_load_validacionHTML5();
        case "Angular": return js_load_Angular();
            break;
        default: return;
    }
}

function js_load_Angular() {
    global $aConfig;
    $libreria = $aConfig['urls']['libreria'];

    $sHtml = '<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">'
            . '<link rel="stylesheet" href="http://blueimp.github.io/Gallery/css/blueimp-gallery.min.css">'
            . '<link rel="stylesheet" href="' . $libreria . 'angularjs/css/jquery.fileupload-ui.css">'
            . '<noscript><link rel="stylesheet" href="' . $libreria . 'angularjs/css/jquery.fileupload-ui-noscript.css"></noscript>'
            . '<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>'
            . '<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.0.5/angular.min.js"></script>'
            . '<script src="' . $libreria . 'angularjs/js/vendor/jquery.ui.widget.js"></script>'
            . '<script src="http://blueimp.github.io/JavaScript-Load-Image/js/load-image.min.js"></script>'
            . '<script src="http://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>'
            . '<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>'
            . '<script src="http://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>'
            . '<script src="' . $libreria . 'angularjs/js/jquery.iframe-transport.js"></script>'
            . '<script src="' . $libreria . 'angularjs/js/jquery.fileupload.js"></script>'
            . '<script src="' . $libreria . 'angularjs/js/jquery.fileupload-process.js"></script>'
            . '<script src="' . $libreria . 'angularjs/js/jquery.fileupload-image.js"></script>'
            . '<script src="' . $libreria . 'angularjs/js/jquery.fileupload-audio.js"></script>'
            . '<script src="' . $libreria . 'angularjs/js/jquery.fileupload-video.js"></script>'
            . '<script src="' . $libreria . 'angularjs/js/jquery.fileupload-validate.js"></script>'
            . '<script src="' . $libreria . 'angularjs/js/jquery.fileupload-angular.js"></script>'
            . '<script src="' . $libreria . 'angularjs/js/app.js"></script>';

    return $sHtml;
}

function js_load_validacionHTML5() {
    global $aConfig;
    $sJQuery = $aConfig['urls']['js'] . "jquery.min.js";
    $sValidador = $aConfig['urls']['js'] . "jquery.html5form-1.5-min.js";

    $sHtml = '<script language="javascript" type="text/javascript" src="' . $sJQuery . '"></script>'
            . '<script language="javascript" type="text/javascript" src="' . $sValidador . '"></script>';

    return $sHtml;
}

function js_load_tinyMCE() {
    global $aConfig;

    $sTinyMCE = $aConfig['urls']['js'] . "tiny_mce/tiny_mce.js";
    $sInitTinyMCE = $aConfig['urls']['js'] . "tiny_mce/init_tiny_mce.js";
    $sHtml = '<script language="javascript" type="text/javascript" src="' . $sTinyMCE . '"></script>'
            . '<script language="javascript" type="text/javascript" src="' . $sInitTinyMCE . '"></script>';
    return $sHtml;
}

function js_load_ckeditor() {
    global $aConfig;

    $editor = $aConfig['urls']['js'] . "ckeditor/ckeditor/ckeditor.js";
    $finder = $aConfig['urls']['js'] . "ckeditor/ckfinder/ckfinder.js";
    $sHtml = '<script language="javascript" type="text/javascript" src="' . $editor . '"></script>'
            . '<script language="javascript" type="text/javascript" src="' . $finder . '"></script>';
    return $sHtml;
}


function js_load_JQuery() {
    global $aConfig;

    $sHtml = '<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>';
    return $sHtml;
}

function js_load_AutoComplete() {
    global $aConfig;

    $sPrototypeAutoComplete = $aConfig['urls']['js'] . "AutoComplete/AutoComplete.js";

    $sHtml = '<script language="javascript" type="text/javascript" src="' . $sPrototypeAutoComplete . '"></script>';
    return $sHtml;
}

function js_load_scriptaculous($params) {
    global $aConfig;

    $sScriptaculous = $aConfig['urls']['js']
            . "scriptaculous/scriptaculous.js"
            . (!empty($params) ? '?load=' . $params : '');

    $sHtml = '<script language="javascript" type="text/javascript" src="' . $sScriptaculous . '"></script>';
    return $sHtml;
}

function js_load_validation() {
    global $aConfig;

    $sValidation = $aConfig['urls']['js'] . "validation/validation.js";
    $sHtml = '<script language="javascript" type="text/javascript" src="' . $sValidation . '"></script>';
    return $sHtml;
}

function js_load_jcalendar() {
    global $aConfig;

    $sCanedarCss = $aConfig['urls']['css'] . 'calendar-system.css';
    $sCalendarSystem = $aConfig['urls']['js'] . 'jcalendar/calendar.js';
    $sCalendarEs = $aConfig['urls']['js'] . 'jcalendar/lang/calendar-es.js';
    $sCalendarSetup = $aConfig['urls']['js'] . 'jcalendar/calendar-setup.js';

    $sHtml = '<link rel="stylesheet" type="text/css" media="all" href="' . $sCanedarCss . '" title="system" />'
            . '<script type="text/javascript" src="' . $sCalendarSystem . '"></script>'
            . '<script type="text/javascript" src="' . $sCalendarEs . '"></script>'
            . '<script type="text/javascript" src="' . $sCalendarSetup . '"></script>';
    return $sHtml;
}

/**
 * Obtiene la ruta
 * login-form = loginForm
 * login_form = loginForm
 */
function http_get_rout($sRout = null) {
    global $aConfig;

    /*
     * $url = "controlador/modulo?var=val";
     * if(preg_match('/([a-zA-Z-]*)\/([a-zA-Z-]*)\?([a-zA-Z0-9\&=]*)/', $url, $match)) {
     *     $controlador = match[1];
     *     $accion = match[2];
     *     $vars = match[3];
     * }
     */

    $aGet = http_get_request();
    $aPost = http_post_request();

    //if (! is_null($sRout)) {
    
    if(isset($aGet['request'])){
    $sRequest = $aGet['request'];
    $aReq = explode('/', $sRequest);
    }
    

    $sModule = $aConfig['default-module'];
    if (isset($aReq[0]) && !empty($aReq[0])) {
        $sModule = str_toCamelCase($aReq[0]);
    }

    $sAction = $aConfig['default-action'];
    if (isset($aReq[1]) && !empty($aReq[1])) {
        $sAction = str_toCamelCase($aReq[1]);
    }

    unset($_REQUEST['request'], $_GET['request'], $aGet['request']);
    //} else {
    // controlador/accion?var1=val1&var2=val2
    // index.php?request=controlador/accion&var1=val1&var2=val2
    //}

    $aResult['module'] = $sModule;
    $aResult['action'] = $sAction;
    $aResult['get_vars'] = $aGet;
    $aResult['post_vars'] = $aPost;

    return $aResult;
}

function parse_rout($sRout) {
    $aTmp = preg_split("/\?/", $sRout);
    if (isset($aTmp[0])) {
        $sPath = $aTmp[0];
    }
    if (isset($aTmp[1])) {
        $sQuery = $aTmp[1];
    }

    if (!empty($sQuery)) {
        $aQueryParts = preg_split("/\&/", $sQuery);
        $aVars = array();
        foreach ($aQueryParts as $sPart) {
            $aV = preg_split("/=/", $sPart);
            $aVars[$aV[0]] = $aV[1];
        }
        $aRoute['vars'] = $aVars;
    }

    if (isset($aRoute['vars']) && array_key_exists('request', $aRoute['vars'])) {
        $sPath = $aRoute['vars']['request'];
        unset($aRoute['vars']['request']);
    }

    if (!empty($sPath)) {
        $aPathParts = preg_split("/\//", $sPath);
        $aRoute['controller'] = $aPathParts[0];
        $aRoute['action'] = $aPathParts[1];
    }

    return $aRoute;
}

function configuraciones($clave = NULL) {
    if ($clave == NULL) {
        $sSql = " SELECT clave, valor"
                . " FROM configuraciones_de_usuario ";
    } else {
        $sSql = " SELECT clave, valor"
                . " FROM configuraciones_de_usuario "
                . " WHERE clave = :clave ";
        mysql_bind($sSql, array('clave' => $clave));
    }

    $oConnection = db_connect();
    if (!$oConnection) {
        return false;
    }

    $oResult = mysql_query($sSql, $oConnection);

    if (!$oResult) {
        return false;
    }

    $aConfiguraciones = array();
    if (mysql_num_rows($oResult) > 0) {
        while ($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aConfiguraciones[$aRow['clave']] = $aRow['valor'];
        }
    } else {
        return false;
    }

    return $aConfiguraciones;
}

function configuracion_de_usuario($nIdUsuario, $clave = NULL) {
    if ($clave == NULL) {
        $sSql = " SELECT "
                . " if((cu.clave_configuracion = c.clave AND cu.usuario_id = :usuario), "
                . "     cu.clave_configuracion, c.clave) AS clave, "
                . " if((cu.clave_configuracion = c.clave AND cu.usuario_id = :usuario), "
                . "     cu.valor, c.valor) AS valor, "
                . " cu.usuario_id "
                . " FROM configuraciones_de_usuario c "
                . " LEFT JOIN configuraciones_por_usuario cu ON cu.clave_configuracion = c.clave"
                . " WHERE cu.usuario_id = :usuario "
                . " GROUP BY c.clave ";
        mysql_bind($sSql, array('usuario' => $nIdUsuario));

        $aConfigDefault = configuraciones();
        if (!$aConfigDefault)
            $aConfigDefault = array();
    }else {
        $sSql = " SELECT "
                . " if((cu.clave_configuracion = c.clave AND cu.usuario_id = :usuario), "
                . "     cu.clave_configuracion, c.clave) AS clave, "
                . " if((cu.clave_configuracion = c.clave AND cu.usuario_id = :usuario), "
                . "     cu.valor, c.valor) AS valor "
                . " FROM configuraciones_de_usuario c "
                . " LEFT JOIN configuraciones_por_usuario cu ON cu.clave_configuracion = c.clave"
                . " WHERE c.clave = :clave AND cu.usuario_id = :usuario "
                . " GROUP BY c.clave ";
        mysql_bind($sSql, array('usuario' => $nIdUsuario, 'clave' => $clave));
        $aConfigDefault = configuraciones($clave);
        if (!$aConfigDefault)
            $aConfigDefault = array();
    }

    $oConnection = db_connect();
    if (!$oConnection) {
        return false;
    }

    $oResult = mysql_query($sSql, $oConnection);

    if (!$oResult) {
        return false;
    }

    $aConfiguraciones = array();
    if (mysql_num_rows($oResult) > 0) {
        while ($aRow = mysql_fetch_array($oResult, MYSQL_ASSOC)) {
            $aConfiguraciones[$aRow['clave']] = $aRow['valor'];
        }
    }
    $aConfiguraciones = array_merge($aConfigDefault, $aConfiguraciones);

    return $aConfiguraciones;
}

function horario_entrada_salida(&$hora, &$minuto, &$turno, $horario) {
    if (($horario / 1000) > 11):
        $hora = (int) ($horario / 1000) - 12;
        $turno = 'pm';
    else:
        $hora = (int) ($horario / 1000);
        $turno = 'am';
    endif;
    //---->minutos
    $minuto = 0;
    if ((int) ($horario % 1000) > 0):
        $minuto = ((int) ($horario % 1000)) / 10;
    endif;
}

function horario_entrada_salida_formato(&$hora, &$minuto, &$turno, $horario) {
    if (($horario / 1000) > 11):
        $hora = (int) ($horario / 1000) - 12;

        $turno = 'pm';
    else:
        $hora = (int) ($horario / 1000);

        $turno = 'am';
    endif;
    //---->minutos
    $minuto = '00';
    if ((int) ($horario % 1000) > 0):
        $minuto = ((int) ($horario % 1000)) / 10;
        if ($minuto < 10)
            $minuto = '0' . $minuto;
    endif;
}

function suma_dias_fecha($fecha, $ndias) {
    if (preg_match("/([0-9][0-9]){1,2}-[0-9]{1,2}-[0-9]{1,2}/", $fecha))
        list($año, $mes, $dia) = split("-", $fecha);
    $nueva = mktime(0, 0, 0, $mes, $dia, $año) + $ndias * 24 * 60 * 60;
    $nuevafecha = date("Y-m-d", $nueva);

    if ($nuevafecha != $fecha):
        return $nuevafecha;
    else:
        if (preg_match("/([0-9][0-9]){1,2}-[0-9]{1,2}-[0-9]{1,2}/", $fecha))
            list($año, $mes, $dia) = split("-", $fecha);
        $nueva = mktime(0, 0, 0, $mes, $dia, $año) + ($ndias + 1) * 24 * 60 * 60;
        $nuevafecha = date("Y-m-d", $nueva);
        return $nuevafecha;
    endif;
}
