<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Abbreviation;
use App\Models\AbbreviationLongName;
use App\Models\City;
use App\Models\Gmt;
use App\Models\Slug;
use App\Models\Timezone;
use App\Models\TimezoneDetail;
use App\Models\IanaTimezone;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ConvertGmtTimeZoneController extends Controller
{
    public function fetchTimeZones(Request $request)
    {
        $search = $request->input('search');



        // Fetch GMT timezones with the search criteria
        $abb = Abbreviation::where('name', 'LIKE', "%{$search}%")
            ->take(10)
            ->get();


        // Fetch GMT timezones with the search criteria
        $tz_name = AbbreviationLongName::where('name', 'LIKE', "%{$search}%")
            ->take(10)
            ->get();


        // Fetch other time zones with the search criteria
        $timeZones = TimeZone::where('name', 'LIKE', "%{$search}%")
            ->take(10)
            ->get();

        // Merge results and format them
        $results = $abb->merge($timeZones)->merge($tz_name)->map(function ($zone) {
            // Check if the object is an instance of the Gmt model
            //            if ($zone instanceof Abbreviation) {
            //                return [
            //                    'id' => $zone->slug,
            //                    'text' => $zone->name
            //                ];
            //            }
            //            if ($zone instanceof AbbreviationLongName) {
            //                return [
            //                    'id' => $zone->slug,
            //                    'text' => $zone->name
            //                ];
            //            }

            // Handle time zone instances
            return [
                'id' => $zone->slug,
                'text' => $zone->name
            ];
        });

        return response()->json($results);
    }
    public function fetchTZ(Request $request)
    {


        $results = [];
        if (strlen($request->input('search')) > 0) {
            $search = $request->input('search');



            // Fetch other time zones with the search criteria
            $timeZones = TimeZone::where('name', 'LIKE', "%{$search}%")
                ->take(100)
                ->get();

            // Merge results and format them
            $results = $timeZones->map(function ($zone) {
                // Handle time zone instances
                return [
                    'id' => $zone->slug,
                    'text' => $zone->name
                ];
            });
        }
        return response()->json($results);
    }

    public function fetchAbb(Request $request)
    {
        $search = $request->input('search');
        $results = [];

        if (strlen($search) > 0) {
            $iana = IanaTimezone::where('iana_timezone', 'LIKE', "%{$search}%")

                ->get()
                ->map(function ($ianaItem) {
                    return [
                        'slug' => $ianaItem->slug,
                        'value' => $ianaItem->iana_timezone,
                    ];
                });

            $timezoneDetails = TimezoneDetail::where('name', 'LIKE', "%{$search}%")
                ->orWhere('timezone_long', 'LIKE', "%{$search}%")

                ->get()
                ->map(function ($timezoneDetail) {
                    return [
                        'slug' => $timezoneDetail->name_slug,
                        'value' => $timezoneDetail->name,
                    ];
                });

            $timezoneDetailsLong = TimezoneDetail::where('timezone_long', 'LIKE', "%{$search}%")

                ->get()
                ->map(function ($timezoneDetailsLongItem) {
                    return [
                        'slug' => $timezoneDetailsLongItem->long_slug,
                        'value' => $timezoneDetailsLongItem->timezone_long,
                    ];
                });

            $results = $iana->merge($timezoneDetails)->merge($timezoneDetailsLong);
        }

        return response()->json($results);
    }
    public function convertTzToTz(Request $request)
    {
        $timezone1 = TimezoneDetail::where('name_slug', $request->input('abb'))
            ->orWhere('long_slug', $request->input('abb'))
            ->first()
            ?? IanaTimezone::where('slug', $request->input('abb'))->first();

        $timezone2 = TimezoneDetail::where('name_slug', $request->input('tz'))
            ->orWhere('long_slug', $request->input('tz'))
            ->first()
            ?? IanaTimezone::where('slug', $request->input('tz'))->first();

        $result = [];

        if ($timezone1) {
            if ($timezone1 instanceof TimezoneDetail) {
                $offset1 = $timezone1->timezone_offset;
                $offsetWithoutSign1 = $this->removeSign($offset1);
                $hoursNumber1 = $this->getHoursFromOffset($offsetWithoutSign1);
                $sign1 = $this->getSign($offset1);
                $hoursNumberWithSign1 = (int)($sign1 . $hoursNumber1);
                $adjustedTime1 = Carbon::now('UTC')->addHours($hoursNumberWithSign1);

                $timezoneName1 = Str::upper($request->input('abb')) === Str::upper($timezone1->long_slug)
                    ? $timezone1->timezone_long
                    : $timezone1->name;
            } else {
                $offset1 = $timezone1->offset_std;
                $hoursNumber2 = $this->getHoursFromOffset($offset1);
                $adjustedTime1 = Carbon::now('UTC')->addHours($hoursNumber2);

                $timezoneName1 = $timezone1->iana_timezone;
            }

            $result['abb'] = $timezoneName1;
            $result['abb_time'] = $adjustedTime1->format('h:i A');
        } else {
            $result['abb'] = 'Not Found';
            $result['abb_time'] = 'empty';
        }

        if ($timezone2) {
            if ($timezone2 instanceof TimezoneDetail) {
                $offset2 = $timezone2->timezone_offset;
                $offsetWithoutSign2 = $this->removeSign($offset2);
                $hoursNumber2 = $this->getHoursFromOffset($offsetWithoutSign2);
                $sign2 = $this->getSign($offset2);
                $hoursNumberWithSign2 = (int)($sign2 . $hoursNumber2);
                $adjustedTime2 = Carbon::now('UTC')->addHours($hoursNumberWithSign2);

                $timezoneName2 = Str::upper($request->input('tz')) === Str::upper($timezone2->long_slug)
                    ? $timezone2->timezone_long
                    : $timezone2->name;
            } else {
                $offset2 = $timezone2->offset_std;
                $hoursNumber2 = $this->getHoursFromOffset($offset2);
                $adjustedTime2 = Carbon::now('UTC')->addHours($hoursNumber2);

                $timezoneName2 = $timezone2->iana_timezone;
            }

            $result['tz'] = $timezoneName2;
            $result['tz_name'] = $adjustedTime2->format('h:i A');
        } else {
            $result['tz'] = 'Not Found';
            $result['tz_time'] = 'empty';
        }

        return response()->json($result);
    }


    public function getIanaTime($offset)
    {
        $offsetWithoutSign = $this->removeSign($offset);

        $hoursNumber = $this->getHoursFromOffset($offsetWithoutSign);

        $sign = $this->getSign($offset);

        $hoursNumberWithSign = (int)($sign . $hoursNumber);

        return $adjustedTime = Carbon::now('UTC')->addHours($hoursNumberWithSign);
    }
    public function getTzTime($offset)
    {
        $offsetWithoutSign = $this->removeSign($offset);

        $hoursNumber = $this->getHoursFromOffset($offsetWithoutSign);

        $sign = $this->getSign($offset);

        $hoursNumberWithSign = (int)($sign . $hoursNumber);

        return $adjustedTime = Carbon::now('UTC')->addHours($hoursNumberWithSign);
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




    public function convertTime($zone1, $zone2, Request $request)
    {


        if (!empty($this->ShowModelBySlug($zone1)) && !empty($this->ShowModelBySlug($zone2))) {

            $model_1 = $this->ShowModelBySlug($zone1)['model'];
            $model_2 = $this->ShowModelBySlug($zone2)['model'];

            // Check if the model is an instance of Timezone or Gmt
            list($timeZone, $gmt, $firstResult) = $this->checkIfTheModelIsAnInstanceOfTimezoneOrGmt($model_1, $zone1);

            $data['first'] = $firstResult;

            // Check if the model is an instance of Timezone or Gmt
            list($timeZone, $gmt, $secondResult) = $this->checkIfTheModelIsAnInstanceOfTimezoneOrGmt($model_2, $zone2);
            $data['second'] = $secondResult;

            return view('front.convert-result-time')->with('data', $data);
        } else {
            // if empty one of model

            abort(404);
            return view('front.convert-result-gmt')->with('data', $data);
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


    public function gmtResult($gmt)
    {

        $dateTimeInOffset = $this->convertGmtStringToDateTime($gmt->name);

        return  [

            'date' => $dateTimeInOffset->format('Y-m-d '),
            'time' => $dateTimeInOffset->format(' H:i:s'),
            'data' => $gmt
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
        $gmt = [];
        $result = [];

        if ($model == 'App\Models\Timezone') {

            $timeZone = Timezone::where('slug', $slug)
                ->with('gmt')
                ->first();


            foreach ($timeZone->gmt as $gmt) {

                $result['timezone'][] = $this->gmtResult($gmt);
            }

            $result['compare'] = $timeZone;
        } elseif ($model == 'App\Models\Abbreviation') {
            $gmt = Abbreviation::where('slug', $slug)->first();

            $result["gmt"] = $this->gmtResult($gmt);
            $result['compare'] = $gmt;
        } elseif ($model == 'App\Models\AbbreviationLongName') {
            $gmt = AbbreviationLongName::where('slug', $slug)->first();

            $result["gmt"] = $this->gmtResult($gmt);
            $result['compare'] = $gmt;
        } elseif ($model == 'App\Models\Gmt') {
            $gmt = Gmt::where('slug', $slug)->first();

            $result["gmt"] = $this->gmtResult($gmt);
            $result['compare'] = $gmt;
        }

        return array($timeZone, $gmt, $result);
    }


    /**
     * @throws \DateMalformedStringException
     * @throws \DateInvalidTimeZoneException
     */
    public function convertAbbTz(Request $request)
    {


        $abb             = Abbreviation::with('timezones')->where('slug', $request->input('abb'))->first();
        $abb_long        = AbbreviationLongName::with('abbreviation.timezones')->where('slug', $request->input('abb'))->first();

        $data = [];
        $timezoneRelation = '';
        if ($abb) {
            $data = $abb;
            $timezoneRelation = $abb->timezones->first()->name;
        }
        if ($abb_long) {
            $data = $abb_long;
            $timezoneRelation = $abb_long->abbreviation->timezones->first()->name;
        }


        $timezone   = Timezone::where('slug', $request->input('tz'))->first();



        $result = [


            'abb'        =>  $data->name,
            'abb_time'   => (strlen($timezoneRelation) > 0) ? convertGmtStringToDateTime(getGmtOffset($timezoneRelation))['time'] : 'empty',

            'tz'         =>  $timezone->name,
            'tz_name'    =>  convertGmtStringToDateTime(getGmtOffset($timezone->name))['time'],



        ];

        return response()->json($result);
    }
}
