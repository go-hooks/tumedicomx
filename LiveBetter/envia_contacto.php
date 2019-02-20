<?php
    require_once("ini.php"); 
    require '../phpmailer/class.phpmailer.php';
        
    $_POST = security_removeXss($_POST);
    $aContacto = $_POST['contacto'];
    
    $mail = new PHPMailer();

    $mail->Host = "localhost";
    $mail->Port = 25;

    $mail->CharSet = "UTF-8";
    $mail->FromName = "Live Better";
    $mail->Subject  = "Contacto de Live Better";
    $mail->IsHTML();

    $mail->AddAddress("contacto@tumedicolaguna.com");
    

    $mail->AltBody = "Necesita HTML para poder ver este correo.";
    
    $correcto = true;
    if($aContacto['nombre'] == "") $correcto = false;
    if($aContacto['correo'] == "") $correcto = false;
    if($aContacto['mensaje'] == "") $correcto = false;
        
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
                    <td>Mensaje:</td>
                    <td>'.nl2br($aContacto['mensaje']).'</td>
                </tr>
                </table>';


    $mail->Body = $sBody;
    $mail->Send();

    header('Location: contacto.php?exito=true');
?>