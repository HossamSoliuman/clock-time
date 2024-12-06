<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Gmt;
use App\Models\Slug;
use App\Models\Timezone;
use App\Services\TimeApiService;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;

class ConvertAllController extends Controller
{
    public function fetchAll(Request $request)
    {
        $search = $request->input('search');

        // Fetch GMT timezones with the search criteria
        $gmts = Gmt::where('name', 'LIKE', "%{$search}%")
            ->orWhere('utc_name', 'LIKE', "%{$search}%")
            ->where('dst', 'no')
            ->take(10)
            ->get();

        // Fetch other time zones with the search criteria
        $timeZones = TimeZone::where('name', 'LIKE', "%{$search}%")
            ->take(10)
            ->get();


        // Fetch other Cities with the search criteria
        $cities = City::where('name', 'LIKE', "%{$search}%")
            ->take(10)
            ->get();

        // Merge results and format them
        $results = $gmts->merge($timeZones)->merge($cities)->map(function($zone) {
            // Check if the object is an instance of the Gmt model
            if ($zone instanceof Gmt) {
                return [
                    'id' => $zone->slug,
                    'text' => $zone->name . " (" . $zone->utc_name . ") DST: " . ($zone->dst ? 'yes' : 'no')
                ];
            }

            // Check if the object is an instance of the City model
            if ($zone instanceof City) {
                return [
                    'id' => $zone->slug,
                    'text' => $zone->country->name.' / '.$zone->name
                ];
            }

            // Handle time zone instances
            return [
                'id' => $zone->slug,
                'text' => $zone->name
            ];
        });

        return response()->json($results);

    }


    public function convertTime($search_1, $search_2, Request $request)
    {


        if(!empty($this->ShowModelBySlug($search_1)) && !empty($this->ShowModelBySlug($search_2))) {

            $model_1 = $this->ShowModelBySlug($search_1)['model'];
            $model_2 = $this->ShowModelBySlug($search_2)['model'];

            // Check if the model is an instance of Timezone or Gmt
            list($timeZone, $gmt, $firstResult) = $this->checkIfTheModelIsAnInstanceOfTimezoneOrGmt($model_1, $search_1);

            $data['first']= $firstResult;

            // Check if the model is an instance of Timezone or Gmt
            list($timeZone, $gmt, $secondResult) = $this->checkIfTheModelIsAnInstanceOfTimezoneOrGmt($model_2, $search_2);

            $data['second']= $secondResult;

            return view('front.convert-result-all')->with('data', $data);

        }else{
            // if empty one of model

            abort(404);
            return view('front.convert-result-all')->with('data', $data);
        }




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

    function convertGmtStringToDateTime($gmtString)
    {
        // Remove 'GMT' from the string and trim spaces
        $gmtString = trim(str_replace('GMT', '', $gmtString));

        // Check the sign
        $sign = $gmtString[0] === '-' ? '-' : '+';

        // Remove sign for further processing
        $offsetWithoutSign = ltrim($gmtString, '+');

        // Split into hours and minutes based on the presence of a decimal
        if (strpos($offsetWithoutSign, '.') !== false) {
            list($hours, $minutes) = explode('.', $offsetWithoutSign);
            $minutes = intval($minutes * 6); // Convert .5 hours to 30 minutes
        } else {
            $hours = $offsetWithoutSign;
            $minutes = 0; // No decimal means 0 minutes
        }

        // Format the timezone string for DateTimeZone
        $timeZoneString = sprintf('%s%02d:%02d', $sign, abs($hours), abs($minutes));

        // Create a DateTime object for the current time in UTC
        $dateTime = new DateTime('now', new DateTimeZone('UTC'));

        // Set the timezone to the calculated offset
        $dateTime->setTimezone(new DateTimeZone($timeZoneString));

        return $dateTime;
    }


    public function gmtResult($gmt){

        $dateTimeInOffset = $this->convertGmtStringToDateTime($gmt->name);

        return  [

            'date' =>$dateTimeInOffset->format('Y-m-d '),
            'time' =>$dateTimeInOffset->format(' H:i:s'),
            'data'=> $gmt
        ];
    }

    /**
     * @param $model_1
     * @param $zone1
     * @return array
     */
    public function checkIfTheModelIsAnInstanceOfTimezoneOrGmt($model, $slug): array
    {
        $timeZone = [];
        $cities = [];
        $gmt = [];
        $result = [];

        if ($model == 'App\Models\Timezone') {

            $timeZone = Timezone::where('slug', $slug)
                ->with('gmt')
                ->first();


            if(count($timeZone->gmt)>0){
                foreach ($timeZone->gmt as $gmt) {

                    $result['timezone'][] = $this->gmtResult($gmt);
                }

            }else{
                $result['timezone'][] =  $this->getCurrentTimeByTimeZone($timeZone);
            }


        }elseif ($model == 'App\Models\City') {

            $city = City::where('slug', $slug)->first();

//            $timeApiService = new TimeApiService(); // Initialize the service
//            $timeData = $timeApiService->getTimeLatAndLon($city->lat, $city->lng);

            $dateTime = DateTime::createFromFormat('H:i', dateLocalTime($city->lng)['time']);



           $data =  [

                'date' =>$dateTime->format('Y-m-d'),
                'time' => $dateTime->format('H:i:s'),
                'data'=> $city
            ];

            $result["city"] = $data;
        }elseif ($model == 'App\Models\Gmt') {
            $gmt = Gmt::where('slug', $slug)->first();

            $result["gmt"] = $this->gmtResult($gmt);
        }
        return array($timeZone, $gmt, $result);
    }


    function getCurrentTimeByTimeZone($timeZone) {
        // Create a DateTime object with the current time
        $dateTime = new DateTime('now', new DateTimeZone($timeZone->name));

        // Format the time (you can customize this format as needed)

        return  [

            'date' =>$dateTime->format('Y-m-d '),
            'time' =>$dateTime->format(' H:i:s'),
            'data'=> $timeZone
        ];

    }
}
