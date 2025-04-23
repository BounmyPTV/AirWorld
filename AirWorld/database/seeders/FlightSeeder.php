<?php

namespace Database\Seeders;

use App\Models\Flight;
use Illuminate\Database\Seeder;

class FlightSeeder extends Seeder
{
    public function run(): void
    {
        Flight::create([
            'departure_date' => '2025-05-01',
            'arrival_date' => '2025-05-01',
            'departure_time' => '08:00:00',
            'arrival_time' => '10:00:00',
            'departure_airport_id' => 1,
            'arrival_airport_id' => 2,
            'airplane_id' => 1,
            'price' => 120.00,
        ]);
    }
}