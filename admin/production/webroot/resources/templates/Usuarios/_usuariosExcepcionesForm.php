<div id="servicioslist">
    <div class="tool-bar">
        <span class="title">Nueva excepci&&oacute;n&nbsp;&nbsp;</span>
        <a href="<?php echo url_format('usuarios/configuracion', array('usuario' => $id)) ?>">Regresar</a>
    </div>
    </div>
    <div class="base-form">
        <div class="top-form"></div>
        <div class="content-form">
            <?php if (isset($msg_error)): ?>
                <div id="close_success" class="success">
                    <span style="clear:both; float:right; top:3px;">
                        <a href="#" onclick="Effect.Fade('close_success'); return false;"><img src="<?php echo URL_IMAGES ?>img_close_search.gif" style="border:none;"; /></a>
                    </span>
                    <?php echo $msg_error ?>
                </div>
            <?php endif; ?>
            <form id="excepcionform" name="excepcionform" action="<?php echo url_format('usuarios/crear-excepcion') ?>" method="post">
                <?php if(isset($id)): ?>
                    <input type="hidden" id="h_usuario_id" name="excepcion[id]" value="<?php echo $id ?>" />
                <?php endif; ?>
                
                <fieldset>
                    <legend>Datos de la excepci&oacute;n</legend><br/>
                    <label for="fecha_inicio">Fecha inicio:</label>
                    <input type="text" class="required textField" id="fecha_inicio" name="horario[fecha_inicio]" readonly="readonly" value="<?php echo isset($fecha_inicio) ? $fecha_inicio : ''; ?>" />
                    
                    <label for="fecha_vencimiento">Fecha vencimiento:</label>
                    <input type="text" class="required textField" id="fecha_vencimiento" name="horario[fecha_vencimiento]" readonly="readonly" value="<?php echo isset($fecha_vencimiento) ? $fecha_vencimiento : ''; ?>" />

                    <label for="incluir_hora">Incluir hora:</label>
                    <select name="horario[incluir_hora]" id="incluir_hora" class="dropDown">
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                </fieldset>

                <fieldset id="horario">
                    <label for="hora">Hora inicio:</label>
                    <div class="vHora">
                        <select name="horario[hora_inicio]" id="hora_inicio" class="dropDown">
                            <?php foreach($aHoras as $indice => $hora): ?>
                                <?php if(isset($horario_hora) && $horario_hora == $indice): ?>
                                <option value="<?php echo $indice ?>" selected="selected"><?php echo $hora ?></option>
                                <?php else: ?>
                                <option value="<?php echo $indice ?>"><?php echo $hora ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <div class="formFieldContent">
                            <select name="horario[minuto_inicio]" id="minuto_inicio" class="dropDown">
                                <?php foreach($aMinutos as $indice => $minuto): ?>
                                    <?php if(isset($horario_minuto) && $horario_minuto == $indice): ?>
                                    <option value="<?php echo $indice ?>" selected="selected"><?php echo $minuto ?></option>
                                    <?php else: ?>
                                    <option value="<?php echo $indice ?>"><?php echo $minuto ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>

                            <label><input class="inputRadio" name="horario[hora_turno_inicio]" id="hora_am" value="0" <?php echo !isset($horas) ? 'checked="checked"' : '' ?>  <?php echo (isset($horas) && $horas == 'am') ? 'checked="checked"' : '' ?> type="radio">&nbsp;am</label>
                            <label><input class="inputRadio" name="horario[hora_turno_inicio]" id="hora_pm" value="12" type="radio" <?php echo (isset($horas) && $horas == 'pm') ? 'checked="checked"' : '' ?>>&nbsp;pm</label>
                        </div>
                    </div>

                    <label for="hora">Hora finalizaci&oacute;n:</label>
                    <div class="vHora">
                        <select name="horario[hora_finalizacion]" id="hora_finalizacion" class="dropDown">
                            <?php foreach($aHoras as $indice => $hora): ?>
                                <?php if(isset($horario_hora) && $horario_hora == $indice): ?>
                                <option value="<?php echo $indice ?>" selected="selected"><?php echo $hora ?></option>
                                <?php else: ?>
                                <option value="<?php echo $indice ?>"><?php echo $hora ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <div class="formFieldContent">
                            <select name="horario[minuto_finalizacion]" id="minuto_finalizacion" class="dropDown">
                                <?php foreach($aMinutos as $indice => $minuto): ?>
                                    <?php if(isset($horario_minuto) && $horario_minuto == $indice): ?>
                                    <option value="<?php echo $indice ?>" selected="selected"><?php echo $minuto ?></option>
                                    <?php else: ?>
                                    <option value="<?php echo $indice ?>"><?php echo $minuto ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>

                            <label><input class="inputRadio" name="horario[hora_turno_finalizacion]" id="hora_am" value="0" <?php echo !isset($horas) ? 'checked="checked"' : '' ?>  <?php echo (isset($horas) && $horas == 'am') ? 'checked="checked"' : '' ?> type="radio">&nbsp;am</label>
                            <label><input class="inputRadio" name="horario[hora_turno_finalizacion]" id="hora_pm" value="12" type="radio" <?php echo (isset($horas) && $horas == 'pm') ? 'checked="checked"' : '' ?>>&nbsp;pm</label>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="submit"> <!-- Submit -->
                    <input type="submit" class="submit" value="Guardar" />
                    <input type="reset" id="btn_reset" value="Reset" />
                </fieldset> <!-- Fin Submit --><br />

                
                <fieldset class="form-notes"> <!-- Notas -->
                    <p><small>
                            <strong>Notas: </strong>Los campos con asterisco (*) son obligatorios.</small>
                    </p><br />
                </fieldset> <!-- Fin Notas -->
            </form>
        </div>
        <div class="bottom-form"></div>
</div>
<script type="text/javascript">
    var calendario_menor = Calendar.setup({
        inputField  : "fecha_inicio",
        ifFormat    : "%Y-%m-%d"
    });
    var calendario_menor = Calendar.setup({
        inputField  : "fecha_vencimiento",
        ifFormat    : "%Y-%m-%d"
    });
    
</script>