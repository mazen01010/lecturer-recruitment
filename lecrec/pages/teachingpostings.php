<?php
require(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');
include('../tables/tableteachingpostings.php');

$PAGE->set_context(context_system::instance());
$PAGE->set_url('/local/lecrec/pages/teachingpostings.php');
$PAGE->set_title('Lecturer Recruitment');

$context = context_system::instance();
$user = $USER->id;

if(has_capability('local/lecrec:manager', $context)){}

if(isguestuser()){

}