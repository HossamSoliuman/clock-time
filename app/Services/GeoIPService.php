<?php

namespace App\Services;

use App\Models\Country;
use GeoIp2\Database\Reader;
use Illuminate\Http\Request;

class GeoIPService
{
    protected $reader;

    public function __construct()
    {
        $this->reader = new Reader(storage_path('app/GeoLite2-Country.mmdb'));
        //        $this->reader = new Reader(storage_path('app/GeoLite2-City.mmdb'));
    }

    public function getLocation($ip)
    {
        try {

            $record = $this->reader->country($ip);

            return [
                'country' => $record->country->name,
                'iso_code' => $record->country->isoCode,
                'continent' => $record->continent->name,
            ];
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return null; // Handle the exception (e.g., log it) if the IP address lookup fails
        }
    }
    public function getCurrentCountry($request)
    {
        $ip = $request->ip();

        if ($ip == '127.0.0.1' || $ip === '::1') {
            $ip = '213.158.168.137';
        }
        $location = $this->getLocation($ip);
        if ($location) {
            return $country = Country::where('code', $location['iso_code'])->first();
        }
    }
}
