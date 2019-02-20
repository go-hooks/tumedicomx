<div class="row">

    <div class="col-sm-10">

        <form enctype="multipart/form-data" class="form-horizontal" role="form" action="<?php echo url_format('aseguradoras') ?>" method="post">

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
                    <th>Aseguradora</th>                    
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($aseguradoras as $aseguradora): ?>
                    <tr>
                        
                        <td>
                            <?php if (!empty($aseguradora['imagen'])): ?>
                                <img src="<?php echo URL_APP . "uploads/images/" . $aseguradora['imagen'] ?>" class="img-thumbnail" width="200px"/>
                            <?php endif; ?>
                        </td>
                        
                        <td><b><?php echo $aseguradora['nombre'] ?></b></td>
                                                      
                        <td>
                            <?php if (hasPermission('aseguradoras_editar')): ?>
                                <a class="btn btn-primary btn-xs"
                                   href="aseguradoras/editar?id=<?php echo $aseguradora['id']; ?>">
                                    <span class="glyphicon glyphicon-cog"></span>
                                    Editar
                                </a>
                            <?php endif; ?>
                            <?php if (hasPermission('aseguradoras_eliminar')): ?>
                                <a class="btn btn-danger btn-xs" 
                                   onclick='return confirm("Está seguro de eliminar el siguiente registro?")'
                                   title="Borrar aseguradora" 
                                   href="<?php echo url_format('aseguradoras/delete', array('id' => $aseguradora['id'])); ?>">
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
        <?php if (hasPermission('aseguradoras_nuevo')): ?>
            <a href="<?php echo url_format('aseguradoras/nuevo') ?>" class="btn btn-success btn-sm">
                <span class="glyphicon glyphicon-book"></span>
                Nueva aseguradora
            </a>
        <?php endif; ?>
    </div>

</div>
