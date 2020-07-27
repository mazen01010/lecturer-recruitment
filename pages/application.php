<?php

require(dirname(__FILE__, 4) . '/config.php');
require_once("$CFG->libdir/formslib.php");
global $PAGE, $DB;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = filter_input_array(INPUT_POST);
} else {
    $input = filter_input_array(INPUT_GET);
};

$name = $input['ID'];
$rowID = $input['rowID'];
if(!isset($_SESSION['$rowID'] )){
    $_SESSION['$rowID'] = $rowID;
}

$PAGE->set_context(context_system::instance());
$PAGE->set_url('/local/lecrec/pages/teachingpostings.php');
$PAGE->set_title('Lecturer Recruitment');
echo $OUTPUT->header();
echo $OUTPUT->heading('Bewerberformular für ' . $name . '');
$PAGE->requires->jquery();
$context = context_system::instance();

echo '</br></br>';
if (has_capability('local/lecrec:manager', $context)) {
}

if (isguestuser()) {
}

//TODO: Form Validation
/*echo ' <header>
            <h1>Bewerberformular für ' . $name . '</h1>
            <!--<h2>Mathematische Grundlagen 1</h2>-->
        </header>
        <form id="form1" name="form1" method="POST" action="../assets/PHPFunctions/add_new_application.php">
<div class="form-group">
<label for="fname">Fname</label><input type="text" name="fname" id="fname" />
<br class="clear" />
<label for="lname">Lname</label><input type="text" name="lname" id="lname" />
<br class="clear" />
<label for="email">Email</label><input type="text" name="email" id="email" />
<br class="clear" />
<label for="title">Title</label><input type="text" name="title" id="title" />
<br class="clear" />
<label for="date_of_birth">Date Of Birth</label><input type="text" name="date_of_birth" id="date_of_birth" />
<br class="clear" />
<label for="place_of_birth">Place Of Birth</label><input type="text" name="place_of_birth" id="place_of_birth" />
<br class="clear" />
<label for="job">Job</label><input type="text" name="job" id="job" />
<br class="clear" />
<label for="private_add_str">Private Add Str</label><input type="text" name="private_add_str" id="private_add_str" />
<br class="clear" />
<label for="private_add_zip">Private Add Zip</label><input type="text" name="private_add_zip" id="private_add_zip" />
<br class="clear" />
<label for="private_add_city">Private Add City</label><input type="text" name="private_add_city" id="private_add_city" />
<br class="clear" />
<label for="private_tele">Private Tele</label><input type="text" name="private_tele" id="private_tele" />
<br class="clear" />
<label for="private_mobile">Private Mobile</label><input type="text" name="private_mobile" id="private_mobile" />
<br class="clear" />
<label for="private_email">Private Email</label><input type="text" name="private_email" id="private_email" />
<br class="clear" />
<label for="private_fax">Private Fax</label><input type="text" name="private_fax" id="private_fax" />
<br class="clear" />
<label for="company">Company</label><input type="text" name="company" id="company" />
<br class="clear" />
<label for="company_add_str">Company Add Str</label><input type="text" name="company_add_str" id="company_add_str" />
<br class="clear" />
<label for="company_add_zip">Company Add Zip</label><input type="text" name="company_add_zip" id="company_add_zip" />
<br class="clear" />
<label for="company_add_city">Company Add City</label><input type="text" name="company_add_city" id="company_add_city" />
<br class="clear" />
<label for="company_tele">Company Tele</label><input type="text" name="company_tele" id="company_tele" />
<br class="clear" />
<label for="company_fax">Company Fax</label><input type="text" name="company_fax" id="company_fax" />
<br class="clear" />
<label for="company_email">Company Email</label><input type="text" name="company_email" id="company_email" />
<br class="clear" />
<label for="education">Education</label><input type="text" name="education" id="education" />
<br class="clear" />
<label for="teaching_activities">Teaching Activities</label><input type="text" name="teaching_activities" id="teaching_activities" />
<br class="clear" />
<label for="job_activities">Job Activities</label><input type="text" name="job_activities" id="job_activities" />
<br class="clear" />
<label for="subject_of_interest">Subject Of Interest</label><input type="text" name="subject_of_interest" id="subject_of_interest" />
<br class="clear" />
<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Absenden</button>
<input type="hidden" id="lr_job_postings_id" value="' . $rowID . '" name="lr_job_postings_id">
</div>
</form>';
*/


class addlecturer extends moodleform
{

