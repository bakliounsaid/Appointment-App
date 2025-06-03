<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name_fr' => 'Rideaux',
                'name_ar' => 'الستائر',
            ],
            [
                'name_fr' => 'La Rail',
                'name_ar' => 'السكك',
            ],
            [
                'name_fr' => 'Accessoire Rideaux',
                'name_ar' => 'اكسسوارات الستائر',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
