<?php

namespace App\Http\Controllers;

use App\Models\AbbreviationLongName;
use App\Models\Country;
use App\Models\City;
use App\Models\IanaTimezone;
use App\Services\GeoIPService;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Traits\GetDate;

class MeetingPlannerController extends Controller
{
    use GetDate;
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
        $date = $this->city($city->slug);
        $ianaTimezone = IanaTimezone::where('iana_timezone', $city->timezone)->first();

        return view('front.meeting-planner')
            ->with([
                'type' => 'meeting-planner',
                'city' => $city,
                'country' => $country,
                'ianaTimezone' => $ianaTimezone,
                'timezoneName' => $city->name,
                'date' =>  $date,
                'timezone' => $city->timezone,
                'offset' => $date['offset'],
                'hoursWithSign' => $date['hoursWithSign'],
                'sign' => $date['sign'],
                'hours' => $date['hours'],
                'hoursNumber' => $date['hoursNumber'],
            ]);
    }
    public function meetingOrg(Request $request)
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
        $date = $this->city($city->slug);
        $ianaTimezone = IanaTimezone::where('iana_timezone', $city->timezone)->first();

        return view('front.meetingOrg')
            ->with([
                'type' => 'meeting-planner',
                'city' => $city,
                'country' => $country,
                'ianaTimezone' => $ianaTimezone,
                'timezoneName' => $city->name,
                'date' =>  $date,
                'timezone' => $city->timezone,
                'offset' => $date['offset'],
                'hoursWithSign' => $date['hoursWithSign'],
                'sign' => $date['sign'],
                'hours' => $date['hours'],
                'hoursNumber' => $date['hoursNumber'],
            ]);
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
