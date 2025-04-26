<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use App\Models\Flight;
use App\Models\Airplane;
use App\Models\User;
use App\Models\Reservation;
use App\Models\Passenger;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function show()
    {
        $airports = Airport::paginate(10);
        $airplanes = Airplane::paginate(10);
        $flights = Flight::paginate(10);
        $users = User::paginate(10);
        $reservations = Reservation::paginate(10);
        $passengers = Passenger::paginate(10);
    
        return view('admin', 
            ["list" => compact('airports', 'airplanes', 'flights', 'users', 'reservations', 'passengers')]
        );
    }

    private function success(string $message)
    {
        return redirect()->route('admin')->with('success', $message);
    }

    // Ajout
    public function add_airport(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'country' => 'required|string|max:255',
        ]);

        Airport::create($request->only('name', 'country'));

        return $this->success('Aéroport ajouté avec succès.');
    }

    public function add_airplane(Request $request)
    {
        $request->validate([
            'model' => 'required|string|max:255',
            'seats' => 'required|integer|min:1',
        ]);

        Airplane::create($request->only('model', 'seats'));

        return $this->success('Avion ajouté avec succès.');
    }

    public function add_flight(Request $request)
    {
        $request->validate([
            'departure_date' => 'required|date',
            'arrival_date' => 'required|date',
            'departure_time' => 'required|date_format:H:i',
            'arrival_time' => 'required|date_format:H:i',
            'departure_airport_id' => 'required|integer|exists:airports,id',
            'arrival_airport_id' => 'required|integer|exists:airports,id',
            'airplane_id' => 'required|integer|exists:airplanes,id',
            'price' => 'required|integer|min:1',
        ]);

        Flight::create($request->all());

        return $this->success('Vol ajouté avec succès.');
    }

    public function add_user(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:2',
            'surname' => 'required|string|min:2',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4',
        ]);

        User::create([
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        Auth::attempt($request->only('email', 'password'));

        return $this->success('Utilisateur créé avec succès.');
    }

    public function add_reservation(Request $request)
    {
        $request->validate([
            'flight_id' => 'required|integer|exists:flights,id',
            'user_id' => 'required|integer|exists:users,id',
            'baggages' => 'required|integer|min:1',
            'price' => 'required|integer|min:1',
        ]);

        Reservation::create($request->all());

        return $this->success('Réservation ajoutée avec succès.');
    }

    public function add_passenger(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'seat_number' => 'required|string|max:10',
            'reservation_id' => 'required|integer|exists:reservations,id',
            'adult' => 'required|boolean',
        ]);

        Passenger::create($request->all());

        return $this->success('Passager ajouté avec succès.');
    }

    // Suppression
    public function delete_airport(Request $request)
    {
        $request->validate([
            'airport_id' => 'required|integer|exists:airports,id',
        ]);

        Airport::findOrFail($request->airport_id)->delete();

        return $this->success('Aéroport supprimé avec succès.');
    }

    public function delete_airplane(Request $request)
    {
        $request->validate([
            'airplane_id' => 'required|integer|exists:airplanes,id',
        ]);

        Airplane::findOrFail($request->airplane_id)->delete();

        return $this->success('Avion supprimé avec succès.');
    }

    public function delete_flight(Request $request)
    {
        $request->validate([
            'flight_id' => 'required|integer|exists:flights,id',
        ]);

        Flight::findOrFail($request->flight_id)->delete();

        return $this->success('Vol supprimé avec succès.');
    }

    public function delete_user(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer|exists:users,id',
        ]);

        User::findOrFail($request->user_id)->delete();

        return $this->success('Utilisateur supprimé avec succès.');
    }

    public function delete_reservation(Request $request)
    {
        $request->validate([
            'reservation_id' => 'required|integer|exists:reservations,id',
        ]);

        Reservation::findOrFail($request->reservation_id)->delete();

        return $this->success('Réservation supprimée avec succès.');
    }

    public function delete_passenger(Request $request)
    {
        $request->validate([
            'passenger_id' => 'required|integer|exists:passengers,id',
        ]);

        Passenger::findOrFail($request->passenger_id)->delete();

        return $this->success('Passager supprimé avec succès.');
    }

    // Update
    public function update_airport(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:airports,id',
            'name' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
        ]);

        $airport = Airport::find($request->id);

        if ($request->filled('name')) {
            $airport->name = $request->name;
        }
        if ($request->filled('country')) {
            $airport->country = $request->country;
        }
        $airport->save();

        return $this->success('Aéroport mis à jour avec succès.');
    }

    public function update_airplane(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:airplanes,id',
            'model' => 'nullable|string|max:255',
            'seats' => 'nullable|integer|min:1',
        ]);

        $airplane = Airplane::find($request->id);

        if ($request->filled('model')) {
            $airplane->model = $request->model;
        }
        if ($request->filled('seats')) {
            $airplane->seats = $request->seats;
        }
        $airplane->save();

        return $this->success('Avion mis à jour avec succès.');
    }
}