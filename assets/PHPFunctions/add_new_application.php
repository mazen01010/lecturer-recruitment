<?php

// Basic example of PHP script to handle with jQuery-Tabledit plug-in.
// Note that is just an example. Should take precautions such as filtering the input data.

//if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) die("Nothing to see here");

// Get value from ajax
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = filter_input_array(INPUT_POST);
} else {
    $input = filter_input_array(INPUT_GET);
};

require_once(dirname(dirname(dirname(dirname(__DIR__)))) . '/config.php');
global $DB, $USER;

$user =  $USER->id;

function  notify_cr(string $cr)
{
    try {
        $data = array(
            'variables' =>
            array(
                'firstname' =>
                array(
                    'value' => $cr,
                    'type' => 'String',
                ),
            ),
            'businessKey' => 'myBusinessKey',
        );
        $data_string = json_encode($data);
        $ch = curl_init('https://camunda.lecturer-recruitment.swimdhbw.de/engine-rest/process-definition/key/application-processing/start');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string)
        ));

        $result = curl_exec($ch);
        var_dump($result);
    } catch (\Exception $e) {
        echo $e;
    }
}
notify_cr($input['fname']);
$id = $DB->insert_record("lr_application", array(
    'lr_job_postings_id' => $input['lr_job_postings_id'],
    'fname' => $input['fname'], 'lname' => $input['lname'], 'email' =>
    $input['email'], 'title' =>
    $input['title'], 'date_of_birth' =>
    $input['date_of_birth'], 'place_of_birth' =>
    $input['place_of_birth'], 'job' =>
    $input['job'], 'private_add_str' =>
    $input['private_add_str'], 'private_add_city' =>
    $input['private_add_city'], 'private_tele' =>
    $input['private_tele'], 'private_mobile' =>
    $input['private_mobile'], 'private_fax' =>
    $input['private_fax'], 'company' =>
    $input['company'], 'company_add_str' =>
    $input['company_add_str'], 'company_add_zip' =>
    $input['company_add_zip'], 'company_add_city' =>
    $input['company_add_city'], 'company_tele' =>
    $input['company_tele'], 'company_fax' =>
    $input['company_fax'], 'company_email'
    =>    $input['company_email'], 'teaching_activities'
    =>    $input['teaching_activities'], 'job_activities'
    =>    $input['job_activities'], 'subject_of_interest' =>
    $input['subject_of_interest']
));
