<?php
    session_start();
    session_name('medico_laguna');

    $ubicacion='inicio';
    
    require_once(dirname(__FILE__) . "/ini.php");    
    include('includes/metatags.php'); 

?>

<title>Tu Medico Laguna</title>
</head>
<body id="aviso">

<?php include('includes/header.php'); ?>
<section class="wrapper">

    <?php include('includes/search.php'); ?>

    <h3>Aviso de Privacidad</h3>
    <hr>

    <div>
        <p>
            <b>Tu Médico MX</b> se compromete a respetar la confidencialidad de los datos personales de los <b>“Usuarios Registrados”, “Usuarios Premium” y “Terceros”</b>. Para más información consulte todos los términos entre comillas (“”) en el <b> capítulo 2</b> de los <b> Términos y Condiciones</b> donde podrá conocer la definición de estos términos.
        </p>
        <p>
            <b>Tu Médico MX</b> en lo subsecuente el <b>"Portal"</b>, es responsable del tratamiento de sus <b>Datos personales y Datos de Contacto e Informativos</b>. Para tales efectos,  a continuación se definen los <b>Datos Personales y Datos de Contacto e Informativos</b> que serán sometidos a su tratamiento:
        </p>
        <p>
            <b>Datos Personales:</b> Nombre completo, apellidos y cédula profesional.
        </p>
        <p>
            <b>Datos de Contacto e Informativos:</b> Nombre o razón social, Especialidad, Domicilio, Código postal, Número telefónico, Número de Celular, Fax, Correo electrónico, Logotipo, información de Aseguradoras de Convenio y Tarjetas Bancarias de Convenio.
        </p>
        <p>
            Se le informa al <b>“Usuario Registrado”</b> y el <b>“Usuario Premium”</b>,que sus <b>Datos Personales y Datos de Contacto e Informativos</b> serán utilizados exclusivamente para promover su actividad profesional y el lugar en donde presta sus servicios y que son datos públicos en diferentes medios de publicidad y sobre la  Red de Internet y <b>Tu Médico MX</b> no se hace responsable por el uso o mal uso que <b>“Terceros”</b> puedan realizar.Debido a la distribución y trato de nuestros servicios, sus <b>Datos Personales y Datos de Contacto e Informativos</b> pueden ser transferidos a nuestros Socios, Distribuidores y/o Proveedores con fines de actualización, soporte y mejora de nuestros servicios, considerando estos actos como Remisión de la información en los términos de la Fracción IX del Artículo 2do. del Reglamento de la Ley Federal de Protección de Datos Personales en Posesión de los Particulares, siendo aplicable lo dispuesto por los Artículos 10 Fracción IV y 37 Fracciones IV y VII de la Ley y el Artículo 53 del Reglamento.
        </p>
        <p>
            Se informa al <b>“Usuario Premium”</b> que por medio <b>"Mini Sitio"</b> dentro del <b>“Portal”</b> serán publicados los datos que el <b>“Usuario Premium”</b> quiera dar a conocer y que serán administrados por ellos mismos, pudiendo además modificarlos a su entera satisfacción.
        </p>
        <p>
            El <b>“Usuario Registrado”</b> y <b>“Usuario Premium”</b> tienen derecho de ingresar, editar, actualizar y cancelar sus <b>Datos Personales y Datos de Contacto e Informativos</b>, así como de oponerse al tratamiento de los mismos para aquellos usos y/o finalidades que no consideren necesarias; sólo envíe una solicitud a través de un correo electrónico a la dirección  <a href="mailto:contacto@tumedicolaguna.com">contacto@tumedicolaguna.com</a> donde lo atenderemos y daremos seguimiento aesta solicitud conforme a la Ley.
        </p>
        <p>
            Toda solicitud de trato de datos personales está sujeta al consentimiento del <b>“Usuario Registrado” y “Usuario Premium”</b>, salvo las excepciones establecidas en la Ley de la materia y su reglamento. Advertimos que de conformidad con el Artículo 8vo. de la Ley Federal de Protección de Datos Personales en Posesión de los Particulares, el <b>“Usuario Registrado” y “Usuario Premium”</b> consienten tácitamente el tratamiento de sus <b>Datos Personales y Datos de Contacto e Informativos</b>, si no manifiesta su oposición.
        </p>
        <p>
            Se le informa al <b>“Usuario Registrado” y “Usuario Premium”</b>,titulares de los <b>Datos Personales y Datos de Contacto e Informativos</b> sobre el derecho para acudir al Instituto Federal de Acceso a la Información y Protección de Datos en caso de considerar que su derecho a la protección de datos personales ha sido vulnerado.
        </p>
    

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
