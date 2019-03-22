<?php
    session_start();
    session_name('medico_laguna');

    $ubicacion='medicos';
    
    require_once(dirname(__FILE__) . "/ini.php");    
    include('includes/metatags.php'); 

    if(! isset($_GET['buscar'])):
        $where = "elim = 0";
    else:
        $where = "elim = 0"
               . " and nombre like '" . $_GET['buscar'] . "%'";                
    endif;
    
    $catalogos = get_all_actived_inactived('catalogos_medicos', $where, 'nombre');     
       
    
    
    $sql = " SELECT * FROM invasivos"
            . " WHERE"
            . " elim = 0"            
            . " AND localizacion = 'medicos'"
            . " AND tipo = 1"
            . " AND fecha_inicio <= '" . date("Y/m/d") . "'"
            . " AND fecha_fin >= '" . date("Y/m/d") . "'" ;
    $invasivo = get_one_sql($sql);     
?>

<title>Tu Medico Laguna</title>
</head>
<body id="medicos">

    <?php if(! isset($_SESSION['medicos'])): ?>        
        
        <?php if(!empty($invasivo)): ?>        
    
            <?php $_SESSION['medicos'] = 1 ?>
            <a href="<?php echo UP_IMG_PATH . $invasivo['imagen']  ?>" class="fancybox" id="promocion"></a>                
            
        <?php endif; ?>        
            
            
    <?php endif; ?>    
    
<?php include('includes/header.php'); ?>
<section class="wrapper">

    <h2 class="colorazul">BÚSQUEDA DE ESPECIALIDAD POR ORDEN ALFABÉTICO:</h2>
    <ul class="alfabeto">
        <li><a href="medicos.php?buscar=A">A</a></li>
        <li><a href="medicos.php?buscar=B">B</a></li>
        <li><a href="medicos.php?buscar=C">C</a></li>
        <li><a href="medicos.php?buscar=D">D</a></li>
        <li><a href="medicos.php?buscar=E">E</a></li>
        <li><a href="medicos.php?buscar=F">F</a></li>
        <li><a href="medicos.php?buscar=G">G</a></li>
        <li><a href="medicos.php?buscar=H">H</a></li>
        <li><a href="medicos.php?buscar=I">I</a></li>
        <li><a href="medicos.php?buscar=J">J</a></li>
        <li><a href="medicos.php?buscar=K">K</a></li>
        <li><a href="medicos.php?buscar=L">L</a></li>
        <li><a href="medicos.php?buscar=M">M</a></li>
        <li><a href="medicos.php?buscar=N">N</a></li>
        <li><a href="medicos.php?buscar=Ñ">Ñ</a></li>
        <li><a href="medicos.php?buscar=O">O</a></li>
        <li><a href="medicos.php?buscar=P">P</a></li>
        <li><a href="medicos.php?buscar=Q">Q</a></li>
        <li><a href="medicos.php?buscar=R">R</a></li>
        <li><a href="medicos.php?buscar=S">S</a></li>
        <li><a href="medicos.php?buscar=T">T</a></li>
        <li><a href="medicos.php?buscar=U">U</a></li>
        <li><a href="medicos.php?buscar=V">V</a></li>
        <li><a href="medicos.php?buscar=W">W</a></li>
        <li><a href="medicos.php?buscar=X">X</a></li>
        <li><a href="medicos.php?buscar=Y">Y</a></li>
        <li><a href="medicos.php?buscar=Z">Z</a></li>
    </ul>
    
    <!--columna izquierda-->    
    <div class="col1" style="width: 48%; display:inline-block; vertical-align: top;">  
    <?php foreach($catalogos as $key=>$catalogo):
        
        $sql = " SELECT * FROM registros r"
                . " INNER JOIN"
                . " medicos m"
                . " ON r.id = m.id"
                . " WHERE"
                . " r.elim=0 AND r.autorizado=1 AND categoria_id =". $catalogo['id'];   
         
        $medicos = get_sql($sql);   
        
    ?>

    <?php if( ( count($catalogos) / 2) >= ($key + 1)): ?>
         

        <a href="resultados-medicos.php?id=<?php echo $catalogo['id'] ?>">
            <h3><?php echo replace($catalogo['nombre']) . " ( " . count($medicos) .  " ) " ?>
            <br>
        </h3>                
        </a>        
   
    <?php endif; ?>
        
    <?php endforeach; ?>
    </div>
    <!--Fin de columna izquierda-->
    

    <!--columna derecha-->    
    <div class="col2" style="width: 48%; display:inline-block; vertical-align: top;">  
    <?php foreach($catalogos as $key=>$catalogo):
        
        $sql = " SELECT * FROM registros r"
                . " INNER JOIN"
                . " medicos m"
                . " ON r.id = m.id"
                . " WHERE"
                . " r.elim=0 AND r.autorizado=1 AND categoria_id =". $catalogo['id'];   
         
        $medicos = get_sql($sql);   
        
    ?>

    <?php if( ( count($catalogos) / 2) < ($key + 1)): ?>
      
    <!--columna derecha-->    
        <a href="resultados-medicos.php?id=<?php echo $catalogo['id'] ?>">
        <h3><?php echo replace($catalogo['nombre']) . " ( " . count($medicos) .  " ) " ?>
            <br>
        </h3>                
        </a>    
    
    <?php endif; ?>   
        
    <?php endforeach; ?>
    </div>
    <!--Fin de columna derecha-->    
    
    
   
    
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
