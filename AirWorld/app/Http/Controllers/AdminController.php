<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use App\Models\Flight;
use App\Models\Airplane;
use Illuminate\Http\Request;

class AdminController extends Controller {
    // Afficher la liste des aéroports
    public function airports() {
        $airports = Airport::all();
        return view("admin.airports.index", compact("airports"));
    }

    // Afficher la liste des avions
    public function airplanes() {
        $airplanes = Airplane::all();
        return view("admin.airplanes.index", compact("airplanes"));
    }

    // Afficher la liste des vols
    public function flights() {
        $flights = Flight::all();
        return view("admin.flights.index", compact("flights"));
    }
    // Afficher la liste des passagères
    public function passengers(){
        $passengers = Passenger::all();
        return view("admin.passengers.index" , compact("passengers"));
    }
    // Afficher la liste des reservations
    public function reservations(){
        $reservation = Reservation::all();
        return view("admin.reservation.index" , compact("reservations"));
    }
    // Afficher la liste des utilisateur
    public function users(){
        $users = User::all();
        return view("admin.user.index" , compact("users"));
    }

    // Ajouter des valeurs dans la table airport
    public function create_airport(array $airportData) {
        return Airport::firstOrCreate([
            'name' => $airportData['name'],
            'country' => $airportData['country'],
        ]);
    }

    // Ajouter des valeurs dans la table airplane
    public function create_airplane(array $airplaneData) {
        return Airplane::firstOrCreate([
            'model' => $airplaneData['model'],
            'seats' => $airplaneData['seats'],
        ]);
    }

    // Ajouter des valeurs dans la table flight
    public function create_flight(array $flightData) {
        return Flight::create([
            'departure_date' => $flightData['departure_date'],
            'arrival_date' => $flightData['arrival_date'],
            'departure_time' => $flightData['departure_time'],
            'arrival_time' => $flightData['arrival_time'],

            'departure_airport_id' => $this->create_airport([
                'name' => $flightData['departure_airport_name'],
                'country' => $flightData['departure_airport_country'],
            ])->id,

            'arrival_airport_id' => $this->create_airport([
                'name' => $flightData['arrival_airport_name'],
                'country' => $flightData['arrival_airport_country'],
            ])->id,
            
            'airplane_id' => $this->create_airplane([
                'model' => $flightData['airplane_model'],
                'seats' => $flightData['airplane_seats'],
            ])->id,
        ]);
    }

    // Ajouter un aéroport via une requête HTTP
    public function add_airport(Request $request) {
        $request->validate([
            "name" => "required|string|max:255",
            "country" => "required|string|max:255",
        ]);

        $this->create_airport($request->all());

        return redirect()->route('admin.airports.index')
            ->with('success', 'L\'aéroport a bien été créé.');
    }

    // Ajouter un avion via une requête HTTP
    public function add_airplane(Request $request) {
        $request->validate([
            "model" => "required|string|max:255",
            "seats" => "required|integer|min:1",
        ]);

        $this->create_airplane($request->all());

        return redirect()->route('admin.airplanes.index')
            ->with('success', 'L\'avion a bien été créé.');
    }

    // Ajouter un vol via une requête HTTP
    public function add_flight(Request $request) {
        $request->validate([
            'departure_date' => 'required|date',
            'arrival_date' => 'required|date',
            'departure_time' => 'required|date_format:H:i',
            'arrival_time' => 'required|date_format:H:i',
            
            'departure_airport_name' => 'required|string|max:255',
            'departure_airport_country' => 'required|string|max:255',
            'arrival_airport_name' => 'required|string|max:255',
            'arrival_airport_country' => 'required|string|max:255',
    
            'airplane_model' => 'required|string|max:255',
            'airplane_seats' => 'required|integer|min:1',
        ]);

        $this->create_flight($request->all());

        return redirect()->route('admin.flights.index')
            ->with('success', 'Le vol a bien été créé.');
    }

    // Mise à jour dans la table airport d'une ligne avec son id
    public function update_airport(Request $request, $id) {
        $request->validate([
            "name" => "required|string|max:255",
            "country" => "required|string|max:255",
        ]);

        $airport = Airport::findOrFail($id);
        $airport->update($request->all());

        return redirect()->route('admin.airports.index')
            ->with('success', 'L\'aéroport a bien été mis à jour.');
    }

    // Mise à jour dans la table airplane d'une ligne avec son id
    public function update_airplane(Request $request, $id) {
        $request->validate([
            "model" => "required|string|max:255",
            "seats" => "required|integer|min:1",
        ]);

        $airplane = Airplane::findOrFail($id);
        $airplane->update($request->all());

        return redirect()->route('admin.airplanes.index')
            ->with('success', 'L\'avion a bien été mis à jour.');
    }

    // Mise à jour dans la table flight d'une ligne avec son id
    public function update_flight(Request $request, $id) {
        $request->validate([
            'departure_date' => 'required|date',
            'arrival_date' => 'required|date',
            'departure_time' => 'required|date_format:H:i',
            'arrival_time' => 'required|date_format:H:i',
        ]);

        $flight = Flight::findOrFail($id);
        $flight->update($request->all());

        return redirect()->route('admin.flights.index')
            ->with('success', 'Le vol a bien été mis à jour.');
    }

    // Suppression dans la table airport d'une ligne avec son id
    public function delete_airport($id) {
        $airport = Airport::findOrFail($id);
        $airport->delete();

        return redirect()->route('admin.airports.index')
            ->with('success', 'L\'aéroport a bien été supprimé.');
    }

    // Suppression dans la table airplane d'une ligne avec son id
    public function delete_airplane($id) {
        $airplane = Airplane::findOrFail($id);
        $airplane->delete();

        return redirect()->route('admin.airplanes.index')
            ->with('success', 'L\'avion a bien été supprimé.');
    }

    // Suppression dans la table flight d'une ligne avec son id
    public function delete_flight($id) {
        $flight = Flight::findOrFail($id);
        $flight->delete();

        return redirect()->route('admin.flights.index')
            ->with('success', 'Le vol a bien été supprimé.');
    }



}    