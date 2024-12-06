<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Timezone;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ConvertCityToCityController extends Controller
{
    public function convertCity(Request $request)
    {

        $city_1   = City::where('slug', $request->input('city_1'))->first();
        $city_2   = City::where('slug', $request->input('city_2'))->first();
        $result = [

            'city1'        =>  $city_1->name,
            'time1'       =>  Carbon::now()->timezone($city_1->timezone)->format('h:i A'),

            'city2'        =>  $city_2->name,
            'time2'       =>  Carbon::now()->timezone($city_2->timezone)->format('h:i A'),
        ];
        return response()->json($result);
    }



    public function convertCityToTime(Request $request)
    {


        $city_1 = City::where('slug', $request->input('city_1'))->first();

        $timezone = Timezone::where('slug', $request->input('time'))->first();


        $result = [


            'city' => $city_1->name,
            'time_1' => dateLocalTime($city_1->lng)['time'],

            'timezone' => $timezone->name,
            'time_2' => convertGmtStringToDateTime(getGmtOffset($timezone->name))['time'],


        ];
        return response()->json($result);
    }

    public function getCity(Request $request)
    {


        $city   = City::with('country')
            ->where('slug', $request
                ->input('city_slug'))
            ->first();


        $date = dateLocalTime($city->lng);

        $result = [
            'city_name'             =>  $city->name,
            'city_slug'             =>  $city->slug,
            'country_name'          =>  $city->country->name,
            'time'                  =>  $date['time'],
            'hours'                 =>  $date['hours'],
            'day'                  =>  $date['day'],
            'flag'                  =>  asset('vendor/blade-flags/country-' . \Str::lower($city->iso2) . '.svg'),
            'gmt'                   =>  $date['gmt'],

        ];



        return response()->json($result);
    }
}
