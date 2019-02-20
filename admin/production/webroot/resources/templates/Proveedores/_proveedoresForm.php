<div class="row">
    <form enctype="multipart/form-data" class="form-horizontal" role="form" action="<?php echo url_format('proveedores/aplicar') ?>" method="post">
        <div class="col-sm-5">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <div class="panel-title">
                        <?php if (!isset($proveedor['id'])): ?>
                            Nuevo proveedor
                        <?php else: ?>
                            Edición de proveedor
                        <?php endif; ?>
                    </div>
                </div>

                <div class="panel-body">
                    <?php if (isset($proveedor['id'])): ?>
                        <input type="hidden" name="id" value="<?php echo $proveedor['id'] ?>">
                    <?php endif; ?>
                        
                    <?php if (isset($buscar['p'])): ?>
                        <input type="hidden" name="p" value="<?php echo $buscar['p'] ?>">
                    <?php endif; ?>                           
                        
                    <?php                    
                        if (@$proveedor['autorizado'] == 1) {
                            $autorizado = "checked";
                        } else {
                            $autorizado = "";
                        }                    
                    ?>                    
                    <div class="form-group">
                        
                        <div class="col-sm-5">
                            <div class="checkbox">
                                <label>
                                    <input id="destacado" name="autorizado" type="checkbox" <?php echo $autorizado; ?> /> Autorizado
                                </label>
                            </div>
                        </div>
                        
                    </div>   
                        
                    <div class="form-group">
                        <label for="representante" class="col-sm-3 control-label">Representante*</label>
                        <div class="col-sm-8">
                            <input value="<?php echo @$proveedor['representante'] ?>" type="text" class="form-control input-sm" name="representante" id="representante" required="">
                        </div>
                    </div>
                                                
                    <div class="form-group">
                        <label for="nombre" class="col-sm-3 control-label">Nombre*</label>
                        <div class="col-sm-8">
                            <input value="<?php echo @$proveedor['nombre'] ?>" type="text" class="form-control input-sm" name="nombre" id="nombre" required="">
                        </div>
                    </div>           


                    <div class="form-group">
                        <label for="telefono" class="col-sm-3 control-label">Telefono*</label>
                        <div class="col-sm-8">
                            <input value="<?php echo @$proveedor['telefono'] ?>" type="text" class="form-control input-sm" name="telefono" id="telefono" required="">
                        </div>
                    </div> 
                        
                        
                    <div class="form-group">
                        <label for="correo" class="col-sm-3 control-label">Usuario*</label>
                        <div class="col-sm-8">
                            <input value="<?php echo @$proveedor['correo'] ?>" type="text" class="form-control input-sm" name="correo" id="correo" required="">
                        </div>
                    </div>                                                        

                        
                    <div class="form-group">
                        <label for="auth_password" class="col-sm-3 control-label">Contrase&ntilde;a*</label>
                        <div class="col-sm-8">
                            <input   type="password"  value="" class="form-control input-sm" id="password" name="password" autocomplete="off" <?php echo(!isset($proveedor['id'])) ? 'required' : ''?>/>
                        </div>
                    </div>                        

                    <div class="form-group">
                        <label for="auth_password" class="col-sm-3 control-label">Confirmar Contrase&ntilde;a*</label>
                        <div class="col-sm-8">
                            <input   type="password"  value="" class="form-control input-sm" id="confirm_password" name="confirm_password" autocomplete="off" <?php echo(!isset($proveedor['id'])) ? 'required' : ''?>/>
                        </div>
                    </div>                              

                        <?php if (isset($proveedor['id'])): ?>
                            <div class="form-info-notes">Deje los campos en blanco para conservar su contrase&ntilde;a actual.</div>
                        <?php endif; ?>                        
                        
                </div>
            </div>
            
            
            <div class="panel panel-default">

                <div class="panel-heading">
                    <div class="panel-title">
                        Datos
                    </div>
                </div>
                
                <div class="panel-body">
                    
                    <div class="form-group">
                        <label for="categoria_id" class="col-sm-3 control-label">Categoria*</label>
                        <div class="col-sm-6">

                            <select class="validate-dropdown dropDown large" id="categoria_id" name="categoria_id">                                
                                     
                            <?php foreach ($categorias as $categoria): ?>
                                <option value="<?php echo $categoria['id'] ?>" <?php echo (isset($proveedor['categoria_id']) && $proveedor['categoria_id'] == $categoria['id']) ? 'selected="selected"' : '' ?>>
                                    <?php echo $categoria['nombre'] ?>
                                </option>
                            <?php endforeach; ?>                                
                                
                            </select>                            
                                                        
                        </div>
                    </div>                       
                    
                </div>
                
            </div>

            <div class="panel panel-default">

                <div class="panel-heading">
                    <div class="panel-title">
                        Encuesta
                    </div>
                </div>
                
                <div class="panel-body">
                    
                    <div class="form-group">
                        <label for="encuesta" class="col-sm-3 control-label">Encuesta*</label>
                        <div class="col-sm-6">

                            <select class="validate-dropdown dropDown large" id="encuesta" name="encuesta" required="">
                                                                                                  
                                <option value="">-Seleccione una opcion-</option>
                                <option value="Anuncio Publicitario" <?php echo (isset($proveedor['encuesta']) && $proveedor['encuesta'] == 'Anuncio Publicitario') ? 'selected="selected"' : '' ?>>Anuncio Publicitario</option>
                                <option value="Correo Electrónico" <?php echo (isset($proveedor['encuesta']) && $proveedor['encuesta'] == 'Correo Electrónico') ? 'selected="selected"' : '' ?>>Correo Electrónico</option>
                                <option value="Recomendaciones" <?php echo (isset($proveedor['encuesta']) && $proveedor['encuesta'] == 'Recomendaciones') ? 'selected="selected"' : '' ?>>Recomendaciones</option>
                                <option value="Redes Sociales" <?php echo (isset($proveedor['encuesta']) && $proveedor['encuesta'] == 'Redes Sociales') ? 'selected="selected"' : '' ?>>Redes Sociales</option>                                                                                                
                                <option value="Vía telefónica" <?php echo (isset($proveedor['encuesta']) && $proveedor['encuesta'] == 'Vía telefónica') ? 'selected="selected"' : '' ?>>Vía telefónica</option>
                                
                            </select>                            
                                                        
                        </div>
                    </div>   
                                                         
                    
                </div>
                
            </div>
            
        </div>

        
        <div class="col-sm-5">               
            
            <div class="panel panel-default">

                <div class="panel-heading">
                    <div class="panel-title">
                        Contacto
                    </div>
                </div>

                 <div class="panel-body">
                     
                    <div class="form-group">
                        <label for="correo_contacto" class="col-sm-3 control-label">Correo*</label>
                        <div class="col-sm-7">
                            <input value="<?php echo @$proveedor['correo_contacto'] ?>" type="text" class="form-control input-sm" name="correo_contacto" id="correo_contacto" required="">
                        </div>
                    </div>   
                     
                    <div class="form-group">
                        <label for="calle_contacto" class="col-sm-3 control-label">Calle*</label>
                        <div class="col-sm-7">
                            <input value="<?php echo @$proveedor['calle_contacto'] ?>" type="text" class="form-control input-sm" name="calle_contacto" id="calle_contacto" required="">
                        </div>
                    </div>
                     
                    <div class="form-group">
                        <label for="numero_contacto" class="col-sm-3 control-label">Numero*</label>
                        <div class="col-sm-2">
                            <input value="<?php echo @$proveedor['numero_contacto'] ?>" type="text" class="form-control input-sm" name="numero_contacto" id="numero_contacto" required="">
                        </div>
                        
                        <label for="cp_contacto" class="col-sm-3 control-label">CP*</label>
                        <div class="col-sm-2">
                            <input value="<?php echo @$proveedor['cp_contacto'] ?>" type="text" class="form-control input-sm" name="cp_contacto" id="cp_contacto" required="">
                        </div>
                                                
                    </div>
 
                     
                    <div class="form-group">
                        <label for="colonia_contacto" class="col-sm-3 control-label">Colonia*</label>
                        <div class="col-sm-7">
                            <input value="<?php echo @$proveedor['colonia_contacto'] ?>" type="text" class="form-control input-sm" name="colonia_contacto" id="colonia_contacto" required="">
                        </div>
                    </div>                     

                    <div class="form-group">
                        <label for="estado_id" class="col-sm-3 control-label">Estado*</label>
                        <div class="col-sm-7">

                            <select class="validate-dropdown dropDown large" id="estado_id" name="estado_id" onchange="municipios(this.value)">
                                      
                                <option value="0"> </option>   
                                
                            <?php foreach ($estados as $estado): ?>
                                <option value="<?php echo $estado['id'] ?>" <?php echo (isset($proveedor['estado_id']) && $proveedor['estado_id'] == $estado['id']) ? 'selected="selected"' : '' ?>>
                                    <?php echo $estado['estado'] ?>
                                </option>
                            <?php endforeach; ?>                                
                                
                            </select>                            
                                                        
                        </div>
                    </div>     
                     

                    <div class="form-group">
                        <label for="municipio_id" class="col-sm-3 control-label">Municipio*</label>
                        <div class="col-sm-7">

                            <select class="validate-dropdown dropDown large" id="municipio_id" name="municipio_id">

                                
                                <?php foreach ($municipios as $municipio): ?>
                                    <option value="<?php echo $municipio['id'] ?>" <?php echo (isset($proveedor['municipio_id']) && $proveedor['municipio_id'] == $municipio['id']) ? 'selected="selected"' : '' ?>>
                                        <?php echo $municipio['municipio'] ?>
                                    </option>
                                <?php endforeach; ?>     
                                
                                
                            </select>                            
                                                        
                        </div>
                    </div>     
                     

                    <div class="form-group">
                        <label for="telefono_contacto" class="col-sm-3 control-label">Telefono*</label>
                        <div class="col-sm-7">
                            <input value="<?php echo @$proveedor['telefono_contacto'] ?>" type="text" class="form-control input-sm" name="telefono_contacto" id="telefono_contacto" required="">
                        </div>
                    </div>                         
                     
                    <div class="form-group">
                        <label for="fax_contacto" class="col-sm-3 control-label">Fax</label>
                        <div class="col-sm-7">
                            <input value="<?php echo @$proveedor['fax_contacto'] ?>" type="text" class="form-control input-sm" name="fax_contacto" id="fax_contacto">
                        </div>
                    </div>   
                                        
                    <div class="form-group">
                        <label for="horario" class="col-sm-3 control-label">Horario</label>
                        <div class="col-sm-7">
                            <input value="<?php echo @$proveedor['horario'] ?>" type="text" class="form-control input-sm" name="horario" id="horario">
                        </div>
                    </div>                       
                     
                 </div>                
            </div>
            
            <div class="panel panel-default">

                <div class="panel-heading">
                    <div class="panel-title">
                        Busqueda
                    </div>
                </div>
                
                <div class="panel-body">

                
                    <?php

                    if (@$proveedor['destacado'] == 1) {
                        $destacado = "checked";
                    } else {
                        $destacado = "";
                    }
                    
                    ?>                    
                    <div class="form-group">
                        
                        <div class="col-sm-5">
                            <div class="checkbox">
                                <label>
                                    <input id="destacado" name="destacado" type="checkbox" <?php echo $destacado; ?> /> Destacar
                                </label>
                            </div>
                        </div>
                        
                    </div>   
                    
                    
                    <div class="form-group">
                        <label for="palabras_clave" class="col-sm-2 control-label">Palabras Clave</label>
                        <div class="col-sm-9">
                         <textarea  name="palabras_clave" class="form-control input-sm" id="palabras_clave" ><?php echo @$proveedor['palabras_clave']; ?></textarea>
                        </div>
                    </div>                      
                    
                    
                </div>
                
            </div>            

            <?php if (hasPermission('acceso_proveedores')): ?>
                <button type="submit" class="btn btn-success  btn-sm">
                    <span class="glyphicon glyphicon-ok"></span> 
                    Aplicar
                </button>
                <a href="<?php echo url_format('proveedores', $buscar) ?>" class="btn btn-danger  btn-sm">
                    <span class="glyphicon glyphicon-remove"></span> 
                    Cancelar 
                </a>
            <?php endif; ?>
            
            
        </div>
    </form>
</div>
