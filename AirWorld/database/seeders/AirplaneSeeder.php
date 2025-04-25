<?php

namespace Database\Seeders;

use App\Models\Airplane;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class AirplaneSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('data/airplanes.dat');

        if (!File::exists($path)) {
            $this->command->error("Fichier airplane.dat introuvable.");
            return;
        }

        $lines = File::lines($path);

        foreach ($lines as $line) {
            $fields = str_getcsv($line);

            if (count($fields) >= 1) {
                Airplane::create([
                    'model' => $fields[1],   
                    'seats' => rand(50, 300),
                ]);
            }
        }
    }
}