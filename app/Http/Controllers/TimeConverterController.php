<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TimeConverterController extends Controller
{
    public function hoursToMins()
    {
        return view('front.time-converters.hours-to-mins')
            ->with([
                'head' => 'Convert minutes to hours'
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
