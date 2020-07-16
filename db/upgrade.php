<?php
// This file is part of Moodle - http://moodle.org/
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
 * Plugin upgrade steps are defined here.
 *
 * @package     local_lecrec
 * @category    upgrade
 * @copyright   nico_andres@gmx.de
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once(__DIR__ . '/upgradelib.php');

/**
 * Execute local_lecrec upgrade from the given old version.
 *
 * @param int $oldversion
 * @return bool
 */
function xmldb_local_lecrec_upgrade($oldversion)
{
    global $DB;

    $dbman = $DB->get_manager();

    // For further information please read the Upgrade API documentation:
    // https://docs.moodle.org/dev/Upgrade_API
    //
    // You will also have to create the db/install.xml file by using the XMLDB Editor.
    // Documentation for the XMLDB Editor can be found at:
    // https://docs.moodle.org/dev/XMLDB_editor

    if ($oldversion < 2020062307) {

        // Changing type of field description on table lr_job_postings to char.
        $table = new xmldb_table('lr_job_postings');
        $field = new xmldb_field('description', XMLDB_TYPE_CHAR, '1024', null, null, null, null, 'external');

        // Launch change of type for field description.
        $dbman->change_field_type($table, $field);

        // Changing type of field lr_description on table lr_subjects to char.
        $table = new xmldb_table('lr_subjects');
        $field = new xmldb_field('lr_description', XMLDB_TYPE_CHAR, '1024', null, null, null, null, 'lr_subject_name');

        // Launch change of type for field lr_description.
        $dbman->change_field_type($table, $field);


        // Lecrec savepoint reached.
        upgrade_plugin_savepoint(true, 2020062307, 'local', 'lecrec');
    }


    return true;
}
