<?php include('includes/metatags.php'); ?>
    <title>Tu Medico Laguna</title>
</head>
<body id="registro">

<?php include('includes/header.php'); ?>
<section class="wrapper">

    <?php include('includes/search.php'); ?>

    <div class="registro">
        <h2>REGISTRO GRATUITO DE INSTITUCIÓN<br>
            <span>Si deseas registrar gratuitamente tu institución, llena el siguiente formulario y comienza a disfrutar de los beneficios.</span></h2>
    </div>

    <div class="registro">
        <p class="subt">DATOS BÁSICOS</p>
        <p>REPRESENTANTE LEGAL* <input class="txt" type="text" name="representante"></p>
        <p>NOMBRE DE INSTITUCIÓN* <input class="txt" class="txt" type="text" name="nombre"></p>
        <p>CORREO* <input class="txt" type="text" name="correo"></p>
        <p>TELÉFONO* <input class="txt" type="text" name="telefono"></p>
        <p>CONTRASEÑA* <input class="txt" type="pass" name="password"></p>
        <p>CONFIRMAR CONTRASEÑA* <input class="txt" type="pass" name="password2"></p>
    </div>

    <div class="registro">
        <p class="subt">DATOS DE CONTACTO</p>
        <table width="850" height="130">
            <tr>
                <td>CALLE* <input class="txt txt3" type="text" name="calle"></td>
                <td width="210">NUM* <input class="txt txt1" class="txt" type="text" name="num"></td>
            </tr>
            <tr>
                <td>COLONIA* <input class="txt txt3" type="text" name="colonia"></td>
                <td>CP*. <input class="txt txt1" type="text" name="cp"></td>
            </tr>
        </table>

        <table width="850" height="140">
            <tr>
                <td width="450">ESTADO* <input class="txt txt2" class="txt" type="text" name="estado"></td>
                <td>MUNICIPIO* <input class="txt txt2" type="text" name="municipio"></td>
            </tr>
            <tr>
                <td>TELÉFONO FIJO* <input class="txt txt2" class="txt" type="text" name="telfijo"></td>
                <td>FAX <input class="txt txt2" type="text" name="fax"></td>
            </tr>
        </table>
        <div class="clear"></div>
    </div>

    <div class="registro">
        <p class="subt">CLASIFICACIÓN</p>
        <table width="850" height="110">
            <tr>
                <td width="450">CATEGORIA*
                    <select>
                        <option>SELCCIONA UNO</option>
                    </select> 
                </td>
                <td>SUBCATEGORIA*
                    <select>
                        <option>SELCCIONA UNO</option>
                    </select> 
                </td>
            </tr>
        </table>

        <table width="100%">
            <tr>
                <th width="140" valign="top">ASEGURADORAS:</th>
                <td>
                    <ul>
                        <li><input type="checkbox" name="aseguradoras">Alfa Medical<br><img src="img/logo-alfamedical.jpg"></li>
                        <li><input type="checkbox" name="aseguradoras">Seguros Monterrey<br><img class="seguros" src="img/logo-monterrey.jpg"></li>
                        <li><input type="checkbox" name="aseguradoras">Zurich<br><img class="seguros" src="img/logo-zurich.jpg"></li>
                        <li><input type="checkbox" name="aseguradoras">Allianz<br><img class="seguros" src="img/logo-allianz.jpg"></li>
                        <li><input type="checkbox" name="aseguradoras">AXXA<br><img class="seguros" src="img/logo-axxa.jpg"></li>
                        <hr>
                        <li><input type="checkbox" name="aseguradoras">Grupo Banorte<br><img class="seguros" src="img/logo-banorte.jpg"></li>
                        <li><input type="checkbox" name="aseguradoras">Seguros Banamex<br><img class="seguros" src="img/logo-banamex.jpg"></li>
                        <li><input type="checkbox" name="aseguradoras">Scotianbank<br><img class="seguros" src="img/logo-scotianbank.jpg"></li>
                        <li><input type="checkbox" name="aseguradoras">Santander<br><img class="seguros" src="img/logo-santander.jpg"></li>
                        <hr>
                        <li><input type="checkbox" name="aseguradoras">GNP<br><img class="seguros" src="img/logo-gnp.jpg"></li>
                        <li><input type="checkbox" name="aseguradoras">Vita Medica<br><img class="seguros" src="img/logo-vitamedica.jpg"></li>
                        <li><input type="checkbox" name="aseguradoras">Bupa<br><img class="seguros" src="img/logo-bupa.jpg"></li>
                        <li><input type="checkbox" name="aseguradoras">Metlife<br><img class="seguros" src="img/logo-metlife.jpg"></li>
                        <hr>                    
                    </ul>
                </td>
            </tr>

            <tr>
                <th valign="top">FORMAS DE PAGO:</th>
                <td>
                    <ul>
                        <li><input type="checkbox" name="tarjetas">Master Card<br><img src="img/logo-mastercard.jpg"></li>
                        <li><input type="checkbox" name="tarjetas">Visa<br><img src="img/logo-visa.jpg"></li>
                        <li><input type="checkbox" name="tarjetas">American Express<br> <img src="img/logo-american.jpg"></li>
                    </ul>
                </td>
            </tr>
        </table>

        

        <p>CÉDULA PROFESIONAL: <input type="text" name="cedula" class="txt"></p>
    </div>


    <table class="suscribir">
        <tr>
            <td><input type="radio" class="radios" name="terminos"><a href="#">Acepto los terminos y condiciones</a></td>
            <td><input type="button" class="btnregistro fr" value="SUSCRIBIR"></td>
        </tr>
    </table>

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
