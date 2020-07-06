<?php

require(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');
include('../tables/tableteachingpostings.php');



$PAGE->set_title('Lecturer Recruitment');
$PAGE->set_context(context_system::instance());
$PAGE->set_url('/local/lecrec/pages/teachingpostings.php');
//$PAGE->set_title('Lecturer Recruitment');
$PAGE->requires->css('/local/lecrec/assets/css/bewerber.css');
echo $OUTPUT->header();
echo $OUTPUT->heading('DHBW Mannheim Postings');
$PAGE->requires->jquery();
$context = context_system::instance();
$user = $USER->id;
echo '</br>';
if (has_capability('local/lecrec:manager', $context)) {
}

if (isguestuser()) {
}

echo '   <div class="container">
        <header>

        </header>
        <div class="main-content">
            <table id="my-table" class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Vorlesung</th>
                        <th scope="col">Beschreibung</th>
                        <th scope="col">Qualifikation</th>
                        <th scope="col">Bedarf</th>
                        <th scope="col">Stunden pro Semester</th>
                    </tr>
                </thead>
                <tbody>
                    <tr >
                        <th scope="row">1</th>
                        <td record="">Mathematik 1</td>
                        <td>Am Beispiel ökonomischer Fragestellungen werden die folgenden Konzepte vermittelt: - Analysis: Funktionen, Eigenschaften von Funktionen, Differentialrechnung bei einer und bei mehreren Unbekannten (u.a. Grenzwert, Stetigkeit, Extremwertaufgaben,
                            Ableitungen), Integralrechnung - Lineare Algebra: Matrizenoperationen, Determinante, lineare Gleichungssysteme, Lösungsverfahren linearer Gleichungssysteme Entsprechend der Vorkenntnisse der Studierenden werden folgende Themen
                            aus der Finanzmathematik zusätzlich angeboten: Anwendung arithmetischer und geometrischer Folgen und Reihen, Zinseszinsrechnung, Kapitalwertmethoden, Tilgungsrechnung, Annuitätenrechnung, Rentenrechnung </td>
                        <td>Bachelor in MINT Fach</td>
                        <td>Semester 2021
                            <td>30 Stunden</td>
                    </tr>
                    <tr >
                        <th scope="row">2</th>
                        <td record="">Programmierung 1</td>
                        <td>Prinzipien der Programmerstellung: Darstellung von Algorithmen, Erstellen von Quellcode, Programmierstil, Übersetzen, Programmausführung, Testen, Fehlersuche. Aufbau der Programmiersprache: Grundstruktur eines Programms, Variablen,
                            einfache Datentypen, Operatoren und Ausdrücke, Anweisungen, Ablaufsteuerung, Kontrollstrukturen, strukturierte Datentypen bzw. Referenzdatentypen (Felder und Klassen). Prozedurales und modulares Programmieren: Unterprogramme,
                            Funktionen, Methoden, Rekursion. Prinzipien der objektorientierten Programmierung: Kapselung, Klassen und Objekte, Klassenvariablen, Instanzvariablen, Klassenmethoden und Instanzmethoden, Zugriffsrechte, Vererbung, Unterklassen,
                            Polymorphie, Pakete, Zugriffsrechte, abstrakte Klassen, Interfaces, Exceptions und Ausnahmebehandlung. Klassenbibliotheken: API-Dokumentationen und ihre Nutzung.</td>
                        <td>Bachelor in MINT Fach</td>
                        <td>Semester 2021
                            <td>60 Stunden</td>
                    </tr>
                    <tr >
                        <th scope="row">3</th>
                        <td record="">Programmierung 2</td>
                        <td>Fortgeschrittene objektorientierte Konzepte: Generische Interfaces und Klassen, Nutzung der Klassenbibliothek. Aufbau grafischer Oberflächen: Layout, typische Komponenten für grafische Benutzungsschnittstellen, Ereignisbehandlung.
                            Fortgeschrittene Programmiermethodik: Parallele Programmierung mit Threads, Synchronisations- und Kommunikationskonzepte, Einund Ausgabe über Streams</td>
                        <td>Bachelor in MINT Fach</td>
                        <td>Semester 2021
                            <td>30 Stunden</td>
                    </tr >
                    <tr >
                        <th scope="row">3</th>
                        <td record="">Finanzbuchhaltung</td>
                        <td>Grundkonzeption des Rechnungswesens – Finanzbuchführung auf Basis der Grundsätze ordnungsmäßiger Buchführung – Bilanz als Grundlage der Buchführung – Finanzbuchführung als Grundlage für Bilanzierungsthemen – Arten der Bilanzveränderung
                            – Veränderungen des Eigenkapitalkontos – Organisation und Technik des Industriekontenrahmens – System der Umsatzsteuer – Buchungen im Sachanlagenbereich – Buchungen im Beschaffungs-, Produktions-, Absatz- und Personalbereich
                            – Besondere Buchungsfälle – Jahresabschlussbuchungen im Industriebetrieb – EDV-gestützte Buchhaltung </td>
                        <td>Bachelor in MINT Fach</td>
                        <td>Semester 2021
                            <td>30 Stunden</td>
                </tbody>
            </table>

        </div>
    </div>';

?>

<script src="../assets/js/jquery-3.5.1.min.js"></script>
<script>
    $(function() {
        $('#my-table tr td').each(function() {
            $(this).css('cursor', 'pointer').hover(
                function() {
                    $(this).addClass('active');
                },
                function() {


                    $(this).removeClass('active');
                }).click(function() {
                var ID = $(this).parent().find('td[record]').html();
                redirectUrl = 'postings.php';
                var form = $('<form action="' + redirectUrl + '" method="post">' +

                    '<input type="hidden" name="ID" value="' + ID + '"></input>' + '</form>');
                $('body').append(form);
                $(form).submit();

            });


        });
    });
</script>