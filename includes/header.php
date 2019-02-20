    <!--[if lt IE 7]>
        <p class="chromeframe">Tu navegador es <strong>Obsoleto</strong>. Por favor <a href="http://browsehappy.com/">actualizalo</a> ó <a href="http://www.google.com/chromeframe/?redirect=true">instala el componente Google Chrome Frame</a> para mejorar tu experiencia.</p>
    <![endif]-->
    <header id="mainheader">
        <div class="wrapper">
            <div class="header-block logo-block">
                <a href="index.php">
                    <img src="img/logomx.png" id="logo" class="fl">                
                </a>
            </div>
            <div class="header-block search-block">
                <form id="zonabuscador2" name="contacto"  method="post" action="resultados-busqueda.php">    
                    <input id="buscador" type="text" name="buscar" placeholder="Busca Médicos, Hospitales...">
                    <!--<input id="btnbuscador" type="submit" value=">>">-->
                    <button id="btnbuscador" type="submit"><i class="fa fa-search"></i></button>          
                </form>
            </div>
            <div class="header-block fecha-block">
                <p class="fecha">  
                    <!--<span id= 'webtitle' style="font-size: 20px" >DIRECTORIO DE SERVICIOS MÉDICOS</span>-->         
                    <?php 
                            
                        date_default_timezone_set('America/Mexico_City');      
                        setlocale (LC_TIME,"spanish");

                        $dias = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
                        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                
                        echo $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y');                      
                    ?>
                </p>
            </div>
        </div>
        <div class="navigation row">
            <div class="panel">
                <nav>
                    <ul id = "mainmenu" class="menu">
                       <li><a href="medicos.php">MÉDICOS</a></li>
                       <li><a href="hospitales.php">HOSPITALES</a></li>
                       <li><a href="laboratorios.php">LABORATORIOS</a></li>
                       <li><a href="servicios-relacionados.php">SERVICIOS</a></li>
                       <li><a href="proveedores.php">PROVEEDORES</a></li>
                       <li><a href="empresa.php">NOSOTROS</a></li>
                       <li><a href="contacto.php">CONTACTO</a></li>          
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    
