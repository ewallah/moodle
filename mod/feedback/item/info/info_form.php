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

require_once($CFG->dirroot.'/mod/feedback/item/feedback_item_form_class.php');

class feedback_info_form extends feedback_item_form {
    protected $type = "info";

    /** @var object Form element. */
    protected $infotype;

    public function definition() {

        $item = $this->_customdata['item'];
        $common = $this->_customdata['common'];
        $positionlist = $this->_customdata['positionlist'];
        $position = $this->_customdata['position'];
        $presentationoptions = $this->_customdata['presentationoptions'];

        $mform =& $this->_form;

        $mform->addElement('header', 'general', get_string($this->type, 'feedback'));
        $mform->addElement('hidden', 'required', 0);
        $mform->setType('required', PARAM_INT);

        $mform->addElement('text',
                            'name',
                            get_string('item_name', 'feedback'),
                            ['size' => FEEDBACK_ITEM_NAME_TEXTBOX_SIZE, 'maxlength' => 1333]);
        $mform->addElement('text',
                            'label',
                            get_string('item_label', 'feedback'),
                            array('size'=>FEEDBACK_ITEM_LABEL_TEXTBOX_SIZE, 'maxlength'=>255));

        $this->infotype = &$mform->addElement('select',
                                              'presentation',
                                              get_string('infotype', 'feedback'),
                                              $presentationoptions);

        parent::definition();
        $this->set_data($item);

    }
}

