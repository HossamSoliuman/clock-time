<?php

namespace App\Livewire;

use App\Services\PrayerTimeService;
use DateTime;
use Livewire\Component;
use App\Services\TimeApiService;


class PayerTime extends Component
{
    public $city;
    public $date;
    public $country;
    public $timeData;
    public $data;


    public function mount($date, $city,$country)
    {

        $this->date = $date;
        $this->city = $city;
        $this->country = $country;



        // Fetch the initial time
        $this->fetchTime();
    }

    public function fetchTime()
    {
        $timeApiService = new PrayerTimeService(); // Initialize the service
        $this->timeData = $timeApiService->getPrayerTimings($this->date,  $this->city,$this->country);
        if($this->timeData != null){

            $this->data = $this->timeData['data']['timings'];

            $convertedTimings = [];

            foreach ($this->data as $prayer => $time) {
                $convertedTimings[$prayer] = $this->convertTo12HourFormat($time);
            }
            $this->data =  $convertedTimings;

            $_SESSION['sunrise'] =  $convertedTimings['Sunrise'];
            $_SESSION['sunset'] = $convertedTimings['Sunset'];


        }else{
            $this->data  = [];
        }


    }

    // Function to convert time from 24-hour to 12-hour format
   public function convertTo12HourFormat($time): string
   {
        $dateTime = DateTime::createFromFormat('H:i', $time);
        return $dateTime ? $dateTime->format('g:i A') : 'Invalid Time'; // e.g., "4:03 PM"
    }

    public function render()
    {
        return view('livewire.payer-time');
    }
}
