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
                                    "reservations","passengers"));
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
        return redirect()->route('admin')->with('success_airport', 'Aéroport ajouté avec succès.');
    
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
            'name' => 'required|string',
            'country' => 'required|string'
        ]);

        $airport = Airport::where('name', $request->input('name'))
                        ->where('country', $request->input('country'))
                        ->firstOrFail();

        $airport->delete();
        return redirect()->route('admin')->with('supprime_airport', 'Aéroport supprimé avec succès.');
    }

    // Supprimer un avion
    public function delete_airplane(Request $request) {
        $request->validate([
            'model' => 'required|string',
            'seats' => 'required|integer|min:1'
        ]);
        $airplane = Airplane::where('model', $request->input('model'))
                            ->where('seats', $request->input('seats'))
                            ->first();
        if (!$airplane) {
            return redirect()->route('admin')->with('supprime_airplane', 'Aucun avion correspondant trouvé.');
        }
        $airplane->delete();
        return redirect()->route('admin')->with('supprime_airplane', 'Avion supprimé avec succès.');
    }
    
}

    

//     // Mise à jour dans la table airplane d'une ligne avec son id
//     public function update_airplane(Request $request, $id) {
//         $request->validate([
//             "model" => "required|string|max:255",
//             "seats" => "required|integer|min:1",
//         ]);

//         $airplane = Airplane::findOrFail($id);
//         $airplane->update($request->all());

//         return redirect()->route('admin.airplanes.index')
//             ->with('success', 'L\'avion a bien été mis à jour.');
//     }

//     // Mise à jour dans la table flight d'une ligne avec son id
//     public function update_flight(Request $request, $id) {
//         $request->validate([
//             'departure_date' => 'required|date',
//             'arrival_date' => 'required|date',
//             'departure_time' => 'required|date_format:H:i',
//             'arrival_time' => 'required|date_format:H:i',
//         ]);

//         $flight = Flight::findOrFail($id);
//         $flight->update($request->all());

//         return redirect()->route('admin.flights.index')
//             ->with('success', 'Le vol a bien été mis à jour.');
//     }

//     //Mise à jour dans la tables user d'une ligne avec son id
//     public function update_user(Request $request, $id){
//         $request->validate([
//             'name' => 'required|string|max:255',
//             'email' => 'required|email',
//             'password' => 'required'
            
//         ]);

//         $user = User::firstOrFail($id);
//         $user->update($request->all());
            
//         return redirect()->route('admin.users.index')
//             ->with('success' , 'Le compte a bien mis à jour');
//     }

//     // Mise à jour dans la table reservation d'une ligne avec son id
//     public function update_reservation(Request $request, $id){
//         $request->validate([
//             'user_id' => ['required',User::exists('users','id')],
//             'flight_id' => ['required',Flight::exists('flights','id')],
//             'baggages' => 'required|integer|min:1',
//             'price' => 'required|integer|min:1'
//         ]);

//         $reservation = Reservation::firstOrFail($id);
//         $reservation->update($request->all());

//         return redirect()->route('admin.reservation.index')
//             ->with('success','La réservation a bien été mis à jour');
//     }

//     // Mise à jour dans la table de passenger d'une ligne avec son id
//     public function update_passenger(Request $request, $id){
//         $request->validate([
//             'firstname' => 'required|string|max:255',
//             'surname' => 'required|string|max:255',
//             'seat_number' => 'required|integer|min:1',
//             'reservation_id' => 'required|integer|min:1'
//         ]);

//         $passenger = Passenger::firstOrFail($id);
//         $passenger->update($request->all());

//         return redirect()->route('admin.passenger.index')
//             ->with('success','Le passagère a bien été mis à jour');
//     

