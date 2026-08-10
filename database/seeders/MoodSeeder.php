<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Mood::insert([
            [
                'name' => 'Focus',
                'theme_class' => 'theme-focus',
                'description' => 'Deep dark roasts for deep work.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Relaxing',
                'theme_class' => 'theme-relaxing',
                'description' => 'Smooth, warm blends to wind down.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Energy',
                'theme_class' => 'theme-energy',
                'description' => 'Bright, crisp profiles to jumpstart your day.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
