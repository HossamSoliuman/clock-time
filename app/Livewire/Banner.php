<?php

namespace App\Livewire;

use DateTime;
use Livewire\Component;
use App\Services\TimeApiService;


class Banner extends Component
{
    public $latitude;
    public $longitude;
    public $currentTime;
    public $currentTimewithoutID;
    public $identy;
    public $currentTimeWithoutSecond;
    public $date;
    public $dayOfWeek;
    public $timeZone;
    public $cityName;
    public $data;
    public $dayName;

    public function mount($lat, $lng,$cityName,$data)
    {
        session_start();
        $this->latitude = $lat;
        $this->longitude = $lng;
        $this->cityName = $cityName;
        $this->data = $data;

        // Fetch the initial time
        $this->fetchTimeLocal();
    }

    public function fetchTimeApi()
    {
        $timeApiService = new TimeApiService(); // Initialize the service
        $timeData = $timeApiService->getTimeLatAndLon($this->latitude, $this->longitude);

        $_SESSION['payer']  =  'Invalid Date'; // e.g., "7/10/2024"


        // Store data in session
        $_SESSION['currentTime'] = '';
        $_SESSION['date'] = '';
        $_SESSION['dayOfWeek'] = '';
        $_SESSION['timeZone'] = '';

        if ($timeData) {
            // Convert the 24-hour format time (e.g., "17:45") to 12-hour format with AM/PM
            $dateTime = DateTime::createFromFormat('H:i', $timeData['time']);

            $this->currentTime = $dateTime ? $dateTime->format('g:i:s A') : 'Invalid Time';  // e.g., "5:45 PM"
            $this->currentTimeWithoutSecond = $dateTime ? $dateTime->format('g:i A') : 'Invalid Time';  // e.g., "5:45 PM"

            $this->currentTimewithoutID = $dateTime ? $dateTime->format('g:i:s') : 'Invalid Time';  // e.g., "5:45 "
            $this->identy = $dateTime ? $dateTime->format('A') : 'Invalid Time';  // e.g., " PM"

            // Format the date as "7 AUG 2024"
            $dateObject = DateTime::createFromFormat('m/d/Y', $timeData['date']);
            $this->date = $dateObject ? $dateObject->format('j M Y') : 'Invalid Date'; // e.g., "7 AUG 2024"
            $this->dayName = $dateObject ? $dateObject->format('D') : 'Invalid Date'; // e.g., "MON"


//            $this->date = $timeData['date'];               // e.g., "10/03/2024"
            $this->dayOfWeek = strtoupper($timeData['dayOfWeek']);   // e.g., "Thursday"
            $this->timeZone = $timeData['timeZone'];       // e.g., "Africa/Cairo"


            // Assuming $timeData['date'] is in 'd-m-Y' format
            $dateObject2 = DateTime::createFromFormat('d-m-Y', $timeData['date']);
            $_SESSION['payer']  = $dateObject2 ? $dateObject->format('j/n/Y') : 'Invalid Date'; // e.g., "7/10/2024"


            // Store data in session
            $_SESSION['currentTime'] = $this->currentTimeWithoutSecond;
            $_SESSION['date'] = $this->date;
            $_SESSION['dayOfWeek'] = $this->dayOfWeek;
            $_SESSION['timeZone'] = $this->timeZone;
        } else {
            $this->currentTime = 'Unable to fetch time';
            $this->date = '-';
            $this->dayOfWeek = '-';
            $this->timeZone = '-';
        }
    }

        public function fetchTimeLocal()
    {

        $timeData =dateLocalTime($this->longitude);

        $_SESSION['payer']  =  'Invalid Date'; // e.g., "7/10/2024"

        // Store data in session
        $_SESSION['currentTime'] = '';
        $_SESSION['date'] = '';
        $_SESSION['dayOfWeek'] = '';
        $_SESSION['timeZone'] = '';

        if ($timeData) {


//// Format each required value without DateTime functions
//            $data = [
//                'time'                  => gmdate("g:i A", $localTimestamp),              // e.g., "5:45 PM"
//                'identify'              => gmdate("A", $localTimestamp),                  // e.g., PM"
//                'dateFormat'            => gmdate("j M Y", $localTimestamp),              // e.g., "7 AUG 2024"
//                'timeWithout'           => gmdate("g:i", $localTimestamp),                // e.g., "5:45 PM"
//                'time_second'           => gmdate("g:i:s A", $localTimestamp),            // e.g., "5:45:00 PM"
//                'currentTimeWithSecond' => gmdate("g:i:s", $localTimestamp),              // e.g., "5:45:00 PM"
//                'day'                   => strtoupper(gmdate("D", $localTimestamp)),      // e.g., "THU"
//                'date'                  => gmdate("m/d/Y", $localTimestamp),              // e.g., "10/03/2024"
//                'date_JNY'              => gmdate("j/n/Y", $localTimestamp),              // e.g., "7/10/2024"
//                'day_of_week'           => gmdate("l", $localTimestamp),                  // e.g., "Thursday"
//                'time_Zone'             => 'GMT' . ($gmtOffset >= 0 ? '+' : '') . $gmtOffset,    // e.g., "GMT+2" or "GMT-5"
//                'gmt_offset'            => 'GMT' . ($gmtOffset >= 0 ? '+' : '') . $gmtOffset     // e.g., "GMT+2" or "GMT-5"
//            ];

            $this->currentTime                  = $timeData['time_second']              ?: 'Invalid Time';   // e.g., "5:45 PM"
            $this->currentTimeWithoutSecond     = $timeData['timeWithout']              ?: 'Invalid Time';   // e.g., "5:45 PM"
            $this->currentTimewithoutID         = $timeData['currentTimeWithSecond']    ?: 'Invalid Time';   // e.g., "5:45 "
            $this->identy                       = $timeData['identify']                 ?: 'Invalid Time';   // e.g., " PM"
            $this->date                         = $timeData['dateFormat']               ?: 'Invalid Time';   // e.g., "7 AUG 2024"
            $this->dayName                      = $timeData['day']                      ?: 'Invalid Time';   // e.g., "MON"
            $this->dayOfWeek                    = $timeData['day_of_week']              ?: 'Invalid Time';   // e.g., "Thursday"
            $this->timeZone                     = $timeData['time_Zone'];       // e.g., "Africa/Cairo"






            // Store data in session
            $_SESSION['currentTime']            = $this->currentTimeWithoutSecond;
            $_SESSION['date']                   = $this->date;
            $_SESSION['dayOfWeek']              = $this->dayOfWeek;
            $_SESSION['timeZone']               = $this->timeZone;
            $_SESSION['payer']                  = $timeData['date_JNY']              ?: 'Invalid Time';   // e.g., "7/10/2024"





        } else {
            $this->currentTime = 'Unable to fetch time';
            $this->date = '-';
            $this->dayOfWeek = '-';
            $this->timeZone = '-';
        }
    }




    public function render()
    {
        return view('livewire.banner');
    }
}
