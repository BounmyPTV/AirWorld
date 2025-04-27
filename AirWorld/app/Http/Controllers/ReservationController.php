<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;
use App\Models\Reservation;
use App\Models\Airport;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function reservation(Request $request) {
        $departureId = $request->input('airport_departure_id'); 
        $arrivalId = $request->input('airport_arrival_id');
        $departureDate = $request->input('departure_date');
        $arrivalDate = $request->input('arrival_date');
    
        $flights = Flight::query();
    
        if ($departureId) $flights->where('departure_airport_id', $departureId);
        if ($arrivalId) $flights->where('arrival_airport_id', $arrivalId);
        if ($departureDate) $flights->whereDate('departure_date', $departureDate);
        if ($arrivalDate) $flights->whereDate('arrival_date', $arrivalDate);
        
        $flights = $flights->with(['departureAirport', 'arrivalAirport'])->paginate(20);
    
        return view('reservation.search', compact('flights'));
    }

    public function search(Request $request) {
        $search = $request->input('query');

        if (empty($search)) {
            return response()->json(Airport::inRandomOrder()->limit(5)->get());
        }

        $results = Airport::where('city', 'like', "%$search%")
                          ->orWhere('country', 'like', "%$search%")
                          ->orWhere('name', 'like', "%$search%")
                          ->limit(5)
                          ->get();
    
        return response()->json($results);
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