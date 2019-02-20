<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;  charset=UTF-8" />
        <link type="image/x-icon" href="<?php echo URL_IMAGES; ?>favicon.ico" rel="shortcut icon"/>
        <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo URL_CSS?>login.css">
        <script src="https://code.jquery.com/jquery.js"></script>
        <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
        <?php echo render_header() ?>
	</head>
    <body>
    	<div class="container">
    		<div class="row">
    			<div class="col-sm-6 col-sm-offset-3 padding-top">
    				<div class="box">
    					<?php echo $sloginContent ?>
	    				<hr />
	    				<div class="center-block">
	    					<p class="text-muted">
		    					TU MEDICO MX <?PHP echo date('Y')?>
		    				</p>
	    				</div>
    				</div>
    			</div>
    		</div>
		</div>    
    </body>
</html>
