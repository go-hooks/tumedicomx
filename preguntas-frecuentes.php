<?php
    session_start();
    session_name('medico_laguna');

    $ubicacion='inicio';
        
    require_once(dirname(__FILE__) . "/ini.php");    
    include('includes/metatags.php'); 

?>

<title>Tu Medico Laguna</title>
</head>
<body id="faqs">

<?php include('includes/header.php'); ?>
<section class="wrapper">

    <?php include('includes/search.php'); ?>

    <h3>Preguntas Frecuentes</h3>
    <hr>

    <div>
        <h3>1.	¿Qué es tumedicomx.com?</h3>
        <p>Es un directorio médico online que tiene como objetivo ser el primer contacto para todas aquellas personas que buscan servicios relacionados con la salud, tales como profesionales e instituciones médicas, clínicas, laboratorios, proveedores, etc.</p>
    
        <h3>2.	¿Qué clase de información se puede encontrar en tumedicomx.com?</h3>
        <p>En Tu Médico MX podrás encontrar información de Instituciones Médicas como Clínicas, Hospitales, Laboratorios, Farmacias, Profesionales Médicos, Especialistas en Medicina Alternativa, Aseguradoras, Proveedores de Equipo y Mobiliario Médico, Restaurantes de alimentos saludables, Gimnasios, Spas, etc.</p>
    
        <h3>3.	¿Cuál es la diferencia entre usuario registrado y el usuario Premium?</h3>
        <p>El registro gratuito muestra la información de contacto del profesional o institución médica de manera general, nombre, dirección, teléfono, horario, formas de pago para el cliente y aseguradoras de convenio; el registro Premium es una membresía por tiempo limitado donde el usuario Premium tiene derecho a un Mini Sitio dentro del dominio de tumedicolaguna, donde además de mostrar sus datos de contacto, puede describir sus servicios, agregar un logotipo, solicitar un banner publicitario dentro del mismo y tener una sección de contacto donde los usuarios pueden ponerse en contacto con el profesional o institución para realizar citas o pedir información sobre sus servicios; esta suscripción maneja los siguientes costos: Suscripción por 1 año $ 999 + IVA, Suscripción por  2 años $ 1499 + IVA y Suscripción por 3 años $ 1799 + IVA.</p>
        <p>Aplican costos extras.</p>
    
        <h3>4.	¿Si soy usuario Registrado o Premium que pasa si olvido mi contraseña?</h3>
        <p>En caso de olvidar la contraseña puedes recuperarla dirigiéndose a la sección de "Recuperar contraseña" en la parte inferior de la Página inicio, la cual lo redireccionará a una pantalla donde tendrás que indicar el correo electrónico registrado, al cual llegará una link para reestablecer y/o definir la nueva contraseña.</p>
        
        <h3>5.	¿Cómo actualizo mis datos?</h3>
        <p>Para actualizar los datos ya sea si eres usuario Premium o usuario Registrado, tienes que ingresar al sistema utilizando tus credenciales válidas y dirigirte  a la sección de "Mi Perfil" para Usuario Registrado y en “Mi Mini Sitio” para Usuario Premium.</p>
        
        <h3>6.	¿Quiénes pueden ver mis datos?</h3>
        <p>Todas las personas que ingresen al portal tendrán, sin ningún costo, acceso a la información de los profesionales e instituciones médicas.</p>
    
        <h3>7.	¿Cómo adquiero un banner?</h3>
        <p>Para generar una solicitud de un banner publicitario, tienes que dar clicen la opción de "Anúnciate con Nosotros", donde te mostraremos las opciones e información de costos; una vez que estés seguros de generar una solicitud, tienes que dar clic en el botón COMPRAR y el sistema te redireccionará a un formulario de contacto que tendrás que llenar para completar el proceso de solicitud, una vez enviada, un agente de ventas se pondrá en contacto contigo a la brevedad.O puedes simplemente enviarnos un correo a <b><a href="mailto:ventas@tumedicolaguna.com">ventas@tumedicomx.com</a></b></p>
        
        <h3>8.	¿Qué es un Mini Sitio?</h3>
        <p>Es una página web en la que se ofrece información específica de un producto, de varios productos o de servicios. Se pueden incluir texto, animaciones y/o gráficos. En nuestros Mini Sitio podrás describir tus servicios detalladamente, costos de consulta, horarios, formas de pago para los clientes, ubicación, proporcionar un logotipo ó fotografía, y la opción donde tus clientes puedan realizar citas o pedir información de tus servicios.</p>
        
        <h3>9.	¿Cómo puedo realizar una cita con el especialista o solicitar información a una institución?</h3>
        <p>Únicamente se puede realizar cita o solicitar información a través del portal cuando elprofesional o institución médica cuenta con Mini Sitio y lo hará ingresando a su Mini Sitio y dirigiéndote a la sección de “Envía un Mensaje”.</p>
        
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
