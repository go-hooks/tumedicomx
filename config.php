<?php
/*
    Nombre del archivo: config.php
    Descripcion: Variables globales de configuracion
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

if ($_SERVER['REMOTE_ADDR'] == '127.0.0.1') {
    ini_set('display_errors','1');
    error_reporting(E_ALL ^ E_NOTICE);
} else {
    error_reporting(0);
}
error_reporting(0);
 

date_default_timezone_set('America/Mexico_City');
setlocale(LC_TIME, 'spanish');


// Datos de la base de datos

//define('DB_HOST', 'localhost');
//define('DB_USER', 'root');
//define('DB_PASSWORD', '');
//define('DB_NAME', 'medico_laguna');


define('DB_HOST', '127.0.0.1');
define('DB_USER', 'joejoesm_tumed1'); 	// tumedico_user	tumed1
define('DB_PASSWORD', '?E_v~+lRdn(E');  // =+D{GmPwp.0s		?E_v~+lRdn(E
define('DB_NAME', 'joejoesm_tumedico_bd'); // tumedico_bd

// Paths de los directorios
define('ABS_PATH', dirname(__FILE__).'/');         // Ruta absoluta del admin
define('INCLUD_PATH', 'includes/');                // includes/

define('UP_PATH', 'admin/production/webroot/uploads/');
//define('UP_PATH', 'production/webroot/uploads/');
define('UP_IMG_PATH', UP_PATH . 'images/');
define('UP_FILES_PATH', UP_PATH . 'files/');
define('BR', '<br />');


