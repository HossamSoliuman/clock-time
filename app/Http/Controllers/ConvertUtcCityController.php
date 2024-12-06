<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\Gmt;
use App\Models\Timezone;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ConvertUtcCityController extends Controller
{

    public function fetchUtcCity(Request $request){


        $gmt    = Gmt::where('slug', $request->input('utc'))
                    ->orWhere('utc_slug', $request->input('utc'))
                    ->first();
        $city   = City::where('slug',$request->input('city'))->first();


        // Check which field matched
        $matchedField = $gmt->slug === $request->input('utc') ? 'name' : 'utc_name';

      $result = [
          'utc'         =>  $gmt->name,
          'time1'       =>  ($gmt)?convertGmtStringToDateTime($gmt->name)['time']:'empty',
          'utc1'        =>  $gmt->$matchedField.' Time',
          'gmt1'        =>  formatGmtOffset($gmt->$matchedField).':00',


          'city'        =>  $city->name,
          'time2'       =>  dateLocalTime($city->lng)['time'],
          'city2'       =>  $city->name.' Time',
          'gmt2'        =>  formatGmtOffset(getGmtOffset(dateLocalTime($city->lng)['time_Zone'])) .':00',


      ];



        return response()->json($result);
    }


}
