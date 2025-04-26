<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use App\Models\Flight;
use App\Models\Airplane;
use App\Models\User;
use App\Models\Reservation;
use App\Models\Passenger;

use App\Http\Controllers\UserController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller {
    public function show()
    {
        $airport = Airport::paginate(10, ['*'], 'airports_page');
        $airplane = Airplane::paginate(10, ['*'], 'airplanes_page');
        $flight = Flight::paginate(10, ['*'], 'flights_page');
        $user = User::paginate(10, ['*'], 'users_page');
        $reservation = Reservation::paginate(10, ['*'], 'reservations_page');
        $passenger = Passenger::paginate(10, ['*'], 'passengers_page');
    
        return view('admin', ["list" => compact('airport', 'airplane', 'flight', 'user', 'reservation', 'passenger')]);
    }

    public function redirection(string $name, string $catchphrase) {
        return redirect()->route('admin')->with("success", $catchphrase);
    }

    public function add_airport(Request $request) {
        $request->validate([
            "name" => "required|string|max:255",
            "country" => "required|string|max:255",
        ]);
        Airport::create($request->only('name', 'country'));
        return $this->redirection('airport', 'Aéroport ajouté avec succès.');
    }

    public function add_airplane(Request $request) {
        $request->validate([
            "model" => "required|string|max:255",
            "seats" => "required|integer|min:1",
        ]);
        Airplane::create($request->only('model', 'seats'));
        return $this->redirection('airplane', "L'avion a bien été créé.");
    }

    public function add_flight(Request $request) {
        $request->validate([
            'departure_date' => 'required|date',
            'arrival_date' => 'required|date',
            'departure_time' => 'required|date_format:H:i',
            'arrival_time' => 'required|date_format:H:i',
            'departure_airport_id' => 'required|integer|min:1',
            'arrival_airport_id' => 'required|integer|min:1',
            'airplane_id' => 'required|integer|min:1',
            'price' => 'required|integer|min:1'
        ]);
        Flight::create($request->all());
        return $this->redirection('flight', "Le vol a bien été créé.");
    }

    public function add_user(Request $request) {
        $request->validate([
            'name' => 'required|string|min:2',
            'surname' => 'required|string|min:2',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4',
            'role' => 'required|in:0,1'
        ]);

        User::create([
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => $request->input('role') ? "admin" : "user"
        ]);

        return $this->redirection('user', "Le compte a bien été créé.");
    }

    public function add_reservation(Request $request) {
        $request->validate([
            'flight_id' => 'required|integer|exists:flights,id',
            'user_id' => 'required|integer|exists:users,id',
            'baggages' => 'required|integer|min:1',
            'price' => 'required|integer|min:1'
        ]);
        Reservation::create($request->all());
        return $this->redirection('reservation', 'Réservation ajoutée.');
    }

    public function add_passenger(Request $request) {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'seat_number' => 'required|string|max:10',
            'reservation_id' => 'required|exists:reservations,id',
        ]);
        Passenger::create($request->all());
        return $this->redirection('passenger', 'Le passager a bien été ajouté.');
    }

    public function delete_airport(Request $request) {
        $request->validate(['airport_id' => 'required|integer|exists:airports,id']);
        Airport::findOrFail($request->input('airport_id'))->delete();
        return $this->redirection('airport', "L'aéroport a bien été supprimé.");
    }

    public function delete_airplane(Request $request) {
        $request->validate(['airplane_id' => 'required|integer|exists:airplanes,id']);
        Airplane::findOrFail($request->input('airplane_id'))->delete();
        return $this->redirection('airplane', "L'avion a bien été supprimé.");
    }

    public function delete_flight(Request $request) {
        $request->validate(['flight_id' => 'required|integer|exists:flights,id']);
        Flight::findOrFail($request->input('flight_id'))->delete();
        return $this->redirection('flight', "Le vol a bien été supprimé.");
    }

    public function delete_user(Request $request) {
        $request->validate(['user_id' => 'required|integer|exists:users,id']);
        User::findOrFail($request->input('user_id'))->delete();
        return $this->redirection('user', "L'utilisateur a bien été supprimé.");
    }

    public function delete_reservation(Request $request) {
        $request->validate(['reservation_id' => 'required|integer|exists:reservations,id']);
        Reservation::findOrFail($request->input('reservation_id'))->delete();
        return $this->redirection('reservation', "La réservation a bien été supprimée.");
    }

    public function delete_passenger(Request $request) {
        $request->validate(['passenger_id' => 'required|integer|exists:passengers,id']);
        Passenger::findOrFail($request->input('passenger_id'))->delete();
        return $this->redirection('passenger', "Le passager a bien été supprimé.");
    }

    public function update_airport(Request $request) {
        $request->validate([
            'id' => 'required|integer|exists:airports,id',
            'name' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255'
        ]);

        $airport = Airport::find($request->input('id'));
        $airport->update($request->only('name', 'country'));
        return $this->redirection('airport', "L'aéroport a été mis à jour.");
    }

    public function update_airplane(Request $request) {
        $request->validate([
            'id' => 'required|integer|exists:airplanes,id',
            'model' => 'nullable|string|max:255',
            'seats' => 'nullable|integer|min:1'
        ]);

        $airplane = Airplane::find($request->input('id'));
        $airplane->update($request->only('model', 'seats'));
        return $this->redirection('airplane', "L'avion a été mis à jour.");
    }

    public function update_flight(Request $request) {
        $request->validate([
            'id' => 'required|integer|exists:flights,id',
            'departure_date' => 'nullable|date',
            'arrival_date' => 'nullable|date',
            'departure_time' => 'nullable|date_format:H:i',
            'arrival_time' => 'nullable|date_format:H:i',
            'departure_airport_id' => 'nullable|integer|min:1',
            'arrival_airport_id' => 'nullable|integer|min:1',
            'airplane_id' => 'nullable|integer|min:1',
            'price' => 'nullable|integer|min:1'
        ]);

        $flight = Flight::find($request->input('id'));
        $flight->update($request->all());
        return $this->redirection('flight', "Le vol a été mis à jour.");
    }

    public function update_reservation(Request $request) {
        $request->validate([
            'id' => 'required|integer|exists:reservations,id',
            'flight_id' => 'nullable|integer|exists:flights,id',
            'user_id' => 'nullable|integer|exists:users,id',
            'baggages' => 'nullable|integer|min:1',
            'price' => 'nullable|integer|min:1'
        ]);

        $reservation = Reservation::find($request->input('id'));
        $reservation->update($request->all());
        return $this->redirection('reservation', "La réservation a été mise à jour.");
    }

    public function update_user(Request $request) {
        $request->validate([
            'id' => 'required|integer|exists:users,id',
            'name' => 'nullable|string|min:2',
            'surname' => 'nullable|string|min:2',
            'email' => 'nullable|email|unique:users,email',
            'password' => 'nullable|min:4'
        ]);

        $user = User::find($request->input('id'));
        if ($request->filled('password')) {
            $request->merge(['password' => Hash::make($request->password)]);
        }
        $user->update($request->only('name', 'surname', 'email', 'password'));
        return $this->redirection('user', "L'utilisateur a été mis à jour.");
    }

    public function update_passenger(Request $request) {
        $request->validate([
            'id' => 'required|integer|exists:passengers,id',
            'firstname' => 'nullable|string|max:255',
            'surname' => 'nullable|string|max:255',
            'seat_number' => 'nullable|string|max:10',
            'reservation_id' => 'nullable|exists:reservations,id',
            'adult' => 'nullable|boolean'
        ]);

        $passenger = Passenger::find($request->input('id'));
        $passenger->update($request->all());
        return $this->redirection('passenger', "Le passager a été mis à jour.");
    }
}
