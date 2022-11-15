<p align="right"><a href="README-de.md">Deutsch</a> &nbsp; <a href="README.md">English</a> &nbsp; <a href="README-sv.md">Svenska</a></p>

# Googlecalendar 0.8.15

Google-Kalender einbinden.

<p align="center"><img src="googlecalendar-screenshot.png?raw=true" alt="Bildschirmfoto"></p>

## Wie man einen Wochenkalender einbindet

Erstelle eine `[googlecalendarweek]`-Abkürzung um eine Woche anzuzeigen.

Die folgenden Argumente sind verfügbar, alle bis auf das erste Argument sind optional:

`Id` = öffentlicher [Google-Kalender](https://calendar.google.com/)  
`Theme` = Kalendertheme, momentan nur `light`  
`Style` = Kalenderstil, z.B. `left`, `center`, `right`  
`Width` = Kalenderbreite, Pixel oder Prozent  
`Height` = Kalenderhöhe, Pixel oder Prozent  

## Wie man einen Montatskalender einbindet

Erstelle eine `[googlecalendarweek]`-Abkürzung um einen Monat anzuzeigen.

Die folgenden Argumente sind verfügbar, alle bis auf das erste Argument sind optional:

`Id` = öffentlicher [Google-Kalender](https://calendar.google.com/)  
`Theme` = Kalendertheme, momentan nur `light`  
`Style` = Kalenderstil, z.B. `left`, `center`, `right`  
`Width` = Kalenderbreite, Pixel oder Prozent  
`Height` = Kalenderhöhe, Pixel oder Prozent  

## Wie man einen Veranstaltungskalender einbindet

Erstelle eine `[googlecalendarevents]`-Abkürzung um eine Liste anzuzeigen.

Die folgenden Argumente sind verfügbar, alle bis auf das erste Argument sind optional:

`Id` = öffentlicher [Google-Kalender](https://calendar.google.com/)  
`Date` = Startdatum, JJJJ-MM-TT Format  
`EntriesMax` = Anzahl der Einträge pro Veranstaltungskalender, 0 für unbegrenzt  

## Beispiele

Wochenkalender einbinden, unterschiedliche Kalender:

    [googlecalendarweek en.uk#holiday]
    [googlecalendarweek de.german#holiday]
    [googlecalendarweek sv.swedish#holiday]

Wochenkalender einbinden, unterschiedliche Größen:

    [googlecalendarweek sv.swedish#holiday light right 50%]
    [googlecalendarweek sv.swedish#holiday light right 240 240]
    [googlecalendarweek sv.swedish#holiday light right 480 480]

Monatskalender einbinden, unterschiedliche Kalender:

    [googlecalendarmonth en.uk#holiday]
    [googlecalendarmonth de.german#holiday]
    [googlecalendarmonth sv.swedish#holiday]

Monatskalender einbinden, unterschiedliche Größen:

    [googlecalendarmonth sv.swedish#holiday light right 50%]
    [googlecalendarmonth sv.swedish#holiday light right 240 240]
    [googlecalendarmonth sv.swedish#holiday light right 480 480]

Veranstaltungskalender einbinden, unterschiedliche Kalender:

    [googlecalendarevents en.uk#holiday]
    [googlecalendarevents de.german#holiday]
    [googlecalendarevents sv.swedish#holiday]

Veranstaltungskalender einbinden, unterschiedliche Startdaten und Anzahl Einträge:

    [googlecalendarevents sv.swedish#holiday 2022-06-01 5]
    [googlecalendarevents sv.swedish#holiday 2022-09-01 10]
    [googlecalendarevents sv.swedish#holiday 2022-12-01 15]

## Einstellungen

Die folgenden Einstellungen können in der Datei `system/extensions/yellow-system.ini` vorgenommen werden:

`GooglecalendarStyle` = Kalenderstil, z.B. `flexible`  
`GooglecalendarApiKey` = dein Google-API-Schlüssel  
`GooglecalendarEntriesMax` = Anzahl der Einträge pro Veranstaltungskalender  

## Installation

[Erweiterung herunterladen](https://github.com/annaesvensson/yellow-googlecalendar/archive/main.zip) und die ZIP-Datei in dein `system/extensions`-Verzeichnis kopieren. [Weitere Informationen zu Erweiterungen](https://github.com/annaesvensson/yellow-update/tree/main/README-de.md).

Diese Erweiterung verwendet [Google-Kalender](https://calendar.google.com/). Der Dienstanbieter sammelt personenbezogene Daten und benutzt Cookies.

## Entwickler

Anna Svensson. [Hilfe finden](https://datenstrom.se/de/yellow/help/).
