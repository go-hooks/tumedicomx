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

    <?php include('includes/search.php'); ?>

    <div class="gracias">
        <h2>GRACIAS</h2>

        <p>TU MENSAJE HA SIDO ENVIADO.</p>
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
