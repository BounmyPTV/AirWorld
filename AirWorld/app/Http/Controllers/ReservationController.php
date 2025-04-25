<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;
use App\Models\Airport;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{

    public function show_reservation($id) {
        $reservations = Flight::with([
            'departureAirport',
            'arrivalAirport',
            'airplane',
        ])
        ->where('id', $id)
        ->get();

        return view("reservation_window", ["res" => $reservations]);
    }

    public function reservation(Request $request){ 
        $airports = Airport::all();

        // Grouper les aéroports par pays
        $groupedAirports = $airports->groupBy('country');

        // Ensuite, tu peux lister un seul aéroport par pays, par exemple le premier
        $uniqueAirportsByCountry = $groupedAirports->map(function ($airports, $country) {
            // Ici, on prend juste le premier aéroport de chaque pays
            return $airports->first();
        });
        $request->validate([
            "departure_id" => "nullable|integer|exists:flights,id",
        ]);
        
        return view('reservation', ["airports" => $uniqueAirportsByCountry]); 
    }


    public function myreservation() {
        $reservations = Reservation::with([
            'flight.departureAirport',
            'flight.arrivalAirport',
            'flight.airplane',
            'passengers'
        ])
        ->where('user_id', Auth::id())
        ->where('price', true)
        ->get();

        // return $reservations;
        return view("profile.reservation", ["res" => $reservations]);
    }
}
