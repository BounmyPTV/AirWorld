<?php

namespace Database\Seeders;

use App\Models\Airplane;
use Illuminate\Database\Seeder;

class AirplaneSeeder extends Seeder
{
    public function run(): void
    {
        Airplane::create(['model' => 'Airbus A320', 'seats' => 180]);
        Airplane::create(['model' => 'Boeing 737', 'seats' => 160]);
    }
}