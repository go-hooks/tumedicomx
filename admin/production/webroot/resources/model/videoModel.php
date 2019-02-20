<?php

function video_read() {
    $sSql = 'SELECT * FROM '
            . ' video v';

    $oConnection = db_connect();

    if (!$oConnection) {
        return false;
    }

    $result = mysql_query($sSql, $oConnection);

    if (mysql_num_rows($result) > 0) {
        return mysql_fetch_array($result, MYSQL_ASSOC);
    } else {
        return false;
    }
}



function salvar_video($aData) {
    
    
    if (isset($aData['id'])) {
        $sSql = "UPDATE video SET "
                . "`video` = :video "
                . "WHERE id =" . $aData['id'];
        $exit = "Video exitosamente <strong>actualizado</strong>";
    } else {
        $sSql = "INSERT INTO video ("
                . " video) "
                . "VALUES ("                
                . ":video);";
        $exit = "Video exitosamente <strong>creado</strong>";
    }

    $required = array(
        'video' => $aData['video']
    );
    
    
    if (in_array('', $required)) {
        set_flash('El video no puede estar vacío', 'warning');
        return false;
    }   
    
    mysql_bind($sSql, array(
        'video' => $aData['video']
    ));

    $oConnection = db_connect();

    if (!$oConnection) {
        return false;
    }

    
    $result = mysql_query($sSql, $oConnection);
    if ($result) {
        set_flash($exit, 'success');
        return true;
    }
}




