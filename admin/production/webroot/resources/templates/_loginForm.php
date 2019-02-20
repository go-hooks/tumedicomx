<div class="row">
	<div class="col-sm-5">
		<img  class="img-responsive" src="<?php echo URL_IMAGES ?>logo.png"  />
	</div>
	<div class="col-sm-7">

		<h1>ADMINISTRADOR <span>BIENVENIDO</span></h1>
	</div>
</div>

<?php if(!isset($error) || $error != '1010000'):
?>
<hr />
<div class="row">
	<div class="col-sm-5">
		<?php if(isset($sErrorMessage)):?>
		<div class="alert alert-warning">
			<?php echo $sErrorMessage; ?>
		</div>
		<?php else: ?>
		<div class="alert alert-info">
			Por favor introduce tus datos para identificarte:
		</div>
		<?php endif ?>
	</div>
	<div class="col-sm-7">
		<form class="form-horizontal" role="form" id="formLogin" name="formLogin" method="post" action="<?php echo url_format('home') ?>">
			<div class="form-group">
				<label class="_col-sm-3 control-label">Usuario:</label>
				<div class="_col-sm-9">
					<input required="required" type="text" class="form-control" value="" name="username" id="username" tabindex="1" size="20" class="inputForm"/>
				</div>
			</div>

			<div class="form-group">
				<label class="_col-sm-3 control-label">Contrase&ntilde;a:</label>
				<div class="_col-sm-9">
					<input required="required" type="password" class="form-control" value="" name="password" id="password" tabindex="2" size="20" class="inputForm" />
				</div>
			</div>
			<div class="form-group">
				<div class="_col-sm-9 _col-sm-offset-3">
					<button type="submit" class="btn btn-primary" >
						Entrar
					</button>
				</div>
			</div>
		</form>

	</div>
</div>
<?php endif; ?>