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
global $DB, $USER;

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
    // We have data let's save it in the database.
    $data->message = format_text($data->message);
    $data->timecreated = time();
    $data->userid = $USER->id;
    $DB->insert_record('local_helloworld_messages', $data);
}

// Display the records from the database.
$messages = $DB->get_records('local_helloworld_messages', null, null, '*');
$cardlist = new stdClass();
foreach ($messages as $m) {
    $data = array();
    $data['id'] = $m->id;
    $name = $DB->get_record('user', ['id' => $m->userid], 'firstname, lastname', MUST_EXIST);
    $data['name'] = $name->firstname . ' ' . $name->lastname;
    $data['message'] = $m->message;
    $data['timecreated'] = $m->timecreated;
    $cardlist->data[] = $data;
}

// Add some links.
$url = new moodle_url('http://192.168.1.100/moodle391');
$cardlist->url_front = $url->out(false);
$cardlist->link_front = get_string('frontpage', 'local_helloworld');
$url = new moodle_url('index.php');
$cardlist->url_here = $url->out(false);
$cardlist->link_here = get_string('main', 'local_helloworld');

echo $OUTPUT->render_from_template('local_helloworld/messages', $cardlist);



// Output the moodle footer (not a simple html footer).
echo $OUTPUT->footer();