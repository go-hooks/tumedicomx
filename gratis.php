<?php
    session_start();       
    session_name('medico_laguna');

    $ubicacion='inicio';    
    
    require_once(dirname(__FILE__) . "/ini.php");    
    include('includes/metatags.php'); 

?>

    <title>Tu Medico Laguna</title>
</head>
<body id="gratis">

<?php include('includes/header.php'); ?>
<section class="wrapper">
	<div class="clear2"></div>
    <?php include('includes/search2.php'); ?>

    <h3>Registro Gratuito de Profesionales e Instituciones</h3>
	<div class="icogratis">
        <a href="registro.php"><img src="img/img-gratis1.jpg"></a>
        <a href="registro-hospital.php"><img src="img/img-gratis2.jpg"></a>
        <a href="registro-laboratorio.php"><img src="img/img-registro-laboratorio.png"></a>        
        <a href="registro-servicios.php"><img src="img/img-registro-servicios.png"></a>
        <a href="registro-proveedores.php"><img src="img/img-registro-proveedores.png"></a>


        <a href="registro.php"><input type="button" class="btninstitucion" value="PROFESIONAL"></a>
        <a href="registro-hospital.php"><input type="button" class="btninstitucion" value="HOSPITALES"></a>
        <a href="registro-laboratorio.php"><input type="button" class="btninstitucion" value="LABORATORIO"></a>        
        <a href="registro-servicios.php"><input type="button" class="btninstitucion" value="SERVICIOS"></a>
        <a href="registro-proveedores.php"><input type="button" class="btninstitucion" value="PROVEEDORES"></a>
        
    </div>
	<h3>Beneficios de ser un Profesional ó Institucion registrado <br></h3>
    <h3 class="puntos"><span>Posicionamiento en nuestro directorio, donde los pacientes pueden encontrarte.</span></h3>
	<h3 class="puntos"><span>Acceso a la sección de destacados*</h3>
	<h3 class="puntos"><span>Promociones exclusivas en publicidad*</h3>
	<p class="puntos"><span>*Consulta esta modalidad con un asesor</p>

	    <div class="clear2"></div>
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
