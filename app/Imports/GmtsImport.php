<?php

namespace App\Imports;


use App\Models\Gmt;
use App\Models\Slug;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GmtsImport implements ToModel, WithHeadingRow
{



        public function model(array $row)
    {
        // Validate the row to avoid undefined index errors
        if (empty($row) || !isset($row['name'])) {
            \Log::info("fail Gmt : ");
            \Log::info($row);
            return null;
        }

        $gmt = 'GMT ' . (($row['name'] > 0) ? '+' . $row['name'] : $row['name']);
        $utc = 'UTC ' . (($row['name'] > 0) ? '+' . $row['name'] : $row['name']);
        $dst = ($row["dst"]==0)?'no':'yes';

        $slug = preg_replace('/[^A-Za-z0-9+-]/', '', \Str::lower($gmt));
        $utc_slug = preg_replace('/[^A-Za-z0-9+-]/', '', \Str::lower($utc));

        if (Slug::where('slug', $slug)->exists()  ){
            $new = preg_replace('/[^A-Za-z0-9+-]/', '', \Str::lower($gmt));
            $slug = $new . '-dst-' . $dst;
        }

        // Check if the UTC slug already exists and adjust if necessary
        if (Slug::where('slug', $utc_slug)->exists()) {
            $new_utc_slug = preg_replace('/[^A-Za-z0-9+-]/', '', \Str::lower($utc));
            $utc_slug = $new_utc_slug . '-dst-' . $dst;
        }


// Check if the UTC slug already exists and adjust if necessary
            if (Slug::where('slug', $utc_slug)->exists()) {
                $new_utc_slug = preg_replace('/[^A-Za-z0-9+-]/', '', \Str::lower($utc));
                $utc_slug = $new_utc_slug . '-dst-' . $dst;
            }



        \Log::info(" Gmt : $gmt |" . "UTC : $utc |". "Dst : $dst |" ."Slug : $slug |"."UTC : $utc_slug");

        $gmt = Gmt::firstOrCreate(
            [
                'dst' => $dst,
                'name' => $gmt,
                'utc_name' => $utc
            ],
            [
                'slug' => $slug,
                'utc_slug' => $utc_slug
            ]
        );


        if ($gmt->wasRecentlyCreated) {
            // If the country was just created, create a corresponding slug
            Slug::create([
                'slug' => $slug,
                'model' => Gmt::class,
            ]);

            // If the country was just created, create a corresponding slug
            Slug::create([
                'slug' => $utc_slug,
                'model' => Gmt::class,
            ]);
        }



        return []; // Return the newly created city
    }



}
