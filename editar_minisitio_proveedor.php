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

    $sql = " SELECT * FROM registros r"
            . " INNER JOIN"
            . " proveedores p"
            . " ON r.id = p.id"
            . " WHERE"
            . " r.elim=0 AND r.id =". $_SESSION['usuario_id'];   

    $proveedor = get_one_sql($sql);    
    

    $where = "estado_id =". $proveedor['estado_id'];   
    $municipios = get_all_actived_inactived('municipios', $where, 'id');     
        
    $where = "registro_id=". $_SESSION['usuario_id'];   
    $reg_aseguradoras = get_all_actived_inactived('registro_aseguradora', $where, 'aseguradora_id');       

    $where = "registro_id=". $_SESSION['usuario_id'];   
    $reg_tarjetas = get_all_actived_inactived('registro_tarjeta', $where, 'tarjeta_id'); 
    
?>

<script type="text/javascript" src="municipios.js"></script>

<title>Tu Medico Laguna</title>
</head>
<body id="registro">

<?php include('includes/header.php'); ?>
<section class="wrapper">

    <?php include('includes/search.php'); ?>

    <div class="registro">
        <h2>MI PERFIL<br>            
        
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

    <form enctype="multipart/form-data" class="clear" name="contacto"  method="post" action="editar_registro_premium.php">     
    
    <input type="hidden" name="tipo" value="proveedor">
    
    <div class="registro">
        <p class="subt">ENCUESTA</p>
        
        <table width="100%">
            <tr>
                <th height="80"> ¿Cómo te enteraste de nosotros?  
                    
                    <select class="txt txt2" id="encuesta" name="encuesta" required="">

                        <option value="">-Seleccione una opcion-</option>
                        <option value="Anuncio Publicitario" <?php if(isset($proveedor['encuesta']) && $proveedor['encuesta']=="Anuncio Publicitario") echo 'selected=""' ?> >Anuncio Publicitario</option>
                        <option value="Correo Electrónico" <?php if(isset($proveedor['encuesta']) && $proveedor['encuesta']=="Correo Electrónico") echo 'selected=""' ?>>Correo Electrónico</option>
                        <option value="Recomendaciones" <?php if(isset($proveedor['encuesta']) && $proveedor['encuesta']=="Recomendaciones") echo 'selected=""' ?> >Recomendaciones</option>
                        <option value="Redes Sociales" <?php if(isset($proveedor['encuesta']) && $proveedor['encuesta']=="Redes Sociales") echo 'selected=""' ?> >Redes Sociales</option>                                                                                                
                        <option value="Vía telefónica" <?php if(isset($proveedor['encuesta']) && $proveedor['encuesta']=="Vía telefónica") echo 'selected=""' ?> >Vía telefónica</option>

                    </select>   
                    
                </th>
            </tr>
            
        </table>
        
    </div>
    
    <div class="registro">
        <p class="subt">DATOS BASICOS</p>        
        <p>REPRESENTANTE LEGAL* <input required="" class="txt" type="text" name="representante" value="<?php echo @$proveedor['representante'] ?>"></p>
        <p>NOMBRE DE INSTITUCIÓN* <input required="" class="txt" class="txt" type="text" name="nombre" value="<?php echo @$proveedor['nombre'] ?>"></p>
        <p>USUARIO* <input required="" class="txt" type="text" name="correo" value="<?php echo @$proveedor['correo'] ?>"></p>
        <p>TELÉFONO* <input required="" class="txt" type="text" name="telefono" value="<?php echo @$proveedor['telefono'] ?>"></p>
        <p>CONTRASEÑA* <input class="txt" type="password" name="password"></p>
        <p>CONFIRMAR CONTRASEÑA* <input  class="txt" type="password" name="password2"></p>
    </div>

    <div class="registro">
        <p class="subt">DATOS DE CONTACTO</p>
        
        <p>CORREO* <input required="" class="txt" type="text" name="correo_contacto" value="<?php echo @$proveedor['correo_contacto'] ?>"></p>
        
        <table width="850" height="130">
            <tr>
                <td>CALLE* <input required="" class="txt txt3" type="text" name="calle" value="<?php echo @$proveedor['calle_contacto'] ?>"></td>
                <td width="210">NUM* <input required="" class="txt txt1" class="txt" type="text" name="num" value="<?php echo @$proveedor['numero_contacto'] ?>"></td>
            </tr>
            <tr>
                <td>COLONIA* <input required=""  class="txt txt3" type="text" name="colonia" value="<?php echo @$proveedor['colonia_contacto'] ?>"></td>
                <td>CP*. <input required="" class="txt txt1" type="text" name="cp" value="<?php echo @$proveedor['cp_contacto'] ?>"></td>
            </tr>
        </table>

        <table width="850" height="220">
            <tr>
                <td width="450">ESTADO* 
                    
                    <select class="txt txt2" name="estado_id" id="estado_id" onchange="municipios(this.value)">                                                    
                        
                        <option value="0"> </option>
                        
                        <?php foreach($estados as $estado): ?>
                        
                            <option value="<?php echo $estado['id'] ?>" <?php if(isset($proveedor['estado_id']) && $proveedor['estado_id']==$estado['id']) echo 'selected=""' ?> > <?php echo replace($estado['estado']) ?> </option>
                        
                        <?php endforeach; ?>
                        
                    </select>                     
                
                </td>
                
                
                <td>MUNICIPIO*
                    
                    <select class="txt txt2" name="municipio_id" id="municipio_id">                                                                            
                        <?php foreach($municipios as $municipio): ?>
                        
                        <option value="<?php echo $municipio['id'] ?>" <?php if(isset($proveedor['municipio_id']) && $proveedor['municipio_id']==$municipio['id']) echo 'selected=""' ?>> <?php echo replace($municipio['municipio']) ?> </option>
                        
                        <?php endforeach; ?>                          
                    </select>                      
                    
                
                </td>
                
            </tr>
            <tr>
                <td>TELÉFONO FIJO* <input required="" class="txt txt2" class="txt" type="text" name="telfijo" value="<?php echo @$proveedor['telefono_contacto'] ?>"></td>
                <td>FAX <input class="txt txt2" type="text" name="fax" value="<?php echo @$proveedor['fax_contacto'] ?>"></td>
            </tr>
        </table>
        
        <p>HORARIO <input class="txt" type="text" name="horario" value="<?php echo @$proveedor['horario'] ?>"></p>
        
        <div class="clear"></div>
    </div>

    <div class="registro">
        <p class="subt">CLASIFICACIÓN</p>

        <table width="100%">
            <tr>
                <th height="80">CATEGORIA*
                
                    <select  class="txt txt2" name="categoria_id" id="categoria_id">                                                                                                   
                        
                        <?php foreach($catalogos as $catalogo): ?>
                        
                            <option value="<?php echo $catalogo['id'] ?>" <?php if(isset($proveedor['categoria_id']) && $proveedor['categoria_id']==$catalogo['id']) echo 'selected=""' ?> > <?php echo replace($catalogo['nombre']) ?> </option>
                        
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
                            
                            <?php
                                $cheched ='';
                                foreach($reg_aseguradoras as $reg): 
                                    
                                    if($reg['aseguradora_id']==$aseguradora['id']) 
                                    {
                                        $cheched ='checked=""';
                                        break;
                                    }
                                    
                                endforeach; 
                            ?> 
                        
                            <li>
                                <input type="checkbox" name="aseguradora_id[]" value="<?php echo $aseguradora['id'] ?>" <?php echo $cheched ?> ><?php echo $aseguradora['nombre'] ?><br>                                
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
                <th valign="top">TARJETAS:</th>
                <td>
                    <ul>

                        <?php foreach($tarjetas as $key=>$tarjeta): ?>

                            <?php
                                $cheched ='';
                                foreach($reg_tarjetas as $reg): 
                                    
                                    if($reg['tarjeta_id']==$tarjeta['id']) 
                                    {
                                        $cheched ='checked=""';
                                        break;
                                    }
                                    
                                endforeach; 
                            ?>    
                        
                            
                            <li>
                                <input type="checkbox" name="tarjeta_id[]" value="<?php echo $tarjeta['id'] ?>" <?php echo $cheched ?> ><?php echo $tarjeta['nombre'] ?><br>                                
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
                <td><input class="txt" class="txt" type="text" name="url" placeholder="URL" value="<?php echo @$proveedor['url'] ?>"></td>
            </tr>            
            <tr>
                <td valign="top">DESCRIPCIÓN</td>
                <td><textarea name="descripcion" class="txtarea"><?php echo @$proveedor['descripcion'] ?>"</textarea></td>
            </tr>
            <tr>
                <td>REDES SOCIALES </td>
                <td><img src="img/ico-faceregistro.jpg"><input type="text" class="txt txt1" name="facebook" placeholder="URL" value="<?php echo @$proveedor['facebook'] ?>">
                    <img src="img/ico-twitterregistro.jpg"><input type="text" class="txt txt1" name="twitter" placeholder="URL" value="<?php echo @$proveedor['twitter'] ?>">
                    <img src="img/ico-skype.jpg"><input type="text" class="txt txt1" name="skype" placeholder="URL" value="<?php echo @$proveedor['skype'] ?>">
                </td>
            </tr>        
            <tr>
                <td>SITIO WEB</td>
                <td><input class="txt" class="txt" type="text" name="sitio_web" value="<?php echo @$proveedor['sitio_web'] ?>" placeholder="URL"></td>
            </tr> 

            <tr>
                <td>UBICACIÓN DEL MAPA</td>
                <td><input class="txt" class="txt" type="text" name="mapa" value="<?php echo @$proveedor['mapa'] ?>"></td>
            </tr> 
            
            <tr>
                <td>*BANNER (400 x 375)</td>
                <td><input type="file" name="Banner" id="Banner" /></td>
            </tr>
            
            
        </table>
        
        <div class="clear"></div>
    </div>

    <table class="suscribir">
        <tr>
            <td> 
                <input type="submit" class="btnregistro fr" value="ACTUALIZAR">
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
