<?php

require(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');
require_login();



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
    echo '
    <form action="lecturer_c_u_form.php" method="post">
      <div class="form-row">
        <div class="col">
          <input type="submit" value="Add New Lecturer" id="addRow9" class="btn btn-danger mb-2 pull-right"/>
        </div>
      </div>
    </form>
    <br/>
    ';
    $table = new html_table();
    $table->id = 'my-table';
    $table->attributes['class'] = 'table table-sm';

    $sql = "SELECT le.id, firstname, lastname , professional_activities , subject_area , dg.company_name
            FROM {lr_lecturer} AS le
            LEFT OUTER JOIN {dg_company} AS dg ON le.dg_company_id = dg.id";
    $records = $DB->get_records_sql($sql);
    //$records = $DB->get_records("lr_lecturer");

    $table->head = array('ID', 'First Name', 'Last Name', 'Professional Activities', 'Subject Area', 'Company');
    $table->align = array('center', 'center', 'center', 'center', 'center', 'center');

    $i = 0;
    foreach ($records as $record) {

        $row = new html_table_row();
        $row->attributes['record_id'] = $record->id;

        $cell1 = new html_table_cell();
        $cell1->text = ++$i;

        $cell2 = new html_table_cell();
        $cell2->text = $record->firstname;

        $cell3 = new html_table_cell();
        $cell3->text = $record->lastname;

        $cell4 = new html_table_cell();
        $cell4->text = $record->professional_activities;

        $cell5 = new html_table_cell();
        $cell5->text = $record->subject_area;

        $cell6 = new html_table_cell();
        $cell6->text = $record->company_name;

        $row->cells  = array($cell1, $cell2, $cell3, $cell4, $cell5, $cell6);

        $table->rowclasses[$record->id] = '';
        $table->data[]  = $row;
    };


    echo html_writer::table($table);
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

    $(function() {

        $('#my-table thead tr').append('<td class="pull-right"><b>View Applications</b></td>');

        i = 0;
        $('#my-table tr[record_id]').each(function() {
            i++;
            $(this).append('<td id="reservationlist' + i + '" style="cursor: pointer;"><button type="button" class="btn btn-default pull-right" style="cursor: pointer;">View</button></td>');
            $('#reservationlist' + i + '').css('cursor', 'pointer').hover(
                function() {
                    $(this).addClass('active');
                },
                function() {

                    $(this).removeClass('active');
                }).click(function() {
                var processID = $(this).parent().attr('RecordID');
                redirectUrl = 'ST_WL_overview.php';
                var form = $('<form action="' + redirectUrl + '" method="post">' +
                    '<input type="hidden" name="processID" value="' + processID + '"></input>' + '</form>');
                $('body').append(form);
                $(form).submit();

            });

        });


    });
</script>


<?php

echo $OUTPUT->footer();

?>