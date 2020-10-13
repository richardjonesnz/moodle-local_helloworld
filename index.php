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
 * Starting page for this plugin.
 *
 * @package local_helloworld
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
use \local_helloworld\utility\messageform;
require_once('../../config.php');

// Setup the page.
$context = context_system::instance();

$PAGE->set_context($context);
require_login();

$PAGE->set_pagelayout('standard');
$PAGE->set_title(get_string('pluginname', 'local_helloworld'));
$PAGE->set_heading(get_string('hello', 'local_helloworld'));
$PAGE->set_url(new moodle_url('/local/helloworld/index.php'));

// Page header information (not the simple html heading).
echo $OUTPUT->header();

// Add a simple html form to be displayed.
$form = new messageform();
$form->display();

if ($data = $form->get_data()) {
    echo format_text($data->message);
}

// Add some links.
$url = new moodle_url('http://192.168.1.100/moodle391');
echo html_writer::link($url, get_string('frontpage', 'local_helloworld'));
echo html_writer::tag('br', null);
$url = new moodle_url('index.php');
echo html_writer::link($url, get_string('main', 'local_helloworld'));

// Output the moodle footer (not a simple html footer).
echo $OUTPUT->footer();