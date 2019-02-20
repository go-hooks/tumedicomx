<?php
    session_start();
    session_name('medico_laguna');
    
    $ubicacion='servicios';      

    require_once(dirname(__FILE__) . "/ini.php");    
    include('includes/metatags.php'); 
           
    $where = "elim = 0";               
    $catalogos = get_all_actived_inactived('catalogos_servicios', $where, 'nombre');    
        
    $sql = " SELECT * FROM invasivos"
            . " WHERE"
            . " elim = 0"            
            . " AND localizacion = 'servicios'"
            . " AND tipo = 1"
            . " AND fecha_inicio <= '" . date("Y/m/d") . "'"
            . " AND fecha_fin >= '" . date("Y/m/d") . "'" ;
    $invasivo = get_one_sql($sql);       
?>

<title>Tu Medico Laguna</title>
</head>
<body id="servicios">


    <?php if(! isset($_SESSION['servicios'])): ?>        
        
        <?php if(!empty($invasivo)): ?>        
    
            <?php $_SESSION['servicios'] = 1 ?>
            <a href="<?php echo UP_IMG_PATH . $invasivo['imagen']  ?>" class="fancybox" id="promocion"></a>                
            
        <?php endif; ?>        
            
            
    <?php endif; ?> 
            
    
<?php include('includes/header.php'); ?>
<section class="wrapper">

    <?php include('includes/search.php'); ?>

    <h2 class="colorazul">SELECCIONA LA CATEGORÍA DE TU INTERÉS:</h2>


<?php foreach($catalogos as $catalogo): 
    

            $sql = " SELECT * FROM registros r"
                    . " INNER JOIN"
                    . " servicios s"
                    . " ON r.id = s.id"
                    . " WHERE"
                    . " r.elim=0 AND r.autorizado=1"
                    . " AND categoria_id =" . $catalogo['id'];                    

            $servicios = get_sql($sql);       
    
?>
           
    
    <ul class="servicios ambulancias">
        <span class="mas">+</span>
         <h2><img src="<?php if($catalogo['imagen']!= '') echo UP_IMG_PATH . $catalogo['imagen'] ?>"><?php echo replace($catalogo['nombre']) ?></h2>
        <li>
            <div class="resultados">
                
                    <!--//////////////////////////////////////////////////////////////////////////////////-->
                    <!--//////////////////////////////////////////////////////////////////////////////////-->
                    <!--//////////////////////////////////////////////////////////////////////////////////-->                
                

                    <?php foreach($servicios as $key=>$servicio): ?>

                    <?php 
                        $estado='';
                        $municipio='';


                        if($servicio['categoria_id']!=''):

                            $sCatalogo = get_all_data_from('catalogos_servicios', $servicio['categoria_id']);                                                    
                            $catalogo = $sCatalogo['nombre'];

                        endif;

                        if($servicio['estado_id']!=''):

                            $sEstado = get_all_data_from('estados', $servicio['estado_id']);                
                            $estado = $sEstado['estado'];

                        endif;

                        if($servicio['municipio_id']!=''):

                            $sMunicipio = get_all_data_from('municipios',$servicio['municipio_id']);                
                            $municipio = $sMunicipio['municipio'];

                        endif;              

                        $sql = " SELECT * FROM registro_tarjeta r"
                                . " INNER JOIN"
                                . " tarjetas t"
                                . " ON r.tarjeta_id = t.id"
                                . " WHERE"
                                . " registro_id = ". $servicio['id'] ;

                        $tarjetas = get_sql($sql);      

                        $sql = " SELECT * FROM registro_aseguradora r"
                                . " INNER JOIN"
                                . " aseguradoras a"
                                . " ON r.aseguradora_id = a.id"
                                . " WHERE"
                                . " registro_id = ". $servicio['id'] ;

                        $seguros = get_sql($sql);   

                    ?>


                    <div class="ficha <?php echo (($key+1) % 2) ? '' : 'noborde' ; ?>">
                        <h4><?php echo replace($servicio['nombre'])  ?></h4>
                        <ul>
                            <li>

                                <h5><img src="img/ico-especialidad.png"> ESPECIALIDAD:</h5>
                                <p><?php echo replace($catalogo)   ?> </p>     

                                <h5><img src="img/ico-ubicacion.png"> UBICACÍON</h5>
                                <p><?php echo replace($servicio['calle_contacto']) . ' No. ' . $servicio['numero_contacto'] ?><br>
                                Col. <?php echo replace($servicio['colonia_contacto'])  ?>  <br>
                                CP. <?php echo $servicio['cp_contacto']  ?> <br>
                                <?php echo replace($municipio . ' ' . $estado)  ?> 
                                </p>

                                    <?php if($servicio['telefono_contacto']!=''): ?>                                                
                                        <h5><img src="img/ico-tel.png"> TELÉFONO:</h5>
                                        <p>
                                              <?php  echo trim($servicio['telefono_contacto']) ;  ?>
                                        </p>
                                    <?php   endif; ?>
                                        
                                    <?php if($servicio['fax_contacto']!=''): ?>                                                
                                        <h5><img src="img/ico-tel.png"> FAX:</h5>
                                        <p>

                                              <?php  echo $servicio['fax_contacto'] ;  ?>
                                        </p>
                                    <?php   endif; ?>                                                                        
                                        
                                        
                                <?php if($servicio['horario']!=''): ?>                                                
                                    <h5><img src="img/ico-ubicacion.png"> HORARIO:</h5>
                                    <p>
                                          <?php  echo $servicio['horario'] ;  ?>
                                    </p>
                                <?php   endif; ?> 
                                    
                            </li>
                            <li>
                                <h5><img src="img/ico-mail.png"> CORREO ELECTRÓNICO</h5>
                                <p><?php echo $servicio['correo_contacto']  ?></p>
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
                                        . " AND id = " . $servicio['id'] 
                                        . " AND fecha_inicio <= '" . date("Y/m/d") . "'"
                                        . " AND fecha_fin >= '" . date("Y/m/d") . "'" ;
                                $sitio = get_all_actived_inactived('registros', $where, 'id');  


                                ?>

                                <?php if(count($sitio)): ?>

                                <form name="minisitio"  method="get" action="minisitio.php">

                                    <input type="hidden" name="tipo"  value="servicios">
                                    <input type="hidden" name="id"  value="<?php echo $servicio['id']  ?>">
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
    </ul>

<?php endforeach; ?>

    <div class="clear"></div>
</section>



<?php include('includes/footer.php'); ?>


<!-- JQUERY -->
<script src="js/vendor/jquery.cycle2.min.js"></script>
<script src="js/vendor/jquery.cycle2.carousel.min.js"></script>
<script src="js/fancybox/source/jquery.fancybox.js"></script>
<script type="text/javascript" src="js/main.js"></script>

<!-- SELECTIVIZR -->
<!--[if (gte IE 6)&(lte IE 8)]>
    <script src="js/polyfills/selectivizr-min.js"></script>
<![endif]-->
</body>
</html>
