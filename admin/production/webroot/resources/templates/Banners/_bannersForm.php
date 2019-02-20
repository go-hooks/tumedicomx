<div class="row">
    <form enctype="multipart/form-data" class="form-horizontal" role="form" action="<?php echo url_format('banners/aplicar') ?>" method="post">
        <div class="col-sm-6">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <div class="panel-title">
                        <?php if (!isset($banner['id'])): ?>
                            Nuevo banner
                        <?php else: ?>
                            Edición de banner
                        <?php endif; ?>
                    </div>
                </div>

                <div class="panel-body">
                    <?php if (isset($banner['id'])): ?>
                        <input type="hidden" name="id" value="<?php echo $banner['id'] ?>">
                        <input type="hidden" name="imagen" value="<?php echo $banner['imagen'] ?>">
                    <?php endif; ?>
                        
                    <?php if (isset($buscar['p'])): ?>
                        <input type="hidden" name="p" value="<?php echo $buscar['p'] ?>">
                    <?php endif; ?>                          
                        
                        
                <div class="panel-body">

                    <div class="form-group">                                                
                        
                        <label for="localizacion">Localizacion*  </label>
                                       
                        <select class="validate-dropdown dropDown large" id="localizacion" name="localizacion" onchange="banners(this.value)" >
                          <option value=""></option>                                                        
                          <option value="blog"  <?php echo (isset($banner['localizacion']) && $banner['localizacion'] == 'blog') ? 'selected="selected"' : '' ?>>Blog</option>                                                        
                          <option value="inicio"  <?php echo (isset($banner['localizacion']) && $banner['localizacion'] == 'inicio') ? 'selected="selected"' : '' ?>>Inicio</option>                                                        
                          <option value="medicos"  <?php echo (isset($banner['localizacion']) && $banner['localizacion'] == 'medicos') ? 'selected="selected"' : '' ?>>Medicos</option>                                
                          <option value="hospitales"  <?php echo (isset($banner['localizacion']) && $banner['localizacion'] == 'hospitales') ? 'selected="selected"' : '' ?>>Hospitales</option>                                
                          <option value="laboratorios"  <?php echo (isset($banner['localizacion']) && $banner['localizacion'] == 'laboratorios') ? 'selected="selected"' : '' ?>>Laboratorios</option>                                
                          <option value="servicios"  <?php echo (isset($banner['localizacion']) && $banner['localizacion'] == 'servicios') ? 'selected="selected"' : '' ?>>Servicios</option>                                
                          <option value="empresa"  <?php echo (isset($banner['localizacion']) && $banner['localizacion'] == 'empresa') ? 'selected="selected"' : '' ?>>Empresa</option>                                
                          <option value="contacto"  <?php echo (isset($banner['localizacion']) && $banner['localizacion'] == 'contacto') ? 'selected="selected"' : '' ?>>Contacto</option>                                
                          <option value="resultados"  <?php echo (isset($banner['localizacion']) && $banner['localizacion'] == 'resultados') ? 'selected="selected"' : '' ?>>Resultados</option>                                
                        </select>
                        
                    </div>
                    
                    
                    
                    <div class="form-group">                                                
                        
                        <label for="tipo">Tipo*  </label>
                                       
                        <select class="validate-dropdown dropDown large" id="tipo" name="tipo" >

                                <?php                                    
                                    if(@$banner['localizacion']=='blog')
                                    {
                                ?>
                                        <option value="6"  <?php echo (isset($banner['tipo']) && $banner['tipo'] == '6') ? 'selected="selected"' : '' ?>>Banner 1 (830 x 250)</option>                                                        
                                        <option value="7"  <?php echo (isset($banner['tipo']) && $banner['tipo'] == '7') ? 'selected="selected"' : '' ?>>Banner 2 (830 x 110)</option>                                
                                <?php
                                    }                                
                                ?>
                                        
                                <?php                                    
                                    if(@$banner['localizacion']=='inicio')
                                    {
                                ?>
                                        <option value="1"  <?php echo (isset($banner['tipo']) && $banner['tipo'] == '1') ? 'selected="selected"' : '' ?>>Banner 1 (960 x 130)</option>                                                        
                                        <option value="2"  <?php echo (isset($banner['tipo']) && $banner['tipo'] == '2') ? 'selected="selected"' : '' ?>>Banner 2 (960 x 220)</option>                                
                                        <option value="3"  <?php echo (isset($banner['tipo']) && $banner['tipo'] == '3') ? 'selected="selected"' : '' ?>>Banner 3 (400 x 375)</option>                                
                                        <option value="4"  <?php echo (isset($banner['tipo']) && $banner['tipo'] == '4') ? 'selected="selected"' : '' ?>>Banner 4 (400 x 275)</option>                                
                                        <option value="5"  <?php echo (isset($banner['tipo']) && $banner['tipo'] == '5') ? 'selected="selected"' : '' ?>>Banner 5 (400 x 140)</option>                                                                        
                                <?php
                                    }                                
                                ?>

                                <?php                                    
                                    if(@$banner['localizacion']=='medicos')
                                    {
                                ?>
                                        <option value="1"  <?php echo (isset($banner['tipo']) && $banner['tipo'] == '1') ? 'selected="selected"' : '' ?>>Banner 1 (960 x 130)</option>                                                                                                
                                <?php
                                    }                                
                                ?>
                                                                    
                                <?php                                    
                                    if(@$banner['localizacion']=='hospitales')
                                    {
                                ?>
                                        <option value="1"  <?php echo (isset($banner['tipo']) && $banner['tipo'] == '1') ? 'selected="selected"' : '' ?>>Banner 1 (960 x 130)</option>                                                        
                                       
                                <?php
                                    }                                
                                ?>

                                <?php                                    
                                    if(@$banner['localizacion']=='laboratorios')
                                    {
                                ?>
                                        <option value="1"  <?php echo (isset($banner['tipo']) && $banner['tipo'] == '1') ? 'selected="selected"' : '' ?>>Banner 1 (960 x 130)</option>                                                        
                                <?php
                                    }                                
                                ?>
                                        
                                <?php                                    
                                    if(@$banner['localizacion']=='servicios')
                                    {
                                ?>
                                        <option value="1"  <?php echo (isset($banner['tipo']) && $banner['tipo'] == '1') ? 'selected="selected"' : '' ?>>Banner 1 (960 x 130)</option>                                                        

                                <?php
                                    }                                
                                ?>                            
                                        
                                <?php                                    
                                    if(@$banner['localizacion']=='empresa')
                                    {
                                ?>
                                        <option value="1"  <?php echo (isset($banner['tipo']) && $banner['tipo'] == '1') ? 'selected="selected"' : '' ?>>Banner 1 (960 x 130)</option>                                                        
                                <?php
                                    }                                
                                ?>                            

                                        
                                <?php                                    
                                    if(@$banner['localizacion']=='contacto')
                                    {
                                ?>
                                        <option value="1"  <?php echo (isset($banner['tipo']) && $banner['tipo'] == '1') ? 'selected="selected"' : '' ?>>Banner 1 (960 x 130)</option>                                                        
                                <?php
                                    }                                
                                ?>                            

                                        
                                <?php                                    
                                    if(@$banner['localizacion']=='resultados')
                                    {
                                ?>
                                        <option value="1"  <?php echo (isset($banner['tipo']) && $banner['tipo'] == '1') ? 'selected="selected"' : '' ?>>Banner 1 (960 x 130)</option>                                                        
                                <?php
                                    }                                
                                ?>                            
                                                                    
                                                        
                        </select>
                        
                    </div>
                        
                    <div class="form-group">  
                        <div class="col-sm-3">
                                                        
                            <?php if (!empty($banner['imagen'])): ?>
                                <img src="<?php echo URL_APP . "uploads/images/" . $banner['imagen'] ?>"  class="img-responsive img-thumbnail" width="100%"/>
                            <?php endif; ?>
                                
                        </div>
                    </div>
                    
                    
                    <div class="form-group">  
                        <div class="col-sm-9">
                            <label class="control-label">Subir banner*</label>
                            <input type="file" name="Imagen" id="Imagen" />
                        </div>

                    </div>

                </div>
            
            </div>
                
           </div>             
            
            <?php if (hasPermission('acceso_banners')): ?>
                <button type="submit" class="btn btn-success  btn-sm">
                    <span class="glyphicon glyphicon-ok"></span> 
                    Aplicar
                </button>
                <a href="<?php echo url_format('banners', $buscar) ?>" class="btn btn-danger  btn-sm">
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
                            <input readonly="" required="" value="<?php echo @$banner['fecha_inicio'] ?>" type="text" class="form-control input-sm" name="fecha_inicio" id="fecha_inicio">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="fecha_fin" class="col-sm-2 control-label">Fin*</label>
                        <div class="col-sm-3">
                            <input readonly="" required="" value="<?php echo @$banner['fecha_fin'] ?>" type="text" class="form-control input-sm" name="fecha_fin" id="fecha_fin">
                        </div>
                    </div>

                    <div class="form-group">     
                        <label for="cliente" class="col-sm-2 control-label">Cliente</label>
                        <div class="col-sm-9">
                            <input value="<?php echo @$banner['cliente'] ?>" type="text" class="form-control input-sm" name="cliente" id="cliente" placeholder="">
                        </div>
                    </div>
                    
                    <div class="form-group">     
                        <label for="url" class="col-sm-2 control-label">URL</label>
                        <div class="col-sm-9">
                            <input value="<?php echo @$banner['url'] ?>" type="text" class="form-control input-sm" name="url" id="url" placeholder="">
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