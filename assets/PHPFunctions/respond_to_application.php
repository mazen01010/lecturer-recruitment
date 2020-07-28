<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = filter_input_array(INPUT_POST);
} else {
    $input = filter_input_array(INPUT_GET);
};

require_once(dirname(dirname(dirname(dirname(__DIR__)))) . '/config.php');
global $DB, $USER;
require_login();

if ($input['qualify']) {
    $DB->update_record('lr_application', array('id' => $input['app_id'], 'status_of_application' => 'Waiting'));
    $_SESSION['InterviewDetails_app_id'] = $input['app_id'];
    redirect('../../pages/interview.php');
    //TODO send email
} elseif ($input['approve']) {
    $DB->update_record('lr_application', array('id' => $input['app_id'], 'status_of_application' => 'Approved'));
    //TODO Add lecturer to pool
    //TODO close posting
    //TODO notify applicant
    redirect('../../index.php');
} else {
    $DB->update_record('lr_application', array('id' => $input['app_id'], 'status_of_application' => 'Rejected'));
    //TODO send email
    redirect('../../index.php');
}
