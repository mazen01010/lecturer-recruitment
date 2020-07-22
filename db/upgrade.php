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

    if ($oldversion < 2020062308) {

        $DB->delete_records('lr_subjects');
        $DB->delete_records('lr_module');

        $DB->insert_record('lr_module', array(
            'module_identifier' => 'BWL',
            'module_name' => 'Grundlagen der BWL'
        ));

        $DB->insert_record('lr_module', array(
            'module_identifier' => 'Rechnungslegung',
            'module_name' => 'Grundlagen der Rechnungslegung'
        ));

        $DB->insert_record('lr_subjects', array(
            'lr_subject_name' => 'Einführung in die BWL',
            'lr_description' => 'Gegenstand und Grundlagen der Betriebswirtschaftslehre - Unternehmerische Zielbildung - Planungs- und Entscheidungspro-zess im Unternehmen - Konstitutive Entscheidungen im Unternehmen - Funktionsbereiche des Unternehmens - Weitere An-sätze betriebswirtschaftlicher Aufgabenbereiche.',
            'lr_teaching_hours' => '36',
            'lr_module_id' => '1'
        ));

        $DB->insert_record('lr_subjects', array(
            'lr_subject_name' => 'Determinanten des Consulting',
            'lr_description' => 'Aufgaben eines Consultant – Schlüsselqualifikationen – Interner Consultant vs. Externer Consultant – Leistungsfelder – Grundlagen strategisches und operatives Beratungsmarketing – Kontaktphase – Akquisitionsphase – Angebotsphase – Ver-tragsgestaltung',
            'lr_teaching_hours' => '12',
            'lr_module_id' => '1'
        ));

        $DB->insert_record('lr_subjects', array(
            'lr_subject_name' => 'Marketing',
            'lr_description' => 'Begriffliche und konzeptionelle Grundlagen - verhaltenswissenschaftliche Grundlagen - Marketing-Mix - Produktpolitik - Preis- und Konditionenpolitik - Distributionspolitik - Kommunikationspolitik - Marktforschung - aktuelle Problemstellungen und neuere Entwicklungen',
            'lr_teaching_hours' => '24',
            'lr_module_id' => '1'
        ));

        $DB->insert_record('lr_subjects', array(
            'lr_subject_name' => 'Kundenverhalten',
            'lr_description' => 'Überblicksveranstaltung: Modell und Einflussfaktoren des Konsumentenverhaltens, Kaufentscheidungsprozess, Konsumen-tenverhalten im internationalen Kontext, Methodik und Didaktik im Umgang mit Kunden: Selbstkompetenz und Sozialkompe-tenz; Kommunikation und deren Modelle',
            'lr_teaching_hours' => '12',
            'lr_module_id' => '1'
        ));

        $DB->insert_record('lr_subjects', array(
            'lr_subject_name' => 'Finanzbuchhaltung',
            'lr_description' => 'Grundkonzeption des Rechnungswesens – Bilanz als Grundlage der Buchführung – Veränderungen des Eigenkapitalkontos – Organisation und Technik des Industriekontenrahmens – Buchungen im Beschaffungs-, Produktions- und Absatzbereich – System der Umsatzsteuer – Buchungen im Sachanlagenbereich – Buchungen im Personalbereich – Besondere Buchungsfälle – Abschluss im Industriebetrieb – EDV-gestützte Buchhaltung',
            'lr_teaching_hours' => '36',
            'lr_module_id' => '2'
        ));

        $DB->insert_record('lr_subjects', array(
            'lr_subject_name' => 'Kosten- und Leistungsrechnung',
            'lr_description' => 'Grundlagen der Kostenrechnung – Kostenartenrechnung – Kostenstellenrechnung – Kostenträgerrechnung –Vollkostenrechnung/Kritik – Grundlagen der Teilkosten-/Deckungsbeitragsrechnung',
            'lr_teaching_hours' => '36',
            'lr_module_id' => '2'
        ));

        $DB->insert_record('lr_subjects', array(
            'lr_subject_name' => '',
            'lr_description' => '',
            'lr_teaching_hours' => '',
            'lr_module_id' => ''
        ));

        upgrade_plugin_savepoint(true, 2020062308, 'local', 'lecrec');
    }


    return true;
}
