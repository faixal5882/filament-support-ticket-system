<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => "Business Class",
                'slug' => "business-class",
                'is_active' => true,
            ],
            [
                'name' => "Economy Class",
                'slug' => "economy-class",
                'is_active' => true,
            ],
            [
                'name' => "First Class",
                'slug' => "first-class",
                'is_active' => true,
            ],
        ];

        Category::insert($categories);
    }
}
