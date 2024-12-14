<?php

namespace App\Http\Controllers;

use App\Models\Abbreviation;
use App\Models\AbbreviationLongName;
use App\Models\City;
use App\Models\Country;
use App\Models\Gmt;
use App\Models\Slug;
use App\Models\IanaTimezone;
use App\Models\TimezoneDetail;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Str;


class HomeController extends Controller
{

    public function index()
    {
        $citiesName = [
            'berlin',
            'dubai',
            'London',
            'new york',
            'Paris',
            'Riyadh',
            'Singapore',
            'sydney',
            'Tokyo'
        ];

        $capitalCities = City::whereIn('name', $citiesName)->get();

        foreach ($capitalCities as $key => $city) {

            $timezone = $city->timezone ?? null;
            if ($timezone) {
                $country = Country::where('capital', $city->name)->first();
                $city->countrySlug = $country->slug ?? '';
                $city->currentTime = Carbon::now()->timezone($timezone)->format('h:i');
                $city->currentTimeWithSecond = Carbon::now()->timezone($timezone)->format('H:i:s');
                $city->identify = Carbon::now()->timezone($timezone)->format('A');
                $city->dayOfWeek = Carbon::now()->timezone($timezone)->format('l');
                $city->image = asset('public/images/country/' . strtolower(str_replace(' ', '-', $city->name)) . '.jpg');
            } else {
                unset($capitalCities[$key]);
            }
        }


        $data['capital'] = $capitalCities;

        $title = "What time now";
        $description = "What time is it now? Get precise time information for any location in the world. Use our reliable clock to stay on schedule.";
        $keywords = "time, clock, world time, world clocks, time now, clock with world time, clock time, world clock, current time, world global clock, clocks, time zone, date and time, timestamp, system time, server time, real-time, standard time, daylight saving time, timekeeping, time management, time measurement, time calculation, clocks on time, current times, time a clock, time the clock, time regions, Real-Time Clock, current time, time in clock, what time is, what is time, what time is it, the time, time right now, on clock, clocks of the world";

        return view('front.index', compact('title', 'description', 'keywords', 'data'));
    }

    // protected $fillable = ['name', 'slug','code','capital','nationality','weight'];

    public function country($slug)
    {

        try {

            $country = Country::where('slug', $slug)->firstOrFail();

            $capital = City::where('name', $country->capital)->firstOrFail();
            $IanaTimezone = IanaTimezone::where('iana_timezone', $capital->timezone)->first();

            $majorCities = City::where('country', $country->name)
                ->orderByDesc('score')
                ->take(9)
                ->get();

            foreach ($majorCities as $key => $city) {
                try {
                    $timezone = $city->timezone ?: $capital->timezone;
                    $city->currentTime = Carbon::now()->timezone($timezone)->format('h:i');
                    $city->currentTimeWithSecond = Carbon::now()->timezone($timezone)->format('H:i:s');
                    $city->identify = Carbon::now()->timezone($timezone)->format('A');
                    $city->dayOfWeek = Carbon::now()->timezone($timezone)->format('l');
                } catch (\Exception $e) {
                    unset($majorCities[$key]);
                }
            }


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

            $date = [
                'time' => $adjustedTime->format('h:i'),
                'timewithSeconds' => $adjustedTime->format('h:i:s'),
                'identify' => $adjustedTime->format('A'),
                'currentTimeWithSeconds' => $adjustedTime->format('H:i:s'),
                'formatted_date' => $adjustedTime->format('D, j-M-Y'),
                'utc' => $currentTimeUTC->format('h:i'),
                'utcWithSeconds' => $currentTimeUTC->format('H:i:s'),
                'utcIdentify' => $currentTimeUTC->format('A'),
            ];


            $title = $country->name . " time now ";

            $description = 'Looking for the precise clock time in ' . $country->name .
                ' ? Our website provides the accurate current time in ' . $country->name .
                ' No more guessing or calculations.';

            $keywords = $country->name . " time, clock,  time,  clocks,times of  , prayers,salah time,athan time  ,azan time ,now  time,current time in  ,local time in  ,present time in  ,sunrise in  ,salah time in ,sunsets in  ,time in  right now, clock,now  ,date and time in  ,local time in  ,time in  just now, exact time";

            return view('front.country', [
                'type' => 'country',
                'capital' => $capital,
                'name' => $country->name,
                'cities' => $majorCities,
                'timezoneSlug' => $IanaTimezone->slug,
                'title' => $title,
                'description' => $description,
                'keywords' => $keywords,
                'date' => $date,
                'timezoneName' => $country->name,
                'offset' => $offset,
                'hoursWithSign' => $hoursWithSign,
                'sign' => $sign,
                'hours' => $hours,
                'hoursNumber' => $hoursWithoutSign,
                'slug' => $slug,
            ]);

            Log::error('HomeController.country : ' . ' No Capital For this Slug : ' . $slug);
            return redirect('not-found');
        } catch (ModelNotFoundException $e) {
            Log::error('HomeController.country : ' . $e->getMessage());
            return response()->json(['message' => 'Resource not found' . $e->getMessage()], 404);
        }
    }

