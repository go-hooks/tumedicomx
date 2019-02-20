<div class="row">
    <form enctype="multipart/form-data" class="form-horizontal" role="form" action="<?php echo url_format('laboratorios/aplicarSitio') ?>" method="post">
        <div class="col-sm-6">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <div class="panel-title">
                            Edición de laboratorio
                    </div>
                </div>

                <div class="panel-body">
                    <?php if (isset($laboratorio['id'])): ?>
                        <input type="hidden" name="id" value="<?php echo $laboratorio['id'] ?>">
                    <?php endif; ?>

                    <?php if (isset($laboratorio['imagen'])): ?>
                        <input type="hidden" name="imagen" value="<?php echo $laboratorio['imagen'] ?>">
                    <?php endif; ?>                          
                        
                    <?php if (isset($laboratorio['banner'])): ?>
                        <input type="hidden" name="banner" value="<?php echo $laboratorio['banner'] ?>">
                    <?php endif; ?>        
                        
                    <?php if (isset($buscar['p'])): ?>
                        <input type="hidden" name="p" value="<?php echo $buscar['p'] ?>">
                    <?php endif; ?>                         

                    <div class="form-group">
                        <label for="descripcion" class="col-sm-2 control-label">Descripcion</label>
                        <div class="col-sm-9">
                         <textarea rows="6" name="descripcion" class="ckeditor" id="descripcion" ><?php echo @$laboratorio['descripcion']; ?></textarea>
                        </div>
                    </div>                                 
                        
                    <div class="form-group">
                        <label for="facebook" class="col-sm-3 control-label">Facebook</label>
                        <div class="col-sm-7">
                            <input value="<?php echo @$laboratorio['facebook'] ?>" type="text" class="form-control input-sm" name="facebook" id="facebook">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="twitter" class="col-sm-3 control-label">Twitter</label>
                        <div class="col-sm-7">
                            <input value="<?php echo @$laboratorio['twitter'] ?>" type="text" class="form-control input-sm" name="twitter" id="twitter">
                        </div>
                    </div>                        


                    <div class="form-group">
                        <label for="skype" class="col-sm-3 control-label">Skype</label>
                        <div class="col-sm-7">
                            <input value="<?php echo @$laboratorio['skype'] ?>" type="text" class="form-control input-sm" name="skype" id="skype">
                        </div>
                    </div> 
                                                                                                   

                    <div class="form-group">
                        <label for="sitio_web" class="col-sm-3 control-label">Sitio Web</label>
                        <div class="col-sm-7">
                            <input value="<?php echo @$laboratorio['sitio_web'] ?>" type="text" class="form-control input-sm" name="sitio_web" id="sitio_web">
                        </div>
                    </div>                                                   

                        
                    <div class="form-group">
                        <label for="mapa" class="col-sm-3 control-label">Mapa</label>
                        <div class="col-sm-7">
                            <input value="<?php echo @$laboratorio['mapa'] ?>" type="text" class="form-control input-sm" name="mapa" id="mapa">
                        </div>
                    </div>    

                        
                    <div class="form-group">                    
                    <div class="col-sm-7">

                            <input type="radio" name="subscripcion" value="1" <?php if(isset($laboratorio['subscripcion']) && $laboratorio['subscripcion']=='1') echo 'checked=""' ?>>1 AÑO
                            <input type="radio" name="subscripcion" value="2" <?php if(isset($laboratorio['subscripcion']) && $laboratorio['subscripcion']=='2') echo 'checked=""' ?>>2 AÑOS
                            <input type="radio" name="subscripcion" value="3" <?php if(isset($laboratorio['subscripcion']) && $laboratorio['subscripcion']=='3') echo 'checked=""' ?>>3 AÑOS

                    </div>
                    </div>                            

                    <div class="form-group">                    
                    <div class="col-sm-7">

                            <input type="radio" name="forma_de_pago" value="TRANSFERENCIA" <?php if(isset($laboratorio['forma_de_pago']) && $laboratorio['forma_de_pago']=='TRANSFERENCIA') echo 'checked=""' ?>>TRANSFERENCIA BANCARIA
                            <input type="radio" name="forma_de_pago" value="EFECTIVO" <?php if(isset($laboratorio['forma_de_pago']) && $laboratorio['forma_de_pago']=='EFECTIVO') echo 'checked=""' ?>>EFECTIVO

                    </div>
                    </div>    
                        
                        
                </div>
            </div>
            
            <?php if (hasPermission('acceso_laboratorios')): ?>
                <button type="submit" class="btn btn-success  btn-sm">
                    <span class="glyphicon glyphicon-ok"></span> 
                    Aplicar
                </button>
                <a href="<?php echo url_format('laboratorios', $buscar) ?>" class="btn btn-danger  btn-sm">
                    <span class="glyphicon glyphicon-remove"></span> 
                    Cancelar 
                </a>
            <?php endif; ?>
            
        </div>
        
        
        <div class="col-sm-6">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <div class="panel-title">
                            Logotipo
                    </div>
                </div>

                <div class="panel-body">
                    
                    <div class="form-group">      
                        
                        <div class="col-sm-3">
                            <?php if (!empty($laboratorio['imagen'])): ?>
                                <img src="<?php echo URL_APP . "uploads/images/" . $laboratorio['imagen'] ?>"  class="img-responsive img-thumbnail" width="100%"/>
                            <?php endif; ?>
                        </div>

                        <div class="col-sm-9">
                            <label class="control-label">Logotipo: (400 x 375)</label>
                            <input type="file" name="Imagen" id="Imagen" />
                        </div>
                        
                    </div>
                    
                </div>
            </div>

            
            <div class="panel panel-default">

                <div class="panel-heading">
                    <div class="panel-title">
                            Banner
                    </div>
                </div>

                <div class="panel-body">
                    
                        
                    <div class="form-group">    
                        <div class="col-sm-3">
                            <?php if (!empty($laboratorio['banner'])): ?>
                                <img src="<?php echo URL_APP . "uploads/images/" . $laboratorio['banner'] ?>"  class="img-responsive img-thumbnail" width="100%"/>
                            <?php endif; ?>
                        </div>

                        <div class="col-sm-9">
                            <label class="control-label">Banner: (400 x 375)</label>
                            <input type="file" name="Banner" id="Banner" />
                        </div>
                    </div>
                                    
                    <div class="form-group">
                        <label for="url" class="col-sm-3 control-label">URL</label>
                        <div class="col-sm-7">
                            <input value="<?php echo @$laboratorio['url'] ?>" type="text" class="form-control input-sm" name="url" id="url">
                        </div>
                    </div>
                    
                </div>
            </div>
            
            
            
            <div class="panel panel-default">

                <div class="panel-heading">
                    <div class="panel-title">
                            Datos
                    </div>
                </div>

                <div class="panel-body">
                    
                    <?php

                    if (@$laboratorio['pagado'] == 1) {
                        $pagado = "checked";
                    } else {
                        $pagado = "";
                    }
                    
                    ?>                    
                    
                                           
                    
                    <div class="form-group">
                        
                        <div class="col-sm-2">
                            <label>
                                <input id="pagado" name="pagado" type="checkbox" <?php echo $pagado; ?> /> Pagado
                            </label>
                        </div>                        
                        
                        <label for="fecha_inicio" class="col-sm-2 control-label">Inicio</label>
                        <div class="col-sm-3">
                            <input readonly="" required="" value="<?php echo @$laboratorio['fecha_inicio'] ?>" type="text" class="form-control input-sm" name="fecha_inicio" id="fecha_inicio">
                        </div>

                        <label for="fecha_fin" class="col-sm-2 control-label">Fin</label>
                        <div class="col-sm-3">
                            <input readonly="" required="" value="<?php echo @$laboratorio['fecha_fin'] ?>" type="text" class="form-control input-sm" name="fecha_fin" id="fecha_fin">
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
        
        