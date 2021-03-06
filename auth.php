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
 * Authentication Plugin: External Webservice Authentication
 *
 * Checks against an external webservice.
 *
 * @package    auth_wsr
 * @author     UNER FCEDU based on Daniel Neis Araujo work
 * @license    http://www.gnu.org/copyleft/gpl.html GNU Public License
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir.'/authlib.php');

/**
 * External webservice authentication plugin.
 */

class auth_plugin_wsr extends auth_plugin_base {

public $datos;
    /**
     * Constructor.
     */
    public function __construct() {
        $this->authtype = 'wsr';
        $this->config = get_config('auth_wsr');

        if (isset($this->config->default_params) && !empty($this->config->default_params)) {
            $params = explode(',', $this->config->default_params);
            $defaultparams = array();
            foreach ($params as $p) {
                list($paramname, $value) = explode(':', $p);
                $defaultparams[$paramname] = $value;
            }
            $this->config->wsr_default_params = $defaultparams;
        } else {
            $this->config->wsr_default_params = array();
        }
    }

    /**
     * Returns true if the username and password work and false if they are
     * wrong or don't exist.
     *
     * @param string $username The username
     * @param string $password The password
     * @return bool Authentication success or failure.
     */
    public function user_login($username, $password) {

        $functionname = $this->config->auth_function;
	$clave = (md5($password));
        $params  = array($this->config->auth_function_username_paramname => $username,
                         $this->config->auth_function_password_paramname => $clave,
			 $this->config->auth_method => $metodo,
			 $this->config->auth_username_rest => $username,
			 $this->config->auth_password_rest => $password);

        $result = $this->call_wsr($this->config->serverurl, $functionname, $params);
	return $result;
    }

    /**
     * This plugin is intended only to authenticate users.
     * User synchronization must be done by external service,
     * using Moodle's webservices.
     *
     * @param progress_trace $trace
     * @param bool $doupdates  Optional: set to true to force an update of existing accounts
     * @return int 0 means success, 1 means failure
     */
    public function sync_users(progress_trace $trace, $doupdates = false) {
        return true;
    }

    public function get_userinfo($username) {
        return array();
    }

    private function call_wsr($serverurl, $functionname, $params = array()) {

        $params = array_merge($this->config->wsr_default_params, $params);
	if (isset($params['a']) && !empty($params['a'])) {
		$params['a'] = '/'.$params['a'].'/';}
	else {
		$params['a'] = '/';
	}
        $serverurl = $serverurl . $functionname.'/'.$params['identificacion'].$params['a'].$params['clave'];

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $serverurl);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        switch ($params['metodo']) {
        case 'basic': curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		break;
	case 'digest': curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
		break;
	}
	$user = $this->config->auth_username_rest;
	$pass = $this->config->auth_password_rest;
	curl_setopt($ch, CURLOPT_USERPWD, "$user:$pass");
	$headr = array();
	$headr[] = 'Content-length: 0';
	$headr[] = 'Content-type: application/json';
	curl_setopt($ch, CURLOPT_HTTPHEADER,$headr);

	try {
		$res = curl_exec($ch);
		curl_close($ch);
		$ok = json_decode($res);
		if($ok->valido == 1){
			return true;
		} else {
			return false;
		}
        } catch (Exception $e) {
            echo "Exception:\n";
            echo $e->getMessage();
            echo "===\n";
            return false;
        }
    }

    public function prevent_local_passwords() {
        return true;
    }

    /**
     * Returns true if this authentication plugin is "internal".
     *
     * Internal plugins use password hashes from Moodle user table for authentication.
     *
     * @return bool
     */
    public function is_internal() {
        return false;
    }

    /**
     * Indicates if moodle should automatically update internal user
     * records with data from external sources using the information
     * from auth_plugin_base::get_userinfo().
     * The external service is responsible to update user records.
     *
     * @return bool true means automatically copy data from ext to user table
     */
    public function is_synchronised_with_external() {
        return false;
    }

    /**
     * Returns true if this authentication plugin can change the user's
     * password.
     *
     * @return bool
     */
    public function can_change_password() {
        return false;
    }

    /**
     * Returns the URL for changing the user's pw, or empty if the default can
     * be used.
     *
     * @return moodle_url
     */
    public function change_password_url() {
        if (isset($this->config->changepasswordurl) && !empty($this->config->changepasswordurl)) {
            return new moodle_url($this->config->changepasswordurl);
        } else {
            return null;
        }
    }

    /**
     * Returns true if plugin allows resetting of internal password.
     *
     * @return bool
     */
    public function can_reset_password() {
        return false;
    }
}
