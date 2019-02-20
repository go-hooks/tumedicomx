<div class="row">

    <div class="col-sm-10">

        
        <form enctype="multipart/form-data" action="<?php echo url_format('invasivos') ?>" method="get">

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
                    <th>Banner</th>
                    <th>Cliente</th>
                    <th>Localizacion</th>
                    <th>Inicio</th>
                    <th>Fin</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($invasivos as $banner): ?>
                    <tr>
                        
                        <td>
                        
                            <?php if (!empty($banner['imagen'])): ?>
                                <img src="<?php echo URL_APP . "uploads/images/" . $banner['imagen'] ?>"  class="img-responsive img-thumbnail" width="100"/>
                            <?php endif; ?>
                        
                        </td>                                                

                        <td>
                            <?php echo $banner['cliente'] ?>
                        </td>
                        
                        <td>
                            <?php echo strtoupper($banner['localizacion']) ?>
                        </td>

                        <td>
                            <?php echo date( "d-m-Y", strtotime($banner['fecha_inicio'] )); ?>
                        </td>

                        <td>
                            <?php echo date( "d-m-Y", strtotime($banner['fecha_fin'] )); ?>
                        </td>
                        
                        <td>
                            <?php if (hasPermission('invasivos_editar')): ?>
                                <a class="btn btn-primary btn-xs"
                                   href="invasivos/editar?p=<?php echo $buscar['p']; ?>&id=<?php echo $banner['id']; ?>">
                                    <span class="glyphicon glyphicon-cog"></span>
                                    Editar
                                </a>
                            <?php endif; ?>
                            <?php if (hasPermission('invasivos_eliminar')): ?>
                                <a class="btn btn-danger btn-xs" 
                                   onclick='return confirm("Está seguro de eliminar el siguiente registro?")'
                                   title="Borrar banner" 
                                   href="<?php echo url_format('invasivos/delete', array('id' => $banner['id'], 'p' => $buscar['p'] )); ?>">
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
        
         
        
        
        <?php if (hasPermission('invasivos_nuevo')): ?>
            <a href="<?php echo url_format('invasivos/nuevo') ?>" class="btn btn-success btn-sm">
                <span class="glyphicon glyphicon-book"></span>
                Nuevo banner
            </a>
        <?php endif; ?>
    </div>

</div>
