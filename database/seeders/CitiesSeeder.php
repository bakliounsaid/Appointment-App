<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Database\Seeder;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities_ar = json_decode(
            file_get_contents(database_path('data/cities/ar.json'))
        );
        $cities_fr = json_decode(
            file_get_contents(database_path('data/cities/fr.json'))
        );
        $cities_en = json_decode(
            file_get_contents(database_path('data/cities/en.json'))
        );

        $countries = Country::with('states')->get();

        foreach ($cities_ar as $key => $arCity) {
            $city = new City([
                'ar_name' => $arCity->name,
                'fr_name' => $cities_fr[$key]->name,
                'en_name' => $cities_en[$key]->name,
            ]);
            $country = $countries->firstWhere('code', $arCity->country_code);
            $state = $country->states->firstWhere('code', $arCity->state_code);

            $city->state()->associate($state);
            $city->save();
        }
    }
}
