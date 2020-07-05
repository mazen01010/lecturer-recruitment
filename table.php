<?php

function getTable($tablename, array $attributes, array $head, array $align, $where, array $equals)
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