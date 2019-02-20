<div id="departamentolist">
    <div class="tool-bar">
    <?php if (isset($id)): ?>
        <span class="title">Modificar grupo&nbsp;&nbsp;</span>
    <?php else: ?>
        <span class="title">Nuevo grupo&nbsp;&nbsp;</span>
    <?php endif; ?>
    <a href="<?php echo url_format('departamentos/listado') ?>">Lista de grupos</a>
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
            <form name="form_registro" id="form_registro" action="<?php echo url_format('departamentos/' . (isset($id) ? 'modificar' : 'crear' )) ?><?php echo (isset($id) ? 'departamento_id='.$id : '' )  ?>"  method="post">
                <?php if (isset($id)): ?>
                    <input type="hidden" id="h_departamento_id" name="departamento[id]" value="<?php echo $id ?>" />
                <?php endif; ?>
                <fieldset> <!-- Pestanas -->
                    <legend>Datos del grupo</legend><br />
                    <label for="nombre">*&nbsp;Nombre:</label>
                    <input type="text" maxlength="255" value="<?php echo isset($nombre) ? $nombre : '' ?>" class="textField large" title=" " id="nombre" name="departamento[nombre]" required />
                    <label for="estado">*&nbsp;Estado:</label>
                    <select class="dropDown large" id="estado" name="departamento[estado]">
                        <?php
                        $estados = departamentos_estado();
                        foreach($estados as $clave => $contenido){
                            if($clave != 'E'){
                                echo '<option value="'.$clave.'" '.($estado == $clave ? 'selected="selected"' : '').'>'.$contenido.'</option>';
                            }
                        }
                        ?>
                    </select>
                </fieldset>

                <fieldset class="submit"> <!-- Submit -->
                    <input type="submit" class="btn btn-default" value="Guardar" />
                    <input type="reset" value="Limpiar" class="btn btn-default" />
                    <p>&nbsp;</p>
                    <div id="respuesta"></div>
                </fieldset> <!-- Fin Submit --><br />
                <fieldset class="form-notes"> <!-- Notas -->
                    <p>
                        <small><strong>Notas: </strong>Los campos con asterisco (*) son obligatorios.</small>
                    </p><br />
                </fieldset> <!-- Fin Notas -->
            </form>
        </div>
        <div class="bottom-form"></div>
      </div>
</div>
