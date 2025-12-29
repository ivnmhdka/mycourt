<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\User;
use App\Models\Field;
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure we have users and fields
        if (User::count() == 0) {
            User::factory(10)->create();
        }
        if (Field::count() == 0) {
            // Basic fields if none exist
             Field::insert([
                ['name' => 'Lapangan Futsal 1', 'type' => 'Vinyl', 'price_per_hour' => 120000],
                ['name' => 'Lapangan Futsal 2', 'type' => 'Sintetis', 'price_per_hour' => 150000],
                ['name' => 'Badminton Court A', 'type' => 'Karpet', 'price_per_hour' => 80000],
            ]);
        }

        // 1. Find or Create specific "Budi Penyewa" user
        $user = User::where('role', 'user')->orderBy('id')->first();
        
        if (!$user) {
            $user = User::factory()->create([
                'name' => 'Budi Penyewa',
                'email' => 'budi@mycourt.com',
                'role' => 'user',
                'password' => bcrypt('password'), // Ensure known password if created
            ]);
        }

        $fields = Field::all();
        if ($fields->isEmpty()) return;

        // Limit to EXACTLY 3 Bookings for this SINGLE user
        
        // Booking 1: Past (Approved/Paid)
        Booking::create([
            'user_id' => $user->id,
            'field_id' => $fields->random()->id,
            'start_time' => Carbon::yesterday()->setHour(10)->setMinute(0),
            'end_time' => Carbon::yesterday()->setHour(12)->setMinute(0),
            'total_price' => 150000,
            'status' => 'approved', // Changed from paid to approved
            'payment_proof' => 'dummy_proof.jpg',
            'created_at' => Carbon::yesterday()->subHours(2),
        ]);

        // Booking 2: Today (Pending)
        Booking::create([
            'user_id' => $user->id,
            'field_id' => $fields->random()->id,
            'start_time' => Carbon::today()->setHour(14)->setMinute(0),
            'end_time' => Carbon::today()->setHour(15)->setMinute(0),
            'total_price' => 100000,
            'status' => 'pending',
            'payment_proof' => null,
            'created_at' => Carbon::today()->subMinutes(30),
        ]);

        // Booking 3: Future (Approved)
        Booking::create([
            'user_id' => $user->id,
            'field_id' => $fields->random()->id,
            'start_time' => Carbon::tomorrow()->setHour(16)->setMinute(0),
            'end_time' => Carbon::tomorrow()->setHour(18)->setMinute(0),
            'total_price' => 200000,
            'status' => 'approved',
            'payment_proof' => 'dummy_proof.jpg',
            'created_at' => Carbon::today(),
        ]);
    }
}
