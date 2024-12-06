<?php
namespace App\Services;

use GeoIp2\Database\Reader;

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



//                $record = $this->reader->city($ip);
//
//                return [
//                    'city' => $record->city->name,
//                    'state' => $record->mostSpecificSubdivision->name,
//                    'country' => $record->country->name,
//                    'latitude' => $record->location->latitude,
//                    'longitude' => $record->location->longitude,
//                ];



        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return null; // Handle the exception (e.g., log it) if the IP address lookup fails
        }
    }
}
