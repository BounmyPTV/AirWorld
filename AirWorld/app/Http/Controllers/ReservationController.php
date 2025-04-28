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
        
        $flights = $flights->with(['departureAirport', 'arrivalAirport', 'airplane']);
        if (empty($request->all())) $flights = $flights->inRandomOrder();
        $flights = $flights->paginate(20);

        $res = Reservation::with(
            ['passengers']
        );

        foreach($flights as $flight) {
            $totalPassengers = Reservation::where('flight_id', $flight->id)
                ->withCount('passengers') 
                ->get()
                ->sum('passengers_count');
            $flight->total_place = $flight->airplane->seats - $totalPassengers;
        }

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
        $res = Reservation::with([
            'flight.departureAirport',
            'flight.arrivalAirport',
            'flight.airplane',
            'passengers'
        ])
        ->where('user_id', Auth::id())
        ->where('paid', true)
        ->get();

        // return $reservations;
        return view("profile.reservation", compact('res'));
    }

    public function show_reservation($id) {
        $flight = Flight::with([
            'departureAirport',
            'arrivalAirport',
            'airplane',
        ])
        ->find($id)
        ->first();

        if (!$flight) {
            return redirect()->route('reservation.homepage')->with('error', 'Vol non trouvé.');
        }

        return view("reservation.show", compact('flight'));
    }
}