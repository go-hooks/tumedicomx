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
