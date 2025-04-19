<?php

namespace Database\Seeders;

use App\Models\Airport;
use Illuminate\Database\Seeder;

class AirportSeeder extends Seeder
{
    public function run(): void
    {
        Airport::create(['name' => 'Charles de Gaulle', 'country' => 'France']);
        Airport::create(['name' => 'Heathrow', 'country' => 'United Kingdom']);
    }
}