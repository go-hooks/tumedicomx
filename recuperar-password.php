<?php
    session_start();
    session_name('medico_laguna');

    $ubicacion='inicio';
    
    require_once(dirname(__FILE__) . "/ini.php");    
    include('includes/metatags.php'); 

?>


<title>Tu Medico Laguna</title>
</head>
<body id="recuperar">

<?php include('includes/header.php'); ?>
<section class="wrapper">
    
                    <?php if(isset($_GET['error'])): ?>
                        <label style="color:red">El usuario ingresado no existe</label>
                    <?php endif; ?>    
    
    <h3>Recupera tu contraseña <br><span>Ingresa tu usuario para resetear tu contraseña</span></h3>
    

    <form class="recuperar" name="contacto" method="post" action="envia_password.php">
        USUARIO<br>
        <input type="text" class="txt" name="contacto[correo]"><br><br>

<!--        INGRESA LOS CARACTERES MOSTRADOS<br><br>
        <img src="img/img-capcha.jpg"><br>-->

        <input type="submit" class="btnminisitio" value="ENVIAR">
        <input type="button" class="btnentrar" value="CANCELAR" onClick="location.href='index.php'">       

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
