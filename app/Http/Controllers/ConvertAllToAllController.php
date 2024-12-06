<?php

namespace App\Http\Controllers;

use App\Models\Abbreviation;
use App\Models\AbbreviationLongName;
use App\Models\City;
use App\Models\Country;
use App\Models\Gmt;
use App\Models\Slug;
use App\Models\Timezone;
use App\Services\TimeApiService;
use DateTime;
use Illuminate\Http\Request;

class ConvertAllToAllController extends Controller
{

    public function fetchAll(Request $request)
    {
        $search = $request->input('search');
//dd('mark');

        $results = [];

        if( strlen($request->input('search')) > 0 ) {
            // Fetch GMT timezones with the search criteria
            $abb = Abbreviation::where('name', 'LIKE', "%{$search}%")
                ->take(10)
                ->get();

            // Fetch GMT timezones with the search criteria
            $tz_name = AbbreviationLongName::where('name', 'LIKE', "%{$search}%")
                ->take(10)
                ->get();

            // Fetch other time zones with the search criteria
            $timeZones = TimeZone::where('name', 'LIKE', "%{$search}%")
                ->take(10)
                ->get();


            // Fetch GMT timezones with the search criteria
            $gmts = Gmt::where('name', 'LIKE', "%{$search}%")
                ->orWhere('utc_name', 'LIKE', "%{$search}%")
                ->where('dst', 'no')
                ->take(10)
                ->get();

            // Fetch other Cities with the search criteria
            $cities = City::where('name', 'LIKE', "%{$search}%")
                ->take(10)
                ->get();

            // Fetch other Countries with the search criteria
            $country = Country::where('name', 'LIKE', "%{$search}%")
                ->take(10)
                ->get();

            // Merge results and format them
            $results = $abb->merge($tz_name)
                ->merge($timeZones)
                ->merge($gmts)
                ->merge($cities)
                ->merge($country)

                ->map(function ($zone) {

                    // Check if the object is an instance of the Gmt model
                    if ($zone instanceof Gmt) {
                        return [
                            'slug' => $zone->slug,
                            'value' => $zone->name . ' ( ' . $zone->utc_name . ' ) '
                        ];
                    }

                    // Check if the object is an instance of the City model
                    if ($zone instanceof City) {
                        return [
                            'slug' => $zone->slug,
                            'value' => $zone->name .' / ' .$zone->country->name
                        ];
                    }


                    // Handle time zone instances
                return [
                    'slug' => $zone->slug,
                    'value' => $zone->name
                ];
            });

        }

        return response()->json($results);


    }



    public function convertAllToAll( Request $request)
    {

        $super_one = $request->input('super_1');

        $super_two =  $request->input('super_2');
        $result = [];

        if(!empty($this->ShowModelBySlug($super_one)) && !empty($this->ShowModelBySlug($super_two))) {

            $model_1 = $this->ShowModelBySlug($super_one)['model'];
            $model_2 = $this->ShowModelBySlug($super_two)['model'];


            list($firstResult) = $this->checkIfTheModelIsAnInstance($model_1, $super_one);

            $data['first'] = $firstResult;


            list($secondResult) = $this->checkIfTheModelIsAnInstance($model_2, $super_two);

            $data['second'] = $secondResult;



            $result = [
                'super_1'       => $data['first']['name'],
                'super_time_1'  => $data['first']['time'],
                'super_utc_1'   => $data['first']['utc'],
                'super_gmt_1'   => $data['first']['gmt'],

                'super_2'       => $data['second']['name'],
                'super_time_2'  => $data['second']['time'],
                'super_utc_2'   => $data['second']['utc'],
                'super_gmt_2'   => $data['second']['gmt'],
            ];



        }

        return response()->json($result);
    }



    public function ShowModelBySlug($slug)
    {
        // Find the slug entry
        $slugEntry = Slug::where('slug', $slug)->first();

        if (!$slugEntry) {
            // Handle case where slug is not found
            return [];
        }

        return ['model' => $slugEntry->model];

    }