    //Add elements to form
    public function definition()
    {
        global $DB;

        $mform = $this->_form; // Don't forget the underscore!


        $mform->addElement('text', 'title', 'Title', 'size="50"');
        $mform->setType('title', PARAM_NOTAGS);
        $mform->addElement('text', 'lastname', 'Last Name', 'size="50"');
        $mform->setType('lastname', PARAM_NOTAGS);
        $mform->addElement('text', 'firstname', 'First Name', 'size="50"');
        $mform->setType('firstname', PARAM_NOTAGS);
        $mform->addElement('date_selector', 'dateofbirth', 'Date of Birth ');
        $mform->addElement('text', 'place_of_birth', 'Place of Birth ');
      //  $mform->addElement('advcheckbox', 'self_employed', 'Self Employed', 'Check if self employed', '', array(0, 1));
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

        $mform->addElement('text', 'private_phonenumber', 'Private Phone Number', 'size="50"');
        $mform->addRule('private_phonenumber', null, 'numeric', null, 'client');
        $mform->setType('private_phonenumber', PARAM_NOTAGS);
        $mform->addElement('text', 'private_cellphone_number', 'Cellphone Number', 'size="50"');
        $mform->addRule('private_cellphone_number', null, 'numeric', null, 'client');
        $mform->setType('private_cellphone_number', PARAM_NOTAGS);

        $mform->addElement('text', 'private_fax', 'Private Fax', 'size="50"');
        $mform->setType('private_fax', PARAM_NOTAGS);

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

        $mform->addElement('text', 'job', 'Job', 'size="50"');
        $mform->setType('job', PARAM_NOTAGS);

        $mform->addElement('text', 'business_phonenumber', 'Work Phone Number', 'size="50"');
        $mform->addRule('business_phonenumber', null, 'numeric', null, 'client');
        $mform->setType('business_phonenumber', PARAM_NOTAGS);
        $mform->addElement('text', 'company', 'Company Name', 'size="50"');
        $mform->setType('company', PARAM_NOTAGS);
        $mform->addElement('text', 'business_mail', 'Work Email', 'size="50"');
        $mform->addElement('text', 'company_fax', 'Company Fax', 'size="50"');
        $mform->setType('company_fax', PARAM_NOTAGS);
        $mform->addRule('business_mail', null, 'email', null, 'client');
        $mform->addElement('textarea', 'previous_teaching_activities', 'Previous Teaching Activities', 'size="50"');
        $mform->setType('previous_teaching_activities', PARAM_NOTAGS);
        $mform->addElement('textarea', 'professional_activities', 'Professional Activities', 'size="50"');
        $mform->setType('professional_activities', PARAM_NOTAGS);
        $mform->addElement('textarea', 'education', 'Educational Interest', 'size="50"');
        $mform->setType('education', PARAM_NOTAGS);
        $mform->addElement('text', 'subject_area', 'Subject Area', 'size="50"');
        $mform->setType('subject_area', PARAM_NOTAGS);
        /*
                $mform->setType('directorid', PARAM_NOTAGS);
                $mform->addElement('select', 'module', 'Module', $modules, array('onchange' => 'javascript:loadSubjects();'))->setValue(;
                $mform->addElement('select', 'subject', 'Subject',); // Add elements to your form
                $mform->setType('subject', PARAM_NOTAGS);                   //Set type of element


                $mform->addElement('select',);
                $mform->addElement('date_selector', 'startdate', 'Start Date');
                $mform->addElement('date_selector', 'enddate', 'End Date');


                $mform->addElement('text', 'contactperson', 'Contact Person', 'size="50"');
                $mform->setType('contactperson', PARAM_NOTAGS);

                $mform->addElement('text', 'emailcontactperson', 'E-Mail Contact Person', 'size="50"');
                $mform->setType('emailcontactperson', PARAM_NOTAGS);*/
        unset($_SESSION['data']);
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
}

if ($mform->is_submitted()) {
    $input = (array)$mform->get_data();
    $rowID = $_SESSION['$rowID'];
    unset($_SESSION['$rowID']);
    $input['dateofbirth'] = date('Y-m-d', $input['dateofbirth']);
    $id = $DB->insert_record("lr_application", array(
        'lr_job_postings_id' => $rowID,
        'fname' => $input['firstname'], 'lname' => $input['lastname'],
        'title' => $input['title'],
        'date_of_birth' => $input['dateofbirth'], 'place_of_birth' => $input['place_of_birth'],
        'job' => $input['job'], 'private_add_str' => $input['private_street'],
        'private_add_zip' => $input['private_postalcode'], 'private_add_city' => $input['private_city'],
        'private_tele' => $input['private_phonenumber'],
        'private_email' => $input['private_mail'],
        'private_mobile' => $input['private_cellphone_number'],
        'private_fax' => $input['private_fax'], 'company' => $input['company'],
        'company_add_str' => $input['business_street'], 'company_add_zip' => $input['business_postalcode'],
        'company_add_city' => $input['business_city'], 'company_tele' => $input['business_phonenumber'],
        'education' => $input['education'], 'company_fax' => $input['company_fax'],
        'company_email' => $input['business_mail'], 'teaching_activities' => $input['previous_teaching_activities'],
        'job_activities' => $input['professional_activities'], 'subject_of_interest' => $input['subject_area'],
        'timecreated' => time(),
        'timemodified' => time(),
        'status_of_application' => 'Applied'

    ));

    redirect(new moodle_url('/local/lecrec/pages/teachingpostings.php'));

}
$companies = $DB->get_records('dg_company');
echo '
<datalist id="id_companies">';
foreach ($companies as $company) {

    echo '<option value="' . $company->company_name . '">';
}
echo '</datalist>';

?>
    <script>
        $('#id_company').attr('list', 'id_company');
    </script>
<?php
echo $OUTPUT->footer();