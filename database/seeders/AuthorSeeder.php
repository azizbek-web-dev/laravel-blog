<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;
use Illuminate\Support\Facades\Hash;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Author::create([
            'name' => 'Azizbek Hakimov',
            'email' => 'azizxakimov45@gmail.com',
            'password' => Hash::make('aziz08aziz'),
            'image' => 'img/author-1.png',
            'bio' => 'Azizbek is a software engineer and a blogger.',
            'twitter' => 'https://www.twitter.com/azizbek.hakimov.5',
            'linkedin' => 'https://www.linkedin.com/azizbek.hakimov.5',
            'github' => 'https://www.github.com/azizbek.hakimov.5',
        ]);
    }
}
