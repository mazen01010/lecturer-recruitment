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
        global $DB;

        $mform = $this->_form; // Don't forget the underscore!

        $sql = "SELECT `name` FROM `mdl_lr_module`";
        $records = $DB->get_records_sql($sql);
        var_dump($records);
        $arr = json_decode(json_encode($records), TRUE);
        var_dump($arr);
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
    }
    //Custom validation should be added here
    function validation($data, $files) {
        return array();
    }
}
$sql = "SELECT * FROM `mdl_lr_module` WHERE 1";
$records = $DB->get_records_sql($sql);
$arr = json_decode(json_encode($records), TRUE);

echo $OUTPUT->header();

$form = new createposting();
$form->display();

echo $OUTPUT->footer();

?>
<script>
    $(document).ready(function () {
        $('#text_value')

    })
</script>
