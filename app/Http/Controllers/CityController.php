<?php

namespace App\Http\Controllers;


use App\Jobs\ImportAbbsJob;
use App\Jobs\ImportCitiesJob;
use App\Jobs\ImportCountriesJob;
use App\Jobs\ImportGmtsJob;
use App\Jobs\ImportRelationJob;
use App\Jobs\ImportZonesJob;
use App\Models\City;
use App\Models\Gmt;
use App\Models\Timezone;
use App\Models\Country;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CitiesImport;
use Exception;

class CityController extends Controller
{

    public function fetchAll(Request $request)
    {


        $results = [];


        if (strlen($request->input('search')) > 0) {
            $searchTerm = $request->input('search');
            $cities = City::query();

            // Prioritize cities that start with the search term
            $cities->where('name', 'like', $searchTerm . '%')
                ->orWhere('name', 'like', '%' . $searchTerm . '%')
                ->orderByRaw("CASE WHEN name LIKE ? THEN 0 ELSE 1 END", [$searchTerm . '%']);

            // Limit the results to 100
            $cities = $cities->take(10)->get();

            // Merge results and format them
            $results = $cities->map(function ($city) {
                return [
                    'slug' => $city->slug,
                    'value' => $city->name . ' / ' . $city->country,
                ];
            });
        }



        return response()->json($results);
    }

    public function fetchAllPlanner(Request $request)
    {


        $results = [];
        $cities = City::query();

        if (strlen($request->input('search')) > 0) {
            $searchTerm = $request->input('search');


            // Prioritize cities that start with the search term
            $cities->where('name', 'like', $searchTerm . '%')
                ->orWhere('name', 'like', '%' . $searchTerm . '%')
                ->orderByRaw("CASE WHEN name LIKE ? THEN 0 ELSE 1 END", [$searchTerm . '%']);
        }

        // Limit the results to 100
        $cities = $cities->take(100)->get();

        // Merge results and format them
        $results = $cities->map(function ($city) {
            return [
                'id' => $city->slug,
                'text' => $city->name . ' / ' . $city->country->name,
            ];
        });

        return response()->json($results);
    }

    public function ByCountry(Request $request)
    {
        $cities = City::query();
        $country = Country::where('slug', $request->country_slug)->first();
        if (strlen($request->input('search')) > 0) {
            $cities->where('name', 'like', '%' . $request->input('search') . '%');
        }
        $cities =  $cities->where('country', $country->name)
            ->take(10)->get();

        $results = $cities->map(function ($city) {
            return [
                'slug' => $city->slug,
                'value' => $city->country . ' / ' . $city->name
            ];
        });



        return response()->json($results);
    }


