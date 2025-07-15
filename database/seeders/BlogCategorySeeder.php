<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BlogCategory;

class BlogCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Technology',
            'Education',
            'Health',
            'Lifestyle',
            'Travel',
            'Finance',
            'Food',
            'Entertainment',
            'Career',
        ];

        foreach ($categories as $category) {
            BlogCategory::firstOrCreate(['name' => $category]);
        }
    }
}
