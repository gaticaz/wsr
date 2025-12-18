<?php
// Este archivo forma parte de Moodle - http://moodle.org/
//
// Moodle es software libre: puede redistribuirlo y/o modificarlo
// bajo los t�rminos de la Licencia P�blica General de GNU publicada por
// la Free Software Foundation, ya sea la versi�n 3 de la Licencia o
// (a su elecci�n) cualquier versi�n posterior.
//
// Moodle se distribuye con la esperanza de que sea �til,
// pero SIN NINGUNA GARANT�A; ni siquiera la garant�a impl�cita de
// COMERCIABILIDAD o IDONEIDAD PARA UN PROP�SITO PARTICULAR. Consulte la
// Licencia P�blica General de GNU para obtener m�s detalles.
//
// Deber�a haber recibido una copia de la Licencia P�blica General de GNU
// junto con Moodle. De no ser as�, consulte <http://www.gnu.org/licenses/>.

/**
 * Configuraciones y valores predeterminados de autenticaci�n de servicio web externo.
 * @package auth_wsr
 * @copyright 2025 UNER FCEDU
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();
require_once($CFG->libdir . '/authlib.php');

if ($ADMIN->fulltree) {

    // Heading.
    $settings->add(new admin_setting_heading(
        'auth_wsr_settings',
        get_string('pluginname', 'auth_wsr'),
        get_string('auth_wsdescription', 'auth_wsr')
    ));

    $settings->add(new admin_setting_configtext(
        'auth_wsr/serverurl',
        get_string('serverurl', 'auth_wsr'),
        get_string('serverurl_desc', 'auth_wsr'),
        '',
        PARAM_URL
    ));

    $settings->add(new admin_setting_configtext(
        'auth_wsr/default_params',
        get_string('default_params', 'auth_wsr'),
        get_string('default_params_desc', 'auth_wsr'),
        '',
        PARAM_TEXT
    ));

    $settings->add(new admin_setting_configtext(
        'auth_wsr/auth_function',
        get_string('auth_function', 'auth_wsr'),
        get_string('auth_function_desc', 'auth_wsr'),
        '',
        PARAM_TEXT
    ));

    $settings->add(new admin_setting_configtext(
        'auth_wsr/auth_function_username_paramname',
        get_string('auth_function_username_paramname', 'auth_wsr'),
        get_string('auth_function_username_paramname_desc', 'auth_wsr'),
        '',
        PARAM_TEXT
    ));

    $settings->add(new admin_setting_configtext(
        'auth_wsr/auth_function_password_paramname',
        get_string('auth_function_password_paramname', 'auth_wsr'),
        get_string('auth_function_password_paramname_desc', 'auth_wsr'),
        '',
        PARAM_TEXT
    ));

    $encryptoptions = [
        'md5'    => 'MD5 (compatibilidad / legado)',
        'bcrypt' => 'bcrypt (recomendado, más seguro)'
    ];

    $settings->add(new admin_setting_configselect(
        'auth_wsr/password_encryption',
        get_string('password_encryption', 'auth_wsr'),
        get_string('password_encryption_desc', 'auth_wsr'),
        'md5',
        $encryptoptions
    ));


    // Auth method options.
    $authopt = [
        'basic'  => get_string('auth_guarani_basic', 'auth_wsr'),
        'digest' => get_string('auth_guarani_digest', 'auth_wsr'),
    ];

    $settings->add(new admin_setting_configselect(
        'auth_wsr/auth_method',
        get_string('guarani_auth_method_key', 'auth_wsr'),
        get_string('guarani_auth_method', 'auth_wsr'),
        'basic',
        $authopt
    ));

    $settings->add(new admin_setting_configtext(
        'auth_wsr/auth_username_rest',
        get_string('auth_username_rest', 'auth_wsr'),
        get_string('auth_username_rest_desc', 'auth_wsr'),
        '',
        PARAM_TEXT
    ));

    $settings->add(new admin_setting_configpasswordunmask(
        'auth_wsr/auth_password_rest',
        get_string('auth_password_rest', 'auth_wsr'),
        get_string('auth_password_rest_desc', 'auth_wsr'),
        '',
        PARAM_TEXT
    ));

    $settings->add(new admin_setting_configtext(
        'auth_wsr/auth_function_resultClass',
        get_string('auth_function_resultClass', 'auth_wsr'),
        get_string('auth_function_resultClass_desc', 'auth_wsr'),
        '',
        PARAM_TEXT
    ));

    $settings->add(new admin_setting_configtext(
        'auth_wsr/auth_function_resultField',
        get_string('auth_function_resultField', 'auth_wsr'),
        get_string('auth_function_resultField_desc', 'auth_wsr'),
        '',
        PARAM_TEXT
    ));

    $settings->add(new admin_setting_configtext(
        'auth_wsr/changepasswordurl',
        get_string('changepasswordurl', 'auth_wsr'),
        get_string('changepasswordurl_desc', 'auth_wsr'),
        '',
        PARAM_URL
    ));

    // User removal options.
    $deleteopt = [
        AUTH_REMOVEUSER_KEEP       => get_string('auth_remove_keep', 'auth'),
        AUTH_REMOVEUSER_SUSPEND    => get_string('auth_remove_suspend', 'auth'),
        AUTH_REMOVEUSER_FULLDELETE => get_string('auth_remove_delete', 'auth'),
    ];

    $settings->add(new admin_setting_configselect(
        'auth_wsr/removeuser',
        get_string('auth_remove_user_key', 'auth'),
        get_string('auth_remove_user', 'auth'),
        AUTH_REMOVEUSER_KEEP,
        $deleteopt
    ));
}
