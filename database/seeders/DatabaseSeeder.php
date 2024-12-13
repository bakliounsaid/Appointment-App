<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       $this->call(
        [
        AdminSeeder::class,
        StatesSeeder::class,
        StatusSeeder::class,
        CitiesSeeder::class,
     ]);
    }
}
