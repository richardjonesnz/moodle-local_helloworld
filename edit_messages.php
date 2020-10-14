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

require_once('../../config.php');
global $DB, $USER;

$action = optional_param('action', 'none', PARAM_ALPHA);
$itemid = optional_param('itemid', 0, PARAM_INT);
// Setup the page.
$context = context_system::instance();

$PAGE->set_context($context);
require_login();

if (isguestuser()) {
   print_error('noguest');
}

$baseurl = new moodle_url('/local/helloworld/edit_messages.php');

$PAGE->set_pagelayout('standard');
$PAGE->set_title(get_string('pluginname', 'local_helloworld'));
$PAGE->set_heading(get_string('manage_messages', 'local_helloworld'));
$PAGE->set_url($baseurl);

if ($action == 'delete') {
    if (has_capability('local/helloworld:deleteanymessage', $context)) {
        $status = $DB->delete_records('local_helloworld_messages', ['id' => $itemid]);
        redirect($baseurl, get_string('message_deleted', 'local_helloworld'), 2);
    }
}

// Display the records from the database.
$messages = $DB->get_records('local_helloworld_messages', null, null, '*');

if (count($messages) > 0) {

    $table = new stdClass();
        foreach ($messages as $m) {
            $data = array();
            $data['id'] = $m->id;
            $name = $DB->get_record('user', ['id' => $m->userid], 'firstname, lastname', MUST_EXIST);
            $data['name'] = $name->firstname . ' ' . $name->lastname;
            $data['message'] = format_text($m->message);
            $data['timecreated'] = $m->timecreated;
            $url = new moodle_url($PAGE->url, ['itemid' => $m->id, 'action' => 'delete']);
            $data['delete'] = $url->out(false);
            $table->tabledata[] = $data;
        }
        $table->tableheaders = [get_string('id', 'local_helloworld'),
                                get_string('name'),
                                get_string('message', 'local_helloworld'),
                                get_string('timecreated', 'local_helloworld'),
                                get_string('delete')];
} else {
    $table->notice = get_string('nodata', 'local_helloworld');
}
// Add some links.
$url = new moodle_url('http://192.168.1.100/moodle391');
$table->url_front = $url->out(false);
$table->link_front = get_string('frontpage', 'local_helloworld');
$url = new moodle_url('index.php');
$table->url_here = $url->out(false);
$table->link_here = get_string('main', 'local_helloworld');

echo $OUTPUT->header();
echo $OUTPUT->render_from_template('local_helloworld/message_list', $table);

// Output the moodle footer (not a simple html footer).
echo $OUTPUT->footer();