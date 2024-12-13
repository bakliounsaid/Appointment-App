<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Admin::create([
            'firstname' => "admin",
            'lastname' => "admin",
            'username' => "admin",
            'email' => "admin@mail.com",
            'password' => Hash::make("123456789")
        ]);
    }
}
