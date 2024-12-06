<?php

namespace App\Imports;


use App\Models\Gmt;
use App\Models\Slug;
use App\Models\Timezone;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ZonesImport implements ToModel, WithHeadingRow
{



        public function model(array $row)
    {
        // Validate the row to avoid undefined index errors
        if (empty($row) || !isset($row['name'])) {
            \Log::info("fail Zone : ");
            \Log::info($row);
            return null;
        }

        $slug =\Str::slug( preg_replace('/[^A-Za-z0-9+-]/', '-', $row['name']));

        $sluga[] = $slug;
        \Log::info($slug);
        $zone = Timezone::firstOrCreate(
            [
                'name' => $row['name']
            ],
            [
                'slug' => $slug
            ]
        );


        if ($zone->wasRecentlyCreated) {
            // If the country was just created, create a corresponding slug
            Slug::create([
                'slug' => $slug,
                'model' => Timezone::class,
            ]);
        }



        return []; // Return the newly created city
    }



}
