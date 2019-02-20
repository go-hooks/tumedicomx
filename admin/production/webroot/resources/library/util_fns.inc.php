<?php

defined('JZ_UPALE') or die('Acceso Incorrecto');


function html_link($text, $url = array(), $options = array(), $msg = NULL) {
 if (is_array($url)) {
  $url = url_format($url[0], $url[1]);
 }
 if (is_array($options)) {
  $opt_string = "";
  foreach ($options as $attr => $val) {
   $opt_string.=" $attr = '$val' ";
  }
 }
 if ($msg != NULL) {
  return "<a onclick='return confirm(\"$msg\")' href='$url' $opt_string>$text</a>";
 } else {
  return "<a href='$url' $opt_string>$text</a>";
 }
}


function es_par($number) {
	
	if ($number % 2 == 0 )
 		return TRUE;
	else
 		return FALSE;
}


function str_toCamelCase($sString) {
    $aKeywords = preg_split("/\s|,|-|_/", $sString);
    $sTmp = '';
    foreach ($aKeywords as $i => $sWord) {
        if ($i == 0) {
            $sTmp .= $sWord;
        } else {
            $sTmp .= ucfirst($sWord);
        }
    }
    return $sTmp;
}

function http_get_request($bSecurityOn = true) {
    if ($bSecurityOn) {
        $aGet = security_removeXss($_GET);
    } else {
        $aGet = $_GET;
    }
    return $aGet;
}

function http_post_request($bSecurityOn = true) {
    if ($bSecurityOn) {
        $aPost = security_removeXss($_POST);
    } else {
        $aPost = $_POST;
    }

    return $aPost;
}

/**
 * Redirecciona a una url
 */
function redirect($url) {
    if (!headers_sent()) {
        header('Location: ' . $url);
        exit;
    } else {
        $html = '<script type="text/javascript">'
                . '    window.location.href="' . $url . '";'
                . '</script>'
                . '<noscript>'
                . '    <meta http-equiv="refresh" content="0;url=' . $url . '" />'
                . '</noscript>';
        echo $html;
        exit;
    }
}

// go_to('login/loginForm', array('message' => '0011101'));
function go_to($sRout, $aParametros = array(), $sUrlFormat = true) {
    $sUrl = url_format($sRout, $aParametros, $sUrlFormat);
    redirect($sUrl);
}

function url_format($sRout, $aParametros = array(), $sUrlFormat = true) {
    global $aConfig;

    $sParam = '';
    if (is_array($aParametros)) {
        $aKeys = array_keys($aParametros);
        foreach ($aKeys as $sKey) {
            $sParam .= $sKey . '=' . $aParametros[$sKey] . '&';
        }
    }

    $sUrl = $aConfig['urls']['base'];
    if ($sUrlFormat) {
        $sUrl .= $sRout . '?';
    } else {
        $sUrl .= 'index.php?request=' . $sRout . '&';
    }

    return $sUrl .= $sParam;
}

/**
 * Remueve un posible ataque XSS
 */
function security_removeXss($string) {
    if (is_array($string)) {
        $return = array();
        foreach ($string as $key => $val) {
            $return[security_removeXss($key)] = security_removeXss($val);
        }
        return $return;
    }

    $string = htmlspecialchars($string);
    return $string;
}

function error_get_message($nError) {
    global $aErrorMessages;

    if (array_key_exists($nError, $aErrorMessages)) {
        return $aErrorMessages[$nError];
    } else {
        return $aErrorMessages['0000001'];
    }
}

