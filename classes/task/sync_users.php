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
 * Sync users task
 *
 * @package   auth_wsr
 * @copyright FCEDU UNER based on Daniel Neis Araujo <danielneis@gmail.com> work
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace auth_wsr\task;

defined('MOODLE_INTERNAL') || die();

/**
 * @package   auth_wsr
 */
class sync_users extends \core\task\scheduled_task
{

    /**
     * Name for this task.
     *
     * @return string
     */
    public function get_name(): string
    {
        return get_string('syncuserstask', 'auth_wsr');
    }

    /**
     * Run task for synchronising users.
     * @return void
     */
    public function execute(): void
    {
        if (!is_enabled_auth('wsr')) {
            mtrace('[auth_wsr] El plugin está deshabilitado. Sincronización cancelada.');
            return;
        }

        $auth = get_auth_plugin('wsr');

        if (!method_exists($auth, 'sync_users')) {
            mtrace('[auth_wsr] El plugin no implementa sync_users().');
            return;
        }

        $config = get_config('auth_wsr');
        $trace = new \text_progress_trace();
        $update = !empty($config->updateusers);

        mtrace('[auth_wsr] Iniciando sincronización de usuarios.');

        $auth->sync_users($trace, $update);

        mtrace('[auth_wsr] Sincronización finalizada.');
    }
}
