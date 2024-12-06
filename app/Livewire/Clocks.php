<?php

namespace App\Livewire;

use App\Models\City;
use App\Models\Country;
use App\Services\TimeApiService;
use Carbon\Carbon;
use DateTime;
use Livewire\Component;

class Clocks extends Component
{
    public $cities;

    public $times = [];

    public $latitude;
    public $longitude;
    public $currentTime;
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



        $this->updateClocks();
    }

    public function updateClocks()
    {

            $timeApiService = new TimeApiService(); // Initialize the service
            $timeData = $timeApiService->getTimeLatAndLon($city->latitude, $city->longitude);


                // Convert the 24-hour format time (e.g., "17:45") to 12-hour format with AM/PM
//                $dateTime = DateTime::createFromFormat('H:i', $timeData['time']);
//                $this->currentTime = $dateTime ? $dateTime->format('g:i A') : 'Invalid Time';  // e.g., "5:45 PM"
//
//                $this->date = $timeData['date'];               // e.g., "10/03/2024"
//                $this->dayOfWeek = $timeData['dayOfWeek'];     // e.g., "Thursday"
//                $this->timeZone = $timeData['timeZone'];



                $this->time = $timeData['time'];
                $this->timeZone = $timeData['time'];

    }

    public function render()
    {
        return view('livewire.clocks');
    }
}
