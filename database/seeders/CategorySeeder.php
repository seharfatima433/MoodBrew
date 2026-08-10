<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Category::insert([
            ['name' => 'Coffee', 'slug' => 'coffee', 'description' => 'Our premium roasted coffee blends.', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Brownies', 'slug' => 'brownies', 'description' => 'Freshly baked chocolate brownies.', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Deals', 'slug' => 'deals', 'description' => 'Special combo offers.', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
