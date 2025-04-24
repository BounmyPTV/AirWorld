<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Flight;
use App\Models\Airport;
use App\Models\Airplane;
use Illuminate\Support\Str;

class FlightSeeder extends Seeder
{
    public function run(): void
    {
        $airports = Airport::all();
        $airplanes = Airplane::all();

        if ($airports->count() < 2 || $airplanes->count() == 0) {
            $this->command->error("Il faut au moins 2 aéroports et 1 avion pour générer des vols.");
            return;
        }

        for ($i = 0; $i < 100; $i++) {
            // Dates de départ/arrivée (même jour ou jour suivant)
            $departureDate = now()->addDays(rand(1, 30))->format('Y-m-d');
            $arrivalDate = $departureDate;

            // Heure aléatoire de départ et arrivée (ex: départ à 08h, arrivée à 10h)
            $departureHour = rand(5, 20); // entre 5h et 20h
            $duration = rand(1, 5); // durée du vol en heures
            $arrivalHour = $departureHour + $duration;

            // Aéroports aléatoires (différents)
            $departureAirport = $airports->random();
            do {
                $arrivalAirport = $airports->random();
            } while ($arrivalAirport->id === $departureAirport->id);

            // Création du vol
            Flight::create([
                'departure_date' => $departureDate,
                'arrival_date' => $arrivalDate,
                'departure_time' => sprintf('%02d:00:00', $departureHour),
                'arrival_time' => sprintf('%02d:00:00', $arrivalHour),
                'departure_airport_id' => $departureAirport->id,
                'arrival_airport_id' => $arrivalAirport->id,
                'airplane_id' => $airplanes->random()->id,
                'price' => rand(80, 500),
            ]);
        }
    }
}