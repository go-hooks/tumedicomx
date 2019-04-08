<?php
	/**
	 * MySQLConnect.class.php
	 * Motor de conexion con la base de datos MySQL
	 * @autor: 
	 * --------------------------------------------------- 
	 */
 
	class MySQLConnect {
		/* Variables de conexion */
		var $_sDb_name;
		var $_sDb_host;
		var $_sDb_user;
		var $_sDb_pass;
		
		/* Identificador de conexion y consulta */
		var $_nDb_ID_connection = 0;
		var $_nDb_ID_query = 0;
		
		/* Codigo de error y mensaje de error */
		var $_nDb_Error = 0;
		var $_sDb_Error = "";
		
		/* Constructor */
		function MySQLConnect($sDb_name = DB_NAME, $sDb_host = DB_HOST, $sDb_user = DB_USER, $sDb_pass = DB_PASSWORD){
			$this->_sDb_name = $sDb_name;
			$this->_sDb_host = $sDb_host;
			$this->_sDb_user = $sDb_user;
			$this->_sDb_pass = $sDb_pass;
		}
		
		
		
		/* Conexion a la base de datos */
		function connect($sDb_name = "", $sDb_host = "", $sDb_user = "", $sDb_pass = ""){
			if($sDb_name != "") $this->_sDb_name = $sDb_name;
			if($sDb_host != "") $this->_sDb_host = $sDb_host;
			if($sDb_user != "") $this->_sDb_user = $sDb_user;
			if($sDb_pass != "") $this->_sDb_pass = $sDb_pass;
			
			// Conexion al servidor
			$this->_nDb_ID_connection = mysql_connect($this->_sDb_host, $this->_sDb_user, $this->_sDb_pass);
			
			if(!$this->_nDb_ID_connection){
				$this->_sDb_Error = "La conexi&oacute;n con la base da datos no se pudo realizar.";
				return 0;
			}
			
			// Seleccionar la base de datos
			if(!@mysql_select_db($this->_sDb_name, $this->_nDb_ID_connection)){
				$this->_sDb_Error = "Imposible conectarse con la base de datos: ".$this->_sDb_name;
				return 0;
			}
			
			// Si se pudo conectar con la base de datos devuelve el identificador de la conexi&oacute;n.
			return $this->_nDb_ID_connection;
		}
		
		/* Ejecutar una consulta */
		function executeQuery($sQuery){
			if($sQuery == ""){
				$this->_sDb_Error = "No se ha especificado una consulta SQL.";
				return 0;
			}
			
			// Ejecutar la consulta
			$this->_nDb_ID_query = @mysql_query($sQuery, $this->_nDb_ID_connection);
			if(!$this->_nDb_ID_query){
				$this->_nDb_Error = mysql_errno();
				$this->_sDb_Error = mysql_error();
			}
			
			// Si hemos tenido exito devuelve el identificador de la consulta.
			return $this->_nDb_ID_query;
		}
		
		/* Devuelve el n&uacute;mero de campos de una consulta */
		function getNumFields(){
			return mysql_num_fields($this->_nDb_ID_query);
		}
		
		/* Devuelve el n&uacute;mero de registros de una consulta */
		function getNumRows(){
			return mysql_num_rows($this->_nDb_ID_query);
		}
		
		/* Devuelve el nombre de un campo de una consulta */
		function getFieldName($nNumField){
			return mysql_field_name($this->_nDb_ID_query, $nNumField);
		}
		
		/* Devuelve el ID de la conexion */
		function getConectionID(){
			return $this->_nDb_ID_connection;
		}
		
		/* Devuelve el ID de la consulta */
		function getQueryID(){
			return $this->_nDb_ID_query;
		}
		
		/* Devuelve el mensaje de error si es que existe */
		function getErrorMessage(){
			return $this->_sDb_Error;
		}
		
		/* Ver los resultados de la consulta */
		function show(){
			$sReturn_html = '<table border=1>';
			$sReturn_html .= '<thead>';
			$sReturn_html .= '<tr>';
			for($i = 0; $i < $this->getNumFields(); $i++){
				$sReturn_html .= '<td><strong>'.$this->getFieldName($i).'</strong></td>';
			}
			$sReturn_html .= '</tr>';
			$sReturn_html .= '</thead>';
			$sReturn_html .= '<tbody>';
			while($aRow = mysql_fetch_array($this->_nDb_ID_query)){
				$sReturn_html .= '<tr>';
				for($i = 0; $i < $this->getNumFields(); $i++){
					$sReturn_html .= '<td>'.$aRow[$i].'</td>';
				}
				$sReturn_html .= '</tr>';
			}
			$sReturn_html .= '</tbody>';
			$sReturn_html .= '</table>';
			
			echo $sReturn_html;
		}
	}
?>