function paginar($sRoute, $nPaginaActual, $nTotalReg, $nRegPorPag = 18446744073709551615, $nNavNumEnl = 10) {
    // Obtenemos la pagina actual
    $pagina_actual = (empty($nPaginaActual) ? 1 : $nPaginaActual);

    // Registros en cada pagina
    $registros_x_pagina = $nRegPorPag;

    // Numero de enlaces a las paginas Ej Anterior | 1 2 3 4 5 6 7 8 9 10 | Siguiente
    $nav_num_enlaces = $nNavNumEnl;

    $total_reg = $nTotalReg;

    // Calcular el numero total de paginas
    $total_paginas = ceil($total_reg / $registros_x_pagina);

    // Eliminamos las pariables de pagina del vector _GET
    if (isset($_GET['pg']))
        unset($_GET['pg']);

    // Obtenemos los nombres de las variables a propagar
    $prop_vars = http_get_request();

    // Añadimos las variables a la url.
    $url_pagina .= url_format($sRoute, $prop_vars);

    /** Enlaces de paginacion */
    $navegacion_tmp = array();

    if ($pagina_actual != 1) {
        // Primera pagina
        $pag_url = 1;
        $navegacion_tmp[] = "<a class='pagenum' href='" . $url_pagina . "pg=" . $pag_url . "'><img src='" . URL_IMAGES . "first.png' alt='Primera pagina' /></a>";

        // Pagina anterior
        $pag_url = $pagina_actual - 1;
        $navegacion_tmp[] = "<a class='pagenum' href='" . $url_pagina . "pg=" . $pag_url . "'><img src='" . URL_IMAGES . "previous.png' alt='Anterior' /></a>";
    }

    // Si no se define el numero de numeros a mostrar, mostrara todos los numeros
    if (!isset($nav_num_enlaces)) {
        $nav_desde = 1;
        $nav_hasta = $total_paginas;
    } else {
        $nav_intervalo = ceil($nav_num_enlaces / 2) - 1;
        $nav_desde = $pagina_actual - $nav_intervalo;
        $nav_hasta = $pagina_actual + $nav_intervalo;

        // Si nav_desde es n numero negativo
        if ($nav_desde < 1) {
            // Aregamos la cantidad sobrante al final para mantener el numero de enlaces a mostrar
            $nav_hasta -= ($nav_desde - 1);
            $nav_desde = 1;
        }

        if ($nav_hasta > $total_paginas) {
            $nav_desde -= ($nav_hasta - $total_paginas);
            $nav_hasta = $total_paginas;

            if ($nav_desde < 1)
                $nav_desde = 1;
        }
    }

    // Calcular numeros de paginas
    for ($i = $nav_desde; $i <= $nav_hasta; $i++) {
        if ($i == $pagina_actual) {
            $navegacion_tmp[] = "<span class='currentpage'>" . $i . "</span>";
        } else {
            $navegacion_tmp[] = "<a class='pagenum' href='" . $url_pagina . "pg=" . $i . "'>" . $i . "</a>";
        }
    }

    if ($pagina_actual < $total_paginas) {
        $pag_url = $pagina_actual + 1;
        $navegacion_tmp[] = "<a class='pagenum' href='" . $url_pagina . "pg=" . $pag_url . "'><img src='" . URL_IMAGES . "next.png' alt='Anterior' /></a>";

        $pag_url = $total_paginas;
        $navegacion_tmp[] = "<a class='pagenum' href='" . $url_pagina . "pg=" . $pag_url . "'><img src='" . URL_IMAGES . "last.png' alt='Anterior' /></a>";
    }

    $panel_navegacion = implode("  ", $navegacion_tmp);

    $reg_inicial = ($pagina_actual - 1) * $registros_x_pagina;

    return array(
        'offset' => $reg_inicial,
        'row_count' => $registros_x_pagina,
        'panel_nav' => $panel_navegacion
    );
}

function eliminar_acentos($cadena) {
    $tofind = "ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ";
    $replac = "AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn";

    $txt_clean = strtr($cadena, $tofind, $replac);
    return $txt_clean;
}

function str_textLimit($string, $length, $replacer = '...') {
    if (strlen($string) > $length)
        return (preg_match('/^(.*)\W.*$/', substr($string, 0, $length + 1), $matches) ? $matches[1] : substr($string, 0, $length)) . $replacer;

    return $string;
}

function subir_archivos_servidor($file, $ruta_carpeta, $aMimeTypesPermitidos = array(), $name = NULL) {
    $nombre_archivo = $_FILES[$file]['name'];
    $path_parts = pathinfo($nombre_archivo);
    $extension = $path_parts["extension"];

    $prefijo = date('Ymd');
    $name_file = substr(md5(time()), 0, 6);
    if ($name != NULL):
        $file_name = $prefijo . $name . '_' . $name_file . '.' . $extension;
    else:
        $file_name = $prefijo . '_' . $name_file . '.' . $extension;
    endif;

    if (isset($_FILES[$file]) && $_FILES[$file]['name'] != '') {

        if (is_dir($ruta_carpeta)) {
            if (array_key_exists($_FILES[$file]['type'], $aMimeTypesPermitidos)) {
                if (move_uploaded_file($_FILES[$file]['tmp_name'], $ruta_carpeta . $file_name)) {
                    @mkdir($ruta_carpeta . $file_name, 0755);
                    return $file_name;
                }
            }
        }
    }
    return false;
}
