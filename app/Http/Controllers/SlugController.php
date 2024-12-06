<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Gmt;  // Assuming you have a Gmt model for the gmts table

class SlugController extends Controller
{
    /**
     * Display the adjusted time for a given timezone slug.
     */
    public function getTimeForGmt($slug)
    {
        // Step 1: Fetch the data from the database based on the slug
        $gmt = Gmt::where('slug', $slug)->first();

        // Step 2: If the time zone is found, process it
        if ($gmt) {
            // Extract the offset, e.g., "+01:00"
            $offset = $gmt->time_offset;

            // Step 3: Use Carbon to calculate the adjusted time based on the offset
            // Carbon now() gets the current UTC time
            $currentTime = Carbon::now('UTC');

            // Add the offset to the current time
            $adjustedTime = $currentTime->addHours($this->getHoursFromOffset($offset));

            // Step 4: Return or display the adjusted time
            return response()->json([
                'timezone' => $gmt->name,
                'slug' => $gmt->slug,
                'offset' => $gmt->time_offset,
                'adjusted_time' => $adjustedTime->toTimeString(),
            ]);
        } else {
            return response()->json([
                'error' => 'Timezone not found',
            ], 404);
        }
    }

    // Helper function to extract the hours from the offset string
    private function getHoursFromOffset($offset)
    {
        // Example: "+01:00" => 1
        $parts = explode(':', $offset);
        return (int)$parts[0];  // Return the hour part (e.g., 1 from "+01:00")
    }
}


