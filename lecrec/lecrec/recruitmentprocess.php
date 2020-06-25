<?php
require(dirname(dirname(dirname(__FILE__))).'/config.php');
require_login();

global $DB, $PAGE, $OUTPUT, $CFG , $USER;

$PAGE->set_context(context_system::instance());
$PAGE->set_url('/local/lecrec/recruitmentprocess.php');
$PAGE->set_title('Lecturer Recruitment');

$context = context_system::instance();
$user = $USER->id;

if(has_capability('local/lecrec:manager', $context)){

    $PAGE->set_heading('Lecturer Recruitment');
    $PAGE->navbar->add('Lecturer Recruitment',new moodle_url('/local/lecrec/index.php', array('id' => $user)));
    $PAGE->navbar->add('Recruitment Processes',new moodle_url('/local/lecrec/recruitmentprocess.php', array('id' => $user)));

    echo $OUTPUT->header();
    echo $OUTPUT->heading('Recruitment Processes');

    $sql ='SELECT * FROM mdl_lr_recruitmentprocess';
    $table = new html_table();
    $table->id= 'my-table';
    $table->attributes['class'] = 'generaltable mod_index';
    $count = $DB->count_records_select("lr_recruitmentprocess",'id',array('closed=0'));
    $records = $DB->get_records_select('lr_recruitmentprocess', 'id', array('*'));

    $table->head = array('Firstname', 'Lastname', 'Company', 'Educational Interest', 'Professional Activities', 'Lecture', 'Date of Application', 'Status of Application');
    $table->align = array('left', 'left', 'left','left', 'left', 'left', 'left');


    for($i=0; $i<$count; $i++) {

        $row = new html_table_row();
        $row->attributes['data-href'] = 'recruitmentprocess.php?#RecordID='.$records[$i+1]->id.'';

        $cell1 = new html_table_cell();
        $cell1->text = $records[$i+1]->firstname;

        $cell2 = new html_table_cell();
        $cell2->text =$records[$i+1]->lastname;

        $cell3 = new html_table_cell();
        $cell3->text =$records[$i+1]->company;

        $cell4 = new html_table_cell();
        $cell4->text = $records[$i+1]->educational_interest;

        $cell5 = new html_table_cell();
        $cell5->text =$records[$i+1]->professional_activities;

        $cell6 = new html_table_cell();
        $cell6->text =$records[$i+1]->lecture;

        $cell7 = new html_table_cell();
        $cell7->text =$records[$i+1]->date_of_application;

        $cell8 = new html_table_cell();
        $cell8->text =$records[$i+1]->status_of_application;

        $row->cells  = array($cell1,$cell2,$cell3, $cell4, $cell5, $cell6, $cell7, $cell8);

        $table->rowclasses[$i]= '';
        $table->data[]  = $row;

    }


    echo html_writer::table($table);

//    echo $OUTPUT->single_button(new moodle_url('/local/student_registration/views/ST_process/ST_process_creation.php', array('id' => $user)),
//        'Add new Process', $attributes = null);

    echo $OUTPUT->footer();

}else {
    redirect($CFG->wwwroot);
}


/*
//https://bluesatkv.github.io/jquery-tabledit/#documentation
https://www.jqueryscript.net/table/Inline-Table-Editing-jQuery-Tabledit.html
*/

?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="../../assets/JavaScript/jquery.tabledit.js"></script>
<script>

    // redirect when click on a row
    $(function(){
        $('#my-table tr[data-href]').each(function(){
            $(this).css('cursor','pointer').hover(
                function(){
                    $(this).addClass('active');
                },
                function(){
                    $(this).removeClass('active');
                }).click( function(){
                    document.location = $(this).attr('data-href');
                }
            );
        });
    });

    $('#example9').Tabledit({
        editButton: true,
        saveButton: true,
        columns: {
            identifier: [0, 'id'],
            editable: [[1, 'col1'], [2, 'col1'], [3, 'col3']]
        },
        buttons: {
            edit: {
                class: 'btn btn-sm btn-default',
                html: '<span class="fa fa-pencil"></span>',
                action: 'edit'
            },
            delete: {
                class: 'btn btn-sm btn-default',
                html: '<span class="fa fa-trash"></span>',
                action: 'delete'
            },
            save: {
                class: 'btn btn-sm btn-success',
                html: 'Save'
            },
            restore: {
                class: 'btn btn-sm btn-warning',
                html: 'Restore',
                action: 'restore'
            },
            confirm: {
                class: 'btn btn-sm btn-danger',
                html: 'Confirm'
            }
        }
    });


    $('#my-table2').Tabledit({
        editButton: true,
        saveButton: true,
        columns: {
            identifier: [0, 'id'],
            editable: [[1, 'col1'], [2, 'col1'], [3, 'col3']]
        },
        buttons: {
            edit: {
                class: 'btn btn-sm btn-default',
                html: '<span class="fa fa-pencil"></span>',
                action: 'edit'
            },
            delete: {
                class: 'btn btn-sm btn-default',
                html: '<span class="fa fa-trash"></span>',
                action: 'delete'
            },
            save: {
                class: 'btn btn-sm btn-success',
                html: 'Save'
            },
            restore: {
                class: 'btn btn-sm btn-warning',
                html: 'Restore',
                action: 'restore'
            },
            confirm: {
                class: 'btn btn-sm btn-danger',
                html: 'Confirm'
            }
        }
    });



    $('#example9').Tabledit({
        url: 'ajax/example.php',
        columns: {
            identifier: [0, 'id'],
            editable: [[1, 'make'],[2, 'year'],[3, 'model'],[4, 'platform']]
        }
    });

    $("#addRow9").on('click', function () {
        // Getting value
        var ID = '3';

        $.ajax({
            type: "POST",
            url: "ajax/add_new.php",
            datatype: 'html',
            data: {
                ID: ID
            },
            success: function (data) {

                // Add 'html' data to table
                $('#example9 tbody').html(data);

                // Update Tabledit plugin
                $('#example9').Tabledit('update');

            },
            error: function () {

            }
        })
    });



    $('#example10').Tabledit({
        url: 'ajax/example.php',
        columns: {
            identifier: [0, 'id'],
            editable: [[1, 'make'],[2, 'year'],[3, 'model'],[4, 'platform']]
        }
    });

    $('#addRow10').click(function() {
        var table = $('#example9');
        var body = $('#example9 tbody');
        var nextId = body.find('tr').length + 1;
        table.prepend($('' + nextId + ''));
        table.Tabledit('update');
    });



</script>

