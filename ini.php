<?php
/*
    Nombre del archivo: ini.php
    Descripcion: Cargador de modelos y vistas asi como todo archivo que se nesecita incluir para
                 el buen funcionamiento del cms.
    ---------------------------------------------------------------------------------------
    @autor tumedicomx 2019 ©

    Develop by
    01/01/2019 : tumedico mx

    Updated by
    03/27/2019 : Alejandro Valdés Fuentes (Developer)
*/
    // DEFAULT
    include 'config.php';
    include 'encriptar.php';
    require_once INCLUD_PATH . 'MySQLConnect.class.php';
    require_once INCLUD_PATH . 'data_base_fns.inc.php';
    require_once INCLUD_PATH . 'util_fns.inc.php';
    require_once INCLUD_PATH . 'util_fns_aux.inc.php';
    require_once INCLUD_PATH . 'thumbnail.php';
    