<?php
    session_start();
    session_name('medico_laguna');
    
    $ubicacion='hospitales';    

    require_once(dirname(__FILE__) . "/ini.php");    
    include('includes/metatags.php'); 
    
    
    
        $where = "elim = 0"
               . " and padre_id =0";                
    
        $catalogos = get_all_actived_inactived('catalogos_hospitales', $where, 'nombre');    
    
        
    $sql = " SELECT * FROM invasivos"
            . " WHERE"
            . " elim = 0"            
            . " AND localizacion = 'hospitales'"
            . " AND tipo = 1"
            . " AND fecha_inicio <= '" . date("Y/m/d") . "'"
            . " AND fecha_fin >= '" . date("Y/m/d") . "'" ;
    $invasivo = get_one_sql($sql); 
    
?>
<title>Tu Medico Laguna</title>
</head>
<body id="hospitales">

    
    <?php if(! isset($_SESSION['hospitales'])): ?>        
        
        <?php if(!empty($invasivo)): ?>        
    
            <?php $_SESSION['hospitales'] = 1 ?>
            <a href="<?php echo UP_IMG_PATH . $invasivo['imagen']  ?>" class="fancybox" id="promocion"></a>                
            
        <?php endif; ?>        
            
            
    <?php endif; ?> 
            
            
    
<?php include('includes/header.php'); ?>
<section class="wrapper">

    <?php include('includes/search.php'); ?>
	<h2 class="colorazul">HOSPITALES</h2>
	
    <h2 class="colorazul">SELECCIONA LA CATEGORÍA DE TU INTERÉS:</h2>

<?php foreach($catalogos as $catalogo): 
    
        $where = "elim = 0"
               . " and padre_id =". $catalogo['id'];                
    
        $subcatalogos = get_all_actived_inactived('catalogos_hospitales', $where, 'nombre');     
    
?>
         
     
    <ul class="hospitales asilos">
        <span class="mas">+</span>
        
        <h2><img src="<?php if($catalogo['imagen']!= '') echo UP_IMG_PATH . $catalogo['imagen'] ?>"><?php echo replace($catalogo['nombre']) ?></h2>
        
        <?php foreach($subcatalogos as $subcatalogo): 
            
            $sql = " SELECT * FROM registros r"
                    . " INNER JOIN"
                    . " hospitales m"
                    . " ON r.id = m.id"
                    . " WHERE"
                    . " r.elim=0 AND r.autorizado=1"
                    . " AND categoria_id =" . $catalogo['id']
                    . " AND subcategoria_id = ". $subcatalogo['id'];

            $hospitales = get_sql($sql);              
            
            
        ?>
        
            <li><h2><?php echo replace($subcatalogo['nombre']) ?></h2>              
                <div class="resultados">
                
                    
                    <!--//////////////////////////////////////////////////////////////////////////////////-->
                    <!--//////////////////////////////////////////////////////////////////////////////////-->
                    <!--//////////////////////////////////////////////////////////////////////////////////-->
                    
                <?php foreach($hospitales as $key=>$hospital): ?>

                <?php 
                    $estado='';
                    $municipio='';
                
                    
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
                
                
                <div class="ficha <?php echo (($key+1) % 2) ? '' : 'noborde' ; ?>">
                    <h4><?php echo replace($hospital['nombre'])  ?></h4>
                    <ul>
                        <li>

                            <h5><img src="img/ico-especialidad.png"> ESPECIALIDAD:</h5>
                            <p><?php echo replace($subcatalogo['nombre'])   ?> </p>                               
                            
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

                                              <?php  echo $hospital['fax_contacto'] ;  ?>
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
    
                            <form name="minisitio"  method="get" action="minisitio.php">
                                
                                <input type="hidden" name="tipo"  value="hospitales">
                                <input type="hidden" name="id"  value="<?php echo $hospital['id']  ?>">
                                <input type="submit" class="btnminisitio" value="VER MINI SITIO">
                                
                                 
                            </form>
                            
                            <?php   endif; ?>
                            
                            
                        </li>

                    </ul>
                </div>
                
                <?php if(($key) % 2): ?>
                <hr>
                <?php endif ?>

                
                <?php endforeach; ?>                                  
                    
                    
                    <!--//////////////////////////////////////////////////////////////////////////////////-->
                    <!--//////////////////////////////////////////////////////////////////////////////////-->
                    <!--//////////////////////////////////////////////////////////////////////////////////-->
                    
                
                </div>            
            </li>  
        
        <?php endforeach; ?>
                      
    </ul>
    
<?php endforeach; ?>
    
   


    <div class="clear"></div>
</section>


<div class="clear2"></div>

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
