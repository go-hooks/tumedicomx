<?php
    session_start();
    session_name('medico_laguna');

    $ubicacion='inicio';
    
    require_once(dirname(__FILE__) . "/ini.php");    
    include('includes/metatags.php'); 

?>

<title>Tu Medico Laguna</title>
</head>
<body id="anunciate">

<?php include('includes/header.php'); ?>
<section class="wrapper">

    <?php include('includes/search.php'); ?>

    <h3>Anúnciate<br><span>Conoce nuestros paquetes promocionales.</h3>

    <!--<a href="contacto.php">
        <input type="button" class="btnregistro" value="COMPRAR">
    </a>-->

    
    <div class="banners">
        <table width="550">
            <tr>
                <td><h2 class="colorazul">Banner 1</h2><td>
                <td>$800.00 Por 30 Días<td>
                
            </tr>
            <tr>
                <td><h2 class="colorazul">Banner 2</h2><td>
                <td>$400.00 Por 30 Días<td>
                <!--<td><input type="button" class="btnregistro" value="COMPRAR"><td>-->
            </tr>
            <tr>
                <td><h2 class="colorazul">Banner 3</h2><td>
                <td>$400.00 Por 30 Días<td>
                <!--<td><input type="button" class="btnregistro" value="COMPRAR"><td>-->
            </tr>
            <tr>
                <td><h2 class="colorazul">Banner 4</h2><td>
                <td>$200.00 Por 30 Días<td>
                <!--<td><input type="button" class="btnregistro" value="COMPRAR"><td>-->
            </tr>
            <tr>
                <td><h2 class="colorazul">Banner 5</h2><td>
                <td>$100.00 Por 30 Días<td>
                <!--<td><input type="button" class="btnregistro" value="COMPRAR"><td>-->
            </tr>
            
            <tr>                
                <td>*Precios en MXN - incluyen IVA <!--<strong>Pregunta por nuestros paquetes por &nbsp; 7 o 15</strong>--><td>
                    <!--<td><strong> días </strong><td>-->
                <!--<td><input type="button" class="btnregistro" value="COMPRAR"><td>-->
            </tr>
            
        </table>
    </div>

    <p><span class="colorazul">Banner 1</span> (900 X 130) </p>
    <img src="img/banner1.png">    
    <p><span class="colorazul">Banner 2</span> (900 X 220) </p>
    <img src="img/banner2.png">
    <div class="colizq">
        <p><span class="colorazul">Banner 3</span> (400 X 375) </p>
        <img src="img/banner3.png">
    </div>
    <div class="colder">
        <p><span class="colorazul">Banner 4</span> (400 X 275) </p>
        <img src="img/banner4.png">

        <p><span class="colorazul">Banner 5</span> (400 X 140) </p>
        <img src="img/banner5.png">
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
