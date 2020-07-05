<?php

global $DB, $OUTPUT, $PAGE;
require(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');
require_login();

$PAGE->set_context(context_system::instance());
$PAGE->set_url('/local/lecrec/pages/lecturerpool.php');
$PAGE->set_title('Lecturer Recruitment');

$table = new html_table();
$table->id= 'my-table';

$sql = "SELECT COUNT(*)
        FROM INFORMATION_SCHEMA.columns
        WHERE TABLE_NAME = N'mdl_lr_student'; 
        ";
$nr = array_values($DB->get_records_sql($sql,$params=null, $strictness=IGNORE_MISSING));
$table->attributes = $nr;


function getTableLecturerPool()
{
    global $DB;
    $table = new html_table();
    $table->id= 'my-table';
    $table->attributes['class'] = 'generaltable mod_index';
    $count = $DB->count_records_select("lr_lecturer",'id',array('closed=0'));
    $records = $DB->get_records_select("lr_lecturer",'id' ,array('*') );

    $table->head = array('Lastname', 'Firstname', 'Educational Interest', 'Professional Activities');
    $table->align = array('center', 'center', 'center', 'center');

    for ($i = 0; $i < $count; $i++) {

        $row = new html_table_row();
        $row->attributes['data-href'] = 'tablelecturerpool.php?#RecordID=' . $records[$i + 1]->id . '';

        $cell1 = new html_table_cell();
        $cell1->text = $records[$i + 1]->lastname;

        $cell2 = new html_table_cell();
        $cell2->text = $records[$i + 1]->firstname;

        $cell3 = new html_table_cell();
        $cell3->text = $records[$i + 1]->educational_interest;

        $cell4 = new html_table_cell();
        $cell4->text = $records[$i + 1]->professional_activities;

        $row->cells = array($cell1, $cell2, $cell3, $cell4);

        $table->rowclasses[$i] = '';
        $table->data[] = $row;
        echo html_writer::table($table);
    }
}
echo $OUTPUT->header();
print_r($nr);
echo $OUTPUT->footer();
?>




