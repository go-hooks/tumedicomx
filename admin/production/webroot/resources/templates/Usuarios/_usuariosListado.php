<div class="row">
<div class="col-sm-10">


    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nombre de usuario</th>
                <th>Email</th>
                <th>Status</th>
                <th>Grupo</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($aUsuarios as $i => $aUsuario): ?>
            <tr <?php echo fmod($i, 2) ? 'class="odd"' : '' ?>>
                <td><?php echo ($i + 1) ?></td>
                <td><?php echo $aUsuario['nombre_completo'] ?></td>
                <td><?php echo $aUsuario['email'] ?></td>
                <td><?php echo $aUsuario['status'] ?></td>
                <td><?php echo $aUsuario['departamento_nombre'] ?></td>
                <td align="center">
                <?php if ($aUsuario['estado'] == 'A'): ?>
                    <a class="btn btn-xs btn-success" href="<?php echo url_format('permisos/usuarios', array('usuario' => $aUsuario['id'])) ?>"> <span class="glyphicon glyphicon-eye-open"></span> Ver permisos</a>
                <?php else: ?>-<?php endif; ?>
                <?php if (hasPermission('perm_modificar')): ?>
                    <a class="btn btn-xs btn-primary" href="<?php echo url_format('usuarios/editar', array('usuario' => $aUsuario['id'])) ?>">
                         <span class="glyphicon glyphicon-cog"></span> Editar
                    </a>
                <?php endif; ?>
                <?php if (hasPermission('perm_eliminar')): ?>
                    <a class="btn btn-xs btn-danger" href="<?php echo url_format('usuarios/eliminar', array('usuario' => $aUsuario['id'])) ?>" onclick="return confirm('Esta seguro de querer eliminar a este usuario: <?php echo $aUsuario['nombre_completo'] ?>');">
                        <span class="glyphicon glyphicon-remove"></span> Borrar
                    </a>
                <?php endif; ?>
                </td>
                
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="col-sm-2 next-2-table">
    <?php if (hasPermission('perm_crear')): ?>
        <a class="btn btn-primary" href="<?php echo url_format('usuarios/nuevo') ?>">
        	<span class="glyphicon glyphicon-user"></span> Nuevo usuario
    	</a>
    <?php endif; ?>
</div>

</div>