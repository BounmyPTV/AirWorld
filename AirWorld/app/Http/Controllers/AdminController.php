<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use App\Models\Flight;
use App\Models\Airplane;

use Illuminate\Http\Request;

class AdminController extends Controller {
    public function createAirport(Request $request) {
        $airport = new Airport();
        $airport->name = $request->get("name");
        $airport->country = $request->get("country");
        $airport->save();

        return view("admin", ["db" => $airport]);        
    }

    public function createAirplane(Request $request) {
        $airplane = new Airplane();
        $airplane->model = $request->get("model");
        $airplane->seats = $request->get("seats");
        $airplane->save();

        return view("admin", ["db" => $airplane]);        
    }

    public function createFlight(Request $request) {
        $flight = new Flight();
        
        $flight->departure_date = $request->get("departure_date");
        $flight->arrival_date = $request->get("arrival_date");
        $flight->departure_time = $request->get("departure_time");
        $flight->arrival_time = $request->get("arrival_time");

        $flight->departureAirport()->associate(Airport::find($request->get("departure_airport_id")));
        $flight->arrivalAirport()->associate(Airport::find($request->get("arrival_airport_id")));

        $flight->airplane()->associate(Airplane::find($request->get("airplane_id")));

        $flight->save();

        return view("admin", ["db" => $flight]);
    }

    public function createPassenger(Request $request){
        $passenger = new Passenger();

        $passenger->firstname = $request->get("firstname");
        $passenger->surname = $request->get("surname");
        $passenger->seatnumber = $request->get("seatnumber");

        $passenger->reservation()->associate(Reservation::find($request->get("reservation_id")));

        $passenger->save();

        return view("admin" , ["passenger" => $passenger]);
    }

    public function createAdmin(Request $request){
        $admin = new Admin();

        $admin->name = $request->get("name");
        $admin->email = $request->get("email");
        $admin->password= $request->get("password");

        return view("admin", ["admin" => $admin]);
    }

    public function createUser(Request $request){
        $user = new User();

        $user->name = $request->get("username");
        $user->email = $request->get("email");
        $user->password = $request->get("password");

        return view("admin" , ["user" => $user]);
    }
    public function createReservation(Request $request){
        $reservation = new Reservation();

        $reservation->baggages = $request->get("baggages");
        $reservation->price = $request->get("price");

        $reservation->user()->associate(User::find($request->get("user_id")));
        $reservation->flight()->associate(Flight::find($request->get("flight_id")));

        $reservation->save();
        return view("admin", ["reservation" => $reservation]);
    }

    public function DeleteAirport(Request $request){
        $request->validate([
            'name' => 'required',
            'country' => 'required'
        ]);

        $airport = Flight::where('name',$request->get('name'))->first();

        if($user){
            $user->delete();
            return back()->with('successful');
        } else {
            return back()->with('error');
        }

        
    }
}