<?php
// Googlecalendar extension, https://github.com/annaesvensson/yellow-googlecalendar

class YellowGooglecalendar {
    const VERSION = "0.8.14";
    public $yellow;         // access to API
    
    // Handle initialisation
    public function onLoad($yellow) {
        $this->yellow = $yellow;
        $this->yellow->system->setDefault("googlecalendarMode", "month");
        $this->yellow->system->setDefault("googlecalendarEntriesMax", "5");
        $this->yellow->system->setDefault("googlecalendarStyle", "flexible");
        $this->yellow->system->setDefault("googlecalendarApiKey", "AIzaSyBC0iK5aceH8C5EguUsS98btnsDoA1PVSo");
    }
    
    // Handle page content of shortcut
    public function onParseContentShortcut($page, $name, $text, $type) {
        $output = null;
        if ($name=="googlecalendar" && ($type=="block" || $type=="inline")) {
            list($id, $mode, $date, $style, $width, $height) = $this->yellow->toolbox->getTextArguments($text);
            list($timestamp, $entriesMax) = $this->getTimestampAndEntries($date);
            if (is_string_empty($mode)) $mode = $this->yellow->system->get("googlecalendarMode");
            if (is_string_empty($entriesMax)) $entriesMax = $this->yellow->system->get("googlecalendarEntriesMax");
            if (is_string_empty($style)) $style = $this->yellow->system->get("googlecalendarStyle");
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
            if ($mode=="week" || $mode=="month") {
                $output = "<div class=\"".htmlspecialchars($style)."\">";
                $output .= "<iframe src=\"https://calendar.google.com/calendar/embed?mode=".rawurlencode($mode)."&amp;dates=".rawurlencode($this->getCalendarDate($timestamp, false))."&amp;ctz=".rawurlencode($timeZone)."&amp;wkst=".rawurlencode($this->getCalendarStart($dateWeekdays, $dateWeekstart))."&amp;hl=".rawurlencode($language)."&amp;showTitle=0&amp;showNav=0&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;showTz=0&amp;showDate=1&amp;src=".rawurlencode($this->getCalendarSource($id))."\" frameborder=\"0\"";
                if ($width && $height) $output .= " width=\"".htmlspecialchars($width)."\" height=\"".htmlspecialchars($height)."\"";
                $output .= "></iframe></div>";
            }
            if ($mode=="events" || $mode=="agenda") {
                if ($style=="flexible") $style = "googlecalendar";
                $output = "<div class=\"".htmlspecialchars($style)."\" data-mode=\"".htmlspecialchars($mode)."\" data-timemin=\"".htmlspecialchars($this->getCalendarDate($timestamp))."\" data-timezone=\"".htmlspecialchars($timeZone)."\" data-timezoneOffset=\"".htmlspecialchars($timeZoneOffset)."\" data-datemonthsnominative=\"".htmlspecialchars($dateMonthsNominative)."\" data-datemonthsgenitive=\"".htmlspecialchars($dateMonthsGenitive)."\" data-dateweekdays=\"".htmlspecialchars($dateWeekdays)."\" data-dateformatshort=\"".htmlspecialchars($dateFormatShort)."\" data-dateformatmedium=\"".htmlspecialchars($dateFormatMedium)."\" data-dateformatlong=\"".htmlspecialchars($dateFormatLong)."\" data-timeformatshort=\"".htmlspecialchars($timeFormatShort)."\" data-timeformatmedium=\"".htmlspecialchars($timeFormatMedium)."\" data-timeformatLong=\"".htmlspecialchars($timeFormatLong)."\" data-entriesmax=\"".htmlspecialchars($entriesMax)."\" data-calendar=\"".htmlspecialchars($this->getCalendarSource($id))."\" data-apikey=\"".htmlspecialchars($apiKey)."\">";
                $output .= "</div>";
            }
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

    // Return calendar timestamp and entries
    public function getTimestampAndEntries($date) {
        if (preg_match("/^(.*?)#([0-9]+)$/", $date, $matches)) {
            $timestamp = is_string_empty($matches[1]) ? time() : strtotime($matches[1]);
            $entriesMax = intval($matches[2]);
        } else {
            if (intval($date)>999) {
                $timestamp = strtotime($date);
                $entriesMax = 0;
            } else {
                $timestamp = time();
                $entriesMax = intval($date);
            }
        }
        return array($timestamp, $entriesMax);
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
