<?php

require(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');
include('../tables/tableteachingpostings.php');




$PAGE->set_context(context_system::instance());
$PAGE->set_url('/local/lecrec/pages/teachingpostings.php');
//$PAGE->set_title('Lecturer Recruitment');
$PAGE->requires->css('/local/lecrec/assets/css/bewerber.css');
echo $OUTPUT->header();
echo $OUTPUT->heading('Lecturer Recruitment');
$context = context_system::instance();
$user = $USER->id;

if (has_capability('local/lecrec:manager', $context)) {
}

if (isguestuser()) {
}

echo '   <div class="container">
        <header>
            <nav>
                <a href="#">
                    <img src="images/dhbw.png" alt="dhbw logo" class="dhbw">
                </a>
            </nav>
        </header>
        <div class="main-content">
            <table class="table table-striped">
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
                    <tr>
                        <th scope="row">1</th>
                        <td>Mathematik 1</td>
                        <td>Am Beispiel ökonomischer Fragestellungen werden die folgenden Konzepte vermittelt: - Analysis: Funktionen, Eigenschaften von Funktionen, Differentialrechnung bei einer und bei mehreren Unbekannten (u.a. Grenzwert, Stetigkeit, Extremwertaufgaben,
                            Ableitungen), Integralrechnung - Lineare Algebra: Matrizenoperationen, Determinante, lineare Gleichungssysteme, Lösungsverfahren linearer Gleichungssysteme Entsprechend der Vorkenntnisse der Studierenden werden folgende Themen
                            aus der Finanzmathematik zusätzlich angeboten: Anwendung arithmetischer und geometrischer Folgen und Reihen, Zinseszinsrechnung, Kapitalwertmethoden, Tilgungsrechnung, Annuitätenrechnung, Rentenrechnung </td>
                        <td>Bachelor in MINT Fach</td>
                        <td>Semester 2021
                            <td>30 Stunden</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Programmierung 1</td>
                        <td>Prinzipien der Programmerstellung: Darstellung von Algorithmen, Erstellen von Quellcode, Programmierstil, Übersetzen, Programmausführung, Testen, Fehlersuche. Aufbau der Programmiersprache: Grundstruktur eines Programms, Variablen,
                            einfache Datentypen, Operatoren und Ausdrücke, Anweisungen, Ablaufsteuerung, Kontrollstrukturen, strukturierte Datentypen bzw. Referenzdatentypen (Felder und Klassen). Prozedurales und modulares Programmieren: Unterprogramme,
                            Funktionen, Methoden, Rekursion. Prinzipien der objektorientierten Programmierung: Kapselung, Klassen und Objekte, Klassenvariablen, Instanzvariablen, Klassenmethoden und Instanzmethoden, Zugriffsrechte, Vererbung, Unterklassen,
                            Polymorphie, Pakete, Zugriffsrechte, abstrakte Klassen, Interfaces, Exceptions und Ausnahmebehandlung. Klassenbibliotheken: API-Dokumentationen und ihre Nutzung.</td>
                        <td>Bachelor in MINT Fach</td>
                        <td>Semester 2021
                            <td>60 Stunden</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Programmierung 2</td>
                        <td>Fortgeschrittene objektorientierte Konzepte: Generische Interfaces und Klassen, Nutzung der Klassenbibliothek. Aufbau grafischer Oberflächen: Layout, typische Komponenten für grafische Benutzungsschnittstellen, Ereignisbehandlung.
                            Fortgeschrittene Programmiermethodik: Parallele Programmierung mit Threads, Synchronisations- und Kommunikationskonzepte, Einund Ausgabe über Streams</td>
                        <td>Bachelor in MINT Fach</td>
                        <td>Semester 2021
                            <td>30 Stunden</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Finanzbuchhaltung</td>
                        <td>Grundkonzeption des Rechnungswesens – Finanzbuchführung auf Basis der Grundsätze ordnungsmäßiger Buchführung – Bilanz als Grundlage der Buchführung – Finanzbuchführung als Grundlage für Bilanzierungsthemen – Arten der Bilanzveränderung
                            – Veränderungen des Eigenkapitalkontos – Organisation und Technik des Industriekontenrahmens – System der Umsatzsteuer – Buchungen im Sachanlagenbereich – Buchungen im Beschaffungs-, Produktions-, Absatz- und Personalbereich
                            – Besondere Buchungsfälle – Jahresabschlussbuchungen im Industriebetrieb – EDV-gestützte Buchhaltung </td>
                        <td>Bachelor in MINT Fach</td>
                        <td>Semester 2021
                            <td>30 Stunden</td>
                </tbody>
            </table>
            <div class="submit-button">
                <a href="bewerberformular.html">Jetzt bewerben</a>
            </div>
        </div>
    </div>';

echo '
    <div class=container></div>
    <header>

    </header>

    <div class="content">
        <header>
            <h1>Bewerberformular</h1>
            <!--<h2>Mathematische Grundlagen 1</h2>-->
        </header>
        <div class="border">
            <form>
                <div class="person">
                    <div class="border">
                        <h3>Zur Person</h3>
                        <div class="row">
                            <label for="vname"></label><input id="vname" name="vname" placeholder="Vorname"></label>
                            <label for="nname"><input id="nname" name="nname" placeholder="Nachname"></label>
                        </div>
                        <div class="row">
                            <label for="titel"><input id="titel" name="titel" placeholder="Titel"></label>
                        </div>
                        <div class="row">
                            <label for="birthdate"><input id="birthdate" name="birthdate"
                                    placeholder="Geburtsdatum"></label>
                            <label for="birthplace"><input id="birthplace" name="birthplace"
                                    placeholder="Geburtsort"></label>
                        </div>
                        <div class="row">
                            <label for="job"><input id="job" name="job" placeholder="Beruf"></label>
                        </div>
                    </div>
                </div>
                <div class="address-info">
                    <div class="border">
                        <h3>Adresse privat</h3>
                        <div class="row">
                            <label for="street"><input id="street" name="street" placeholder="Straße"></label>
                        </div>
                        <div class="row">
                            <label for="postal-city"><input id="postal-city" name="postal-city"
                                    placeholder="PLZ, Ort"></label>
                        </div>
                        <div class="row">
                            <label for="state"><input id="state" name="state" placeholder="Bundesland"></label>
                        </div>
                        <div class="row">
                            <label for="phone"><input id="phone" name="phone" placeholder="Telefon"></label>
                            <label for="fax"><input id="fax" name="fax" placeholder="Fax"></label>
                        </div>
                        <div class="row">
                            <label for="mphone"> <input id="mphone" name="mphone" placeholder="Mobil"></label>
                        </div>
                        <div class="row">
                            <label for="email"> <input id="email" name="email" placeholder="E-Mail"></label>
                        </div>
                    </div>
                    <div class="border">
                        <h3>Adresse dienstlich</h3>
                        <div class="row">
                            <label for="company"><input id="company" name="company" placeholder="Firma"></label>
                        </div>
                        <div class="row">
                            <label for="street"><input id="street" name="street" placeholder="Straße"></label>
                        </div>
                        <div class="row">
                            <label for="postal-city"><input id="postal-city" name="postal-city"
                                    placeholder="PLZ, Ort"></label>
                        </div>
                        <div class="row">
                            <label for="state"><input id="state" name="state" placeholder="Bundesland"></label>
                        </div>
                        <div class="row">
                            <label for="phone"><input id="phone" name="phone" placeholder="Telefon"></label>
                            <label for="fax"><input id="fax" name="fax" placeholder="Fax"></label>
                        </div>
                        <div class="row">
                            <label for="email"> <input id="email" name="email" placeholder="E-Mail"></label>
                        </div>
                    </div>
                </div>


            </form>
            <form>
                <div class="border">
                    <div class="headline">
                        <h3>Ausbildung / Studium</h3>
                        <div class="bigbox">
                            <textarea class="form-control" aria-label="education"></textarea>
                        </div>

                        <!--<div class="bigbox">
                <input id="education" name="education"></label>
            </div>-->
                    </div>
                    <div class="headline">
                        <h3>Bisherige Lehrtätigkeiten</h3>
                        <div class="bigbox">
                            <textarea class="form-control" aria-label="previous-lectureships"></textarea>
                        </div>
                    </div>
                    <div class="headline">
                        <h3>Berufliche Tätigkeiten</h3>
                        <div class="bigbox">
                            <textarea class="form-control" aria-label="work-activities"></textarea>
                        </div>
                    </div>
                    <div class="headline">
                        <h3>Lehrgebiete an denen ich interessiert bin</h3>
                        <div class="bigbox">
                            <textarea class="form-control" aria-label="interesting-lectureships"></textarea>
                        </div>
                    </div>
                </div>
            </form>

            <p>Ich erkläre mich damit einverstanden, dass meine personenbezogenen Daten (siehe oben) in das Intranet der Dualen Hochschule Mannheim gestellt werden. Dies ist für Sie ein freiwilliger Service der Dualen Hochschule Mannheim. Sie haben das Recht,
                Auskunft über Ihre gespeicherten personenbezogene Daten zu erhalten und diese ge¬gebenenfalls berichtigen zu lassen. In diesem Fall wenden Sie sich bitte an den Datenschutz¬beauftragten der Dualen Hochschule Mannheim.
            </p>


            <div class="date-signature">

                <form class="form-inline">
                    <input class="form-control mr-sm-2" type="search" placeholder="Datum" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Absenden</button>
                </form>
            </div>

        </div>
    </div>';
