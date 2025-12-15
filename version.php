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
 * Detalles de versión
 *
 * @package    auth_wsr
 * @copyright  2025 UNER FCEDU en base al trabajo de Daniel Neis Araujo.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$plugin->version   = 2025070100;
$plugin->requires  = 2022041900; // Moodle 4.0+
$plugin->component = 'auth_wsr';
$plugin->maturity  = MATURITY_STABLE;
$plugin->release = '1.1.0 (Moodle 4.x)';
