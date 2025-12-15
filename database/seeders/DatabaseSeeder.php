<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Field;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Admin Account
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@mycourt.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // 2. Manager Account
        User::create([
            'name' => 'Manager Lapangan',
            'email' => 'manager@mycourt.com',
            'password' => Hash::make('password'),
            'role' => 'manager',
        ]);

        // 3. User Account
        User::create([
            'name' => 'Budi Penyewa',
            'email' => 'user@mycourt.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // 4. Dummy Fields
        Field::create([
            'name' => 'Lapangan Futsal A',
            'category' => 'Futsal',
            'price_per_hour' => 100000,
            'description' => 'Lapangan Futsal Vinyl Standar Internasional',
            'image_path' => 'images/futsal-a.jpg', // Placeholder
        ]);

        Field::create([
            'name' => 'Lapangan Badminton B',
            'category' => 'Badminton',
            'price_per_hour' => 50000,
            'description' => 'Lapangan Badminton Karpet',
            'image_path' => 'images/badminton-b.jpg', // Placeholder
        ]);
        
    }
}
