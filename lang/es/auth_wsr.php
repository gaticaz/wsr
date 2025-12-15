<?php
// Este archivo forma parte de Moodle - http://moodle.org/
//
// Moodle es software libre: puede redistribuirlo y/o modificarlo
// bajo los términos de la Licencia Pública General de GNU publicada por
// la Free Software Foundation, ya sea la versión 3 de la Licencia o
// (a su elección) cualquier versión posterior.
//
// Moodle se distribuye con la esperanza de que sea útil,
// pero SIN NINGUNA GARANTÍA; ni siquiera la garantía implícita de
// COMERCIABILIDAD o IDONEIDAD PARA UN PROPÓSITO PARTICULAR. Consulte la
// Licencia Pública General de GNU para obtener más detalles.
//
// Debería haber recibido una copia de la Licencia Pública General de GNU
// junto con Moodle. De no ser así, consulte <http://www.gnu.org/licenses/>.

/**
 * Strings for component 'auth_wsr', language 'es'.
 *
 * @package   auth_wsr
 * @copyright 2025 UNER FCEDU basado en el trabajo de Daniel Neis Araujo.
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['pluginname'] = 'Autenticación por servicio web';
$string['pluginname_help'] = 'Permite autenticar usuarios contra un servicio web externo.';

$string['auth_wsdescription'] = 'Este complemento autentica usuarios contra un servicio web externo.';

$string['serverurl'] = 'URL del servidor de autenticación';
$string['serverurl_desc'] = 'URL completa del servicio web que ejecuta la autenticación.';

$string['default_params'] = 'Parámetros por defecto';
$string['default_params_desc'] = 'Parámetros enviados en cada llamada al servicio web. Formato: clave:valor,clave:valor';

$string['auth_function'] = 'Función para autenticación';
$string['auth_function_desc'] = 'Nombre de la función del servicio web utilizada para autenticar.';

$string['auth_function_username_paramname'] = 'Parámetro de usuario';
$string['auth_function_username_paramname_desc'] = 'Nombre del parámetro que representa el nombre de usuario en el servicio web.';

$string['auth_function_password_paramname'] = 'Parámetro de contraseña';
$string['auth_function_password_paramname_desc'] = 'Nombre del parámetro que representa la contraseña en el servicio web.';

$string['auth_function_resultClass'] = 'Clase de resultado';
$string['auth_function_resultClass_desc'] = 'Clase que contiene el resultado devuelto por el servicio web.';

$string['auth_function_resultField'] = 'Campo de resultado';
$string['auth_function_resultField_desc'] = 'Campo de la clase de resultado que indica si la autenticación fue válida.';

$string['guarani_auth_method_key'] = 'Método de autenticación';
$string['guarani_auth_method'] = 'Método utilizado para la autenticación REST';

$string['auth_guarani_basic'] = 'Basic';
$string['auth_guarani_digest'] = 'Digest';

$string['auth_username_rest'] = 'Usuario REST';
$string['auth_username_rest_desc'] = 'Usuario utilizado para la conexión al servicio REST.';

$string['auth_password_rest'] = 'Contraseña REST';
$string['auth_password_rest_desc'] = 'Contraseña utilizada para la conexión al servicio REST.';

$string['changepasswordurl'] = 'URL para cambio de contraseña';
$string['changepasswordurl_desc'] = 'URL externa donde los usuarios pueden cambiar su contraseña.';

$string['syncuserstask'] = 'Sincronizar usuarios desde auth_wsr';

$string['password_encryption'] = 'Cifrado de la clave';
$string['password_encryption_desc'] = 'Algoritmo utilizado para cifrar la clave enviada al servicio web. Use MD5 solo por compatibilidad con sistemas antiguos.';


/**
 * Privacy API
 */
$string['privacy:metadata'] = 'El plugin auth_wsr no almacena datos personales.';
