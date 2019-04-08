<?php
session_start();
session_name('medico_laguna');
        
    require_once(dirname(__FILE__) . "/ini.php");    
    
    $_POST = security_removeXss($_POST);
       
    $correcto = true;
    if($_POST['correo'] == "") $correcto = false;
    if($_POST['password'] == "") $correcto = false;
    
    if($correcto):
        //---->Verifico si los datos de acceso son correctos
        if($aUsuario = existe_usuario_login($_POST['correo'], $_POST['password'])):
                        
            // definimos usuarios_id como IDentificador del usuario en nuestra BD de usuarios
            $_SESSION['usuario_id']     = $aUsuario['id'];

            //definimos usuario_nivel con el Nivel de acceso del usuario de nuestra BD de usuarios
            $_SESSION['usuario_login']  = $aUsuario['correo'];

            //definimos usuario_password con el password del usuario de la sesi�n actual (formato md5 encriptado)
            $_SESSION['usuario_password'] = $aUsuario['password'];

            $nConn = db_connect();   
            //////////////////////////////////////////////////////////////////////////////////////////////////                     

            $sSql = "SELECT * "
                  . "FROM medicos "
                  . "WHERE id= " . $aUsuario['id']. " "
                  . "LIMIT 1"; 

            $nResult = mysql_query($sSql, $nConn);
            $aResult = mysql_fetch_array($nResult, MYSQL_ASSOC);
                
            if(! empty($aResult))
            {        
                $_SESSION['usuario_tipo'] = 'medico';
                $_SESSION['nombre_usuario'] = $aResult['genero'] . ' ' . $aResult['nombre'] . ' ' . $aResult['apellidos']; 
                redirect('index.php?ok=1');
            }
            
            $sSql = "SELECT * "
                  . "FROM hospitales "
                  . "WHERE id= " . $aUsuario['id']; 

            $nResult = mysql_query($sSql, $nConn);
            $aResult = mysql_fetch_array($nResult, MYSQL_ASSOC);
                
            if(! empty($aResult))
            {          
                $_SESSION['usuario_tipo'] = 'hospital';
                $_SESSION['nombre_usuario'] = $aResult['nombre']; 
                redirect('index.php?ok=1');            
            }
    
            $sSql = "SELECT * "
                  . "FROM laboratorios "
                  . "WHERE id= " . $aUsuario['id']; 

            $nResult = mysql_query($sSql, $nConn);
            $aResult = mysql_fetch_array($nResult, MYSQL_ASSOC);
                
            if(! empty($aResult))
            {                
                $_SESSION['usuario_tipo'] = 'laboratorio';
                $_SESSION['nombre_usuario'] = $aResult['nombre']; 
                redirect('index.php?ok=1');
            }
            
            $sSql = "SELECT * "
                  . "FROM servicios "
                  . "WHERE id= " . $aUsuario['id']; 

            $nResult = mysql_query($sSql, $nConn);
            $aResult = mysql_fetch_array($nResult, MYSQL_ASSOC);
                
            if(! empty($aResult))
            {                
                $_SESSION['usuario_tipo'] = 'servicio';
                $_SESSION['nombre_usuario'] = $aResult['nombre']; 
                redirect('index.php?ok=1');
            }            
            
            $sSql = "SELECT * "
                  . "FROM proveedores "
                  . "WHERE id= " . $aUsuario['id']; 

            $nResult = mysql_query($sSql, $nConn);
            $aResult = mysql_fetch_array($nResult, MYSQL_ASSOC);
                
            if(! empty($aResult))
            {                         
                $_SESSION['usuario_tipo'] = 'proveedor';
                $_SESSION['nombre_usuario'] = $aResult['nombre']; 
                redirect('index.php?ok=1');
            }            
                        
        endif;
    endif;
    
    header('Location: index.php?error=1');