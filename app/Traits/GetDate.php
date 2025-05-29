<?php

namespace App\Traits;

use App\Models\City;
use App\Models\Country;
use App\Models\Gmt;
use App\Models\IanaTimezone;
use App\Models\TimezoneDetail;
use Carbon\Carbon;
use Illuminate\Support\Str;

trait GetDate
{
    public function city($slug)
    {
        $city = City::whereSlug($slug)->firstOrFail();

        $adjustedTime = Carbon::now()->timezone($city->timezone);
        $currentTimeUTC = Carbon::now('UTC');

        $offsetInSeconds = (new \DateTimeZone($city->timezone))->getOffset(new \DateTime('now', new \DateTimeZone('UTC')));
        $offset = $offsetInSeconds / 3600;
        $offset = ($offset > 0 ? '+' : '') . $offset;


        $hoursNumber = $this->getHoursFromOffset($offset);
        $hoursWithoutSign = $this->removeSign($hoursNumber);
        $hours = $this->convertDecimalToTime($hoursWithoutSign);
        $sign = $this->getSign($offset);
        $hoursWithSign = $this->getHoursFromOffsetWithSign($offset);
        $date = [
            'city' => $city,
            'time' => $adjustedTime->format('h:i'),
            'timewithSeconds' => $adjustedTime->format('h:i:s'),
            'identify' => $adjustedTime->format('A'),
            'currentTimeWithSeconds' => $adjustedTime->format('H:i:s'),
            'formatted_date' => $adjustedTime->format('D, j-M-Y'),
            'formatted_date_home' => $adjustedTime->format('D j M Y'),
            'utc' => $currentTimeUTC->format('h:i'),
            'utcWithSeconds' => $currentTimeUTC->format('H:i:s'),
            'utcIdentify' => $currentTimeUTC->format('A'),
            'timezone' => $city->timezone,
            'offset' => $offset,
            'hoursWithSign' => $hoursWithSign,
            'sign' => $sign,
            'hours' => $hours,
            'hoursNumber' => $hoursWithoutSign,

        ];
        return $date;
    }

