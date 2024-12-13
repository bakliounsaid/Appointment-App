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
            ['name' => 'In Progress', 'class' => 'bg-warning'],
            ['name' => 'Validated', 'class' => 'bg-success'],
            ['name' => 'Archived', 'class' => 'bg-danger'],
        ];

        foreach ($statuses as $status) {
            Status::updateOrCreate(['name' => $status['name']], $status);
        }
    }
}
