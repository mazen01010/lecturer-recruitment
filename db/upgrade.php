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

    if ($oldversion < 2020062304) {

        // Define table lr_company to be created.
        $table = new xmldb_table('lr_company');

        // Adding fields to table lr_company.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '11', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('name', XMLDB_TYPE_CHAR, '50', null, null, null, null);
        $table->add_field('street', XMLDB_TYPE_CHAR, '50', null, null, null, null);
        $table->add_field('postalcode', XMLDB_TYPE_INTEGER, '9', null, null, null, null);
        $table->add_field('city', XMLDB_TYPE_CHAR, '50', null, null, null, null);
        $table->add_field('state', XMLDB_TYPE_CHAR, '50', null, null, null, null);

        // Adding keys to table lr_company.
        $table->add_key('pk', XMLDB_KEY_PRIMARY, ['id']);

        // Conditionally launch create table for lr_company.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // Define table lr_lecturer to be created.
        $table = new xmldb_table('lr_lecturer');

        // Adding fields to table lr_lecturer.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '11', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('mdl_user_id', XMLDB_TYPE_INTEGER, '10', null, null, null, null);
        $table->add_field('lastname', XMLDB_TYPE_CHAR, '50', null, null, null, null);
        $table->add_field('firstname', XMLDB_TYPE_CHAR, '50', null, null, null, null);
        $table->add_field('title', XMLDB_TYPE_CHAR, '50', null, null, null, null);
        $table->add_field('dateofbirth', XMLDB_TYPE_TEXT, null, null, null, null, null);
        $table->add_field('self_employed', XMLDB_TYPE_INTEGER, '2', null, null, null, null);
        $table->add_field('private_street', XMLDB_TYPE_CHAR, '50', null, null, null, null);
        $table->add_field('private_postalcode', XMLDB_TYPE_INTEGER, '9', null, null, null, null);
        $table->add_field('private_city', XMLDB_TYPE_CHAR, '50', null, null, null, null);
        $table->add_field(
            'private_state',
            XMLDB_TYPE_CHAR,
            '50',
            null,
            null,
            null,
            null
        );
        $table->add_field('private_phonenumber', XMLDB_TYPE_INTEGER, '9', null, null, null, null);
        $table->add_field('private_cellphone', XMLDB_TYPE_INTEGER, '9', null, null, null, null);
        $table->add_field('private_mail', XMLDB_TYPE_CHAR, '100', null, null, null, null);
        $table->add_field(
            'company_id',
            XMLDB_TYPE_INTEGER,
            '9',
            null,
            null,
            null,
            null
        );
        $table->add_field('business_phonenumber', XMLDB_TYPE_INTEGER, '9', null, null, null, null);
        $table->add_field(
            'business_mail',
            XMLDB_TYPE_CHAR,
            '100',
            null,
            null,
            null,
            null
        );
        $table->add_field('previous_teaching_activities', XMLDB_TYPE_CHAR, '500', null, null, null, null);
        $table->add_field('professional_activities', XMLDB_TYPE_CHAR, '500', null, null, null, null);
        $table->add_field('educational_interest', XMLDB_TYPE_CHAR, '500', null, null, null, null);
        $table->add_field('subject_area', XMLDB_TYPE_CHAR, '500', null, null, null, null);

        // Adding keys to table lr_lecturer.
        $table->add_key('pk', XMLDB_KEY_PRIMARY, ['id']);
        $table->add_key('fk_mdl_user_id', XMLDB_KEY_FOREIGN, ['mdl_user_id'], 'mdl_user', ['id']);

        // Conditionally launch create table for lr_lecturer.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }
        // Define table lr_subjects to be created.
        $table = new xmldb_table('lr_subjects');

        // Adding fields to table lr_subjects.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '11', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('lr_subject_name', XMLDB_TYPE_CHAR, '255', null, null, null, null);
        $table->add_field('lr_description', XMLDB_TYPE_CHAR, '455', null, null, null, null);
        $table->add_field('lr_teaching_hours', XMLDB_TYPE_INTEGER, '9', null, null, null, null);

        // Adding keys to table lr_subjects.
        $table->add_key('pk', XMLDB_KEY_PRIMARY, ['id']);

        // Conditionally launch create table for lr_subjects.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }
        // Define table lr_corporate_partner to be created.
        $table = new xmldb_table('lr_corporate_partner');

        // Adding fields to table lr_corporate_partner.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '11', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('contact', XMLDB_TYPE_INTEGER, '9', null, null, null, null);

        // Adding keys to table lr_corporate_partner.
        $table->add_key('pk', XMLDB_KEY_PRIMARY, ['id']);

        // Conditionally launch create table for lr_corporate_partner.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }
        // Define table lr_dean_of_studies to be created.
        $table = new xmldb_table('lr_dean_of_studies');

        // Adding fields to table lr_dean_of_studies.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '11', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);

        // Adding keys to table lr_dean_of_studies.
        $table->add_key('pk', XMLDB_KEY_PRIMARY, ['id']);

        // Conditionally launch create table for lr_dean_of_studies.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }
        // Define table lr_course_room to be created.
        $table = new xmldb_table('lr_course_room');

        // Adding fields to table lr_course_room.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '11', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('number_room', XMLDB_TYPE_INTEGER, '9', null, null, null, null);
        $table->add_field(
            'building',
            XMLDB_TYPE_CHAR,
            '1',
            null,
            null,
            null,
            null
        );

        // Adding keys to table lr_course_room.
        $table->add_key('pk', XMLDB_KEY_PRIMARY, ['id']);

        // Conditionally launch create table for lr_course_room.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }
        // Define table lr_course to be created.
        $table = new xmldb_table('lr_course');

        // Adding fields to table lr_course.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '11', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('dean_of_studies_id', XMLDB_TYPE_INTEGER, '11', null, null, null, null);
        $table->add_field('name', XMLDB_TYPE_CHAR, '100', null, null, null, null);

        // Adding keys to table lr_course.
        $table->add_key('pk', XMLDB_KEY_PRIMARY, ['id']);
        $table->add_key('dean_of_studies_id', XMLDB_KEY_FOREIGN, ['dean_of_studies_id'], 'lr_dean_of_studies', ['id']);

        // Conditionally launch create table for lr_course.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }
        // Define table lr_lecture to be created.
        $table = new xmldb_table('lr_lecture');

        // Adding fields to table lr_lecture.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '9', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('course_room_id', XMLDB_TYPE_INTEGER, '11', null, null, null, null);
        $table->add_field('lecturer_id', XMLDB_TYPE_INTEGER, '11', null, null, null, null);
        $table->add_field('lecturer_data', XMLDB_TYPE_INTEGER, '9', null, null, null, null);
        $table->add_field('number_of_students', XMLDB_TYPE_INTEGER, '9', null, null, null, null);
        $table->add_field('start_date', XMLDB_TYPE_TEXT, null, null, null, null, null);
        $table->add_field('description', XMLDB_TYPE_CHAR, '500', null, null, null, null);
        $table->add_field('subject_area', XMLDB_TYPE_CHAR, '50', null, null, null, null);
        $table->add_field('language', XMLDB_TYPE_CHAR, '50', null, null, null, null);
        $table->add_field('semester', XMLDB_TYPE_INTEGER, '9', null, null, null, null);
        $table->add_field('number_of_ects', XMLDB_TYPE_INTEGER, '9', null, null, null, null);
        $table->add_field('number_of_hours', XMLDB_TYPE_INTEGER, '9', null, null, null, null);

        // Adding keys to table lr_lecture.
        $table->add_key('pk', XMLDB_KEY_PRIMARY, ['id']);
        $table->add_key('fk_lecturer_id', XMLDB_KEY_FOREIGN, ['lecturer_id'], 'lr_lecturer', ['id']);
        $table->add_key('fk_course_room_id', XMLDB_KEY_FOREIGN, ['course_room_id'], 'lr_course_room', ['id']);

        // Conditionally launch create table for lr_lecture.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }
        // Define table lr_student to be created.
        $table = new xmldb_table('lr_student');

        // Adding fields to table lr_student.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '11', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('firstname', XMLDB_TYPE_CHAR, '50', null, null, null, null);
        $table->add_field('lastname', XMLDB_TYPE_CHAR, '50', null, null, null, null);
        $table->add_field(
            'company_id',
            XMLDB_TYPE_INTEGER,
            '11',
            null,
            null,
            null,
            null
        );

        // Adding keys to table lr_student.
        $table->add_key('pk', XMLDB_KEY_PRIMARY, ['id']);
        $table->add_key(
            'fk_company_id',
            XMLDB_KEY_FOREIGN,
            ['company_id'],
            'lr_company',
            ['id']
        );

        // Conditionally launch create table for lr_student.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }
        // Define table lr_is_corporate_partner to be created.
        $table = new xmldb_table('lr_is_corporate_partner');

        // Adding fields to table lr_is_corporate_partner.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '11', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field(
            'company_id',
            XMLDB_TYPE_INTEGER,
            '11',
            null,
            null,
            null,
            null
        );
        $table->add_field('corporate_partner_id', XMLDB_TYPE_INTEGER, '11', null, null, null, null);

        // Adding keys to table lr_is_corporate_partner.
        $table->add_key('pk', XMLDB_KEY_PRIMARY, ['id']);
        $table->add_key(
            'fk_company_id',
            XMLDB_KEY_FOREIGN,
            ['company_id'],
            'lr_company',
            ['id']
        );
        $table->add_key('fk_corporate_partner_id', XMLDB_KEY_FOREIGN, ['corporate_partner_id'], 'lr_corporate_partner', ['id']);

        // Conditionally launch create table for lr_is_corporate_partner.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }
        // Define table lr_job_postings to be created.
        $table = new xmldb_table('lr_job_postings');

        // Adding fields to table lr_job_postings.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '11', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('external', XMLDB_TYPE_INTEGER, '2', null, null, null, '1');
        $table->add_field('description', XMLDB_TYPE_CHAR, '455', null, null, null, null);
        $table->add_field('expected_hours', XMLDB_TYPE_INTEGER, '9', null, null, null, null);
        $table->add_field('lr_subjects_id', XMLDB_TYPE_INTEGER, '11', null, null, null, null);
        $table->add_field('start_date', XMLDB_TYPE_DATETIME, null, null, null, null, null);
        $table->add_field('end_date', XMLDB_TYPE_DATETIME, null, null, null, null, null);
        $table->add_field('director_id', XMLDB_TYPE_INTEGER, '9', null, null, null, null);
        $table->add_field('contact_person', XMLDB_TYPE_INTEGER, '9', null, null, null, null);

        // Adding keys to table lr_job_postings.
        $table->add_key('pk', XMLDB_KEY_PRIMARY, ['id']);
        $table->add_key('fk_lr_subjects_id', XMLDB_KEY_FOREIGN, ['lr_subjects_id'], 'lr_subjects', ['id']);

        // Conditionally launch create table for lr_job_postings.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }
        // Define table lr_posting_assignment to be created.
        $table = new xmldb_table('lr_posting_assignment');

        // Adding fields to table lr_posting_assignment.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '11', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('lr_lecturer_id', XMLDB_TYPE_INTEGER, '11', null, null, null, null);
        $table->add_field('lr_job_postings_id', XMLDB_TYPE_INTEGER, '11', null, null, null, null);

        // Adding keys to table lr_posting_assignment.
        $table->add_key('pk', XMLDB_KEY_PRIMARY, ['id']);
        $table->add_key('fk_lr_lecturer_id', XMLDB_KEY_FOREIGN, ['lr_lecturer_id'], 'lr_lecturer', ['id']);
        $table->add_key('fk_lr_job_postings_id', XMLDB_KEY_FOREIGN, ['lr_job_postings_id'], 'lr_job_postings', ['id']);

        // Conditionally launch create table for lr_posting_assignment.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }
        // Define table lr_application to be created.
        $table = new xmldb_table('lr_application');

        // Adding fields to table lr_application.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '11', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('closed', XMLDB_TYPE_INTEGER, '2', null, null, null, '0');
        $table->add_field('status_of_application', XMLDB_TYPE_CHAR, '255', null, null, null, null);
        $table->add_field('lr_job_postings_id', XMLDB_TYPE_INTEGER, '11', null, null, null, null);
        $table->add_field('fname', XMLDB_TYPE_CHAR, '255', null, null, null, null);
        $table->add_field('lname', XMLDB_TYPE_CHAR, '255', null, null, null, null);
        $table->add_field('email', XMLDB_TYPE_CHAR, '255', null, null, null, null);
        $table->add_field('title', XMLDB_TYPE_CHAR, '45', null, null, null, null);
        $table->add_field('date_of_birth', XMLDB_TYPE_DATETIME, null, null, null, null, null);
        $table->add_field('place_of_birth', XMLDB_TYPE_CHAR, '255', null, null, null, null);
        $table->add_field('job', XMLDB_TYPE_CHAR, '255', null, null, null, null);
        $table->add_field('private_add_str', XMLDB_TYPE_CHAR, '455', null, null, null, null);
        $table->add_field('private_add_zip', XMLDB_TYPE_INTEGER, '9', null, null, null, null);
        $table->add_field('private_add_city', XMLDB_TYPE_CHAR, '255', null, null, null, null);
        $table->add_field('private_tele', XMLDB_TYPE_INTEGER, '9', null, null, null, null);
        $table->add_field('private_mobile', XMLDB_TYPE_INTEGER, '9', null, null, null, null);
        $table->add_field(
            'private_email',
            XMLDB_TYPE_CHAR,
            '255',
            null,
            null,
            null,
            null
        );
        $table->add_field('private_fax', XMLDB_TYPE_INTEGER, '9', null, null, null, null);
        $table->add_field('company', XMLDB_TYPE_CHAR, '455', null, null, null, null);
        $table->add_field('company_add_str', XMLDB_TYPE_CHAR, '455', null, null, null, null);
        $table->add_field('company_add_zip', XMLDB_TYPE_INTEGER, '9', null, null, null, null);
        $table->add_field('company_add_city', XMLDB_TYPE_CHAR, '255', null, null, null, null);
        $table->add_field('company_tele', XMLDB_TYPE_INTEGER, '9', null, null, null, null);
        $table->add_field('company_fax', XMLDB_TYPE_INTEGER, '9', null, null, null, null);
        $table->add_field(
            'company_email',
            XMLDB_TYPE_CHAR,
            '255',
            null,
            null,
            null,
            null
        );
        $table->add_field('education', XMLDB_TYPE_CHAR, '455', null, null, null, null);
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
        // Define table lr_has_lectures to be created.
        $table = new xmldb_table('lr_has_lectures');

        // Adding fields to table lr_has_lectures.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '11', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('course_id', XMLDB_TYPE_INTEGER, '11', null, null, null, null);
        $table->add_field(
            'lecture_id',
            XMLDB_TYPE_INTEGER,
            '11',
            null,
            null,
            null,
            null
        );

        // Adding keys to table lr_has_lectures.
        $table->add_key('pk', XMLDB_KEY_PRIMARY, ['id']);
        $table->add_key('fk_course_id', XMLDB_KEY_FOREIGN, ['course_id'], 'course', ['id']);
        $table->add_key('fk_lecturer_id', XMLDB_KEY_FOREIGN, ['lecture_id'], 'lecture', ['id']);

        // Conditionally launch create table for lr_has_lectures.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }
        // Define table lr_course_attendance to be created.
        $table = new xmldb_table('lr_course_attendance');

        // Adding fields to table lr_course_attendance.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '11', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('course_id', XMLDB_TYPE_INTEGER, '11', null, null, null, null);
        $table->add_field(
            'student_id',
            XMLDB_TYPE_INTEGER,
            '11',
            null,
            null,
            null,
            null
        );

        // Adding keys to table lr_course_attendance.
        $table->add_key('pk', XMLDB_KEY_PRIMARY, ['id']);
        $table->add_key('fk_course_id', XMLDB_KEY_FOREIGN, ['course_id'], 'course', ['id']);
        $table->add_key(
            'fk_student_id',
            XMLDB_KEY_FOREIGN,
            ['student_id'],
            'student',
            ['id']
        );

        // Conditionally launch create table for lr_course_attendance.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }
        // Define table lr_subj_field_asgnmt to be created.
        $table = new xmldb_table('lr_subj_field_asgnmt');

        // Adding fields to table lr_subj_field_asgnmt.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '11', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('lr_subjects_id', XMLDB_TYPE_INTEGER, '11', null, null, null, null);

        // Adding keys to table lr_subj_field_asgnmt.
        $table->add_key('pk', XMLDB_KEY_PRIMARY, ['id']);
        $table->add_key('fk_lr_subjects_id', XMLDB_KEY_FOREIGN, ['lr_subjects_id'], 'subjects', ['id']);

        // Conditionally launch create table for lr_subj_field_asgnmt.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }



        // Lecrec savepoint reached.
        upgrade_plugin_savepoint(true, 2020062304, 'local', 'lecrec');
    }


    return true;
}
