<?php include('includes/metatags.php'); ?>
    <title>Tu Medico Laguna</title>
</head>
<body id="contacto">

<?php include('includes/header.php'); ?>
<section class="wrapper">

    <?php include('includes/search.php'); ?>

    <hr>

    <div class="contacto">
        <p>Si tienes dudas o comentarios acerca de tumedicolaguna.com puedes enviarnos un correo electrónico a: </p>
        <p class="colorazul"><img src="img/ico-mailcontacto.jpg"><b>contacto@tumedicolaguna.com</b></p>
        <p>O comunicarte al siguiente número telefónico:</p>
        <p class="colorazul"><img src="img/ico-telcontacto.jpg"><b>8110 08 13 83</b></p>
    </div>

    <hr>
    <div class="contacto">
        <h2>ENVÍANOS UN MENSAJE</h2>
        <form class="clear">
            <input type="text" class="txt" placeholder="Nombre" name="nombre">
            <input type="text" class="txt" placeholder="E-mail"  name="correo">
            <input type="text" class="txt" placeholder="Teléfono"  name="telefono">
            <input type="text" class="txt" placeholder="Ciudad" name="ciudad">
            <input type="text" class="txt" placeholder="Empresa"  name="e,presa">
            <textarea class="txtarea" name="mensaje" placeholder="Mensaje"></textarea>
            <input type="submit" class="btnregistro fr" value="ENVIAR">
        </form>
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
