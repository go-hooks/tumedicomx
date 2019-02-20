<?php include('includes/metatags.php'); ?>
    <title>Tu Medico Laguna</title>
</head>
<body id="gratis">

<?php include('includes/header.php'); ?>
<section class="wrapper">

    <?php include('includes/search.php'); ?>

    <h3>Registro gratuito de profesionales e instituciones <br> 
    	<span>Beneficios de ser un profesional e Institucion registrado</span><br><br></h3>

    <h3 class="puntos"><span>Posicionamiento en el directorio de nuestro portal, donde los pacientes pueden encontrarte.</span></h3>
	<h3 class="puntos"><span>Acceso a la sección de destacados*</h3>
	<h3 class="puntos"><span>Acceso a solicitud de publicidad</h3>
	<p class="puntos"><span>*Consulta esta modalidad con un asesor</p>

	<div class="icogratis">
		<a href="registro.php"><img src="img/img-gratis1.jpg">
		<a href="registro-institucion.php"><img src="img/img-gratis2.jpg"><br>

		<a href="registro.php"><input type="button" class="btninstitucion" value="PROFESIONAL"></a>
		<a href="registro-institucion.php"><input type="button" class="btninstitucion" value="INSTITUCION"></a>
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
