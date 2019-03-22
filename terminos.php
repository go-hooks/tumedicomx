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

    <h3>Términos y Condiciones</h3>
    <hr>

    <div>
        
        <p>Los presentes <b>“Términos y Condiciones”</b> describen detalladamente el funcionamiento de <b>“www.tumedicomx.com”</b> (en adelante el <b>"Portal”</b>), propiedad de <b>tumedicomx</b>, además de regular las relaciones entre <b>tumedicomx</b>, los <b>"Usuarios"</b> del <b>“Portal”</b> y <b>"Terceros"</b>.</p>
        
        <p>La información proporcionada en <b>www.tumedicomx.com</b> tiene el objeto de informar, no reemplazar, la relación que existe entre un paciente y/o <b>"Usuarios"</b> del <b>“Portal”</b> con el profesional de la salud o institución médica.</p>
        
        <p>La misión de este sitio web <b>www.tumedicomx.com</b>, es la creación y gestión de un directorio médico que incluya profesionales de la salud e instituciones médicas que permitan a los <b>“Usuarios”</b> de este sitio web acceder a información general y específica de aquellos profesionales e instituciones médicas (en adelante <b>"Clientes"</b>), tales como datos de contacto, fotografías, mapas de ubicación, descripción de servicios,  o cualquier otra información considerada oportuna por los <b>“Clientes”</b> y que <b>tumedicomx</b> considere ofrecer.</p>
        
        
        <h3>Capítulo 1 - Definición de Conceptos</h3>
        
        
        <p>Para efectos del presente apartado, las partes acuerdan que los conceptos que a continuación se describen y que se utilizan en el texto del presente, se entenderá de conformidad con las siguientes definiciones:</p>
        
        <p><b>Portal:</b> Se refiere al sitio web <b>www.tumedicomx.com</b> el cual ofrece al usuario ingresar al portal de manera gratuita, fácil y rápida para hacer uso de una serie de recursos  y de servicios relacionados a la salud además de tener acceso a  servicios de publicidad (aplican costos extras). </p>
                   
        <p><b>Usuarios:</b> Se refiere al <b>"Usuario", "Usuario Registrado"</b> y <b>"Usuario Premium"</b> del <b>"Portal"</b></p>
        
        <p><b>Usuario:</b> Es toda aquella persona física independientemente de su nacionalidad o país de residencia, siempre que haya aceptado expresamente los presentes <b>“Términos y Condiciones”</b>, quién tendrá acceso a toda la información con la que cuente el <b>“Portal”</b>.</p>

        <p><b>Usuario Registrado:</b> Es aquel profesional de la salud o aquella institución médica que desee registrarse en el <b>“Portal”</b> de manera gratuita; siempre que haya aceptado expresamente los presentes <b>“Términos y Condiciones”</b>, quién tendrá acceso al <b>“Portal”</b> y  podrá registrar información general de contacto tal como nombre, especialidad, dirección, teléfonos, tipo de tarjetas bancarias de convenio y aseguradoras de convenio; para poder registrarse deberá de proporcionar a <b>“tumedicomx”</b> los siguientes datos requeridos para su validación: Nombre, Apellido, Representante Legal (en caso de ser institución médica), dirección(calle, número, código postal, colonia, municipio, estado),  correo electrónico, <b>“Contraseña”</b>, cédula profesional y teléfono; así mismo el <b>“Usuario Registrado”</b> podrá registrar en el <b>“Portal”</b> información opcional tal como: número celular, fax y radio. Esta información exceptuando la cédula profesional puede ser modificada o actualizada en cualquier momento cuantas veces lo considere el <b>“Usuario Registrado”</b></p>
        
        <p><b>Usuario Premium:</b> Es aquel profesional de la salud o aquella institución médica que desee registrarse en el <b>“Portal” </b> cubriendo el costo de un contrato de servicios por tiempo definido para tener derecho a un <b>“Mini Sitio” </b> bajo el dominio de <b> “www.tumedicomx.com” </b>, podrá registrar información general de contacto tal como nombre, especialidad, dirección, teléfono, tipo de tarjetas bancarias de convenio y aseguradoras de convenio; para el <b> “Mini Sitio” </b>, el <b> “Usuario Premium” </b> podrá registrar la siguiente información para ser validada por <b>"tumedicomx"</b> para después ser mostrada en el “Portal” </b>: Descripción de servicios,  ubicación por medio de Google Maps™.  Para completar el registro deberá de proporcionar a “<b>tumedicomx” </b> los siguientes datos requeridos para su validación: Nombre, Apellido, Representante Legal (en caso de ser institución médica), dirección (calle, número, código postal, colonia, municipio, estado),  correo electrónico, <b>“Contraseña” </b>, cédula profesional y teléfono; así mismo el <b> “Usuario Registrado” </b> podrá registrar en el <b>“Portal” </b> información opcional tal como: número de celular, fax y radio. Esta información exceptuando la cédula profesional puede ser modificada o actualizada en cualquier momento cuantas veces lo considere el <b> “Usuario Premium” </b></p>
        
        <p><b>Terceros:</b> Son aquellas personas o instituciones legalmente inscritas a la SHCP (Secretaría de Hacienda y Crédito Público) o a un organismo que regule sus actividades comerciales y fiscales dentro de su país de registro que tienen relación directa o indirecta con <b>tumedicomx</b>, donde sus contenidos pueden aparecer dentro del <b>"Portal"</b> de manera informativa o que desean solicitar <b>"Servicios"</b>  dentro del <b> “Portal” </b>.</p>
        
        <p><b>Servicios:</b> Se refiere al conjunto de servicios comerciales y/o informativos disponibles para los <b>"Usuarios"</b> y <b>"Terceros"</b> dentro del <b>"Portal"</b>. </p>
        
        <p><b>Contrato de Servicios:</b> Es aquel documento que regula las características y condiciones de un servicio comercial solicitado por los <b>"Usuarios"</b> y/o <b>"Terceros"</b>.</p>
        
        <p><b>Datos Personales:</b> Es la información personal y/o institucional de contacto recaudada a los <b>"Usuarios"</b> y <b>"Terceros"</b> con el fin de validar la autenticidad de los mismos.</p>
        
        <p><b>Nombre de Usuario:</b> Es el nombre con el que se identifican las cuentas tanto del <b>"Usuario Registrado"</b> como del <b>"Usuario Premium"</b>, en este caso será la dirección de correo electrónico registrado.</p>
        
        <p><b>Contraseña:</b> Una contraseña es una forma de autentificación que utiliza información secreta para controlar el acceso a la información del <b>"Usuario Registrado"</b> como del <b>"Usuario Premium"</b>.</p>
        
        <p><b>Empresa prestadora de servicios:</b> tumedicomx.com</p>
        
        <p><b>Las Partes:</b> Se refiere a la relación entre los <b>"Usuarios"</b>, <b>"Terceros"</b> y <b>tumedicomx.com</b></p>
        
        <hr>
        
        <h3>Capítulo 2 - Condiciones generales | Aceptación</h3>
                
        <p>Las condiciones generales  (en adelante, las <b>"Condiciones Generales"</b>) regulan el uso del servicio del Portal <b>"tumedicomx.com"</b>  de Internet (en adelante, el <b>"Portal"</b>).</p>
        
            <h4><u>Objeto</u></h4>
       
                <p>A través de <b>"www.tumedicomx.com"</b>,  <b>tumedicomx</b> facilita a los <b>"Usuarios" y "Terceros"</b> el acceso y la utilización de  servicios y contenidos puestos a disposición.</p>

                <p><b>tumedicomx</b> se reserva el derecho a modificar unilateralmente, en cualquier momento y sin aviso previo, la presentación y configuración del <b>"Portal"</b>, así como también se reserva el derecho a modificar o eliminar, en cualquier momento y sin previo aviso, los <b>"Servicios"</b> y las condiciones requeridas para acceder y/o utilizar el <b>"Portal"</b> y sus <b>"Servicios"</b>.</p>
                
            <h4><u>Condiciones de acceso y utilización del Portal</u></h4>
            
                <p>El carácter de acceso y utilización del <b>"Portal"</b> es gratuito. La prestación del servicio del <b>"Portal"</b> por parte de <b>tumedicomx</b> tiene carácter gratuito para el <b>“Usuario” y “Usuario Registrado”</b>.</p>

                <p>Para obtener la calidad de <b>"Usuario Premium"</b> es necesario cumplir con todos los requisitos mencionados en el <b>capítulo 1</b>.</p>
            
            <h4><b><u>Obligación de hacer un uso correcto del Portal y de los Servicios</u></b></h4>           
            
                <p>El <b>“Usuario”,  “Usuario Registrado",  “Usuario Premium” y "Terceros"</b> se comprometen a utilizar el <b>"Portal"</b> y los <b>"Servicios"</b> de manera conforme a la ley, y a lo dispuesto en estas <b>"Condiciones Generales"</b>, la moral y buenas costumbres generalmente aceptadas y el orden público. Se obligan a abstenerse de utilizar el <b>"Portal"</b> y los <b>"Servicios"</b> con fines o efectos ilícitos, contrarios a lo establecido por el presente, lesivos de los derechos e intereses de <b>"Terceros"</b>, o que de cualquier forma puedan dañar, inutilizar, sobrecargar o deteriorar el <b>"Portal"</b> y los <b>"Servicios"</b> o impedir la normal utilización y disfrute por parte de los <b>"Usuarios"</b> y/o <b>"Terceros"</b>. </p>                                
        
            <h4><u>Uso de la contraseña</u></h4>          
                    
                <p>Una vez que se valida y aprueba  la autenticidad de la información que el profesional ó institución médica proporciona al <b>"Portal"</b> para realizar su registro gratuito, <b>tumedicomx</b> envía un correo de confirmación al correo registrado por parte del <b>"Usuario"</b>, convirtiéndose de esta manera en <b>"Usuario Registrado"</b>.</p>    
        
                <p>Por otra parte para completar el registro del <b>"Usuario Premium"</b>, es necesario, que <b>tumedicomx</b>, valide y apruebe  la autenticidad de la información proporcionada por el profesional ó institución médica, y además se cubra el pago de un <b>"Contrato de Servicios"</b> por tiempo definido. <b>tumedicomx</b> envía un correo de confirmación al correo registrado por parte del <b>"Usuario"</b>, convirtiéndose de esta manera en <b>"Usuario Premium"</b>.</p>

                <p>Los <b> “Usuarios Registrados” </b> y <b> “Usuarios Premium” </b> se comprometen a hacer un uso diligente y a mantener en secreto la <b>"Contraseña"</b> y el <b>"Nombre de Usuario” </b> proporcionados a <b>tumedicomx</b> para acceder al <b>"Portal"</b> y a los <b>"Servicios"</b>. Los <b> “Usuarios Registrados” y “Usuarios Premium” </b> responderán de los gastos, daños y/o perjuicios ocasionados por la utilización de los <b>"Servicios"</b> de <b>"Terceros"</b>, que emplee al efecto, su <b>"Contraseña"</b> y <b>"Nombre de Usuario" </b>mediante un uso no diligente o a la pérdida de los mismos por el usuario. <b>tumedicomx </b>queda exonerado de toda responsabilidad que pudiera derivarse del uso indebido o negligente de las contraseñas asignadas para acceder al <b>"Portal"</b>.</p>

        <hr>
        
        <h3>Capítulo 3</h3>
        
        <h4><u>Datos de carácter personal</u></h4>
        
        <p>Para acceder y/o utilizar algunos de los <b>"Servicios"</b> es necesario que los <b>“Usuarios Registrados” y “Usuarios Premium”</b> proporcionen previamente a <b>tumedicomx</b> ciertos datos de carácter personal (capitulo 2) que tratará e incorporará a bases de datos automatizadas, que en su caso estarán registradas o dado de alta ante la autoridad competente, con las finalidades que en cada caso correspondan. Todas estas circunstancias serán previas y debidamente advertidas por <b>tumedicomx</b> a los <b>“Usuarios Registrados” y “Usuarios Premium”</b>, en los casos y en la forma en que ello resulta legalmente exigible. <b>tumedicomx.com</b> garantiza que ha adoptado las medidas oportunas de seguridad en sus instalaciones, sistemas y ficheros. tumedicomx garantiza la confidencialidad de los <b>"Datos Personales"</b>. No obstante,  podrá revelar a las autoridades públicas competentes estos <b>"Datos Personales"</b> y cualquier otra información que esté en su poder o sea accesible a través de sus sistemas y que sea requerida de conformidad con las disposiciones legales y reglamentarias aplicables al caso.</p>

        <p>Los <b>“Usuarios Registrados” y “Usuarios Premium”</b>   podrán ejercitar los derechos de acceso, cancelación, rectificación y oposición contactando con <b>tumedicomx</b> a través de la sección de contacto o enviando un correo electrónico a la siguiente dirección: <a href="mailto:contacto@tumedicomx.com">contacto@tumedicomx.com</a> </p>

        <p>Los <b>“Usuarios Registrados” y “Usuarios Premium”</b> garantizan y responden, en cualquier caso, de la veracidad, exactitud, vigencia y autenticidad de los <b>"Datos Personales"</b> facilitados, y se comprometen a mantenerlos debidamente actualizados. </p>
        
        <hr>
        
        <h3>Capítulo 4</h3>
        
        <h4><u>Política de Privacidad</u></h4>        
        
        <p><b>tumedicomx</b> se compromete a respetar la confidencialidad de los datos personales de los <b>“Usuarios Registrados” y “Usuarios Premium”</b>. Para más información, favor de remitirse al capítulo 2 de estos <b>"Términos y Condiciones"</b> donde podrá saber sistema de recolección de  los <b>"Datos Personales"</b> y el uso que les damos.</p>

        <h4><u>Contenidos</u></h4> 
        
            <div align="center"><li><b>Propios</b></li></div> 
            
            <p><b>tumedicomx</b> ofrece sus contenidos como <b>"Servicios"</b> a los <b>“Usuarios” y "Terceros"</b>,  por lo tanto deberán ser usados con carácter informativo y/o comercial sea el caso; <b>tumedicomx</b> no tiene responsabilidad en los errores u omisiones de estos materiales. Tampoco garantiza, explícita o implícitamente, los contenidos del <b>"Portal"</b>, incluyendo, pero no limitando a la exactitud o confiabilidad de los textos, gráficos, enlaces y otros elementos accesibles en su servidor de Internet.</p>
            
            <div align="center"><li><b>De terceros</b></li></div> 
        
            <p><b>tumedicomx</b> advierte que al no ser de su titularidad toda la información contenida en el <b>"Portal"</b>, algunos de los textos, gráficos,  vínculos y/o el contenido de algunos artículos incluidos en el mismo, podrían no ser veraces o no estar actualizados; asimismo tampoco garantiza el cumplimiento de las normas vigentes en relación con dichos contenidos. <b>tumedicomx</b> no será responsable por el cumplimiento con la legislación vigente en materia de propiedad intelectual o veracidad y exactitud de los contenidos ofrecidos a través del <b>"Portal"</b> o que de algún modo estén vinculados al <b>"Portal"</b> y que sean provistos por <b>"Terceros"</b>. Asimismo, <b>tumedicomx</b> no puede controlar o editar los contenidos provistos por <b>"Terceros"</b> antes de ser publicados, como tampoco puede asegurar la remoción del material inapropiado luego de su publicación. Las publicaciones de <b>"Terceros"</b>  no representan la opinión, creencia o intención de tumedicomx. Las imágenes y/o contenidos propiedad de <b>"Terceros"</b> que <b>tumedicomx</b> pudiera mostrar dentro del <b>"Portal"</b> son de carácter informativo y no tienen fines lucrativos.</p>

            <div align="center"><li><b>Uso del Portal</b></li></div>         
        
            <p>Este <b>"Portal"</b> (o cualquier porción de este <b>Portal</b>) no puede ser reproducido, duplicado, copiado, vendido, revendido o explotado con otros fines distintos de aquellos expresamente permitidos por <b>tumedicomx</b>. Tanto el acceso al Portal, así como el uso que pueda hacerse de la información contenida en el mismo son exclusiva responsabilidad de quien los realiza. <b>tumedicomx</b> no responderá por los daños y perjuicios, ya sean directos o indirectos, derivados del mal funcionamiento de los <b>"Servicios"</b> ofrecidos en el <b>"Portal"</b> que se basen en causas, de cualquier naturaleza, ajenas a su voluntad y/o su control.</p>
        
            <div align="center"><li><b>Duración y terminación</b></li></div>        
            
            <p>La prestación del servicio de <b>"Portal"</b> y de los demás <b>"Servicios"</b> tienen una duración indefinida, <b>tumedicomx</b>, no obstante, está facultado para dar por terminada, suspender o interrumpir unilateralmente, en cualquier momento y sin necesidad de previo aviso, la prestación del servicio del <b>"Portal"</b> y/o de cualquiera de los <b>"Servicios"</b>, sin perjuicio de lo que se hubiere dispuesto al respecto en las correspondientes Condiciones.</p>            
        
            <div align="center"><li><b>Competencia</b></li></div>             
        
            <p><b>"Las Partes"</b> estarán regidas por la Ley Federal de Protección al Consumidor, de los Estados Unidos Mexicanos y cualquier controversia que se derive de la aplicación de la misma se ventilará ante las autoridades y los tribunales de la Ciudad de  Torreón, Coahuila México., renunciando expresamente a cualquier otra jurisdicción que les pudiera corresponder por razón de su domicilio presente o futuro. Nos reservamos el derecho de hacer cambios a nuestra página y/o exclusiones, términos y condiciones en cualquier tiempo.</p>            
        
            <div align="center"><li><b>Responsabilidad</b></li></div>        
        
        <p>tumedicomx.com <b>NO SE RESPONSABILIZA BAJO NINGUNA CIRCUNSTANCIA POR LA INTERPRETACIÓN Y/O POR LA INCORRECTA INTERPRETACIÓN DE LO EXPRESADO EN EL PORTAL, EN LAS CONSULTAS REALIZADAS, NI DE SU USO INDEBIDO, ASÍ COMO TAMPOCO SERÁ RESPONSABLE POR LOS PERJUICIOS DIRECTOS O INDIRECTOS CAUSADOS POR O A QUIENES FUERAN INDUCIDOS A TOMAR U OMITIR DECISIONES O MEDIDAS AL CONSULTAR EL PORTAL</b></p>            
         
        <p><b>“Las Partes"</b> acuerdan defender e indemnizar a <b>tumedicomx</b>, sus proveedores de información, sus subsidiarias y a todos sus directores, empleados, representantes, agentes, miembros, abogados y exonerarlos de cualquier o todos los reclamos, demandas, daños, perjuicios, responsabilidades, pérdidas, costos y gastos (incluyendo honorarios de los letrados legales y las costas del litigio) derivadas del uso que usted realice en el <b>"Portal"</b> o con cualquier información, producto, servicio, documentación o software disponible en mismo así como de cualquier violación o actos impropios que usted realice a los <b>"Términos y Condiciones"</b>.  </p> 

        <p>Si usted no acepta estos <b>Términos y Condiciones</b> o tiene alguna pregunta sobre los mismos, por favor contáctese con nosotros.</p>
         
        <p><a href="mailto:contacto@tumedicomx.com">contacto@tumedicomx.com</a></p>
                
    </div>

    <div class="clear2"></div>

</section>

<?php include('includes/footer.php'); ?>


<!-- JQUERY -->
<script src="js/vendor/jquery.cycle2.min.js"></script>
<script src="js/vendor/jquery.cycle2.carousel.min.js"></script>

<!-- LUCKY ORANGE -->
<script type='text/javascript'>
window.__lo_site_id = 147239;

	(function() {
		var wa = document.createElement('script'); wa.type = 'text/javascript'; wa.async = true;
		wa.src = 'https://d10lpsik1i8c69.cloudfront.net/w.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(wa, s);
	  })();
</script>

<!-- SELECTIVIZR -->
<!--[if (gte IE 6)&(lte IE 8)]>
    <script src="js/polyfills/selectivizr-min.js"></script>
<![endif]-->
</body>
</html>
