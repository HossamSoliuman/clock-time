<?php

namespace App\Http\Controllers;

use App\Models\Abbreviation;
use App\Models\AbbreviationLongName;
use App\Models\City;
use App\Models\Country;
use App\Models\Gmt;
use App\Models\IanaTimezone;
use App\Models\Slug;
use App\Models\Timezone;
use App\Models\TimezoneDetail;
use App\Services\TimeApiService;
use Carbon\Carbon;
use App\Traits\GetDate;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ConvertAllToAllController extends Controller
{
    use GetDate;
    public function index()
    {
        return view('front.timeConverter')
            ->with('name_1', 'Time Difference Calculator');
    }
    public function fetchAll(Request $request)
    {
        $search = $request->input('search');
        $results = collect();

        $cities = City::where('name', 'LIKE', "%{$search}%")
            ->take(10)
            ->get()
            ->map(function ($zone) {
                return [
                    'slug' => $zone->slug,
                    'value' => $zone->name . ' / ' . $zone->country
                ];
            });

        if (strlen($search) > 0) {
            $abb = IanaTimezone::where('iana_timezone', 'LIKE', "%{$search}%")
                ->take(10)
                ->get()
                ->map(function ($zone) {
                    return [
                        'slug' => $zone->slug,
                        'value' => $zone->iana_timezone
                    ];
                });

            $timezoneDetail = TimezoneDetail::where('name', 'LIKE', "%{$search}%")
                ->take(10)
                ->get()
                ->map(function ($zone) {
                    return [
                        'slug' => $zone->name_slug,
                        'value' => $zone->name
                    ];
                });

            $timezoneDetailLong = TimezoneDetail::where('timezone_long', 'LIKE', "%{$search}%")
                ->orWhere('long_slug', 'LIKE', "%{$search}%")
                ->take(10)
                ->get()
                ->map(function ($zone) {
                    return [
                        'slug' => $zone->long_slug,
                        'value' => $zone->timezone_long
                    ];
                });

            $gmts = Gmt::where('name', 'LIKE', "%{$search}%")
                ->orWhere('utc_name', 'LIKE', "%{$search}%")
                ->take(10)
                ->get()
                ->map(function ($zone) {
                    return [
                        'slug' => $zone->slug,
                        'value' => $zone->name . ' ( ' . $zone->utc_name . ' ) '
                    ];
                });

            $country = Country::where('name', 'LIKE', "%{$search}%")
                ->take(10)
                ->get()
                ->map(function ($zone) {
                    return [
                        'slug' => $zone->slug,
                        'value' => $zone->name
                    ];
                });

            $results = $results
                ->merge($abb)
                ->merge($timezoneDetail)
                ->merge($timezoneDetailLong)
                ->merge($gmts)
                ->merge($cities)
                ->merge($country);
        }

        return response()->json($results);
    }





    public function convertAllToAll(Request $request)
    {

        $super_one = $request->input('super_1');

        $super_two =  $request->input('super_2');
        $result = [];

        if (!empty($this->ShowModelBySlug($super_one)) && !empty($this->ShowModelBySlug($super_two))) {

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
                'super_link_1'   => $data['first']['link'],
                'super_gmt_1'   => $data['first']['gmt'],

                'super_2'       => $data['second']['name'],
                'super_time_2'  => $data['second']['time'],
                'super_utc_2'   => $data['second']['utc'],
                'super_link_2'   => $data['second']['link'],
                'super_gmt_2'   => $data['second']['gmt'],
            ];
        }

        return response()->json($result);
    }



    public function ShowModelBySlug($slug)
    {
        $slugEntry = Slug::where('slug', $slug)->first();
        if (!$slugEntry) {
            return [];
        }
        return ['model' => $slugEntry->model];
    }


    public function checkIfTheModelIsAnInstance($model, $slug): array
    {
        $result = [];
        $date = [];

        switch ($model) {
            case 'App\Models\Timezone':
                $date = $this->ianaTimezone($slug);
                break;
            case 'App\Models\Abbreviation':
            case 'App\Models\AbbreviationLongName':
                $date = $this->timezoneDetails($slug);
                break;
            case 'App\Models\Gmt':
                $date = $this->gmt($slug);
                break;
            case 'App\Models\City':
                $date = $this->city($slug);
                $date['timezone'] = $date['city']->name . ' / ' . $date['city']->country;
                break;
            case 'App\Models\Country':
                $date = $this->country($slug);
                break;
        }

        if (!empty($date)) {
            $name = $date['timezone'];
            $time = $date['time'] . ' ' . $date['identify'];
            $utc = (strlen($name) > 0) ? $name . ' Time' : "Time";
            $link = $date['sign'] . $date['hoursNumber'];
            $gmt = $date['hoursWithSign'] . ' GMT';

            $result = [
                'name' => $name,
                'time' => $time,
                'utc'  => $utc,
                'link'  => $link,
                'gmt'  => $gmt,
            ];
        }

        return [$result];
    }
}
