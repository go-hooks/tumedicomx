<div class="row">

    <div class="col-sm-10">

        <form enctype="multipart/form-data" class="form-horizontal" role="form" action="<?php echo url_format('catalogosMedicos') ?>" method="get">

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
                    <th>Catalogo</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($catalogos as $catalogo): ?>
                    <tr>
                        <td><b><?php echo $catalogo['nombre'] ?></b></td>

                                                
                        <td>
                            <?php if (hasPermission('catalogos_medicos_editar')): ?>
                                <a class="btn btn-primary btn-xs"
                                   href="catalogosMedicos/editar?p=<?php echo $buscar['p']; ?>&id=<?php echo $catalogo['id']; ?>">
                                    <span class="glyphicon glyphicon-cog"></span>
                                    Editar
                                </a>
                            <?php endif; ?>
                            <?php if (hasPermission('catalogos_medicos_eliminar')): ?>
                                <a class="btn btn-danger btn-xs" 
                                   onclick='return confirm("Está seguro de eliminar el siguiente registro?")'
                                   title="Borrar catalogo" 
                                   href="<?php echo url_format('catalogosMedicos/delete', array('id' => $catalogo['id'], 'p' => $buscar['p'] )); ?>">
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
        <?php if (hasPermission('catalogos_medicos_nuevo')): ?>
            <a href="<?php echo url_format('catalogosMedicos/nuevo') ?>" class="btn btn-success btn-sm">
                <span class="glyphicon glyphicon-book"></span>
                Nuevo catalogo
            </a>
        <?php endif; ?>
    </div>

</div>
