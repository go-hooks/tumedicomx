<?php
    session_start();
    session_name('medico_laguna');
    require_once(dirname(__FILE__) . "/ini.php");  
    require 'phpmailer/class.phpmailer.php';
        
    $_POST = security_removeXss($_POST);
    $aContacto = $_POST['contacto'];
    
    $mail = new PHPMailer();

    $mail->Host = "localhost";
    $mail->Port = 25;

    $mail->CharSet = "UTF-8";
    $mail->FromName = "Tu Medico Laguna";
    $mail->Subject  = "Contacto de tumedicolaguna.com";
    $mail->IsHTML();

    $mail->AddAddress("contacto@tumedicolaguna.com");
    /*contacto@tumedicolaguna.com*/
    

    $mail->AltBody = "Necesita HTML para poder ver este correo.";
    
    $correcto = true;
    if($aContacto['nombre'] == "") $correcto = false;
    if($aContacto['correo'] == "") $correcto = false;
    if($aContacto['telefono'] == "") $correcto = false;
    if($aContacto['ciudad'] == "") $correcto = false;    
    if($aContacto['empresa'] == "") $correcto = false;    
    if($aContacto['mensaje'] == "") $correcto = false;
    
    /*if(!$correcto):
        header('Location: gracias_mensaje.php');
        exit;
    endif;*/

    if(!$correcto):
        header('Location: contacto.php?error=1');
        exit;
    endif;
    
    $sBody .= '<table>
                <tr>
                    <td>Nombre:</td>
                    <td>'.$aContacto['nombre'].'</td>
                </tr>
                <tr>
                    <td>Correo:</td>
                    <td>'.$aContacto['correo'].'</td>
                </tr>                
                <tr>
                    <td>Tel&eacute;fono:</td>
                    <td>'.$aContacto['telefono'].'</td>
                </tr>
                <tr>
                    <td>Ciudad:</td>
                    <td>'.$aContacto['ciudad'].'</td>
                </tr>                
                <tr>
                    <td>Empresa:</td>
                    <td>'.$aContacto['empresa'].'</td>
                </tr>                
                <tr>
                    <td>Mensaje:</td>
                    <td>'.nl2br($aContacto['mensaje']).'</td>
                </tr>
                </table>';


    $mail->Body = $sBody;
    $mail->Send();

    header('Location: contacto.php?exito=true');
?>