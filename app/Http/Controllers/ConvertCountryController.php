<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\Gmt;
use App\Models\Timezone;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ConvertCountryController extends Controller
{
    public function country()
    {

        return view('front.convert-page.convert-country')
            ->with('name_1', 'Convert Time')
            ->with('name_2', 'Between Two Countries');
    }
    public function city()
    {

        return view('front.convert-page.convert-city')
            ->with('name_1', 'Convert Time')
            ->with('name_2', 'Between Two Cities');
    }
    public function tz()
    {

        return view('front.convert-page.convert-tz')
            ->with('name_1', 'Convert Time')
            ->with('name_2', 'Between Two Time Zones');
    }
    public function super()
    {

        return view('front.convert-page.convert-super')
            ->with('name_1', 'Time Difference Calculator');
    }


    public function fetchAll(Request $request)
    {
        $search = $request->input('search');
        $results = [];
        if (strlen($request->input('search')) > 0) {
            $searchTerm = $request->input('search');


            $country = Country::query();

            $country->where('name', 'like', $searchTerm . '%')
                ->orWhere('name', 'like', '%' . $searchTerm . '%')
                ->orderByRaw("CASE WHEN name LIKE ? THEN 0 ELSE 1 END", [$searchTerm . '%']);

            $country = $country->take(100)->get();

            $results = $country->map(function ($countryArray) {
                return [
                    'slug' => $countryArray->slug,
                    'value' => $countryArray->name
                ];
            });
        }
        return response()->json($results);
    }


    public function fetchCountry(Request $request)
    {


        $countryOne  = Country::where('slug', $request->input('search_1'))->first();
        $countryTwo  = Country::where('slug', $request->input('search_2'))->first();
        $capitalOne = City::where('country', $countryOne->name)->first();
        $capitalTwo = City::where('country', $countryTwo->name)->first();

        $timeOne = $this->getTime($capitalOne->timezone);
        $timeTwo = $this->getTime($capitalTwo->timezone);


        $time_1 = 'no capital';
        $utc_1 = 'no capital';
        $gmt_1 = 'no capital';
        $city1 = 'no capital';

        $city2 = 'no capital';
        $time_2 = 'no capital';
        $utc_2 = 'no capital';
        $gmt_2 = 'no capital';
        if ($countryOne && $capitalOne) {

            $city1 = $capitalOne->name;
            $time_1 = $timeOne;

            $utc_1 = $this->getOffset($capitalOne->timezone);
            $gmt_1 = $this->getOffset($capitalOne->timezone);
        }
        if ($countryTwo && $capitalTwo) {

            $city2 = $capitalTwo->name;
            $time_2 = $timeTwo;

            $utc_2 = $this->getOffset($capitalTwo->timezone);
            $gmt_2 = $this->getOffset($capitalTwo->timezone);
        }

        $result = [
            'country1'    =>  $countryOne->name,
            'city1'       =>  $city1,
            'time1'       =>  $time_1,
            'flag1'       =>  asset('vendor/blade-flags/country-' . \Str::lower($countryOne->country_code) . '.svg'),
            'utc1'       =>   $utc_1,
            'gmt1'       =>   $gmt_1,

            'country2'    =>  $countryTwo->name,
            'city2'       =>  $city2,
            'time2'       =>  $time_2,
            'flag2'       =>  asset('vendor/blade-flags/country-' . \Str::lower($countryTwo->country_code) . '.svg'),
            'utc2'       =>   $utc_2,
            'gmt2'       =>   $gmt_2,
        ];



        return response()->json($result);
    }

    public function getTime($timezone)
    {
        return \Carbon\Carbon::now()->timezone($timezone)->format('h:i A');
    }
    public function getOffset($timezone)
    {
        $offsetInSeconds = (new \DateTimeZone($timezone))->getOffset(new \DateTime('now', new \DateTimeZone('UTC')));
        $offset = $offsetInSeconds / 3600;
        return $offset = ($offset > 0 ? '+' : '') . $offset;
    }
}
