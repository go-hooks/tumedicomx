<div class="row">

    <div class="col-sm-10">

        <form enctype="multipart/form-data" class="form-horizontal" role="form" action="<?php echo url_format('estados') ?>" method="get">

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
                    <th>Estado</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($estados as $estado): ?>
                    <tr>
                        <td><b><?php echo $estado['estado'] ?></b></td>

                                                
                        <td>
                            <?php if (hasPermission('estados_editar')): ?>
                                <a class="btn btn-primary btn-xs"
                                   href="estados/editar?p=<?php echo $buscar['p']; ?>&id=<?php echo $estado['id']; ?>">
                                    <span class="glyphicon glyphicon-cog"></span>
                                    Editar
                                </a>
                            <?php endif; ?>
                            <?php if (hasPermission('estados_eliminar')): ?>
                                <a class="btn btn-danger btn-xs" 
                                   onclick='return confirm("Está seguro de eliminar el siguiente registro?")'
                                   title="Borrar estado" 
                                   href="<?php echo url_format('estados/delete', array('id' => $estado['id'], 'p' => $buscar['p'] )); ?>">
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
        <?php if (hasPermission('estados_nuevo')): ?>
            <a href="<?php echo url_format('estados/nuevo') ?>" class="btn btn-success btn-sm">
                <span class="glyphicon glyphicon-book"></span>
                Nuevo estado
            </a>
        <?php endif; ?>
    </div>

</div>
