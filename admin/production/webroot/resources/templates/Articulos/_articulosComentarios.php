<div class="row">

    <div class="col-sm-10">
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Comentario</th>
                    <th> </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($comentarios as $comentario): ?>
                    <tr>

                        <td><b><?php echo date('d/m/Y', strtotime($comentario['fecha'])) ?></b></td>
                        <td><b><?php echo $comentario['nombre'] ?></b></td>
                        <td><?php echo $comentario['email'] ?></td>
                        <td><?php echo html_entity_decode($comentario['comentario'])  ?></td>
                        
                         
                        <td>
                            <?php if (hasPermission('articulos_eliminar')): ?>
                                <a class="btn btn-danger btn-xs" 
                                   onclick='return confirm("Está seguro de eliminar el siguiente registro?")'
                                   title="Borrar comentario" 
                                   href="<?php echo url_format('articulos/deleteComentario', array('id' => $articulo['id'], 'comentario_id' => $comentario['id'], 'p' => $buscar['p'] )); ?>">
                                   <span class="glyphicon glyphicon-remove"></span> &nbsp;Borrar
                                </a>
                            <?php endif; ?>
                        </td>
                        
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>


</div>
