<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Author;
use App\Models\Category;
use App\Models\Tag;
use App\Models\ContactMessage;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminAuthorSeeder::class,
            AuthorSeeder::class,
            CategorySeeder::class,
            PostSeeder::class,
        ]);
    }
}
