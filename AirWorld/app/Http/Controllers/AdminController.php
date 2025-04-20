<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use App\Models\Flight;
use App\Models\Airplane;
use App\Models\Reservation;
use App\Models\Passenger;
use App\Models\User;

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


    #####
#############
    #####

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

    //Ajouter des valeurs dans la table user
    public function create_user(array $userData){
        return User::create([
            'name' => $userData['name'],
            'email' => $userData['email'],
            'password' => $userData['password']
        ]);
    }

    // Ajouter des valeurs dans la table reservation
    public function create_reservation(array $reservationData){
        return Reservation::create([
            'user_id' => $reservationData('user_id'),
            'flight_id' => $reservationData('flight_id'),
            'baggages' => $reservationData('baggages'),
            'price' => $reservationData('price'),
        ]);
    }

    // Ajouter des valeurs dans la table passenger
    public function create_passenger(array $passengerData){
        return Passenger::create([
            'firstname' => $passengerData('firstname'),
            'surname' => $passengerData('surname'),
            'seat_number' => $passengerData('seatnumber'),
            'reservation_id' => $passengerData('reservation_id')
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

    // Ajouter un utilisateur via une requête HTTP
    public function add_user(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $this->create_user($request->all());

        return redirect()->route('admin.users.index')
            ->with('success' , 'Le compte a bien été créé');
    }

    // Adjouter une réservation via une reqêute HTTP
    public function add_reservation(Request $request){
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'flight_id' => 'required|exists:flights,id',
            'baggages' => 'required|integer|min:1',
            'price' => 'required|integer|min:1'
        ]);

        $this->create_reservation($request->all());

        return redirect()->route('admin.reservation.index')
            ->with('success','La réservation a bien été créé');
    }

    // Ajouter un passagère via une requête HTTP
    public function add_passager(Request $request){
        $request->validate([
            'firstname' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'seat_number' => 'required|integer|min:1',
            'reservation_id' => 'required|integer|min:1'
        ]);

        $this->create_passenger($request->all());

        return redirect()->route('admin.passeger.index')
            ->with('success','Le passagère a bien été créé');
    }
        #####
    ###############
        #####

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

    //Mise à jour dans la tables user d'une ligne avec son id
    public function update_user(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required'
            
        ]);

        $user = User::firstOrFail($id);
        $user->update($request->all());
            
        return redirect()->route('admin.users.index')
            ->with('success' , 'Le compte a bien mis à jour');
    }

    // Mise à jour dans la table reservation d'une ligne avec son id
    public function update_reservation(Request $request, $id){
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'flight_id' => 'required|exists:flights,id',
            'baggages' => 'required|integer|min:1',
            'price' => 'required|integer|min:1'
        ]);

        $reservation = Reservation::firstOrFail($id);
        $reservation->update($request->all());

        return redirect()->route('admin.reservation.index')
            ->with('success','La réservation a bien été mis à jour');
    }

    // Mise à jour dans la table de passenger d'une ligne avec son id
    public function update_passenger(Request $request, $id){
        $request->validate([
            'firstname' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'seat_number' => 'required|integer|min:1',
            'reservation_id' => 'required|integer|min:1'
        ]);

        $passenger = Passenger::firstOrFail($id);
        $passenger->update($request->all());

        return redirect()->route('admin.passenger.index')
            ->with('success','Le passagère a bien été mis à jour');
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