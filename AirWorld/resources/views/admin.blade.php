@extends('template')
@section('title', 'admin')
@section('content')

    @php
use Illuminate\Support\Facades\Schema;


$add = [
    'airport' => [Schema::getColumnListing('airports'), route('Add_Airport')],
    'airplane' => [Schema::getColumnListing('airplanes'), route('Add_Airplane')],
    'reservation' => [Schema::getColumnListing('reservations'), route('Add_Reservation')],
    'flight' => [Schema::getColumnListing('flights'), route('Add_Flight')],
    'passenger' => [Schema::getColumnListing('passengers'), route('Add_Passenger')],
    'user' => [Schema::getColumnListing('users'), route('Add_User')],
];

$ignore_add = ['id', 'created_at', 'updated_at','adult', 'email_verified_at', 'remember_token'];

$delete = [
        "airport" => route('Delete_Airport'), 
        "airplane" => route('Delete_Airplane'), 
        "flight" => route('Delete_Flight') ,
        "reservation" => route('Delete_Reservation'), 
        "passenger" => route('Delete_Passenger') ,
        "user" => route('Delete_User')
    ];

$update = [
    'airport' => [Schema::getColumnListing('airports'), route('Update_Airport')],
    'airplane' => [Schema::getColumnListing('airplanes'), route('Update_Airplane')],
    'reservation' => [Schema::getColumnListing('reservations'), route('Update_Reservation')],
    'flight' => [Schema::getColumnListing('flights'), route('Update_Flight')],
    'passenger' => [Schema::getColumnListing('passengers'), route('Update_Passenger')],
    'user' => [Schema::getColumnListing('users'), route('Update_User')],
];

$ignore_update = ['created_at', 'updated_at', 'adult','email_verified_at', 'remember_token'];

@endphp    

@if($errors->any())
        @foreach($errors->all() as $error)
            <p>{{$error}}</p>
            @endforeach
    @endif
@foreach($add as $name => $list)
    <form action="{{ $list[1] }}" method="post">
        @csrf
        <h3>Add {{ $name }}</h3>

        @php $i = 1; @endphp
        @foreach($list[0] as $column)
            @if(!in_array($column, $ignore_add))
                @php
                    // Déduction du type de champ
                    $type = 'text';
                    if (str_contains($column, 'date')) $type = 'date';
                    elseif (str_contains($column, 'time')) $type = 'time';
                    elseif (str_contains($column, 'email')) $type = 'email';
                    elseif (str_contains($column, 'password')) $type = 'password';
                    elseif ($column === 'id') $type = 'number';
                    elseif (str_ends_with($column, '_id') || str_contains($column, 'price') || str_contains($column, 'seat')) $type = 'number';
                @endphp

                <label>{{ $i }}. {{ str_replace('_', ' ', $column) }}:</label>
                <input type="{{ $type }}" name="{{ $column }}"> <br>
                @php $i++; @endphp
            @endif
        @endforeach

        <input type="submit" name="send" value="Add {{ ucfirst($name) }}">
    </form>
    <br>
    @if(session()->has("success_".$name))
    <p>{{session()->get("success_".$name)}}</p>
@endif
@endforeach

{{-- Supprimer --}}
@foreach($delete as $name => $route)
<form action="{{ $route }}" method="POST">
    <h3>Delete {{ $name }}</h3>
    1. ID <br>
    @csrf
    @method('delete')
    <input type="number" name="{{ $name }}_id">
    <input type="submit" value="Delete" name="delete">
</form>
<br>
@if(session()->has("supprime_".$name))
    <p>{{session()->get("supprime_".$name)}}</p>
@endif
@endforeach

