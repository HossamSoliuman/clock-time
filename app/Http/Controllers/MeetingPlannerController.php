<?php

namespace App\Http\Controllers;

use App\Models\AbbreviationLongName;
use App\Models\Country;
use App\Models\City;
use App\Services\GeoIPService;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MeetingPlannerController extends Controller
{

    protected $geoIPService;

    public function __construct(GeoIPService $geoIPService)
    {
        $this->geoIPService = $geoIPService;
    }

    public function index(Request $request)
    {
        $ip = $request->ip();

        if ($ip == '127.0.0.1' || $ip === '::1') {
            $ip = '213.158.168.137';
        }
        $location = $this->geoIPService->getLocation($ip);
        if ($location) {
            $country = Country::where('code', $location['iso_code'])->first();
        }
        $city = City::where('name', $country->capital)->first();
        $date = Carbon::now()->timezone($city->timezone);
        return view('front.meeting-planner')

            ->with('abb', $country)
            ->with('gmt', false)
            ->with('abblong', '')
            ->with('date',  $date);
    }

    public function getUserLocationPlanner(Request $request)
    {
        $ip = $request->ip();

        if ($ip == '127.0.0.1' || $ip === '::1') {
            $ip = '213.158.168.137';
        }
        $location = $this->geoIPService->getLocation($ip);
        if ($location) {
            $country = Country::where('code', $location['iso_code'])->first();
            if ($country && $country->capitalCities()) {
                $capital = $country->capitalCities()->slug;
                return response()->json(['success' => true, 'data' => $capital]);
            } else {
                return response()->json(['success' => true, 'data' => $country->slug]);
            }
        }
        return response()->json(['success' => false]);
    }
}
