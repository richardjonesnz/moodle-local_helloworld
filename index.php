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
 * @copyright moodle hq
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../../config.php');

$name = optional_param('name', 'World!', PARAM_ALPHA);

echo html_writer::tag('h2', get_string('hello', 'local_helloworld', $name));
echo html_writer::tag('p', get_string('getname', 'local_helloworld'));

$form = '<form action="index.php">
  <label for="name">Name: </label>
  <input type="text" id="name" name="name" value="User">
  <input type="submit" value="Submit">
</form>';

echo $form;

$url = new moodle_url('http://192.168.1.100/moodle391');
echo html_writer::link($url, get_string('frontpage', 'local_helloworld'));
echo html_writer::tag('br', null);
$url = new moodle_url('index.php', ['name' => $_GET['name']]);
echo html_writer::link($url, get_string('main', 'local_helloworld'));