    public function timezoneDetails($slug)
    {
        $timezone = TimezoneDetail::where('name_slug', $slug)->orWhere('long_slug', $slug)->first();

        if ($timezone) {
            $offset = $timezone->timezone_offset;

            $offsetWithoutSign = $this->removeSign($offset);

            $hoursNumber = $this->getHoursFromOffset($offsetWithoutSign);

            $sign = $this->getSign($offset);

            $hoursNumberWithSign = (int)($sign . $hoursNumber);

            $adjustedTime = Carbon::now('UTC')->addHours($hoursNumberWithSign);
            if (Str::upper($slug) == Str::upper($timezone->long_slug)) {
                $timezoneName = $timezone->timezone_long;
            } else {
                $timezoneName = $timezone->name;
            }
            $currentTimeUTC = Carbon::now('UTC');

            $sign = $this->getSign($offset);
            $hoursWithSign = $this->getHoursFromOffsetWithSign($offset);
            $hoursWithoutSign = $this->removeSign($hoursNumber);
            $hours = $this->convertDecimalToTime($hoursWithoutSign);

            return $date = [
                'time' => $adjustedTime->format('h:i'),
                'timewithSeconds' => $adjustedTime->format('h:i:s'),
                'identify' => $adjustedTime->format('A'),
                'currentTimeWithSeconds' => $adjustedTime->format('H:i:s'),
                'formatted_date' => $adjustedTime->format('D, j-M-Y'),
                'utc' => $currentTimeUTC->format('h:i'),
                'utcWithSeconds' => $currentTimeUTC->format('H:i:s'),
                'utcIdentify' => $currentTimeUTC->format('A'),
                'timezone' => $timezoneName,
                'offset' => $offset,
                'hoursWithSign' => $hoursWithSign,
                'sign' => $sign,
                'hours' => $hours,
                'hoursNumber' => $hoursWithoutSign,
                'name' => $timezone->name,
                'slug' => $timezone->name_slug
            ];
        }
    }
    public function ianaTimezone($slug)
    {
        $timeZone = IanaTimezone::where('slug', $slug)
            ->firstOrFail();


        $offset = $timeZone->offset_std;


        $hoursNumber = $this->getHoursFromOffset($offset);
        $adjustedTime = Carbon::now('UTC')->addHours($hoursNumber);

        $currentTimeUTC = Carbon::now('UTC');


        $timezoneName = $timeZone->iana_timezone;

        $hoursWithoutSign = $this->removeSign($hoursNumber);
        $hours = $this->convertDecimalToTime($hoursWithoutSign);
        $sign = $this->getSign($offset);
        $hoursWithSign = $this->getHoursFromOffsetWithSign($offset);
        return  $date = [
            'time' => $adjustedTime->format('h:i'),
            'timewithSeconds' => $adjustedTime->format('h:i:s'),
            'identify' => $adjustedTime->format('A'),
            'currentTimeWithSeconds' => $adjustedTime->format('H:i:s'),
            'formatted_date' => $adjustedTime->format('D, j-M-Y'),
            'utc' => $currentTimeUTC->format('h:i'),
            'utcWithSeconds' => $currentTimeUTC->format('H:i:s'),
            'utcIdentify' => $currentTimeUTC->format('A'),
            'timezone' => $timezoneName,
            'offset' => $offset,
            'hoursWithSign' => $hoursWithSign,
            'sign' => $sign,
            'hours' => $hours,
            'hoursNumber' => $hoursWithoutSign,
        ];
    }
    public function gmt($slug)
    {
        $gmt = Gmt::where('slug', $slug)
            ->orWhere('utc_slug', $slug)
            ->first();

        if ($gmt) {
            $offset = $gmt->time_offset;

            $adjustedTime = Carbon::now('UTC')->addHours($this->getHoursFromOffset($offset));

            $currentTimeUTC = Carbon::now('UTC');

            $upperSlug = Str::upper($slug);
            if ($upperSlug == $gmt->utc_slug) {
                $isUTC = 1;
                $timezoneName = $gmt->utc_name;
            } else {
                $isUTC = 0;
                $timezoneName = $gmt->name;
            }

            $decemalHours = $this->getHoursFromOffset($offset);
            $decemalHours = $this->removeSign($decemalHours);
            $hours = $this->convertDecimalToTime($decemalHours);
            $sign = $this->getSign($offset);
            $hoursWithSign = $this->getHoursFromOffsetWithSign($offset);
            $hoursWithoutSign = $this->removeSign($decemalHours);

            return $date = [
                'time' => $adjustedTime->format('h:i'),
                'timewithSeconds' => $adjustedTime->format('h:i:s'),
                'identify' => $adjustedTime->format('A'),
                'currentTimeWithSeconds' => $adjustedTime->format('H:i:s'),
                'formatted_date' => $adjustedTime->format('D, j-M-Y'),
                'utc' => $currentTimeUTC->format('h:i'),
                'utcWithSeconds' => $currentTimeUTC->format('H:i:s'),
                'utcIdentify' => $currentTimeUTC->format('A'),
                'timezone' => $timezoneName,
                'offset' => $offset,
                'hoursWithSign' => $hoursWithSign,
                'sign' => $sign,
                'hours' => $hours,
                'hoursNumber' => $hoursWithoutSign,
            ];
        }
    }
    public function country($slug)
    {
        $country = Country::where('slug', $slug)->firstOrFail();

        $capital = City::where('name', $country->capital)->firstOrFail();
        $IanaTimezone = IanaTimezone::where('iana_timezone', $capital->timezone)->first();


        $adjustedTime = Carbon::now()->timezone($capital->timezone);
        $currentTimeUTC = Carbon::now('UTC');

        $offsetInSeconds = (new \DateTimeZone($capital->timezone))->getOffset(new \DateTime('now', new \DateTimeZone('UTC')));
        $offset = $offsetInSeconds / 3600;
        $offset = ($offset > 0 ? '+' : '') . $offset;

        $hoursNumber = $this->getHoursFromOffset($offset);
        $hoursWithoutSign = $this->removeSign($hoursNumber);
        $hours = $this->convertDecimalToTime($hoursWithoutSign);
        $sign = $this->getSign($offset);
        $hoursWithSign = $this->getHoursFromOffsetWithSign($offset);

        return  $date = [
            'time' => $adjustedTime->format('h:i'),
            'timewithSeconds' => $adjustedTime->format('h:i:s'),
            'identify' => $adjustedTime->format('A'),
            'currentTimeWithSeconds' => $adjustedTime->format('H:i:s'),
            'formatted_date' => $adjustedTime->format('D, j-M-Y'),
            'utc' => $currentTimeUTC->format('h:i'),
            'utcWithSeconds' => $currentTimeUTC->format('H:i:s'),
            'utcIdentify' => $currentTimeUTC->format('A'),
            'timezone' => $country->name,
            'offset' => $offset,
            'hoursWithSign' => $hoursWithSign,
            'sign' => $sign,
            'hours' => $hours,
            'hoursNumber' => $hoursWithoutSign,
        ];
    }

    private function getHoursFromOffset($offset)
    {
        preg_match('/([+-]?\d+):?(\d{2})?/', $offset, $matches);
        $hours = (int)$matches[1];
        $minutes = isset($matches[2]) ? (int)$matches[2] / 60 : 0;
        return  $decimalHours = $hours + $minutes;
    }

    private function getHoursFromOffsetWithSign($timezone)
    {
        return Str::of($timezone)->substr(strpos($timezone, '+') === false && strpos($timezone, '-') === false ? 0 : (strpos($timezone, '+') === false ? strpos($timezone, '-') : strpos($timezone, '+')));
    }

    private function getSign($timezone)
    {
        return  Str::contains($timezone, '+') ? '+' : '-';
    }

    private function removeSign($hours)
    {
        return Str::remove(['-', '+'], $hours);
    }


    public function convertDecimalToTime($decimalHours)
    {
        $hours = floor($decimalHours);
        $minutes = round(($decimalHours - $hours) * 60);
        return sprintf('%d:%02d', $hours, $minutes);
    }
}
