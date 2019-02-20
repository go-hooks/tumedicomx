<div class="row">

    <div class="col-sm-10">

        <form enctype="multipart/form-data" class="form-horizontal" role="form" action="<?php echo url_format('categorias') ?>" method="get">

                <div class="form-group">

                <div class="col-sm-2">                    
                    <label>Buscar </label>
                </div>
                    
                    
                <div class="col-sm-2">
                    <input autofocus type="text" class="form-control input-sm" name="buscar" id="buscar" value="<?php echo @$buscar['buscar'] ?>">                    
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
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Mostrar</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categorias as $categoria): ?>
                    <tr>

                        <td>
                            <?php if (!empty($categoria['imagen'])): ?>
                                <img src="<?php echo URL_APP . "uploads/images/" . $categoria['imagen'] ?>" class="img-thumbnail" width="50px"/>
                            <?php endif; ?>
                        </td>
                        
                        
                        <td style="color: <?php echo $categoria['color']; ?>"><b><?php echo $categoria['nombre'] ?></b></td>
                        
                                                
                        <td>                            
                            <?php echo ($categoria['mostrar'] == 1)? "SI" : "NO";  ?>
                        </td>
                        
                        <td>
                            <?php if (hasPermission('categorias_editar')): ?>
                                <a class="btn btn-primary btn-xs"
                                   href="categorias/editar?p=<?php echo $buscar['p']; ?>&id=<?php echo $categoria['id']; ?>">
                                    <span class="glyphicon glyphicon-cog"></span>
                                    Editar
                                </a>
                            <?php endif; ?>
                            <?php if (hasPermission('categorias_eliminar')): ?>
                                <a class="btn btn-danger btn-xs" 
                                   onclick='return confirm("Está seguro de eliminar el siguiente registro?")'
                                   title="Borrar categoria" 
                                   href="<?php echo url_format('categorias/delete', array('id' => $categoria['id'], 'p' => $buscar['p'] )); ?>">
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
        <?php if (hasPermission('categorias_nuevo')): ?>
            <a href="<?php echo url_format('categorias/nuevo') ?>" class="btn btn-success btn-sm">
                <span class="glyphicon glyphicon-book"></span>
                Nueva categoria
            </a>
        <?php endif; ?>
    </div>

</div>
