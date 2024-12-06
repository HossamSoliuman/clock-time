<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;
use App\Models\Slug;

class CitySeeder extends Seeder
{
    public function run()
    {
        $cities = [
            ['name' => 'New York', 'slug' => 'new-york', 'country_id' => 1, 'timezone_id' => 1],
            ['name' => 'Toronto', 'slug' => 'toronto', 'country_id' => 2, 'timezone_id' => 1],
            ['name' => 'Mexico City', 'slug' => 'mexico-city', 'country_id' => 3, 'timezone_id' => 1],
            ['name' => 'Mexico2', 'slug' => 'mexico2', 'country_id' => 3],
        ];

        foreach ($cities as $cityData) {
            $city = City::create($cityData);
            Slug::firstOrCreate([
                'slug' => $cityData['slug'],
                'model' => City::class,
            ]);
        }
    }
}
