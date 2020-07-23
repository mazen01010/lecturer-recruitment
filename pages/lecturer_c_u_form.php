<?php
require(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');
require_once("$CFG->libdir/formslib.php");
global $PAGE, $USER;
$PAGE->set_context(context_system::instance());
$PAGE->set_url('/local/lecrec/pages/lecturer_c_u_form.php');
$PAGE->set_title('Lecturer Recruitment');
$PAGE->requires->jquery();
$context = context_system::instance();


$PAGE->set_heading("Add new lecturer");
echo $OUTPUT->header();

//TODO: add applicant to lecturer pool

class addlecturer extends moodleform
{


    //Add elements to form
    public function definition()
    {
        global $DB;

        $mform = $this->_form; // Don't forget the underscore!


        $records = $DB->get_records('lr_module');
        $modules[] = null;
        foreach ($records as $item) {
            $modules[$item->id] = $item->module_name;
        }
        $mform->addElement('text', 'title', 'Title', 'size="50"');
        $mform->setType('title', PARAM_NOTAGS);
        $mform->addElement('text', 'lastname', 'Last Name', 'size="50"');
        $mform->setType('lastname', PARAM_NOTAGS);
        $mform->addElement('text', 'firstname', 'First Name', 'size="50"');
        $mform->setType('firstname', PARAM_NOTAGS);
        $mform->addElement('date_selector', 'dateofbirth', 'Date of Birth ');
        $mform->addElement('advcheckbox', 'self_employed', 'Self Employed', 'Check if self employed', '', array(0, 1));
        $private_address = array();
        $mform->addGroup($private_address, null, 'Private Data', null, false);
        $mform->addElement('text', 'private_street', 'Street and Nr.', 'size="50"');
        $mform->setType('private_street', PARAM_NOTAGS);
        $mform->addElement('text', 'private_postalcode', 'Postal Code', 'size="50"');
        $mform->addRule('private_postalcode', null, 'numeric', null, 'client');
        $mform->addRule('private_postalcode', 'Only numbers are allowed', 'required', null, 'client');
        $mform->addRule('private_postalcode', null, 'minlength', 5, 'client');
        $mform->addRule('private_postalcode', null, 'maxlength', 5, 'client');
        $mform->addElement('text', 'private_city', 'City', 'size="50"');
        $mform->setType('private_city', PARAM_NOTAGS);
        $mform->addElement('text', 'private_state', 'State', 'size="50"');
        $mform->setType('private_state', PARAM_NOTAGS);
        $mform->addElement('text', 'private_phonenumber', 'Private Phone Number', 'size="50"');
        $mform->addRule('private_phonenumber', null, 'numeric', null, 'client');
        $mform->setType('private_phonenumber', PARAM_NOTAGS);
        $mform->addElement('text', 'private_cellphone_number', 'Cellphone Number', 'size="50"');
        $mform->addRule('private_cellphone_number', null, 'numeric', null, 'client');
        $mform->setType('private_cellphone_number', PARAM_NOTAGS);
        $mform->addElement('text', 'private_mail', 'Private Email', 'size="50"');
        $mform->addRule('private_mail', null, 'email', null, 'client');
        $business_address = array();
        $mform->addGroup($business_address, null, 'Work Data', null, false);
        $mform->addElement('text', 'business_street', 'Street and Nr.', 'size="50"');
        $mform->setType('business_street', PARAM_NOTAGS);
        $mform->addElement('text', 'business_postalcode', 'Postal Code', 'size="50"');
        $mform->addRule('business_postalcode', null, 'numeric', null, 'client');
        $mform->addRule('business_postalcode', 'Only numbers are allowed', 'required', null, 'client');
        $mform->addRule('business_postalcode', null, 'minlength', 5, 'client');
        $mform->addRule('business_postalcode', null, 'maxlength', 5, 'client');
        $mform->addElement('text', 'business_city', 'City', 'size="50"');
        $mform->setType('business_city', PARAM_NOTAGS);
        $mform->addElement('text', 'business_state', 'State', 'size="50"');
        $mform->setType('business_state', PARAM_NOTAGS);
        $mform->addElement('text', 'business_phonenumber', 'Work Phone Number', 'size="50"');
        $mform->addRule('business_phonenumber', null, 'numeric', null, 'client');
        $mform->setType('business_phonenumber', PARAM_NOTAGS);
        $mform->addElement('text', 'company', 'Company Name', 'size="50"');
        $mform->setType('company', PARAM_NOTAGS);
        $mform->addElement('text', 'business_mail', 'Work Email', 'size="50"');
        $mform->addRule('business_mail', null, 'email', null, 'client');
        $mform->addElement('textarea', 'previous_teaching_activities', 'Previous Teaching Activities', 'size="50"');
        $mform->setType('previous_teaching_activities', PARAM_NOTAGS);
        $mform->addElement('textarea', 'professional_activities', 'Professional Activities', 'size="50"');
        $mform->setType('professional_activities', PARAM_NOTAGS);
        $mform->addElement('textarea', 'educational_interest', 'Educational Interest', 'size="50"');
        $mform->setType('educational_interest', PARAM_NOTAGS);
        $mform->addElement('text', 'subject_area', 'Subject Area', 'size="50"');
        $mform->setType('subject_area', PARAM_NOTAGS);
        /*
                $mform->setType('directorid', PARAM_NOTAGS);
                $mform->addElement('select', 'module', 'Module', $modules, array('onchange' => 'javascript:loadSubjects();'));
                $mform->addElement('select', 'subject', 'Subject',); // Add elements to your form
                $mform->setType('subject', PARAM_NOTAGS);                   //Set type of element


                $mform->addElement('select',);
                $mform->addElement('date_selector', 'startdate', 'Start Date');
                $mform->addElement('date_selector', 'enddate', 'End Date');


                $mform->addElement('text', 'contactperson', 'Contact Person', 'size="50"');
                $mform->setType('contactperson', PARAM_NOTAGS);

                $mform->addElement('text', 'emailcontactperson', 'E-Mail Contact Person', 'size="50"');
                $mform->setType('emailcontactperson', PARAM_NOTAGS);*/

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


$mform = new addlecturer();
$mform->display();


if ($mform->is_cancelled()) {
    //Handle form cancel operation, if cancel button is present on form
    $url = new moodle_url($CFG->wwwroot . '/local/lecrec/index.php');
    redirect($url);

} else if ($fromform = $mform->get_data()) {
    //In this case you process validated data. $mform->get_data() returns data posted in form.
    print_r($fromform);
}
if ($mform->is_submitted()) {
    //  $DB->insert_record('lr_job_postings',)
}
echo $OUTPUT->footer();