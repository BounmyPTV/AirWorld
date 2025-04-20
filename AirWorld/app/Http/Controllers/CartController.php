<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
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

    public function delete_cart(Request $request) {
        $reservation = Reservation::find($request->reservation_id);
        $reservation->delete();
        return redirect()->back();
    }
}
