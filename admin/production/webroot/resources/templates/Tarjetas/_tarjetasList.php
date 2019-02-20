<div class="row">

    <div class="col-sm-10">

        <form enctype="multipart/form-data" class="form-horizontal" role="form" action="<?php echo url_format('tarjetas') ?>" method="post">

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
                    <th>Tarjeta</th>                    
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tarjetas as $tarjeta): ?>
                    <tr>
                        
                        <td>
                            <?php if (!empty($tarjeta['imagen'])): ?>
                                <img src="<?php echo URL_APP . "uploads/images/" . $tarjeta['imagen'] ?>" class="img-thumbnail" width="200px"/>
                            <?php endif; ?>
                        </td>
                        
                        <td><b><?php echo $tarjeta['nombre'] ?></b></td>
                                                      
                        <td>
                            <?php if (hasPermission('tarjetas_editar')): ?>
                                <a class="btn btn-primary btn-xs"
                                   href="tarjetas/editar?id=<?php echo $tarjeta['id']; ?>">
                                    <span class="glyphicon glyphicon-cog"></span>
                                    Editar
                                </a>
                            <?php endif; ?>
                            <?php if (hasPermission('tarjetas_eliminar')): ?>
                                <a class="btn btn-danger btn-xs" 
                                   onclick='return confirm("Está seguro de eliminar el siguiente registro?")'
                                   title="Borrar tarjeta" 
                                   href="<?php echo url_format('tarjetas/delete', array('id' => $tarjeta['id'])); ?>">
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
        <?php if (hasPermission('tarjetas_nuevo')): ?>
            <a href="<?php echo url_format('tarjetas/nuevo') ?>" class="btn btn-success btn-sm">
                <span class="glyphicon glyphicon-book"></span>
                Nueva tarjeta
            </a>
        <?php endif; ?>
    </div>

</div>
