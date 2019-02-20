<div class="row">
    <form enctype="multipart/form-data" class="form-horizontal" role="form" action="<?php echo url_format('aseguradoras/aplicar') ?>" method="post">
        <div class="col-sm-6">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <div class="panel-title">
                        <?php if (!isset($aseguradora['id'])): ?>
                            Nueva aseguradora
                        <?php else: ?>
                            Edición de aseguradora
                        <?php endif; ?>
                    </div>
                </div>

                <div class="panel-body">
                    <?php if (isset($aseguradora['id'])): ?>
                        <input type="hidden" name="id" value="<?php echo $aseguradora['id'] ?>">
                    <?php endif; ?>
                        
                    <?php if (isset($aseguradora['imagen'])): ?>
                        <input type="hidden" name="imagen" value="<?php echo $aseguradora['imagen'] ?>">
                    <?php endif; ?>                          
                        
                    <div class="form-group">
                        <label for="nombre" class="col-sm-2 control-label">Nombre*</label>
                        <div class="col-sm-5">
                            <input value="<?php echo @$aseguradora['nombre'] ?>" type="text" class="form-control input-sm" name="nombre" id="nombre" placeholder="Nombre de la aseguradora">
                        </div>
                    </div>

                    <div class="form-group">

                        <div class="col-sm-3">
                            <?php if (!empty($aseguradora['imagen'])): ?>
                                <img src="<?php echo URL_APP . "uploads/images/" . $aseguradora['imagen'] ?>"  class="img-responsive img-thumbnail" width="100%"/>
                            <?php endif; ?>
                        </div>

                        <div class="col-sm-9">
                            <label class="control-label">Subir imagen:</label>
                            <input type="file" name="Imagen" id="Imagen" />
                        </div>

                    </div>                        

                </div>


            </div>

        </div>

        
        <div class="col-sm-5">               
                   
            <?php if (hasPermission('acceso_aseguradoras')): ?>
                <button type="submit" class="btn btn-success  btn-sm">
                    <span class="glyphicon glyphicon-ok"></span> 
                    Aplicar
                </button>
                <a href="<?php echo url_format('aseguradoras') ?>" class="btn btn-danger  btn-sm">
                    <span class="glyphicon glyphicon-remove"></span> 
                    Cancelar 
                </a>
            <?php endif; ?>
            
        </div>
    </form>
</div>
