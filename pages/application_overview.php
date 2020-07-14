<?php


require(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');
require_login();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = filter_input_array(INPUT_POST);
} else {
    $input = filter_input_array(INPUT_GET);
};

$RecordID = $input['RecordID'];

global $DB, $PAGE, $OUTPUT, $CFG, $USER;

$PAGE->set_context(context_system::instance());
$PAGE->set_url('/local/lecrec/pages/recruitmentprocess.php');
$PAGE->set_title('Lecturer Applications');
$PAGE->requires->jquery();
$context = context_system::instance();
$user = $USER->id;

if (has_capability('local/lecrec:manager', $context)) {

    $PAGE->set_heading('Lecturer Recruitment');
    $PAGE->navbar->add('Lecturer Recruitment', new moodle_url('/local/lecrec/index.php'));
    $PAGE->navbar->add('Recruitment Processes', new moodle_url('/local/lecrec/pages/recruitmentprocess.php'));

    echo $OUTPUT->header();
    echo $OUTPUT->heading('Lecturer Applications');



    $table = new html_table();
    $table->id = 'my_table';
    $table->attributes['class'] = 'table table-sm ';

    $records = $DB->get_records_select("lr_application", 'lr_job_postings_id = ? AND closed = 0', array($RecordID));
    $table->head = array('Name', 'company', 'Education');
    $table->align = array('left', 'left', 'left');




    foreach ($records as $record) {

        // $table->data[] = array($record->id, $record->first_name, $record->last_name, $record->date_of_birth, $record->private_email, $record->timecreated, $record->contract_status);
        $row = new html_table_row();

        $row->attributes['RecordID'] = $record->id;
        $cell0 = new html_table_cell();
        $cell0->text = $record->fname . ' ' . $record->lname;

        $cell1 = new html_table_cell();
        $cell1->text = $record->company;

        $cell2 = new html_table_cell();
        $cell2->text = $record->education;


        $row->cells  = array($cell0, $cell1, $cell2);

        $table->data[]  = $row;
    };


    echo html_writer::table($table);






    echo $OUTPUT->footer();
} else {
    redirect($CFG->wwwroot);
}



?>
<script>
    $(document).ready(function() {
        $('#my_table tr[RecordID]').each(function() {
            $(this).css('cursor', 'pointer').hover(
                function() {
                    $(this).addClass('active');

                },
                function() {


                    $(this).removeClass('active');
                }).click(function() {
                var RecordID = $(this).attr('RecordID');
                redirectUrl = 'application_view.php';
                var form = $('<form action="' + redirectUrl + '" method="post">' +
                    '<input type="hidden" name="RecordID" value="' + RecordID + '"></input>' + '</form>');
                $('body').append(form);
                $(form).submit();

            });
        });
    });
</script>