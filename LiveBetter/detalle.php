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
    
    
    
    if(isset($_GET['id']) && is_numeric($_GET['id'])):
        
        $articulo = get_all_data_from('articulos', $_GET['id']);
        $color = get_all_data_from('categorias', $articulo['categoria_id']);
    
        $where = 'articulo_id = ' . $articulo['id'];        
        $comentarios = get_all_actived_inactived('comentarios', $where, 'fecha', 'DESC');
    else:
    
        redirect('index.php');
    
    endif;    
    
    
    $where = "elim = 0 AND autorizado = 1 AND categoria_id = ". $articulo['categoria_id'];        
    $relacionados = get_all_actived_inactived_paginado('articulos', $where, '3', 'RAND()');  

    
    $sql = " SELECT * FROM imagen";
    $imagen = get_one_sql($sql);     
    
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="es"> <!--<![endif]-->
<?php include("includes/metatags.php"); ?>
    
<body class="main" >
    <style type="text/css">
        .ponplay{
            position: relative;
            height: 0;
            width: 100%;
            top: -100px;
            
        }
        .ponplay #play{
                background: url(http://www.ziarulatac.ro/static/images/play_icon.png) no-repeat center;
                height: 290px;
                width: 100%;
                top: -190px;
                position: relative;
                background-size: 89px;
                cursor: pointer;
            }
        #video{
            height: 290px;
            width: 61%;
            margin: 0 auto;
        }
    </style>
    
        <a class="fancy" href="#gracias" id="graciasclick"></a>
        <div id="gracias" style="display:none;">
            <h2 style="font-family:'Lato',sans-serif; text-align: center">Gracias, tu opiniòn es muy valiosa para nosotros</h2>
        </div>


	<!--[if lt IE 7]>
            <p class="chromeframe">Tu navegador es <strong>Obsoleto</strong>. Por favor <a href="http://browsehappy.com/">actualizalo</a> ó <a href="http://www.google.com/chromeframe/?redirect=true">instala el componente Google Chrome Frame</a> para mejorar tu experiencia.</p>
    <![endif]-->
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&appId=274866469374216&version=v2.0";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    
    
    <div id="header">
        <div class="logo"><a href="index.php"><img src="img/logo.png" width="120px"></a></div>
        <!--<div class="title">Live Better</div>-->
    </div>
    <div id="headerdetalle" style="background-image:url(../admin/production/webroot/uploads/images/<?php echo $color['imagen']?>);">
    
    </div>
    
    <div id="content" 
         class="detalle cat1" 
         
         <?php if(isset($imagen['noticias_imagen']) && $imagen['noticias_imagen'] != ""): ?>
         style="background: url(<?php echo UP_IMG_PATH . $imagen['noticias_imagen'] ?>) no-repeat center center fixed;-webkit-background-size: cover;-moz-background-size: cover; -o-background-size: cover;background-size: cover;"
         <?php endif; ?>
    >
                
        
        <?php include("includes/header.php"); ?>
        

        <?php 
            
            if(isset($imagen['noticias_color']) && $imagen['noticias_color'] != ""):
                
            endif;           
            list($r, $g, $b) = sscanf($imagen['noticias_color'], "#%02x%02x%02x");                         

        ?>
        
        
        <div class="wrap" 
             
            <?php if(isset($imagen['noticias_color']) && $imagen['noticias_color'] != ""): ?>
             style="background-color: rgba(<?php echo $r ?>, <?php echo $g ?>, <?php echo $b ?>, 0.80);padding: 10px;"
             <?php endif; ?>
        >
            <div class="detail">
                <div class="info">
                    <div class="date"><?php echo date('d/m/Y', strtotime($articulo['fecha'])) ?></div>
                    <div class="title"><?php echo replace($articulo['titulo']); ?></div>
                    <div id="By">Escrito por:<span class="autor"> <?php echo replace($articulo['autor']); ?></span></div><br>
                    <div id="Tags">Tags: <span> <?php echo replace($articulo['palabras_clave']); ?></span></div>
                    <div id="Cmnts">(<?php echo count($comentarios) ?>) Comentarios</div>
                </div>
                
                <div class="pleca"></div>
                
                <div class="contents">
                    
                    
                    <!--Imagen-->
                    <?php if($articulo['imagen'] != ''): ?>
                        <div class="main-image round">
                            <img width="247px" src="<?php echo UP_IMG_PATH . $articulo['imagen'] ?>">
                        </div>
                    <?php endif; ?>
                    <!--Fin Imagen-->                                    
                    
                    
                    <!--Texto-->
                    <div class="text">                                   
                        <?php echo html_entity_decode($articulo['texto']); ?>                        
                    </div>
                    <!--Fin texto-->
                    
                    
                    <!--Video-->
                    <?php if($articulo['video'] != ''): ?>
                        <div id="video">
                             <img src="http://img.youtube.com/vi/<?php echo $articulo['video'] ?>/0.jpg" style="height: 290px;">
                            <div class="ponplay">
                                <div id="play"></div>
                            </div>     
                            
                        </div> 
                        <!--<a class="video fancy fancybox.iframe" href="<?php echo $articulo['video']; ?>"><img src="img/icon-video.png" width="40"> <?php echo $articulo['texto_video']; ?> </a>-->
                            <div class="various fancybox.iframe"  id="formvarious" style="display:none;">
                                <iframe width="800px" height="500px" src="//www.youtube.com/embed/<?php echo $articulo['video'] ?>?autoplay=0" frameborder="0" allowfullscreen></iframe>
                            </div>
                    <?php endif; ?>
                    <!--Fin Video-->
                    
                </div>
                
                
                <div class="social-share">
                    
                    <div class="facebook-like">
                        <div class="fb-like" data-href="http://tumedicolaguna.com/LiveBetter/detalle.php?id=<?php echo $articulo['id'] ?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
                    </div>
                    
                    <div class="tweet">
                        <a href="https://twitter.com/share" class="twitter-share-button" data-via="TuMedicolaguna" data-lang="es">Twittear</a>
                        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                    </div>
                    
                    <div class="sep"></div>
                    <div class="txt">COMPARTIR:</div>
                    
                        
                        <div class="twitter">
                            <a title="Twitter" target="_blank" href="http://twitter.com/intent/tweet/?url=http://tumedicolaguna.com/LiveBetter/detalle.php?id=<?php echo $articulo['id'] ?>">
                                <img src="img/icon-twitter-gris.png">
                            </a>
                        </div>
                    
                    
                    
                        <div class="facebook">
                            <!--<a title="Facebook" target="_blank" href="http://www.facebook.com/sharer.php?u=http://tumedicolaguna.com/LiveBetter/detalle.php?id=<?php echo $articulo['id'] ?>">-->                            
                            <a 
                                title="Facebook" 
                                target="_blank" 
                                href="http://www.facebook.com/sharer.php?s=100
                                        &p[title]='Live Better'
                                        &p[summary]='<?php echo replace($articulo['titulo']); ?>'
                                        &p[images][0]='http://tumedicolaguna.com/production/webroot/uploads/img/<?php echo $articulo['imagen'] ?>'
                                        &p[url]='http://tumedicolaguna.com/LiveBetter/detalle.php?id=<?php echo $articulo['id'] ?>'">                                                                
                                
                                <img src="img/icon-facebook-gris.png">
                            </a>
                        </div>
                    
                    
                        <!--<div class="instagram"><img src="img/icon-instagram-gris.png"></div>-->
                        <!--<div class="mail"><img src="img/icon-mail.png"></div>-->
                    
                    <!--<div class="sep"></div>-->
                    
