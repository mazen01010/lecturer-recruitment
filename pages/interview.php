<?php
global $PAGE;
require(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');
require_once("$CFG->libdir/formslib.php");
$PAGE->set_context(context_system::instance());
$PAGE->set_url('/local/lecrec/pages/createposting.php');
$PAGE->set_title('Lecturer Recruitment');
$PAGE->requires->jquery();

$context = context_system::instance();
$user = $USER->id;

$PAGE->set_heading("Interview Details");


class setInterview extends moodleform
{


    //Add elements to form
    public function definition()
    {
        global $DB;

        $mform = $this->_form; // Don't forget the underscore!
        $app_id = $_SESSION['InterviewDetails_app_id'];

        $record = $DB->get_record('lr_application', array('id' => $app_id));

        $mform->addElement('date_time_selector', 'interviewDate', 'Interview Date');


        $mform->addElement('text', 'street', 'Street', 'size="50"');
        $mform->addElement('text', 'city', 'City', 'size="50"');
        $mform->addElement('text', 'zipcode', 'Zip Code', 'size="50"');


        $buttonarray = array();
        $buttonarray[] = $mform->createElement('submit', 'submitbutton', 'Save');
        $buttonarray[] = $mform->createElement('cancel');
        $mform->addGroup($buttonarray, 'buttonar', '', ' ', false);
    }
    //Custom validation should be added here
    function validation($data, $files)
    {
        return array();
    }
}

echo $OUTPUT->header();


$mform = new setInterview();
$mform->display();


if ($mform->is_cancelled()) {
    //Handle form cancel operation, if cancel button is present on form
    $url = new moodle_url($CFG->wwwroot . '/local/lecrec/index.php');
    redirect($url);
}
if ($mform->is_submitted()) {
    $data = $mform->get_data();
    $app_id = $_SESSION['InterviewDetails_app_id'];

    $DB->update_record('lr_application', (object)array(
        'id' => $app_id,
        'status_of_application' =>  'Interview sent',
        'interview_date' => $data->interviewDate,
        'interview_street' => $data->street,
        'interview_city' => $data->city,
        'interview_city_zip' => $data->zipcode
    ));
    unset($_SESSION['InterviewDetails_app_id']);
    redirect('../index.php');
};

?>
<script>

</script>

<?php
echo $OUTPUT->footer();
?>