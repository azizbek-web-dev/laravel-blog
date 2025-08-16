<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;
use Illuminate\Support\Facades\Hash;

class AdminAuthorSeeder extends Seeder
{
    public function run()
    {
        // Create admin author
        Author::create([
            'name' => 'Admin User',
            'email' => 'admin@devmed.uz',
            'password' => Hash::make('password123'),
            'bio' => 'Administrator of DevMed.uz blog platform',
            'image' => null,
        ]);

        // Create another test author
        Author::create([
            'name' => 'John Doe',
            'email' => 'john@devmed.uz',
            'password' => Hash::make('password123'),
            'bio' => 'Technology enthusiast and blogger',
            'image' => null,
        ]);

        $this->command->info('Admin authors created successfully!');
        $this->command->info('Login credentials:');
        $this->command->info('Email: admin@devmed.uz');
        $this->command->info('Password: password123');
    }
}






