<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TimeConverterController extends Controller
{

    public function minsToHours()
    {
        return view('front.time-converters.mins-to-hours')
            ->with([
                'head' => 'Convert minutes to hours'
            ]);
    }

    public function hoursToMins()
    {
        return view('front.time-converters.hours-to-mins')
            ->with([
                'head' => 'Convert hours to minutes'
            ]);
    }

    public function hoursToSeconds()
    {
        return view('front.time-converters.hours-to-seconds')
            ->with([
                'head' => 'Convert hours to seconds'
            ]);
    }

    public function minsToSeconds()
    {
        return view('front.time-converters.mins-to-seconds')
            ->with([
                'head' => 'Convert minutes to seconds'
            ]);
    }




    public function hoursToDecimal()
    {
        return view('front.time-converters.hours-to-decimal')
            ->with([
                'head' => 'Hours To Decimal'
            ]);
    }

    public function epochUnix()
    {
        return view('front.time-converters.epoch-unix')
            ->with([
                'head' => 'Unix Epoch Clock now'
            ]);
    }
}
