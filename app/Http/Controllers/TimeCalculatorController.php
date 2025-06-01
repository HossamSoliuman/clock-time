<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TimeCalculatorController extends Controller
{
    public function timeDuration()
    {
        return view('front.timeCalculator.time-duration');
    }
    public function hourDuration()
    {
        return view('front.timeCalculator.hour-duration');
    }
    public function HourDayCalculator()
    {
        return view('front.timeCalculator.8-hour-day-calculator');
    }
}