    public function upload(Request $request): \Illuminate\Http\RedirectResponse
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:100048', // Max size 2MB
        ]);

        try {

            // Store the uploaded file temporarily
            $filePath = $request->file('file')->store('imports');

            // Dispatch the job to the queue
            ImportCitiesJob::dispatch($filePath);
            return redirect()->back()->with('success', 'Cities import job has been dispatched.');
        } catch (Exception $e) {
            // Handle any errors during the import
            return redirect()->back()->with('error', 'Error importing data: ' . $e->getMessage());
        }
    }

    public function country(Request $request): \Illuminate\Http\RedirectResponse
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:7048', // Max size 2MB
        ]);

        try {

            // Store the uploaded file temporarily
            $filePath = $request->file('file')->store('imports');

            // Dispatch the job to the queue
            ImportCountriesJob::dispatch($filePath);
            return redirect()->back()->with('success', 'Countries import job has been dispatched.');
        } catch (Exception $e) {
            // Handle any errors during the import
            return redirect()->back()->with('error', 'Error importing data: ' . $e->getMessage());
        }
    }
    public function gmt(Request $request): \Illuminate\Http\RedirectResponse
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:6048', // Max size 2MB
        ]);

        try {

            // Store the uploaded file temporarily
            $filePath = $request->file('file')->store('imports');

            // Dispatch the job to the queue
            ImportGmtsJob::dispatch($filePath);
            return redirect()->back()->with('success', 'Gmt import job has been dispatched.');
        } catch (Exception $e) {
            // Handle any errors during the import
            return redirect()->back()->with('error', 'Error importing data: ' . $e->getMessage());
        }
    }
    public function abb(Request $request): \Illuminate\Http\RedirectResponse
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:6048', // Max size 2MB
        ]);

        try {

            // Store the uploaded file temporarily
            $filePath = $request->file('file')->store('imports');

            // Dispatch the job to the queue
            ImportAbbsJob::dispatch($filePath);
            return redirect()->back()->with('success', 'Cities import job has been dispatched.');
        } catch (Exception $e) {
            // Handle any errors during the import
            return redirect()->back()->with('error', 'Error importing data: ' . $e->getMessage());
        }
    }
    public function zone(Request $request): \Illuminate\Http\RedirectResponse
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:6048', // Max size 2MB
        ]);

        try {

            // Store the uploaded file temporarily
            $filePath = $request->file('file')->store('imports');

            // Dispatch the job to the queue
            ImportZonesJob::dispatch($filePath);
            return redirect()->back()->with('success', 'Cities import job has been dispatched.');
        } catch (Exception $e) {
            // Handle any errors during the import
            return redirect()->back()->with('error', 'Error importing data: ' . $e->getMessage());
        }
    }
    public function relation(Request $request): \Illuminate\Http\RedirectResponse
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:7048', // Max size 2MB
        ]);

        try {

            // Store the uploaded file temporarily
            $filePath = $request->file('file')->store('imports');

            // Dispatch the job to the queue
            ImportRelationJob::dispatch($filePath);
            return redirect()->back()->with('success', 'Relation import job has been dispatched.');
        } catch (Exception $e) {
            // Handle any errors during the import
            return redirect()->back()->with('error', 'Error importing data: ' . $e->getMessage());
        }
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['time'] =  time();  // current Unix timestamp
        $data['microTime'] =  microtime(true);  // microtime returns timestamp with microseconds (param: true=float, false=string)

        // Example usage with the provided timestamp 1727949600
        $timestamp = -1830383032;
        $data['fullFormate'] =  $this->formatDateTime($timestamp);

        $data['unix'] =  $this->getOffsets($timestamp);

        $epoch = -1830383032;
        $data['date'] =  date('r', $epoch); // output as RFC 2822 date - returns local time
        $data['gmdate'] =  gmdate('r', $epoch); // returns GMT/UTC time: Sun, 01 Jan 2017 00:00:00 +0000
        dd($data);
    }


    function formatDateTimeWithDynamicGMT($timestamp)
    {
        // Create a new DateTime object from the provided timestamp
        $date = new DateTime();
        $date->setTimestamp($timestamp);

        // Set the timezone to GMT+02:00 (or any desired timezone)
        $timezone = new DateTimeZone('Etc/GMT-2');  // Negative sign for GMT+2
        $date->setTimezone($timezone);

        // Get the offset in seconds
        $offset = $timezone->getOffset($date);

        // Convert offset from seconds to hours and minutes
        $hours = intdiv($offset, 3600);
        $minutes = abs(($offset % 3600) / 60);

        // Format the offset as GMT+HH:MM or GMT-HH:MM
        $formatted_offset = sprintf('GMT%+03d:%02d', $hours, $minutes);

        // Format the date in the desired format and append the GMT offset
        return $date->format('l, F j, Y g:i:s A') . " " . $formatted_offset;
    }



    function formatDateTime($timestamp)
    {
        // Create a new DateTime object from the provided timestamp
        $date = new DateTime();
        //        $date->setTimestamp($timestamp);

        // Set the timezone to GMT+02:00
        $timezone = new DateTimeZone('Etc/GMT-2');  // Negative sign for GMT+2
        $date->setTimezone($timezone);

        // Format the date in the desired format
        return $date->format('l, F j, Y g:i:s A \G\M\TP');
    }



    function getOffsets($timestamp)
    {
        // Create a new DateTime object from the provided timestamp
        $date = new DateTime();
        $date->setTimestamp($timestamp);

        // Set the timezone to GMT+02:00
        $timezone = new DateTimeZone('Etc/GMT-2');  // Negative sign for GMT+2
        $date->setTimezone($timezone);

        // Get the offset in seconds
        $offset = $timezone->getOffset($date);

        // Convert offset from seconds to hours and minutes
        $hours = intdiv($offset, 3600);
        $minutes = abs(($offset % 3600) / 60);

        // Format the offsets as GMT and UTC
        $formatted_gmt_offset = sprintf('GMT%+03d:%02d', $hours, $minutes);
        $formatted_utc_offset = sprintf('UTC%+03d:%02d', $hours, $minutes);

        // Return only the offsets
        return "$formatted_utc_offset, $formatted_gmt_offset";
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
