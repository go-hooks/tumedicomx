<?php include('includes/metatags.php'); ?>
    <title>Tu Medico Laguna</title>
</head>
<body id="perfil">

<?php include('includes/header.php'); ?>
<section class="wrapper">

    <?php include('includes/search.php'); ?>

    <div class="perfil">
        <h2>PROFESIONAL</h2>
    </div>

    <div class="perfil">
        <p class="subt">DATOS BASICOS</p>
        <p><b>NOMBRE:</b> DRA. MARIANA GONZÁLEZ PEREZ</p>
        <p><b>CORREO:</b>MARIANA@HOTMAIL.COM</p>
        <p><b>TELÉFONO:</b>(33) 43 32 42 34</p>
        <p><b>CONTRASEÑA:</b>****************</p>
    </div>

    <div class="perfil">
        <p class="subt">DATOS DE CONTACTO</p>

        <table width="100%" height="300">
            <tr>
                <td><b>CALLE:</b>LOS PINOS</td>
                <td><b>NUM:</b> #1555</td>
            </tr>
            <tr>
                <td><b>COLONIA:</b>LOS PINOS</td>
                <td><b>CP:</b>45580</td>
            </tr>
            <tr>
                <td><b>ESTADO:</b>COAHUILA</td>
                <td><b>MUNICIPIO:</b>TERREON</td>
            </tr>
            <tr>
                <td><b>TELÉFONO FIJO:</b>2342342423</td>
                <td><b>TELÉFONO MOVIL:</b>234234234</td>
            </tr>
            <tr>
                <td><b>RADIO:</b>2342342423</td>
                <td><b>BIPER:</b>234234234</td>
            </tr>
        </table>
    </div>

    <div class="perfil">
        <p class="subt">CLASIFICACIÓN</p>

        <p><b>ESPECIALIDAD:</b> DENTISTA</p>

        <p><b>ASEGURADORAS:</b></p>
        <img class="seguros" src="img/logo-alfamedical.jpg"><img class="seguros" src="img/logo-monterrey.jpg">
        <img class="seguros" src="img/logo-gnp.jpg"><img class="seguros" src="img/logo-vitamedica.jpg">

        <p><b>TARJETAS:</b></p>
        <img class="tarjetas" src="img/logo-mastercard.jpg">
        <img class="tarjetas" src="img/logo-visa.jpg">
        <img class="tarjetas" src="img/logo-american.jpg">

        <p><b>CÉDULA PROFESIONAL:</b> 9842349923740723470</p>
    </div>

    <input type="button" class="btnregistro fr" value="EDITAR"> 

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
