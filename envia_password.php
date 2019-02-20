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
    $mail->Subject  = "Recuperar contraseña - tumedicolaguna.com";
    $mail->IsHTML();    
    
    $correcto = true;
    if($aContacto['correo'] == "") $correcto = false;
        
    if(!$correcto):
        header('Location: recuperar-password.php?error=1');
        exit;
    endif;

    //Verificar correo
    //////////////////////////////////////////////////////////////////////////
    
    $sql = " SELECT * FROM registros r"
            . " WHERE"
            . " r.elim=0 AND r.correo='" . $aContacto['correo'] . "'" ;

    $registro = get_one_sql($sql);
    
    if(! $registro)
    {
        header('Location: recuperar-password.php?error=1');
        exit;        
    }
        
    //Recuperar contraseña
    //////////////////////////////////////////////////////////////////////////
    $contraseña = Encrypter::decrypt($registro['password']);
    
    
    $mail->AddAddress($aContacto['correo']);
    
    $mail->AltBody = "Necesita HTML para poder ver este correo.";

    
    $sBody .= '<table>
                <tr>
                    <td>Correo:</td>
                    <td>'.$aContacto['correo'].'</td>
                </tr>                
                <tr>
                    <td>Contraseña:</td>
                    <td>'.$contraseña.'</td>
                </tr>               

                </table>';


    $mail->Body = $sBody;
    $mail->Send();

    header('Location: gracias_password.php');
?>