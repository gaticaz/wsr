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
 * Plugin de autenticación: Autenticación de servicio web externo
 *
 * Comprueba con un servicio web externo, pensado para usar con siu guaraní.
 *
 * @package    auth_wsr
 * @author     UNER FCEDU based on Daniel Neis Araujo work
 * @license    http://www.gnu.org/copyleft/gpl.html GNU Public License
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/authlib.php');
require_once(__DIR__ . '/classes/bcrypt.php');

use core\http_client;

/**
 * Plugin de autenticación: Autenticación de servicio web externo.
 */

class auth_plugin_wsr extends auth_plugin_base
{

    public $datos;
    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->authtype = 'wsr';
        $this->config = get_config('auth_wsr');

        if (!empty($this->config->default_params)) {
            $params = explode(',', $this->config->default_params);
            $defaultparams = [];

            foreach ($params as $p) {
                if (strpos($p, ':') === false) {
                    continue;
                }
                [$paramname, $value] = explode(':', $p, 2);
                $defaultparams[$paramname] = $value;
            }
            $this->config->wsr_default_params = $defaultparams;
        } else {
            $this->config->wsr_default_params = [];
        }
    }

    /**
     * Devuelve verdadero si el nombre de usuario y la contraseña funcionan y 
     * falso si son incorrectos o no existen.
     *
     * @param string $username El nombre de usuario
     * @param string $password La contraseña
     * @return bool Autenticación exitosa o fallida.
     */
    public function user_login($username, $password): bool
    {
        if (empty($username) || empty($password)) {
            return false;
        }

        $functionname = $this->config->auth_function ?? null;
        if (empty($functionname)) {
            return false;
        }
        // $clave = (md5($password));
        $clave = $this->encrypt_password($password);

        $params = [
            $this->config->auth_function_username_paramname => $username,
            $this->config->auth_function_password_paramname => $clave,
            'metodo' => $this->config->auth_method ?? null,
            'identificacion' => $username,
            'clave' => $clave,
        ];

        return $this->call_wsr($this->config->serverurl, $functionname, $params);
    }

    /**
     * Este plugin está diseñado solo para autenticar usuarios.
     * La sincronización de usuarios debe ser realizada por un servicio externo,
     * utilizando los servicios web de Moodle.
     *
     * @param progress_trace $trace
     * @param bool $doupdates  Opcional: set to true para forzar una actualización de cuentas existentes
     * @return int 0 significa éxito, 1 significa error
     */
    public function sync_users(progress_trace $trace, $doupdates = false): int
    {
        return 0;
    }

    /**
     * User info is managed externally.
     *
     * @param string $username
     * @return array
     */
    public function get_userinfo($username): array
    {
        return [];
    }

    /**
     * Llama al servicio web externo.
     *
     * @param string $serverurl
     * @param string $functionname
     * @param array $params
     * @return bool
     */
    private function call_wsr($serverurl, $functionname, $params = array()): bool
    {
        $params = array_merge($this->config->wsr_default_params, $params);

        $a = !empty($params['a']) ? '/' . $params['a'] . '/' : '/';

        $url = rtrim($serverurl, '/') . '/'
            . $functionname . '/'
            . ($params['identificacion'] ?? '') . $a
            . ($params['clave'] ?? '');

        $ch = curl_init($url);

        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Content-length: 0'
            ],
        ]);

        if (!empty($params['metodo'])) {
            if ($params['metodo'] === 'basic') {
                curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            } elseif ($params['metodo'] === 'digest') {
                curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
            }
        }

        if (!empty($this->config->auth_username_rest) && !empty($this->config->auth_password_rest)) {
            curl_setopt(
                $ch,
                CURLOPT_USERPWD,
                $this->config->auth_username_rest . ':' . $this->config->auth_password_rest
            );
        }

        $response = curl_exec($ch);
        curl_close($ch);

        if ($response === false) {
            return false;
        }

        $data = json_decode($response);

        if (json_last_error() !== JSON_ERROR_NONE || !is_object($data)) {
            return false;
        }

        return !empty($data->valido);
    }

    /**
     * ¿Prevenir contrasen?a local?
     *
     * @return bool
     */
    public function prevent_local_passwords(): bool
    {
        return true;
    }

    /**
     * ¿Es autenticación interna?
     *
     * @return bool
     */
    public function is_internal(): bool
    {
        return false;
    }

    /**
     * ¿Sincronizado con externo?
     *
     * @return bool
     */
    public function is_synchronised_with_external(): bool
    {
        return false;
    }

    /**
     * ¿Puede cambiar la contrasen?a?
     *
     * @return bool
     */
    public function can_change_password(): bool
    {
        return false;
    }

    /**
     * URL para cambio de contrasen?a.
     *
     * @return moodle_url|null
     */
    public function change_password_url()
    {
        if (!empty($this->config->changepasswordurl)) {
            return new moodle_url($this->config->changepasswordurl);
        }
        return null;
    }

    /**
     * ¿Puede resetear la contraseña?
     *
     * @return bool
     */
    public function can_reset_password(): bool
    {
        return false;
    }

    /**
     * Encriptar contrasen?a para autenticación WSR.
     *
     * @param string $password
     * @return string
     */
    private function encrypt_password(string $password): string
    {
        // Config option: bcrypt | md5
        $method = $this->config->password_encryption ?? 'md5';

        if ($method === 'bcrypt') {
            try {
                $bcrypt = new \bcrypt(12);
                $hash = $bcrypt->hash($password);
                if ($hash !== false) {
                    return $hash;
                }
            } catch (\Throwable $e) {
                // Fallback to md5
            }
        }

        // Default / fallback behavior (original)
        return md5($password);
    }
}
