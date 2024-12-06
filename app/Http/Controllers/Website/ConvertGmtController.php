<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Gmt;
use App\Models\Slug;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;

class ConvertGmtController extends Controller
{
    public function convertTime($gmt, $timezone, Request $request)
    {


        // Get the 'code' parameter from the request if needed
//        $time= $request->input('time');




        $gmt = Gmt::where('slug', $gmt)->first();
        $gmt2 = Gmt::where('slug', $timezone)->first();

        $dateTimeInOffset = $this->convertGmtStringToDateTime($gmt->name);
        $dateTimeInOffset2 = $this->convertGmtStringToDateTime($gmt2->name);
        $data["result_1"] =
            [
                'date' =>$dateTimeInOffset->format('Y-m-d '),
                'time' =>$dateTimeInOffset->format(' H:i:s'),
                'data'=>$gmt
            ];
        $data["result_2"] =
            [
                'date' =>$dateTimeInOffset2->format('Y-m-d'),
                'time' =>$dateTimeInOffset2->format('H:i:s'),
                'data'=>$gmt2
            ];





        // Return a view or JSON response based on your needs
        // Assuming you have a view named 'convert-result'
        return view('front.convert-result-gmt')->with('data', $data);
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

// Function to convert GMT string to DateTime
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

    //Ajax list
    public function fetchGmt(Request $request)
    {
        $search = $request->input('search');

        // Fetch GMT timezones with the search criteria
        $gmts = Gmt::where('name', 'LIKE', "%{$search}%")
            ->orWhere('utc_name', 'LIKE', "%{$search}%")
            ->take(10)
            ->get();



        // Merge results and format them
        $results = $gmts->map(function($zone) {

            $dst = ($zone->dst =='no')?'NO':'YES';
            return [
                'id' => $zone->slug,
                'text' => $zone->name . " | " . $zone->utc_name . " | " . "  DST : " .$dst
            ];
        });

        return response()->json($results);
    }
}
