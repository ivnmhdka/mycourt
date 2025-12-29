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

        // 4. Fields (9 Total: 3 Futsal, 3 Badminton, 3 Basketball)
        
        // --- FUTSAL ---
        Field::create([
            'name' => 'Lapangan Futsal 1',
            'category' => 'Futsal',
            'price_per_hour' => 120000,
            'description' => 'Lantai Vinyl Premium, Scoreboard, Parkir Luas',
            'image_path' => 'https://i.pinimg.com/1200x/47/a1/35/47a135ace3bb63af9268b3dc450b5008.jpg',
        ]);
        Field::create([
            'name' => 'Lapangan Futsal 2',
            'category' => 'Futsal',
            'price_per_hour' => 150000,
            'description' => 'Rumput Sintetis Standard FIFA, Shower Room',
            'image_path' => 'https://images.unsplash.com/photo-1529900748604-07564a03e7a6?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
        ]);
        Field::create([
            'name' => 'Lapangan Futsal 3',
            'category' => 'Futsal',
            'price_per_hour' => 200000,
            'description' => 'Lantai Interlock Professional, Standar Kompetisi, Full AC',
            'image_path' => 'https://images.unsplash.com/photo-1552667466-07770ae110d0?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
        ]);

        // --- BADMINTON ---
        Field::create([
            'name' => 'Badminton Court 1',
            'category' => 'Badminton',
            'price_per_hour' => 80000,
            'description' => 'Karpet Standar, LED Lighting, Non-Slip',
            'image_path' => 'https://images.unsplash.com/photo-1626224583764-84786c71971e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
        ]);
        Field::create([
            'name' => 'Badminton Court 2',
            'category' => 'Badminton',
            'price_per_hour' => 100000,
            'description' => 'Karpet Yonex Original, Good Airflow',
            'image_path' => 'https://images.unsplash.com/photo-1596723220452-95f36e8b2b9f?q=80&w=2670&auto=format&fit=crop',
        ]);
        Field::create([
            'name' => 'Badminton Court 3',
            'category' => 'Badminton',
            'price_per_hour' => 150000,
            'description' => 'VVIP Private Court, Full AC',
            'image_path' => 'https://images.unsplash.com/photo-1622363989397-90ff6a27e02e?q=80&w=2671&auto=format&fit=crop',
        ]);

        // --- BASKETBALL ---
        Field::create([
            'name' => 'Basketball Court 1',
            'category' => 'Basketball', // Note: Case sensitive match? View uses lowercase 'basketball'
            'price_per_hour' => 100000,
            'description' => 'Outdoor Area, Ring Standar',
            'image_path' => 'https://images.unsplash.com/photo-1546519638-68e109498ffc?q=80&w=2690&auto=format&fit=crop',
        ]);
        Field::create([
            'name' => 'Basketball Court 2',
            'category' => 'Basketball',
            'price_per_hour' => 150000,
            'description' => 'Indoor Vinyl Sport, Anti-Cedera',
            'image_path' => 'https://images.unsplash.com/photo-1505666287802-93144f1756d3?q=80&w=2574&auto=format&fit=crop',
        ]);
        Field::create([
            'name' => 'Basketball Court 3',
            'category' => 'Basketball',
            'price_per_hour' => 250000,
            'description' => 'Pro NBA Parquet Kayu, FIBA Approved',
            'image_path' => 'https://images.unsplash.com/photo-1504450758481-7338eba7524a?q=80&w=2669&auto=format&fit=crop',
        ]);

    }
}
