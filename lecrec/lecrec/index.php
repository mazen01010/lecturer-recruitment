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


require_once(dirname(dirname(__DIR__)) . '/config.php');
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

    $tilesr = new CreateTile();
    $tilesr->setTitle('Lecturer Pool');
    $tilesr->setButtonName('Go To');
    $tilesr->setButtonURL(new moodle_url('/local/lecrec/lecturerpool.php'));


    $tilessp = new CreateTile();
    $tilessp->setTitle('Recruitment Processes');
    $tilessp->setButtonName('Go To');
    $tilessp->setButtonURL(new moodle_url('/local/lecrec/recruitmentprocess.php'));


    $tileContainer = new TileContainer();
    $tileContainer->addTile($tilesr);
    $tileContainer->addTile($tilessp);


    $tileContainer->render();

    echo $OUTPUT->footer();

}else {
    redirect($CFG->wwwroot);
}
