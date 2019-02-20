<?php 

require_once("ini.php"); 

    $where = "mostrar = 1 AND elim = 0";
    $categorias = get_all_actived_inactived('categorias', $where, 'nombre');        

    $sql = " SELECT * FROM imagen";
    $imagen = get_one_sql($sql);     
    
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="es"> <!--<![endif]-->

    <?php include("includes/metatags.php"); ?>

    
<body 
    class="contacto" 
    
         <?php if(isset($imagen['contacto_imagen']) && $imagen['contacto_imagen'] != ""): ?>
         style="background: url(<?php echo UP_IMG_PATH . $imagen['contacto_imagen'] ?>) no-repeat center center fixed;-webkit-background-size: cover;-moz-background-size: cover; -o-background-size: cover;background-size: cover;"
         <?php endif; ?>             
>
    
        <a class="fancy" href="#mensaje" id="mensajeclick"></a>
        <div id="mensaje" style="display:none;">
            <h2 style="font-family:'Lato',sans-serif; text-align: justify">Gracias por contactarnos</h2>
        </div>
        
        
	<!--[if lt IE 7]>
            <p class="chromeframe">Tu navegador es <strong>Obsoleto</strong>. Por favor <a href="http://browsehappy.com/">actualizalo</a> ó <a href="http://www.google.com/chromeframe/?redirect=true">instala el componente Google Chrome Frame</a> para mejorar tu experiencia.</p>
    <![endif]-->
    <div id="header">
        <div class="logo"><a href="index.php"><img src="img/logo.png" width="120px"></a></div>
        <!--<div class="title">Live Better</div>-->
    </div>
        <div id="content" class="contacto">
        
            
        <?php include("includes/header.php"); ?>            
                
            
        <?php 
            
            if(isset($imagen['contacto_color']) && $imagen['contacto_color'] != ""):
                
            endif;           
            list($r, $g, $b) = sscanf($imagen['contacto_color'], "#%02x%02x%02x");                              

        ?>
            
        
        <div class="wrap" style="background-color: rgba(<?php echo $r ?>, <?php echo $g ?>, <?php echo $b ?>, 0.80);padding: 10px;">
            <div class="title">ENVÍANOS UN MENSAJE</div>
            <div class="pleca"></div>
            <div class="formulario">
                <form id="formContacto" method="POST" action="envia_contacto.php" name="contacto">
                    <input type="text" name="contacto[nombre]" placeholder="Nombre" required=""><br>
                    <input type="email" name="contacto[correo]" placeholder="Email" required=""><br>
                    <textarea name="contacto[mensaje]" placeholder="Mensaje" required=""></textarea><br>
                    <input type="submit" value="ENVIAR">
                </form>
            </div>
        </div>
            
            
    </div>
                        
    <?php include("includes/footer.php"); ?>
    
        <?php if(isset($_GET['exito'])): ?>
        <script>
            $(document).ready(function(){
                $('#mensajeclick').click();

            });
        </script>
        <?php endif; ?>        
    
</body>
</html>