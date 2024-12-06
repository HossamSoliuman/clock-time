<?php

namespace App\Livewire;

use DateTime;
use Livewire\Component;
use App\Services\TimeApiService;

class CapitalUpdater extends Component
{
    public $latitude;
    public $longitude;
    public $currentTime;
    public $currentTimeWithSecond;
    public $date;
    public $dayOfWeek;
    public $timeZone;
    public $cityName;
    public $city;

    public function mount($lat, $lng,$cityName,$city)
    {
        $this->latitude = $lat;
        $this->longitude = $lng;
        $this->cityName = $cityName;
        $this->city = $city;

        // Fetch the initial time
        $this->fetchTime();
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

            $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', sprintf('%04d-%02d-%02d %02d:%02d:%02d',
                $timeData['year'],
                $timeData['month'],
                $timeData['day'],
                $timeData['hour'],
                $timeData['minute'],
                $timeData['seconds']
            ));

            $this->currentTimeWithSecond = $dateTime ? $dateTime->format('g:i:s') : 'Invalid Time';  // e.g., "10:55:15 PM"





        } else {
            $this->currentTime = 'Unable to fetch time';
            $this->date = '-';
            $this->dayOfWeek = '-';
            $this->timeZone = '-';
        }
    }

    public function render()
    {
        return view('livewire.capital-updater');
    }
}
