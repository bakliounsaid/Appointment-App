<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = json_decode(file_get_contents(database_path("data/cities.json")));

        foreach($cities as $city){
            City::updateOrCreate(
                [
                    "state_id" => $city->wilaya_id,
                    "ar_name" => $city->ar_name,
                    "fr_name" => $city->fr_name
                ],
                [
                    "state_id" => $city->wilaya_id,
                    "ar_name" => $city->ar_name,
                    "fr_name" => $city->fr_name
                ]);
        }
    }
}
