<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Carbon\Carbon;

class SystemController extends Controller
{
    public function discover() { return view('discover'); }
    public function reservation() { return view('reservation'); }
    public function home() { 
        $flight = Flight::with(['departureAirport', 'arrivalAirport', 'airplane']);
        $today = Carbon::now();

        return view('home', [
            'home1' => $flight->inRandomOrder()->take(3)->get(),
            'home2' => $flight->orderBy('price', 'asc')->take(3)->get(),
            'home3' => $flight->whereDate('departure_date', '<=', $today->copy()->addDays(3))
                ->orderBy('departure_date')->take(3)->get(),
        ]);
    }
}