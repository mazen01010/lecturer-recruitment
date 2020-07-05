<?php

function getTableLecturerPool($tablename, array $attributes, array $head, array $align, $where, array $equals)
{
    global $DB;

    $table = new html_table();
    $table->id= 'my-table';
    $table->attributes['class'] = 'table table-md';

    $records = $DB->get_records_select($tablename, $where ,$equals );

    $table->head = $head;
    $table->align = $align;

    foreach ($records as $record) {
        $i = 0;
        $row = new html_table_row();
        $row->attributes['record_id'] = $record->id;

        foreach ($attributes as $attribute) {
            $i++;
            $cell = new html_table_cell();
            $cell->text = $record->$attribute;
            $row->cells[] = $cell;
        }

            $table->data[] = $row;

    }
    echo html_writer::table($table);
}
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
