<?php
    session_start();
    session_name('medico_laguna');

    $ubicacion='resultados';     
    
    require_once(dirname(__FILE__) . "/ini.php");    
    include('includes/metatags.php'); 


    $cuenta=0;
    
    if(isset($_POST['buscar']))
    {
        $sql = " SELECT * FROM registros r"
                . " INNER JOIN"
                . " medicos m"
                . " ON r.id = m.id"
                . " WHERE"
                . " r.elim=0 AND r.autorizado=1"
                . " AND"
                . " ("
                . " nombre like '%". $_POST['buscar'] . "%' "
                . " OR apellidos like '%". $_POST['buscar'] . "%' "
                . " OR palabras_clave like '%". $_POST['buscar'] . "%' "
                . ")"
                . " ORDER BY nombre, apellidos";   

        $medicos = get_sql($sql);        


        $sql = " SELECT * FROM registros r"
                . " INNER JOIN"
                . " hospitales m"
                . " ON r.id = m.id"
                . " WHERE"
                . " r.elim=0 AND r.autorizado=1"
                . " AND"
                . " ("
                . " nombre like '%". $_POST['buscar'] . "%' "
                . " OR palabras_clave like '%". $_POST['buscar'] . "%' "
                . ")"
                . " ORDER BY nombre";   

        $hospitales = get_sql($sql);      

        $sql = " SELECT * FROM registros r"
                . " INNER JOIN"
                . " laboratorios m"
                . " ON r.id = m.id"
                . " WHERE"
                . " r.elim=0 AND r.autorizado=1"
                . " AND"
                . " ("
                . " nombre like '%". $_POST['buscar'] . "%' "
                . " OR palabras_clave like '%". $_POST['buscar'] . "%' "
                . ")"
                . " ORDER BY nombre";   

        $laboratorios = get_sql($sql);         
    
        
        $sql = " SELECT * FROM registros r"
                . " INNER JOIN"
                . " servicios s"
                . " ON r.id = s.id"
                . " WHERE"
                . " r.elim=0 AND r.autorizado=1"
                . " AND"
                . " ("
                . " nombre like '%". $_POST['buscar'] . "%' "
                . " OR palabras_clave like '%". $_POST['buscar'] . "%' "
                . ")"
                . " ORDER BY nombre";   


        $servicios = get_sql($sql);  
        
        
        $sql = " SELECT * FROM registros r"
                . " INNER JOIN"
                . " proveedores p"
                . " ON r.id = p.id"
                . " WHERE"
                . " r.elim=0 AND r.autorizado=1"
                . " AND"
                . " ("
                . " nombre like '%". $_POST['buscar'] . "%' "
                . " OR palabras_clave like '%". $_POST['buscar'] . "%' "
                . ")"
                . " ORDER BY nombre";   


        $proveedores = get_sql($sql);  
        
        
    }
    else
    {
        redirect('index.php');
    }
    
    
    $total = count($medicos) + count($hospitales) + count($laboratorios) + count($servicios) + count($proveedores);
    
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
                    <h4><?php echo  replace($medico['nombre']) . ' ' . replace($medico['apellidos']) ?></h4>
                    <ul>
                        <li>

                            <h5><img src="img/ico-especialidad.png"> ESPECIALIDAD:</h5>
                            <p><?php echo replace($catalogo)   ?> </p>       
                            
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
                
                <?php if(!($cuenta % 2)): ?>
                <hr>
                <?php endif; ?>                
                
                <?php endforeach; ?>

                <!--/////////////////////////////////////////////////////////////////////////////////////////-->
                <!--/////////////////////////////////////////////////////////////////////////////////////////-->
                <!--/////////////////////////////////////////////////////////////////////////////////////////-->
                <!--/////////////////////////////////////////////////////////////////////////////////////////-->
                

                
                <?php foreach($hospitales as $key=>$hospital): ?>

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
                    
                    $cuenta+=1;                                        
                ?>
                    

                
                <div class="ficha <?php echo ($cuenta % 2) ? '' : 'noborde' ; ?>">
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
                
                <?php if(!($cuenta % 2)): ?>
                <hr>
                <?php endif ?>                
                
                <?php endforeach; ?>                                
                
                <!--/////////////////////////////////////////////////////////////////////////////////////////-->
                <!--/////////////////////////////////////////////////////////////////////////////////////////-->
                <!--/////////////////////////////////////////////////////////////////////////////////////////-->
                <!--/////////////////////////////////////////////////////////////////////////////////////////-->

                
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
                
                
                <!--/////////////////////////////////////////////////////////////////////////////////////////-->
                <!--/////////////////////////////////////////////////////////////////////////////////////////-->
                <!--/////////////////////////////////////////////////////////////////////////////////////////-->
                <!--/////////////////////////////////////////////////////////////////////////////////////////-->

                
                <?php foreach($servicios as $key=>$servicio): ?>

                <?php 
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
                    
                    $cuenta+=1;
                    
                    
                ?>
                    
                
                <div class="ficha <?php echo ($cuenta % 2) ? '' : 'noborde' ; ?>">
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
                
                <?php if(!($cuenta % 2)): ?>
                <hr>
                <?php endif ?>                
                
                <?php endforeach; ?>                
                
                
                <!--/////////////////////////////////////////////////////////////////////////////////////////-->
                <!--/////////////////////////////////////////////////////////////////////////////////////////-->
                <!--/////////////////////////////////////////////////////////////////////////////////////////-->
                <!--/////////////////////////////////////////////////////////////////////////////////////////-->
                

                <?php foreach($proveedores as $key=>$proveedor): ?>

                <?php 
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
                    
                    $cuenta+=1;
                    
                    
                ?>
                    
                
                <div class="ficha <?php echo ($cuenta % 2) ? '' : 'noborde' ; ?>">
                    <h4><?php echo replace($proveedor['nombre'])  ?></h4>
                    <ul>
                        <li>
                            
                            <h5><img src="img/ico-especialidad.png"> ESPECIALIDAD:</h5>
                            <p><?php echo replace($catalogo)   ?> </p>     
                            
                            <h5><img src="img/ico-ubicacion.png"> UBICACÍON</h5>
                            <p><?php echo replace($proveedor['calle_contacto']) . ' No. ' . $proveedor['numero_contacto'] ?><br>
                            Col. <?php echo replace($proveedor['colonia_contacto'])  ?>  <br>
                            CP. <?php echo $proveedor['cp_contacto']  ?> <br>
                            <?php echo replace($municipio . ' ' . $estado)  ?> 
                            </p>

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
                                    
                        </li>
                        <li>
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

                            <?php 
                            
                            $where = "pagado = 1"
                                    . " AND id = " . $proveedor['id'] 
                                    . " AND fecha_inicio <= '" . date("Y/m/d") . "'"
                                    . " AND fecha_fin >= '" . date("Y/m/d") . "'" ;
                            $sitio = get_all_actived_inactived('registros', $where, 'id');  
                            

                            ?>
                            
                            <?php if(count($sitio)): ?>
    
                            <form name="minisitio"  method="get" action="minisitio.php">
                                
                                <input type="hidden" name="tipo"  value="proveedores">
                                <input type="hidden" name="id"  value="<?php echo $proveedor['id']  ?>">
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
