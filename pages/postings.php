<?php

require(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');
//include('../tables/tableteachingpostings.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = filter_input_array(INPUT_POST);
} else {
    $input = filter_input_array(INPUT_GET);
};

$name = $input['ID'];
$rowID = $input['rowID'];

$PAGE->set_context(context_system::instance());
$PAGE->set_url('/local/lecrec/pages/teachingpostings.php');
//$PAGE->set_title('Lecturer Recruitment');
$PAGE->requires->css('/local/lecrec/assets/css/bewerber.css');
echo $OUTPUT->header();
//echo $OUTPUT->heading('Lecturer Recruitment');
$PAGE->requires->jquery();
$context = context_system::instance();
$user = $USER->id;
echo '</br>';
if (has_capability('local/lecrec:manager', $context)) {
}

if (isguestuser()) {
}

//TODO: Form Validation
echo ' <header>
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
