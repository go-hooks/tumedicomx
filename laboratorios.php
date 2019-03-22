<?php
    session_start();
    session_name('medico_laguna');
    
    $ubicacion='laboratorios';        

    require_once(dirname(__FILE__) . "/ini.php");    
    include('includes/metatags.php'); 
    
    $cuenta=0;
    
        $sql = " SELECT * FROM registros r"
            . " INNER JOIN"
            . " laboratorios m"
            . " ON r.id = m.id"
            . " WHERE"
            . " r.elim=0 AND r.autorizado=1";

    $laboratorios = get_sql($sql);    
    
    
    $sql = " SELECT * FROM invasivos"
            . " WHERE"
            . " elim = 0"            
            . " AND localizacion = 'laboratorios'"
            . " AND tipo = 1"
            . " AND fecha_inicio <= '" . date("Y/m/d") . "'"
            . " AND fecha_fin >= '" . date("Y/m/d") . "'" ;
    $invasivo = get_one_sql($sql);     
?>

<title>Tu Medico Laguna</title>
</head>
<body id="laboratorios">
    
    
    <?php if(! isset($_SESSION['laboratorios'])): ?>        
        
        <?php if(!empty($invasivo)): ?>        
    
            <?php $_SESSION['laboratorios'] = 1 ?>
            <a href="<?php echo UP_IMG_PATH . $invasivo['imagen']  ?>" class="fancybox" id="promocion"></a>                
            
        <?php endif; ?>        
            
            
    <?php endif; ?> 
            

<?php include('includes/header.php'); ?>
<section class="wrapper">

    <?php include('includes/search.php'); ?>

    <ul class="laboratorios">
        <h2><img src="img/ico-laboratorios1.png">LABORATORIOS</h2>
        <li>
            <div class="resultados">
                
                    <!--//////////////////////////////////////////////////////////////////////////////////-->
                    <!--//////////////////////////////////////////////////////////////////////////////////-->
                    <!--//////////////////////////////////////////////////////////////////////////////////-->                
                

                    <?php foreach($laboratorios as $key=>$laboratorio): ?>

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

                        $cuenta+=1;


                    ?>


                    <div class="ficha <?php echo ($cuenta % 2) ? '' : 'noborde' ; ?>">
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

                                              <?php  echo $laboratorio['fax_contacto'] ;  ?>
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

                                <form name="minisitio"  method="get" action="minisitio.php">

                                    <input type="hidden" name="tipo"  value="laboratorios">
                                    <input type="hidden" name="id"  value="<?php echo $laboratorio['id']  ?>">
                                    <input type="submit" class="btnminisitio" value="VER MINI SITIO">


                                </form>

                                <?php   endif; ?>


                            </li>

                        </ul>
                    </div>


                    <?php if(!($cuenta % 2)): ?>
                    <hr>
                    <?php endif ?>


                    <?php endforeach; ?>   
                
                
                    <!--//////////////////////////////////////////////////////////////////////////////////-->
                    <!--//////////////////////////////////////////////////////////////////////////////////-->
                    <!--//////////////////////////////////////////////////////////////////////////////////-->                
                

            </div>
        </li>
    </ul>
    <div class="clear"></div>
</section>



<?php include('includes/footer.php'); ?>


<!-- JQUERY -->
<script src="js/vendor/jquery.cycle2.min.js"></script>
<script src="js/vendor/jquery.cycle2.carousel.min.js"></script>
<script src="js/fancybox/source/jquery.fancybox.js"></script>
<script type="text/javascript" src="js/main.js"></script>

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
