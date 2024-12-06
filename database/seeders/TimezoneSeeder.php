<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Timezone;
use App\Models\Slug;

class TimezoneSeeder extends Seeder
{
    public function run()
    {
        $timezones = [
            ['name' => 'UTC', 'slug' => 'utc'],
            ['name' => 'GMT', 'slug' => 'gmt'],
            ['name' => 'CST', 'slug' => 'cst'],
        ];

        foreach ($timezones as $timezoneData) {
            $timezone = Timezone::create($timezoneData);
            Slug::create([
                'slug' => $timezoneData['slug'],
                'model' => Timezone::class,
            ]);
        }
    }
}
