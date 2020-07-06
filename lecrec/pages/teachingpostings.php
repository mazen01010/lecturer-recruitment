<?php
require(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');
include('../table.php');

$PAGE->set_context(context_system::instance());
$PAGE->set_url('/local/lecrec/pages/teachingpostings.php');
$PAGE->set_title('Lecturer Recruitment');

$context = context_system::instance();
$user = $USER->id;


if(has_capability('local/lecrec:manager', $context)){}

    $PAGE->set_heading('Teaching Postings');
    $PAGE->navbar->add('Lecturer Recruitment',new moodle_url('/local/lecrec/index.php', array('id' => $user)));
    $PAGE->navbar->add('Teaching Postings',new moodle_url('/local/lecrec/pages/teachingpostings.php', array('id' => $user)));

    echo $OUTPUT->header();
    echo $OUTPUT->heading('Teaching Postings');

    $attributes = array("id", "external", "description", "expected_hours", "start_date", "end_date", "contact_person");
    $head = array("ID", "External", "Description", "Expected Hours", "Start Date", "End Date", "Contact Person");
    $align = array("center", "center", "center", "center", "center", "center", "center");
    $equals = array("");

    getTable("lr_job_postings", $attributes, $head, $align,"", $equals);

    echo $OUTPUT->footer();
if(isguestuser()){

    $PAGE->set_heading('Teaching Postings');
    $PAGE->navbar->add('Lecturer Recruitment',new moodle_url('/local/lecrec/index.php', array('id' => $user)));
    $PAGE->navbar->add('Teaching Postings',new moodle_url('/local/lecrec/pages/teachingpostings.php', array('id' => $user)));

    echo $OUTPUT->header();
    echo $OUTPUT->heading('Teaching Postings');

    $attributes = array("id", "external", "description", "expected_hours", "start_date", "end_date", "contact_person");
    $head = array("ID", "External", "Description", "Expected Hours", "Start Date", "End Date", "Contact Person");
    $align = array("center", "center", "center", "center", "center", "center", "center");
    $equals = array("1");

    getTable("lr_job_postings", $attributes, $head, $align,"external", $equals);

    echo $OUTPUT->footer();
}
?>
<script>
    $(function(){
        $('#my-table tr[record_id] td').each(function(){
            $(this).css('cursor','pointer').hover(
                function(){
                    $(this).addClass('active');
                },
                function(){


                    $(this).removeClass('active');
                }).click( function(){
                    var ID = $(this).attr('record_id');
                    redirectUrl = 'ST_process_update.php';
                    var form = $('<form action="' + redirectUrl + '" method="post">' +
                        '<input type="hidden" name="ID" value="' + ID + '"></input>' + '</form>');
                    $('body').append(form);
                    $(form).submit();

                }
            );
        });
    });
    if ($_SERVER['REQUEST_METHOD']=='POST') {
        $input = filter_input_array(INPUT_POST);
    } else {
        $input = filter_input_array(INPUT_GET);
    };
</script>
