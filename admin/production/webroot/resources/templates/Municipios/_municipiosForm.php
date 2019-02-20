<div class="row">
    <form enctype="multipart/form-data" class="form-horizontal" role="form" action="<?php echo url_format('municipios/aplicar') ?>" method="post">
        <div class="col-sm-6">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <div class="panel-title">
                        <?php if (!isset($municipio['id'])): ?>
                            Nuevo municipio
                        <?php else: ?>
                            Edición de municipio
                        <?php endif; ?>
                    </div>
                </div>

                <div class="panel-body">
                    <?php if (isset($municipio['id'])): ?>
                        <input type="hidden" name="id" value="<?php echo $municipio['id'] ?>">
                    <?php endif; ?>
                        
                    <?php if (isset($buscar['p'])): ?>
                        <input type="hidden" name="p" value="<?php echo $buscar['p'] ?>">
                    <?php endif; ?>                        
                        
                        
                    <div class="form-group">                        
                        <label for="municipio" class="col-sm-2 control-label">Municipio*</label>
                        <div class="col-sm-5">
                            <input value="<?php echo @$municipio['municipio'] ?>" type="text" class="form-control input-sm" name="municipio" id="municipio" placeholder="Nombre del municipio">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="estado_id" class="col-sm-2 control-label">Estado*</label>                       
                        <div class="col-sm-5">
                                                     
                            <select class="validate-dropdown dropDown large" id="estado_id" name="estado_id">
                                                       
                            <?php foreach ($estados as $estado): ?>                                                               
                                
                                <option value="<?php echo $estado['id'] ?>" <?php echo (isset($municipio['estado_id']) && $municipio['estado_id'] == $estado['id']) ? 'selected="selected"' : '' ?>>
                                   
                                    <?php echo $estado['estado']; ?>                                    
                                    
                                </option>
                            <?php endforeach; ?>                                
                                
                            </select>                                                      
                        </div>                     
                     </div>                        

                        
                </div>
            </div>
        </div>

        
        <div class="col-sm-5">               
                   
            <?php if (hasPermission('acceso_municipios')): ?>
                <button type="submit" class="btn btn-success  btn-sm">
                    <span class="glyphicon glyphicon-ok"></span> 
                    Aplicar
                </button>
                <a href="<?php echo url_format('municipios', $buscar) ?>" class="btn btn-danger  btn-sm">
                    <span class="glyphicon glyphicon-remove"></span> 
                    Cancelar 
                </a>
            <?php endif; ?>
            
        </div>
    </form>
</div>
