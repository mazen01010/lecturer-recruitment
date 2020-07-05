<?php

require(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');
require_login();

include('../table.php');

global $DB, $PAGE, $OUTPUT, $CFG, $USER;

$PAGE->set_context(context_system::instance());
$PAGE->set_url('/local/lecrec/pages/lecturerpool.php');
$PAGE->set_title('Lecturer Recruitment');
$PAGE->requires->jquery();

$context = context_system::instance();
$user = $USER->id;

if (has_capability('local/lecrec:manager', $context)) {

    $PAGE->set_heading('Lecturer Recruitment');
    $PAGE->navbar->add('Lecturer Recruitment', new moodle_url('/local/lecrec/index.php', array('id' => $user)));
    $PAGE->navbar->add('Lecturer Pool', new moodle_url('/local/lecrec/lecturerpool.php', array('id' => $user)));

    echo $OUTPUT->header();
    echo $OUTPUT->heading('Pool of available lecturers');

    $attributes = array("lastname", "firstname", "professional_activities", "subject_area");
    $head = array("Lastname", "Firstname", "Professional Activities", "Subject Area");
    $align = array("center", "center", "center", "center");
    $equals = array("");


    getTable("lr_lecturer", $attributes, $head, $align, "", $equals);
    echo $OUTPUT->footer();
} else {
    redirect($CFG->wwwroot);
}
?>
<script>
    $(function() {
        $('#my-table tr[record_id] td').each(function() {
            $(this).css('cursor', 'pointer').hover(
                function() {
                    $(this).addClass('active');
                },
                function() {


                    $(this).removeClass('active');
                }).click(function() {
                var ID = $(this).attr('record_id');
                redirectUrl = 'ST_process_update.php';
                var form = $('<form action="' + redirectUrl + '" method="post">' +
                    '<input type="hidden" name="ID" value="' + ID + '"></input>' + '</form>');
                $('body').append(form);
                $(form).submit();

            });
        });
    });
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $input = filter_input_array(INPUT_POST);
    } else {
        $input = filter_input_array(INPUT_GET);
    };
</script>