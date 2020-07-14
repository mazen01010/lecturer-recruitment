<?php
global $PAGE;
require(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');
require_once("$CFG->libdir/formslib.php");
$PAGE->set_context(context_system::instance());
$PAGE->set_url('/local/lecrec/pages/testpage.php');
$PAGE->set_title('Lecturer Recruitment');

$context = context_system::instance();
$user = $USER->id;

$PAGE->set_heading("Testpage");


class createposting extends moodleform {
    //Add elements to form
    public function definition() {
        global $CFG;

        $mform = $this->_form; // Don't forget the underscore!

        $mform->addElement('text', 'subject', 'Subject', 'size="50"'); // Add elements to your form
        $mform->setType('subject', PARAM_NOTAGS);                   //Set type of element

        $mform->addElement('advcheckbox', 'external', 'External', 'Check if posting is open for external applications', '', array(0, 1));

        $mform->addElement('date_selector', 'startdate', 'Start Date');
        $mform->addElement('date_selector', 'enddate', 'End Date');

        $mform->addElement('text', 'directorid', 'Director ID', 'size="50"');
        $mform->setType('subject', PARAM_NOTAGS);

        $mform->addElement('text', 'subject', 'Subject', 'size="50"');
        $mform->setType('subject', PARAM_NOTAGS);

        $mform->addElement('text', 'subject', 'Subject', 'size="50"');
        $mform->setType('subject', PARAM_NOTAGS);
    }
    //Custom validation should be added here
    function validation($data, $files) {
        return array();
    }
}
echo $OUTPUT->header();

$form = new createposting();
$form->display();

echo $OUTPUT->footer();