<div class="row">

    <div class="col-sm-10">

        <form enctype="multipart/form-data" class="form-horizontal" role="form" action="<?php echo url_format('proveedores') ?>" method="get">

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

                <a href="<?php echo url_format('proveedores/exportar') ?>" class="btn btn-success btn-sm">
                    <span class="glyphicon glyphicon-book"></span>
                    Exportar
                </a>
                    
                </div>  


        </form>
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Proveedor</th>
                    <th>Sitio</th>                      
                    <th>Estatus</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($proveedores as $proveedor): ?>
                    <tr>
                        <td><b><?php echo $proveedor['nombre'] ?></b></td>

                        <?php
                        
                            $sitio='Inactivo';
                            
                            if($proveedor['pagado']){
                                $sitio='Activo';
                            }
                            
                            $estatus='Pendiente';
                            
                            if($proveedor['autorizado']){
                                $estatus='Autorizado';
                            }
                            
                        ?>
                        <td><b><?php echo $sitio ?></b></td>
                        
                        <td><b><?php echo $estatus ?></b></td>
                        
                        
                        <td>
                            <?php if (hasPermission('proveedores_editar')): ?>

                                <a class="btn btn-success btn-xs"
                                   href="proveedores/datos?p=<?php echo $buscar['p']; ?>&id=<?php echo $proveedor['id']; ?>">
                                    <span class="glyphicon  glyphicon-th-large"></span>
                                    Aseguradoras y Tarjetas
                                </a>                                
                            
                                <a class="btn btn-success btn-xs"
                                   href="proveedores/sitio?p=<?php echo $buscar['p']; ?>&id=<?php echo $proveedor['id']; ?>">
                                    <span class="glyphicon  glyphicon-tags"></span>
                                    Sitio
                                </a>                                                        
                            
                                <a class="btn btn-primary btn-xs"
                                   href="proveedores/editar?p=<?php echo $buscar['p']; ?>&id=<?php echo $proveedor['id']; ?>">
                                    <span class="glyphicon glyphicon-cog"></span>
                                    Editar
                                </a>
                            
                            <?php endif; ?>
                            <?php if (hasPermission('proveedores_eliminar')): ?>
                                <a class="btn btn-danger btn-xs" 
                                   onclick='return confirm("Está seguro de eliminar el siguiente registro?")'
                                   title="Borrar proveedor" 
                                   href="<?php echo url_format('proveedores/delete', array('id' => $proveedor['id'], 'p' => $buscar['p'] )); ?>">
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
        <?php if (hasPermission('proveedores_nuevo')): ?>
            <a href="<?php echo url_format('proveedores/nuevo') ?>" class="btn btn-success btn-sm">
                <span class="glyphicon glyphicon-book"></span>
                Nuevo proveedor
            </a>
        <?php endif; ?>
    </div>

</div>
