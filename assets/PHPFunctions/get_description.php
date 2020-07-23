<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = filter_input_array(INPUT_POST);
} else {
    $input = filter_input_array(INPUT_GET);
};

require_once(dirname(dirname(dirname(dirname(__DIR__)))) . '/config.php');
global $DB, $USER;

$subject = $DB->get_record_select('lr_subjects', 'lr_module_id = ? AND lr_subject_name = ?', array($input['module_id'], $input['subject_id']));
$subject_array = [];
foreach ($subject as $item) {
    array_push($subject_array, $item);
}
unset($subject_array[0]);
unset($subject_array[1]);
unset($subject_array[4]);

echo json_encode($subject_array);
