<?php

namespace Database\Seeders;

use App\Models\Reservation;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    public function run(): void
    {
        Reservation::create([
            'user_id' => 1,
            'flight_id' => 1,
            'baggages' => 2,
        ]);
    }
}