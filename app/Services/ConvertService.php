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

        $zoneTime = Carbon::parse($this->timezoneDetails($timezoneSlug)['currentTimeWithSeconds'])->timestamp;
        $cityTime = Carbon::parse($this->city($citySlug)['currentTimeWithSeconds'])->timestamp;

        $diffHours = ($zoneTime - $cityTime) / 3600;

        if ($diffHours > 12) {
            $diffHours = 24 - $diffHours;
        } elseif ($diffHours < -12) {
            $diffHours = 24 + $diffHours;
        }

        $diffHours = $cityTime > $zoneTime ? $diffHours : -$diffHours;

        return [
            'diffHours' => round($diffHours),
            'cityTime' => Carbon::createFromTimestamp($cityTime)->format('g:i A'),
            'zoneTime' => Carbon::createFromTimestamp($zoneTime)->format('g:i A'),
            'cityName' => $city->name,
        ];
    }
}
