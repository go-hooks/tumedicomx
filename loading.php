<?php
    session_start();
    session_name('medico_laguna');      
    
    $_SESSION['contador'] = 1;
    
    require_once(dirname(__FILE__) . "/ini.php");        
    include('includes/metatags.php'); 
    
?>

<head>  
    <title>Tu Médico Laguna</title>
</head>
<body id="loading">

    <!--<div id="loading_bienvenido">
        <img src="img/Loading/bienvenido.png"> 
    </div>    -->
    
    <div id="loading_img">
        <img src="img/Loading/logo.png"> 
    </div>

    <div id="loading_slogan">
        <img src="img/Loading/slogan.png"> 
    </div>
    
    
    <a href="index.php">
        
        <div id="loading_entrar">
            <img src="img/Loading/entrar.png"> 
        </div>
    </a>
    
    <div id="loading_siguenos">
        <img src="img/Loading/siguenos.png"> 
    </div>    
    
    <div id="loading_redes">
        <img src="img/Loading/social.png"> 
    </div>
    
    
    <!-- JQUERY -->
<script src="js/vendor/jquery.cycle2.min.js"></script>
<script src="js/vendor/jquery.cycle2.carousel.min.js"></script>

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