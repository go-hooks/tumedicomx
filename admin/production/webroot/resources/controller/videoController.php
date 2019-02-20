<?php

defined('JZ_UPALE') or die('Acceso Incorrecto');
define('CONTROLLER', 'Video');


require_once MODEL_PATH . DS . 'videoModel.php';

authenticar();

if (!hasPermission('acceso_video')) {
	
    go_to('acceso/denegado');
	
}


function video_default() {
    if (!hasPermission('video_nuevo')) {
        go_to('acceso/denegado');
    }
    return video_editar();
}



function video_aplicar() {

    if (!hasPermission('video_nuevo')) {
        go_to('acceso/denegado');
    }

    defined('BR') or define('BR', '<br />');

    set_header(array(
        'section' => 'Nuevo Video',
        'libraries' => array('Jquery')
    ));

    $aPost = http_post_request();
 
    salvar_video($aPost);    
    go_to('video');
    
}

function video_editar( ) {

    if (!hasPermission('video_editar')) {
        go_to('acceso/denegado');
    }

    set_header(array(
        'section' => 'Video',
        'libraries' => array('Jquery')
    ));

    $aGet = http_get_request();
    
    $video = video_read();  
	
    set_header(array('section' => 'Edici&oacute;n del video'));

    return load_template(CONTROLLER . DS . "_videoForm.php", array('video' => $video));

}

?>