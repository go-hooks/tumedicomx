<form id="formLogin" name="formLogin" method="post" action="<?php echo url_format('home') ?>">
    <table cellspacing="0" cellpadding="0" border="0" width="750" height="500px" align="center" class="centerLayout">
        <tbody>
            <tr>
                <td width="340" rowspan="2" style="vertical-align: top"><img src="<?php echo URL_IMAGES ?>agencia.jpg" border="0" style="margin:0px; padding:0px;" /></td>
                <td align="center"></td>
            </tr>
            <tr>
                <td align="center" class="tabForm">
                    <table width="95%" cellspacing="2" cellpadding="2" border="0" style="margin:5px;" id="login">
                        <tbody>
                            <tr>
                                <td colspan="2"><img src="<?php echo URL_IMAGES ?>bienvenido.jpg" border="0" style="margin:0px; padding:0px;" /></td>
                            </tr>
                            <tr>
                                <td width="100%" colspan="2" class="dataLabel">Por favor introduce tus datos para identificarte:</td>
                            </tr>
                        <?php if(isset($sErrorMessage)): ?>
                            <tr>
                                <td colspan="2" align="center" style="padding:0 5px; 0 0"><p class="error"><?php echo $sErrorMessage ?></p></td>
                            </tr>
                            <tr>
                                <td colspan="2">&nbsp;</td>
                            </tr>
                        <?php else: ?>
                            <tr>
                                <td colspan="2">&nbsp;</td>
                            </tr>
                        <?php endif; ?>
                            
                            <?php if(isset($error) && $error == '1010000'): ?>
                            
                            <?php else: ?>
                                <tr>
                                    <td width="30%" class="dataLabel">Usuario:</td>
                                    <td width="65%"><input type="text" value="" name="username" id="username" tabindex="1" size="20" class="inputForm"/></td>
                                </tr>
                                <tr>
                                    <td class="dataLabel">Contrase&ntilde;a:</td>
                                    <td><input type="password" value="" name="password" id="password" tabindex="2" size="20" class="inputForm" /></td>
                                </tr>
                                <tr>
                                    <td colspan="2">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="right">
                                        <input type="image" src="<?php echo URL_IMAGES ?>btn_entrar.jpg" style="margin-right: 90px" />
                                    </td>
                                </tr>
                            <!--
                                <tr>
                                    <td colspan="2">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="dataLabel">
                                        <a href="index.php?action=lostpass">&iquest;Olvid&oacute; su contrase&ntilde;a?</a>
                                    </td>
                                </tr> -->
                            <?php endif; ?>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</form>
