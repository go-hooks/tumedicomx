<?php

function replace($message)
{
    
 $search = explode(",","Ã¡,Ã©,Ã­,Ã³,Ãº,Ã±,ÃÃ¡,ÃÃ©,Ã,ÃÃ³,ÃÃº,Ã‘,á,é,í,ó,ú,ñ,Ãš,Ã“,Ã‰,Ã,Â");
 $replace = explode(",","á,é,í,ó,ú,ñ,Á,É,Í,Ó,Ú,Ñ,á,é,í,ó,ú,ñ,Ú,Ó,É,Á,");
 
 $message= str_replace($search, $replace, $message);
 
 return $message; 
    
 
}

function borrar_archivo_servidor($fileArray) {
    
    $path = UP_IMG_PATH;
               
        if (unlink($path . $fileArray)) {
             return TRUE;
        } else {             
             return FALSE;
        }

    
}



function subir_al_servidor($fileArray, $mymes = array()) {
    $path = UP_IMG_PATH;

    if ($fileArray["error"] == UPLOAD_ERR_OK) {

        $tmp_name = $fileArray["tmp_name"];

        $name = uniqid();

        if (!empty($mymes)) {
            $allowed = $mymes;
        } else {
            $allowed = array(
                'image/jpeg' => 'jpeg',
                'image/jpg' => 'jpg',
                'image/png' => 'png',
                'image/gif' => 'gif',
            );
        }

        if (in_array($fileArray['type'], array_flip($allowed))) {
            $name .= "." . $allowed[$fileArray['type']];

            if (move_uploaded_file($tmp_name, $path . $name)) {
                return $name;
            } else {               
                return FALSE;
            }
        } else {            
            return FALSE;
        }
    }
}

function header_no_cache()
{
    if (! headers_sent()) {
        // No almacenar en el cache del navegador esta página.
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");             		// Expira en fecha pasada
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");		// Siempre página modificada
        header("Cache-Control: no-cache, must-revalidate");           		// HTTP/1.1
        header("Pragma: no-cache");
    }
}

function is_valid_email($email)
{
    // Checamos que contenga la arroba (@),
    // y la longitud de caracteres sea correcta.
    if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
        // Si es incorrecta, retornamos false
        return false;
    }
    // Separamos en secciones la direccion de email
    $email_array = explode("@", $email);
    $local_array = explode(".", $email_array[0]);
    for ($i = 0; $i < sizeof($local_array); $i++) {
        if(!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) {
            return false;
        }
    }
    // Verificamos si el dominio es una IP, si no,
    // checamos que sea un dominio valido
    if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) {
        $domain_array = explode(".", $email_array[1]);
        if (sizeof($domain_array) < 2) {
            return false;
        }
        for ($i = 0; $i < sizeof($domain_array); $i++) {
            if(!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i])) {
                return false;
            }
        }
    }
    return true;
}

function subir_archivos_servidor($file, $ruta_carpeta, $aMimeTypesPermitidos = array(), $name = NULL)
{   
    
    $nombre_archivo = $_FILES[$file]['name'];
    $path_parts = pathinfo($nombre_archivo);
    $extension = $path_parts["extension"];
    
    $prefijo = date('Ymd');
    $name_file = substr(md5(time()), 0, 6);
    if($name != NULL):
        $file_name = $prefijo . $name . '_' . $name_file . '.' . $extension;
    else:
        $file_name = $prefijo . '_' . $name_file . '.' . $extension;
    endif;

    if(isset($_FILES[$file]) && $_FILES[$file]['name'] != ''){

        if(is_dir($ruta_carpeta)){

            if(array_key_exists($_FILES[$file]['type'], $aMimeTypesPermitidos)){
                if (move_uploaded_file($_FILES[$file]['tmp_name'], $ruta_carpeta . $file_name)){
                    @mkdir($ruta_carpeta . $file_name, 0755);
                    return $file_name;
                }
            }
        }

    }
    return false;
}


// Limita un texto a una longitud fija
function str_textLimit($string, $length, $replacer = '...')
{
    if(strlen($string) > $length) {
        return (preg_match('/^(.*)\W.*$/', substr($string, 0, $length+1), $matches) ? 
                    $matches[1] : substr($string, 0, $length)) . $replacer;
    }

    return $string;
} 

// Purga el contenido de un string o un array para evitar ataques XSS
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

function redirect($url){
    if (! headers_sent()) {
        header('Location: '.$url);
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

