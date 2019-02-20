<?php

if ( isset($_POST['contact']) ) {
	
	$aContact = $_POST['contact'];

	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type:text/html; charset=utf-8' . "\r\n";
	
	$to = "francisco@sustam.com  ";
	
	$subject = 'Formulario de Contacto Avexpress';
	
	$message = '<br />
				<p> Datos enviados desde el formulario de contacto Income </p>
				<p> <strong>Nombre: </strong>'. $aContact['name'] .'</p>
				<p> <strong>Compañia: </strong>'. $aContact['company'] .'</p>
				<p> <strong>Mensaje: </strong> <br />'. $aContact['msg'] .'</p>';
	
	if ( !isset($aContact['name']) || ($aContact['name'] == "") || !isset($aContact['msg']) || ($aContact['msg'] == "") || !isset($aContact['company']) || ($aContact['company'] == "") ) {
		echo '<p class="alert error">Falta campos marcados(*) ó los datos nos son validos.</p>
				    <div class="content">
			        <div class="column1">
			            <div class="titulo">Escríbenos un Mensaje</div>
			            <div class="sub-texto">Nosotros nos pondremos en contacto contigo</div>
			            <div class="linea"></div>

			            <div class="texto-bold">Aveespress S.A de C.V.<br>Direcciones</div>
			            <div class="texto">Uruapan, Michoacán, México:<br>
			            Aeropuerto Nacional de Uruapan,<br>
			            Hangares H-13 San Jose Obregon. CP 60160<br><br>
			            Tlajomulco de Zúñiga, Jalisco:<br>
			            Aeropuerto Intl de Guadalajara.<br>
			            Hgr 2, Fila 8. CP 45659.<br><br>
			            </div>
			            <div class="texto-bold">Dirección Operativa. Tel.33 3688 5019</div><br>
			            <div class="texto-bold">Guadalajara</div>
			            <div class="texto"><strong>E-mail sobre Información General,<br>
			            Bolsa de Trabajo, Cotizaciones</strong><br>
			            Elena@avexpress.com.mx<br>
			            <div class="texto-bold">Tel.33 3688 5648</div><br>
			            </div>
			            <div class="texto-bold">Uruapan</div>
			            <div class="texto"><strong>E-mail sobre Información General,<br>
			            Bolsa de Trabajo, Cotizaciones</strong><br>
			            Elena@avexpress.com.mx<br>
			            <div class="texto-bold">Tel.452 524 9601/02</div><br><br>
			            </div>
			        </div>
			        <div class="column2">
			                <form>
			                    <label>Nombre</label><br>
			                    <input type="text" name="nombre" size="35"><br>
			                    <label>Compañia</label><br>
			                    <input type="text" name="compania" size="35"><br>
			                    <label>Mensaje</label><br>
			                    <textarea name="mensaje" cols="38" rows="7"></textarea><br>
			                    <input type="submit" value="Enviar">
			                </form>
			        </div>
			    </div>';

	} else {
		if ( !mail($to, $subject, $message, $headers) ) {
			echo "Ocurrió un error al enviar el mensaje. Por favor vuelva a intentarlo más tarde.";
		} else {
			echo '<p class="alert success">Tu mensaje a sido enviado, te contactaremos tan pronto como sea posible. ¡Gracias!</p>
					    <div class="content">
				        <div class="column1">
				            <div class="titulo">Escríbenos un Mensaje</div>
				            <div class="sub-texto">Nosotros nos pondremos en contacto contigo</div>
				            <div class="linea"></div>

				            <div class="texto-bold">Aveespress S.A de C.V.<br>Direcciones</div>
				            <div class="texto">Uruapan, Michoacán, México:<br>
				            Aeropuerto Nacional de Uruapan,<br>
				            Hangares H-13 San Jose Obregon. CP 60160<br><br>
				            Tlajomulco de Zúñiga, Jalisco:<br>
				            Aeropuerto Intl de Guadalajara.<br>
				            Hgr 2, Fila 8. CP 45659.<br><br>
				            </div>
				            <div class="texto-bold">Dirección Operativa. Tel.33 3688 5019</div><br>
				            <div class="texto-bold">Guadalajara</div>
				            <div class="texto"><strong>E-mail sobre Información General,<br>
				            Bolsa de Trabajo, Cotizaciones</strong><br>
				            Elena@avexpress.com.mx<br>
				            <div class="texto-bold">Tel.33 3688 5648</div><br>
				            </div>
				            <div class="texto-bold">Uruapan</div>
				            <div class="texto"><strong>E-mail sobre Información General,<br>
				            Bolsa de Trabajo, Cotizaciones</strong><br>
				            Elena@avexpress.com.mx<br>
				            <div class="texto-bold">Tel.452 524 9601/02</div><br><br>
				            </div>
				        </div>
				        <div class="column2">
				                <form>
				                    <label>Nombre</label><br>
				                    <input type="text" name="nombre" size="35"><br>
				                    <label>Compañia</label><br>
				                    <input type="text" name="compania" size="35"><br>
				                    <label>Mensaje</label><br>
				                    <textarea name="mensaje" cols="38" rows="7"></textarea><br>
				                    <input type="submit" value="Enviar">
				                </form>
				        </div>
				    </div>';
		}
	}
}



function validEmail($email)
{
	$isValid = true;
	$atIndex = strrpos($email, "@");
	
	if (is_bool($atIndex) && !$atIndex) {
		$isValid = false;
	}
	else {
		$domain    = substr($email, $atIndex+1);
		$local     = substr($email, 0, $atIndex);
		$localLen  = strlen($local);
		$domainLen = strlen($domain);

		if ($localLen < 1 || $localLen > 64) {
			// local part length exceeded
			$isValid = false;
		}
		else if ($domainLen < 1 || $domainLen > 255) {
			// domain part length exceeded
			$isValid = false;
		}
		else if ($local[0] == '.' || $local[$localLen-1] == '.') {
			// local part starts or ends with '.'
			$isValid = false;
		}
		else if (preg_match('/\\.\\./', $local)) {
			// local part has two consecutive dots
			$isValid = false;
		}
		else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain)) {
			// character not valid in domain part
			$isValid = false;
		}
		else if (preg_match('/\\.\\./', $domain)) {
			// domain part has two consecutive dots
			$isValid = false;
		}
		else if (!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/', str_replace("\\\\","",$local))) {
			// character not valid in local part unless  local part is quoted
			if (!preg_match('/^"(\\\\"|[^"])+"$/', str_replace("\\\\","",$local))) {
				$isValid = false;
			}
		}
		if ($isValid && !(checkdnsrr($domain,"MX") || checkdnsrr($domain,"A"))) {
			// domain not found in DNS
			$isValid = false;
		}
	}
	return $isValid;
}

?>