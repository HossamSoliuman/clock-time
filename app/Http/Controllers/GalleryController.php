<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function digitalClocks()
    {
        return view('front.gallery.digital-clocks')
            ->with([
                'head' => 'Digital clock collection'
            ]);
    }

    public function analogClocks()
    {
        return view('front.gallery.analog-clocks')
            ->with([
                'head' => 'Analog clock collection'
            ]);
    }

    public function sandTimers()
    {
        return view('front.gallery.sand-timers')
            ->with([
                'head' => 'Sand timer collection'
            ]);
    }
}
