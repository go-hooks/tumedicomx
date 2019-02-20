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

    <?php include('includes/search.php'); ?>

    <h3>Registro premium de profesionales e instituciones <br> 
    	<span>Beneficios de ser un profesional e Institucion registrado</span><br><br></h3>

    <h3 class="puntos"><span>Primeros lugares de posicionamiento en nuestros listados. </span></h3>
	<h3 class="puntos"><span>Minisitio personalizado, en donde podrás describir tus servicios, datos de contacto, métodos de pago, horarios de consulta o servicio, y solicitar publicidad dentro de nuestro portal. </h3>
	<h3 class="puntos"><span>Acceso a la sección de destacados*</h3>
	<h3 class="puntos"><span>En caso ser profesional, recibir peticiones de citas por parte de los pacientes.</h3>
	<h3 class="puntos"><span>En caso de ser institución, recibir consultas de tus servicios por parte de los usuarios.</h3>
	
	<h3 class="puntos"><span>Si deseas suscribirte como usuario Premium, selecciona el plan que más te convenga, el sistema te mostrará una página con un formulario para que puedas solicitar tu alta como Médico Premium, y un asesor de venta te contactá.<br><br></h3>
	<h3 class="puntos2"><span>Suscripción 1 año: 999 + IVA. </h3>
	<h3 class="puntos2"><span>Suscripción 2 años: 1,499 + IVA.</h3>
	<h3 class="puntos2"><span>Suscripción 3 años: 1,799 + IVA.</h3>

	<p class="puntos2"><span>*Consulta esta modalidad con un asesor</p>




	<div class="icogratis">
		<a href="registro-premium.php"><img src="img/img-gratis1.jpg"></a>
		<a href="registro-premium-hospital.php"><img src="img/img-gratis2.jpg"></a>
		<a href="registro-premium-laboratorio.php"><img src="img/img-registro-laboratorio.png"></a>
                <a href="registro-premium-servicios.php"><img src="img/img-registro-servicios.png"></a>
		<a href="registro-premium-proveedores.php"><img src="img/img-registro-proveedores.png"></a>
		


                <a href="registro-premium.php"><input type="button" class="btninstitucion" value="PROFESIONAL"></a>
		<a href="registro-premium-hospital.php"><input type="button" class="btninstitucion" value="HOSPITALES"></a>
		<a href="registro-premium-laboratorio.php"><input type="button" class="btninstitucion" value="LABORATORIO"></a>
                <a href="registro-premium-servicios.php"><input type="button" class="btninstitucion" value="SERVICIOS"></a>
		<a href="registro-premium-proveedores.php"><input type="button" class="btninstitucion" value="PROVEEDORES"></a>
		
	</div>
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
