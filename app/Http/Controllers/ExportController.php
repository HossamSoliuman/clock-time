<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExportController extends Controller
{

    public function exportCountry(){


        // Get all countries
        $countries = Country::get();

        // Initialize CSV data with headers
        $csvData = [
            ['code','name','zoneName', 'gmtOffset', 'gmtOffsetName', 'abbreviation', 'tzName','capital','lat','lng','iso3']
        ];

        // Loop through each country and extract timezone data
        foreach ($countries as $country) {
            $d = json_decode($country->timezones, true);

            // Append each timezone data row to the CSV data array
            $csvData[] = [
                $country['iso2'],
                $country['name'],
                $d[0]['zoneName'],
                $d[0]['gmtOffset'],
                $d[0]['gmtOffsetName'],
                $d[0]['abbreviation'],
                $d[0]['tzName'],
                $country['capital'],
                $country['latitude'],
                $country['longitude'],
                $country['iso3'],
            ];
        }

        // Define the filename with the current timestamp
        $fileName = 'timezones_export_' . now()->format('Ymd_His') . '.csv';

        // Convert array to CSV format
        $filePath = storage_path('app/' . $fileName);
        $file = fopen($filePath, 'w');

        foreach ($csvData as $line) {
            fputcsv($file, $line);
        }
        fclose($file);

        // Return the CSV file as a download
        return response()->download($filePath)->deleteFileAfterSend(true);
    }

    public function exportGmt(){


        // Get all countries

        // Get all countries
        $countries = DB::table('countries')->get();

        // Initialize CSV data with headers
        $csvData = [
            ['name','dst']
        ];

        // Loop through each country and extract timezone data
        foreach ($countries as $country) {
            $d = json_decode($country->timezones, true);
            // Append each timezone data row to the CSV data array
            $csvData[] = [
                $this->calculate_gmt_offset($d[0]['gmtOffset']),
                '0',
            ];
        }

        // Define the filename with the current timestamp
        $fileName = 'gmt_export_' . now()->format('Ymd_His') . '.csv';

        // Convert array to CSV format
        $filePath = storage_path('app/' . $fileName);
        $file = fopen($filePath, 'w');

        foreach ($csvData as $line) {
            fputcsv($file, $line);
        }
        fclose($file);

        // Return the CSV file as a download
        return response()->download($filePath)->deleteFileAfterSend(true);
    }

    public function calculate_gmt_offset($seconds) {
        // Convert seconds to hours
        $gmt_offset = $seconds / 3600;

        // Clamp the gmt_offset to the range of -12 to 12
        if ($gmt_offset > 14) {
            $gmt_offset = 14;
        } elseif ($gmt_offset < -14) {
            $gmt_offset = -14;
        }

        // Format as GMT + or GMT -
   return $gmt_offset;
    }



    public function exportCapital(){


        // Get all countries
        $countries = Country::get();

        // Initialize CSV data with headers
        $csvData = [
//            ['code','name','iso3', 'gmtOffset', 'gmtOffsetName', 'abbreviation', 'tzName']
            ['city','city_ascii','lat','lng','country','iso2','iso3','admin_name','capital','population']
        ];



        // Loop through each country and extract timezone data
        foreach ($countries as $state) {
//            $d = json_decode($country->timezones, true);

            // Append each timezone data row to the CSV data array
            $csvData[] = [

                $state['capital'],
                $state['capital'],
                $state['latitude'],
                $state['longitude'],
                $state['iso2'],
                $state['iso2'],
                $state['iso3'],
                $state['capital'],
                'primary',
                '',

            ];
        }

        // Define the filename with the current timestamp
        $fileName = 'capital_' . now()->format('Ymd_His') . '.csv';

        // Convert array to CSV format
        $filePath = storage_path('app/' . $fileName);
        $file = fopen($filePath, 'w');

        foreach ($csvData as $line) {
            fputcsv($file, $line);
        }
        fclose($file);

        // Return the CSV file as a download
        return response()->download($filePath)->deleteFileAfterSend(true);
    }
    public function exportAdmin(){


        // Get all countries
        $states = DB::table('states')->get();

        // Initialize CSV data with headers
        $csvData = [
//            ['code','name','iso3', 'gmtOffset', 'gmtOffsetName', 'abbreviation', 'tzName']
            ['city','city_ascii','lat','lng','country','iso2','iso3','admin_name','capital','population']
        ];


        // Loop through each country and extract timezone data
        foreach ($states as $state) {
//            $d = json_decode($country->timezones, true);

            // Append each timezone data row to the CSV data array
            $csvData[] = [

                $state->name,
                $state->name,
                $state->latitude,
                $state->longitude,
                $state->country_code,
                $state->country_code,
                $state->iso2,
                $state->name,
                'admin',
                '',

            ];
        }

        // Define the filename with the current timestamp
        $fileName = 'Admin_' . now()->format('Ymd_His') . '.csv';

        // Convert array to CSV format
        $filePath = storage_path('app/' . $fileName);
        $file = fopen($filePath, 'w');

        foreach ($csvData as $line) {
            fputcsv($file, $line);
        }
        fclose($file);

        // Return the CSV file as a download
        return response()->download($filePath)->deleteFileAfterSend(true);
    }

    public function exportCities(){

// Get all state names and country codes
//        $stateNamesAndCodes = DB::table('states')->select('name', 'country_code')->get();

// Start a query for cities
        $citiesWithoutStateNameAndCode = DB::table('cities')->get();
//
//// Apply a where condition to exclude each (name, country_code) combination
//        foreach ($stateNamesAndCodes as $state) {
//            $citiesWithoutStateNameAndCode->where(function($query) use ($state) {
//                $query->where('name', '!=', $state->name);
//                $query->where('country_code', '!=', $state->country_code);
//            });
//        }
//
//// Execute the query
//        $citiesWithoutStateNameAndCode = $citiesWithoutStateNameAndCode->get();

        // Initialize CSV data with headers
        $csvData = [
            ['city','city_ascii','lat','lng','country','iso2','iso3','admin_name','capital','population']
        ];

        // Loop through each country and extract timezone data
        foreach ($citiesWithoutStateNameAndCode as $state) {
//            $d = json_decode($country->timezones, true);

            // Append each timezone data row to the CSV data array
            $csvData[] = [

                $state->name,
                $state->name,
                $state->latitude,
                $state->longitude,
                $state->country_code,
                $state->country_code,
                $state->state_code,
                $state->name,
                '',
                '',

            ];
        }

        // Define the filename with the current timestamp
        $fileName = 'city_' . now()->format('Ymd_His') . '.csv';

        // Convert array to CSV format
        $filePath = storage_path('app/' . $fileName);
        $file = fopen($filePath, 'w');

        foreach ($csvData as $line) {
            fputcsv($file, $line);
        }
        fclose($file);

        // Return the CSV file as a download
        return response()->download($filePath)->deleteFileAfterSend(true);
    }

}
