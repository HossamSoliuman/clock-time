<?php

namespace App\Livewire;

use DateTime;
use Livewire\Component;
use App\Services\TimeApiService;

class TimeUpdater extends Component
{
    public $latitude;
    public $longitude;
    public $currentTime;
    public $currentTimeWithSecond;
    public $identify;
    public $date;
    public $dayOfWeek;
    public $timeZone;
    public $cityName;
    public $country;
    public $city;

    public function mount($lat, $lng,$cityName,$country='no',$city=[])
    {
        $this->latitude = $lat;
        $this->longitude = $lng;
        $this->cityName = $cityName;
        $this->country = $country;
        $this->city = $city;

        // Fetch the initial time
        $this->fetchTimeLocal();
    }

    public function fetchTime()
    {
        $timeApiService = new TimeApiService(); // Initialize the service
        $timeData = $timeApiService->getTimeLatAndLon($this->latitude, $this->longitude);

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



            $this->currentTime                  = $timeData['timeWithout']              ?: 'Invalid Time';   // e.g., "5:45 "
            $this->identify                     = $timeData['identify']              ?: 'Invalid Time';   // e.g., " PM"
            $this->currentTimeWithSecond        = $timeData['currentTimeWithSecond24']              ?: 'Invalid Time';   // e.g., "5:45:00 "

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
        return view('livewire.time-updater');
    }
}
