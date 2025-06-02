<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TimeCalculatorController extends Controller
{
    public function timeDuration()
    {
        return view('front.timeCalculator.time-duration')
            ->with([
                'head' => 'Calculates the difference<br>between two times'
            ]);
    }

    public function HourDayCalculator()
    {
        return view('front.timeCalculator.8-hour-day-calculator');
    }
}
