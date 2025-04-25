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
    // Afficher la liste des aéroports
    public function show() {
        $airports = Airport::all();        
        $airplanes = Airplane::all();
        $flights = Flight::all();
        $users = User::all();
        $reservations = Reservation::all();
        $passengers = Passenger::all();
        return view("admin", compact("airports","airplanes","flights","users",
                                    "reservations","passengers",));
    }

    public function redirection(string $name, string $catchphrase) {
        return redirect()->route('admin')->with("success_" . $name, $catchphrase);
    }

//     // Ajouter un aéroport via une requête HTTP
public function add_airport(Request $request) {
    
        $request->validate([
            "name" => "required|string|max:255",
            "country" => "required|string|max:255",
        ]);
        Airport::create([
            "name" => $request->input('name'),
            "country" => $request->input('country')
        ]);
        return $this->redirection('airport', 'Aéroport ajouté avec succès.'); 
        // redirect()->route('admin')->with('success_airport', 'Aéroport ajouté avec succès.');
    
}

//     // Ajouter un avion via une requête HTTP
    public function add_airplane(Request $request) {
        $request->validate([
            "model" => "required|string|max:255",
            "seats" => "required|integer|min:1",
        ]);

        Airplane::create([
            "model" => $request->input('model'),
            "seats" => $request->input('seats')
        ]);

        return redirect()->route('admin')
            ->with('success_airplane', 'L\'avion a bien été créé.');
    }

//     // Ajouter un vol via une requête HTTP
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

        Flight :: create($request->all());

        return redirect()->route('admin')
            ->with('success_flight', 'Le vol a bien été créé.');
    }

//     // Ajouter un utilisateur via une requête HTTP
public function add_user(Request $request) {
    $request->validate([
        'name' => 'required|string|min:2',
        'surname' => 'required|string|min:2',
        'email' => 'required|email|unique:users, email',
        'password' => 'required|min:4'
    ]);

    User::create([
        'name'=> $request->input('name'),
        'surname' => $request->input('surname'),
        'email'=> $request->input('email'),
        'password'=> Hash::make($request->input('password')),
    ]);

    Auth::attempt($request->only('email','password'));
    return redirect()->route('admin')
    ->with('success_user', 'Le compte a bien été créé.');
}


    // Adjouter une réservation via une reqêute HTTP
    public function add_reservation(Request $request) {
        $request->validate([
            'flight_id' => 'required|integer|exists:flights,id',
            'user_id' => 'required|integer|exists:users,id',
            'baggages' => 'required|integer|min:1',
            'price' => 'required|integer|min:1'

        ]);

        Reservation::create($request->all());
        return redirect()->route('admin')->with('success_reservation', 'Réservation ajoutée.');
    }

    public function add_passenger(Request $request) {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'seat_number' => 'required|string|max:10',
            'reservation_id' => 'required|exists:reservations,id',
            'adult' => 'required|boolean'
        ]);
            Passenger::create($request->all());
            return redirect()->route('admin')
            ->with('success_passenger', 'Le passager a bien été ajouté.');
    }
 
    // Suprimmer un aéroport
    public function delete_airport(Request $request) {
        $request->validate([
            'airport_id' => 'required|integer|exists:airports,id'
        ]);
    
        Airport::findOrFail($request->input('airport_id'))->delete();
        
        return redirect()->route('admin')
            ->with('delete_airport', 'L’aéroport a bien été supprimé.');
    }
    

    // Supprimer un avion
    public function delete_airplane(Request $request) {
        $request->validate([
            'airplane_id' => 'required|integer|exists:airplanes,id'
        ]);
    
        Airplane::findOrFail($request->input('airplane_id'))->delete();
        
        return redirect()->route('admin')
            ->with('delete_airplane', 'L’avion a bien été supprimé.');
    }
    //supprimer un vol
    public function delete_flight(Request $request) {
        $request->validate([
            'flight_id' => 'required|integer|exists:flights,id'
        ]);
    
        Flight::findOrFail($request->input('flight_id'))->delete();
    
        return redirect()->route('admin')
            ->with('delete_flight', 'Le vol a bien été supprimé.');
    }
    // supprimer un user
    public function delete_user(Request $request) {
        $request->validate([
            'user_id' => 'required|integer|exists:users,id'
        ]);
    
        User::findOrFail($request->input('user_id'))->delete();
        
        return redirect()->route('admin')
            ->with('delete_user', 'L\'utilisateur a bien été supprimé.');
    }
    // supprimer une reservation
    public function delete_reservation(Request $request) {
        $request->validate([
            'reservation_id' => 'required|integer|exists:reservations,id'
        ]);
    
        Reservation::findOrFail($request->input('reservation_id'))->delete();
        
        return redirect()->route('admin')
            ->with('delete_reservation', 'La reservation a bien été supprimé.');
    }
    // supprimer un passager
    public function delete_passenger(Request $request) {
        $request->validate([
            'passenger_id' => 'required|integer|exists:passengers,id'
        ]);
    
        Passenger::findOrFail($request->input('passenger_id'))->delete();
        
        return redirect()->route('admin')
            ->with('delete_passenger', 'Le passager a bien été supprimé.');
    }

    
    public function update_airport(Request $request) {
        $request->validate([
            'id' => 'required|integer|exists:airports,id',
            'name' => 'nullable|string|max:255', 
            'country' => 'nullable|string|max:255'
        ]);

        $airport = Airport::find($request->input('id'));
    
        if ($request->filled('name')) {
            $airport->name = $request->input('name');
        }
        if ($request->filled('country')) {
            $airport->country = $request->input('country');
        }
        $airport->save();
        return $this->redirection('update_airport', 'l\'aéroport a été mise à jour.');
    }

    public function update_airplane(Request $request) {
        $request->validate([
            'id' => 'required|integer|exists:airports,id',
            'name' => 'nullable|string|max:255', 
            'country' => 'nullable|string|max:255'
        ]);

        $airport = Airport::find($request->input('id'));
    
        if ($request->filled('name')) {
            $airport->name = $request->input('name');
        }
        if ($request->filled('country')) {
            $airport->country = $request->input('country');
        }
        $airport->save();
        return $this->redirection('update_airport', 'l\'aéroport a été mise à jour.');
    }
}

    