<?php
    session_start();
    session_name('medico_laguna');

    $ubicacion='inicio';
    
    require_once(dirname(__FILE__) . "/ini.php");    
    include('includes/metatags.php'); 
            
    $where = "elim = 0";
    $catalogos = get_all_actived_inactived('catalogos_proveedores', $where, 'nombre');     

    $where = "elim = 0";
    $aseguradoras = get_all_actived_inactived('aseguradoras', $where, 'id');     
    
    $where = "elim = 0";
    $tarjetas = get_all_actived_inactived('tarjetas', $where, 'id');     

    $where = "elim = 0";
    $estados = get_all_actived_inactived('estados', $where, 'id');     

    
?>

<script type="text/javascript" src="municipios.js"></script>
<script type="text/javascript" src="js/validacion.js"></script>

<title>Tu Medico Laguna</title>
</head>
<body id="registro">

<?php include('includes/header.php'); ?>
<section class="wrapper">

    <?php include('includes/search.php'); ?>

    <div class="registro">
        <h2>REGISTRO PREMIUM PROVEEDORES<br>
            <span>Si deseas registrarte como profesional, llena el siguiente formulario y comienza a disfrutar de los beneficios.</span></h2>
        
            <span style="color:red">
            <?php
            
                if(isset($_GET['error']))
                {
                    
                    if($_GET['error']==1) echo 'Debe aceptar terminos y condiciones.';
                    if($_GET['error']==2) echo 'El correo no es valido.';
                    if($_GET['error']==3) echo 'El usuario ya ha sido registrado.';
                    if($_GET['error']==4) echo 'Las contraseñas no coinciden.';
                    if($_GET['error']==5) echo 'Seleccione estado y municipio.';
                    
                    if($_GET['error']==10) echo 'Seleccione categoria.';

                    
                }
            
            ?>
            </span>
        
        
    </div>

