<?php

namespace App\Services;

use App\Models\City;
use App\Models\Country;
use App\Models\TimezoneDetail;
use App\Traits\GetDate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ConvertService
{
    use GetDate;

    public function __construct(public GeoIPService $geoIPService) {}

    public function zoneToCity($timezoneSlug, $formattedTime, $citySlug)
    {
        $cityTime = Carbon::parse($this->city($citySlug)['currentTimeWithSeconds']);
        $sentTime = Carbon::parse($formattedTime);
        $diffHours = $cityTime->diffInHours($sentTime, false);
        $timeZone = TimezoneDetail::where('name_slug', $timezoneSlug)->firstOrFail();
        $offset = $timeZone->timezone_offset;
        $offsetWithoutSign = $this->removeSign($offset);
        $hoursNumber = $this->getHoursFromOffset($offsetWithoutSign);
        $sign = $this->getSign($offset);
        $hoursNumberWithSign = (int)($sign . $hoursNumber);
        $adjustedTime = Carbon::now('UTC')->addHours($hoursNumberWithSign + $diffHours);
        return $adjustedTime->format('g A');
    }

    public function getDiffHoursBetweenZoneAndCity($request, $timezoneSlug, $citySlug = null)
    {
        if (!isset($citySlug)) {
            $country = $this->geoIPService->getCurrentCountry($request);
            if ($country) {
                $city = City::where('name', $country->capital)->first();
                if ($city) {
                    $citySlug = $city->slug;
                }
            }
        }
        if (!$citySlug) {
            return null;
        }
        $cityTime = Carbon::parse($this->city($citySlug)['currentTimeWithSeconds']);
        $zoneTime = Carbon::parse($this->timezoneDetails($timezoneSlug)['currentTimeWithSeconds']);

        return [
            'diffHours' => $cityTime->diff($zoneTime)->format('%R%H:%I'),
            'cityTime' => $cityTime,
            'zoneTime' => $zoneTime,
            'cityName' => $city->name,
        ];
    }
}
