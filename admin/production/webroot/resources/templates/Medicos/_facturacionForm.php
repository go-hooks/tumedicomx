<div class="row">
    <form enctype="multipart/form-data" class="form-horizontal" role="form" action="<?php echo url_format('medicos/aplicarFacturacion') ?>" method="post">
        <div class="col-sm-8">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <div class="panel-title">
                            Edición de medico
                    </div>
                </div>

                <div class="panel-body">
                    <?php if (isset($medico['id'])): ?>
                        <input type="hidden" name="id" value="<?php echo $medico['id'] ?>">
                    <?php endif; ?>
                        
                    <?php if (isset($buscar['p'])): ?>
                        <input type="hidden" name="p" value="<?php echo $buscar['p'] ?>">
                    <?php endif; ?>                           
                                                                        
                    <div class="form-group">
                        <label for="razon_social" class="col-sm-3 control-label">Razon Social</label>
                        <div class="col-sm-7">
                            <input value="<?php echo @$medico['razon_social'] ?>" type="text" class="form-control input-sm" name="razon_social" id="nombre">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="rfc" class="col-sm-3 control-label">RFC</label>
                        <div class="col-sm-7">
                            <input value="<?php echo @$medico['rfc'] ?>" type="text" class="form-control input-sm" name="rfc" id="rfc">
                        </div>
                    </div>                        


                    <div class="form-group">
                        <label for="calle_facturacion" class="col-sm-3 control-label">Calle</label>
                        <div class="col-sm-7">
                            <input value="<?php echo @$medico['calle_facturacion'] ?>" type="text" class="form-control input-sm" name="calle_facturacion" id="calle_facturacion">
                        </div>
                    </div> 
                        
                        
                    <div class="form-group">
                        <label for="numero_facturacion" class="col-sm-3 control-label">Numero</label>
                        <div class="col-sm-2">
                            <input value="<?php echo @$medico['numero_facturacion'] ?>" type="text" class="form-control input-sm" name="numero_facturacion" id="numero_facturacion">
                        </div>

                        <label for="cp_facturacion" class="col-sm-3 control-label">CP</label>
                        <div class="col-sm-2">
                            <input value="<?php echo @$medico['cp_facturacion'] ?>" type="text" class="form-control input-sm" name="cp_facturacion" id="cp_facturacion">
                        </div>

                        
                    </div>                                                        

                    <div class="form-group">
                        <label for="colonia_facturacion" class="col-sm-3 control-label">Colonia</label>
                        <div class="col-sm-7">
                            <input value="<?php echo @$medico['colonia_facturacion'] ?>" type="text" class="form-control input-sm" name="colonia_facturacion" id="colonia_facturacion">
                        </div>
                    </div>                                                   
                        
                </div>
            </div>
                       

            
            <?php if (hasPermission('acceso_medicos')): ?>
                <button type="submit" class="btn btn-success  btn-sm">
                    <span class="glyphicon glyphicon-ok"></span> 
                    Aplicar
                </button>
                <a href="<?php echo url_format('medicos', $buscar) ?>" class="btn btn-danger  btn-sm">
                    <span class="glyphicon glyphicon-remove"></span> 
                    Cancelar 
                </a>
            <?php endif; ?>
            
            
        </div>
    </form>
</div>