    public function checkIfTheModelIsAnInstance($model, $slug): array
    {
        $result = [];
        $name = '';
        $time = '';
        $utc = '';
        $gmt = '';


        if ($model == 'App\Models\Timezone') {

            $timeZone = Timezone::where('slug', $slug)->first();


            $name = $timeZone->name;
            $time = (strlen($timeZone->name)>0)?convertGmtStringToDateTime(getGmtOffset($timeZone->name))['time']:'empty';

            $utc  =  (strlen($timeZone->name)>0)?$timeZone->name.' Time':"Time";
            $gmt  =  (strlen($timeZone->name)>0)?getGmtOffset($timeZone->name).':00':"00:00";



        }
        elseif ($model == 'App\Models\Abbreviation') {

            $abb = Abbreviation::where('slug', $slug)
                ->with('timezones')
                ->first();


            $timezoneRelation = $abb->timezones->first()->name;

            $name =  $abb->name;
            $time =  (strlen($timezoneRelation)>0)?convertGmtStringToDateTime(getGmtOffset($timezoneRelation))['time']:'empty';
            $utc  =  (strlen($abb->name)>0)?$abb->name.' Time':"Time";
            $gmt  =  (strlen($timezoneRelation)>0)?getGmtOffset($timezoneRelation).':00':"00:00";



        }
        elseif ($model == 'App\Models\AbbreviationLongName') {


            $abb_long   = AbbreviationLongName::with('abbreviation.timezones')
                ->where('slug',$slug)
                ->first();


            $name = $abb_long->name;
            $time = (strlen( $abb_long->abbreviation->timezones->first()->name)>0)?convertGmtStringToDateTime(getGmtOffset($abb_long->abbreviation->timezones->first()->name))['time']:'empty';

            $utc  =  (strlen($abb_long->name)>0)?$abb_long->name.' Time':"Time";
            $gmt  =  (strlen($abb_long->abbreviation->timezones->first()->name)>0)?getGmtOffset($abb_long->abbreviation->timezones->first()->name).':00':"00:00";


        }

        elseif ($model == 'App\Models\Gmt') {


            $gmt    = Gmt::where('slug', $slug)
                ->orWhere('utc_slug', $slug)
                ->first();



            // Check which field matched
            $matchedField = $gmt->slug === $slug ? 'name' : 'utc_name';




            $name =  $gmt->name;
            $time = (strlen($gmt->name)>0)?convertGmtStringToDateTime($gmt->name)['time']:'empty';
            $utc  =  $gmt->$matchedField.' Time';
            $gmt  =  formatGmtOffset($gmt->$matchedField).':00';


        }
        elseif ($model == 'App\Models\City') {

            $city = City::where('slug', $slug)->first();

            $api_time = dateLocalTime($city->lng);



            $name =  $city->name ;
            $time =  $api_time['time'];
            $utc  =  (strlen($city->name)>0)?getGmtOffset($api_time['time_Zone']).' Time':"Time";
            $gmt  =  formatGmtOffset(getGmtOffset($api_time['time_Zone'])) .':00';

        }
        elseif ($model == 'App\Models\Country') {

            $country = Country::where('slug', $slug)->first();

            if ($country && $country->capitalCities()) {
                    $city = $country->capitalCities();

                $api_time = dateLocalTime($city->lng);

                $name =  $country->name  ;
                $time = $api_time['time'];
                $utc  =  (strlen($city->name)>0)?getGmtOffset($api_time['time_Zone']).' Time':"Time";
                $gmt  =  formatGmtOffset(getGmtOffset($api_time['time_Zone'])) .':00';



                }else{

                $name =  $country->name  ;
                $time = 'No Capital';

                }

        }

                $result = [

                    'name'  =>  $name ,
                    'time'  =>  $time,
                    'utc'   =>  $utc ,
                    'gmt'   =>  $gmt,
                ];

        return array($result);
    }




}
