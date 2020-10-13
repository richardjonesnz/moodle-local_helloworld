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
 * Form for message input.
 *
 * @package local_helloworld
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace local_helloworld\utility;
use moodleform;

class messageform extends moodleform {

    public function definition() {

            $mform = $this->_form;

            // message
            $mform->addElement('textarea', 'message', get_string('prompt', 'local_helloworld'),
                    'wrap="virtual" rows="5" "cols="50"');
            $mform->setType('message', PARAM_TEXT);
            $mform->addRule('message', null, 'required', null, 'client');

            // Add the submit button.
            $this->add_action_buttons();
    }
}