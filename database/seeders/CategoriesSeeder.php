<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Technology',
                'description' => 'Latest technology trends, programming tutorials, and tech news',
                'slug' => 'technology',
                'color' => '#3b82f6',
                'icon' => 'fas fa-microchip',
                'meta_title' => 'Technology Blog - Latest Tech Trends & Programming Tutorials',
                'meta_description' => 'Stay updated with the latest technology trends, programming tutorials, and tech news. Expert insights on software development, AI, and emerging technologies.',
                'meta_keywords' => 'technology, programming, software development, AI, tech news, tutorials',
                'og_title' => 'Technology Blog - Your Source for Tech Trends & Programming',
                'og_description' => 'Discover the latest in technology, programming tutorials, and tech insights. Stay ahead with expert analysis and practical guides.',
                'canonical_url' => 'https://yoursite.com/categories/technology'
            ],
            [
                'name' => 'Business',
                'description' => 'Business strategies, entrepreneurship tips, and market insights',
                'slug' => 'business',
                'color' => '#10b981',
                'icon' => 'fas fa-briefcase',
                'meta_title' => 'Business Blog - Entrepreneurship & Business Strategy Guide',
                'meta_description' => 'Expert business advice, entrepreneurship tips, and market insights. Learn strategies to grow your business and succeed in today\'s market.',
                'meta_keywords' => 'business, entrepreneurship, strategy, marketing, leadership',
                'og_title' => 'Business Blog - Expert Advice for Entrepreneurs',
                'og_description' => 'Get expert business advice, entrepreneurship tips, and market insights. Learn proven strategies to grow and succeed in business.',
                'canonical_url' => 'https://yoursite.com/categories/business'
            ],
            [
                'name' => 'Lifestyle',
                'description' => 'Personal development, health tips, and lifestyle advice',
                'slug' => 'lifestyle',
                'color' => '#f59e0b',
                'icon' => 'fas fa-heart',
                'meta_title' => 'Lifestyle Blog - Personal Development & Health Tips',
                'meta_description' => 'Transform your life with personal development tips, health advice, and lifestyle inspiration. Discover ways to live better and happier.',
                'meta_keywords' => 'lifestyle, personal development, health, wellness, motivation',
                'og_title' => 'Lifestyle Blog - Transform Your Life Today',
                'og_description' => 'Transform your life with expert personal development tips, health advice, and lifestyle inspiration. Start living better today.',
                'canonical_url' => 'https://yoursite.com/categories/lifestyle'
            ],
            [
                'name' => 'Travel',
                'description' => 'Travel guides, destination tips, and adventure stories',
                'slug' => 'travel',
                'color' => '#8b5cf6',
                'icon' => 'fas fa-plane',
                'meta_title' => 'Travel Blog - Adventure Guides & Destination Tips',
                'meta_description' => 'Explore the world with our travel guides, destination tips, and adventure stories. Get inspired to plan your next unforgettable journey.',
                'meta_keywords' => 'travel, adventure, destinations, travel tips, tourism',
                'og_title' => 'Travel Blog - Explore the World',
                'og_description' => 'Explore the world with expert travel guides, destination tips, and inspiring adventure stories. Plan your next unforgettable journey.',
                'canonical_url' => 'https://yoursite.com/categories/travel'
            ],
            [
                'name' => 'Food & Cooking',
                'description' => 'Recipes, cooking tips, and culinary adventures',
                'slug' => 'food-cooking',
                'color' => '#ef4444',
                'icon' => 'fas fa-utensils',
                'meta_title' => 'Food & Cooking Blog - Delicious Recipes & Cooking Tips',
                'meta_description' => 'Discover delicious recipes, cooking tips, and culinary adventures. From beginner-friendly dishes to gourmet creations.',
                'meta_keywords' => 'food, cooking, recipes, culinary, cooking tips, cuisine',
                'og_title' => 'Food & Cooking Blog - Delicious Recipes',
                'og_description' => 'Discover delicious recipes, expert cooking tips, and exciting culinary adventures. Perfect for food lovers of all skill levels.',
                'canonical_url' => 'https://yoursite.com/categories/food-cooking'
            ],
            [
                'name' => 'Health & Fitness',
                'description' => 'Fitness tips, health advice, and wellness guides',
                'slug' => 'health-fitness',
                'color' => '#06b6d4',
                'icon' => 'fas fa-dumbbell',
                'meta_title' => 'Health & Fitness Blog - Wellness Tips & Fitness Guides',
                'meta_description' => 'Achieve your health and fitness goals with expert advice, workout plans, and wellness tips. Transform your life with proven strategies.',
                'meta_keywords' => 'health, fitness, wellness, workout, nutrition, exercise',
                'og_title' => 'Health & Fitness Blog - Transform Your Life',
                'og_description' => 'Achieve your health and fitness goals with expert advice, proven workout plans, and wellness tips. Start your transformation today.',
                'canonical_url' => 'https://yoursite.com/categories/health-fitness'
            ]
        ];

        foreach ($categories as $categoryData) {
            Category::updateOrCreate(
                ['slug' => $categoryData['slug']],
                $categoryData
            );
        }

        $this->command->info('Categories seeded successfully!');
    }
}
