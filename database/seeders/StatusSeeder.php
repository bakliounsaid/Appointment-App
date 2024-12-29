<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            ['name' => 'Pending', 'class' => 'bg-warning text-dark'],
            ['name' => 'Validated', 'class' => 'bg-primary text-white'],
            ['name' => 'Ongoing', 'class' => 'bg-info text-white'],
            ['name' => 'Archived', 'class' => 'bg-secondary text-white'],
        ];


        foreach ($statuses as $status) {
            Status::updateOrCreate(['name' => $status['name']], $status);
        }
    }
}
