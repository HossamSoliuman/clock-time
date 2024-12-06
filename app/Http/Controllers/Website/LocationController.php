<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

use App\Services\GeoIPService;

class LocationController extends Controller
{
    protected $geoIPService;

    public function __construct(GeoIPService $geoIPService)
    {
        $this->geoIPService = $geoIPService;
    }

    public function getUserLocation(Request $request)
    {
        $ip = $request->ip(); // Get the user's IP address

        if ($ip == '127.0.0.1' || $ip === '::1') {
            $ip = '213.158.168.137'; // Fallback IP for testing in local environment
        }

        $location = $this->geoIPService->getLocation($ip);

        if ($location) {
            $country =Country::where('code', $location['iso_code'])->first();
            if($country && $country->capitalCities()){
                $capital = $country->capitalCities()->slug;

             return   redirect("/$capital");
            }else{
                return   redirect("/$country->slug");
            }

        }

        return redirect('/');
    }

    public function getUserLocationGmt(Request $request)
    {
        $ip = $request->ip(); // Get the user's IP address

        if ($ip == '127.0.0.1' || $ip === '::1') {
            $ip = '213.158.168.137'; // Fallback IP for testing in local environment
        }

        $location = $this->geoIPService->getLocation($ip);

        if ($location) {
            $country =Country::with('gmt')->where('code', $location['iso_code'])->first();

            if($country->gmt){
                $gmt = $country->gmt->first();
                $matchedField  = 'name';

                return view('front.gmt')
                    ->with('abb',$gmt)
                    ->with('gmt',$gmt)
                    ->with('abblong','')
                    ->with('searchField',$matchedField)
                    ->with('date',convertGmtStringToDateTime($gmt->name));
            }


            if($country && $country->capitalCities()){
                $capital = $country->capitalCities()->slug;

             return   redirect("/$capital");
            }else{
                return   redirect("/$country->slug");
            }

        }

        return redirect('/');
    }
    public function notFound(Request $request)
    {
        $ip = $request->ip(); // Get the user's IP address

        if ($ip == '127.0.0.1' || $ip === '::1') {
            $ip = '213.158.168.137'; // Fallback IP for testing in local environment
        }

        $location = null;$this->geoIPService->getLocation($ip);

        if ($location) {
            $country =Country::with('gmt')->where('code', $location['iso_code'])->first();

            $resource = $country->capitalCities();
            // Combine results
            $data = [
                'lat'           =>  $resource->lat,
                'lng'           =>  $resource->lng,
                'name'          =>  $resource->name,
                'capital'       =>  [],
                'city'          =>  $resource,
                'country'       =>  $resource->country,
                'flag'          =>  \Str::lower($resource->country->cities[0]->iso2),
//                'timezone'      =>  $resource->timezone,

//                'date'=>timeApiService( $resource->lat,$resource->lng)
                'date'=>dateLocalTime( $resource->lng)
            ];


            return view('front.404')->with('data',$data)->with('active',true);

        }

        return redirect('/');
    }
}
