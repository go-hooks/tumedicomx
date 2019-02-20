<div class="row">

    <div class="col-sm-10">

        <form enctype="multipart/form-data" class="form-horizontal" role="form" action="<?php echo url_format('articulos') ?>" method="get">

                <div class="form-group">

                <div class="col-sm-1">                    
                    <label>Buscar</label>
                </div>
                    
                    
                <div class="col-sm-2">
                    <input autofocus type="text" class="form-control input-sm" name="buscar" id="buscar" value="<?php echo @$buscar['buscar'] ?>" placeholder="Titulo o Autor">                    
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
                    <th>Fecha</th>
                    <th>Titulo</th>
                    <th>Autor</th>
                    <th>Categoria</th>
                    <th>Autorizado</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($articulos as $articulo): ?>
                    <tr>

                        <td><b><?php echo date('d/m/Y', strtotime($articulo['fecha'])) ?></b></td>
                        <td><b><?php echo $articulo['titulo'] ?></b></td>
                        <td><?php echo $articulo['autor'] ?></td>
                        
                        <?php                        
                            $categoria = categorias_read($articulo['categoria_id']);                        
                        ?>
                        
                        
                        <td><?php echo $categoria['nombre'] ?></td>
                        
                        <?php
                        
                            if($articulo['autorizado'] == 0)
                            {
                                $autorizado = "NO";
                            }
                            else
                            {
                                $autorizado = "SI";
                            }
                        
                        ?>
                        
                        <td><?php echo $autorizado ?></td>
                        
                        <td>
                            <?php if (hasPermission('articulos_editar')): ?>
                            
                                <a class="btn btn-success btn-xs"
                                   href="articulos/comentarios?p=<?php echo $buscar['p']; ?>&id=<?php echo $articulo['id']; ?>">
                                    <span class="glyphicon glyphicon-book"></span>
                                    Comentarios
                                </a>
                            
                                <a class="btn btn-primary btn-xs"
                                   href="articulos/editar?p=<?php echo $buscar['p']; ?>&id=<?php echo $articulo['id']; ?>">
                                    <span class="glyphicon glyphicon-cog"></span>
                                    Editar
                                </a>
                            <?php endif; ?>
                            <?php if (hasPermission('articulos_eliminar')): ?>
                                <a class="btn btn-danger btn-xs" 
                                   onclick='return confirm("Está seguro de eliminar el siguiente registro?")'
                                   title="Borrar articulo" 
                                   href="<?php echo url_format('articulos/delete', array('id' => $articulo['id'], 'p' => $buscar['p'] )); ?>">
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
        <?php if (hasPermission('articulos_nuevo')): ?>
            <a href="<?php echo url_format('articulos/nuevo') ?>" class="btn btn-success btn-sm">
                <span class="glyphicon glyphicon-book"></span>
                Nuevo articulo
            </a>
        <?php endif; ?>
    </div>

</div>
