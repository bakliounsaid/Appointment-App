<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Seeder;

class StatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $wilayas = json_decode(file_get_contents(database_path("data/states.json")));

        foreach ($wilayas as $wilaya) {
            State::updateOrCreate(
                [
                    "id" => $wilaya->id,
                    "ar_name" => $wilaya->ar_name,
                    "fr_name" => $wilaya->fr_name
                ],
                [
                    "id" => $wilaya->id,
                    "ar_name" => $wilaya->ar_name,
                    "fr_name" => $wilaya->fr_name
                ],
            );
        }
    }
}
