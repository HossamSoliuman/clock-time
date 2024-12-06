<?php

namespace App\Http\Controllers;

class TimerController
{
    public function timer()
    {
        return view("front.timer.timer");
    }
    public function countDownTimer()
    {
        return view("front.timer.countDownTimer");
    }
    public function stopWatch()
    {
        return view("front.timer.stopWatch");
    }
}
