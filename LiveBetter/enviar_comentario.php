<?php 

require_once("ini.php"); 

    $where = "mostrar = 1 AND elim = 0";
    $categorias = get_all_actived_inactived('categorias', $where, 'nombre');       
    
    $_POST = security_removeXss($_POST);
    
    if(isset($_POST['id']))
    {
        
        $valores = array();
        $valores['articulo_id'] = $_POST['id'];
        $valores['fecha'] = date('Y-m-d H:i:s');
        $valores['nombre'] = $_POST['nombre'];
        $valores['email'] = $_POST['email'];
        $valores['comentario'] = $_POST['comentario'];
        
        $id = db_insertar('comentarios',$valores);
        
    }
    

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="es"> <!--<![endif]-->

    <?php include("includes/metatags.php"); ?>
    
    
    <?php 
            $fondo = "img/bg-index.jpg";        
    ?>   
    
<body class="aviso" style="background-image: url(<?php echo $fondo ?>);background-repeat: no-repeat;background-size: cover">
	<!--[if lt IE 7]>
            <p class="chromeframe">Tu navegador es <strong>Obsoleto</strong>. Por favor <a href="http://browsehappy.com/">actualizalo</a> ó <a href="http://www.google.com/chromeframe/?redirect=true">instala el componente Google Chrome Frame</a> para mejorar tu experiencia.</p>
    <![endif]-->
    <div id="header">
        <div class="logo"><a href="./"><img src="img/logo.png"></a></div>
        <div class="title">Live Better</div>
    </div>
                
    <div id="content" class="aviso">
        
        
        <?php include("includes/header.php"); ?>  
        
        
        <div class="wrap">
            <div class="title">Gracias por su comentario</div>
            <div class="pleca"></div>
        </div>
        
        
    </div>
        

        
    <?php include("includes/footer.php"); ?>
        
</body>
</html>