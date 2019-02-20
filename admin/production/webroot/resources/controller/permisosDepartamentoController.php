<?php
  /** ---------------------------------------------------- *
    * Upale Operativo                                      *
    * upale.com                                            *
    * ---------------------------------------------------- *
    * Archivo:      permisosDepartamentoController.php                  *
    * Descripcion:	controlador para los permisos de un departamento     *
    * Autor: 	    Omar Alejandro Garcia Santacruz     *
    * E-mail:		alejandro.delpiero@gmail.com                  *
    * ---------------------------------------------------- *
    */

defined('JZ_UPALE')
    or die('Acceso Incorrecto');
define('CONTROLLER', "Permisos");

authenticar();
if (! hasPermission('acceso_departamentos')) { go_to('acceso/denegado'); }

function permisosDepartamento_departamento($aExt = array())
{
    if (! hasPermission('perm_modificar')) { go_to('acceso/denegado'); }

    require_once MODEL_PATH . DS . 'departamentosModel.php';
    
    $aGet = http_get_request();
    $aGet = array_merge($aGet, $aExt);

    if (isset($aGet['departamento_id']) && is_numeric($aGet['departamento_id'])) {
        if ($aD = obtener_datos_departamento($aGet['departamento_id'])) {
            set_header(array(
                'section'   => 'Permisos del grupo',
                'libraries' => array('Jquery')
            ));
            
            $vec_permisos = obtener_todos_los_permisos();
            $perms = obtener_permisos_por_departamento($aGet['departamento_id']);

            $aData['label_titulo'] = 'Permisos para el grupo: ' . $aD['nombre'];
            $aData['label_regresar'] = 'Listado de grupos';
            $aData['url_regresar'] = url_format('departamentos/listado');
            $aData['url_action_form'] = url_format('permisos-departamento/departamento-guardar' , array('departamento_id' => $aD['id']));
            $aData['campos_ocultos'] = array('departamento_id' => $aD['id']);
            $aData['vec_permisos'] = $vec_permisos;
            $aData['permisos'] = $perms;
            
            if (isset($aGet['msg_notice'])) {
                $aData['msg_notice'] = $aGet['msg_notice'];
            }
            if (isset($aGet['msg_success'])) {
                $aData['msg_success'] = $aGet['msg_success'];
            }
            if (isset($aGet['msg_unsuccess'])) {
                $aData['msg_unsuccess'] = $aGet['msg_unsuccess'];
            }

            $sPermisos = load_template(CONTROLLER . DS .'_permisosDepartamentoListado.php', $aData);
            return $sPermisos;
        }
    }
}


function permisosDepartamento_departamentoGuardar()
{
    if (! hasPermission('perm_modificar')) { go_to('acceso/denegado'); }

    require_once MODEL_PATH . DS . 'departamentosModel.php';

    $aPost = http_post_request();
    if (isset($aPost['departamento_id']) && is_numeric($aPost['departamento_id'])) {
        if ($aD = obtener_datos_departamento($aPost['departamento_id'])) {
            foreach ($aPost as $key => $value):
                  if (substr($key, 0, 5) == "perm_") {
                     $permisoId = str_replace("perm_", "" ,$key);
                     if ($value == "x") {
                         $sSql = "DELETE FROM permisos_de_departamentos "
                               . "   WHERE departamento_id = :departamento_id "
                               . " AND permiso_id = :permiso_id ";
                         mysql_bind($sSql, array('permiso_id' => $permisoId , 'departamento_id' => $aPost['departamento_id']));

                         db_eliminar_por_sql($sSql);
                         continue;
                    }

                    $sSqlInsert = "REPLACE INTO permisos_de_departamentos "
                                . " SET "
                                . " departamento_id = :departamento_id, permiso_id = :permiso_id, "
                                . " valor = :valor, created_at = :created_at;";

                    $oConnection = db_connect();
                    mysql_bind($sSqlInsert, array(
                        'departamento_id' => $aPost['departamento_id'],
                        'permiso_id' => $permisoId,
                        'valor'      => $value,
                        'created_at' => date ("Y-m-d H:i:s")
                    ));
                    $oResult = mysql_query($sSqlInsert, $oConnection);
                    unset($oConnection);
                  }
           endforeach;
           return permisosDepartamento_departamento(array(
                'msg_success' => 'Se han actualizado los permisos del grupo "'.$aD['nombre'].'".'
            ));
        }
    }

}