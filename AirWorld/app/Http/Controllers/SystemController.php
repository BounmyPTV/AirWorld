<?php

namespace App\Http\Controllers;

use App\Models\Flight;

class SystemController extends Controller
{
    public function discover() { return view('discover'); }
    public function reservation() { return view('reservation'); }
    public function home() { 
        return view('home', 
            ['flight' => Flight::with([
                'departureAirport', 
                'arrivalAirport',
                'airplane'
            ])->get()
        ]); 
    }
}