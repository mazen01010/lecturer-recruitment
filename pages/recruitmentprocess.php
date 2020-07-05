<?php
require(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');
require_login();
include('../tables/tablerecruitmentprocess.php');
include_once('../table.php');
global $DB, $PAGE, $OUTPUT, $CFG, $USER;

$PAGE->set_context(context_system::instance());
$PAGE->set_url('/local/lecrec/pages/recruitmentprocess.php');
$PAGE->set_title('Lecturer Recruitment');

$context = context_system::instance();
$user = $USER->id;

if (has_capability('local/lecrec:manager', $context)) {

    $PAGE->set_heading('Lecturer Recruitment');
    $PAGE->navbar->add('Lecturer Recruitment', new moodle_url('/local/lecrec/index.php', array('id' => $user)));
    $PAGE->navbar->add('Recruitment Processes', new moodle_url('/local/lecrec/recruitmentprocess.php', array('id' => $user)));

    echo $OUTPUT->header();
    echo $OUTPUT->heading('Recruitment Processes');

    $attributes = array("lastname", "firstname");
    $head = array("Lastname", "Firstname");
    $align = array("center", "center");
    $equals = array("");


    getTable("lr_lecturer", $attributes, $head, $align, "", $equals);


    //    echo $OUTPUT->single_button(new moodle_url('/local/student_registration/views/ST_process/ST_process_creation.php', array('id' => $user)),
    //        'Add new Process', $attributes = null);

    echo $OUTPUT->footer();
} else {
    redirect($CFG->wwwroot);
}
