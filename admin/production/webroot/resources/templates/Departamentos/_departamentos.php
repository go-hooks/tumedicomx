<?php
    if(!isset($opcion_plantilla)):
        exit;
    endif;
?>

<?php if($opcion_plantilla == 'muestra_listado'): ?>
<div id="departamentolist">
    <div class="tool-bar">
    <?php if (isset($sMsgNotice)): ?>
        <div id="close_notice" class="notice">
            <span style="clear:both; float:right; top:3px;">
                <a href="#" onclick="javascript: $('#close_success').fadeOut();"><img src="<?php echo URL_IMAGES ?>img_close_search.gif" style="border:none;"; /></a>
            </span>
            <?php echo $sMsgNotice ?>
        </div>
    <?php endif; ?>
    <?php if (isset($msg_success)): ?>
        <div id="close_success" class="success">
            <span style="clear:both; float:right; top:3px;">
                <a href="#" onclick="javascript: $('#close_success').fadeOut();"><img src="<?php echo URL_IMAGES ?>img_close_search.gif" style="border:none;"; /></a>
            </span>
            <?php echo $msg_success ?>
        </div>
    <?php endif; ?>
    <?php if (isset($msg_unsuccess)): ?>
        <div id="close_unsuccess" class="unsuccess">
            <span style="clear:both; float:right; top:3px;">
                <a href="#" onclick="javascript: $('#close_success').fadeOut();"><img src="<?php echo URL_IMAGES ?>img_close_search.gif" style="border:none;"; /></a>
            </span>
            <?php echo $msg_unsuccess ?>
        </div>
    <?php endif; ?>
        <span class="title">Lista de grupos&nbsp;&nbsp;</span>
    <?php if (hasPermission('perm_crear')): ?>
        <a href="<?php echo url_format('departamentos/nuevo') ?>">Agregar nuevo grupo</a>
    <?php endif; ?>
    </div>

    <table class="tableList" cellpadding="0" cellspacing="1">
        <thead>
            <tr>
                <th scope="col">NOMBRE DEL GRUPO</th>
                <th scope="col">STATUS</th>
                <th scope="col">PERMISOS</th>
                <th scope="col">&nbsp;</th>
                <th scope="col">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($aDepartamentos as $i => $departamento): ?>
            <tr <?php echo fmod($i, 2) ? 'class="odd"' : '' ?>>
                <td width="250"><a href="<?php echo url_format('departamentos/editar', array('departamento_id' => $departamento['id'])) ?>"><?php echo $departamento['nombre'] ?></a></td>
                <td><?php echo departamentos_nombre_estado($departamento['estado']); ?></td>
                <td align="center"><a href="<?php echo url_format('permisos-departamento/departamento' , array('departamento_id' => $departamento['id'])); ?>">ver</a></td>
                <td width="12">
                <?php if (hasPermission('perm_modificar')): ?>
                    <a href="<?php echo url_format('departamentos/editar', array('departamento_id' => $departamento['id'])) ?>">
                        <img src="<?php echo URL_IMAGES ?>edit.gif" alt="Editar" title="Editar" /></a>
                <?php endif; ?>
                </td>
                <td width="12">
                <?php if (hasPermission('perm_eliminar_grupos')): ?>
                    <a href="<?php echo url_format('departamentos/eliminar', array('departamento_id' => $departamento['id'])) ?>" onclick="return confirm('¿Esta seguro de querer eliminar a este grupo: <?php echo $departamento['nombre'] ?>?');">
                        <img src="<?php echo URL_IMAGES ?>ico_borrar.gif" alt="Eliminar" />
                    </a>
                <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php endif; ?>


