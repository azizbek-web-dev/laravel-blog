<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Technology',
            'Lifestyle',
            'Health',
            'Travel',
            'Food',
            'Education',
            'Finance',
            'Sports',
            'Entertainment',
            'Fashion',
            'Science',
            'Business',
            'Music',
            'Art',
            'Politics',
            'Gaming',
            'History',
            'Environment',
            'Photography',
            'Self Improvement'
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'name' => $category,
                'description' => $category . ' related articles',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
