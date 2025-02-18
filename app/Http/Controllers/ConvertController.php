<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Services\ConvertService;
use App\Services\GeoIPService;
use Illuminate\Http\Request;

class ConvertController extends Controller
{
    public function __construct(public ConvertService $convertService, public GeoIPService $geoIPService) {}

    public function zoneToCity(Request $request)
    {
        $timezoneSlug = $request->timezoneSlug;
        $citySlug = $request->citySlug;

        $hour = $request->hour;
        $meridian = $request->meridian;
        $formattedTime = "{$hour} {$meridian}";
        $country = $this->geoIPService->getCurrentCountry($request);
        $city = City::where('name', $country->capital)->first();
        $citySlug = $city->slug;
        $response = $this->convertService->zoneToCity($timezoneSlug, $formattedTime, $citySlug);

        return response()->json($response);
    }
}