<!--                    <div class="txt">IMPRIMIR</div>
                    <div class="print">
                        <a class="imprimir" href="#">
                            <img src="img/icon-print.png">
                        </a>
                    </div>-->
                    
                </div>
                
                
                <div class="secc-comments">
                    <div class="title">Comentarios :</div>
                    <div class="comments">
                        <ol>
                            
                            <?php foreach ($comentarios as $comentario): ?>
                            
                                <li>
                                    <div class="Name"><?php echo $comentario['nombre'] ?></div><div class="sep">&nbsp; - &nbsp;</div><div class="hora"><?php echo date('d/m/Y H:i:s', strtotime($comentario['fecha'])) ?></div>
                                    <div class="comment"><?php echo $comentario['comentario']; ?></div>
                                </li>

                            
                            <?php endforeach; ?>
                            

                        </ol>
                    </div>
                    <div class="formulario">
                        <div class="title">Deja un comentario</div>
                        
                        <form id="formComment" method="POST">
                            
                            <input type="hidden" value="<?php echo $articulo['id']; ?>" name="id">
                            
                            <label>Nombre (requerido)</label><br>
                            <input type="text" name="nombre" required=""><br>
                            
                            <label>Correo electrónico (requerido)</label><br>
                            <input type="email" name="email" required=""><br>
                            
                            <label>Comentario</label><br>
                            <textarea name="comentario" required=""></textarea><br>
                            
                            <input type="submit" value="Agregar comentario">
                            
                        </form>
                        
                    </div>
                </div>
                
                
                <div class="pleca"></div>
                <div class="relacionado">
                    
