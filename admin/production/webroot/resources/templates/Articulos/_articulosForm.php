<div class="row">
    <form enctype="multipart/form-data" class="form-horizontal" role="form" action="<?php echo url_format('articulos/aplicar') ?>" method="post">
        <div class="col-sm-10">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <div class="panel-title">
                        <?php if (!isset($articulo['id'])): ?>
                            Nuevo articulo
                        <?php else: ?>
                            Edición de articulo
                        <?php endif; ?>
                    </div>
                </div>

                <div class="panel-body">
                    <?php if (isset($articulo['id'])): ?>
                        <input type="hidden" name="id" value="<?php echo $articulo['id'] ?>">
                    <?php endif; ?>
                        
                    <?php if (isset($articulo['imagen'])): ?>
                        <input type="hidden" name="imagen" value="<?php echo $articulo['imagen'] ?>">
                    <?php endif; ?> 
                        
                    <?php if (isset($buscar['p'])): ?>
                        <input type="hidden" name="p" value="<?php echo $buscar['p'] ?>">
                    <?php endif; ?>                         
                        
                    <div class="form-group">                        
                        <label for="categoria_id" class="col-sm-2 control-label">Categoria*</label>
                        <div class="col-sm-5">

                            <select class="form-control input-sm" id="categoria_id" name="categoria_id" required="">
                                                                      
                            <?php foreach ($categorias as $categoria): ?>
                                <option value="<?php echo $categoria['id'] ?>" <?php echo (isset($articulo['categoria_id']) && $articulo['categoria_id'] == $categoria['id']) ? 'selected="selected"' : '' ?>>
                                    <?php echo $categoria['nombre'] ?>
                                </option>
                            <?php endforeach; ?>   
                                
                            </select>
                        </div>
                        
                        
                        <label for="autorizado" class="col-sm-2 control-label">Autorizado</label>
                        
                        <?php     
                                                        
                        ?>
                        
                        <div class="col-sm-2">
                            <input type="checkbox" name="autorizado" id="autorizado" class="input-sm" value="1" <?php if(@$articulo['autorizado']==1) echo'checked=""'; ?> >
                        </div>  
                        
                    </div>                          
                        
                        
                    <div class="form-group">                        
                        <label for="titulo" class="col-sm-2 control-label">Titulo*</label>
                        <div class="col-sm-5">
                            <input value="<?php echo @$articulo['titulo'] ?>" type="text" class="form-control input-sm" name="titulo" id="titulo" required="">
                        </div>
                        
                        
                        <label for="fecha" class="col-sm-2 control-label">Fecha*</label>
                        
                        <?php     
                                                        
                            if(! isset($articulo['fecha']) || $articulo['fecha'] == '')
                            {
                                $fecha = date("Y-m-d");
                            }
                            else
                            {
                                $fecha = $articulo['fecha'];
                            }

                        ?>
                        
                        <div class="col-sm-2">
                            <input value="<?php echo $fecha; ?>" type="date" class="form-control input-sm" name="fecha" id="fecha" required="">
                        </div>  
                        
                        
                    </div>              
                        
                    <div class="form-group">                        
                        <label for="autor" class="col-sm-2 control-label">Autor*</label>
                        <div class="col-sm-5">
                            <input value="<?php echo @$articulo['autor'] ?>" type="text" class="form-control input-sm" name="autor" id="autor" required="">
                        </div>
                    </div>                              

                    <div class="form-group">                        
                        <label for="correo" class="col-sm-2 control-label">Correo*</label>
                        <div class="col-sm-5">
                            <input value="<?php echo @$articulo['correo'] ?>" type="text" class="form-control input-sm" name="correo" id="correo" required="">
                        </div>
                    </div>      
                        
                    <div class="form-group">                        
                        <label for="palabras_clave" class="col-sm-2 control-label">Palabras Clave*</label>
                        <div class="col-sm-5">
                            <input value="<?php echo @$articulo['palabras_clave'] ?>" type="text" class="form-control input-sm" name="palabras_clave" id="palabras_clave" required="">
                        </div>
                    </div>  
                        
                        
                    <div class="form-group">                        
                        
                        <label for="video" class="col-sm-2 control-label">Video</label>
                        <div class="col-sm-5">
                            <input value="<?php echo @$articulo['video'] ?>" type="text" class="form-control input-sm" name="video" id="video">
                        </div>
                        
                        <label for="texto_video" class="col-sm-2 control-label">Texto Video</label>
                        <div class="col-sm-2">
                            <input value="<?php echo @$articulo['texto_video'] ?>" type="text" class="form-control input-sm" name="texto_video" id="texto_video">
                        </div>
                        
                        
                    </div>  

                        
                        
                        
                    <div class="form-group">

                        <div class="col-sm-3">
                            <?php if (!empty($articulo['imagen'])): ?>
                                <img src="<?php echo URL_APP . "uploads/images/" . $articulo['imagen'] ?>"  class="img-responsive img-thumbnail" width="200"/>
                            <?php endif; ?>
                        </div>

                        <div class="col-sm-9">
                            <label class="control-label">Subir imagen:</label>
                            <input type="file" name="Imagen" id="Imagen" />
                        </div>

                    </div>
                        
                        
                    <div class="form-group">
                        <label for="texto" class="col-sm-2 control-label">Contenido</label>
                        <div class="col-sm-9">
                            <textarea rows="10" name="texto" class="ckeditor" id="texto" ><?php echo @$articulo['texto']; ?></textarea>
                        </div>
                    </div>                          
                        
                </div>
            </div>
            
            <?php if (hasPermission('acceso_articulos')): ?>
                <button type="submit" class="btn btn-success  btn-sm">
                    <span class="glyphicon glyphicon-ok"></span> 
                    Aplicar
                </button>
                <a href="<?php echo url_format('articulos', $buscar) ?>" class="btn btn-danger  btn-sm">
                    <span class="glyphicon glyphicon-remove"></span> 
                    Cancelar 
                </a>
            <?php endif; ?>
            
        </div>
    </form>
</div>
