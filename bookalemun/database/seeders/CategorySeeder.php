<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Aksiyon-Macera',
            'Bilim Kurgu',
            'Tarih',
            'Din',
            'Felsefe',
        ];

        foreach ($categories as $category) {
            Category::create(['category_name' => $category]);
        }
    }
}

