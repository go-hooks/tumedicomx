<?php
session_start();
session_name('medico_laguna');

    $ubicacion='inicio';

require_once(dirname(__FILE__) . "/ini.php");    
include('includes/metatags.php'); 

    
    if(! isset($_GET['tipo']) || ! isset($_GET['id']))
    {
        redirect('index.php');
    }
    
    
    
    
    if($_GET['tipo']=='medicos'){
        
            
        $sql = " SELECT * FROM registros r"
                . " INNER JOIN"
                . " medicos m"
                . " ON r.id = m.id"
                . " WHERE"
                . " r.elim=0 AND r.autorizado=1 AND r.id =". $_GET['id'];   

        $medico = get_one_sql($sql);                             
        
    }
        
    
    if($_GET['tipo']=='hospitales'){
        
    
        $sql = " SELECT * FROM registros r"
                . " INNER JOIN"
                . " hospitales m"
                . " ON r.id = m.id"
                . " WHERE"
                . " r.elim=0 AND r.autorizado=1 AND r.id =". $_GET['id'];   

        $hospital = get_one_sql($sql);          

    }
    
    
    
    if($_GET['tipo']=='laboratorios'){
        
    
        $sql = " SELECT * FROM registros r"
                . " INNER JOIN"
                . " laboratorios m"
                . " ON r.id = m.id"
                . " WHERE"
                . " r.elim=0 AND r.autorizado=1 AND r.id =". $_GET['id'];   

        $laboratorio = get_one_sql($sql);       

    }
    
    
    if($_GET['tipo']=='servicios'){
        
    
        $sql = " SELECT * FROM registros r"
                . " INNER JOIN"
                . " servicios s"
                . " ON r.id = s.id"
                . " WHERE"
                . " r.elim=0 AND r.autorizado=1 AND r.id =". $_GET['id'];   

        $servicio = get_one_sql($sql);       

    }    
    
    if($_GET['tipo']=='proveedores'){
        
    
        $sql = " SELECT * FROM registros r"
                . " INNER JOIN"
                . " proveedores p"
                . " ON r.id = p.id"
                . " WHERE"
                . " r.elim=0 AND r.autorizado=1 AND r.id =". $_GET['id'];   

        $proveedor = get_one_sql($sql);       

    }    
    
?>

    <title>Tu Medico Laguna</title>
</head>
<body id="minisitio">

