<?php

namespace App\Imports;


use App\Models\Abbreviation;
use App\Models\AbbreviationLongName;
use App\Models\Gmt;
use App\Models\Slug;
use App\Models\Timezone;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AbbsImport implements ToModel, WithHeadingRow
{



        public function model(array $row)
    {
        // Validate the row to avoid undefined index errors
        if (empty($row) || !isset($row['name']) || !isset($row['long'])) {
            \Log::info("fail Zone : ");
            \Log::info($row);
            return null;
        }

        $slug = \Str::slug(preg_replace('/[^A-Za-z0-9+-]/', '', $row['name']));

        // Step 1: Remove unwanted characters
        $slug_long = preg_replace('/[^A-Za-z0-9\s]/', '', $row['long']);

        // Step 2: Replace spaces with dashes
            $slug_long = str_replace(' ', '-', $slug_long);

        // Optionally, you can also convert to lower case if needed
            $slug_long = strtolower($slug_long);



        if (Slug::where('slug', $slug_long)->exists()  ){
            $slug_long = $slug_long . '-' . $row['name'];
        }


        $abb = Abbreviation::firstOrCreate(
            [
                'name' => $row['name'],

            ],
            [
                'slug' => $slug,

            ]
        );

        $abbLong = AbbreviationLongName::firstOrCreate(
            [
                'abbreviation_id' => $abb->id,
                'name' => $row['long'],

            ],
            [
                'slug' => $slug_long,

            ]
        );


        if ($abb->wasRecentlyCreated) {
            // If the country was just created, create a corresponding slug
            Slug::create([
                'slug' => $slug,
                'model' => Abbreviation::class,
            ]);

            Slug::create([
                'slug' => $slug_long,
                'model' => AbbreviationLongName::class,
            ]);
        }



        return []; // Return the newly created city
    }



}
