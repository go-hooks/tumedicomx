<?php 

    require_once("ini.php"); 
    require '../phpmailer/class.phpmailer.php';

    $_POST = security_removeXss($_POST);

    $log = false;
    $error = false;
    
    $where = "mostrar = 1 AND elim = 0";
    $categorias = get_all_actived_inactived('categorias', $where, 'nombre');       

    $where = "autorizado = 1 "
            . " AND elim = 0"
            . " AND "
            . " ("
            . " correo = '" . $_POST['registro']['correo'] . "'"
            . " OR"
            . " correo_contacto = '" . $_POST['registro']['correo'] . "'"
            . " )";
    
    $registro = get_all_actived_inactived('registros', $where, 'id');    

    if(count($registro) == 1)
    {
        $log = true;
    }
    
    if(! $log)
    {
            
            if( $_FILES['Imagen']['error'] === UPLOAD_ERR_OK)
            {    

                $carga_al_servidor = subir_al_servidor($_FILES["Imagen"]);

                if ($carga_al_servidor) 
                {

                    $_POST['registro']['imagen'] = $carga_al_servidor;
                }

            }
            else
            {
                if(! isset($aPost['imagen']))
                {            
                    $_POST['registro']['imagen'] = '';     
                }

            }    



            if(isset($_POST['registro']))
            {

                $aArticulo = $_POST['registro'];

                $valores = array();
                $valores['categoria_id']    = $aArticulo['categoria_id'];
                $valores['fecha']           = date('Y-m-d');
                $valores['autor']           = $aArticulo['autor'];
                $valores['correo']          = $aArticulo['correo'];
                $valores['titulo']          = $aArticulo['titulo'];
                $valores['video']           = $aArticulo['video'];
                $valores['texto_video']     = $aArticulo['texto_video'];
                $valores['texto']           = $aArticulo['texto'];
                $valores['palabras_clave']  = $aArticulo['palabras_clave'];
                $valores['imagen']          = $aArticulo['imagen'];

                $id = db_insertar('articulos',$valores);

                if(! $id)
                {
                    $error = true;
                }
            }
            else
            {
                $error = true;
            }
    }
    
    //////////////////////////////////////////////////////////////////////
    
    if(! $error && $log )
    {
    $mail = new PHPMailer();

    $mail->Host = "localhost";
    $mail->Port = 25;

    $mail->CharSet = "UTF-8";
    $mail->FromName = "Live Better";
    $mail->Subject  = "Noticia Live Better";
    $mail->IsHTML();

    $mail->AddAddress("contacto@tumedicolaguna.com");
    

    $mail->AltBody = "Necesita HTML para poder ver este correo.";
    
    
    $sBody .= '<table>
                <tr>
                    <td>Nombre:</td>
                    <td>'.$valores['autor'] .'</td>
                </tr>
                <tr>
                    <td>Correo:</td>
                    <td>'.$valores['correo'].'</td>
                </tr>                               
                <tr>
                    <td>Titulo:</td>
                    <td>'.$valores['titulo'].'</td>
                </tr>
                </table>';


    $mail->Body = $sBody;
    $mail->Send();      
    }
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="es"> <!--<![endif]-->

    <?php include("includes/metatags.php"); ?>
    
    
    <?php 
            $fondo = "img/bg-index.jpg";        
    ?>   
    
<body class="aviso">
	<!--[if lt IE 7]>
            <p class="chromeframe">Tu navegador es <strong>Obsoleto</strong>. Por favor <a href="http://browsehappy.com/">actualizalo</a> ó <a href="http://www.google.com/chromeframe/?redirect=true">instala el componente Google Chrome Frame</a> para mejorar tu experiencia.</p>
    <![endif]-->
    <div id="header">
        <div class="logo"><a href="index.php"><img src="img/logo.png" width="60px"></a></div>
        <div class="title">Live Better</div>
    </div>
                
    <div id="content" class="articulo">
        
        
        <?php include("includes/header.php"); ?>  
        
        <?php if(! $error && $log): ?>
        <div class="wrap">
            <div class="graciasarticulo">
                <h1>Tu artículo entró en proceso de validación</h1>
                <br/>
                <h3>Recibirás un correo de conformación cuando este aprobado. <br /> Gracias</h3>
            </div>
        </div>
        <?php endif; ?>
        
        <?php if($error && $log): ?>
        <div class="wrap">
            <div class="graciasarticulo">
                <h1>Ocurrio un error al enviar tus datos</h1>
                <br/>
                <h3>Favor de intentarlo nuevamente mas tarde</h3>
            </div>
        </div>
        <?php endif; ?>
        
        <?php if(! $log): ?>
        <div class="wrap">
            <div class="graciasarticulo">
                <h2>
                    Debes estar registrado como medico o institución medica 
                    <br/>                    
                    en nuestro directorio
                </h2>
                <br/>
                <h3>Si deseas registrate da clic <a href="../gratis.php" target="_blank">aquí</a></h3>
            </div>
        </div>
        <?php endif; ?>        
        
    </div>
        

        
    <?php include("includes/footer.php"); ?>
        
</body>
</html>