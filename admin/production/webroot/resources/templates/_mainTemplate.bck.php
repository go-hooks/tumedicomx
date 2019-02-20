<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"  />
        <link type="image/x-icon" href="<?php echo URL_IMAGES; ?>favicon.ico" rel="shortcut icon"/>
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"/>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places&region=MX"></script>

        <?php echo render_header() ?>
    </head>
    <body>
        <div id="wrapper">
            <div id="inner">
                <div id="structure">
                    
                    <div id="header">
                        <div id="current-date" style="float:right; margin:0px; position:absolute; right:10px; top:10px; font-size:12px; color:#fff;"></div>
                        <div id="logo"><img src="<?php echo URL_IMAGES; ?>logo.png"/></div>
                        <div id="seccionTitle">
                        	
                        	<?php if(defined('MODULE_TITLE')):?>
                    			<?php  echo MODULE_TITLE; ?>
                    		<?php else: ?>
                            	<?php  echo @CONTROLLER; ?>
                            <?php endif; ?>

                            <?php if(isset($aMetas['section'])):?>
                            	<span> <?php echo $aMetas['section']?></span>
                            <?php endif; ?>
                        </div>
                        <div id="personalNav">
                            <!-- Menu de bienvenida y perfil -->
                            <ul class="navwelcom">
                                <li>
                                    <?php if(isset($_SESSION["upale_usuario"])): ?>
                                        <a href="<?php echo url_format('usuarios/mi-perfil') ?>">Bienvenid@ <?php echo $_SESSION['upale_usuario_nombre'] ?></a>
                                    <?php endif; ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <div id="body">
                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                            <tbody>
                                <tr>
                                    <td id="left" class="leftLayout" valign="top">
                                        <table width="160" cellspacing="0" cellpadding="0" border="0">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div id="left">
                                                            <!-- Menu izquierdo (shortcuts) -->
                                                            <p>
                                                                <table width="100%" cellspacing="0" cellpadding="0" border="0" class="wrapshortcut">
                                                                    <tbody>
                                                                        <tr>
                                                                            <th width="100%" class="titleshortcut">Men&uacute;</th>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </p>
                                                            <?php echo app_render_nav_menu() ?>
                                                        </div>  
                                                    </td>  
                                                </tr>  
                                            </tbody>
                                        </table>  
                                    </td>
                                    <td id="main" class="mainLayout" valign="top">
                                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <?php flash()?>
                                                        <?php echo $sContent ?>
                                                    </td>
                                                </tr>  
                                            </tbody>
                                        </table>  
                                    </td>  
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <footer>
        	
        	<div class="container">
        		<div class="row">
        			<div class="col-sm-3">
        				<?php echo paginate_position(); ?>
        			</div>
        			<div class="col-sm-6">
	        			<div id="paginator">
		        			<?php paginate_helper(9); ?>
		        		</div>   				
        			</div>
        			<div class="col-sm-3">
        				<div id="sign">
		        			Esta aplicación fue desarrollada por <br /> 
		        			&copy; <a href="http://www.sustam.com" target="_blank">Sustam.com </a> 
		        			<span><?php echo date('Y')?></span>
		        		</div>  
        			</div>
        		</div>        		
        	</div>
        </footer>
    </body>
</html>
