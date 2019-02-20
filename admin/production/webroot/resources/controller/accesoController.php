<?php
function acceso_denegado()
{
    authenticar();
    $sMsg = load_template('_accesoDenegado.php', array(
        'sMsg' => 'Esta tratando de entrar a una zona restringida.'
    ));
    return $sMsg;
}
