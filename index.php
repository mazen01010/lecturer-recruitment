<?php
// This file is part of the Local Analytics plugin for Moodle
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.


/**
 * Information about the version of the plugin.
 *
 * @package   local_lecrec
 * @copyright nico_andres@gmx.de
 * @license   https://moodle.dhbw-mannheim.de/
 */


require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once(__DIR__ . '/lib.php');
require_once(__DIR__ . '/assets/PHPClasses/UI.php');

global $DB, $PAGE, $OUTPUT, $CFG, $USER;

require_login();

$PAGE->set_context(context_system::instance());
$PAGE->set_url('/local/lecrec/index.php');
$PAGE->set_title('Lecturer Recruitment');

$context = context_system::instance();

if(has_capability('local/lecrec:manager', $context)){


    $PAGE->set_heading('Lecturer Recruitment');
    echo $OUTPUT->header();

    $tilelp = new CreateTile();
    $tilelp->setTitle('Lecturer Pool');
    $tilelp->setButtonName('Go To');
    $tilelp->setButtonURL(new moodle_url('/local/lecrec/pages/lecturerpool.php'));

    $tilesrp = new CreateTile();
    $tilesrp->setTitle('Recruitment Processes');
    $tilesrp->setButtonName('Go To');
    $tilesrp->setButtonURL(new moodle_url('/local/lecrec/pages/recruitmentprocess.php'));

    $tilestp = new CreateTile();
    $tilestp->setTitle('Open Teaching Postings');
    $tilestp->setButtonName('Go To');
    $tilestp->setButtonURL(new moodle_url('/local/lecrec/pages/teachingpostings.php'));

    $tilestest = new CreateTile();
    $tilestest->setTitle('Test');
    $tilestest->setButtonName('Go To');
    $tilestest->setButtonURL(new moodle_url('/local/lecrec/pages/createposting.php'));

    $tileContainer = new TileContainer();
    $tileContainer->addTile($tilelp);
    $tileContainer->addTile($tilesrp);
    $tileContainer->addTile($tilestp);
    $tileContainer->addTile($tilestest);


    $tileContainer->render();

    echo $OUTPUT->footer();

}
elseif (isguestuser()){
    $PAGE->set_heading('Lecturer Recruitment');
    echo $OUTPUT->header();

    $tilestp = new CreateTile();
    $tilestp->setTitle('Open Teaching Postings');
    $tilestp->setButtonName('Go To');
    $tilestp->setButtonURL(new moodle_url('/local/lecrec/pages/teachingpostings.php'));

    $tilestest = new CreateTile();
    $tilestest->setTitle('Test');
    $tilestest->setButtonName('Go To');
    $tilestest->setButtonURL(new moodle_url('/local/lecrec/pages/testpage.php'));

    $tileContainer = new TileContainer();
    $tileContainer->addTile($tilestp);
    $tileContainer->addTile($tilestest);
    $tileContainer->render();

    echo $OUTPUT->footer();
}
else {
    redirect($CFG->wwwroot);
}