@foreach($update as $name => $list)
    <form action="{{ $list[1] }}" method="post">
        @csrf
        <h3>update {{ $name }}</h3>

        @php $i = 1; @endphp
        @foreach($list[0] as $column)
            @if(!in_array($column, $ignore_update))
                @php
                    // Déduction du type de champ
                    $type = 'text';
                    if (str_contains($column, 'date')) $type = 'date';
                    elseif (str_contains($column, 'time')) $type = 'time';
                    elseif (str_contains($column, 'email')) $type = 'email';
                    elseif (str_contains($column, 'password')) $type = 'password';
                    elseif (str_ends_with($column, '_id') || str_contains($column, 'price') || str_contains($column, 'seat')) $type = 'number';
                @endphp

                <label>{{ $i }}. {{ str_replace('_', ' ', $column) }}:</label>
                <input type="{{ $type }}" name="{{ $column }}"> <br>
                @php $i++; @endphp
            @endif
        @endforeach

        <input type="submit" name="send" value="Update {{ ucfirst($name) }}">
    </form>
    @if(session()->has('update_{{$name}}'))
        <p>{{session()->get("update_".$name)}}</p>
    @endif
@endforeach

   
<div class="container mt-5">
    <h1 class="mb-4">Liste des Aéroports</h1>

    <table border=1px class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Id</th>
                <th>Nom</th>
                <th>Pays</th>
            </tr>
        </thead>
        <tbody>
            @foreach($airports as $airport)
                <tr>
                    <td>{{ $airport->id }}</td>
                    <td>{{ $airport->name }}</td>
                    <td>{{ $airport->country }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="container mt-5">
    <h1 class="mb-4">Liste des avions</h1>

    <table border=1px class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Id</th>
                <th>Nom</th>
                <th>Pays</th>
            </tr>
        </thead>
        <tbody>
            @foreach($airplanes as $airplane)
                <tr>
                    <td>{{ $airplane->id }}</td>
                    <td>{{ $airplane->model }}</td>
                    <td>{{ $airplane->seats }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
 

<div class="container mt-5">
    <h1 class="mb-4">Liste des vols</h1>

    <table border=1px class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Id</th>
                <th>departure_date</th>
                <th>arrival_date</th>
                <th>departure_time</th>
                <th>arrival_time</th>
                <th>departure_airport_id</th>
                <th>arrival_airport_id</th>
                <th>airplane_id</th>
                <th>price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($flights as $flight)
                <tr>
                    <td>{{ $flight->id }}</td>
                    <td>{{ $flight->departure_date }}</td>
                    <td>{{ $flight->arrival_date }}</td>
                    <td>{{ $flight->departure_time}}</td>
                    <td>{{ $flight->arrival_time}}</td>
                    <td>{{ $flight->departure_airport_id }}</td>
                    <td>{{ $flight->arrival_airport_id }}</td>
                    <td>{{ $flight->airplane_id }}</td>
                    <td>{{ $flight->price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
 
<div class="container mt-5">
    <h1 class="mb-4">Liste des utilisateurs</h1>

    <table border=1px class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Id</th>
                <th>Nom</th>
                <th>Nom de famille</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->surname }}</td>
                    <td>{{ $user->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


<div class="container mt-5">
    <h1 class="mb-4">Liste des réservations</h1>

    <table border=1px class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Id</th>
                <th>User id</th>
                <th>Flight id</th>
                <th>Baggages</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->id}}</td>
                    <td>{{ $reservation->user_id}}</td>
                    <td>{{ $reservation->flight_id}}</td>
                    <td>{{ $reservation->baggages}}</td>
                    <td>{{ $reservation->price}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>    
<div class="container mt-5">
    <h1 class="mb-4">Liste des passagers</h1>

    <table border=1px class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Id</th>
                <th>Prénom</th>
                <th>Nom de famille</th>
                <th>Numéro de siège</th>
                <th>Réservation id</th>
                <th>Adulte/Enfant</th>
            </tr>
        </thead>
        <tbody>
            @foreach($passengers as $passenger)
                <tr>
                    <td>{{ $passenger->id }}</td>
                    <td>{{ $passenger->firstname }}</td>
                    <td>{{ $passenger->surname }}</td>
                    <td>{{ $passenger->seat_number }}</td>
                    <td>{{ $passenger->reservation_id }}</td>
                    <td>
                        @if($passenger->adult == 1)
                            Adulte
                        @else
                            Enfant
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


    