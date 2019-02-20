<?php
/*
    Nombre del archivo: ini.php
    Descripcion: Cargador de modelos y vistas asi como todo archivo que se nesecita incluir para
                 el buen funcionamiento del cms.
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
    // DEFAULT
    include 'config.php';
    include 'encriptar.php';
    require_once INCLUD_PATH . 'MySQLConnect.class.php';
    require_once INCLUD_PATH . 'data_base_fns.inc.php';
    require_once INCLUD_PATH . 'util_fns.inc.php';
    require_once INCLUD_PATH . 'util_fns_aux.inc.php';
    require_once INCLUD_PATH . 'thumbnail.php';
    