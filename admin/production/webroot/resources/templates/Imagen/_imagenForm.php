<div class="row">
    <form enctype="multipart/form-data" class="form-horizontal" role="form" action="<?php echo url_format('imagen/aplicar') ?>" method="post">
        <div class="col-sm-6">
            
            <!--IMAGEN-->            
            <div class="panel panel-default">

                <div class="panel-heading">
                    <div class="panel-title">
                        <?php if (!isset($imagen['id'])): ?>
                            Nueva imagen
                        <?php else: ?>
                            Edición de la imagen
                        <?php endif; ?>
                    </div>
                </div>


                
                <div class="panel-body">
                    
                    
                    <?php if (isset($imagen['id'])): ?>
                        <input type="hidden" name="id" value="<?php echo $imagen['id'] ?>">
                    <?php endif; ?>                                               
                        
                    <?php if (isset($imagen['imagen'])): ?>
                        <input type="hidden" name="imagen" value="<?php echo $imagen['imagen'] ?>">
                    <?php endif; ?> 

                        
                    <div class="form-group">  
                        <div class="col-sm-3">
                                                        
                            <?php if (!empty($imagen['imagen'])): ?>
                                <img src="<?php echo URL_APP . "uploads/images/" . $imagen['imagen'] ?>"  class="img-responsive img-thumbnail" width="100%"/>
                            <?php endif; ?>
                                
                        </div>
                    </div>
                        
                        
                    <div class="form-group">  
                        <div class="col-sm-8">
                            <label class="control-label">Subir Imagen*</label>
                            <input type="file" name="imagen" id="imagen" />
                        </div>

                    </div>                        
                        
                        
                    <div class="form-group">
                        <label for="url" class="col-sm-2 control-label">URL*</label>
                        <div class="col-sm-8">
                            <input value="<?php echo @$imagen['url'] ?>" type="text" required="" class="form-control input-sm" name="url" id="url">
                        </div>
                    </div>
                       

                </div>
            </div>
            <!--FIN IMAGEN-->
            
            
            
            <!--HOME-->
            
            <div class="panel panel-default">

                <div class="panel-heading">
                    <div class="panel-title">                        
                            Home
                    </div>
                </div>

                
                <div class="panel-body">                                             
                        
                    <?php if (isset($imagen['home_imagen']) && $imagen['home_imagen'] != ''): ?>
                        <input type="hidden" name="home_imagen" value="<?php echo $imagen['home_imagen'] ?>">
                    <?php endif; ?> 

                        
                    <div class="form-group">  
                        <div class="col-sm-3">
                                                        
                            <?php if (!empty($imagen['home_imagen'])): ?>
                                <img src="<?php echo URL_APP . "uploads/images/" . $imagen['home_imagen'] ?>"  class="img-responsive img-thumbnail" width="100%"/>
                            <?php endif; ?>
                                
                        </div>
                    </div>
                        
                        
                    <div class="form-group">  
                        <div class="col-sm-8">
                            <label class="control-label">Subir Imagen (1920 x 2086 px)</label>
                            <input type="file" name="home_imagen" id="home_imagen" />
                        </div>
                    </div>                        
                        
                        
                    <div class="form-group">  
                        <div class="col-sm-8">
                            <label class="control-label">Color</label>
                            <input type="color" name="home_color" value="<?php echo @$imagen['home_color'] ?>"/>
                        </div>
                    </div>                            
                                                
                </div>
            </div>
            <!--FIN HOME-->
            
            
            <!--NOTICIAS-->
            
            <div class="panel panel-default">

                <div class="panel-heading">
                    <div class="panel-title">                        
                            Noticias
                    </div>
                </div>

                
                <div class="panel-body">                                             
                        
                    <?php if (isset($imagen['noticias_imagen']) && $imagen['noticias_imagen'] != '' ): ?>
                        <input type="hidden" name="noticias_imagen" value="<?php echo $imagen['noticias_imagen'] ?>">
                    <?php endif; ?> 

                        
                    <div class="form-group">  
                        <div class="col-sm-3">
                                                        
                            <?php if (!empty($imagen['noticias_imagen'])): ?>
                                <img src="<?php echo URL_APP . "uploads/images/" . $imagen['noticias_imagen'] ?>"  class="img-responsive img-thumbnail" width="100%"/>
                            <?php endif; ?>
                                
                        </div>
                    </div>
                        
                        
                    <div class="form-group">  
                        <div class="col-sm-8">
                            <label class="control-label">Subir Imagen (1920 x 2086 px)</label>
                            <input type="file" name="noticias_imagen" id="noticias_imagen" />
                        </div>
                    </div>                        
                        
                        
                    <div class="form-group">  
                        <div class="col-sm-8">
                            <label class="control-label">Color</label>
                            <input type="color" name="noticias_color" value="<?php echo @$imagen['noticias_color'] ?>"/>
                        </div>
                    </div>                            
                                                
                </div>
            </div>
            <!--FIN NOTICIA-->          
            
            
            <!--CONTACTO-->
            
            <div class="panel panel-default">

                <div class="panel-heading">
                    <div class="panel-title">                        
                            Contacto
                    </div>
                </div>

                
                <div class="panel-body">                                             
                        
                    <?php if (isset($imagen['contacto_imagen']) && $imagen['contacto_imagen'] != '' ): ?>
                        <input type="hidden" name="contacto_imagen" value="<?php echo $imagen['contacto_imagen'] ?>">
                    <?php endif; ?> 

                        
                    <div class="form-group">  
                        <div class="col-sm-3">
                                                        
                            <?php if (!empty($imagen['contacto_imagen'])): ?>
                                <img src="<?php echo URL_APP . "uploads/images/" . $imagen['contacto_imagen'] ?>"  class="img-responsive img-thumbnail" width="100%"/>
                            <?php endif; ?>
                                
                        </div>
                    </div>
                        
                        
                    <div class="form-group">  
                        <div class="col-sm-8">
                            <label class="control-label">Subir Imagen (1920 x 2086 px)</label>
                            <input type="file" name="contacto_imagen" id="contacto_imagen" />
                        </div>
                    </div>                        
                        
                        
                    <div class="form-group">  
                        <div class="col-sm-8">
                            <label class="control-label">Color</label>
                            <input type="color" name="contacto_color" value="<?php echo @$imagen['contacto_color'] ?>"/>
                        </div>
                    </div>                            
                                                
                </div>
            </div>
            <!--FIN CONTACTO-->  
            
            <!--TERMINOS-->
            
            <div class="panel panel-default">

                <div class="panel-heading">
                    <div class="panel-title">                        
                            Terminos y Condiciones
                    </div>
                </div>

                
                <div class="panel-body">                                             
                        
                    <?php if (isset($imagen['terminos_imagen']) && $imagen['terminos_imagen'] != '' ): ?>
                        <input type="hidden" name="terminos_imagen" value="<?php echo $imagen['terminos_imagen'] ?>">
                    <?php endif; ?> 

                        
                    <div class="form-group">  
                        <div class="col-sm-3">
                                                        
                            <?php if (!empty($imagen['terminos_imagen'])): ?>
                                <img src="<?php echo URL_APP . "uploads/images/" . $imagen['terminos_imagen'] ?>"  class="img-responsive img-thumbnail" width="100%"/>
                            <?php endif; ?>
                                
                        </div>
                    </div>
                        
                        
                    <div class="form-group">  
                        <div class="col-sm-8">
                            <label class="control-label">Subir Imagen (1920 x 2086 px)</label>
                            <input type="file" name="terminos_imagen" id="terminos_imagen" />
                        </div>
                    </div>                        
                        
                        
                    <div class="form-group">  
                        <div class="col-sm-8">
                            <label class="control-label">Color</label>
                            <input type="color" name="terminos_color" value="<?php echo @$imagen['terminos_color'] ?>"/>
                        </div>
                    </div>                            
                                                
                </div>
            </div>
            <!--FIN TERMINOS-->  
            
            
            <?php if (hasPermission('acceso_imagen')): ?>
                <button type="submit" class="btn btn-success  btn-sm">
                    <span class="glyphicon glyphicon-ok"></span> 
                    Aplicar
                </button>
            <?php endif; ?>            
            
        </div>
        
    </form>
</div>
