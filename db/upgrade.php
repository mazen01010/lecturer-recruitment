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

    if ($oldversion < 2020062306) {

        // Define table lr_lecturer to be dropped.
        $table = new xmldb_table('lr_lecturer');

        // Conditionally launch drop table for lr_lecturer.
        if ($dbman->table_exists($table)) {
            $dbman->drop_table($table);
        }
        // Define table lr_subjects to be dropped.
        $table = new xmldb_table('lr_subjects');

        // Conditionally launch drop table for lr_subjects.
        if ($dbman->table_exists($table)) {
            $dbman->drop_table($table);
        }
        // Define table lr_course_room to be dropped.
        $table = new xmldb_table('lr_course_room');

        // Conditionally launch drop table for lr_course_room.
        if ($dbman->table_exists($table)) {
            $dbman->drop_table($table);
        }
        // Define table lr_job_postings to be dropped.
        $table = new xmldb_table('lr_job_postings');

        // Conditionally launch drop table for lr_job_postings.
        if ($dbman->table_exists($table)) {
            $dbman->drop_table($table);
        }
        // Define table lr_posting_assignment to be dropped.
        $table = new xmldb_table('lr_posting_assignment');

        // Conditionally launch drop table for lr_posting_assignment.
        if ($dbman->table_exists($table)) {
            $dbman->drop_table($table);
        }
        // Define table lr_application to be dropped.
        $table = new xmldb_table('lr_application');

        // Conditionally launch drop table for lr_application.
        if ($dbman->table_exists($table)) {
            $dbman->drop_table($table);
        }
        // Define table lr_subj_field_asgnmt to be dropped.
        $table = new xmldb_table('lr_subj_field_asgnmt');

        // Conditionally launch drop table for lr_subj_field_asgnmt.
        if ($dbman->table_exists($table)) {
            $dbman->drop_table($table);
        }
        // Define table lr_module to be dropped.
        $table = new xmldb_table('lr_module');

        // Conditionally launch drop table for lr_module.
        if ($dbman->table_exists($table)) {
            $dbman->drop_table($table);
        }

        // Define table lr_lecturer to be created.
        $table = new xmldb_table('lr_lecturer');

        // Adding fields to table lr_lecturer.
        $table->add_field(
            'id',
            XMLDB_TYPE_INTEGER,
            '11',
            null,
            XMLDB_NOTNULL,
            XMLDB_SEQUENCE,
            null
        );
        $table->add_field('mdl_user_id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);
        $table->add_field('lastname', XMLDB_TYPE_CHAR, '50', null, XMLDB_NOTNULL, null, null);
        $table->add_field('firstname', XMLDB_TYPE_CHAR, '50', null, XMLDB_NOTNULL, null, null);
        $table->add_field(
            'title',
            XMLDB_TYPE_CHAR,
            '50',
            null,
            XMLDB_NOTNULL,
            null,
            null
        );
        $table->add_field(
            'dateofbirth',
            XMLDB_TYPE_TEXT,
            null,
            null,
            XMLDB_NOTNULL,
            null,
            null
        );
        $table->add_field(
            'self_employed',
            XMLDB_TYPE_INTEGER,
            '2',
            null,
            XMLDB_NOTNULL,
            null,
            null
        );
        $table->add_field('private_street', XMLDB_TYPE_CHAR, '50', null, XMLDB_NOTNULL, null, null);
        $table->add_field('private_postalcode', XMLDB_TYPE_INTEGER, '9', null, XMLDB_NOTNULL, null, null);
        $table->add_field('private_city', XMLDB_TYPE_CHAR, '50', null, XMLDB_NOTNULL, null, null);
        $table->add_field('private_state', XMLDB_TYPE_CHAR, '50', null, XMLDB_NOTNULL, null, null);
        $table->add_field('private_phonenumber', XMLDB_TYPE_INTEGER, '9', null, XMLDB_NOTNULL, null, null);
        $table->add_field('private_cellphone_number', XMLDB_TYPE_INTEGER, '9', null, XMLDB_NOTNULL, null, null);
        $table->add_field('private_mail', XMLDB_TYPE_CHAR, '100', null, XMLDB_NOTNULL, null, null);
        $table->add_field('company_id', XMLDB_TYPE_INTEGER, '9', null, XMLDB_NOTNULL, null, null);
        $table->add_field('business_phonenumber', XMLDB_TYPE_INTEGER, '9', null, XMLDB_NOTNULL, null, null);
        $table->add_field('business_mail', XMLDB_TYPE_CHAR, '100', null, XMLDB_NOTNULL, null, null);
        $table->add_field('previous_teaching_activities', XMLDB_TYPE_CHAR, '500', null, XMLDB_NOTNULL, null, null);
        $table->add_field('professional_activities', XMLDB_TYPE_CHAR, '500', null, XMLDB_NOTNULL, null, null);
        $table->add_field('educational_interest', XMLDB_TYPE_CHAR, '500', null, XMLDB_NOTNULL, null, null);
        $table->add_field('subject_area', XMLDB_TYPE_CHAR, '500', null, XMLDB_NOTNULL, null, null);
        $table->add_field(
            'dg_company_id',
            XMLDB_TYPE_INTEGER,
            '10',
            null,
            null,
            null,
            null
        );

        // Adding keys to table lr_lecturer.
        $table->add_key('pk', XMLDB_KEY_PRIMARY, ['id']);
        $table->add_key('fk_mdl_user_id', XMLDB_KEY_FOREIGN, ['mdl_user_id'], 'user', ['id']);
        $table->add_key('dg_company_id', XMLDB_KEY_FOREIGN, ['dg_company_id'], 'dg_company', ['id']);

        // Conditionally launch create table for lr_lecturer.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }
        // Define table lr_module to be created.
        $table = new xmldb_table('lr_module');

        // Adding fields to table lr_module.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('module_identifier', XMLDB_TYPE_CHAR, '45', null, null, null, null);
        $table->add_field('module_name', XMLDB_TYPE_CHAR, '225', null, null, null, null);

        // Adding keys to table lr_module.
        $table->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);

        // Conditionally launch create table for lr_module.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // Define table lr_module to be created.
        $table = new xmldb_table('lr_module');

        // Adding fields to table lr_module.
        $table->add_field(
            'id',
            XMLDB_TYPE_INTEGER,
            '10',
            null,
            XMLDB_NOTNULL,
            XMLDB_SEQUENCE,
            null
        );
        $table->add_field(
            'module_identifier',
            XMLDB_TYPE_CHAR,
            '45',
            null,
            null,
            null,
            null
        );
        $table->add_field('module_name', XMLDB_TYPE_CHAR, '225', null, null, null, null);

        // Adding keys to table lr_module.
        $table->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);

        // Conditionally launch create table for lr_module.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // Define table lr_subjects to be created.
        $table = new xmldb_table('lr_subjects');

        // Adding fields to table lr_subjects.
        $table->add_field(
            'id',
            XMLDB_TYPE_INTEGER,
            '11',
            null,
            XMLDB_NOTNULL,
            XMLDB_SEQUENCE,
            null
        );
        $table->add_field('lr_subject_name', XMLDB_TYPE_CHAR, '255', null, null, null, null);
        $table->add_field('lr_description', XMLDB_TYPE_CHAR, '455', null, null, null, null);
        $table->add_field('lr_teaching_hours', XMLDB_TYPE_INTEGER, '9', null, null, null, null);
        $table->add_field('lr_module_id', XMLDB_TYPE_INTEGER, '10', null, null, null, null);

        // Adding keys to table lr_subjects.
        $table->add_key('pk', XMLDB_KEY_PRIMARY, ['id']);
        $table->add_key('lr_module_id', XMLDB_KEY_FOREIGN, ['lr_module_id'], 'lr_module', ['id']);

        // Conditionally launch create table for lr_subjects.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // Define table lr_job_postings to be created.
        $table = new xmldb_table('lr_job_postings');

        // Adding fields to table lr_job_postings.
        $table->add_field(
            'id',
            XMLDB_TYPE_INTEGER,
            '11',
            null,
            XMLDB_NOTNULL,
            XMLDB_SEQUENCE,
            null
        );
        $table->add_field(
            'external',
            XMLDB_TYPE_INTEGER,
            '2',
            null,
            null,
            null,
            '1'
        );
        $table->add_field('description', XMLDB_TYPE_CHAR, '455', null, null, null, null);
        $table->add_field(
            'expected_hours',
            XMLDB_TYPE_INTEGER,
            '9',
            null,
            null,
            null,
            null
        );
        $table->add_field(
            'lr_subjects_id',
            XMLDB_TYPE_INTEGER,
            '11',
            null,
            XMLDB_NOTNULL,
            null,
            null
        );
        $table->add_field('start_date', XMLDB_TYPE_DATETIME, null, null, null, null, null);
        $table->add_field('end_date', XMLDB_TYPE_DATETIME, null, null, null, null, null);
        $table->add_field('director_id', XMLDB_TYPE_INTEGER, '9', null, null, null, null);
        $table->add_field(
            'contact_person',
            XMLDB_TYPE_INTEGER,
            '9',
            null,
            null,
            null,
            null
        );

        // Adding keys to table lr_job_postings.
        $table->add_key('pk', XMLDB_KEY_PRIMARY, ['id']);
        $table->add_key(
            'fk_lr_subjects_id',
            XMLDB_KEY_FOREIGN,
            ['lr_subjects_id'],
            'lr_subjects',
            ['id']
        );

        // Conditionally launch create table for lr_job_postings.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // Define table lr_posting_assignment to be created.
        $table = new xmldb_table('lr_posting_assignment');

        // Adding fields to table lr_posting_assignment.
        $table->add_field(
            'id',
            XMLDB_TYPE_INTEGER,
            '11',
            null,
            XMLDB_NOTNULL,
            XMLDB_SEQUENCE,
            null
        );
        $table->add_field(
            'lr_lecturer_id',
            XMLDB_TYPE_INTEGER,
            '11',
            null,
            XMLDB_NOTNULL,
            null,
            null
        );
        $table->add_field('lr_job_postings_id', XMLDB_TYPE_INTEGER, '11', null, XMLDB_NOTNULL, null, null);

        // Adding keys to table lr_posting_assignment.
        $table->add_key('pk', XMLDB_KEY_PRIMARY, ['id']);
        $table->add_key(
            'fk_lr_lecturer_id',
            XMLDB_KEY_FOREIGN,
            ['lr_lecturer_id'],
            'lr_lecturer',
            ['id']
        );
        $table->add_key('fk_lr_job_postings_id', XMLDB_KEY_FOREIGN, ['lr_job_postings_id'], 'lr_job_postings', ['id']);

        // Conditionally launch create table for lr_posting_assignment.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // Define table lr_application to be created.
        $table = new xmldb_table('lr_application');

        // Adding fields to table lr_application.
        $table->add_field(
            'id',
            XMLDB_TYPE_INTEGER,
            '11',
            null,
            XMLDB_NOTNULL,
            XMLDB_SEQUENCE,
            null
        );
        $table->add_field('closed', XMLDB_TYPE_INTEGER, '2', null, null, null, '0');
        $table->add_field('status_of_application', XMLDB_TYPE_CHAR, '255', null, null, null, null);
        $table->add_field('lr_job_postings_id', XMLDB_TYPE_INTEGER, '11', null, XMLDB_NOTNULL, null, null);
        $table->add_field('fname', XMLDB_TYPE_CHAR, '255', null, null, null, null);
        $table->add_field('lname', XMLDB_TYPE_CHAR, '255', null, null, null, null);
        $table->add_field('email', XMLDB_TYPE_CHAR, '255', null, null, null, null);
        $table->add_field(
            'title',
            XMLDB_TYPE_CHAR,
            '45',
            null,
            null,
            null,
            null
        );
        $table->add_field(
            'date_of_birth',
            XMLDB_TYPE_DATETIME,
            null,
            null,
            null,
            null,
            null
        );
        $table->add_field('place_of_birth', XMLDB_TYPE_CHAR, '255', null, null, null, null);
        $table->add_field(
            'job',
            XMLDB_TYPE_CHAR,
            '255',
            null,
            null,
            null,
            null
        );
        $table->add_field('private_add_str', XMLDB_TYPE_CHAR, '455', null, null, null, null);
        $table->add_field('private_add_zip', XMLDB_TYPE_INTEGER, '9', null, null, null, null);
        $table->add_field(
            'private_add_city',
            XMLDB_TYPE_CHAR,
            '255',
            null,
            null,
            null,
            null
        );
        $table->add_field('private_tele', XMLDB_TYPE_INTEGER, '9', null, null, null, null);
        $table->add_field(
            'private_mobile',
            XMLDB_TYPE_INTEGER,
            '9',
            null,
            null,
            null,
            null
        );
        $table->add_field('private_email', XMLDB_TYPE_CHAR, '255', null, null, null, null);
        $table->add_field('private_fax', XMLDB_TYPE_INTEGER, '9', null, null, null, null);
        $table->add_field('company', XMLDB_TYPE_CHAR, '455', null, null, null, null);
        $table->add_field('company_add_str', XMLDB_TYPE_CHAR, '455', null, null, null, null);
        $table->add_field('company_add_zip', XMLDB_TYPE_INTEGER, '9', null, null, null, null);
        $table->add_field(
            'company_add_city',
            XMLDB_TYPE_CHAR,
            '255',
            null,
            null,
            null,
            null
        );
        $table->add_field('company_tele', XMLDB_TYPE_INTEGER, '9', null, null, null, null);
        $table->add_field('company_fax', XMLDB_TYPE_INTEGER, '9', null, null, null, null);
        $table->add_field('company_email', XMLDB_TYPE_CHAR, '255', null, null, null, null);
        $table->add_field(
            'education',
            XMLDB_TYPE_CHAR,
            '455',
            null,
            null,
            null,
            null
        );
        $table->add_field('teaching_activities', XMLDB_TYPE_CHAR, '455', null, null, null, null);
        $table->add_field('job_activities', XMLDB_TYPE_CHAR, '455', null, null, null, null);
        $table->add_field('subject_of_interest', XMLDB_TYPE_CHAR, '455', null, null, null, null);

        // Adding keys to table lr_application.
        $table->add_key('pk', XMLDB_KEY_PRIMARY, ['id']);
        $table->add_key('fk_lr_job_postings_id', XMLDB_KEY_FOREIGN, ['lr_job_postings_id'], 'lr_job_postings', ['id']);

        // Conditionally launch create table for lr_application.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // Define table sr_study_programs to be created.
        $table = new xmldb_table('sr_study_programs');

        // Adding fields to table sr_study_programs.
        $table->add_field(
            'id',
            XMLDB_TYPE_INTEGER,
            '18',
            null,
            XMLDB_NOTNULL,
            XMLDB_SEQUENCE,
            null
        );
        $table->add_field('study_program_name', XMLDB_TYPE_CHAR, '255', null, null, null, null);
        $table->add_field('description', XMLDB_TYPE_CHAR, '455', null, null, null, null);
        $table->add_field('valid_from', XMLDB_TYPE_DATETIME, null, null, null, null, null);
        $table->add_field('valid_to', XMLDB_TYPE_DATETIME, null, null, null, null, null);
        $table->add_field(
            'old',
            XMLDB_TYPE_INTEGER,
            '1',
            null,
            null,
            null,
            '0'
        );

        // Adding keys to table sr_study_programs.
        $table->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);

        // Conditionally launch create table for sr_study_programs.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // Define table sr_study_fields to be created.
        $table = new xmldb_table('sr_study_fields');

        // Adding fields to table sr_study_fields.
        $table->add_field(
            'id',
            XMLDB_TYPE_INTEGER,
            '18',
            null,
            XMLDB_NOTNULL,
            XMLDB_SEQUENCE,
            null
        );
        $table->add_field(
            'study_field_name',
            XMLDB_TYPE_CHAR,
            '255',
            null,
            null,
            null,
            null
        );
        $table->add_field('description', XMLDB_TYPE_CHAR, '455', null, null, null, null);
        $table->add_field(
            'old',
            XMLDB_TYPE_INTEGER,
            '1',
            null,
            null,
            null,
            '0'
        );
        $table->add_field('sr_study_programs_id', XMLDB_TYPE_INTEGER, '18', null, null, null, null);

        // Adding keys to table sr_study_fields.
        $table->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);
        $table->add_key('sr_study_programs_id', XMLDB_KEY_FOREIGN, ['sr_study_programs_id'], 'sr_study_programs', ['id']);

        // Conditionally launch create table for sr_study_fields.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }
        // Define table lr_subj_field_asgnmt to be created.
        $table = new xmldb_table('lr_subj_field_asgnmt');

        // Adding fields to table lr_subj_field_asgnmt.
        $table->add_field(
            'id',
            XMLDB_TYPE_INTEGER,
            '11',
            null,
            XMLDB_NOTNULL,
            XMLDB_SEQUENCE,
            null
        );
        $table->add_field(
            'lr_subjects_id',
            XMLDB_TYPE_INTEGER,
            '11',
            null,
            null,
            null,
            null
        );
        $table->add_field('sr_study_field_id', XMLDB_TYPE_INTEGER, '10', null, null, null, null);

        // Adding keys to table lr_subj_field_asgnmt.
        $table->add_key('pk', XMLDB_KEY_PRIMARY, ['id']);
        $table->add_key(
            'fk_lr_subjects_id',
            XMLDB_KEY_FOREIGN,
            ['lr_subjects_id'],
            'lr_subjects',
            ['id']
        );
        $table->add_key(
            'sr_study_field_id',
            XMLDB_KEY_FOREIGN,
            ['sr_study_field_id'],
            'sr_study_fields',
            ['id']
        );

        // Conditionally launch create table for lr_subj_field_asgnmt.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }




        // Lecrec savepoint reached.
        upgrade_plugin_savepoint(true, 2020062306, 'local', 'lecrec');
    }


    return true;
}