    <div class="footer">
        <div class="wrapper">
            <div class="txt">
                <span>Algunos Derechos Reservados www.tumedicolaguna.com 2014</span><br>
                <span>Marca Registrada en tramite 2014</span><br>
                <span><a href="contacto.php">Contacto</a></span><br>
                <span><a href="terminos_condiciones.php" target="_blank">Terminos y condiciones</a></span><br>
                <span><a href="articulo.php">Sube tu artículo</a></span>
            </div>
            <div class="logo-ch"></div>
            <div class="clear"></div>

        </div>
    </div>
        
        
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
    <script type="text/javascript" src="js/jquery.fancybox.pack.js"></script>
    <script type="text/javascript" src="js/jquery.cycle2.min.js"></script>
    <script type="text/javascript" src="js/chosen.jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.pin.js"></script>
    <script type="text/javascript" src="js/bootstrap-3.1.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap-multiselect.js"></script>
    
    
    <script>
        $(document).ready(function() {
            $('.fancy').fancybox();
            
            $(".fancybox").fancybox({
                helpers : {
                    overlay : {
                        locked : false
                    }
                }
            });
	                    
            $("#promocion").click();  
            
            
            <?php if(empty($busqueda_resultados) && isset($_POST['buscar'])): ?>
                    
                $('#buscarclick').click();
                    
            <?php endif; ?>         
        
        
            <?php if(isset($_POST['registrar'])): ?>
                
                $('#enviarclick').click();
        
            <?php endif; ?>         
                
                
            //$("#categorias").chosen({placeholder_text_multiple: " "});
            $('#categorias').multiselect();

            $(".pineable .pinprev").pin({  containerSelector: ".wrap"});
            $(".pineable .pinnext").pin({  containerSelector: ".wrap"});
            
        })
    </script>
    

        

        