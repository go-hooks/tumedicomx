<?php
    require_once(dirname(__FILE__) . "/ini.php");   
    
    $ubicacion='inicio';
    
    include('includes/metatags.php'); 
?>

    <title>Tu Medico Laguna</title>
</head>
<body id="gracias">

<?php include('includes/header.php'); ?>
<section class="wrapper">

    <div class="gracias">
        <h2>LA EDICIÓN DE TUS DATOS HA SIDO EXITOSA.</h2>

        <p>VALIDAREMOS TU INFORMACIÓN. <br>
        EN BREVE RECIBIRÁS UN CORREO DE CONFIRMACIÓN. </p>
        
    </div>

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
