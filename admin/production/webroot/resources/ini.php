<?php
/* ================================================================== *
    Nombre del archivo: ini.php
    Descripcion: Incluye archivos necesarios
    -----------------------------------------------------------------
    @autor Jesus Nazareth Gtz Hernandez <jesusnazarethgh@gmail.com>
    @version 1.0

    Develop by
    17/09/2009 : Jesus Nazareth Gutierrez Hernandez
 * ================================================================== */

defined('JZ_UPALE')
    or die('Acceso Incorrecto');

require_once 'resources/config.php';
require_once LIBRARY_PATH . DS . 'util_fns.inc.php';
require_once LIBRARY_PATH . DS . 'database_fns.inc.php';
require_once LIBRARY_PATH . DS . 'auth_fns.inc.php';
require_once LIBRARY_PATH . DS . 'permisos_fns.inc.php';
require_once LIBRARY_PATH . DS . 'app_fns.inc.php';
require_once LIBRARY_PATH . DS . 'static_info_selects_fns.inc.php';
require_once LIBRARY_PATH . DS . 'debugging_flashing.inc.php';
require_once LIBRARY_PATH . DS . 'pagination_helpers.inc.php';
require_once LIBRARY_PATH . DS . 'encriptar.php';