<!--                    <div class="arrows">
                        <div class="prev"></div>
                        <div class="next"></div>
                    </div>-->
                    
                    <div class="title">Notas relacionadas</div>
                    
                    <div class="grid">
                        
                        
                    <?php
                        foreach($relacionados as $relacionado):

                            foreach($relacionado as $key => $articulos): ?>

                            <?php                         
                                $categoria = get_all_data_from('categorias', $articulos['categoria_id']);
                            ?>

                                <a href="detalle.php?id=<?php echo $articulos['id'] ?>">

                                <div class="item" style="background-color: <?php echo $categoria['color']; ?>">
                                    
                                    <div class="title"><?php echo replace($articulos['titulo']); ?></div>

                                    <?php if($articulos['imagen'] != ''): ?>
                                        <div class="img round"><img width="132px" src="<?php echo UP_IMG_PATH . $articulos['imagen'] ?>"></div>
                                    <?php endif; ?>
                                                                            
                                    <div class="txt"><span><?php echo substr(html_entity_decode($articulos['texto']),0,80) . "..."; ?></span></div>                                                                

                                    <div class="date"> <?php echo date('d/m/Y', strtotime($articulos['fecha'])) ?></div>
                                    <div class="vermas">Leer mas</div>
                                
                                </div>

                                </a>


                            <?php endforeach;

                        endforeach;
                    ?>
                        
                    </div>
                </div>
                
                
            </div>
        </div>
    </div>
    

    <?php include("includes/footer.php"); ?>
        
        <?php if(isset($_POST['id'])): ?>
        <script>
            $(document).ready(function(){
                $('#graciasclick').click();

            });
        </script>
        <?php endif; ?>

        
        <script>

        $(document).on('ready', function() {

             $("#play").click(function() {                 
                 
                  $.fancybox({fitToView: false,autoSize: true,width: '800px',height: '500px',closeClick: false,
                      hideOnOverlayClick: true,openEffect: 'none',closeEffect: 'none',
                       onComplete: function () {
                                    $.fancybox.resize();
                                    $.fancybox.center();
                                },
                                href : "#formvarious",
                               afterClose : function(){ // it was onClosed for v1.3.4
                                $("#login_error").hide();
                               }
                              }); // fancybox
                 });


                $('.imprimir').click(function(){
                        window.print();
                        return false;
                }); 


        });    

        </script> 

</body>
</html>