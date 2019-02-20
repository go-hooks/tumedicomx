
        <div id="date">
        
            <?php 
                            
                date_default_timezone_set('America/Mexico_City');      
                setlocale (LC_TIME,"spanish");

                $dias = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
                $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                
                echo $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;                            
            
            ?>            
        
        </div>



        <div class="social">
            <div class="facebook"><a href="https://www.facebook.com/tumedicolaguna" target="_blank"><img src="img/icon-facebook.png"></a></div>
            <div class="twitter"><a href="https://twitter.com/TuMedicolaguna" target="_blank"><img src="img/icon-twitter.png"></a></div>
            <div class="instagram"><a href="http://instagram.com/tumedicolaguna" target="_blank"><img src="img/icon-instagram.png"></a></div>                        
            <div class="medico"><a href="http://tumedicomx.com" target="_blank"><img src="img/icon-medico.png"></a></div>
            
        </div>



        <div class="menu">
            
            <a href="index.php">
                <div class="home"><img src="img/ico-home.png" ></div>
            </a>
                        
            <?php foreach ($categorias as $categoria): ?>
            
                <a href="index.php?categoria=<?php echo$categoria['id'] ?>">
                    <div class="secc" style="background-color: <?php echo $categoria['color'] ?>">                    
                            <span><?php echo replace($categoria['nombre']) ?></span>                    
                    </div>
                </a>           
            
            <?php endforeach; ?>
                        
            
        </div>


        <div id="tools">
            
            
            <div id="search">
                
                <form method="POST" action="index.php">
                    <input type="text" required="" name="buscar" placeholder="Buscar" value="<?php if(isset($_POST['buscar'])) echo $_POST['buscar'];  ?>">
                    <input type="submit" value="">
                </form>
                
            </div>
            
            
            <div id="register">
                <form id="formRegister" method="POST" name="registro">
                    
                    <input type="hidden" name="registrar" value="1">
                    <input type="text" name="nombre" placeholder="Nombre" required="">
                    <input type="email" name="correo" placeholder="Correo electrónico" required="">
                    <select id="categorias" name="categorias[]" class="cats multiselect" multiple="multiple" required="">

                        <?php foreach ($categorias as $categoria): ?>

                            <option value="<?php echo $categoria['id'] ?>"><?php echo replace($categoria['nombre']) ?></option>

                        <?php endforeach; ?>                        
                                                
                    </select>
                    <a class="fancy" href="#informacion">
                        <img src="img/interrogacion.png" width="25px">
                    </a>
                    
                    
                    <input type="submit" value="ENVIAR">
                    
                    
                </form>
                                             
            </div>
        </div> 


        <div id="informacion" style="display:none;">
            <h4 style="font-family:'Lato',sans-serif; text-align: justify">
                Inscríbete a una lista de correos para recibir la información de tu interés.<br/><br/> 
                Puedes elegir todas las categorías o sólo una en particular.<br/><br/>
                Al dar click en el botón de Enviar<br/>
                estas aceptando nuestros Términos y Condiciones
            </h4>
        </div>

        <a class="fancy" href="#enviar" id="enviarclick"></a>
        <div id="enviar" style="display:none;">
            <h4 style="font-family:'Lato',sans-serif; text-align: justify">
                Muchas Gracias por inscribirte a nuestra lista de correos.<br/><br/> 
                En breve empezarás a recibir las noticias de tu interés.
            </h4>
        </div>
        

        <a class="fancy" href="#buscar" id="buscarclick"></a>
        <div id="buscar" style="display:none;">
            <h4 style="font-family:'Lato',sans-serif; text-align: justify">
                No se encontraron resultados de acuerdo al criterio de busqueda solicitado                
            </h4>
        </div>
        

<?php 

if(isset($_POST['registrar']))
{
                
        $registro = $_POST;
        
        //Eliminar registros 
        $sql = "Delete FROM suscripciones where correo = '" . $registro['correo'] . "'";
        get_one_sql($sql);
        //Fin eliminar registros
        
        
        //Agregar registros
        foreach($registro['categorias'] as $categoria)
        {

            $valores = array();
            $valores['nombre']          = $registro['nombre'];
            $valores['correo']          = $registro['correo'];
            $valores['categoria_id']    = $categoria;

            $id = db_insertar('suscripciones',$valores);
        
        }
        //Fin agregar registros


        //Enviar Correo
        require '../phpmailer/class.phpmailer.php';
        
        $mail = new PHPMailer();

        $mail->Host = "localhost";
        $mail->Port = 25;

        $mail->CharSet = "UTF-8";
        $mail->FromName = "Live Better";
        $mail->Subject  = "Suscripcion de Live Better";
        $mail->IsHTML();

        $mail->AddAddress("contacto@tumedicolaguna.com");


        $mail->AltBody = "Necesita HTML para poder ver este correo.";

        $sBody .= '<table>
                    <tr>
                        <td>Nombre:</td>
                        <td>'.$registro['nombre'].'</td>
                    </tr>
                    <tr>
                        <td>Correo:</td>
                        <td>'.$registro['correo'].'</td>
                    </tr>                               
                    </table>';

        $mail->Body = $sBody;
        $mail->Send();        

        
}

?>