<div id="servicioslist">
    <div class="tool-bar">
        <span class="title">configuraci&oacute;n: <?php echo $nombre_completo ?></span>
        <a href="<?php echo url_format('usuarios/listado') ?>">Listado de usuarios</a>
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
            <form id="grupoform" name="grupoform" action="<?php echo url_format('usuarios/modificar-configuracion') ?>" method="post">
                <?php if (isset($id)): ?>
                    <input type="hidden" id="h_usuario_id" name="usuario[id]" value="<?php echo $id ?>" />
                <?php endif; ?>
                
                <fieldset>
                    <legend>Datos de la configuraci&oacute;n</legend><br/>
                </fieldset>

                
                <hr /><br style="clear:both;" />
                <fieldset><!-- LUNES -->
                    <label for="hora">&nbsp;</label>
                    <input name="horario[lunes]" class="textField" id="Lun" value="1" type="checkbox" <?php if($aConfiguracion['DL-LU']) echo 'checked="checked"'; ?>>&nbsp;&nbsp;Lunes
                    <label for="hora">Hora de entrada:</label>
                    <div class="vHora">
                        <select name="horario[hora_entrada_lunes]" id="hora_entrada_lunes" class="dropDown">
                            <?php foreach($aHoras as $indice => $hora): ?>
                                <?php if(isset($hora_entrada_lunes) && $hora_entrada_lunes == $indice): ?>
                                <option value="<?php echo $indice ?>" selected="selected"><?php echo $hora ?></option>
                                <?php else: ?>
                                <option value="<?php echo $indice ?>"><?php echo $hora ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <div class="formFieldContent">
                            <select name="horario[minuto_entrada_lunes]" id="minuto_entrada_lunes" class="dropDown">
                                <?php foreach($aMinutos as $indice => $minuto): ?>
                                    <?php if(isset($minutos_entrada_lunes) && $minutos_entrada_lunes == $indice): ?>
                                    <option value="<?php echo $indice ?>" selected="selected"><?php echo $minuto ?></option>
                                    <?php else: ?>
                                    <option value="<?php echo $indice ?>"><?php echo $minuto ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>

                            <label><input class="inputRadio" name="horario[hora_turno_entrada_lunes]" id="hora_am_entrada_lunes" value="0" type="radio" <?php echo ($turno_entrada_lunes == 'am') ? 'checked="checked"' : '' ?>>&nbsp;am</label>
                            <label><input class="inputRadio" name="horario[hora_turno_entrada_lunes]" id="hora_pm_entrada_lunes" value="12" type="radio" <?php echo ($turno_entrada_lunes == 'pm') ? 'checked="checked"' : '' ?>>&nbsp;pm</label>
                        </div>
                    </div>
                    <label for="hora">Hora de salida:</label>
                    <div class="vHora">
                        <select name="horario[hora_salida_lunes]" id="hora_salida_lunes" class="dropDown">
                            <?php foreach($aHoras as $indice => $hora): ?>
                                <?php if(isset($hora_salida_lunes) && $hora_salida_lunes == $indice): ?>
                                <option value="<?php echo $indice ?>" selected="selected"><?php echo $hora ?></option>
                                <?php else: ?>
                                <option value="<?php echo $indice ?>"><?php echo $hora ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <div class="formFieldContent">
                            <select name="horario[minuto_salida_lunes]" id="minuto_salida_lunes" class="dropDown">
                                <?php foreach($aMinutos as $indice => $minuto): ?>
                                    <?php if(isset($minutos_salida_lunes) && $minutos_salida_lunes == $indice): ?>
                                    <option value="<?php echo $indice ?>" selected="selected"><?php echo $minuto ?></option>
                                    <?php else: ?>
                                    <option value="<?php echo $indice ?>"><?php echo $minuto ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>

                            <label><input class="inputRadio" name="horario[hora_turno_salida_lunes]" id="hora_am_salida_lunes" value="0" <?php echo (isset($turno_salida_lunes) && $turno_salida_lunes == 'am') ? 'checked="checked"' : '' ?> type="radio">&nbsp;am</label>
                            <label><input class="inputRadio" name="horario[hora_turno_salida_lunes]" id="hora_pm_salida_lunes" value="12" type="radio" <?php echo (isset($turno_salida_lunes) && $turno_salida_lunes == 'pm') ? 'checked="checked"' : '' ?>>&nbsp;pm</label>
                        </div>
                    </div>
                    
                    <label for="hora">Hora de descanso:</label>
                    <select name="horario[descanzo_lunes]" id="descanzo_lunes" class="dropDown" onchange="activa_desactiva('descanzo_lunes', 'descanzo_laboral_lunes')">
                        <option value="1" <?php if($aConfiguracion['HL-DES-LU'] == 0) echo 'selected="selected"'; ?>>No</option>
                        <option value="2" <?php if($aConfiguracion['HL-DES-LU'] == 1) echo 'selected="selected"'; ?>>Si</option>
                    </select>

                </fieldset>

                <fieldset id="descanzo_laboral_lunes">

                    <label for="hora">Hora salida:</label>
                    <div class="vHora">
                        <select name="horario[receso_salida_lunes]" id="receso_salida_lunes" class="dropDown" <?php if($aConfiguracion['HL-DES-LU'] == 0) echo 'disabled="disabled"'; ?>>
                            <?php foreach($aHoras as $indice => $hora): ?>
                                <?php if(isset($hora_receso_salida_lunes) && $hora_receso_salida_lunes == $indice): ?>
                                <option value="<?php echo $indice ?>" selected="selected"><?php echo $hora ?></option>
                                <?php else: ?>
                                <option value="<?php echo $indice ?>"><?php echo $hora ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <div class="formFieldContent">
                            <select name="horario[minuto_receso_salida_lunes]" id="minuto_receso_salida_lunes" class="dropDown" <?php if($aConfiguracion['HL-DES-LU'] == 0) echo 'disabled="disabled"'; ?>>
                                <?php foreach($aMinutos as $indice => $minuto): ?>
                                    <?php if(isset($minuto_receso_salida_lunes) && $minuto_receso_salida_lunes == $indice): ?>
                                    <option value="<?php echo $indice ?>" selected="selected"><?php echo $minuto ?></option>
                                    <?php else: ?>
                                    <option value="<?php echo $indice ?>"><?php echo $minuto ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>

                            <label><input class="inputRadio" <?php if($aConfiguracion['HL-DES-LU'] == 0) echo 'disabled="disabled"'; ?> name="horario[receso_turno_salida_lunes]" id="receso_am_salida_lunes" value="0" type="radio" <?php echo (isset($turno_receso_salida_lunes) && $turno_receso_salida_lunes == 'am') ? 'checked="checked"' : '' ?>>&nbsp;am</label>
                            <label><input class="inputRadio" <?php if($aConfiguracion['HL-DES-LU'] == 0) echo 'disabled="disabled"'; ?> name="horario[receso_turno_salida_lunes]" id="receso_pm_salida_lunes" value="12" type="radio" <?php echo (!isset($turno_receso_salida_lunes) || $turno_receso_salida_lunes == 'pm') ? 'checked="checked"' : '' ?>>&nbsp;pm</label>
                        </div>
                    </div>

                    <label for="hora">Hora entrada:</label>
                    <div class="vHora">
                        <select name="horario[receso_entrada_lunes]" id="hora_receso_entrada_lunes" class="dropDown" <?php if($aConfiguracion['HL-DES-LU'] == 0) echo 'disabled="disabled"'; ?>>
                            <?php foreach($aHoras as $indice => $hora): ?>
                                <?php if(isset($hora_receso_entrada_lunes) && $hora_receso_entrada_lunes == $indice): ?>
                                <option value="<?php echo $indice ?>" selected="selected"><?php echo $hora ?></option>
                                <?php else: ?>
                                <option value="<?php echo $indice ?>"><?php echo $hora ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <div class="formFieldContent">
                            <select name="horario[minuto_receso_entrada_lunes]" id="minuto_receso_entrada_lunes" class="dropDown" <?php if($aConfiguracion['HL-DES-LU'] == 0) echo 'disabled="disabled"'; ?>>
                                <?php foreach($aMinutos as $indice => $minuto): ?>
                                    <?php if(isset($minuto_receso_entrada_lunes) && $minuto_receso_entrada_lunes == $indice): ?>
                                    <option value="<?php echo $indice ?>" selected="selected"><?php echo $minuto ?></option>
                                    <?php else: ?>
                                    <option value="<?php echo $indice ?>"><?php echo $minuto ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>

                            <label><input class="inputRadio" <?php if($aConfiguracion['HL-DES-LU'] == 0) echo 'disabled="disabled"'; ?> name="horario[receso_turno_entrada_lunes]" id="receso_am_entrada_lunes" value="0"  type="radio" <?php echo (isset($turno_receso_entrada_lunes) && $turno_receso_entrada_lunes == 'am') ? 'checked="checked"' : '' ?>>&nbsp;am</label>
                            <label><input class="inputRadio" <?php if($aConfiguracion['HL-DES-LU'] == 0) echo 'disabled="disabled"'; ?> name="horario[receso_turno_entrada_lunes]" id="receso_pm_entrada_lunes" value="12" type="radio" <?php echo (!isset($turno_receso_entrada_lunes) || $turno_receso_entrada_lunes == 'pm') ? 'checked="checked"' : '' ?>>&nbsp;pm</label>
                        </div>
                    </div>
                </fieldset><br style="clear:both;" />

                <hr /><br style="clear:both;" />
                <fieldset><!-- MARTES -->
                    <label for="hora">&nbsp;</label>
                    <input name="horario[martes]" class="textField" id="Mar" value="1" type="checkbox" <?php if($aConfiguracion['DL-MA']) echo 'checked="checked"'; ?>>&nbsp;&nbsp;Martes
                    <label for="hora">Hora de entrada:</label>
                    <div class="vHora">
                        <select name="horario[hora_entrada_martes]" id="hora_entrada_martes" class="dropDown">
                            <?php foreach($aHoras as $indice => $hora): ?>
                                <?php if(isset($hora_entrada_martes) && $hora_entrada_martes == $indice): ?>
                                <option value="<?php echo $indice ?>" selected="selected"><?php echo $hora ?></option>
                                <?php else: ?>
                                <option value="<?php echo $indice ?>"><?php echo $hora ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <div class="formFieldContent">
                            <select name="horario[minuto_entrada_martes]" id="minuto_entrada_martes" class="dropDown">
                                <?php foreach($aMinutos as $indice => $minuto): ?>
                                    <?php if(isset($minutos_entrada_martes) && $minutos_entrada_martes == $indice): ?>
                                    <option value="<?php echo $indice ?>" selected="selected"><?php echo $minuto ?></option>
                                    <?php else: ?>
                                    <option value="<?php echo $indice ?>"><?php echo $minuto ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>

                            <label><input class="inputRadio" name="horario[hora_turno_entrada_martes]" id="hora_am_entrada_martes" value="0" type="radio" <?php echo ($turno_entrada_martes == 'am') ? 'checked="checked"' : '' ?>>&nbsp;am</label>
                            <label><input class="inputRadio" name="horario[hora_turno_entrada_martes]" id="hora_pm_entrada_martes" value="12" type="radio" <?php echo ($turno_entrada_martes == 'pm') ? 'checked="checked"' : '' ?>>&nbsp;pm</label>
                        </div>
                    </div>
                    <label for="hora">Hora de salida:</label>
                    <div class="vHora">
                        <select name="horario[hora_salida_martes]" id="hora_salida_martes" class="dropDown">
                            <?php foreach($aHoras as $indice => $hora): ?>
                                <?php if(isset($hora_salida_martes) && $hora_salida_martes == $indice): ?>
                                <option value="<?php echo $indice ?>" selected="selected"><?php echo $hora ?></option>
                                <?php else: ?>
                                <option value="<?php echo $indice ?>"><?php echo $hora ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <div class="formFieldContent">
                            <select name="horario[minuto_salida_martes]" id="minuto_salida_martes" class="dropDown">
                                <?php foreach($aMinutos as $indice => $minuto): ?>
                                    <?php if(isset($minutos_salida_martes) && $minutos_salida_martes == $indice): ?>
                                    <option value="<?php echo $indice ?>" selected="selected"><?php echo $minuto ?></option>
                                    <?php else: ?>
                                    <option value="<?php echo $indice ?>"><?php echo $minuto ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>

                            <label><input class="inputRadio" name="horario[hora_turno_salida_martes]" id="hora_am_salida_martes" value="0" <?php echo (isset($turno_salida_martes) && $turno_salida_martes == 'am') ? 'checked="checked"' : '' ?> type="radio">&nbsp;am</label>
                            <label><input class="inputRadio" name="horario[hora_turno_salida_martes]" id="hora_pm_salida_martes" value="12" type="radio" <?php echo (isset($turno_salida_martes) && $turno_salida_martes == 'pm') ? 'checked="checked"' : '' ?>>&nbsp;pm</label>
                        </div>
                    </div>

                    <label for="hora">Hora de descanso:</label>
                    <select name="horario[descanzo_martes]" id="descanzo_martes" class="dropDown" onchange="activa_desactiva('descanzo_martes', 'descanzo_laboral_martes')">
                        <option value="1" <?php if($aConfiguracion['HL-DES-MA'] == 0) echo 'selected="selected"'; ?>>No</option>
                        <option value="2" <?php if($aConfiguracion['HL-DES-MA'] == 1) echo 'selected="selected"'; ?>>Si</option>
                    </select>

                </fieldset>

                <fieldset id="descanzo_laboral_martes">
                    <label for="hora">Hora salida:</label>
                    <div class="vHora">
                        <select name="horario[receso_salida_martes]" id="receso_salida_martes" class="dropDown" <?php if($aConfiguracion['HL-DES-MA'] == 0) echo 'disabled="disabled"'; ?>>
                            <?php foreach($aHoras as $indice => $hora): ?>
                                <?php if(isset($hora_receso_salida_martes) && $hora_receso_salida_martes == $indice): ?>
                                <option value="<?php echo $indice ?>" selected="selected"><?php echo $hora ?></option>
                                <?php else: ?>
                                <option value="<?php echo $indice ?>"><?php echo $hora ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <div class="formFieldContent">
                            <select name="horario[minuto_receso_salida_martes]" id="minuto_receso_salida_martes" class="dropDown" <?php if($aConfiguracion['HL-DES-MA'] == 0) echo 'disabled="disabled"'; ?>>
                                <?php foreach($aMinutos as $indice => $minuto): ?>
                                    <?php if(isset($minuto_receso_salida_martes) && $minuto_receso_salida_martes == $indice): ?>
                                    <option value="<?php echo $indice ?>" selected="selected"><?php echo $minuto ?></option>
                                    <?php else: ?>
                                    <option value="<?php echo $indice ?>"><?php echo $minuto ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>

                            <label><input class="inputRadio" <?php if($aConfiguracion['HL-DES-MA'] == 0) echo 'disabled="disabled"'; ?> name="horario[receso_turno_salida_martes]" id="receso_am_salida_martes" value="0" type="radio" <?php echo (isset($turno_receso_salida_martes) && $turno_receso_salida_martes == 'am') ? 'checked="checked"' : '' ?>>&nbsp;am</label>
                            <label><input class="inputRadio" <?php if($aConfiguracion['HL-DES-MA'] == 0) echo 'disabled="disabled"'; ?> name="horario[receso_turno_salida_martes]" id="receso_pm_salida_martes" value="12" type="radio" <?php echo (!isset($turno_receso_salida_martes) || $turno_receso_salida_martes == 'pm') ? 'checked="checked"' : '' ?>>&nbsp;pm</label>
                        </div>
                    </div>

                    <label for="hora">Hora entrada:</label>
                    <div class="vHora">
                        <select name="horario[receso_entrada_martes]" id="hora_receso_entrada_martes" class="dropDown" <?php if($aConfiguracion['HL-DES-MA'] == 0) echo 'disabled="disabled"'; ?>>
                            <?php foreach($aHoras as $indice => $hora): ?>
                                <?php if(isset($hora_receso_entrada_martes) && $hora_receso_entrada_martes == $indice): ?>
                                <option value="<?php echo $indice ?>" selected="selected"><?php echo $hora ?></option>
                                <?php else: ?>
                                <option value="<?php echo $indice ?>"><?php echo $hora ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <div class="formFieldContent">
                            <select name="horario[minuto_receso_entrada_martes]" id="minuto_receso_entrada_martes" class="dropDown" <?php if($aConfiguracion['HL-DES-MA'] == 0) echo 'disabled="disabled"'; ?>>
                                <?php foreach($aMinutos as $indice => $minuto): ?>
                                    <?php if(isset($minuto_receso_entrada_martes) && $minuto_receso_entrada_martes == $indice): ?>
                                    <option value="<?php echo $indice ?>" selected="selected"><?php echo $minuto ?></option>
                                    <?php else: ?>
                                    <option value="<?php echo $indice ?>"><?php echo $minuto ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                            <label><input class="inputRadio" <?php if($aConfiguracion['HL-DES-MA'] == 0) echo 'disabled="disabled"'; ?> name="horario[receso_turno_entrada_martes]" id="receso_am_entrada_martes" value="0"  type="radio" <?php echo (isset($turno_receso_entrada_martes) && $turno_receso_entrada_martes == 'am') ? 'checked="checked"' : '' ?>>&nbsp;am</label>
                            <label><input class="inputRadio" <?php if($aConfiguracion['HL-DES-MA'] == 0) echo 'disabled="disabled"'; ?> name="horario[receso_turno_entrada_martes]" id="receso_pm_entrada_martes" value="12" type="radio" <?php echo (!isset($turno_receso_entrada_martes) || $turno_receso_entrada_martes == 'pm') ? 'checked="checked"' : '' ?>>&nbsp;pm</label>
                        </div>
                    </div>
                </fieldset><br style="clear:both;" />

                <hr /><br style="clear:both;" />
                <fieldset><!-- MIERCOLES -->
                    <label for="hora">&nbsp;</label>
                    <input name="horario[miercoles]" class="textField" id="Mie" value="1" type="checkbox" <?php if($aConfiguracion['DL-MI']) echo 'checked="checked"'; ?>>&nbsp;&nbsp;Miercoles
                    <label for="hora">Hora de entrada:</label>
                    <div class="vHora">
                        <select name="horario[hora_entrada_miercoles]" id="hora_entrada_miercoles" class="dropDown">
                            <?php foreach($aHoras as $indice => $hora): ?>
                                <?php if(isset($hora_entrada_miercoles) && $hora_entrada_miercoles == $indice): ?>
                                <option value="<?php echo $indice ?>" selected="selected"><?php echo $hora ?></option>
                                <?php else: ?>
                                <option value="<?php echo $indice ?>"><?php echo $hora ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <div class="formFieldContent">
                            <select name="horario[minuto_entrada_miercoles]" id="minuto_entrada_miercoles" class="dropDown">
                                <?php foreach($aMinutos as $indice => $minuto): ?>
                                    <?php if(isset($minutos_entrada_miercoles) && $minutos_entrada_miercoles == $indice): ?>
                                    <option value="<?php echo $indice ?>" selected="selected"><?php echo $minuto ?></option>
                                    <?php else: ?>
                                    <option value="<?php echo $indice ?>"><?php echo $minuto ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>

                            <label><input class="inputRadio" name="horario[hora_turno_entrada_miercoles]" id="hora_am_entrada_miercoles" value="0" type="radio" <?php echo ($turno_entrada_miercoles == 'am') ? 'checked="checked"' : '' ?>>&nbsp;am</label>
                            <label><input class="inputRadio" name="horario[hora_turno_entrada_miercoles]" id="hora_pm_entrada_miercoles" value="12" type="radio" <?php echo ($turno_entrada_miercoles == 'pm') ? 'checked="checked"' : '' ?>>&nbsp;pm</label>
                        </div>
                    </div>
                    <label for="hora">Hora de salida:</label>
                    <div class="vHora">
                        <select name="horario[hora_salida_miercoles]" id="hora_salida_miercoles" class="dropDown">
                            <?php foreach($aHoras as $indice => $hora): ?>
                                <?php if(isset($hora_salida_miercoles) && $hora_salida_miercoles == $indice): ?>
                                <option value="<?php echo $indice ?>" selected="selected"><?php echo $hora ?></option>
                                <?php else: ?>
                                <option value="<?php echo $indice ?>"><?php echo $hora ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <div class="formFieldContent">
                            <select name="horario[minuto_salida_miercoles]" id="minuto_salida_miercoles" class="dropDown">
                                <?php foreach($aMinutos as $indice => $minuto): ?>
                                    <?php if(isset($minutos_salida_miercoles) && $minutos_salida_miercoles == $indice): ?>
                                    <option value="<?php echo $indice ?>" selected="selected"><?php echo $minuto ?></option>
                                    <?php else: ?>
                                    <option value="<?php echo $indice ?>"><?php echo $minuto ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>

                            <label><input class="inputRadio" name="horario[hora_turno_salida_miercoles]" id="hora_am_salida_miercoles" value="0" <?php echo (isset($turno_salida_miercoles) && $turno_salida_miercoles == 'am') ? 'checked="checked"' : '' ?> type="radio">&nbsp;am</label>
                            <label><input class="inputRadio" name="horario[hora_turno_salida_miercoles]" id="hora_pm_salida_miercoles" value="12" type="radio" <?php echo (isset($turno_salida_miercoles) && $turno_salida_miercoles == 'pm') ? 'checked="checked"' : '' ?>>&nbsp;pm</label>
                        </div>
                    </div>

                    <label for="hora">Hora de descanso:</label>
                    <select name="horario[descanzo_miercoles]" id="descanzo_miercoles" class="dropDown" onchange="activa_desactiva('descanzo_miercoles', 'descanzo_laboral_miercoles')">
                        <option value="1" <?php if($aConfiguracion['HL-DES-MI'] == 0) echo 'selected="selected"'; ?>>No</option>
                        <option value="2" <?php if($aConfiguracion['HL-DES-MI'] == 1) echo 'selected="selected"'; ?>>Si</option>
                    </select>

                </fieldset>

                <fieldset id="descanzo_laboral_miercoles">
                    <label for="hora">Hora salida:</label>
                    <div class="vHora">
                        <select name="horario[receso_salida_miercoles]" id="receso_salida_miercoles" class="dropDown" <?php if($aConfiguracion['HL-DES-MI'] == 0) echo 'disabled="disabled"'; ?>>
                            <?php foreach($aHoras as $indice => $hora): ?>
                                <?php if(isset($hora_receso_salida_miercoles) && $hora_receso_salida_miercoles == $indice): ?>
                                <option value="<?php echo $indice ?>" selected="selected"><?php echo $hora ?></option>
                                <?php else: ?>
                                <option value="<?php echo $indice ?>"><?php echo $hora ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <div class="formFieldContent">
                            <select name="horario[minuto_receso_salida_miercoles]" id="minuto_receso_salida_miercoles" class="dropDown" <?php if($aConfiguracion['HL-DES-MI'] == 0) echo 'disabled="disabled"'; ?>>
                                <?php foreach($aMinutos as $indice => $minuto): ?>
                                    <?php if(isset($minuto_receso_salida_miercoles) && $minuto_receso_salida_miercoles == $indice): ?>
                                    <option value="<?php echo $indice ?>" selected="selected"><?php echo $minuto ?></option>
                                    <?php else: ?>
                                    <option value="<?php echo $indice ?>"><?php echo $minuto ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>

                            <label><input class="inputRadio" <?php if($aConfiguracion['HL-DES-MI'] == 0) echo 'disabled="disabled"'; ?> name="horario[receso_turno_salida_miercoles]" id="receso_am_salida_miercoles" value="0" type="radio" <?php echo (isset($turno_receso_salida_miercoles) && $turno_receso_salida_miercoles == 'am') ? 'checked="checked"' : '' ?>>&nbsp;am</label>
                            <label><input class="inputRadio" <?php if($aConfiguracion['HL-DES-MI'] == 0) echo 'disabled="disabled"'; ?> name="horario[receso_turno_salida_miercoles]" id="receso_pm_salida_miercoles" value="12" type="radio" <?php echo (!isset($turno_receso_salida_miercoles) || $turno_receso_salida_miercoles == 'pm') ? 'checked="checked"' : '' ?>>&nbsp;pm</label>
                        </div>
                    </div>

                    <label for="hora">Hora entrada:</label>
                    <div class="vHora">
                        <select name="horario[receso_entrada_miercoles]" id="hora_receso_entrada_miercoles" class="dropDown" <?php if($aConfiguracion['HL-DES-MI'] == 0) echo 'disabled="disabled"'; ?>>
                            <?php foreach($aHoras as $indice => $hora): ?>
                                <?php if(isset($hora_receso_entrada_miercoles) && $hora_receso_entrada_miercoles == $indice): ?>
                                <option value="<?php echo $indice ?>" selected="selected"><?php echo $hora ?></option>
                                <?php else: ?>
                                <option value="<?php echo $indice ?>"><?php echo $hora ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <div class="formFieldContent">
                            <select name="horario[minuto_receso_entrada_miercoles]" id="minuto_receso_entrada_miercoles" class="dropDown" <?php if($aConfiguracion['HL-DES-MI'] == 0) echo 'disabled="disabled"'; ?>>
                                <?php foreach($aMinutos as $indice => $minuto): ?>
                                    <?php if(isset($minuto_receso_entrada_miercoles) && $minuto_receso_entrada_miercoles == $indice): ?>
                                    <option value="<?php echo $indice ?>" selected="selected"><?php echo $minuto ?></option>
                                    <?php else: ?>
                                    <option value="<?php echo $indice ?>"><?php echo $minuto ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                            <label><input class="inputRadio" <?php if($aConfiguracion['HL-DES-MI'] == 0) echo 'disabled="disabled"'; ?> name="horario[receso_turno_entrada_miercoles]" id="receso_am_entrada_miercoles" value="0"  type="radio" <?php echo (isset($turno_receso_entrada_miercoles) && $turno_receso_entrada_miercoles == 'am') ? 'checked="checked"' : '' ?>>&nbsp;am</label>
                            <label><input class="inputRadio" <?php if($aConfiguracion['HL-DES-MI'] == 0) echo 'disabled="disabled"'; ?> name="horario[receso_turno_entrada_miercoles]" id="receso_pm_entrada_miercoles" value="12" type="radio" <?php echo (!isset($turno_receso_entrada_miercoles) || $turno_receso_entrada_miercoles == 'pm') ? 'checked="checked"' : '' ?>>&nbsp;pm</label>
                        </div>
                    </div>
                </fieldset><br style="clear:both;" />

                <hr /><br style="clear:both;" />
                <fieldset><!-- JUEVES -->
                    <label for="hora">&nbsp;</label>
                    <input name="horario[jueves]" class="textField" id="Jue" value="1" type="checkbox" <?php if($aConfiguracion['DL-JU']) echo 'checked="checked"'; ?>>&nbsp;&nbsp;Jueves
                    <label for="hora">Hora de entrada:</label>
                    <div class="vHora">
                        <select name="horario[hora_entrada_jueves]" id="hora_entrada_jueves" class="dropDown">
                            <?php foreach($aHoras as $indice => $hora): ?>
                                <?php if(isset($hora_entrada_jueves) && $hora_entrada_jueves == $indice): ?>
                                <option value="<?php echo $indice ?>" selected="selected"><?php echo $hora ?></option>
                                <?php else: ?>
                                <option value="<?php echo $indice ?>"><?php echo $hora ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <div class="formFieldContent">
                            <select name="horario[minuto_entrada_jueves]" id="minuto_entrada_jueves" class="dropDown">
                                <?php foreach($aMinutos as $indice => $minuto): ?>
                                    <?php if(isset($minutos_entrada_jueves) && $minutos_entrada_jueves == $indice): ?>
                                    <option value="<?php echo $indice ?>" selected="selected"><?php echo $minuto ?></option>
                                    <?php else: ?>
                                    <option value="<?php echo $indice ?>"><?php echo $minuto ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>

                            <label><input class="inputRadio" name="horario[hora_turno_entrada_jueves]" id="hora_am_entrada_jueves" value="0" type="radio" <?php echo ($turno_entrada_jueves == 'am') ? 'checked="checked"' : '' ?>>&nbsp;am</label>
                            <label><input class="inputRadio" name="horario[hora_turno_entrada_jueves]" id="hora_pm_entrada_jueves" value="12" type="radio" <?php echo ($turno_entrada_jueves == 'pm') ? 'checked="checked"' : '' ?>>&nbsp;pm</label>
                        </div>
                    </div>
                    <label for="hora">Hora de salida:</label>
                    <div class="vHora">
                        <select name="horario[hora_salida_jueves]" id="hora_salida_jueves" class="dropDown">
                            <?php foreach($aHoras as $indice => $hora): ?>
                                <?php if(isset($hora_salida_jueves) && $hora_salida_jueves == $indice): ?>
                                <option value="<?php echo $indice ?>" selected="selected"><?php echo $hora ?></option>
                                <?php else: ?>
                                <option value="<?php echo $indice ?>"><?php echo $hora ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <div class="formFieldContent">
                            <select name="horario[minuto_salida_jueves]" id="minuto_salida_jueves" class="dropDown">
                                <?php foreach($aMinutos as $indice => $minuto): ?>
                                    <?php if(isset($minutos_salida_jueves) && $minutos_salida_jueves == $indice): ?>
                                    <option value="<?php echo $indice ?>" selected="selected"><?php echo $minuto ?></option>
                                    <?php else: ?>
                                    <option value="<?php echo $indice ?>"><?php echo $minuto ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>

                            <label><input class="inputRadio" name="horario[hora_turno_salida_jueves]" id="hora_am_salida_jueves" value="0" <?php echo (isset($turno_salida_jueves) && $turno_salida_jueves == 'am') ? 'checked="checked"' : '' ?> type="radio">&nbsp;am</label>
                            <label><input class="inputRadio" name="horario[hora_turno_salida_jueves]" id="hora_pm_salida_jueves" value="12" type="radio" <?php echo (isset($turno_salida_jueves) && $turno_salida_jueves == 'pm') ? 'checked="checked"' : '' ?>>&nbsp;pm</label>
                        </div>
                    </div>

                    <label for="hora">Hora de descanso:</label>
                    <select name="horario[descanzo_jueves]" id="descanzo_jueves" class="dropDown" onchange="activa_desactiva('descanzo_jueves', 'descanzo_laboral_jueves')">
                        <option value="1" <?php if($aConfiguracion['HL-DES-JU'] == 0) echo 'selected="selected"'; ?>>No</option>
                        <option value="2" <?php if($aConfiguracion['HL-DES-JU'] == 1) echo 'selected="selected"'; ?>>Si</option>
                    </select>

                </fieldset>

                <fieldset id="descanzo_laboral_jueves">
                    <label for="hora">Hora salida:</label>
                    <div class="vHora">
                        <select name="horario[receso_salida_jueves]" id="receso_salida_jueves" class="dropDown" <?php if($aConfiguracion['HL-DES-JU'] == 0) echo 'disabled="disabled"'; ?>>
                            <?php foreach($aHoras as $indice => $hora): ?>
                                <?php if(isset($hora_receso_salida_jueves) && $hora_receso_salida_jueves == $indice): ?>
                                <option value="<?php echo $indice ?>" selected="selected"><?php echo $hora ?></option>
                                <?php else: ?>
                                <option value="<?php echo $indice ?>"><?php echo $hora ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <div class="formFieldContent">
                            <select name="horario[minuto_receso_salida_jueves]" id="minuto_receso_salida_jueves" class="dropDown" <?php if($aConfiguracion['HL-DES-JU'] == 0) echo 'disabled="disabled"'; ?>>
                                <?php foreach($aMinutos as $indice => $minuto): ?>
                                    <?php if(isset($minuto_receso_salida_jueves) && $minuto_receso_salida_jueves == $indice): ?>
                                    <option value="<?php echo $indice ?>" selected="selected"><?php echo $minuto ?></option>
                                    <?php else: ?>
                                    <option value="<?php echo $indice ?>"><?php echo $minuto ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>

                            <label><input class="inputRadio" <?php if($aConfiguracion['HL-DES-JU'] == 0) echo 'disabled="disabled"'; ?> name="horario[receso_turno_salida_jueves]" id="receso_am_salida_jueves" value="0" type="radio" <?php echo (isset($turno_receso_salida_jueves) && $turno_receso_salida_jueves == 'am') ? 'checked="checked"' : '' ?>>&nbsp;am</label>
                            <label><input class="inputRadio" <?php if($aConfiguracion['HL-DES-JU'] == 0) echo 'disabled="disabled"'; ?> name="horario[receso_turno_salida_jueves]" id="receso_pm_salida_jueves" value="12" type="radio" <?php echo (!isset($turno_receso_salida_jueves) || $turno_receso_salida_jueves == 'pm') ? 'checked="checked"' : '' ?>>&nbsp;pm</label>
                        </div>
                    </div>

                    <label for="hora">Hora entrada:</label>
                    <div class="vHora">
                        <select name="horario[receso_entrada_jueves]" id="hora_receso_entrada_jueves" class="dropDown" <?php if($aConfiguracion['HL-DES-JU'] == 0) echo 'disabled="disabled"'; ?>>
                            <?php foreach($aHoras as $indice => $hora): ?>
                                <?php if(isset($hora_receso_entrada_jueves) && $hora_receso_entrada_jueves == $indice): ?>
                                <option value="<?php echo $indice ?>" selected="selected"><?php echo $hora ?></option>
                                <?php else: ?>
                                <option value="<?php echo $indice ?>"><?php echo $hora ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <div class="formFieldContent">
                            <select name="horario[minuto_receso_entrada_jueves]" id="minuto_receso_entrada_jueves" class="dropDown" <?php if($aConfiguracion['HL-DES-JU'] == 0) echo 'disabled="disabled"'; ?>>
                                <?php foreach($aMinutos as $indice => $minuto): ?>
                                    <?php if(isset($minuto_receso_entrada_jueves) && $minuto_receso_entrada_jueves == $indice): ?>
                                    <option value="<?php echo $indice ?>" selected="selected"><?php echo $minuto ?></option>
                                    <?php else: ?>
                                    <option value="<?php echo $indice ?>"><?php echo $minuto ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                            <label><input class="inputRadio" <?php if($aConfiguracion['HL-DES-JU'] == 0) echo 'disabled="disabled"'; ?> name="horario[receso_turno_entrada_jueves]" id="receso_am_entrada_jueves" value="0"  type="radio" <?php echo (isset($turno_receso_entrada_jueves) && $turno_receso_entrada_jueves == 'am') ? 'checked="checked"' : '' ?>>&nbsp;am</label>
                            <label><input class="inputRadio" <?php if($aConfiguracion['HL-DES-JU'] == 0) echo 'disabled="disabled"'; ?> name="horario[receso_turno_entrada_jueves]" id="receso_pm_entrada_jueves" value="12" type="radio" <?php echo (!isset($turno_receso_entrada_jueves) || $turno_receso_entrada_jueves == 'pm') ? 'checked="checked"' : '' ?>>&nbsp;pm</label>
                        </div>
                    </div>
                </fieldset><br style="clear:both;" />


                <hr /><br style="clear:both;" />
                <fieldset><!-- VIERNES -->
                    <label for="hora">&nbsp;</label>
                    <input name="horario[viernes]" class="textField" id="Vie" value="1" type="checkbox" <?php if($aConfiguracion['DL-VI']) echo 'checked="checked"'; ?>>&nbsp;&nbsp;Viernes
                    <label for="hora">Hora de entrada:</label>
                    <div class="vHora">
                        <select name="horario[hora_entrada_viernes]" id="hora_entrada_viernes" class="dropDown">
                            <?php foreach($aHoras as $indice => $hora): ?>
                                <?php if(isset($hora_entrada_viernes) && $hora_entrada_viernes == $indice): ?>
                                <option value="<?php echo $indice ?>" selected="selected"><?php echo $hora ?></option>
                                <?php else: ?>
                                <option value="<?php echo $indice ?>"><?php echo $hora ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <div class="formFieldContent">
                            <select name="horario[minuto_entrada_viernes]" id="minuto_entrada_viernes" class="dropDown">
                                <?php foreach($aMinutos as $indice => $minuto): ?>
                                    <?php if(isset($minutos_entrada_viernes) && $minutos_entrada_viernes == $indice): ?>
                                    <option value="<?php echo $indice ?>" selected="selected"><?php echo $minuto ?></option>
                                    <?php else: ?>
                                    <option value="<?php echo $indice ?>"><?php echo $minuto ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>

                            <label><input class="inputRadio" name="horario[hora_turno_entrada_viernes]" id="hora_am_entrada_viernes" value="0" type="radio" <?php echo ($turno_entrada_viernes == 'am') ? 'checked="checked"' : '' ?>>&nbsp;am</label>
                            <label><input class="inputRadio" name="horario[hora_turno_entrada_viernes]" id="hora_pm_entrada_viernes" value="12" type="radio" <?php echo ($turno_entrada_viernes == 'pm') ? 'checked="checked"' : '' ?>>&nbsp;pm</label>
                        </div>
                    </div>
                    <label for="hora">Hora de salida:</label>
                    <div class="vHora">
                        <select name="horario[hora_salida_viernes]" id="hora_salida_viernes" class="dropDown">
                            <?php foreach($aHoras as $indice => $hora): ?>
                                <?php if(isset($hora_salida_viernes) && $hora_salida_viernes == $indice): ?>
                                <option value="<?php echo $indice ?>" selected="selected"><?php echo $hora ?></option>
                                <?php else: ?>
                                <option value="<?php echo $indice ?>"><?php echo $hora ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <div class="formFieldContent">
                            <select name="horario[minuto_salida_viernes]" id="minuto_salida_viernes" class="dropDown">
                                <?php foreach($aMinutos as $indice => $minuto): ?>
                                    <?php if(isset($minutos_salida_viernes) && $minutos_salida_viernes == $indice): ?>
                                    <option value="<?php echo $indice ?>" selected="selected"><?php echo $minuto ?></option>
                                    <?php else: ?>
                                    <option value="<?php echo $indice ?>"><?php echo $minuto ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>

                            <label><input class="inputRadio" name="horario[hora_turno_salida_viernes]" id="hora_am_salida_viernes" value="0" <?php echo (isset($turno_salida_viernes) && $turno_salida_viernes == 'am') ? 'checked="checked"' : '' ?> type="radio">&nbsp;am</label>
                            <label><input class="inputRadio" name="horario[hora_turno_salida_viernes]" id="hora_pm_salida_viernes" value="12" type="radio" <?php echo (isset($turno_salida_viernes) && $turno_salida_viernes == 'pm') ? 'checked="checked"' : '' ?>>&nbsp;pm</label>
                        </div>
                    </div>

                    <label for="hora">Hora de descanso:</label>
                    <select name="horario[descanzo_viernes]" id="descanzo_viernes" class="dropDown" onchange="activa_desactiva('descanzo_viernes', 'descanzo_laboral_viernes')">
                        <option value="1" <?php if($aConfiguracion['HL-DES-VI'] == 0) echo 'selected="selected"'; ?>>No</option>
                        <option value="2" <?php if($aConfiguracion['HL-DES-VI'] == 1) echo 'selected="selected"'; ?>>Si</option>
                    </select>

                </fieldset>

                <fieldset id="descanzo_laboral_viernes">
                    <label for="hora">Hora salida:</label>
                    <div class="vHora">
                        <select name="horario[receso_salida_viernes]" id="receso_salida_viernes" class="dropDown" <?php if($aConfiguracion['HL-DES-VI'] == 0) echo 'disabled="disabled"'; ?>>
                            <?php foreach($aHoras as $indice => $hora): ?>
                                <?php if(isset($hora_receso_salida_viernes) && $hora_receso_salida_viernes == $indice): ?>
                                <option value="<?php echo $indice ?>" selected="selected"><?php echo $hora ?></option>
                                <?php else: ?>
                                <option value="<?php echo $indice ?>"><?php echo $hora ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <div class="formFieldContent">
                            <select name="horario[minuto_receso_salida_viernes]" id="minuto_receso_salida_viernes" class="dropDown" <?php if($aConfiguracion['HL-DES-VI'] == 0) echo 'disabled="disabled"'; ?>>
                                <?php foreach($aMinutos as $indice => $minuto): ?>
                                    <?php if(isset($minuto_receso_salida_viernes) && $minuto_receso_salida_viernes == $indice): ?>
                                    <option value="<?php echo $indice ?>" selected="selected"><?php echo $minuto ?></option>
                                    <?php else: ?>
                                    <option value="<?php echo $indice ?>"><?php echo $minuto ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>

                            <label><input class="inputRadio" <?php if($aConfiguracion['HL-DES-VI'] == 0) echo 'disabled="disabled"'; ?> name="horario[receso_turno_salida_viernes]" id="receso_am_salida_viernes" value="0" type="radio" <?php echo (isset($turno_receso_salida_viernes) && $turno_receso_salida_viernes == 'am') ? 'checked="checked"' : '' ?>>&nbsp;am</label>
                            <label><input class="inputRadio" <?php if($aConfiguracion['HL-DES-VI'] == 0) echo 'disabled="disabled"'; ?> name="horario[receso_turno_salida_viernes]" id="receso_pm_salida_viernes" value="12" type="radio" <?php echo (!isset($turno_receso_salida_viernes) || $turno_receso_salida_viernes == 'pm') ? 'checked="checked"' : '' ?>>&nbsp;pm</label>
                        </div>
                    </div>

                    <label for="hora">Hora entrada:</label>
                    <div class="vHora">
                        <select name="horario[receso_entrada_viernes]" id="hora_receso_entrada_viernes" class="dropDown" <?php if($aConfiguracion['HL-DES-VI'] == 0) echo 'disabled="disabled"'; ?>>
                            <?php foreach($aHoras as $indice => $hora): ?>
                                <?php if(isset($hora_receso_entrada_viernes) && $hora_receso_entrada_viernes == $indice): ?>
                                <option value="<?php echo $indice ?>" selected="selected"><?php echo $hora ?></option>
                                <?php else: ?>
                                <option value="<?php echo $indice ?>"><?php echo $hora ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <div class="formFieldContent">
                            <select name="horario[minuto_receso_entrada_viernes]" id="minuto_receso_entrada_viernes" class="dropDown" <?php if($aConfiguracion['HL-DES-VI'] == 0) echo 'disabled="disabled"'; ?>>
                                <?php foreach($aMinutos as $indice => $minuto): ?>
                                    <?php if(isset($minuto_receso_entrada_viernes) && $minuto_receso_entrada_viernes == $indice): ?>
                                    <option value="<?php echo $indice ?>" selected="selected"><?php echo $minuto ?></option>
                                    <?php else: ?>
                                    <option value="<?php echo $indice ?>"><?php echo $minuto ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                            <label><input class="inputRadio" <?php if($aConfiguracion['HL-DES-VI'] == 0) echo 'disabled="disabled"'; ?> name="horario[receso_turno_entrada_viernes]" id="receso_am_entrada_viernes" value="0"  type="radio" <?php echo (isset($turno_receso_entrada_viernes) && $turno_receso_entrada_viernes == 'am') ? 'checked="checked"' : '' ?>>&nbsp;am</label>
                            <label><input class="inputRadio" <?php if($aConfiguracion['HL-DES-VI'] == 0) echo 'disabled="disabled"'; ?> name="horario[receso_turno_entrada_viernes]" id="receso_pm_entrada_viernes" value="12" type="radio" <?php echo (!isset($turno_receso_entrada_viernes) || $turno_receso_entrada_viernes == 'pm') ? 'checked="checked"' : '' ?>>&nbsp;pm</label>
                        </div>
                    </div>
                </fieldset><br style="clear:both;" />


                <hr /><br style="clear:both;" />
                <fieldset><!-- SABADO -->
                    <label for="hora">&nbsp;</label>
                    <input name="horario[sabado]" class="textField" id="Sab" value="1" type="checkbox" <?php if($aConfiguracion['DL-SA']) echo 'checked="checked"'; ?>>&nbsp;&nbsp;Sabado
                    <label for="hora">Hora de entrada:</label>
                    <div class="vHora">
                        <select name="horario[hora_entrada_sabado]" id="hora_entrada_sabado" class="dropDown">
                            <?php foreach($aHoras as $indice => $hora): ?>
                                <?php if(isset($hora_entrada_sabado) && $hora_entrada_sabado == $indice): ?>
                                <option value="<?php echo $indice ?>" selected="selected"><?php echo $hora ?></option>
                                <?php else: ?>
                                <option value="<?php echo $indice ?>"><?php echo $hora ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <div class="formFieldContent">
                            <select name="horario[minuto_entrada_sabado]" id="minuto_entrada_sabado" class="dropDown">
                                <?php foreach($aMinutos as $indice => $minuto): ?>
                                    <?php if(isset($minutos_entrada_sabado) && $minutos_entrada_sabado == $indice): ?>
                                    <option value="<?php echo $indice ?>" selected="selected"><?php echo $minuto ?></option>
                                    <?php else: ?>
                                    <option value="<?php echo $indice ?>"><?php echo $minuto ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>

                            <label><input class="inputRadio" name="horario[hora_turno_entrada_sabado]" id="hora_am_entrada_sabado" value="0" type="radio" <?php echo ($turno_entrada_sabado == 'am') ? 'checked="checked"' : '' ?>>&nbsp;am</label>
                            <label><input class="inputRadio" name="horario[hora_turno_entrada_sabado]" id="hora_pm_entrada_sabado" value="12" type="radio" <?php echo ($turno_entrada_sabado == 'pm') ? 'checked="checked"' : '' ?>>&nbsp;pm</label>
                        </div>
                    </div>
                    <label for="hora">Hora de salida:</label>
                    <div class="vHora">
                        <select name="horario[hora_salida_sabado]" id="hora_salida_sabado" class="dropDown">
                            <?php foreach($aHoras as $indice => $hora): ?>
                                <?php if(isset($hora_salida_sabado) && $hora_salida_sabado == $indice): ?>
                                <option value="<?php echo $indice ?>" selected="selected"><?php echo $hora ?></option>
                                <?php else: ?>
                                <option value="<?php echo $indice ?>"><?php echo $hora ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <div class="formFieldContent">
                            <select name="horario[minuto_salida_sabado]" id="minuto_salida_sabado" class="dropDown">
                                <?php foreach($aMinutos as $indice => $minuto): ?>
                                    <?php if(isset($minutos_salida_sabado) && $minutos_salida_sabado == $indice): ?>
                                    <option value="<?php echo $indice ?>" selected="selected"><?php echo $minuto ?></option>
                                    <?php else: ?>
                                    <option value="<?php echo $indice ?>"><?php echo $minuto ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>

                            <label><input class="inputRadio" name="horario[hora_turno_salida_sabado]" id="hora_am_salida_sabado" value="0" <?php echo (isset($turno_salida_sabado) && $turno_salida_sabado == 'am') ? 'checked="checked"' : '' ?> type="radio">&nbsp;am</label>
                            <label><input class="inputRadio" name="horario[hora_turno_salida_sabado]" id="hora_pm_salida_sabado" value="12" type="radio" <?php echo (isset($turno_salida_sabado) && $turno_salida_sabado == 'pm') ? 'checked="checked"' : '' ?>>&nbsp;pm</label>
                        </div>
                    </div>

                    <label for="hora">Hora de descanso:</label>
                    <select name="horario[descanzo_sabado]" id="descanzo_sabado" class="dropDown" onchange="activa_desactiva('descanzo_sabado', 'descanzo_laboral_sabado')">
                        <option value="1" <?php if($aConfiguracion['HL-DES-SA'] == 0) echo 'selected="selected"'; ?>>No</option>
                        <option value="2" <?php if($aConfiguracion['HL-DES-SA'] == 1) echo 'selected="selected"'; ?>>Si</option>
                    </select>

                </fieldset>

                <fieldset id="descanzo_laboral_sabado">
                    <label for="hora">Hora salida:</label>
                    <div class="vHora">
                        <select name="horario[receso_salida_sabado]" id="receso_salida_sabado" class="dropDown" <?php if($aConfiguracion['HL-DES-SA'] == 0) echo 'disabled="disabled"'; ?>>
                            <?php foreach($aHoras as $indice => $hora): ?>
                                <?php if(isset($hora_receso_salida_sabado) && $hora_receso_salida_sabado == $indice): ?>
                                <option value="<?php echo $indice ?>" selected="selected"><?php echo $hora ?></option>
                                <?php else: ?>
                                <option value="<?php echo $indice ?>"><?php echo $hora ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <div class="formFieldContent">
                            <select name="horario[minuto_receso_salida_sabado]" id="minuto_receso_salida_sabado" class="dropDown" <?php if($aConfiguracion['HL-DES-SA'] == 0) echo 'disabled="disabled"'; ?>>
                                <?php foreach($aMinutos as $indice => $minuto): ?>
                                    <?php if(isset($minuto_receso_salida_sabado) && $minuto_receso_salida_sabado == $indice): ?>
                                    <option value="<?php echo $indice ?>" selected="selected"><?php echo $minuto ?></option>
                                    <?php else: ?>
                                    <option value="<?php echo $indice ?>"><?php echo $minuto ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>

                            <label><input class="inputRadio" <?php if($aConfiguracion['HL-DES-SA'] == 0) echo 'disabled="disabled"'; ?> name="horario[receso_turno_salida_sabado]" id="receso_am_salida_sabado" value="0" type="radio" <?php echo (isset($turno_receso_salida_sabado) && $turno_receso_salida_sabado == 'am') ? 'checked="checked"' : '' ?>>&nbsp;am</label>
                            <label><input class="inputRadio" <?php if($aConfiguracion['HL-DES-SA'] == 0) echo 'disabled="disabled"'; ?> name="horario[receso_turno_salida_sabado]" id="receso_pm_salida_sabado" value="12" type="radio" <?php echo (!isset($turno_receso_salida_sabado) || $turno_receso_salida_sabado == 'pm') ? 'checked="checked"' : '' ?>>&nbsp;pm</label>
                        </div>
                    </div>

                    <label for="hora">Hora entrada:</label>
                    <div class="vHora">
                        <select name="horario[receso_entrada_sabado]" id="hora_receso_entrada_sabado" class="dropDown" <?php if($aConfiguracion['HL-DES-SA'] == 0) echo 'disabled="disabled"'; ?>>
                            <?php foreach($aHoras as $indice => $hora): ?>
                                <?php if(isset($hora_receso_entrada_sabado) && $hora_receso_entrada_sabado == $indice): ?>
                                <option value="<?php echo $indice ?>" selected="selected"><?php echo $hora ?></option>
                                <?php else: ?>
                                <option value="<?php echo $indice ?>"><?php echo $hora ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <div class="formFieldContent">
                            <select name="horario[minuto_receso_entrada_sabado]" id="minuto_receso_entrada_sabado" class="dropDown" <?php if($aConfiguracion['HL-DES-SA'] == 0) echo 'disabled="disabled"'; ?>>
                                <?php foreach($aMinutos as $indice => $minuto): ?>
                                    <?php if(isset($minuto_receso_entrada_sabado) && $minuto_receso_entrada_sabado == $indice): ?>
                                    <option value="<?php echo $indice ?>" selected="selected"><?php echo $minuto ?></option>
                                    <?php else: ?>
                                    <option value="<?php echo $indice ?>"><?php echo $minuto ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                            <label><input class="inputRadio" <?php if($aConfiguracion['HL-DES-SA'] == 0) echo 'disabled="disabled"'; ?> name="horario[receso_turno_entrada_sabado]" id="receso_am_entrada_sabado" value="0"  type="radio" <?php echo (isset($turno_receso_entrada_sabado) && $turno_receso_entrada_sabado == 'am') ? 'checked="checked"' : '' ?>>&nbsp;am</label>
                            <label><input class="inputRadio" <?php if($aConfiguracion['HL-DES-SA'] == 0) echo 'disabled="disabled"'; ?> name="horario[receso_turno_entrada_sabado]" id="receso_pm_entrada_sabado" value="12" type="radio" <?php echo (!isset($turno_receso_entrada_sabado) || $turno_receso_entrada_sabado == 'pm') ? 'checked="checked"' : '' ?>>&nbsp;pm</label>
                        </div>
                    </div>
                </fieldset><br style="clear:both;" />

                <hr /><br style="clear:both;" />
                <fieldset><!-- DOMINGO -->
                    <label for="hora">&nbsp;</label>
                    <input name="horario[domingo]" class="textField" id="Dom" value="1" type="checkbox" <?php if($aConfiguracion['DL-DO']) echo 'checked="checked"'; ?>>&nbsp;&nbsp;Domingo
                    <label for="hora">Hora de entrada:</label>
                    <div class="vHora">
                        <select name="horario[hora_entrada_domingo]" id="hora_entrada_domingo" class="dropDown">
                            <?php foreach($aHoras as $indice => $hora): ?>
                                <?php if(isset($hora_entrada_domingo) && $hora_entrada_domingo == $indice): ?>
                                <option value="<?php echo $indice ?>" selected="selected"><?php echo $hora ?></option>
                                <?php else: ?>
                                <option value="<?php echo $indice ?>"><?php echo $hora ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <div class="formFieldContent">
                            <select name="horario[minuto_entrada_domingo]" id="minuto_entrada_domingo" class="dropDown">
                                <?php foreach($aMinutos as $indice => $minuto): ?>
                                    <?php if(isset($minutos_entrada_domingo) && $minutos_entrada_domingo == $indice): ?>
                                    <option value="<?php echo $indice ?>" selected="selected"><?php echo $minuto ?></option>
                                    <?php else: ?>
                                    <option value="<?php echo $indice ?>"><?php echo $minuto ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>

                            <label><input class="inputRadio" name="horario[hora_turno_entrada_domingo]" id="hora_am_entrada_domingo" value="0" type="radio" <?php echo ($turno_entrada_domingo == 'am') ? 'checked="checked"' : '' ?>>&nbsp;am</label>
                            <label><input class="inputRadio" name="horario[hora_turno_entrada_domingo]" id="hora_pm_entrada_domingo" value="12" type="radio" <?php echo ($turno_entrada_domingo == 'pm') ? 'checked="checked"' : '' ?>>&nbsp;pm</label>
                        </div>
                    </div>
                    <label for="hora">Hora de salida:</label>
                    <div class="vHora">
                        <select name="horario[hora_salida_domingo]" id="hora_salida_domingo" class="dropDown">
                            <?php foreach($aHoras as $indice => $hora): ?>
                                <?php if(isset($hora_salida_domingo) && $hora_salida_domingo == $indice): ?>
                                <option value="<?php echo $indice ?>" selected="selected"><?php echo $hora ?></option>
                                <?php else: ?>
                                <option value="<?php echo $indice ?>"><?php echo $hora ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <div class="formFieldContent">
                            <select name="horario[minuto_salida_domingo]" id="minuto_salida_domingo" class="dropDown">
                                <?php foreach($aMinutos as $indice => $minuto): ?>
                                    <?php if(isset($minutos_salida_domingo) && $minutos_salida_domingo == $indice): ?>
                                    <option value="<?php echo $indice ?>" selected="selected"><?php echo $minuto ?></option>
                                    <?php else: ?>
                                    <option value="<?php echo $indice ?>"><?php echo $minuto ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>

                            <label><input class="inputRadio" name="horario[hora_turno_salida_domingo]" id="hora_am_salida_domingo" value="0" <?php echo (isset($turno_salida_domingo) && $turno_salida_domingo == 'am') ? 'checked="checked"' : '' ?> type="radio">&nbsp;am</label>
                            <label><input class="inputRadio" name="horario[hora_turno_salida_domingo]" id="hora_pm_salida_domingo" value="12" type="radio" <?php echo (isset($turno_salida_domingo) && $turno_salida_domingo == 'pm') ? 'checked="checked"' : '' ?>>&nbsp;pm</label>
                        </div>
                    </div>

                    <label for="hora">Hora de descanso:</label>
                    <select name="horario[descanzo_domingo]" id="descanzo_domingo" class="dropDown" onchange="activa_desactiva('descanzo_domingo', 'descanzo_laboral_domingo')">
                        <option value="1" <?php if($aConfiguracion['HL-DES-DO'] == 0) echo 'selected="selected"'; ?>>No</option>
                        <option value="2" <?php if($aConfiguracion['HL-DES-DO'] == 1) echo 'selected="selected"'; ?>>Si</option>
                    </select>

                </fieldset>

                <fieldset id="descanzo_laboral_domingo">
                    <label for="hora">Hora salida:</label>
                    <div class="vHora">
                        <select name="horario[receso_salida_domingo]" id="receso_salida_domingo" class="dropDown" <?php if($aConfiguracion['HL-DES-DO'] == 0) echo 'disabled="disabled"'; ?>>
                            <?php foreach($aHoras as $indice => $hora): ?>
                                <?php if(isset($hora_receso_salida_domingo) && $hora_receso_salida_domingo == $indice): ?>
                                <option value="<?php echo $indice ?>" selected="selected"><?php echo $hora ?></option>
                                <?php else: ?>
                                <option value="<?php echo $indice ?>"><?php echo $hora ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <div class="formFieldContent">
                            <select name="horario[minuto_receso_salida_domingo]" id="minuto_receso_salida_domingo" class="dropDown" <?php if($aConfiguracion['HL-DES-DO'] == 0) echo 'disabled="disabled"'; ?>>
                                <?php foreach($aMinutos as $indice => $minuto): ?>
                                    <?php if(isset($minuto_receso_salida_domingo) && $minuto_receso_salida_domingo == $indice): ?>
                                    <option value="<?php echo $indice ?>" selected="selected"><?php echo $minuto ?></option>
                                    <?php else: ?>
                                    <option value="<?php echo $indice ?>"><?php echo $minuto ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>

                            <label><input class="inputRadio" <?php if($aConfiguracion['HL-DES-DO'] == 0) echo 'disabled="disabled"'; ?> name="horario[receso_turno_salida_domingo]" id="receso_am_salida_domingo" value="0" type="radio" <?php echo (isset($turno_receso_salida_domingo) && $turno_receso_salida_domingo == 'am') ? 'checked="checked"' : '' ?>>&nbsp;am</label>
                            <label><input class="inputRadio" <?php if($aConfiguracion['HL-DES-DO'] == 0) echo 'disabled="disabled"'; ?> name="horario[receso_turno_salida_domingo]" id="receso_pm_salida_domingo" value="12" type="radio" <?php echo (!isset($turno_receso_salida_domingo) || $turno_receso_salida_domingo == 'pm') ? 'checked="checked"' : '' ?>>&nbsp;pm</label>
                        </div>
                    </div>

                    <label for="hora">Hora entrada:</label>
                    <div class="vHora">
                        <select name="horario[receso_entrada_domingo]" id="hora_receso_entrada_domingo" class="dropDown" <?php if($aConfiguracion['HL-DES-DO'] == 0) echo 'disabled="disabled"'; ?>>
                            <?php foreach($aHoras as $indice => $hora): ?>
                                <?php if(isset($hora_receso_entrada_domingo) && $hora_receso_entrada_domingo == $indice): ?>
                                <option value="<?php echo $indice ?>" selected="selected"><?php echo $hora ?></option>
                                <?php else: ?>
                                <option value="<?php echo $indice ?>"><?php echo $hora ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <div class="formFieldContent">
                            <select name="horario[minuto_receso_entrada_domingo]" id="minuto_receso_entrada_domingo" class="dropDown" <?php if($aConfiguracion['HL-DES-DO'] == 0) echo 'disabled="disabled"'; ?>>
                                <?php foreach($aMinutos as $indice => $minuto): ?>
                                    <?php if(isset($minuto_receso_entrada_domingo) && $minuto_receso_entrada_domingo == $indice): ?>
                                    <option value="<?php echo $indice ?>" selected="selected"><?php echo $minuto ?></option>
                                    <?php else: ?>
                                    <option value="<?php echo $indice ?>"><?php echo $minuto ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                            <label><input class="inputRadio" <?php if($aConfiguracion['HL-DES-DO'] == 0) echo 'disabled="disabled"'; ?> name="horario[receso_turno_entrada_domingo]" id="receso_am_entrada_domingo" value="0"  type="radio" <?php echo (isset($turno_receso_entrada_domingo) && $turno_receso_entrada_domingo == 'am') ? 'checked="checked"' : '' ?>>&nbsp;am</label>
                            <label><input class="inputRadio" <?php if($aConfiguracion['HL-DES-DO'] == 0) echo 'disabled="disabled"'; ?> name="horario[receso_turno_entrada_domingo]" id="receso_pm_entrada_domingo" value="12" type="radio" <?php echo (!isset($turno_receso_entrada_domingo) || $turno_receso_entrada_domingo == 'pm') ? 'checked="checked"' : '' ?>>&nbsp;pm</label>
                        </div>
                    </div>
                </fieldset><br style="clear:both;" />

                <hr /><br style="clear:both;" />
                <fieldset>
                    <legend>Excepciones / Asuetos del usuario </legend>
                    <div class="TabPanelContent">
                    <?php foreach($excepciones as $i => $excepcion): ?>
                        <div class="titulo-mediano">Fecha de inicio:</div>
                        <div class="col-Field"><?php echo $excepcion['fecha_inicio'] ?></div>
                        <div class="titulo-mediano">Fecha de fin:</div>
                        <div class="col-Field"><?php echo $excepcion['fecha_fin'] ?></div>
                        <?php if($excepcion['hora_inicio'] != ''): ?>
                        <div class="titulo-mediano">Horario:</div>
                        <div class="col-Field"><?php echo $excepcion['hora_inicio'] ?> a <?php echo $excepcion['hora_fin'] ?></div>
                        <?php endif; ?>
                        <div class="bar-serv">
                            <a href="<?php echo url_format('usuarios/eliminar-excepcion', array('usuario' => $id, 'excepcion' => $excepcion['id'])) ?>" onclick="return confirm('Estas seguro de eliminar esta excepcion laboral')">Eliminar</a>
                        </div>
                        <br style="clear:both;" /><br style="clear:both;" />
                    <?php endforeach; ?>
                    </div>
                    <div class="serv-title" style="float: right">
                        <a href="<?php echo url_format('usuarios/excepciones', array('usuario' => $id)) ?>">A&ntilde;adir excepciones</a><br/>
                    </div>
                </fieldset><br style="clear:both;" />


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