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
    
<body class="noticia">
	<!--[if lt IE 7]>
            <p class="chromeframe">Tu navegador es <strong>Obsoleto</strong>. Por favor <a href="http://browsehappy.com/">actualizalo</a> ó <a href="http://www.google.com/chromeframe/?redirect=true">instala el componente Google Chrome Frame</a> para mejorar tu experiencia.</p>
    <![endif]-->
    <div id="header">
        <div class="logo"><a href="index.php"><img src="img/logo.png" width="120px"></a></div>
        <!--<div class="title">Live Better</div>-->
    </div>
        
    <div 
        id="content" 
        class="noticia"                 

        <?php if(isset($imagen['home_imagen']) && $imagen['home_imagen'] != ""): ?>
        style="background: url(<?php echo UP_IMG_PATH . $imagen['home_imagen'] ?>) no-repeat center center fixed;-webkit-background-size: cover;-moz-background-size: cover; -o-background-size: cover;background-size: cover;"
        <?php endif; ?>         
        
    >
        
        
        <?php include("includes/header.php"); ?>
        
        
        <?php             
            if(isset($imagen['home_color']) && $imagen['home_color'] != ""):
                
            endif;           
            list($r, $g, $b) = sscanf($imagen['home_color'], "#%02x%02x%02x");                     
        ?>
        
        
        <div class="wrap" style="background-color: rgba(<?php echo $r ?>, <?php echo $g ?>, <?php echo $b ?>, 0.80);padding: 10px;">
            <div class="title">SUBE TU ARTÍCULO</div>
            <div class="pleca"></div>
            <div class="formulario">
                
                <form id="formContacto" method="POST" action="enviar_articulo.php" enctype="multipart/form-data" name="registro">
                    
                    <input type="text" name="registro[autor]" placeholder="Autor" required=""><br>
                    
                    <input type="email" name="registro[correo]" placeholder="Correo" required=""><br>
                    
                    <input type="text" name="registro[titulo]" placeholder="Titulo" required=""><br>
                    
                    <input type="text" name="registro[palabras_clave]" placeholder="Palabras clave" required=""><br>
                                        
                    Categoria: 
                    <select id="categorias" name="registro[categoria_id]" class="cats" required="">
                        
                        <?php foreach ($categorias as $categoria): ?>
                        
                            <option value="<?php echo $categoria['id'] ?>"><?php echo replace($categoria['nombre']); ?></option>
                        
                        <?php endforeach; ?>
                        
                    </select>
                    
                    <textarea name="registro[texto]" placeholder="Contenido" required=""></textarea><br>
                    
                    Imagen: <input type="file" name="Imagen"><br>
                    
                    <input type="text" name="registro[texto_video]" placeholder="Texto del Video"><br>
                    
                    <input type="text" name="registro[video]" placeholder="Video"><br>
                    
                    <input type="submit" value="ENVIAR">
                </form>
                
                
            </div>
        </div>
    </div>

    <?php include("includes/footer.php"); ?>
        
</body>
</html>