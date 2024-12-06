<?php

namespace App\Livewire;

use DateTime;
use Livewire\Component;
use App\Services\TimeApiService;

class TimeResult extends Component
{
    public $latitude;
    public $longitude;
    public $currentTime;
    public $date;
    public $data;
    public $dayOfWeek;
    public $timeZone;
    public $cityName;

    public function mount($data)
    {
        $this->data = $data;
//        $this->latitude = $lat;
//        $this->longitude = $lng;
//        $this->cityName = $cityName;

        // Fetch the initial time
        $this->fetchTimeLocal();
    }

    public function fetchTime()
    {
        $timeApiService = new TimeApiService(); // Initialize the service
        $timeData = $timeApiService->getCurrentTime($this->data->timezone->name);

        if ($timeData) {
            // Convert the 24-hour format time (e.g., "17:45") to 12-hour format with AM/PM
            $dateTime = DateTime::createFromFormat('H:i', $timeData['time']);
            $this->currentTime = $dateTime ? $dateTime->format('g:i A') : 'Invalid Time';  // e.g., "5:45 PM"

            $this->date = $timeData['date'];               // e.g., "10/03/2024"
            $this->dayOfWeek = $timeData['dayOfWeek'];     // e.g., "Thursday"
            $this->timeZone = $timeData['timeZone'];       // e.g., "Africa/Cairo"
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

        if ($timeData) {




            $this->currentTime                  = $timeData['time']              ?: 'Invalid Time';   // e.g., "5:45 PM"

            $this->date                         = $timeData['dateFormat']               ?: 'Invalid Time';   // e.g., "7 AUG 2024"

            $this->dayOfWeek                    = $timeData['day_of_week']              ?: 'Invalid Time';   // e.g., "Thursday"
            $this->timeZone                     = $timeData['time_Zone'];       // e.g., "Africa/Cairo"



        }else {
            $this->currentTime = 'Unable to fetch time';
            $this->date = '-';
            $this->dayOfWeek = '-';
            $this->timeZone = '-';
        }
    }

    public function render()
    {
        return view('livewire.time-result');
    }
}