<form enctype="multipart/form-data" class="clear" name="contacto"  method="post" action="envia_registro_premium.php" onsubmit="return validacion(correo_contacto,password,password2)">     
    
    <input type="hidden" name="tipo" value="proveedor">
    
    <div class="registro">
        <p class="subt">ENCUESTA</p>
        
        <table width="100%">
            <tr>
                <th height="80"> ¿Cómo te enteraste de nosotros?  
                    
                    <select class="txt txt2" id="encuesta" name="encuesta" required="">

                        <option value="">-Seleccione una opcion-</option>
                        <option value="Anuncio Publicitario" >Anuncio Publicitario</option>
                        <option value="Correo Electrónico">Correo Electrónico</option>
                        <option value="Recomendaciones" >Recomendaciones</option>
                        <option value="Redes Sociales" >Redes Sociales</option>                                                                                                
                        <option value="Vía telefónica" >Vía telefónica</option>

                    </select>   
                    
                </th>
            </tr>
            
        </table>
        
    </div>
    
    <div class="registro">
        <p class="subt">DATOS BASICOS</p>        
        <p>REPRESENTANTE LEGAL* <input required="" class="txt" type="text" name="representante"></p>
        <p>NOMBRE DE INSTITUCIÓN* <input required="" class="txt" class="txt" type="text" name="nombre"></p>
        <p>USUARIO* <input required="" class="txt" type="text" name="correo"></p>
        <p>TELÉFONO* <input required="" class="txt" type="text" name="telefono"></p>
        <p>CONTRASEÑA* <input required="" class="txt" type="password" name="password"></p>
        <p>CONFIRMAR CONTRASEÑA* <input required="" class="txt" type="password" name="password2"></p>
    </div>

    <div class="registro">
        <p class="subt">DATOS DE CONTACTO</p>
        
        <p>CORREO* <input required="" class="txt" type="text" name="correo_contacto"></p>
        
        <table width="850" height="130">
            <tr>
                <td>CALLE* <input required="" class="txt txt3" type="text" name="calle"></td>
                <td width="210">NUM* <input required="" class="txt txt1" class="txt" type="text" name="num"></td>
            </tr>
            <tr>
                <td>COLONIA* <input required=""  class="txt txt3" type="text" name="colonia"></td>
                <td>CP*. <input required="" class="txt txt1" type="text" name="cp"></td>
            </tr>
        </table>

        <table width="850" height="220">
            <tr>
                <td width="450">ESTADO* 
                    
                    <select  required="" class="txt txt2" name="estado_id" id="estado_id" onchange="municipios(this.value)">                                                    
                        
                        <option value="0"> </option>
                        
                        <?php foreach($estados as $estado): ?>
                        
                            <option value="<?php echo $estado['id'] ?>" > <?php echo replace($estado['estado']) ?> </option>
                        
                        <?php endforeach; ?>
                        
                    </select>                     
                
                </td>
                
                
                <td>MUNICIPIO*
                    
                    <select required="" class="txt txt2" name="municipio_id" id="municipio_id">                                                                            
                        
                    </select>                      
                    
                
                </td>
                
            </tr>
            <tr>
                <td>TELÉFONO FIJO* <input required="" class="txt txt2" class="txt" type="text" name="telfijo"></td>
                <td>FAX <input class="txt txt2" type="text" name="fax"></td>
            </tr>
        </table>
        
         <p>HORARIO <input class="txt" type="text" name="horario"></p>
        
        <div class="clear"></div>
    </div>

    <div class="registro">
        <p class="subt">CLASIFICACIÓN</p>

        <table width="100%">
            <tr>
                <th height="80">CATEGORIA*
                
                    <select required=""  class="txt txt2" name="categoria_id" id="categoria_id">                                                                                                   
                        
                        <?php foreach($catalogos as $catalogo): ?>
                        
                            <option value="<?php echo $catalogo['id'] ?>" > <?php echo replace($catalogo['nombre']) ?> </option>
                        
                        <?php endforeach; ?>
                        
                    </select> 
                </th>

            </tr>
        </table>        
        

            
      <table width="100%">
            <tr>
                <th width="140" valign="top">ASEGURADORAS:</th>
                <td>
                    <ul>

                        <?php foreach($aseguradoras as $key=>$aseguradora): ?>
                            
                            <li>
                                <input type="checkbox" name="aseguradora_id[]" value="<?php echo $aseguradora['id'] ?>"><?php echo $aseguradora['nombre'] ?><br>                                
                                <img src="<?php if($aseguradora['imagen']!='') echo UP_IMG_PATH . $aseguradora['imagen'] ?>">
                            </li>

                            <?php if(!(($key+1)%5)): ?>
                            
                            <?php endif; ?>
                            
                                                
                        <?php endforeach; ?>
                        
                            <?php if(($key+1)%5): ?>
                            <hr>
                            <?php endif; ?>
                            <hr>
                    </ul>
                </td>
            </tr>

            <tr>
                <th valign="top">FORMAS DE PAGO:</th>
                <td>
                    <ul>

                        <?php foreach($tarjetas as $key=>$tarjeta): ?>

                            
                            <li>
                                <input type="checkbox" name="tarjeta_id[]" value="<?php echo $tarjeta['id'] ?>"><?php echo $tarjeta['nombre'] ?><br>                                
                                <img src="<?php if($tarjeta['imagen']!='') echo UP_IMG_PATH . $tarjeta['imagen'] ?>">
                            </li>


                            <?php if(!(($key+1)%5)): ?>
                            
                            <?php endif; ?>
                            
                        <?php endforeach; ?>
                            
                            <?php if(($key+1)%5): ?>
                            <hr>
                            <?php endif; ?>
                            
                    </ul>
                </td>
            </tr>
        </table>

              
    </div>

    <div class="datosminisitio registro">
        <p class="subt">DATOS PARA MINISITIO</p>

        <table width="850" height="250">
            <tr>
                <td>LOGOTIPO (400 x 375)</td>
                <td><input type="file" name="Imagen" id="Imagen" /></td>
            </tr>            
            <tr>
                <td>URL</td>
                <td><input class="txt" class="txt" type="text" name="url" placeholder="URL"></td>
            </tr>            
            <tr>
                <td valign="top">DESCRIPCIÓN</td>
                <td><textarea name="descripcion" class="txtarea"></textarea></td>
            </tr>
            <tr>
                <td>REDES SOCIALES </td>
                <td><img src="img/ico-faceregistro.jpg"><input type="text" class="txt txt1" name="facebook" placeholder="URL">
                    <img src="img/ico-twitterregistro.jpg"><input type="text" class="txt txt1" name="twitter" placeholder="URL">
                    <img src="img/ico-skype.jpg"><input type="text" class="txt txt1" name="skype" placeholder="URL">
                </td>
            </tr>
            
            <tr>
                <td>SITIO WEB</td>
                <td><input class="txt" class="txt" type="text" name="sitio_web" placeholder="URL"></td>
            </tr> 

            <tr>
                <td>UBICACIÓN DEL MAPA</td>
                <td><input class="txt" class="txt" type="text" name="mapa"></td>
            </tr> 

            <tr>
                <td>*BANNER (400 x 375)</td>
                <td><input type="file" name="Banner" id="Banner" /></td>
            </tr>
            
        </table>
        
        <div class="clear"></div>
    </div>
    
    <div class="registro">
        <p class="radios">TIPO SUBSCRIPCIÓN 
            <input type="radio" value="1" name="subscripcion" checked=""> 1 AÑO  
            <input type="radio" value="2" name="subscripcion"> 2 AÑOS
            <input type="radio" value="3" name="subscripcion"> 3 AÑOS
        </p>


        <p class="radios">SELECCIONA TU FORMA DE PAGO
            <input type="radio" value="TRANSFERENCIA" name="forma_de_pago" checked=""> TRANSEFERENCIA BANCARIA
            <input type="radio" value="EFECTIVO" name="forma_de_pago"> EFECTIVO
        </p>

    </div>       
    
    <p>(*)Aplica un costo extra, consulta esta modalidad con tu asesor de venta.</p>
    
    <table class="suscribir">
        <tr>
            <td><input type="checkbox" required="" class="radios" name="terminos" value="terminos"><a href="terminos.php" target="_blank">Acepto los terminos y condiciones</a></td>
            <td> 
                <input type="submit" class="btnregistro fr" value="ENVIAR">
            </td>
        </tr>
    </table>
        
        
        
</form>
     

    <div class="clear2"></div>
</section>


<?php include('includes/footer.php'); ?>


<!-- JQUERY -->
<script src="js/vendor/jquery.cycle2.min.js"></script>
<script src="js/vendor/jquery.cycle2.carousel.min.js"></script>


<!-- SELECTIVIZR -->
<!--[if (gte IE 6)&(lte IE 8)]>
    <script src="js/polyfills/selectivizr-min.js"></script>
<![endif]-->
</body>
</html>
