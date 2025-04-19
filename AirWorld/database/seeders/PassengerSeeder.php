<?php

namespace Database\Seeders;

use App\Models\Passenger;
use Illuminate\Database\Seeder;

class PassengerSeeder extends Seeder
{
    public function run(): void
    {
        Passenger::create([
            'firstname' => 'Alice',
            'surname' => 'Doe',
            'seat_number' => '12A',
            'reservation_id' => 1,
        ]);
    }
}