<?php


use App\Services\PrayerTimeService;
use App\Services\TimeApiService;
use Carbon\Carbon;
//use DateTime;
//use DateTimeZone;


if (! function_exists('convertGmtStringToDateTime')) {


    /**
     * @throws DateInvalidTimeZoneException
     * @throws DateMalformedStringException
     */
    function convertGmtStringToDateTime($gmtString)
    {
        // Remove 'GMT' from the string and trim spaces
        $gmtString = trim(str_replace('GMT', '', $gmtString));

        // Check the sign
        $sign = $gmtString[0] === '-' ? '-' : '+';

        // Remove sign for further processing
        $offsetWithoutSign = ltrim($gmtString, '+');

        // Split into hours and minutes based on the presence of a decimal
        if (strpos($offsetWithoutSign, '.') !== false) {
            list($hours, $minutes) = explode('.', $offsetWithoutSign);
            $minutes = intval($minutes * 6); // Convert .5 hours to 30 minutes
        } else {
            $hours = $offsetWithoutSign;
            $minutes = 0; // No decimal means 0 minutes
        }

        // Format the timezone string for DateTimeZone
        $timeZoneString = sprintf('%s%02d:%02d', $sign, abs($hours), abs($minutes));

        // Create a DateTime object for the current time in UTC
        $dateTime = new DateTime('now', new DateTimeZone('UTC'));

        // Set the timezone to the calculated offset
        $dateTime->setTimezone(new DateTimeZone($timeZoneString));

        // Format the date to 'WED 7 AUG 2024'
        $formattedDate = $dateTime->format('D j M Y');

        return [
            'hours' => $hours,
            'date' => $dateTime->format('Y-m-d'),
            'time' => $dateTime->format('g:i A'),
            'timeWithout' => $dateTime->format('g:i'),
            'time2' => $dateTime->format('g:i'),
            'currentTimewithoutID' => $dateTime->format('g:i:s'),
            'identy' => $dateTime->format('A'),
            'identify' => $dateTime->format('A'),
            'formatted_date' => $formattedDate,
            'currentTimeWithSecond' => $dateTime->format('g:i:s'),
            'currentTimeWithSecond24' => $dateTime->format('G:i:s'),
            'day_of_week' => $dateTime->format('l'),
        ];
    }
}
if (! function_exists('generateAbbreviationsLinks')) {


    function generateAbbreviationsLinks($abbreviations): string
    {
        if (count($abbreviations) > 0) {
            $html = '<h3 class="mb-4 justify-content-center text-center fw-bold wow animate__animated animate__fadeInUp">';
            $html .= '(';

            foreach ($abbreviations as $index => $abb) {
                $html .= '<a href="' . url($abb->slug) . '">' . $abb->name . '</a>';

                // Add a hyphen if it's not the last item
                if ($index < count($abbreviations) - 1) {
                    $html .= ' - ';
                }
            }

            $html .= ')';
            $html .= '</h3>';

            return $html;
        }

        return '';
    }
}

if (! function_exists('formatGmtOffset')) {


    function formatGmtOffset($offset)
    {
        // Remove 'GMT' from the string and trim spaces
        $offset = trim(str_replace('GMT', '', $offset));

        // Replace the '+' with a space
        $offset = str_replace('+', '0', $offset);

        // Return the formatted offset
        return 'GMT ' . $offset;
    }
}

if (! function_exists('timeApiService')) {

    function timeApiService($latitude, $longitude)
    {
        $data               = [];
        $timeApiService     = new TimeApiService(); // Initialize the service
        $timeData           = $timeApiService->getTimeLatAndLon($latitude, $longitude);

        if ($timeData) {

            // Convert the 24-hour format time (e.g., "17:45") to 12-hour format with AM/PM
            $dateTime               = DateTime::createFromFormat('H:i', $timeData['time']);
            $data['time']   = $dateTime ? $dateTime->format('g:i A') : 'Invalid Time';  // e.g., "5:45 PM"
            $data['time_second']   = $dateTime ? $dateTime->format('g:i:s A') : 'Invalid Time';  // e.g., "5:45:00 PM"
            $data['day']   = $dateTime ? $dateTime->format('D') : 'Invalid Time';  // THU"

            $data['date']           = $timeData['date'];               // e.g., "10/03/2024"
            $data['day_of_week']    = $timeData['dayOfWeek'];     // e.g., "Thursday"
            $data['time_Zone']      = $timeData['timeZone'];       // e.g., "Africa/Cairo"

            // Get the GMT offset for the specified time zone
            $timezone               = new DateTimeZone($timeData['timeZone']);
            $dateTimeWithZone       = new DateTime('now', $timezone);
            $gmtOffset              = $timezone->getOffset($dateTimeWithZone) / 3600; // Convert seconds to hours
            $data['gmt_offset']     = 'GMT' . ($gmtOffset >= 0 ? '+' : '') . $gmtOffset; // e.g., "GMT+2" or "GMT-5"
            $data['gmt']            = ($gmtOffset >= 0 ? '+' : '') . $gmtOffset; // e.g., "+3" or "-3"
        }

        return $data;
    }
}


