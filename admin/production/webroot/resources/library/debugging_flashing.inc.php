<?php

/* ================================================================== *
 * 
 * Nombre del archivo: debugging_flashing.inc.php 
 * Descripcion: Recive desde controlador, modelos y vistas llamadas para 
 * depurado de datos y otras noticaciones para el cliente.
 * 
 * Requiere bootstrap.min.css bootstrap.min.js y Jquery cargados en Frontend.
  -----------------------------------------------------------------
  @autor Daniel Lepe Ayala <fallen.quetzalcoatl@gmail.com>
  @version 1.0

  Develop by
  21/01/2014 : Daniel Lepe Ayala
 * ================================================================== */

/*
 * Recibe una variable y la imprime INSITE. 
 * 
 * Ademas indica nombre de archivo y linea donde ha sido llamado.
 * */

function debug($var) {
    $id = uniqid();
    $backtrace = debug_backtrace();
    echo "<div id='$id'>"
    . "<code class=''>"
    . "<strong>FILE: " . $backtrace[0]['file'] . "</strong>" . "<BR />"
    . "<strong>LINE: " . $backtrace[0]['line'] . "</strong>" . "<BR />"
    . "<pre>";
    print_r($var);
    echo "</pre>"
    . "</code>"
    . "</div>";
}

function set_flash($msg, $cnf = 'info') {
    if (!empty($msg)) {

        switch ($cnf) {
            case 'danger': case 'success': case 'info': case 'warning':
                $class = "alert alert-$cnf alert-dismissable";
                $msg = "<div class='$class'>"
                        . "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"
                        . $msg
                        . "</div>";

                break;
            case null: default:
                $class = "alert alert-info";
                $msg = "<div class='$class'>"
                        . $msg
                        . "</div>";

                break;
        }

        $_SESSION['FLASH'] = array(
            'msg' => $msg
        );
        return true;
    } else {
        return false;
    }
}

function flash() {

    if (isset($_SESSION['FLASH']) && !empty($_SESSION['FLASH']['msg'])) {
        echo $_SESSION['FLASH']['msg'];
        unset($_SESSION['FLASH']);
    }

    return true;
}

function borrar_archivo_servidor($fileArray) {
    
    $path = APP_PATH . DS . "uploads" . DS . "images" . DS;
               
        if (unlink($path . $fileArray)) {
             return TRUE;
        } else {
             set_flash('No se ha podido borrar el archivo', 'danger');
             return FALSE;
        }

    
}



function subir_al_servidor($fileArray, $mymes = array()) {
    $path = APP_PATH . DS . "uploads" . DS . "images" . DS;

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
                set_flash('No se ha podido cargar el archivo', 'danger');
                return FALSE;
            }
        } else {
            set_flash('Tipo de archivo incorrecto', 'warning');
            return FALSE;
        }
    }
}

function user($key = NULL) {
    if ($key == NULL) {
        return $_SESSION;
    } else {
        switch ($key) {
            case 'id':
                return $_SESSION['upale_usuario_id'];
                break;
            case 'name':
                return $_SESSION['upale_usuario_nombre'];
                break;
            case 'username':
                return $_SESSION['upale_usuario'];
                break;
            case 'group_id':
                return $_SESSION['upale_usuario_departamento'];
                break;
            default:
                return $_SESSION['upale_usuario_id'];
                break;
        }
    }
}
