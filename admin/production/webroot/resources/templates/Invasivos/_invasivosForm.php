<div class="row">
    <form enctype="multipart/form-data" class="form-horizontal" role="form" action="<?php echo url_format('invasivos/aplicar') ?>" method="post">
        <div class="col-sm-6">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <div class="panel-title">
                        <?php if (!isset($invasivo['id'])): ?>
                            Nuevo Banner
                        <?php else: ?>
                            Edición del Banner
                        <?php endif; ?>
                    </div>
                </div>

                <div class="panel-body">
                    <?php if (isset($invasivo['id'])): ?>
                        <input type="hidden" name="id" value="<?php echo $invasivo['id'] ?>">
                        <input type="hidden" name="imagen" value="<?php echo $invasivo['imagen'] ?>">
                    <?php endif; ?>
                        
                    <?php if (isset($buscar['p'])): ?>
                        <input type="hidden" name="p" value="<?php echo $buscar['p'] ?>">
                    <?php endif; ?>                          
                        
                        
                <div class="panel-body">

                    <div class="form-group">                                                
                        
                        <label for="localizacion">Localizacion*  </label>
                                       
                        <select class="validate-dropdown dropDown large" id="localizacion" name="localizacion" onchange="invasivos(this.value)" >
                          <option value=""></option>                                                        
                          <option value="blog"  <?php echo (isset($invasivo['localizacion']) && $invasivo['localizacion'] == 'blog') ? 'selected="selected"' : '' ?>>Blog</option>                                                          
                          <option value="home"  <?php echo (isset($invasivo['localizacion']) && $invasivo['localizacion'] == 'home') ? 'selected="selected"' : '' ?>>Home</option>                                                                                  
                          <option value="hospitales"  <?php echo (isset($invasivo['localizacion']) && $invasivo['localizacion'] == 'hospitales') ? 'selected="selected"' : '' ?>>Hospitales</option>                                                        
                          <option value="laboratorios"  <?php echo (isset($invasivo['localizacion']) && $invasivo['localizacion'] == 'laboratorios') ? 'selected="selected"' : '' ?>>Laboratorios</option>                                                        
                          <option value="medicos"  <?php echo (isset($invasivo['localizacion']) && $invasivo['localizacion'] == 'medicos') ? 'selected="selected"' : '' ?>>Medicos</option>                                                        
                          <option value="proveedores"  <?php echo (isset($invasivo['localizacion']) && $invasivo['localizacion'] == 'proveedores') ? 'selected="selected"' : '' ?>>Proveedores</option>                                                        
                          <option value="servicios"  <?php echo (isset($invasivo['localizacion']) && $invasivo['localizacion'] == 'servicios') ? 'selected="selected"' : '' ?>>Servicios</option>                                                                                  
                        </select>
                        
                    </div>
                    
                    
                    
                    <div class="form-group">                                                
                        
                        <label for="tipo">Tipo*  </label>
                                       
                        <select class="validate-dropdown dropDown large" id="tipo" name="tipo" >
                            
                                <?php                                    
                                    if(@$invasivo['localizacion']=='home' || @$invasivo['localizacion']=='blog' || @$invasivo['localizacion']=='medicos' || @$invasivo['localizacion']=='hospitales' || @$invasivo['localizacion']=='laboratorios' || @$invasivo['localizacion']=='servicios' || @$invasivo['localizacion']=='proveedores')
                                    {
                                ?>
                                        <option value="1"  <?php echo (isset($invasivo['tipo']) && $invasivo['tipo'] == '1') ? 'selected="selected"' : '' ?>>Banner 1 (800 x 500)</option>                                                        
                                <?php
                                    }                                
                                ?>
                                                        
                        </select>
                        
                    </div>
                        
                    <div class="form-group">  
                        <div class="col-sm-3">
                                                        
                            <?php if (!empty($invasivo['imagen'])): ?>
                                <img src="<?php echo URL_APP . "uploads/images/" . $invasivo['imagen'] ?>"  class="img-responsive img-thumbnail" width="100%"/>
                            <?php endif; ?>
                                
                        </div>
                    </div>
                    
                    
                    <div class="form-group">  
                        <div class="col-sm-9">
                            <label class="control-label">Subir Banner*</label>
                            <input type="file" name="Imagen" id="Imagen" />
                        </div>

                    </div>

                </div>
            
            </div>
                
           </div>             
            
            <?php if (hasPermission('acceso_invasivos')): ?>
                <button type="submit" class="btn btn-success  btn-sm">
                    <span class="glyphicon glyphicon-ok"></span> 
                    Aplicar
                </button>
                <a href="<?php echo url_format('invasivos', $buscar) ?>" class="btn btn-danger  btn-sm">
                    <span class="glyphicon glyphicon-remove"></span> 
                    Cancelar 
                </a>
            <?php endif; ?>
            
            
       </div>

        <div class="col-sm-5">               

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">DATOS</div>
                </div>

                <div class="panel-body">
                        

                    <div class="form-group">
                        <label for="fecha_inicio" class="col-sm-2 control-label">Inicio*</label>
                        <div class="col-sm-3">
                            <input readonly="" required="" value="<?php echo @$invasivo['fecha_inicio'] ?>" type="text" class="form-control input-sm" name="fecha_inicio" id="fecha_inicio">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="fecha_fin" class="col-sm-2 control-label">Fin*</label>
                        <div class="col-sm-3">
                            <input readonly="" required="" value="<?php echo @$invasivo['fecha_fin'] ?>" type="text" class="form-control input-sm" name="fecha_fin" id="fecha_fin">
                        </div>
                    </div>

                    <div class="form-group">     
                        <label for="cliente" class="col-sm-2 control-label">Cliente</label>
                        <div class="col-sm-9">
                            <input value="<?php echo @$invasivo['cliente'] ?>" type="text" class="form-control input-sm" name="cliente" id="cliente" placeholder="">
                        </div>
                    </div>
                    
                    <div class="form-group">     
                        <label for="url" class="col-sm-2 control-label">URL</label>
                        <div class="col-sm-9">
                            <input value="<?php echo @$invasivo['url'] ?>" type="text" class="form-control input-sm" name="url" id="url" placeholder="">
                        </div>
                    </div>
                        
                </div>
            </div>      
            
        </div>        
    </form>
</div>

<script type="text/javascript">
    var fecha_inicio = Calendar.setup({
        inputField  : "fecha_inicio",
        ifFormat    : "%Y-%m-%d"
    });

    var fecha_fin = Calendar.setup({
        inputField  : "fecha_fin",
        ifFormat    : "%Y-%m-%d"
    });

</script>