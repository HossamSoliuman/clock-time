<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller
{
    public function digitalClocks()
    {
        $folder = base_path('../public_html/images/gallery/digital-clocks');

        $images = collect(File::exists($folder) ? File::files($folder) : [])
            ->map(fn($img) => basename($img->getFilename()));

        $count = $images->count();

        if ($count < 16 && $count > 0) {
            $repeat = ceil(16 / $count);
            $images = $images->flatMap(fn($img) => array_fill(0, $repeat, $img))->take(16);
        }

        return view('front.gallery.digital-clocks')->with([
            'head' => 'Digital clocks',
            'images' => $images
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
