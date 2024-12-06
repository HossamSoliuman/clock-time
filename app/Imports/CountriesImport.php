<?php

namespace App\Imports;

use App\Models\City;
use App\Models\Country;
use App\Models\Slug;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CountriesImport implements ToModel, WithHeadingRow
{



        public function model(array $row)
    {
        // Validate the row to avoid undefined index errors
        if (empty($row) || !isset($row['code'])) {
            \Log::info("fail country : ");
            \Log::info($row);
            return null;
        }

            $slug = \Str::slug($row['name']);



            if (Slug::where('slug', $slug)->exists()  ){
                $slug =  \Str::slug($row['name'] . '-' . $row['code']);
            }

        $country = Country::firstOrCreate(
            [
                'code' => $row['code'],
                'name' => $row['name'],
                'lat' => $row['lat'],
                'lng' => $row['lng'],
            ],
            [
                'slug' => $slug
            ]
        );


            if ($country->wasRecentlyCreated) {
                // If the country was just created, create a corresponding slug
                Slug::create([
                    'slug' => $slug,
                    'model' => Country::class,
                ]);
            }





        return []; // Return the newly created city
    }



}
