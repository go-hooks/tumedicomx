<div id="userlist">
    <div class="tool-bar">
        <?php if (isset($id)): ?>
            <span class="title">Modificar usuario </span>
        <?php else: ?>
            <span class="title">Nuevo usuario </span>
        <?php endif; ?>
        <a href="<?php echo url_format('usuarios/listado') ?>">Lista de usuarios</a>
    </div>
    <div class="base-form">
        <div class="top-form"></div>
        <div class="content-form">
            <?php if (isset($msg_error)): ?>
                <div id="close_success" class="success">
                    <span style="clear:both; float:right; top:3px;">
                        <a href="#" onclick="javascript: $('#close_success').fadeOut();"><img src="<?php echo URL_IMAGES ?>img_close_search.gif" style="border:none;"; /></a>
                    </span>
                    <?php echo $msg_error ?>
                </div>
            <?php endif; ?>

            <form id="form_registro" name="form_registro" action="<?php echo url_format('usuarios/' . (isset($id) ? 'modificar' : 'crear' )) ?>" method="post">
                <?php if (isset($id)): ?>
                    <input type="hidden" id="h_usuario_id" name="usuario[id]" value="<?php echo $id ?>" />
                <?php endif; ?>
                <?php if (isset($departamento_id)): ?>
                    <input type="hidden" id="h_departamento_id" value="<?php echo $departamento_id ?>" />
                <?php endif; ?>

                <fieldset>
                    <legend>Datos personales</legend><br/>

                    <label for="nombre">*&nbsp;Nombre:</label>
                    <input type="text" maxlength="100" value="<?php echo isset($nombre) ? $nombre : '' ?>" class="textField large" title=" " id="nombre" name="usuario[nombre]" required />

                    <label for="apell_paterno">Apellido paterno:</label>
                    <input type="text" maxlength="255" value="<?php echo isset($apell_paterno) ? $apell_paterno : ''; ?>" class="textField large" id="apell_paterno" name="usuario[apell_paterno]" />

                    <label for="apell_materno">Apellido materno:</label>
                    <input type="text" maxlength="255" value="<?php echo isset($apell_materno) ? $apell_materno : '' ?>" class="textField large" id="apell_materno" name="usuario[apell_materno]" />

                    <label for="auth_usuario">*&nbsp;Usuario:</label>
                    <input type="text" maxlength="255" value="<?php echo isset($auth_usuario) ? $auth_usuario : '' ?>" class="valid-user textField large"  title=" " id="auth_usuario" name="usuario[auth_usuario]" autocomplete="off" required /><div style="display: none;" id="txt_valid_user" class="validation-advice"></div>
                    <label for="auth_password"><sup>1</sup>&nbsp;*&nbsp;Contrase&ntilde;a:</label>
                    <input type="password" maxlength="255" value="" class="valid-pass textField large" title=" " id="auth_password" name="usuario[auth_password]" autocomplete="off" <?php echo(!isset($id)) ? 'required' : '' ?> />

                    <label for="auth_confirm_password">*&nbsp;Confirmar contrase&ntilde;a:</label>
                    <input type="password" maxlength="255" value=""  class="confirm-pass textField large" id="auth_confirm_password" name="usuario[auth_confirm_password]" autocomplete="off" <?php echo(!isset($id)) ? 'required' : '' ?> />

                    <?php if (isset($id)): ?>
                        <div class="form-info-notes">Deje los campos en blanco para conservar su contrase&ntilde;a actual.</div>
                    <?php endif; ?>

                    <label for="departamento_id">*&nbsp;Grupo:</label>

                    <select class="validate-dropdown dropDown large" id="departamento_id" name="usuario[departamento_id]">
                        <?php foreach ($aDepartamentos as $aDepto): ?>
                            <option value="<?php echo $aDepto['id'] ?>" <?php echo (isset($departamento_id) && $departamento_id == $aDepto['id']) ? 'selected="selected"' : '' ?>>
                                <?php echo $aDepto['nombre'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <?php if(FALSE):?>
                    <span style="display: <?php echo(!isset($departamento_id) || $departamento_id != '27') ? '' : 'none' ?>" id="combo_asistentes">
                        <label for="estado">*&nbsp;Asistente:</label>
                        <select class="dropDown large" id="asistente" name="usuario[asistente]">
                            <option value="">Selecciona un asistente en caso de requerirlo</option>
                            <?php foreach ($asistentes as $i => $asistente): ?>
                                <option value="<?php echo $asistente['id'] ?>"><?php echo $asistente['nombre'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </span>
                    <?PHP endif;?>

                    <label for="email">*&nbsp;Correo electr&oacute;nico:</label>
                    <input type="text" maxlength="255" value="<?php echo isset($email) ? $email : '' ?>" class="textField large" id="email" name="usuario[email]" required />

                    <label for="tel_movil">Tel&eacute;fono fijo:</label>
                    <input type="text" maxlength="255" value="<?php echo isset($tel_oficina) ? $tel_oficina : '' ?>" class="textField large" id="tel_movil" name="usuario[tel_oficina]" />

                    <label for="tel_movil">Tel&eacute;fono m&oacute;vil:</label>
                    <input type="text" maxlength="255" value="<?php echo isset($tel_movil) ? $tel_movil : '' ?>" class="textField large" id="tel_movil" name="usuario[tel_movil]" />
                    <?php if(FALSE): ?>
                    <label for="estado">Estado:</label>
                    <select class="dropDown large" id="estado" name="usuario[estado]">
                        <?php foreach ($aEstados as $clave => $status): ?>
                            <option value="<?php echo $clave ?>" <?php echo $estado == $clave ? 'selected="selected"' : '' ?>><?php echo $status ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php endif;?>
                </fieldset>


                <fieldset class="submit">
                    <input type="submit" value="Guardar" class="btn btn-default" /> 
                    <input type="reset" value="Limpiar" class="btn btn-default" />
                    <p>&nbsp;</p>
                    <div id="respuesta"></div>
                </fieldset>

                <fieldset class="form-notes">
                    <p>
                        <strong>Notas:</strong><br />
                        *&nbsp; Los campos con un asterisco (*) son obligatorios.<br />
                    </p><br />
                </fieldset>
            </form>
        </div>
        <div class="bottom-form"></div>
    </div>
</div>
