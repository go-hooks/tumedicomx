<div class="row">
    <form enctype="multipart/form-data" class="form-horizontal" role="form" action="<?php echo url_format('categorias/aplicar') ?>" method="post">
        <div class="col-sm-6">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <div class="panel-title">
                        <?php if (!isset($categoria['id'])): ?>
                            Nuevo categoria
                        <?php else: ?>
                            Edición de categoria
                        <?php endif; ?>
                    </div>
                </div>

                <div class="panel-body">
                    <?php if (isset($categoria['id'])): ?>
                        <input type="hidden" name="id" value="<?php echo $categoria['id'] ?>">
                    <?php endif; ?>
                        
                    <?php if (isset($categoria['imagen'])): ?>
                        <input type="hidden" name="imagen" value="<?php echo $categoria['imagen'] ?>">
                    <?php endif; ?> 
                        
                    <?php if (isset($buscar['p'])): ?>
                        <input type="hidden" name="p" value="<?php echo $buscar['p'] ?>">
                    <?php endif; ?>                         
                        
                        
                    <div class="form-group">                        
                        <label for="nombre" class="col-sm-2 control-label">Nombre*</label>
                        <div class="col-sm-5">
                            <input value="<?php echo @$categoria['nombre'] ?>" type="text" class="form-control input-sm" name="nombre" id="nombre" required="">
                        </div>
                        
                        <label for="mostrar" class="col-sm-2 control-label">Mostrar</label>
                        <div class="col-sm-2">                            
                            <input type="checkbox" name="mostrar"  class="input-sm" <?php echo (@$categoria['mostrar']== 1) ? 'checked=""': '' ?> >
                        </div>
                        
                        
                        
                    </div>              

                    <div class="form-group">                        
                        <label for="color" class="col-sm-2 control-label">Color*</label>
                        <div class="col-sm-2">
                            <input value="<?php echo @$categoria['color'] ?>" type="color" class="form-control input-sm" name="color" id="color" required="">
                        </div>
                    </div>              

                        
                    <div class="form-group">

                        <div class="col-sm-3">
                            <?php if (!empty($categoria['imagen'])): ?>
                                <img src="<?php echo URL_APP . "uploads/images/" . $categoria['imagen'] ?>"  class="img-responsive img-thumbnail" width="100%"/>
                            <?php endif; ?>
                        </div>

                        <div class="col-sm-9">
                            <label class="control-label">Subir imagen (1920 x 2086 px):</label>
                            <input type="file" name="Imagen" id="Imagen" />
                        </div>

                    </div>
                        
                        
                </div>
            </div>
        </div>

        
        <div class="col-sm-5">               
                   
            <?php if (hasPermission('acceso_categorias')): ?>
                <button type="submit" class="btn btn-success  btn-sm">
                    <span class="glyphicon glyphicon-ok"></span> 
                    Aplicar
                </button>
                <a href="<?php echo url_format('categorias', $buscar) ?>" class="btn btn-danger  btn-sm">
                    <span class="glyphicon glyphicon-remove"></span> 
                    Cancelar 
                </a>
            <?php endif; ?>
            
        </div>
    </form>
</div>
