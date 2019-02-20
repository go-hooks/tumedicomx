<?php
    session_start();
    session_name('medico_laguna');    
    
    $ubicacion='medicos';     

    require_once(dirname(__FILE__) . "/ini.php");    
    include('includes/metatags.php'); 


    $cuenta=0;
    
    if(isset($_GET['id']))
    {
        $sql = " SELECT * FROM registros r"
                . " INNER JOIN"
                . " medicos m"
                . " ON r.id = m.id"
                . " WHERE"
                . " r.elim=0 AND r.autorizado=1"
                . " AND categoria_id=". $_GET['id']
                . " ORDER BY nombre, apellidos";   

        $medicos = get_sql($sql);        
        
    }
    else
    {
        redirect('index.php');
    }
    
    
    $total = count($medicos);
    
?>

<title>Tu Medico Laguna</title>
</head>
<body id="busqueda">

<?php include('includes/header.php'); ?>
<section class="wrapper">

    <?php include('includes/search.php'); ?>

    <p><b>Se encontraron: <?php echo $total; ?> resultados</b></p>
    
    <ul class="busqueda">
        <li>
            <div class="resultados">
                
                    
                
                <!--/////////////////////////////////////////////////////////////////////////////////////////-->
                <!--/////////////////////////////////////////////////////////////////////////////////////////-->
                <!--/////////////////////////////////////////////////////////////////////////////////////////-->
                <!--/////////////////////////////////////////////////////////////////////////////////////////-->
                    
                <?php foreach($medicos as $key=>$medico): ?>

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
                  
                    
                    $cuenta+=1;
                    
                    
                ?>
                
                <div class="ficha <?php echo ($cuenta % 2) ? '' : 'noborde' ; ?>">
                    <h4><?php echo  replace($medico['nombre'] . ' ' . $medico['apellidos']) ?></h4>
                    <ul>
                        <li>

                            <h5><img src="img/ico-especialidad.png"> ESPECIALIDAD:</h5>
                            <p><?php echo replace($catalogo)   ?> </p>       
                            
                            <h5><img src="img/ico-ubicacion.png"> UBICACÍON</h5>
                            <p><?php echo replace($medico['calle_contacto']) . ' No. ' . replace($medico['numero_contacto']) ?><br>
                            Col. <?php echo replace($medico['colonia_contacto'])  ?>  <br>
                            CP. <?php echo $medico['cp_contacto']  ?> <br>
                            <?php echo $municipio . ', ' . $estado  ?> 
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
                
                <?php if(!($cuenta % 2)): ?>
                <hr>
                <?php endif ?>
                
                <?php endforeach; ?>

                <!--/////////////////////////////////////////////////////////////////////////////////////////-->
                <!--/////////////////////////////////////////////////////////////////////////////////////////-->
                <!--/////////////////////////////////////////////////////////////////////////////////////////-->
                <!--/////////////////////////////////////////////////////////////////////////////////////////-->
                

                
                </div>
            </div>
        </li>
    </ul>
    <div class="clear"></div>
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
