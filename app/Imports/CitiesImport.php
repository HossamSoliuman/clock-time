<?php

namespace App\Imports;

use App\Models\City;
use App\Models\Country;
use App\Models\Slug;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CitiesImport implements ToModel, WithHeadingRow
{



        public function model(array $row)
        {
            // Validate the row to avoid undefined index errors
            if (empty($row) || !isset($row['city_ascii'], $row['iso2'], $row['iso3'])) {
                \Log::info("fail : ");
                \Log::info($row);
                return null; // Or handle it as needed
            }


            $country = Country::where('code', $row['iso2'])->first();

            if (!$country) {
                // If country not found with iso2, check with iso3
                \Log::info('Country Code Not Found for iso2: ' . $row['iso2'] . ' - Country: ' . $row['country']);

                $country = Country::where('code', $row['iso3'])->first();

                if (!$country) {
                    // Country not found with iso3, so create a new one
                    \Log::info('Country Code Not Found for iso3: ' . $row['iso3'] . ' - Country: ' . $row['country']);





                    $slug = \Str::slug($row['country']);



                    if (Slug::where('slug', $slug)->exists()  ){
                        $slug =  \Str::slug($row['country'] . '-' . $row['iso2']);
                    }

                    $country = Country::firstOrCreate(
                        [
                            'code' => $row['iso2'],
                            'name' => $row['country']
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



                } else {
                    // Country found with iso3
                    \Log::info('Country Code Found for iso3: ' . $row['iso3'] . ' - ID: ' . $country->id);
                }
            } else {
                // Country found with iso2
                \Log::info('Country Code Found for iso2: ' . $row['iso2'] . ' - ID: ' . $country->id);
            }

// Check and create slugs
            $slugs = [
                \Str::slug($row['city_ascii']),
                \Str::slug($row['city_ascii'] . '-' . $row['iso3']),
                \Str::slug($row['city_ascii'] . '-' . $row['iso2']),
                \Str::slug($row['city_ascii'] . '-' . $row['iso2'] . '-' . $row['country']),
            ];

            $city = [];
            foreach ($slugs as $slug) {
                // Check if slug already exists
                if (!Slug::where('slug', $slug)->exists() && !City::where('slug', $slug)->exists()) {
                    Slug::create([
                        'slug' => $slug,
                        'model' => City::class,
                    ]);

                    $type = null; // Default to null
                    if (strtolower($row['capital']) === 'primary') {
                        $type = 'CAPITAL';
                    } elseif (strtolower($row['capital']) === 'admin') {
                        $type = 'ADMIN';
                    }

                    // Create a new city instance
                    $city = City::create([
                        'country_id' => $country->id, // Use the found or newly created country ID
                        'name' => $row['city_ascii'],
                        'slug' => $slug,
                        'lat' => $row['lat'],
                        'lng' => $row['lng'],
                        'iso2' => $row['iso2'],
                        'iso3' => $row['iso3'],
                        'type' => $type,
                        'population' => $row['population'],
                    ]);

                    break; // Break after successfully creating the city
                } else {
                    \Log::info('City already exists: ' . $slug . ' -- City: ' . $row['city_ascii']);
                }
            }

            if (empty($city)) {
                \Log::info("record: " . $row['city'] . '-' . $row['city_ascii'] . '-' . $row['iso3']);
            }





            return []; // Return the newly created city
        }



}
