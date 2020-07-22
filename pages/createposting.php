<?php
global $PAGE;
require(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');
require_once("$CFG->libdir/formslib.php");
$PAGE->set_context(context_system::instance());
$PAGE->set_url('/local/lecrec/pages/createposting.php');
$PAGE->set_title('Lecturer Recruitment');

$context = context_system::instance();
$user = $USER->id;

$PAGE->set_heading("Create a job posting");


class createposting extends moodleform {


    //Add elements to form
    public function definition() {
        global $DB;

        $mform = $this->_form; // Don't forget the underscore!

        $sql = "SELECT `name` FROM `mdl_lr_module`";
        $records = $DB->get_records_sql($sql);
        $arr = json_decode(json_encode($records), TRUE);
        $testarray= [];
        foreach ($arr as $item){
            foreach ($item as $i){
                array_push($testarray,$i);
            }
        }

        $mform->addElement('select','module', 'Module', $testarray);

        $mform->addElement('text', 'lecture', 'Lecture', 'size="50"'); // Add elements to your form
        $mform->setType('lecture', PARAM_NOTAGS);                   //Set type of element

        $mform->addElement('advcheckbox', 'external', 'External', 'Check if posting is open for external applications', '', array(0, 1));

        $mform->addElement('date_selector', 'startdate', 'Start Date');
        $mform->addElement('date_selector', 'enddate', 'End Date');

        $mform->addElement('text', 'directorid', 'Director ID', 'size="50"');
        $mform->setType('directorid', PARAM_NOTAGS);

        $mform->addElement('text', 'contactperson', 'Contact Person', 'size="50"');
        $mform->setType('contactperson', PARAM_NOTAGS);

        $mform->addElement('text', 'emailcontactperson', 'E-Mail Contact Person', 'size="50"');
        $mform->setType('emailcontactperson', PARAM_NOTAGS);

        $buttonarray=array();
        $buttonarray[] = $mform->createElement('submit', 'submitbutton','Save');
        $buttonarray[] = $mform->createElement('reset', 'resetbutton','Revert');
        $buttonarray[] = $mform->createElement('cancel');
        $mform->addGroup($buttonarray, 'buttonar', '', ' ', false);
    }
    //Custom validation should be added here
    function validation($data, $files) {
        return array();
    }
}

echo $OUTPUT->header();


$mform = new createposting();
$mform->display();


if ($mform->is_cancelled()) {
    //Handle form cancel operation, if cancel button is present on form
    $url = new moodle_url($CFG->wwwroot.'/local/lecrec/index.php');
    redirect($url);

}
else if ($fromform = $mform->get_data()) {
    //In this case you process validated data. $mform->get_data() returns data posted in form.
    print_r($fromform);
}
/*else {
    // this branch is executed if the form is submitted but the data doesn't validate and the form should be redisplayed
    // or on the first display of the form.

    //Set default data (if any)
    $mform->set_data($toform);
    //displays the form
    $mform->display();
}
*/
echo $OUTPUT->footer();

?>