if (! function_exists('getGmtOffset')) {

    function getGmtOffset($timezone)
    {

        $dateTime = new \DateTime('now', new \DateTimeZone($timezone));
        $offsetInSeconds = $dateTime->getOffset();

        // Convert the offset from seconds to hours
        $offsetInHours = $offsetInSeconds / 3600;


        return ($offsetInHours > 0) ? 'GMT +' . $offsetInHours : 'GMT ' . $offsetInHours;
    }
}


if (! function_exists('dateLocalTime')) {

    function dateLocalTime($longitude)
    {

        $utcTimestamp = time();

        // Calculate GMT offset based on longitude
        $gmtOffset = round($longitude / 15);  // Each 15° longitude is roughly a 1-hour offset
        $offsetSeconds = $gmtOffset * 3600;

        // Calculate the local timestamp by applying the offset
        $localTimestamp = $utcTimestamp + $offsetSeconds;


        //        $data['time_Zone']      = $timeData['timeZone'];       // e.g., "Africa/Cairo"




        // Format each required value without DateTime functions
        $data = [
            'time'                  => gmdate("g:i A", $localTimestamp),              // e.g., "5:45 PM"
            'hours'                  => gmdate("G", $localTimestamp),                 // e.g., "23"
            'identify'              => gmdate("A", $localTimestamp),                  // e.g., PM"
            'dateFormat'            => gmdate("j M Y", $localTimestamp),              // e.g., "7 AUG 2024"
            'timeWithout'           => gmdate("g:i", $localTimestamp),                // e.g., "5:45 PM"
            'time_second'           => gmdate("g:i:s A", $localTimestamp),            // e.g., "5:45:00 PM"
            'currentTimeWithSecond' => gmdate("g:i:s", $localTimestamp),              // e.g., "5:45:00"
            'currentTimeWithSecond24' => gmdate("G:i:s", $localTimestamp),              // e.g., "23:45:00"
            'day'                   => strtoupper(gmdate("D", $localTimestamp)),      // e.g., "THU"
            'date'                  => gmdate("m/d/Y", $localTimestamp),              // e.g., "10/03/2024"
            'date_JNY'              => gmdate("j/n/Y", $localTimestamp),              // e.g., "7/10/2024"
            'day_of_week'           => gmdate("l", $localTimestamp),                  // e.g., "Thursday"
            'time_Zone'             => 'GMT' . ($gmtOffset >= 0 ? '+' : '') . $gmtOffset,    // e.g., "GMT+2" or "GMT-5"
            'gmt_offset'            => 'GMT' . ($gmtOffset >= 0 ? '+' : '') . $gmtOffset,    // e.g., "GMT+2" or "GMT-5"
            'gmt'                   => ($gmtOffset >= 0 ? '+' : '') . $gmtOffset             // e.g., "+3" or "-3"
        ];


        return $data;
    }
}
if (! function_exists('payer')) {

    function payer($date, $city, $country)
    {

        $timeApiService = new PrayerTimeService(); // Initialize the service
        $timeData = $timeApiService->getPrayerTimings($date,  $city, $country);
        if ($timeData != null) {

            $data = $timeData['data']['timings'];

            $convertedTimings = [];

            foreach ($data as $prayer => $time) {
                $convertedTimings[$prayer] = convertTo12HourFormat($time);
            }
            $data =  $convertedTimings;

            $_SESSION['sunrise'] =  $convertedTimings['Sunrise'];
            $_SESSION['sunset'] = $convertedTimings['Sunset'];
        } else {
            $data  = [];
        }

        return $data;
    }
}

if (! function_exists('convertTo12HourFormat')) {

    function convertTo12HourFormat($time): string
    {
        $dateTime = DateTime::createFromFormat('H:i', $time);
        return $dateTime ? $dateTime->format('g:i A') : 'Invalid Time'; // e.g., "4:03 PM"
    }
}

if (! function_exists('countryDate')) {
    function countryDate($time, $countries)
    {

        $countryData = [];
        foreach ($countries as $country) {

            if ($country->capitalCities()) {
                if ($time == dateLocalTime($country->capitalCities()->lng)['time']) {
                    //                    $countryData[]  = $country->capitalCities()->name.'|'.dateLocalTime($country->capitalCities()->lng)['time'];
                    $countryData[]  = $country;
                }
            }
        }


        return collect($countryData)->take(9);
    }
}
