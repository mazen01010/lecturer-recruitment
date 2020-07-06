<?php
require(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');
require_login();
include('../tables/tabletest.php');

global $DB, $PAGE, $OUTPUT, $CFG , $USER;

$PAGE->set_context(context_system::instance());
$PAGE->set_url('/local/lecrec/pages/testpage.php');
$PAGE->set_title('Lecturer Recruitment');

$context = context_system::instance();
$user = $USER->id;

$PAGE->set_heading("Testpage");

echo $OUTPUT->header();

getTestTable();

echo $OUTPUT->footer();