<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Strings for component 'auth_wsr', language 'es'.
 *
 * @package   auth_wsr
 * @copyright UNER FCEDU based on Daniel Neis Araujo work
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
