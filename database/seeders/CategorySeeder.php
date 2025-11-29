<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Dry Skin', 'description' => 'Products specifically formulated for dry skin types'],
            ['name' => 'Oily Skin', 'description' => 'Products designed to control oil and manage oily skin'],
            ['name' => 'Combination Skin', 'description' => 'Products that balance both dry and oily areas'],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
            ]);
        }
    }
}
