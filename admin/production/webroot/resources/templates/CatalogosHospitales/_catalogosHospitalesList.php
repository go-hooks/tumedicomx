<div class="row">

    <div class="col-sm-10">

        <form enctype="multipart/form-data" class="form-horizontal" role="form" action="<?php echo url_format('catalogosHospitales') ?>" method="get">

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
                    <th>Catalogo</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($catalogos as $catalogo): ?>
                    <tr>

                        <td>
                            <?php if (!empty($catalogo['imagen'])): ?>
                                <img src="<?php echo URL_APP . "uploads/images/" . $catalogo['imagen'] ?>" class="img-thumbnail" width="50px"/>
                            <?php endif; ?>
                        </td>
                        
                        <td><b><?php echo $catalogo['nombre'] ?></b></td>
                                                
                        <?php
                            $padre = '';
                            
                            if ($catalogo['padre_id']){                                
                                $padre = catalogos_hospitales_read($catalogo['padre_id']);
                            }
                            
                        ?>
                        
                        <td><b><?php if(!empty($padre)) echo $padre['nombre'] ?></b></td>
                        
                        <td>
                            <?php if (hasPermission('catalogos_hospitales_editar')): ?>
                                <a class="btn btn-primary btn-xs"
                                   href="catalogosHospitales/editar?p=<?php echo $buscar['p']; ?>&id=<?php echo $catalogo['id']; ?>">
                                    <span class="glyphicon glyphicon-cog"></span>
                                    Editar
                                </a>
                            <?php endif; ?>
                            <?php if (hasPermission('catalogos_hospitales_eliminar')): ?>
                                <a class="btn btn-danger btn-xs" 
                                   onclick='return confirm("Está seguro de eliminar el siguiente registro?")'
                                   title="Borrar catalogo" 
                                   href="<?php echo url_format('catalogosHospitales/delete', array('id' => $catalogo['id'], 'p' => $buscar['p'] )); ?>">
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
        <?php if (hasPermission('catalogos_hospitales_nuevo')): ?>
            <a href="<?php echo url_format('catalogosHospitales/nuevo') ?>" class="btn btn-success btn-sm">
                <span class="glyphicon glyphicon-book"></span>
                Nuevo catalogo
            </a>
        <?php endif; ?>
    </div>

</div>
