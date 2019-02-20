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
<div class="row">
	<form action="<?php echo $url_action_form ?>" name="permForm" method="post">
	<div class="userList col-sm-6">
		
	        <?php foreach ($campos_ocultos as $nombre => $valor): ?>
	            <input type="hidden" name="<?php echo $nombre ?>" value="<?php echo $valor ?>" />
	        <?php endforeach; ?>
	        <table class="table table-striped">
	            <thead>
	                <tr>
	                    <th><a href="#">Permiso</a></th>
	                    <th>Permitir</th>
	                    <th>Negar</th>
	                    <th>Heredado</th>
	                </tr>
	            </thead>
	            <tbody>
	                <?php foreach ($vec_permisos as $clave => $p): ?>
	                    <tr>
	                        <td>
	                            <?php echo $p["nombre"] ?>
	                        </td>
	                        <td>
	                            <input type="radio" id="perm_<?php echo $p['id'] ?>_1" name="perm_<?php echo $p['id'] ?>" value="1" <?php if (@$permisos[$p['key']]['valor'] === true && $permisos[$p['key']]['heredado'] !== true): ?>checked="checked"<?php endif; ?> /></td>
	                        <td>
	                            <input type="radio" id="perm_<?php echo $p['id'] ?>_0" name="perm_<?php echo $p['id'] ?>" value="0" <?php if (@$permisos[$p['key']]['valor'] === false && $permisos[$p['key']]['heredado'] !== true): ?>checked="checked"<?php endif; ?> /></td>
	                        <td style="background-color:#F9FAFD;">
	                            <input type="radio" id="perm_<?php echo $p['id'] ?>_x" name="perm_<?php echo $p['id'] ?>" value="x" <?php if (@$permisos[$p['key']]['heredado'] === true || !array_key_exists($p['key'], $permisos)): ?>checked="checked"<?php endif; ?> />
	                            <?php if (@$permisos[$p['key']]['heredado'] === true): ?> 
	                                <?php if (@$permisos[$p['key']]['valor'] === true): ?>
	                                    &nbsp;(Permitido)
	                                <?php else: ?>
	                                    &nbsp;(Negado)
	                                <?php endif; ?> 
	                            <?php endif; ?>
	                        </td>
	                    </tr>
	                <?php endforeach; ?>
	            </tbody>
	        </table>
	        <p><small><?php $label_legend ?></small></p>
	</div>
	<div class="col-sm-3 next-2-table">
		 <input type="submit" value="Guardar" class="btn btn-success" />
		 <a href="<?php echo url_format('usuarios')?>" class="btn btn-default btn-sm" >
		 	<span class="glyphicon glyphicon-list"></span>
		 	Listado de Usuarios
	 	</a>
	</div>
</form>
</div>