    public function city($slug)
    {
        try {
            $city = City::whereSlug($slug)->firstOrFail();
            $country = country::where('name', $city->country)->firstOrFail();
            $similarCities = City::where('country', $city->country)
                ->orderByDesc('score')
                ->take(9)
                ->get();
            $IanaTimezone = IanaTimezone::where('iana_timezone', Str::replace(' ', '', $city->timezone))->first();
            foreach ($similarCities as $key => $similarCity) {
                try {
                    $timezone = $city->timezone;
                    $similarCity->currentTime = Carbon::now()->timezone($timezone)->format('h:i');
                    $similarCity->currentTimeWithSecond = Carbon::now()->timezone($timezone)->format('H:i:s');
                    $similarCity->identify = Carbon::now()->timezone($timezone)->format('A');
                    $similarCity->dayOfWeek = Carbon::now()->timezone($timezone)->format('l');
                } catch (\Exception $e) {
                    unset($similarCities[$key]);
                }
            }
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
                'time' => $adjustedTime->format('h:i'),
                'timewithSeconds' => $adjustedTime->format('h:i:s'),
                'identify' => $adjustedTime->format('A'),
                'currentTimeWithSeconds' => $adjustedTime->format('H:i:s'),
                'formatted_date' => $adjustedTime->format('D, j-M-Y'),
                'utc' => $currentTimeUTC->format('h:i'),
                'utcWithSeconds' => $currentTimeUTC->format('H:i:s'),
                'utcIdentify' => $currentTimeUTC->format('A'),
            ];

            $title = $city->name . " time now ";

            $description = 'Looking for the precise clock time in ' . $city->name .
                ' ? Our website provides the accurate current time in ' . $city->name .
                ' No more guessing or calculations.';

            $keywords = $city->name . " time, clock,  time,  clocks,times of  , prayers,salah time,athan time  ,azan time ,now  time,current time in  ,local time in  ,present time in  ,sunrise in  ,salah time in ,sunsets in  ,time in  right now, clock,now  ,date and time in  ,local time in  ,time in  just now, exact time";

            return view('front.city', [
                'type' => 'city',
                'country' => $country,
                'cities' => $similarCities,
                'timezoneSlug' => $IanaTimezone->slug,
                'name' => $city->name,
                'title' => $title,
                'description' => $description,
                'keywords' => $keywords,
                'date' => $date,
                'ogImage' => '',
                'ogImageAlt' => '',
                'imageUrl' => '',
                'timezoneName' => $city->name,
                'timezone' => $city->timezone,
                'offset' => $offset,
                'hoursWithSign' => $hoursWithSign,
                'sign' => $sign,
                'hours' => $hours,
                'hoursNumber' => $hoursWithoutSign,
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Resource not found: ' . $e->getMessage()], 404);
        }
    }


    public function timezone($slug)
    {
        $timeZone = IanaTimezone::where('slug', $slug)
            ->firstOrFail();


        $offset = $timeZone->offset_std;


        $hoursNumber = $this->getHoursFromOffset($offset);
        $adjustedTime = Carbon::now('UTC')->addHours($hoursNumber);

        $currentTimeUTC = Carbon::now('UTC');


        $timezoneName = $timeZone->iana_timezone;

        $name = $timezoneName . " Time Now";

        $date = [
            'time' => $adjustedTime->format('h:i'),
            'timewithSeconds' => $adjustedTime->format('h:i:s'),
            'identify' => $adjustedTime->format('A'),
            'currentTimeWithSeconds' => $adjustedTime->format('H:i:s'),
            'formatted_date' => $adjustedTime->format('D, j-M-Y'),
            'utc' => $currentTimeUTC->format('h:i'),
            'gmt' => $currentTimeUTC->format('h:i'),
            'utcWithSeconds' => $currentTimeUTC->format('H:i:s'),
            'utcIdentify' => $currentTimeUTC->format('A'),
        ];

        $hoursWithoutSign = $this->removeSign($hoursNumber);
        $hours = $this->convertDecimalToTime($hoursWithoutSign);
        $sign = $this->getSign($offset);
        $hoursWithSign = $this->getHoursFromOffsetWithSign($offset);


        $description = 'Discover everything about the ' . $timezoneName . ' time zone, including its current time, UTC offset, and countries that observe ' . $timezoneName . ' time zone.';
        $keywords = $timezoneName . " Zone  , time, clock,  time,  clocks,times of  , prayers,salah time,athan time ,azan time ,now  time,current time in ,local time in  ,present time in  ,sunrise in  ,salah time in ,sunsets in  ,time in  right now, clock,now  ,date and time in  ,local time in  ,time in  just now, exact time";
        $ogImage = 'https://theclocktime.com/images/time-zone.jpg';
        $ogImageAlt = 'Time Zone';
        $imageUrl = 'public/images/TimeZone.jpg';

        return view('front.timezone', [
            'title' => $name,
            'description' => $description,
            'keywords' => $keywords,
            'ogImage' => $ogImage,
            'ogImageAlt' => $ogImageAlt,
            'imageUrl' => $imageUrl,
            'date' => $date,
            'timezoneName' => $timezoneName,
            'offset' => $offset,
            'hoursWithSign' => $hoursWithSign,
            'sign' => $sign,
            'hours' => $hours,
            'hoursNumber' => $hoursWithoutSign,
        ]);
    }


    public function abbreviation($slug)
    {
        $timezone = TimezoneDetail::where('name_slug', $slug)->orWhere('long_slug', $slug)->first();


        if ($timezone) {
            $offset = $timezone->timezone_offset;

            $offsetWithoutSign = $this->removeSign($offset);

            $hoursNumber = $this->getHoursFromOffset($offsetWithoutSign);

            $sign = $this->getSign($offset);

            $hoursNumberWithSign = (int)($sign . $hoursNumber);

            $adjustedTime = Carbon::now('UTC')->addHours($hoursNumberWithSign);

            $currentTimeUTC = Carbon::now('UTC');

            if (Str::upper($slug) == Str::upper($timezone->long_slug)) {
                $timezoneName = $timezone->timezone_long;
            } else {
                $timezoneName = $timezone->name;
            }
            $timezoneNameLong = $timezone->timezone_long;
            $name = $timezoneName . " Time Now";

            $date = [
                'time' => $adjustedTime->format('h:i'),
                'timewithSeconds' => $adjustedTime->format('h:i:s'),
                'identify' => $adjustedTime->format('A'),
                'currentTimeWithSeconds' => $adjustedTime->format('H:i:s'),
                'formatted_date' => $adjustedTime->format('D, j-M-Y'),
                'utc' => $currentTimeUTC->format('h:i'),
                'gmt' => $currentTimeUTC->format('h:i'),
                'utcWithSeconds' => $currentTimeUTC->format('H:i:s'),
                'utcIdentify' => $currentTimeUTC->format('A'),
            ];

            $hoursNumberWithoutSign = $this->removeSign($hoursNumber);
            $hoursTime = $this->convertDecimalToTime($hoursNumberWithoutSign);
            $sign = $this->getSign($offset);
            $hoursWithSign = $this->getHoursFromOffsetWithSign($offset);

            return view('front.timezone', [
                'title' => $name,
                'description' => "Discover everything about the {$timezoneName} time zone, including its current time, UTC offset, and the countries that observe {$timezoneName}.",
                'keywords' => "{$timezoneName} time, clock, zone, current time in {$timezoneName}, local time in {$timezoneName}, salah time, azan time, sunrise, sunset, exact time, date and time",
                'countries' => [],
                'ogImage' => 'https://theclocktime.com/images/TimeZone.jpg',
                'ogImageAlt' => 'TimeZone',
                'date' => $date,
                'timezoneName' => $timezoneName,
                'timezoneNameLong' => $timezoneNameLong,
                'offset' => $offset,
                'hoursWithSign' => $hoursWithSign,
                'sign' => $sign,
                'hours' => $hoursTime,
                'hoursNumber' => $hoursNumberWithoutSign,
            ]);
        } else {
            return redirect('/');
        }
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

            $name = $timezoneName . ' Time Now';
            $date = [
                'time' => $adjustedTime->format('h:i'),
                'timewithSeconds' => $adjustedTime->format('h:i:s'),
                'identify' => $adjustedTime->format('A'),
                'currentTimeWithSeconds' => $adjustedTime->format('H:i:s'),
                'formatted_date' => $adjustedTime->format('D, j-M-Y'),
                'utc' => $currentTimeUTC->format('h:i'),
                'gmt' => $currentTimeUTC->format('h:i'),
                'utcWithSeconds' => $currentTimeUTC->format('H:i:s'),
                'utcIdentify' => $currentTimeUTC->format('A'),
            ];

            $decemalHours = $this->getHoursFromOffset($offset);
            $decemalHours = $this->removeSign($decemalHours);
            $hours = $this->convertDecimalToTime($decemalHours);
            $sign = $this->getSign($offset);
            $hoursWithSign = $this->getHoursFromOffsetWithSign($offset);
            return view('front.timezone', [
                'title' => $name,
                'description' => $isUTC
                    ? "Find the current time in Coordinated Universal Time (UTC) {$gmt->utc_name}. Discover the time difference between {$gmt->utc_name} and other time zones, UTC offset, and countries."
                    : "Find the current time in Greenwich Mean Time (GMT) {$gmt->name}. Discover the time difference between {$gmt->name} and other time zones, UTC offset, and countries.",

                'keywords' => $isUTC
                    ? "{$gmt->utc_name} time, UTC clock, UTC zone, current time in UTC, Coordinated Universal Time, UTC offset, sunrise in UTC, sunset in UTC, date and time in UTC"
                    : "{$gmt->name} time, clock, zone, current time in {$gmt->name}, local time in {$gmt->name}, salah time, azan time, sunrise, sunset, exact time, date and time",
                'countries' => countryDate($adjustedTime->format('H:i'), $gmt->countries->unique()),
                'ogImage' => $isUTC
                    ? 'https://theclocktime.com/images/UTC.jpg'
                    : 'https://theclocktime.com/images/GMT.jpg',
                'ogImageAlt' => $isUTC ? 'UTC' : 'GMT',
                'date' => $date,
                'isUTC' => $isUTC,
                'imageUrl' => $isUTC ? 'public/images/UTC.jpg' : 'public/images/GMT.jpg',
                'timezoneName' => $timezoneName,
                'offset' => $offset,
                'hours' => $hours,
                'hoursWithSign' => $hoursWithSign,
                'sign' => $sign,
                'hoursNumber' => $decemalHours,

            ]);
        } else {
            return redirect('/');
        }
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



    public function showBySlug($slug)
    {
        $slugEntry = Slug::where('slug', $slug)->first();

        if (!$slugEntry) {
            return redirect('not-found');
        }

        $methodsCAll = [
            'App\Models\Country' => "country",
            'App\Models\City' => "city",
            'App\Models\Timezone' => "timezone",
            'App\Models\Abbreviation' => "abbreviation",
            'App\Models\AbbreviationLongName' => "abbreviation",
            'App\Models\Gmt' => "gmt",
        ];

        if (array_key_exists($slugEntry->model, $methodsCAll)) {
            return $this->{$methodsCAll[$slugEntry->model]}($slugEntry->slug);
        }

        return response()->json(['message' => 'Model not found'], 404);
    }
}
