<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\Slug;

class CountrySeeder extends Seeder
{
    public function run()
    {
        $countries = [
            ['name' => 'USA', 'slug' => 'usa'],
            ['name' => 'Canada', 'slug' => 'canada'],
            ['name' => 'Mexico', 'slug' => 'mexico'],
        ];

        foreach ($countries as $countryData) {
            $country = Country::create($countryData);
            Slug::firstOrCreate([
                'slug' => $countryData['slug'],
                'model' => Country::class,
            ]);
        }
    }
}
