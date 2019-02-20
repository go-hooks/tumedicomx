<?php

function imagen_read() {
    $sSql = 'SELECT * FROM '
            . ' imagen i';

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



function salvar_imagen($aData) {
    
    if (isset($aData['id'])) {
        $sSql = "UPDATE imagen SET "
                . "`imagen`             = :imagen, "
                . "`home_color`         = :home_color, "                
                . "`noticias_imagen`    = :noticias_imagen, "
                . "`noticias_color`     = :noticias_color, "                   
                . "`contacto_imagen`    = :contacto_imagen, "
                . "`contacto_color`     = :contacto_color, "                                   
                . "`terminos_imagen`    = :terminos_imagen, "
                . "`terminos_color`     = :terminos_color, "                  
                . "`url`                = :url, "
                . "`home_imagen`        = :home_imagen "                
                . "WHERE id =" . $aData['id'];
        $exit = "Imagen exitosamente <strong>actualizada</strong>";
    } else {
        $sSql = "INSERT INTO imagen ("
                . " home_imagen, "
                . " home_color, "
                . " noticias_imagen, "
                . " noticias_color, "                
                . " contacto_imagen, "
                . " contacto_color, "                   
                . " terminos_imagen, "
                . " terminos_color, "                   
                . " url, "
                . " imagen) "
                . "VALUES ("                
                . " :home_imagen, "
                . " :home_color, "                
                . " :noticias_imagen, "
                . " :noticias_color, "                                
                . " :contacto_imagen, "
                . " :contacto_color, "                  
                . " :terminos_imagen, "
                . " :terminos_color, "                 
                . " :url, "
                . " :imagen);";
        $exit = "Imagen exitosamente <strong>creada</strong>";
    }

    $required = array(
        'imagen'            => $aData['imagen'],
        'url'               => $aData['url'],      
    );
    
    
    if (in_array('', $required)) {
        set_flash('La imagen no puede estar vacía', 'warning');
        return false;
    }   
    
    mysql_bind($sSql, array(
        'imagen'            => $aData['imagen'],
        'url'               => $aData['url'],
        'home_imagen'       => $aData['home_imagen'],
        'home_color'        => $aData['home_color'],        
        'noticias_imagen'   => $aData['noticias_imagen'],
        'noticias_color'    => $aData['noticias_color'],         
        'contacto_imagen'   => $aData['contacto_imagen'],
        'contacto_color'    => $aData['contacto_color'], 
        'terminos_imagen'   => $aData['terminos_imagen'],
        'terminos_color'    => $aData['terminos_color'],         
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




