<div class="row">
    <form enctype="multipart/form-data" class="form-horizontal" role="form" action="<?php echo url_format('catalogosMedicos/aplicar') ?>" method="post">
        <div class="col-sm-6">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <div class="panel-title">
                        <?php if (!isset($catalogo['id'])): ?>
                            Nuevo catalogo
                        <?php else: ?>
                            Edición de catalogo
                        <?php endif; ?>
                    </div>
                </div>

                <div class="panel-body">
                    <?php if (isset($catalogo['id'])): ?>
                        <input type="hidden" name="id" value="<?php echo $catalogo['id'] ?>">
                    <?php endif; ?>
                        
                    <?php if (isset($buscar['p'])): ?>
                        <input type="hidden" name="p" value="<?php echo $buscar['p'] ?>">
                    <?php endif; ?>                         
                        
                        
                    <div class="form-group">
                        <label for="nombre" class="col-sm-2 control-label">Nombre*</label>
                        <div class="col-sm-5">
                            <input value="<?php echo @$catalogo['nombre'] ?>" type="text" class="form-control input-sm" name="nombre" id="nombre" placeholder="">
                        </div>
                    </div>


                </div>


            </div>

        </div>

        
        <div class="col-sm-5">               
                   
            <?php if (hasPermission('acceso_catalogos_medicos')): ?>
                <button type="submit" class="btn btn-success  btn-sm">
                    <span class="glyphicon glyphicon-ok"></span> 
                    Aplicar
                </button>
                <a href="<?php echo url_format('catalogosMedicos', $buscar) ?>" class="btn btn-danger  btn-sm">
                    <span class="glyphicon glyphicon-remove"></span> 
                    Cancelar 
                </a>
            <?php endif; ?>
            
        </div>
    </form>
</div>
