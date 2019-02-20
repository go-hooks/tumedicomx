<?php
    session_start();
    session_name('medico_laguna');
    
    $ubicacion='contacto';       

    require_once(dirname(__FILE__) . "/ini.php");    
    include('includes/metatags.php'); 

?>

<title>Tu Medico Laguna</title>
</head>
<body id="contacto">

<?php include('includes/header.php'); ?>
<section class="wrapper">

    <?php include('includes/search.php'); ?>


<div class="contacto">

                    <?php if(isset($_GET['exito'])): ?>
                    <label><!--p class="mensaje"><strong>Tu mensaje ha sido enviado<br />
                           Gracias por ponerte en contacto</strong></p-->
                           <section class="wrapper">
                                <div class="gracias">
                                   
                                    
                                    <h2>GRACIAS POR PONERTE EN CONTACTO</h2></br></br></br></br></br>
                                     <span class="mensaje"><strong>TU MENSAJE HA SIDO ENVIADO.</strong>
                                    </span>
                                    </br></br></br></br></br>
                                    
                                    
                                </div>
                                <div class="clear"></div>
                            </section>
                    </label>
                    <?php endif; ?>
                    <?php if(isset($_GET['error'])): ?>
                    <label>Completa todos los campos<br />
                           del formulario
                    </label>
                    <?php endif; ?>
    </div>


    <hr>

    <div class="contacto">
        <p>Si tienes dudas o comentarios acerca de tumedicomx.com puedes enviarnos un correo electrónico a: </p>
        <p class="colorazul"><img src="img/ico-mailcontacto.jpg"><b>contacto@tumedicomx.com</b></p>
        <p>O comunicarte al siguiente número telefónico:</p>
        <p class="colorazul"><img src="img/ico-telcontacto.jpg"><b>871-475-38-41</b></p>
    </div>

    <hr>
    
    
    <div class="contacto">
        <h2>ENVÍANOS UN MENSAJE</h2>
        
        <form class="clear" name="contacto"  method="post" action="envia_contacto.php">
            <input type="text" class="txt" placeholder="Nombre*" name="contacto[nombre]">
            <input type="text" class="txt" placeholder="Correo Electrónico*"  name="contacto[correo]">
            <input type="text" class="txt" placeholder="Teléfono"  name="contacto[telefono]">
            <input type="text" class="txt" placeholder="Ciudad" name="contacto[ciudad]">
            <!--<input type="text" class="txt" placeholder="Empresa"  name="contacto[empresa]">-->
            <textarea class="txtarea" name="contacto[mensaje]" placeholder="Mensaje*"></textarea>
            <input type="submit" class="btnregistro fr" value="ENVIAR DATOS">                        
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
