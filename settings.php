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
 * Hello World admin settings page
 *
 * @package    local_helloworld
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();
global $ADMIN;

// Our default values.
$showinsitenav = 1;

if ($hassiteconfig) {
    $ADMIN->add('localplugins', new admin_category('local_helloworld_settings', new lang_string('pluginname', 'local_helloworld')));
    $settingspage = new admin_settingpage('managelocalhelloworld', new lang_string('manage', 'local_helloworld'));

    if ($ADMIN->fulltree) {
        $settingspage->add(new admin_setting_configcheckbox(
            'local_helloworld/showinnavigation',
            get_string('showinnavigation', 'local_helloworld'),
            get_string('showinnavigation_detail', 'local_helloworld'),
            $showinsitenav));
    }

    $ADMIN->add('localplugins', $settingspage);
}