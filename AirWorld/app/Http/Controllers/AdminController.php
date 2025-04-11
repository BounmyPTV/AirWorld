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
}