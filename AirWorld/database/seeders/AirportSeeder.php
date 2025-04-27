<?php

namespace Database\Seeders;

use App\Models\Airport;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class AirportSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('data/airports.dat');

        if (!File::exists($path)) {
            $this->command->error("Fichier airports.dat introuvable.");
            return;
        }

        $lines = File::lines($path);
      
        $i = 1;

        foreach ($lines as $line) {
            $fields = str_getcsv($line);

            if ($i == 100) break;
            $i++;
          
            if (count($fields) >= 4) {
                Airport::create([
                    'name' => $fields[1],
                    'city' => $fields[2], 
                    'country' => $fields[3],
                ]);
            }
        }
    }
}