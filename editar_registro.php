<?php
    session_start();
    session_name('medico_laguna');
    require_once(dirname(__FILE__) . "/ini.php");  
    require 'phpmailer/class.phpmailer.php';
        
    $_POST = security_removeXss($_POST);
    $error='';
    
   //////////////////////////////////////////////////////////////////////////////////////////////////// 
   //////////////////////////////////////////////////////////////////////////////////////////////////// 
        
    $registro = get_all_data_from('registros', $_SESSION['usuario_id']);      

    if(!isset($_POST['terminos']))
    {        
        $error=1;
    }    
    
    if(! is_valid_email($_POST['correo_contacto']))
    {
        $error=2;
    }
    
    
    if($registro['correo'] != $_POST['correo'])
    {
        $where = "elim = 0"
                . " AND correo='" . $_POST['correo'] ."'" ;    
        $verificar = get_all_actived_inactived('registros', $where, 'id');      

        if(count($verificar)>0)
        {
            $error=3;
        }
    }
    
    if($_POST['password'] != '' || $_POST['password2']!= '')
    {    
        if($_POST['password'] != $_POST['password2'])
        {        
            $error=4;
        }
    }
    else
    {
        $_POST['password'] = Encrypter::decrypt($registro['password']);
    }
    
    if(!isset($_POST['estado_id']) || !isset($_POST['municipio_id']))
    {        
        $error=5;
    }        
    
    if($_POST['tipo']=='medico')
    {            
        if(!isset($_POST['genero']))
        {        
            $error=6;
        }
        if(!isset($_POST['categoria_id']))
        {        
            $error=7;
        }        
    }
    
    if($_POST['tipo']=='hospital')
    {            
        if(!isset($_POST['categoria_id']) || !isset($_POST['subcategoria_id']))
        {        
            $error=8;
        }        
    }    
                    
    if($_POST['tipo']=='servicio')
    {            
        if(!isset($_POST['categoria_id']))
        {        
            $error=9;
        }        
    }        
    
    if($_POST['tipo']=='proveedor')
    {            
        if(!isset($_POST['categoria_id']))
        {        
            $error=10;
        }        
    }  
    
    if($error!='')
    {
        if($_POST['tipo']=='medico') redirect('editar_perfil_medico.php?error=' . $error);
        if($_POST['tipo']=='hospital') redirect('editar_perfil_hospital.php?error=' . $error);
        if($_POST['tipo']=='laboratorio') redirect('editar_perfil_laboratorio.php?error=' . $error);
        if($_POST['tipo']=='servicio') redirect('editar_perfil_servicio.php?error=' . $error);
        if($_POST['tipo']=='proveedor') redirect ('editar_perfil_proveedor.php?error=' . $error);
    }
    
    
    ////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////
    
        db_modificar('registros',$_SESSION['usuario_id'], array(
            'encuesta' => $_POST['encuesta'],
            'horario' => $_POST['horario'],
            'correo_contacto' => $_POST['correo_contacto'],              
            'correo' => $_POST['correo'],
            'password' => Encrypter::encrypt($_POST['password'])            
        ));    
                
        $aseguradoras = array();
        $aseguradoras = $_POST['aseguradora_id'];

        $tarjetas = array();
        $tarjetas = $_POST['tarjeta_id'];
        
        db_eliminar_por_campos('registro_aseguradora',array(
            'registro_id' => $_SESSION['usuario_id']      
        ));

        db_eliminar_por_campos('registro_tarjeta',array(
            'registro_id' => $_SESSION['usuario_id']      
        ));        
        
        foreach($aseguradoras as $aseguradora):
            
                $Asg = db_insertar('registro_aseguradora', array(
                    'registro_id' => $_SESSION['usuario_id'],
                    'aseguradora_id' => $aseguradora            
                ));    
                                    
        endforeach;      
        
        foreach($tarjetas as $tarjeta):
            
                $Tar = db_insertar('registro_tarjeta', array(
                    'registro_id' => $_SESSION['usuario_id'],
                    'tarjeta_id' => $tarjeta            
                ));    
                                    
        endforeach;    
        
    ////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////
        
        
        if($_POST['tipo']=='medico')
        {

            if(!isset($_POST['movil'])){
                $_POST['movil'] = '';
            } 
            
            if(!isset($_POST['radio'])){
                $_POST['radio'] = '';
            }        

            if(!isset($_POST['cedula'])){
                $_POST['cedula'] = '';
            }      
     
            
            $result = db_modificar('medicos', $_SESSION['usuario_id'] , array(
                'id' => (int)$_SESSION['usuario_id'],
                'genero' => $_POST['genero'],
                'nombre' => $_POST['nombre'],
                'apellidos' => $_POST['apellidos'],
                'telefono' => $_POST['telefono'],     
                'calle_contacto' => $_POST['calle'],
                'numero_contacto' => $_POST['num'],
                'colonia_contacto' => $_POST['colonia'],
                'cp_contacto' => $_POST['cp'],
                'estado_id' => (int)$_POST['estado_id'],
                'municipio_id' => (int)$_POST['municipio_id'],                                        
                'telefono_contacto' => $_POST['telfijo'],  
                'celular_contacto' => $_POST['movil'],  
                'radio_contacto' => $_POST['radio'],  
                'categoria_id' => $_POST['categoria_id'],  
                'cedula' => $_POST['cedula']
            ));   
            
            
            $nombre= $_POST['nombre']. $_POST['apellidos'];
            $correo = $_POST['correo'];
        }
        
        
    
 
        
    ////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////
        
        
        
        if($_POST['tipo']=='hospital')
        {

            if(!isset($_POST['fax'])){
                $_POST['fax'] = '';
            }        
        
                        
            $result = db_modificar('hospitales' ,$_SESSION['usuario_id'] , array(
                'id' => (int)$_SESSION['usuario_id'],
                'representante' => $_POST['representante'],
                'nombre' => $_POST['nombre'],
                'telefono' => $_POST['telefono'],     
                'calle_contacto' => $_POST['calle'],
                'numero_contacto' => $_POST['num'],
                'colonia_contacto' => $_POST['colonia'],
                'cp_contacto' => $_POST['cp'],
                'estado_id' => (int)$_POST['estado_id'],
                'municipio_id' => (int)$_POST['municipio_id'],                                        
                'telefono_contacto' => $_POST['telfijo'],  
                'fax_contacto' => $_POST['fax'],  
                'categoria_id' => $_POST['categoria_id'],  
                'subcategoria_id' => $_POST['subcategoria_id']
            ));   
            
            
            $nombre= $_POST['nombre'];
            $correo = $_POST['correo'];
        }        
    
        
    ////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////
        
        
        if($_POST['tipo']=='laboratorio')
        {

            if(!isset($_POST['fax'])){
                $_POST['fax'] = '';
            }        
        
            
            $result = db_modificar('laboratorios', $_SESSION['usuario_id'] , array(
                'id' => (int)$_SESSION['usuario_id'],
                'representante' => $_POST['representante'],
                'nombre' => $_POST['nombre'],
                'telefono' => $_POST['telefono'],     
                'calle_contacto' => $_POST['calle'],
                'numero_contacto' => $_POST['num'],
                'colonia_contacto' => $_POST['colonia'],
                'cp_contacto' => $_POST['cp'],
                'estado_id' => (int)$_POST['estado_id'],
                'municipio_id' => (int)$_POST['municipio_id'],                                        
                'telefono_contacto' => $_POST['telfijo'],  
                'fax_contacto' => $_POST['fax']
            ));   
            
            
            $nombre= $_POST['nombre'];
            $correo = $_POST['correo'];
        }        
            
        
    ////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////        
        
        if($_POST['tipo']=='servicio')
        {

            if(!isset($_POST['fax'])){
                $_POST['fax'] = '';
            }        
        
            
            $result = db_modificar('servicios' ,$_SESSION['usuario_id'] , array(
                'id' => (int)$_SESSION['usuario_id'],
                'representante' => $_POST['representante'],
                'nombre' => $_POST['nombre'],
                'telefono' => $_POST['telefono'],     
                'calle_contacto' => $_POST['calle'],
                'numero_contacto' => $_POST['num'],
                'colonia_contacto' => $_POST['colonia'],
                'cp_contacto' => $_POST['cp'],
                'estado_id' => (int)$_POST['estado_id'],
                'municipio_id' => (int)$_POST['municipio_id'],                                        
                'telefono_contacto' => $_POST['telfijo'],  
                'fax_contacto' => $_POST['fax'],  
                'categoria_id' => $_POST['categoria_id']
            ));   
            
            
            $nombre= $_POST['nombre'];
            $correo = $_POST['correo'];
        }        
        
        
    ////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////
        
        
        if($_POST['tipo']=='proveedor')
        {

            if(!isset($_POST['fax'])){
                $_POST['fax'] = '';
            }        
        
           
            $result = db_modificar('proveedores' , $_SESSION['usuario_id'] ,array(
                'id' => (int)$_SESSION['usuario_id'],
                'representante' => $_POST['representante'],
                'nombre' => $_POST['nombre'],
                'telefono' => $_POST['telefono'],     
                'calle_contacto' => $_POST['calle'],
                'numero_contacto' => $_POST['num'],
                'colonia_contacto' => $_POST['colonia'],
                'cp_contacto' => $_POST['cp'],
                'estado_id' => (int)$_POST['estado_id'],
                'municipio_id' => (int)$_POST['municipio_id'],                                        
                'telefono_contacto' => $_POST['telfijo'],  
                'fax_contacto' => $_POST['fax'],  
                'categoria_id' => $_POST['categoria_id']
            ));   
            
            
            $nombre= $_POST['nombre'];
            $correo = $_POST['correo'];
        }                
        
    /////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////
    
    $mail = new PHPMailer();

    $mail->Host = "localhost";
    $mail->Port = 25;

    $mail->CharSet = "UTF-8";
    $mail->FromName = "Tu Medico Laguna";
    $mail->Subject  = "Registro de tumedicolaguna.com";
    $mail->IsHTML();

    $mail->AddAddress("contacto@tumedicolaguna.com");
    

    $mail->AltBody = "Necesita HTML para poder ver este correo.";
            
    
    $sBody .= '<table>
                <tr>
                    <td>Actualización Perfil:</td>
                </tr>
                <tr>
                    <td>Tipo:</td>
                    <td>'.$_POST['tipo'].'</td>
                </tr>                  
                <tr>
                    <td>Nombre:</td>
                    <td>'.$nombre.'</td>
                </tr>                
                <tr>
                    <td>Correo:</td>
                    <td>'.$correo.'</td>
                </tr>             
                </table>';


    $mail->Body = $sBody;
    $mail->Send();

    header('Location: gracias.php');
    
    
    /////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////
    
?>