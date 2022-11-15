<?php
// Googlecalendar extension, https://github.com/annaesvensson/yellow-googlecalendar

class YellowGooglecalendar {
    const VERSION = "0.8.15";
    public $yellow;         // access to API
    
    // Handle initialisation
    public function onLoad($yellow) {
        $this->yellow = $yellow;
        $this->yellow->system->setDefault("googlecalendarStyle", "flexible");
        $this->yellow->system->setDefault("googlecalendarApiKey", "AIzaSyBC0iK5aceH8C5EguUsS98btnsDoA1PVSo");
        $this->yellow->system->setDefault("googlecalendarEntriesMax", "5");
    }
    
    // Handle page content of shortcut
    public function onParseContentShortcut($page, $name, $text, $type) {
        $output = null;
        if (($name=="googlecalendarweek" || $name=="googlecalendarmonth") && ($type=="block" || $type=="inline")) {
            list($id, $theme, $style, $width, $height) = $this->yellow->toolbox->getTextArguments($text);
            if (is_string_empty($style)) $style = $this->yellow->system->get("googlecalendarStyle");
            $timestamp = time();
            $mode = $name=="googlecalendarweek" ? "week" : "month";
            $language = $page->get("language");
            $timeZone = $this->yellow->system->get("coreTimezone");
            $dateWeekdays = $this->yellow->language->getText("coreDateWeekdays", $language);
            $dateWeekstart = $this->yellow->language->getText("coreDateWeekstart", $language);
            $apiKey = $this->yellow->system->get("googlecalendarApiKey");
            $output = "<div class=\"".htmlspecialchars($style)."\">";
            $output .= "<iframe src=\"https://calendar.google.com/calendar/embed?mode=".rawurlencode($mode)."&amp;dates=".rawurlencode($this->getCalendarDate($timestamp, false))."&amp;ctz=".rawurlencode($timeZone)."&amp;wkst=".rawurlencode($this->getCalendarStart($dateWeekdays, $dateWeekstart))."&amp;hl=".rawurlencode($language)."&amp;showTitle=0&amp;showNav=1&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;showTz=0&amp;showDate=1&amp;src=".rawurlencode($this->getCalendarSource($id))."\" frameborder=\"0\"";
            if ($width && $height) $output .= " width=\"".htmlspecialchars($width)."\" height=\"".htmlspecialchars($height)."\"";
            $output .= "></iframe></div>";
        }
        if ($name=="googlecalendarevents" && ($type=="block" || $type=="inline")) {
            list($id, $date, $entriesMax) = $this->yellow->toolbox->getTextArguments($text);
            if (is_string_empty($entriesMax)) $entriesMax = $this->yellow->system->get("googlecalendarEntriesMax");
            $timestamp = is_string_empty($date) ? time() : strtotime($date);
            $language = $page->get("language");
            $timeZone = $this->yellow->system->get("coreTimezone");
            $timeZoneHelper = new DateTime("now", new DateTimeZone($timeZone));
            $timeZoneOffset = $timeZoneHelper->getOffset();
            $dateMonthsNominative = $this->yellow->language->getText("coreDateMonthsNominative", $language);
            $dateMonthsGenitive = $this->yellow->language->getText("coreDateMonthsGenitive", $language);
            $dateWeekdays = $this->yellow->language->getText("coreDateWeekdays", $language);
            $dateWeekstart = $this->yellow->language->getText("coreDateWeekstart", $language);
            $dateFormatShort = $this->yellow->language->getText("coreDateFormatShort", $language);
            $dateFormatMedium = $this->yellow->language->getText("coreDateFormatMedium", $language);
            $dateFormatLong = $this->yellow->language->getText("coreDateFormatLong", $language);
            $timeFormatShort = $this->yellow->language->getText("coreTimeFormatShort", $language);
            $timeFormatMedium = $this->yellow->language->getText("coreTimeFormatMedium", $language);
            $timeFormatLong = $this->yellow->language->getText("coreTimeFormatLong", $language);
            $apiKey = $this->yellow->system->get("googlecalendarApiKey");
            $output = "<div class=\"googlecalendar\" data-mode=\"events\" data-timemin=\"".htmlspecialchars($this->getCalendarDate($timestamp))."\" data-timezone=\"".htmlspecialchars($timeZone)."\" data-timezoneOffset=\"".htmlspecialchars($timeZoneOffset)."\" data-datemonthsnominative=\"".htmlspecialchars($dateMonthsNominative)."\" data-datemonthsgenitive=\"".htmlspecialchars($dateMonthsGenitive)."\" data-dateweekdays=\"".htmlspecialchars($dateWeekdays)."\" data-dateformatshort=\"".htmlspecialchars($dateFormatShort)."\" data-dateformatmedium=\"".htmlspecialchars($dateFormatMedium)."\" data-dateformatlong=\"".htmlspecialchars($dateFormatLong)."\" data-timeformatshort=\"".htmlspecialchars($timeFormatShort)."\" data-timeformatmedium=\"".htmlspecialchars($timeFormatMedium)."\" data-timeformatLong=\"".htmlspecialchars($timeFormatLong)."\" data-entriesmax=\"".htmlspecialchars($entriesMax)."\" data-calendar=\"".htmlspecialchars($this->getCalendarSource($id))."\" data-apikey=\"".htmlspecialchars($apiKey)."\">";
            $output .= "</div>";
        }
        return $output;
    }
    
    // Handle page extra data
    public function onParsePageExtra($page, $name) {
        $output = null;
        if ($name=="header") {
            $extensionLocation = $this->yellow->system->get("coreServerBase").$this->yellow->system->get("coreExtensionLocation");
            $output = "<link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"{$extensionLocation}googlecalendar.css\" />\n";
            $output .= "<script type=\"text/javascript\" defer=\"defer\" src=\"{$extensionLocation}googlecalendar.js\"></script>\n";
        }
        return $output;
    }

    // Return calendar source
    public function getCalendarSource($src) {
        if (strposu($src, "@")===false) $src .= "@group.v.calendar.google.com";
        return $src;
    }
    
    // Return calendar date
    public function getCalendarDate($timestamp, $isoFormat = true) {
        return date($isoFormat ? "c" : "Ymd/Ymd", $timestamp);
    }

    // Return calendar start
    public function getCalendarStart($weekdays, $weekstart) {
        $index = array_search($weekstart, preg_split("/\s*,\s*/", $weekdays));
        return 1+(($index+1)%7);
    }
}
