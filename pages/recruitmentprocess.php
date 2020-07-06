<?php
require(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');
require_login();
include('../table.php');

global $DB, $PAGE, $OUTPUT, $CFG , $USER;

$PAGE->set_context(context_system::instance());
$PAGE->set_url('/local/lecrec/pages/recruitmentprocess.php');
$PAGE->set_title('Lecturer Recruitment');

$context = context_system::instance();
$user = $USER->id;

if(has_capability('local/lecrec:manager', $context)){

    $PAGE->set_heading('Lecturer Recruitment');
    $PAGE->navbar->add('Lecturer Recruitment',new moodle_url('/local/lecrec/index.php', array('id' => $user)));
    $PAGE->navbar->add('Recruitment Processes',new moodle_url('/local/lecrec/pages/recruitmentprocess.php', array('id' => $user)));

    echo $OUTPUT->header();
    echo $OUTPUT->heading('Recruitment Processes');

    $attributes = array("id", "fname", "lname", "job", "subject_of_interest", "company_email");
    $head = array("ID", "Firstname", "Lastname", "Job", "Subjects", "E-Mail");
    $align = array("center", "center", "center","center", "center","center");
    $equals = array("");


    getTable("lr_application", $attributes, $head, $align, "", $equals);


    echo $OUTPUT->footer();

}else {
    redirect($CFG->wwwroot);
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

