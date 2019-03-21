<?php
    session_start();
    session_name('medico_laguna');
        
    require_once(dirname(__FILE__) . "/ini.php");    

    include("Mobile_Detect.php");
    $detect = new Mobile_Detect();

    
   if (! $detect->isMobile()) 
   {

    if(! isset($_SESSION['contador']))
    {
        
        redirect('loading.php');
        
    }
   }
            
    
    $ubicacion='inicio';
    
    if(isset($_GET['salir'])):
        unset($_SESSION);
        session_destroy();
    endif;   
    
    
    if(isset($_GET['error'])):
        ?>
        
            <script>                    
                    alert("El Usuario y/o Contraseña son incorrectos.");                    
            </script>

        <?php
    endif; 
      
    
    include('includes/metatags.php'); 
        
    $where = "elim = 0"
            . " AND localizacion = 'inicio'"
            . " AND tipo = 2"
           . " AND fecha_inicio <= '" . date("Y/m/d") . "'"
           . " AND fecha_fin >= '" . date("Y/m/d") . "'" ;
    $banners2 = get_all_actived_inactived('banners', $where, 'RAND()');     
       
    
    $where = "elim = 0"
            . " AND localizacion = 'inicio'"
            . " AND tipo = 3"
           . " AND fecha_inicio <= '" . date("Y/m/d") . "'"
           . " AND fecha_fin >= '" . date("Y/m/d") . "'" ;
    $banners3 = get_all_actived_inactived('banners', $where, 'RAND()');     
    
    $where = "elim = 0"
            . " AND localizacion = 'inicio'"
            . " AND tipo = 4"
          . " AND fecha_inicio <= '" . date("Y/m/d") . "'"
          . " AND fecha_fin >= '" . date("Y/m/d") . "'" ;
    $banners4 = get_all_actived_inactived('banners', $where, 'RAND()');         

    $where = "elim = 0"
            . " AND localizacion = 'inicio'"
            . " AND tipo = 5"
            . " AND fecha_inicio <= '" . date("Y/m/d") . "'"
           . " AND fecha_fin >= '" . date("Y/m/d") . "'" ;
    $banners5 = get_all_actived_inactived('banners', $where, 'RAND()');  
    
            
    $sql = " SELECT * FROM registros r"
            . " INNER JOIN"
            . " medicos m"
            . " ON r.id = m.id"
            . " WHERE"
            . " r.elim=0 AND r.autorizado=1 AND r.destacado=1";   

    $medicos = get_sql($sql);        


    $sql = " SELECT * FROM registros r"
            . " INNER JOIN"
            . " hospitales m"
            . " ON r.id = m.id"
            . " WHERE"
            . " r.elim=0 AND r.autorizado=1 AND r.destacado=1";

    $hospitales = get_sql($sql);      

    $sql = " SELECT * FROM registros r"
            . " INNER JOIN"
            . " laboratorios m"
            . " ON r.id = m.id"
            . " WHERE"
            . " r.elim=0 AND r.autorizado=1 AND r.destacado=1";

    $laboratorios = get_sql($sql);      
    
    
    
    $sql = " SELECT * FROM invasivos"
            . " WHERE"
            . " elim = 0"            
            . " AND localizacion = 'home'"
            . " AND tipo = 1"
            . " AND fecha_inicio <= '" . date("Y/m/d") . "'"
            . " AND fecha_fin >= '" . date("Y/m/d") . "'" ;
    $invasivo = get_one_sql($sql);      

    
    $sql = " SELECT * FROM video";
    $video = get_one_sql($sql);      
    
?>

</head>
<body id="home">


    <?php if(! isset($_SESSION['home'])): ?>        
        
        <?php if(!empty($invasivo)): ?>        
    
            <?php $_SESSION['home'] = 1 ?>
            <a href="<?php echo UP_IMG_PATH . $invasivo['imagen']  ?>" class="fancybox" id="promocion"></a>                
            
        <?php endif; ?>        
            
            
    <?php endif; ?>
    



