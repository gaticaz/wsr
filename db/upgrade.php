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
 * WSR authentication plugin upgrade code
 *
 * @package    auth_wsr
 * @copyright  2019 UNER FCEDU based on Daniel Neis Araujo work
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
