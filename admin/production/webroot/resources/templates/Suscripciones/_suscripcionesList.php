<div class="row">

    <div class="col-sm-10">

        <form enctype="multipart/form-data" class="form-horizontal" role="form" action="<?php echo url_format('suscripciones') ?>" method="get">

                <div class="form-group">

                <div class="col-sm-2">                    
                    <label>Buscar </label>
                </div>
                    
                    
                <div class="col-sm-2">
                    <input autofocus type="text" class="form-control input-sm" name="buscar" id="buscar" value="<?php echo @$buscar['buscar'] ?>">                    
                </div>

                <label for="categoria_id" class="col-sm-1 control-label">Categoria</label>
                <div class="col-sm-2">

                    <select class="form-control input-sm" id="categoria_id" name="categoria_id">

                        <option value="" ></option>    
                        
                    <?php foreach ($categorias as $categoria): ?>
                        <option value="<?php echo $categoria['id'] ?>" <?php echo (isset($buscar['categoria_id']) && $buscar['categoria_id'] == $categoria['id']) ? 'selected="selected"' : '' ?>>
                            <?php echo $categoria['nombre'] ?>
                        </option>
                    <?php endforeach; ?>   

                    </select>
                </div>
                
                <button type="submit" class="btn btn-success  btn-sm">
                    <span class="glyphicon glyphicon-ok"></span> 
                    Buscar
                </button>


                </div>  


        </form>
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Categoria</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($suscripciones as $suscripcion): ?>
                    <tr>
                        
                        <td><b><?php echo $suscripcion['nombre'] ?></b></td>
                        <td><?php echo $suscripcion['correo'] ?></td>
                        <td><?php echo $suscripcion['categoria'] ?></td>                        
                                                
                        <td>
                            <?php if (hasPermission('suscripciones_eliminar')): ?>
                                <a class="btn btn-danger btn-xs" 
                                   onclick='return confirm("Está seguro de eliminar el siguiente registro?")'
                                   title="Borrar suscripcion" 
                                   href="<?php echo url_format('suscripciones/delete', array('id' => $suscripcion['id'], 'p' => $buscar['p'] )); ?>">
                                   <span class="glyphicon glyphicon-remove"></span> &nbsp;Borrar
                                </a>
                            <?php endif; ?>                            
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

    <div class="col-sm-2 next-2-table">
       
            <a href="<?php echo url_format('suscripciones/exportar') ?>" class="btn btn-success btn-sm">
                <span class="glyphicon glyphicon-book"></span>
                Exportar
            </a>
        
    </div>

</div>

