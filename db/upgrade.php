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
 * WSR autenticación plugin upgrade code
 *
 * @package    auth_wsr
 * @copyright  2025 UNER FCEDU basado en el trabajo de Daniel Neis Araujo.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Upgrade function for auth_wsr.
 *
 * @param int $oldversion
 * @return bool
 */
function xmldb_auth_wsr_upgrade($oldversion)
{
    global $DB;

    // Legacy upgrade: migrate old auth/wsr config to auth_wsr.
    if ($oldversion < 2019021200) {

        upgrade_fix_config_auth_plugin_names('wsr');
        upgrade_fix_config_auth_plugin_defaults('wsr');

        upgrade_plugin_savepoint(true, 2019021200, 'auth', 'wsr');
    }

    /*
     * Future upgrades go here.
     *
     * Example:
     *
     * if ($oldversion < 2024010100) {
     *     // New upgrade step.
     *     upgrade_plugin_savepoint(true, 2024010100, 'auth', 'wsr');
     * }
     */

    return true;
}
