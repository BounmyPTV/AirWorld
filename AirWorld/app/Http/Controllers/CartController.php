<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function cart() {
        $res = Reservation::with([
            'flight.departureAirport',
            'flight.arrivalAirport',
            'flight.airplane',
            'passengers'
        ])
        ->where('user_id', Auth::id())
        ->where('paid', false)
        ->get();
    
        $total = 0;
        

        foreach ($res as $reservation) {
            $reservation->total_price = $reservation->flight->price * $reservation->passengers->count();
            $total += $reservation->total_price;
        }
    
        return view("profile.cart", compact('res', 'total'));
    }
    public function delete_cart(Request $request) {
        $reservation = Reservation::find($request->reservation_id);
        $reservation->delete();
        return redirect()->back();
    }

    public function apply_cart() {
        $user = Auth::user();

        Reservation::where('user_id', $user->id)
            ->where('paid', false)
            ->update(['paid' => true]);

        return redirect()->route('account.myreservation')->with('success', 'Paiement effectué avec succès !');
    }
}
