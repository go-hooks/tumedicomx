<?php
defined('JZ_UPALE') or die('Acceso Incorrecto');
define('CONTROLLER', 'Permisos');

authenticar();
if (!hasPermission('acceso_usuarios')) { go_to('acceso/denegado');
}

function permisos_usuarios($aExt = array()) {
	if (!hasPermission('perm_modificar')) { go_to('acceso/denegado');
	}

	require_once MODEL_PATH . DS . 'usuariosModel.php';

	$aGet = http_get_request();
	$aGet = array_merge($aGet, $aExt);

	if (isset($aGet['usuario']) && is_numeric($aGet['usuario'])) {
		if ($aU = obtener_datos_usuario($aGet['usuario'])) {

			set_header(array(
				'section' => sprintf('Permisos del usuario "%s"', $aU['nombre_completo']),
				'libraries' => array('Jquery')
			));

			$vec_permisos = obtener_todos_los_permisos();

			$perms = obtener_permisos_de_usuario($aU['id'], $aU['departamento_id']);

			$aData['label_titulo'] = 'Permisos del usuario ' . $aU['nombre_completo'];
			$aData['label_regresar'] = 'Listado de usuarios';
			$aData['url_regresar'] = url_format('usuarios/listado');
			$aData['url_action_form'] = url_format('permisos/usuario-guardar');
			$aData['campos_ocultos'] = array('usuario' => $aU['id']);
			$aData['vec_permisos'] = $vec_permisos;
			$aData['permisos'] = $perms;
			$aData['label_legend'] = 'Algunos permisos han sido heredados de el departamento y el cargo de cada usuario.';

			if (isset($aGet['msg_notice'])) {
				$aData['msg_notice'] = $aGet['msg_notice'];
			}
			if (isset($aGet['msg_success'])) {
				$aData['msg_success'] = $aGet['msg_success'];
			}
			if (isset($aGet['msg_unsuccess'])) {
				$aData['msg_unsuccess'] = $aGet['msg_unsuccess'];
			}

			$sPermisos = load_template(CONTROLLER . DS . '_permisosListado.php', $aData);
			return $sPermisos;
		}
	}
}

function permisos_usuarioGuardar() {
	if (!hasPermission('perm_modificar')) { go_to('acceso/denegado');
	}

	require_once MODEL_PATH . DS . 'usuariosModel.php';

	$aPost = http_post_request();
	if (isset($aPost['usuario']) && is_numeric($aPost['usuario'])) {
		if ($aU = obtener_datos_usuario($aPost['usuario'])) {
			foreach ($aPost as $key => $value) {
				if (substr($key, 0, 5) == "perm_") {
					$permiso_id = str_replace("perm_", "", $key);
					if ($value == "x") {
						$sSqlDelete = "DELETE FROM permisos_de_usuarios " . "WHERE 1 = 1 " . "    AND usuario_id = :usuario_id " . "    AND permiso_id = :permiso_id;";

						$oConnection = db_connect();
						mysql_bind($sSqlDelete, array(
							'usuario_id' => $aPost['usuario'],
							'permiso_id' => $permiso_id
						));

						$oResult = mysql_query($sSqlDelete, $oConnection);
						unset($oConnection);
						continue;
					}

					$sSqlInsert = "REPLACE INTO permisos_de_usuarios " . "SET " . "usuario_id = :usuario_id, " . "permiso_id = :permiso_id, " . "valor = :valor, " . "created_at = :created_at;";
					$oConnection = db_connect();
					mysql_bind($sSqlInsert, array(
						'usuario_id' => $aPost['usuario'],
						'permiso_id' => $permiso_id,
						'valor' => $value,
						'created_at' => date("Y-m-d H:i:s")
					));

					$oResult = mysql_query($sSqlInsert, $oConnection);
					unset($oConnection);
				}
			}

			return permisos_usuarios(array(
				'usuario' => $aPost['usuario'],
				'msg_success' => 'Se han actualizado los permisos del usuario ' . $aU['nombre_completo'] . '.'
			));
		}
	}
}
