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
    
        $total = 0;

        foreach ($reservations as $reservation) {
            $reservation->total_price = $reservation->flight->price * $reservation->passengers->count();
            $total += $reservation->total_price;
        }
    
        return view("profile.cart", ["res" => $reservations, "total" => $total]);
    }
    public function delete_cart(Request $request) {
        $reservation = Reservation::find($request->reservation_id);
        $reservation->delete();
        return redirect()->back();
    }

    public function apply_cart() {
        $user = Auth::user();

        Reservation::where('user_id', $user->id)
            ->where('price', false)
            ->update(['price' => true]);

        return redirect()->route('account.myreservation')->with('success', 'Paiement effectué avec succès !');
    }
}
