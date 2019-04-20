  <!--[if lt IE 7]>
        <p class="chromeframe">Tu navegador es <strong>Obsoleto</strong>. Por favor <a href="http://browsehappy.com/">actualizalo</a> ó <a href="http://www.google.com/chromeframe/?redirect=true">instala el componente Google Chrome Frame</a> para mejorar tu experiencia.</p>
    <![endif]-->
    <header>
        <div class="wrapper">
            <a href="index.php">
                <img src="img/logo.png" id="logo" class="fl">                
            </a>
            


            <p class="fecha">            
            <?php 
                            
                date_default_timezone_set('America/Mexico_City');      
                setlocale (LC_TIME,"spanish");

                $dias = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
                $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                
                echo $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;            
                
                //echo strftime("%A, %d de %B de %Y");
            
            ?>
              <br><br><span style="font-size: 16px" >DIRECTORIO MÉDICO</span>
            </p>
            

            <?php 
            
                $sql = " SELECT * FROM imagen";
                $imagen = get_one_sql($sql);    
    
            ?>
            
            <?php if(isset($imagen['imagen'])): ?>                   
                <a href="<?php echo $imagen['url'] ?>" target="_blank">
                    <img src="<?php echo UP_IMG_PATH . $imagen['imagen'] ?>" style="float:right" height="146px">            
                </a>
            <?php endif; ?>
            
            
            <nav>
                <ul class="wrapper">
                   <li><a href="index.php"><img src="img/ico-home.png"></a></li>
                   <li><a href="medicos.php">Médicos </a></li>
                   <li><a href="hospitales.php">Hospitales y Clinicas</a></li>
                   <li><a href="laboratorios.php">Laboratorios</a></li>
                   <li><a href="servicios-relacionados.php">Servicios</a></li>
                   <li><a href="proveedores.php">Proveedores</a></li>
                   <li><a href="empresa.php">Quiénes Somos</a></li>
                   <li><a href="contacto.php">Contacto</a></li>          
                   <li><a href="LiveBetter/index.php" target="_blank">Live Better</a></li>          
                </ul>
            </nav>
        </div>

    </header>


    
