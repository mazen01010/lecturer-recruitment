<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = filter_input_array(INPUT_POST);
} else {
    $input = filter_input_array(INPUT_GET);
};

require_once(dirname(__DIR__, 4) . '/config.php');
global $DB, $USER;
require_login();

if ($input['qualify']) {
  //  $DB->update_record('lr_application', array('id' => $input['app_id']));
    $_SESSION['InterviewDetails_app_id'] = $input['app_id'];
    redirect('../../pages/interview.php');
    //TODO send email
} elseif ($input['approve']) {
    $DB->update_record('lr_application', array('id' => $input['app_id'], 'status_of_application' => 'Accepted' , 'closed' => 0));
    //TODO Add lecturer to pool
    $record = $DB->get_record_select('lr_application' , 'id = ?' , array($input['app_id']));
    $status = (object)$DB->get_record_select('lr_lecturer' , 'lastname = ? AND firstname = ? AND dateofbirth = ?' , array(
        $record->lname ,$record->fname,$record->date_of_birth
    ));
    if(empty($status)){

    $DB->insert_record('lr_lecturer' , array(
        'mdl_user_id' => 0,
    'self_employed' => 0,
    'lastname' => $record->lname ,
    'firstname'=>  $record->fname,
    'title'=>  $record->title,
    'dateofbirth'=>  $record->date_of_birth,
    'private_street'=> $record->private_add_str ,
    'private_postalcode'=> $record->private_add_zip ,
    'private_city'=>  $record->private_add_city,
    'private_phonenumber'=>  $record->private_tele,
    'private_cellphone_number'=>  $record->private_mobile,
    'private_mail'=>  $record->private_email,
    'company'=>  $record->company,
    'business_phonenumber'=>  $record->company_tele,
    'business_mail'=> $record->company_email ,
    'previous_teaching_activities'=> $record->teaching_activities ,
    'professional_activities'=>  $record->job_activities,
    'educational_interest'=> $record->subject_of_interest,
    'subject_area'=>  $record->education
    ));
    }

    $DB->update_record('lr_job_postings', array('id' => $record->lr_job_postings_id, 'closed' => 1));
    //TODO close posting
    //TODO notify applicant
    redirect('../../index.php');
} else {

    $DB->update_record('lr_application', array('id' => $input['app_id'], 'status_of_application' => 'Rejected'));
    //TODO send email
    redirect('../../index.php');
}
