<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\State;
use Illuminate\Database\Seeder;

class StatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states_ar = json_decode(
            file_get_contents(database_path('data/states/ar.json'))
        );
        $states_fr = json_decode(
            file_get_contents(database_path('data/states/fr.json'))
        );
        $states_en = json_decode(
            file_get_contents(database_path('data/states/en.json'))
        );

        $countries = Country::get();

        foreach ($states_ar as $key => $arState) {
            $state = new State([
                'code' => $arState->code,
                'ar_name' => $arState->name,
                'en_name' => $states_en[$key]->name,
                'fr_name' => $states_fr[$key]->name,
            ]);
            $country = $countries->firstWhere('code', $arState->country_code);
            $state->country()->associate($country);
            $state->save();
        }
    }
}
