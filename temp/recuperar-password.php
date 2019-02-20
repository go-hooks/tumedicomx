<?php include('includes/metatags.php'); ?>
    <title>Tu Medico Laguna</title>
</head>
<body id="recuperar">

<?php include('includes/header.php'); ?>
<section class="wrapper">

    <?php include('includes/search.php'); ?>

    <h3>Recuperar tu contraseña <br><span>Te podemos ayudar a resetear tu contraseña. Ingresa tu correo electrónico</span></h3>
    

    <form class="recuperar">
        CORREO<br>
        <input type="text" class="txt" name="correo"><br><br>

        INGRESA LOS CARACTERES MOSTRADOS<br><br>
        <img src="img/img-capcha.jpg"><br>

        <input type="submit" class="btnminisitio" value="SIGUIENTE">
        <input type="button" class="btnentrar" value="CANCELAR">


    </form>

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
