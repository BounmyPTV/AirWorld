<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\Flight;
use App\Models\Passenger;

// Route::get('/reservation', [SystemController::class, 'reservation'])->middleware('auth')->name('myreservation');
// Route::get('/discover', fn() => view('discover'))->name('discover');
// Route::get('/reservation', fn() => view('reservation'))->name('reservation');

class SystemController extends Controller
{
    public function settings() { return view('profile.settings'); }
    public function discover() { return view('discover'); }
    public function myreservation() { return view('profile.reservation'); }
    public function reservation() { return view('reservation'); }
    public function home() { return view('home'); }

    public function cart() {
        $reservations = Reservation::with([
            'flight.departureAirport',
            'flight.arrivalAirport',
            'flight.airplane',
            'passengers'
        ])
        ->where('user_id', Auth::id())
        ->where('price', false)
        ->get();

        // return $reservations;
        return view("profile.cart", ["res" => $reservations]);
    }
}