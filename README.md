<p align="right"><a href="README-de.md">Deutsch</a> &nbsp; <a href="README.md">English</a> &nbsp; <a href="README-sv.md">Svenska</a></p>

# Googlecalendar 0.8.15

Embed Google calendar.

<p align="center"><img src="googlecalendar-screenshot.png?raw=true" alt="Screenshot"></p>

## How to embed a weekly calendar

Create a `[googlecalendarweek]` shortcut to show a week.

The following arguments are available, all but the first argument are optional:

`Id` = public [Google calendar](https://calendar.google.com/)  
`Theme` = calendar theme, currently `light` only  
`Style` = calendar style, e.g. `left`, `center`, `right`  
`Width` = calendar width, pixel or percent  
`Height` = calendar height, pixel or percent  

You should know that the service provider collects personal data and uses cookies.

## How to embed a monthly calendar

Create a `[googlecalendarmonth]` shortcut to show a month.

The following arguments are available, all but the first argument are optional:

`Id` = public [Google calendar](https://calendar.google.com/)  
`Theme` = calendar theme, currently `light` only  
`Style` = calendar style, e.g. `left`, `center`, `right`  
`Width` = calendar width, pixel or percent  
`Height` = calendar height, pixel or percent  

You should know that the service provider collects personal data and uses cookies.

## How to embed an events calendar

Create a `[googlecalendarevents]` shortcut to show a list.

The following arguments are available, all but the first argument are optional:

`Id` = public [Google calendar](https://calendar.google.com/)  
`Date` = start date, YYYY-MM-DD format  
`EntriesMax` = number of entries to show per events calendar, 0 for unlimited  

You should know that the service provider collects personal data and uses cookies.

## Examples

Embedding a weekly calendar, different calendars:

    [googlecalendarweek en.uk#holiday]
    [googlecalendarweek de.german#holiday]
    [googlecalendarweek sv.swedish#holiday]

Embedding a weekly calendar, different sizes:

    [googlecalendarweek sv.swedish#holiday light right 50%]
    [googlecalendarweek sv.swedish#holiday light right 240 240]
    [googlecalendarweek sv.swedish#holiday light right 480 480]

Embedding a monthly calendar, different calendars:

    [googlecalendarmonth en.uk#holiday]
    [googlecalendarmonth de.german#holiday]
    [googlecalendarmonth sv.swedish#holiday]

Embedding a monthly calendar, different sizes:

    [googlecalendarmonth sv.swedish#holiday light right 50%]
    [googlecalendarmonth sv.swedish#holiday light right 240 240]
    [googlecalendarmonth sv.swedish#holiday light right 480 480]

Embedding an events calendar, different calendars:

    [googlecalendarevents en.uk#holiday]
    [googlecalendarevents de.german#holiday]
    [googlecalendarevents sv.swedish#holiday]

Embedding an events calendar, different start dates and numbers of entries:

    [googlecalendarevents sv.swedish#holiday 2022-06-01 5]
    [googlecalendarevents sv.swedish#holiday 2022-09-01 10]
    [googlecalendarevents sv.swedish#holiday 2022-12-01 15]

## Settings

The following settings can be configured in file `system/extensions/yellow-system.ini`:

`GooglecalendarStyle` = calendar style, e.g. `flexible`  
`GooglecalendarApiKey` = your Google API key  
`GooglecalendarEntriesMax` = number of entries to show per events calendar  

## Acknowledgements

This extension uses [Google calendar](https://calendar.google.com/). Thank you for the free service.

## Installation

[Download extension](https://github.com/annaesvensson/yellow-googlecalendar/archive/main.zip) and copy ZIP file into your `system/extensions` folder. [Learn more about extensions](https://github.com/annaesvensson/yellow-update).

## Developer

Anna Svensson. [Get help](https://datenstrom.se/yellow/help/).
