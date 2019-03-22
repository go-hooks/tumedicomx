<?php
    session_start();
    session_name('medico_laguna');
        
    $ubicacion='empresa';      

    require_once(dirname(__FILE__) . "/ini.php");    
    include('includes/metatags.php'); 
    
?>

<title>Tu Medico Laguna</title>
</head>
<body id="empresa">

<?php include('includes/header.php'); ?>
<section class="wrapper">
<div class="clear2"></div>
 <?php include('includes/search2.php'); ?>
 
 <h2 class="colorazul">ACERCA DE NOSOTROS</h2>
 
    <p><b>Somos un directorio médico online fundado en la ciudad de Torreòn en el año 2014 que busca ser la primera opción de contacto 
		en México para aquellas personas que requieren de servicios relacionados con la salud. Dentro de nuestro poratl el usuario puede 
		entrar en contacto con el profesional, hospitales e instituciones prestadoras de servicios de salud; 
        conocer la oferta de servicio, ubicación, solicitar información y citas de una manera cómoda, fácil y 
        práctica tanto para el usuario como para el profesional.</b>
    </p>

    <hr>

    <img src="img/img-empresa.jpg">

    <ul>
        <li>Busca los mejores doctores, hospitales, clínicas o instituciones médicas.</li>
        <li>Si eres doctor, hospital, clínica o institucion, regístrate y publica tus servicios</li>
        <li>Los doctores y hospitales más destacados.</li>
    </ul>

    <hr>

    <a href="preguntas-frecuentes.php"><input type="button" value="PREGUNTAS FRECUENTES" class="btnpreguntas fl"></a>
    <a href="terminos.php"><input type="button" value="TÉRMINOS Y CONDICIONES" class="btnpreguntas fr"></a>

    <div class="clear"></div>
</section>



<?php include('includes/prefooter2.php'); ?>
<?php include('includes/footer.php'); ?>


<!-- JQUERY -->
<script src="js/vendor/jquery.cycle2.min.js"></script>
<script src="js/vendor/jquery.cycle2.carousel.min.js"></script>

<!-- LUCKY ORANGE -->
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