<?php include('includes/header.php'); ?>
<section class="wrapper">

    <?php include('includes/search.php'); ?>

    <div class="colizq">
        <h3>Destacados: </h3>
        <ul class="catalogopestanas">
            <li data-class=".medi" class="activo"><img src="img/ico-medicos.jpg">Médicos</li>
            <li data-class=".clin"><img src="img/ico-hospital.jpg">Hospitales y Clínicas</li>
            <li data-class=".labs"><img src="img/ico-labs.jpg">Laboratorios</li>
        </ul>
       <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
        <div class="ocultar">
            <div class="catalogo medi activo">
                <div class="cycle-slideshow"
                data-cycle-fx=carousel
                data-cycle-slides="> div"
                data-cycle-timeout=4000
                data-cycle-next="#nextmedi"
                data-cycle-prev="#prevmedi"
                data-cycle-carousel-visible=3
                data-cycle-carousel-vertical=true>
                    
                    <?php foreach($medicos as $medico): ?>

                    <?php 
                        $estado='';
                        $municipio='';
                        $catalogo='';
                    
                        if($medico['categoria_id']!=''):
                            
                            $sCatalogo = get_all_data_from('catalogos_medicos', $medico['categoria_id']);                                                    
                            $catalogo = $sCatalogo['nombre'];
                            
                        endif;
                        
                        if($medico['estado_id']!=''):
                            
                            $sEstado = get_all_data_from('estados', $medico['estado_id']);                
                            $estado = $sEstado['estado'];
                            
                        endif;
                        
                        if($medico['municipio_id']!=''):

                            $sMunicipio = get_all_data_from('municipios',$medico['municipio_id']);                
                            $municipio = $sMunicipio['municipio'];
                            
                        endif;             
                        
                        $sql = " SELECT * FROM registro_tarjeta r"
                                . " INNER JOIN"
                                . " tarjetas t"
                                . " ON r.tarjeta_id = t.id"
                                . " WHERE"
                                . " registro_id = ". $medico['id'] ;

                        $tarjetas = get_sql($sql);      
                        
                        $sql = " SELECT * FROM registro_aseguradora r"
                                . " INNER JOIN"
                                . " aseguradoras a"
                                . " ON r.aseguradora_id = a.id"
                                . " WHERE"
                                . " registro_id = ". $medico['id'] ;

                        $seguros = get_sql($sql);   
                        
                    ?>

                    

                    <div class="ficha">
                        <h4><?php echo replace($medico['nombre']) . ' ' . replace($medico['apellidos']) ?></h4>
                        <ul>
                            <li>

                                <h5><img src="img/ico-especialidad.png"> ESPECIALIDAD:</h5>
                                <p><?php echo replace($catalogo);   ?> </p>                            
                                
                                <h5><img src="img/ico-ubicacion.png"> UBICACÍON</h5>
                                <p><?php echo replace($medico['calle_contacto']) . ' No. ' . $medico['numero_contacto'] ?><br>
                                Col. <?php echo replace($medico['colonia_contacto'])  ?>  <br>
                                CP. <?php echo $medico['cp_contacto']  ?> <br>
                                <?php echo replace($municipio . ', ' . $estado)  ?> 
                                </p>

                                    <?php if($medico['telefono_contacto']!=''): ?>                                                
                                        <h5><img src="img/ico-tel.png"> TELÉFONO:</h5>
                                        <p>
                                              <?php  echo trim($medico['telefono_contacto']) ;  ?>
                                        </p>
                                    <?php   endif; ?>
                                        
                                    <?php if($medico['celular_contacto']!=''): ?>                                                
                                        <h5><img src="img/ico-tel.png"> MOVIL:</h5>
                                        <p>

                                              <?php  echo $medico['celular_contacto'] ;  ?>
                                        </p>
                                    <?php   endif; ?>                                        
                                
                                    <?php if($medico['radio_contacto']!=''): ?>                                                
                                        <h5><img src="img/ico-tel.png"> RADIO:</h5>
                                        <p>

                                              <?php  echo $medico['radio_contacto'] ;  ?>
                                        </p>
                                    <?php   endif; ?> 
                                        
                                        
                                <?php if($medico['horario']!=''): ?>                                                
                                    <h5><img src="img/ico-ubicacion.png"> HORARIO:</h5>
                                    <p>
                                          <?php  echo $medico['horario'] ;  ?>
                                    </p>
                                <?php   endif; ?>       
                                    

                            </li>
                            <li>
                                <h5><img src="img/ico-mail.png"> CORREO ELECTRÓNICO</h5>
                                <p><?php echo $medico['correo_contacto']  ?></p>
                                <h5><img src="img/ico-tarjetas.jpg">FORMAS DE PAGO</h5>
                                <p>
                                   
                                    <?php foreach($tarjetas as $tarjeta): ?>
                                    
                                        <img src=" <?php echo UP_IMG_PATH . $tarjeta['imagen'] ?>" width="50px">
                                        
                                    <?php endforeach; ?>
                                    
                                    
                                </p>
                                <h5><img src="img/ico-seguros.jpg">SEGUROS</h5>
                                <p>
                                    
                                    <?php foreach($seguros as $seguro): ?>
                                    
                                        <img src=" <?php echo UP_IMG_PATH . $seguro['imagen'] ?>" width="50px">
                                        
                                    <?php endforeach; ?>                                
                                    

     
                                </p>

                                <?php 
                                
                                $where = "pagado = 1"
                                        . " AND id = " . $medico['id'] 
                                        . " AND fecha_inicio <= '" . date("Y/m/d") . "'"
                                        . " AND fecha_fin >= '" . date("Y/m/d") . "'" ;		
                                $sitio = get_all_actived_inactived('registros', $where, 'id');  
                                

                                ?>
                                
                                <?php if(count($sitio)): ?>
                                
                                <form name="minisitio"  method="get" action="minisitio.php">
                                    
                                    <input type="hidden" name="tipo"  value="medicos">
                                    <input type="hidden" name="id"  value="<?php echo $medico['id']  ?>">
                                    <input type="submit" class="btnminisitio" value="VER MINI SITIO">
                                    
                                     
                                </form>
                                
                                <?php   endif; ?>
                                
                            </li>

                        </ul>
                    </div>
                    
                    <?php endforeach; ?>
                    

                </div>

                <div class="catalogocontrols">
                    <img src="img/flecha-downcatalogo.png" id="nextmedi">
                    <img src="img/flecha-upcatalogo.png" id="prevmedi">
                </div>
            </div>

            <div class="catalogo clin" >
                <div class="cycle-slideshow"
                data-cycle-fx=carousel
                data-cycle-slides="> div"
                data-cycle-timeout=4000
                data-cycle-next="#nextclin"
                data-cycle-prev="#prevclin"
                data-cycle-carousel-visible=3
                data-cycle-carousel-vertical=true
                >
                    
                    

                    
                    <?php foreach($hospitales as $hospital): ?>

                    <?php 
                        $estado='';
                        $municipio='';
                        $catalogo='';
                    
                        if($hospital['subcategoria_id']!=''):
                            
                            $sCatalogo = get_all_data_from('catalogos_hospitales', $hospital['subcategoria_id']);                                                    
                            $catalogo = $sCatalogo['nombre'];
                            
                        endif;
                        
                        if($hospital['estado_id']!=''):
                            
                            $sEstado = get_all_data_from('estados', $hospital['estado_id']);                
                            $estado = $sEstado['estado'];
                            
                        endif;
                        
                        if($hospital['municipio_id']!=''):

                            $sMunicipio = get_all_data_from('municipios',$hospital['municipio_id']);                
                            $municipio = $sMunicipio['municipio'];
                            
                        endif;            
                        
                        $sql = " SELECT * FROM registro_tarjeta r"
                                . " INNER JOIN"
                                . " tarjetas t"
                                . " ON r.tarjeta_id = t.id"
                                . " WHERE"
                                . " registro_id = ". $hospital['id'] ;

                        $tarjetas = get_sql($sql);      
                        
                        $sql = " SELECT * FROM registro_aseguradora r"
                                . " INNER JOIN"
                                . " aseguradoras a"
                                . " ON r.aseguradora_id = a.id"
                                . " WHERE"
                                . " registro_id = ". $hospital['id'] ;

                        $seguros = get_sql($sql);   
                        
                    ?>

                    
                    <div class="ficha">
                        <h4><?php echo replace($hospital['nombre'])  ?></h4>
                        <ul>
                            <li>

                                <h5><img src="img/ico-especialidad.png"> ESPECIALIDAD:</h5>
                                <p><?php echo replace($catalogo)   ?> </p>                               
                                
                                <h5><img src="img/ico-ubicacion.png"> UBICACÍON</h5>
                                <p><?php echo replace($hospital['calle_contacto']) . ' No. ' . $hospital['numero_contacto'] ?><br>
                                Col. <?php echo replace($hospital['colonia_contacto'])  ?>  <br>
                                CP. <?php echo $hospital['cp_contacto']  ?> <br>
                                <?php echo replace($municipio . ', ' . $estado)  ?> 
                                </p>

                                
                                    <?php if($hospital['telefono_contacto']!=''): ?>                                                
                                        <h5><img src="img/ico-tel.png"> TELÉFONO:</h5>
                                        <p>
                                              <?php  echo trim($hospital['telefono_contacto']) ;  ?>
                                        </p>
                                    <?php   endif; ?>
                                        
                                    <?php if($hospital['fax_contacto']!=''): ?>                                                
                                        <h5><img src="img/ico-tel.png"> FAX:</h5>
                                        <p>
                                              <?php  echo trim($hospital['fax_contacto']) ;  ?>
                                        </p>
                                    <?php   endif; ?>

                                        
                                <?php if($hospital['horario']!=''): ?>                                                
                                    <h5><img src="img/ico-ubicacion.png"> HORARIO:</h5>
                                    <p>
                                          <?php  echo $hospital['horario'] ;  ?>
                                    </p>
                                <?php   endif; ?>                                            

                            </li>
                            <li>
                                <h5><img src="img/ico-mail.png"> CORREO ELECTRÓNICO</h5>
                                <p><?php echo $hospital['correo_contacto']  ?></p>
                                <h5><img src="img/ico-tarjetas.jpg">FORMAS DE PAGO</h5>
                                <p>
                                   
                                    <?php foreach($tarjetas as $tarjeta): ?>
                                    
                                        <img src=" <?php echo UP_IMG_PATH . $tarjeta['imagen'] ?>" width="50px">
                                        
                                    <?php endforeach; ?>
                                    
                                    
                                    
                                </p>
                                <h5><img src="img/ico-seguros.jpg">SEGUROS</h5>
                                <p>
                                    
                                    <?php foreach($seguros as $seguro): ?>
                                    
                                        <img src=" <?php echo UP_IMG_PATH . $seguro['imagen'] ?>" width="50px">
                                        
                                    <?php endforeach; ?>                                

     
                                </p>

                                <?php 
                                
                                $where = "pagado = 1"
                                        . " AND id = " . $hospital['id'] 
                                       . " AND fecha_inicio <= '" . date("Y/m/d") . "'"
                                       . " AND fecha_fin >= '" . date("Y/m/d") . "'" ;
                                $sitio = get_all_actived_inactived('registros', $where, 'id');  
                                

                                ?>
                                
                                <?php if(count($sitio)): ?>
        
                                <form name="minisitio"  method="post" action="minisitio.php">
                                    
                                    <input type="hidden" name="tipo"  value="hospitales">
                                    <input type="hidden" name="id"  value="<?php echo $hospital['id']  ?>">
                                    <input type="submit" class="btnminisitio" value="VER MINI SITIO">
                                    
                                     
                                </form>
                                
                                <?php   endif; ?>
                                
                                
                            </li>

                        </ul>
                    </div>
                    
                    <?php endforeach; ?>                
                    
                    
                    
                    
                    
                </div>

                <div class="catalogocontrols">
                    <img src="img/flecha-downcatalogo.png" id="nextclin">
                    <img src="img/flecha-upcatalogo.png" id="prevclin">
                </div>
            </div>


            <div class="catalogo labs" >
                <div class="cycle-slideshow"
                data-cycle-fx=carousel
                data-cycle-slides="> div"
                data-cycle-timeout=4000
                data-cycle-next="#nextlabs"
                data-cycle-prev="#prevlabs"
                data-cycle-carousel-visible=3
                data-cycle-carousel-vertical=true
                >
                    
     
                    <?php foreach($laboratorios as $laboratorio): ?>

                    <?php 
                        $estado='';
                        $municipio='';

                        
                        if($laboratorio['estado_id']!=''):
                            
                            $sEstado = get_all_data_from('estados', $laboratorio['estado_id']);                
                            $estado = $sEstado['estado'];
                            
                        endif;
                        
                        if($laboratorio['municipio_id']!=''):

                            $sMunicipio = get_all_data_from('municipios',$laboratorio['municipio_id']);                
                            $municipio = $sMunicipio['municipio'];
                            
                        endif;             
                        
                        $sql = " SELECT * FROM registro_tarjeta r"
                                . " INNER JOIN"
                                . " tarjetas t"
                                . " ON r.tarjeta_id = t.id"
                                . " WHERE"
                                . " registro_id = ". $laboratorio['id'] ;

                        $tarjetas = get_sql($sql);      
                        
                        $sql = " SELECT * FROM registro_aseguradora r"
                                . " INNER JOIN"
                                . " aseguradoras a"
                                . " ON r.aseguradora_id = a.id"
                                . " WHERE"
                                . " registro_id = ". $laboratorio['id'] ;

                        $seguros = get_sql($sql);   
                        
                    ?>

                    
                    <div class="ficha">
                        <h4><?php echo replace($laboratorio['nombre'])  ?></h4>
                        <ul>
                            <li>
                                <h5><img src="img/ico-ubicacion.png"> UBICACÍON</h5>
                                <p><?php echo replace($laboratorio['calle_contacto']) . ' No. ' . $laboratorio['numero_contacto'] ?><br>
                                Col. <?php echo replace($laboratorio['colonia_contacto'])  ?>  <br>
                                CP. <?php echo $laboratorio['cp_contacto']  ?> <br>
                                <?php echo replace($municipio . ', ' . $estado)  ?> 
                                </p>

                                
                                    <?php if($laboratorio['telefono_contacto']!=''): ?>                                                
                                        <h5><img src="img/ico-tel.png"> TELÉFONO:</h5>
                                        <p>
                                              <?php  echo trim($laboratorio['telefono_contacto']) ;  ?>
                                        </p>
                                    <?php   endif; ?>
                                        
                                    <?php if($laboratorio['fax_contacto']!=''): ?>                                                
                                        <h5><img src="img/ico-tel.png"> FAX:</h5>
                                        <p>
                                              <?php  echo trim($laboratorio['fax_contacto']) ;  ?>
                                        </p>
                                    <?php   endif; ?>
                                        
                                        
                                <?php if($laboratorio['horario']!=''): ?>                                                
                                    <h5><img src="img/ico-ubicacion.png"> HORARIO:</h5>
                                    <p>
                                          <?php  echo $laboratorio['horario'] ;  ?>
                                    </p>
                                <?php   endif; ?>  
                                    

                            </li>
                            <li>
                                <h5><img src="img/ico-mail.png"> CORREO ELECTRÓNICO</h5>
                                <p><?php echo $laboratorio['correo_contacto']  ?></p>
                                <h5><img src="img/ico-tarjetas.jpg">FORMAS DE PAGO</h5>
                                <p>
                                   
                                    <?php foreach($tarjetas as $tarjeta): ?>
                                    
                                        <img src=" <?php echo UP_IMG_PATH . $tarjeta['imagen'] ?>" width="50px">
                                        
                                    <?php endforeach; ?>                                
                                    
                                    
                                </p>
                                <h5><img src="img/ico-seguros.jpg">SEGUROS</h5>
                                <p>
                                    
                                    <?php foreach($seguros as $seguro): ?>
                                    
                                        <img src=" <?php echo UP_IMG_PATH . $seguro['imagen'] ?>" width="50px">
                                        
                                    <?php endforeach; ?>                                
                                    
     
                                </p>

                                <?php 
                                
                                $where = "pagado = 1"
                                        . " AND id = " . $laboratorio['id'] 
                                       . " AND fecha_inicio <= '" . date("Y/m/d") . "'"
                                       . " AND fecha_fin >= '" . date("Y/m/d") . "'" ;
                                $sitio = get_all_actived_inactived('registros', $where, 'id');  
                                

                                ?>
                                
                                <?php if(count($sitio)): ?>
        
                                <form name="minisitio"  method="post" action="minisitio.php">
                                    
                                    <input type="hidden" name="tipo"  value="laboratorios">
                                    <input type="hidden" name="id"  value="<?php echo $laboratorio['id']  ?>">
                                    <input type="submit" class="btnminisitio" value="VER MINI SITIO">
                                    
                                     
                                </form>
                                
                                <?php   endif; ?>
                                
                                
                            </li>

                        </ul>
                    </div>
                    
                    <?php endforeach; ?>                
                    

                    

                </div>

                <div class="catalogocontrols">
                    <img src="img/flecha-downcatalogo.png" id="nextlabs">
                    <img src="img/flecha-upcatalogo.png" id="prevlabs">
                </div>
            </div>
        </div>
    </div>





    <div class="colder">
        <h3>Regístrate con nosotros: </h3>
        <div id="zonaregistro">
            <a href="gratis.php"><input type="button" value="REGISTRO GRATUITO" class="btnregistro"></a>
            <a href="premium.php"><input type="button" value="REGISTRO PREMIUM" class="btnregistro"></a>           
        </div>
        
        <h3>Síguenos en:</h3>
        
        <div class="redes">           
            <a href="https://twitter.com/TuMedicolaguna" target="_blank"><img src="img/social_twitter.png" ></a>
            <a href="https://www.facebook.com/tumedicolaguna" target="_blank"><img src="img/social_facebook.png" class="medio" ></a>
            <a href="http://instagram.com/tumedicolaguna" target="_blank"><img src="img/social_instagram.png" ></a>
        </div>

        
        <a href="anunciate.php">
        <h3>Anúnciate en un Banner</h3>
        </a>
        
        <div class="banner3 cycle-slideshow" data-cycle-slides='> a' data-cycle-timeout="<?php echo (int)($timmer['tiempo'] * 1000) ?>">
            
            <?php foreach ($banners3 as $banner): ?>

                <a href="<?php echo $banner['url']  ?>" target="_blank">
                    <img src="<?php echo UP_IMG_PATH . $banner['imagen']  ?>" >
                </a>

            <?php endforeach; ?>            
            
            
        </div>
        
        
        <div class="banner4 cycle-slideshow" data-cycle-slides='> a' data-cycle-timeout="<?php echo (int)($timmer['tiempo'] * 1000) ?>">
            
            <?php foreach ($banners4 as $banner): ?>

                <a href="<?php echo $banner['url']  ?>" target="_blank">
                    <img src="<?php echo UP_IMG_PATH . $banner['imagen']  ?>" >
                </a>

            <?php endforeach; ?>
            

        </div>
        
        
        <div class="banner5 cycle-slideshow" data-cycle-slides='> a' data-cycle-timeout="<?php echo (int)($timmer['tiempo'] * 1000) ?>">
            
        <?php foreach ($banners5 as $banner): ?>
            
            <a href="<?php echo $banner['url']  ?>" target="_blank">
                <img src="<?php echo UP_IMG_PATH . $banner['imagen']  ?>" >
            </a>
        
        <?php endforeach; ?>            
            
            
        </div>
        
        
    <div id="video">
       
        <?php if(isset($video['video'])): ?>   
            <img src="http://img.youtube.com/vi/<?php echo $video['video'];?>/0.jpg" style="width: 100%;">
           <!-- <iframe width="400" height="280" src="<?php echo $video['video']; ?>" frameborder="0" allowfullscreen></iframe>-->
        <?php endif; ?>
        <div class="ponplay">
            <div id="play"></div>
        </div>     
        
    </div>  
      <div class="various fancybox.iframe"  id="formvarious" style="display:none;">
        <iframe width="800" height="500" src="//www.youtube.com/embed/<?php echo $video['video'];?>?autoplay=0" frameborder="0" allowfullscreen></iframe>
      </div>
      
    </div>
    
    <div id="banner1">
        <div class="cycle-slideshow" data-cycle-slides='> a'>
            
            
        <?php foreach ($banners2 as $banner): ?>
            
            <a href="<?php echo $banner['url']  ?>" target="_blank">
                <img src="<?php echo UP_IMG_PATH . $banner['imagen']  ?>" >
            </a>
        
        <?php endforeach; ?>
            
            
        </div>
    </div>

    
  
    
    <div class="clear"></div>
</section>




<?php include('includes/footer.php'); ?>


<!-- JQUERY -->
<script src="js/vendor/jquery.cycle2.min.js"></script>
<script src="js/vendor/jquery.cycle2.carousel.min.js"></script>
<script src="js/fancybox/source/jquery.fancybox.js"></script>
<script type="text/javascript" src="js/main.js"></script>


<script>

    //setTimeout('$.fancybox.close();', 1000);    
    
</script>   

<script type='text/javascript'>
window.__lo_site_id = 147239;

	(function() {
		var wa = document.createElement('script'); wa.type = 'text/javascript'; wa.async = true;
		wa.src = 'https://d10lpsik1i8c69.cloudfront.net/w.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(wa, s);
	  })();
</script>

<!-- SELECTIVIZR -->
<!--[if (gte IE 6)&(lte IE 8)]>
    <script src="js/polyfills/selectivizr-min.js"></script>
<![endif]-->
</body>
</html>
