<div class="userList">
    <div class="tool-bar">
        <span class="title"><?php echo $label_titulo ?>&nbsp;&nbsp;</span>
        <a href="<?php echo $url_regresar ?>"><?php echo $label_regresar?></a>
    </div>
    
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

    <form action="<?php echo $url_action_form ?>" name="permForm" method="post">
    <?php foreach ($campos_ocultos as $nombre => $valor): ?>
        <input type="hidden" name="<?php echo $nombre ?>" value="<?php echo $valor ?>" />
    <?php endforeach; ?>
        <table class="tableList" cellpadding="0" cellspacing="1">
            <thead>
                <tr>
                    <th scope="col"><a href="#">PERMISO</a></th>
                    <th scope="col" width="60">PERMITIR</th>
                    <th scope="col" width="60">NEGAR</th>
                    <th scope="col" width="100">SIN ASIGNAR</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td colspan="8" align="right">
                        <input type="submit" value="Guardar" class="btn btn-default" />
                    </td>
                </tr>
            </tfoot>
            <tbody>
            <?php foreach ($vec_permisos as $clave => $p): ?>
                <tr>
                    <td>
                        <?php echo $p["nombre"] ?>
                    </td>
                    <td align="center">
                        <input type="radio" id="perm_<?php echo $p['id'] ?>_1" name="perm_<?php echo $p['id'] ?>" value="1" <?php if (@$permisos[$p['key']]['valor'] === true): ?>checked="checked"<?php endif; ?> /></td>
                    <td align="center">
                        <input type="radio" id="perm_<?php echo $p['id'] ?>_0" name="perm_<?php echo $p['id'] ?>" value="0" <?php if (@$permisos[$p['key']]['valor'] === false): ?>checked="checked"<?php endif; ?> /></td>
                    <td style="background-color:#F9FAFD;" align="center">
                        <input type="radio" id="perm_<?php echo $p['id'] ?>_x" name="perm_<?php echo $p['id'] ?>" value="x" <?php if (!array_key_exists($p['key'], $permisos)): ?>checked="checked"<?php endif; ?> />
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <p><small><?php $label_legend ?></small></p>
    </form>
</div>
