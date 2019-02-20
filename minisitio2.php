<?php include('includes/metatags.php'); ?>
    <title>Tu Medico Laguna</title>
</head>
<body id="minisitio">

<?php include('includes/header.php'); ?>
<section class="wrapper">

    <?php include('includes/search.php'); ?>

    <h3>MINI SITIO / PATRICIA RUIZ BARRIENTOS</h3>
    <div class="colizq">
        <ul class="ficha">
            <h4>PATRICIA RUIZ BARRIENTOS</h4>
            <li>
                <h5><img src="img/ico-especialidad.png"> ESPECIALIDAD:</h5>
                <p>MEDICO GENERAL</p>

                <h5><img src="img/ico-tel.png"> TELÉFONOS:</h5>
                <p>57812035, 57296000 EXT 66017<br>
                    FAX. 56 78 90 90
                </p>

                <h5><img src="img/ico-ubicacion.png"> UBICACÍON</h5>
                <p>Av. México No. 45 Col. Real del Sol  <br>
                CP. 456789 Torreón Coahuila
                </p>

                <h5><img src="img/ico-mail.png"> CORREO ELECTRÓNICO</h5>
                <p>dra.patriciaruiz@hotmail.com</p>
                <h5><img src="img/ico-tarjetas.jpg">FORMAS DE PAGO</h5>
                <p>
                    <img src="img/tarjeta-visa.png">
                    <img src="img/tarjeta-mastercard.png">
                    <img src="img/tarjeta-american.png">
                </p>
                <h5><img src="img/ico-seguros.jpg">SEGUROS</h5>
                <p>
                    <img src="img/seguro-gnp.png">
                    <img src="img/seguro-axa.png"><br>
                    <img src="img/seguro-santander.png">
                    <img src="img/seguro-banamex.png"><br>
                    <img src="img/seguro-azul.png">
                    <img src="img/seguro-monterrey.png">
                    <img src="img/seguro-metlife.png"><br>
                    <img src="img/seguro-alfamedical.png">
                    <img src="img/seguro-banorte.png">
                    <img src="img/seguro-scotianbank.png"><br>
                    <img src="img/seguro-allianz.png">
                </p>
            </li>
        </ul>
        <ul class="ficha web">
            <li>
                <h5>SITIO WEB</h5>
                <p>www.patriciaruiz.com</p>

                <h5>REDES SOCIALES</h5>
                <p><img src="img/ico-twitter.jpg"><img src="img/ico-face.jpg"></p>
            </li>
        </ul> 
    </div>

    <div class="colder">
        <div class="minisitiologo">
            <img src="img/logominisitio.jpg">
        </div>
        <div class="banner3 cycle-slideshow">
            <img src="img/banner302.png">
            <img src="img/banner301.png">
        </div>
    </div>
    <div class="clear"></div>

    <h3>DESCRIPCIÓN DE SERVICIOS</h3>
    <div class="minisitiodesc">
        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. 
    </div>

    <h3>ENVÍA UN MENSAJE <br><span>Si desea realizar una cita llene el siguiente formulario.</span></h3>
    <form class="bordeazul">
        <table width="100%">
            <tr>
                <td width="33">NOMBRE <input type="text" class="txt" name="nombre"></td>
                <td width="34">CORREO: <input type="text" class="txt" name="correo"></td>
                <td width="33">TELÉFONO<input type="text" class="txt" name="telefono"></td>
            </tr>
        </table>
        MENSAJE<input type="text" class="txt txt2" name="mensaje"><br>
        <input type="submit" class="btnminisitio fr" value="ENVIAR">
    </form>

    <h3>UBICACIÓN EN MAPA</h3>
    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d7651369.854873354!2d-108.14215645!3d20.546344700000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses!2smx!4v1399413676588" width="100%" height="350" frameborder="0"></iframe>

    <hr>

    <input type="button" class="btneditar fr" value="EDITAR MINI SITIO"  >

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
