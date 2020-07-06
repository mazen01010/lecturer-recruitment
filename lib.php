<?php
defined('MOODLE_INTERNAL') || die();


function local_lecrec_extend_navigation(global_navigation $nav) {
    $context = context_system::instance();

    if(isloggedin()) {
        if(has_capability('local/lecrec:manager', $context)){
            $link = new moodle_url('/local/lecrec/index.php');
            $node = $nav->add('Lecturer Recruitment',$link,navigation_node::TYPE_CUSTOM,
                null,
                'lecrec',
                new pix_icon('lehrer', 'local_lecrec', 'local_lecrec')
            );
            $node->showinflatnavigation = true;


        }elseif (has_capability('local/lecrec:teacher', $context)){
            $link = new moodle_url('/local/lecrec/index.php');
            $node = $nav->add('Lecturer Recruitment',$link,navigation_node::TYPE_CUSTOM,
                null,
                'lecrec',
                new pix_icon('lehrer', 'local_lecrec', 'local_lecrec')
            );
        }

        if(isguestuser()){

            $link = new moodle_url('/local/lecrec/index.php');
            $node = $nav->add('Lecturer Recruitment',$link,navigation_node::TYPE_CUSTOM,
                null,
                'lecrec',
                new pix_icon('lehrer', 'local_lecrec', 'local_lecrec'));
            $node->showinflatnavigation = true;
        }
    }

}