<?php include('includes/header.php'); ?>
<section class="wrapper">

    <?php include('includes/search.php'); ?>

    
                <!--/////////////////////////////////////////////////////////////////////////////////////////-->
                <!--/////////////////////////////////////////////////////////////////////////////////////////-->
                <!--/////////////////////////////////////////////////////////////////////////////////////////-->
                <!--/////////////////////////////////////////////////////////////////////////////////////////-->
    
    
    <?php 

    if($_GET['tipo']=='medicos'):
                    
                
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

                
    <h3>MINI SITIO / <?php echo replace($medico['nombre'] . ' ' . $medico['apellidos']) ?></h3>
    <div class="colizq">
        <ul class="ficha">
            <h4><?php echo replace($medico['nombre'] . ' ' . $medico['apellidos']) ?></h4>
            <li>
                <h5><img src="img/ico-especialidad.png"> ESPECIALIDAD:</h5>
                <p><?php echo replace($catalogo)   ?></p>

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

                <h5><img src="img/ico-ubicacion.png"> UBICACÍON</h5>
                <p><?php echo replace($medico['calle_contacto']). ' No. ' . $medico['numero_contacto'] ?><br>
                Col. <?php echo replace($medico['colonia_contacto'])  ?>  <br>
                CP. <?php echo $medico['cp_contacto']  ?> <br>
                <?php echo replace($municipio . ', ' . $estado)  ?> 
                </p>

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
            </li>
        </ul>
        <ul class="ficha web">
            <li>
                <h5>SITIO WEB</h5>
                
                
                <?php if($medico['sitio_web']!=''): ?>
                
                <p>
                    <a href="<?php echo $medico['sitio_web']  ?>" target="_blank"> <?php echo $medico['sitio_web']  ?> </a>
                </p>
                
                <?php endif; ?>                
                
                
                

                <h5>REDES SOCIALES</h5>
                <p>
                    
                    <?php if ($medico['twitter']!=''):  ?>
                        <a href="<?php echo $medico['twitter']; ?>" target="_blank">
                            <img src="img/ico-twitter.jpg">
                        </a>
                    <?php endif;  ?>
                    
                    <?php if ($medico['facebook']!=''):  ?>
                        <a href="<?php echo $medico['facebook']; ?>" target="_blank">
                            <img src="img/ico-face.jpg">
                        </a>                    
                    <?php endif;  ?>
                    
                    <?php if ($medico['skype']!= ''):  ?>
                        <a href="<?php echo $medico['skype']; ?>" target="_blank">
                            <img src="img/ico-skype.jpg">
                        </a>
                    <?php endif;  ?>
                    
                </p>
            </li>
        </ul> 
    </div>

    <div class="colder">
        
        <?php if($medico['imagen']!=''): ?>
            <div class="minisitiologo">                        
                <img src="<?php  echo UP_IMG_PATH . $medico['imagen'] ?>">                                        
            </div>
        <?php endif; ?>
        
        
        <?php if($medico['banner']!=''): ?>
            <div class="banner3 cycle-slideshow" data-cycle-slides='> a'>                                    
                <a href="<?php echo $medico['url'] ?>" target="_blank">                                
                    <img src="<?php  echo UP_IMG_PATH . $medico['banner'] ?>">                                                                
                </a>                                               
            </div>
        <?php endif; ?>
        
    </div>
    
    <div class="clear"></div>

    <h3>DESCRIPCIÓN DE SERVICIOS</h3>
    <div class="minisitiodesc">
            
        <?php echo html_entity_decode($medico['descripcion'])  ?>

    </div>

    <?php if($medico['correo_contacto']!=''): ?>
    
    <h3>ENVÍA UN MENSAJE <br><span>Si desea realizar una cita llene el siguiente formulario.</span></h3>
    
    <form class="bordeazul" name="mensaje" method="post" action="envia_mensaje.php">
        
        <input type="hidden" class="txt" name="mensaje[destino]" value="<?php echo $medico['correo_contacto'] ?>">
        
        <table width="100%">
            <tr>
                
                <td width="33">NOMBRE <input type="text" class="txt" name="mensaje[nombre]"></td>
                <td width="34">CORREO: <input type="text" class="txt" name="mensaje[correo]"></td>
                <td width="33">TELÉFONO<input type="text" class="txt" name="mensaje[telefono]"></td>
            </tr>
        </table>
        MENSAJE<input type="text" class="txt txt2" name="mensaje[mensaje]"><br>
        <input type="submit" class="btnminisitio fr" value="ENVIAR">
        
        
    </form>

    <?php endif; ?>
    
    <h3>UBICACIÓN EN MAPA</h3>
    
        <?php  if ($medico['mapa'] !=''):  ?>

                <iframe src="<?php  echo $medico['mapa']; ?> " width="100%" height="350" frameborder="0" style="border:0"></iframe>

        <?php  endif;  ?>        
    
    
    
    <?php
    
    endif;
    
    ?>
    
                <!--/////////////////////////////////////////////////////////////////////////////////////////-->
                <!--/////////////////////////////////////////////////////////////////////////////////////////-->
                <!--/////////////////////////////////////////////////////////////////////////////////////////-->
                <!--/////////////////////////////////////////////////////////////////////////////////////////-->
    
    <?php
    if($_GET['tipo']=='hospitales'):                    
                
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

                
    <h3>MINI SITIO / <?php echo replace($hospital['nombre']) ?></h3>
    <div class="colizq">
        <ul class="ficha">
            <h4><?php echo replace($hospital['nombre']) ?></h4>
            <li>
                <h5><img src="img/ico-especialidad.png"> ESPECIALIDAD:</h5>
                <p><?php echo replace($catalogo)   ?></p>

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

                <h5><img src="img/ico-ubicacion.png"> UBICACÍON</h5>
                <p><?php echo replace($hospital['calle_contacto']) . ' No. ' . $hospital['numero_contacto'] ?><br>
                Col. <?php echo replace($hospital['colonia_contacto'])  ?>  <br>
                CP. <?php echo $hospital['cp_contacto']  ?> <br>
                <?php echo replace($municipio . ', ' . $estado)  ?> 
                </p>

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
            </li>
        </ul>
        <ul class="ficha web">
            <li>
                <h5>SITIO WEB</h5>
                <p><?php echo $hospital['sitio_web']  ?></p>

                <h5>REDES SOCIALES</h5>
                <p>
                    
                    <?php if ($hospital['twitter']!=''):  ?>
                        <a href="<?php echo $hospital['twitter']; ?>" target="_blank">
                            <img src="img/ico-twitter.jpg">
                        </a>
                    <?php endif;  ?>
                    
                    <?php if ($hospital['facebook']!=''):  ?>
                        <a href="<?php echo $hospital['facebook']; ?>" target="_blank">
                            <img src="img/ico-face.jpg">
                        </a>                    
                    <?php endif;  ?>
                    
                    <?php if ($hospital['skype']!= ''):  ?>
                        <a href="<?php echo $hospital['skype']; ?>" target="_blank">
                            <img src="img/ico-skype.jpg">
                        </a>
                    <?php endif;  ?>
                    
                </p>
            </li>
        </ul> 
    </div>

    <div class="colder">
        
        <?php if($hospital['imagen']!=''): ?>
            <div class="minisitiologo">                       
                <img src="<?php  echo UP_IMG_PATH . $hospital['imagen'] ?>">            
            </div>
        <?php endif; ?>                            
        
        <?php if($hospital['banner']!=''): ?>
            <div class="banner3 cycle-slideshow" data-cycle-slides='> a'>            
                <a href="<?php echo $hospital['url'] ?>" target="_blank">                
                    <img src="<?php  echo UP_IMG_PATH . $hospital['banner'] ?>">                
                </a>            
            </div>
        <?php endif; ?>
        
    </div>
    

    <h3>DESCRIPCIÓN DE SERVICIOS</h3>
    <div class="minisitiodesc">
            
        <?php echo html_entity_decode($hospital['descripcion'])  ?>

    </div>

    <?php if($hospital['correo_contacto']!=''): ?>
    
    <h3>ENVÍA UN MENSAJE <br><span>Si desea realizar una cita llene el siguiente formulario.</span></h3>
    
    <form class="bordeazul" name="mensaje" method="post" action="envia_mensaje.php">
        
        <input type="hidden" class="txt" name="mensaje[destino]" value="<?php echo $hospital['correo_contacto'] ?>">
        
        <table width="100%">
            <tr>
                
                <td width="33">NOMBRE <input type="text" class="txt" name="mensaje[nombre]"></td>
                <td width="34">CORREO: <input type="text" class="txt" name="mensaje[correo]"></td>
                <td width="33">TELÉFONO<input type="text" class="txt" name="mensaje[telefono]"></td>
            </tr>
        </table>
        MENSAJE<input type="text" class="txt txt2" name="mensaje[mensaje]"><br>
        <input type="submit" class="btnminisitio fr" value="ENVIAR">
        
        
    </form>

    <?php endif; ?>
    
    <h3>UBICACIÓN EN MAPA</h3>
    
        <?php  if ($hospital['mapa'] !=''):  ?>

                <iframe src="<?php  echo $hospital['mapa']; ?> " width="100%" height="350" frameborder="0" style="border:0"></iframe>

        <?php  endif;  ?>        
    
    
    
    <?php
    
    endif;
    
    ?>
    
                <!--/////////////////////////////////////////////////////////////////////////////////////////-->
                <!--/////////////////////////////////////////////////////////////////////////////////////////-->
                <!--/////////////////////////////////////////////////////////////////////////////////////////-->
                <!--/////////////////////////////////////////////////////////////////////////////////////////-->    
    
    
    <?php
    if($_GET['tipo']=='laboratorios'):                    
                
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

                
    <h3>MINI SITIO / <?php echo replace($laboratorio['nombre']) ?></h3>
    <div class="colizq">
        <ul class="ficha">
            <h4><?php echo replace($laboratorio['nombre']) ?></h4>
            <li>


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

                <h5><img src="img/ico-ubicacion.png"> UBICACÍON</h5>
                <p><?php echo replace($laboratorio['calle_contacto']) . ' No. ' . $laboratorio['numero_contacto'] ?><br>
                Col. <?php echo replace($laboratorio['colonia_contacto'])  ?>  <br>
                CP. <?php echo $laboratorio['cp_contacto']  ?> <br>
                <?php echo replace($municipio . ', ' . $estado)  ?> 
                </p>

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
            </li>
        </ul>
        <ul class="ficha web">
            <li>
                <h5>SITIO WEB</h5>
                <p><?php echo $laboratorio['sitio_web']  ?></p>

                <h5>REDES SOCIALES</h5>
                <p>
                    
                    <?php if ($laboratorio['twitter']!=''):  ?>
                        <a href="<?php echo $laboratorio['twitter']; ?>" target="_blank">
                            <img src="img/ico-twitter.jpg">
                        </a>
                    <?php endif;  ?>
                    
                    <?php if ($laboratorio['facebook']!=''):  ?>
                        <a href="<?php echo $laboratorio['facebook']; ?>" target="_blank">
                            <img src="img/ico-face.jpg">
                        </a>                    
                    <?php endif;  ?>
                    
                    <?php if ($laboratorio['skype']!= ''):  ?>
                        <a href="<?php echo $laboratorio['skype']; ?>" target="_blank">
                            <img src="img/ico-skype.jpg">
                        </a>
                    <?php endif;  ?>
                    
                </p>
            </li>
        </ul> 
    </div>

    <div class="colder">
        
        <?php if($laboratorio['imagen']!=''): ?>        
            <div class="minisitiologo">            
                <img src="<?php  echo UP_IMG_PATH . $laboratorio['imagen'] ?>">
            
            </div>
        <?php endif; ?>                        
        
        
        <?php if($laboratorio['banner']!=''): ?>
            <div class="banner3 cycle-slideshow" data-cycle-slides='> a'>            
                <a href="<?php echo $laboratorio['url'] ?>" target="_blank">                                
                    <img src="<?php  echo UP_IMG_PATH . $laboratorio['banner'] ?>">                
                </a>            
            </div>
        <?php endif; ?>                                                
        
    </div>

    <h3>DESCRIPCIÓN DE SERVICIOS</h3>
    <div class="minisitiodesc">
            
        <?php echo html_entity_decode($laboratorio['descripcion'])  ?>

    </div>

    <?php if($laboratorio['correo_contacto']!=''): ?>
    
    <h3>ENVÍA UN MENSAJE <br><span>Si desea realizar una cita llene el siguiente formulario.</span></h3>
    
    <form class="bordeazul" name="mensaje" method="post" action="envia_mensaje.php">
        
        <input type="hidden" class="txt" name="mensaje[destino]" value="<?php echo $laboratorio['correo_contacto'] ?>">
        
        <table width="100%">
            <tr>
                
                <td width="33">NOMBRE <input type="text" class="txt" name="mensaje[nombre]"></td>
                <td width="34">CORREO: <input type="text" class="txt" name="mensaje[correo]"></td>
                <td width="33">TELÉFONO<input type="text" class="txt" name="mensaje[telefono]"></td>
            </tr>
        </table>
        MENSAJE<input type="text" class="txt txt2" name="mensaje[mensaje]"><br>
        <input type="submit" class="btnminisitio fr" value="ENVIAR">
        
        
    </form>

    <?php endif; ?>
    
    <h3>UBICACIÓN EN MAPA</h3>
    
        <?php  if ($laboratorio['mapa'] !=''):  ?>

                <iframe src="<?php  echo $laboratorio['mapa']; ?> " width="100%" height="350" frameborder="0" style="border:0"></iframe>

        <?php  endif;  ?>        
    
    
    
    <?php
    
    endif;
    
    ?>
                
                <!--/////////////////////////////////////////////////////////////////////////////////////////-->
                <!--/////////////////////////////////////////////////////////////////////////////////////////-->
                <!--/////////////////////////////////////////////////////////////////////////////////////////-->
                <!--/////////////////////////////////////////////////////////////////////////////////////////-->
    
    
    <?php 

    if($_GET['tipo']=='servicios'):
                    
                    $estado='';
                    $municipio='';
                    $catalogo='';
                
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

                
    <h3>MINI SITIO / <?php echo replace($servicio['nombre']) ?></h3>
    <div class="colizq">
        <ul class="ficha">
            <h4><?php echo replace($servicio['nombre']) ?></h4>
            <li>
                <h5><img src="img/ico-especialidad.png"> ESPECIALIDAD:</h5>
                <p><?php echo replace($catalogo) ?></p>

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

                <h5><img src="img/ico-ubicacion.png"> UBICACÍON</h5>
                <p><?php echo replace($servicio['calle_contacto']) . ' No. ' . $servicio['numero_contacto'] ?><br>
                Col. <?php echo replace($servicio['colonia_contacto'])  ?>  <br>
                CP. <?php echo $servicio['cp_contacto']  ?> <br>
                <?php echo replace($municipio . ', ' . $estado)  ?> 
                </p>

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
            </li>
        </ul>
        <ul class="ficha web">
            <li>
                <h5>SITIO WEB</h5>
                <p><?php echo $servicio['sitio_web']  ?></p>

                <h5>REDES SOCIALES</h5>
                <p>
                    
                    <?php if ($servicio['twitter']!=''):  ?>
                        <a href="<?php echo $servicio['twitter']; ?>" target="_blank">
                            <img src="img/ico-twitter.jpg">
                        </a>
                    <?php endif;  ?>
                    
                    <?php if ($servicio['facebook']!=''):  ?>
                        <a href="<?php echo $servicio['facebook']; ?>" target="_blank">
                            <img src="img/ico-face.jpg">
                        </a>                    
                    <?php endif;  ?>
                    
                    <?php if ($servicio['skype']!= ''):  ?>
                        <a href="<?php echo $servicio['skype']; ?>" target="_blank">
                            <img src="img/ico-skype.jpg">
                        </a>
                    <?php endif;  ?>
                    
                </p>
            </li>
        </ul> 
    </div>

    <div class="colder">
        
        <?php if($servicio['imagen']!=''): ?>        
            <div class="minisitiologo">
                <img src="<?php  echo UP_IMG_PATH . $servicio['imagen'] ?>">
            </div>
        <?php endif; ?>               

        <?php if($servicio['banner']!=''): ?>        
            <div class="banner3 cycle-slideshow" data-cycle-slides='> a'>            
                <a href="<?php echo $servicio['url'] ?>" target="_blank">                
                    <img src="<?php  echo UP_IMG_PATH . $servicio['banner'] ?>">
                </a>            
            </div>
        <?php endif; ?>                   
        
    </div>
    <div class="clear"></div>

    <h3>DESCRIPCIÓN DE SERVICIOS</h3>
    <div class="minisitiodesc">
            
        <?php echo html_entity_decode($servicio['descripcion'])  ?>

    </div>

    <?php if($servicio['correo_contacto']!=''): ?>
    
    <h3>ENVÍA UN MENSAJE <br><span>Si desea realizar una cita llene el siguiente formulario.</span></h3>
    
    <form class="bordeazul" name="mensaje" method="post" action="envia_mensaje.php">
        
        <input type="hidden" class="txt" name="mensaje[destino]" value="<?php echo $servicio['correo_contacto'] ?>">
        
        <table width="100%">
            <tr>
                
                <td width="33">NOMBRE <input type="text" class="txt" name="mensaje[nombre]"></td>
                <td width="34">CORREO: <input type="text" class="txt" name="mensaje[correo]"></td>
                <td width="33">TELÉFONO<input type="text" class="txt" name="mensaje[telefono]"></td>
            </tr>
        </table>
        MENSAJE<input type="text" class="txt txt2" name="mensaje[mensaje]"><br>
        <input type="submit" class="btnminisitio fr" value="ENVIAR">
        
        
    </form>

    <?php endif; ?>
    
    <h3>UBICACIÓN EN MAPA</h3>
    
        <?php  if ($servicio['mapa'] !=''):  ?>

                <iframe src="<?php  echo $servicio['mapa']; ?> " width="100%" height="350" frameborder="0" style="border:0"></iframe>

        <?php  endif;  ?>        
    
    
    
    <?php
    
    endif;
    
    ?>
    
                <!--/////////////////////////////////////////////////////////////////////////////////////////-->
                <!--/////////////////////////////////////////////////////////////////////////////////////////-->
                <!--/////////////////////////////////////////////////////////////////////////////////////////-->
                <!--/////////////////////////////////////////////////////////////////////////////////////////-->                

                
    <?php 

    if($_GET['tipo']=='proveedores'):
                    
                    $estado='';
                    $municipio='';
                    $catalogo='';
                
                    if($proveedor['categoria_id']!=''):
                        
                        $sCatalogo = get_all_data_from('catalogos_proveedores', $proveedor['categoria_id']);                                                    
                        $catalogo = $sCatalogo['nombre'];
                        
                    endif;
                    
                    if($proveedor['estado_id']!=''):
                        
                        $sEstado = get_all_data_from('estados', $proveedor['estado_id']);                
                        $estado = $sEstado['estado'];
                        
                    endif;
                    
                    if($proveedor['municipio_id']!=''):

                        $sMunicipio = get_all_data_from('municipios',$proveedor['municipio_id']);                
                        $municipio = $sMunicipio['municipio'];
                        
                    endif;              
                    
                    $sql = " SELECT * FROM registro_tarjeta r"
                            . " INNER JOIN"
                            . " tarjetas t"
                            . " ON r.tarjeta_id = t.id"
                            . " WHERE"
                            . " registro_id = ". $proveedor['id'] ;

                    $tarjetas = get_sql($sql);      
                    
                    $sql = " SELECT * FROM registro_aseguradora r"
                            . " INNER JOIN"
                            . " aseguradoras a"
                            . " ON r.aseguradora_id = a.id"
                            . " WHERE"
                            . " registro_id = ". $proveedor['id'] ;

                    $seguros = get_sql($sql);  
                  

                ?>

                
    <h3>MINI SITIO / <?php echo replace($proveedor['nombre']) ?></h3>
    <div class="colizq">
        <ul class="ficha">
            <h4><?php echo replace($proveedor['nombre']) ?></h4>
            <li>
                <h5><img src="img/ico-especialidad.png"> ESPECIALIDAD:</h5>
                <p><?php echo replace($catalogo)   ?></p>

                        <?php if($proveedor['telefono_contacto']!=''): ?>                                                
                            <h5><img src="img/ico-tel.png"> TELÉFONO:</h5>
                            <p>
                                  <?php  echo trim($proveedor['telefono_contacto']) ;  ?>
                            </p>
                        <?php   endif; ?>

                        <?php if($proveedor['fax_contacto']!=''): ?>                                                
                            <h5><img src="img/ico-tel.png"> FAX:</h5>
                            <p>

                                  <?php  echo $proveedor['fax_contacto'] ;  ?>
                            </p>
                        <?php   endif; ?>                                                                        


                    <?php if($proveedor['horario']!=''): ?>                                                
                        <h5><img src="img/ico-ubicacion.png"> HORARIO:</h5>
                        <p>
                              <?php  echo $proveedor['horario'] ;  ?>
                        </p>
                    <?php   endif; ?> 

                <h5><img src="img/ico-ubicacion.png"> UBICACÍON</h5>
                <p><?php echo replace($proveedor['calle_contacto']) . ' No. ' . $proveedor['numero_contacto'] ?><br>
                Col. <?php echo replace($proveedor['colonia_contacto'])  ?>  <br>
                CP. <?php echo $proveedor['cp_contacto']  ?> <br>
                <?php echo replace($municipio . ', ' . $estado)  ?> 
                </p>

                <h5><img src="img/ico-mail.png"> CORREO ELECTRÓNICO</h5>
                <p><?php echo $proveedor['correo_contacto']  ?></p>
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
            </li>
        </ul>
        <ul class="ficha web">
            <li>
                <h5>SITIO WEB</h5>
                <p><?php echo $proveedor['sitio_web']  ?></p>

                <h5>REDES SOCIALES</h5>
                <p>
                    
                    <?php if ($proveedor['twitter']!=''):  ?>
                        <a href="<?php echo $proveedor['twitter']; ?>" target="_blank">
                            <img src="img/ico-twitter.jpg">
                        </a>
                    <?php endif;  ?>
                    
                    <?php if ($proveedor['facebook']!=''):  ?>
                        <a href="<?php echo $proveedor['facebook']; ?>" target="_blank">
                            <img src="img/ico-face.jpg">
                        </a>                    
                    <?php endif;  ?>
                    
                    <?php if ($proveedor['skype']!= ''):  ?>
                        <a href="<?php echo $proveedor['skype']; ?>" target="_blank">
                            <img src="img/ico-skype.jpg">
                        </a>
                    <?php endif;  ?>
                    
                </p>
            </li>
        </ul> 
    </div>

    <div class="colder">
        
        <?php if($proveedor['imagen']!=''): ?>
            <div class="minisitiologo">                        
                <img src="<?php  echo UP_IMG_PATH . $proveedor['imagen'] ?>">            
            </div>
        <?php endif; ?>                                        
        
        
        <?php if($proveedor['banner']!=''): ?>
            <div class="banner3 cycle-slideshow" data-cycle-slides='> a'>            
                <a href="<?php echo $proveedor['url'] ?>" target="_blank">                                
                    <img src="<?php  echo UP_IMG_PATH . $proveedor['banner'] ?>">                
                </a>            
            </div>
        <?php endif; ?>                                    
        
    </div>
    <div class="clear"></div>

    <h3>DESCRIPCIÓN DE SERVICIOS</h3>
    <div class="minisitiodesc">
            
        <?php echo html_entity_decode($proveedor['descripcion'])  ?>

    </div>

    <?php if($proveedor['correo_contacto']!=''): ?>
    
    <h3>ENVÍA UN MENSAJE <br><span>Si desea realizar una cita llene el siguiente formulario.</span></h3>
    
    <form class="bordeazul" name="mensaje" method="post" action="envia_mensaje.php">
        
        <input type="hidden" class="txt" name="mensaje[destino]" value="<?php echo $proveedor['correo_contacto'] ?>">
        
        <table width="100%">
            <tr>
                
                <td width="33">NOMBRE <input type="text" class="txt" name="mensaje[nombre]"></td>
                <td width="34">CORREO: <input type="text" class="txt" name="mensaje[correo]"></td>
                <td width="33">TELÉFONO<input type="text" class="txt" name="mensaje[telefono]"></td>
            </tr>
        </table>
        MENSAJE<input type="text" class="txt txt2" name="mensaje[mensaje]"><br>
        <input type="submit" class="btnminisitio fr" value="ENVIAR">
        
        
    </form>

    <?php endif; ?>
    
    <h3>UBICACIÓN EN MAPA</h3>
    
        <?php  if ($proveedor['mapa'] !=''):  ?>

                <iframe src="<?php  echo $proveedor['mapa']; ?> " width="100%" height="350" frameborder="0" style="border:0"></iframe>

        <?php  endif;  ?>        
    
    
    
    <?php
    
    endif;
    
    ?>                
                
                <!--/////////////////////////////////////////////////////////////////////////////////////////-->
                <!--/////////////////////////////////////////////////////////////////////////////////////////-->
                <!--/////////////////////////////////////////////////////////////////////////////////////////-->
                <!--/////////////////////////////////////////////////////////////////////////////////////////-->         
                
                
                
                
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
