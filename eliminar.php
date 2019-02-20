<?php
    session_start();
    session_name('medico_laguna');
    require_once(dirname(__FILE__) . "/ini.php");  
    require 'phpmailer/class.phpmailer.php';
    
    
    //Eliminar registro
    $sql = " UPDATE registros"
            . " SET"
            . " autorizado=0,"
            . " destacado=0,"
            . " pagado=0,"
            . " elim=1"
            . " WHERE"
            . " id=" . $_SESSION['usuario_id'];   

    $reg = get_one_sql($sql); 
    ///////////////////////////////////////////////////
    
    
    $mail = new PHPMailer();

    $mail->Host = "localhost";
    $mail->Port = 25;

    $mail->CharSet = "UTF-8";
    $mail->FromName = "Tu Medico Laguna";
    $mail->Subject  = "Registro Eliminado";
    $mail->IsHTML();

    $mail->AddAddress("contacto@tumedicolaguna.com");
    

    $mail->AltBody = "Necesita HTML para poder ver este correo.";
    
    
    $sBody .= '<table>
                <tr>
                    <td>Tipo:</td>
                    <td>'.$_SESSION['usuario_tipo'].'</td>
                </tr>        
                <tr>
                    <td>Nombre:</td>
                    <td>'.$_SESSION['nombre_usuario'].'</td>
                </tr>
                <tr>
                    <td>Correo:</td>
                    <td>'.$_SESSION['usuario_login'].'</td>
                </tr>                
                </table>';


    $mail->Body = $sBody;
    $mail->Send();

    header('Location: index.php?salir=true');
?>